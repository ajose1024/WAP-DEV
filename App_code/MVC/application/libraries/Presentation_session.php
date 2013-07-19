<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * WAP - WEB Application Platform
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		WAP - WEB Application Platform
 * @author		Epsilon Software
 * @copyright           Copyright (c) 2010 - 2011, Epsilon Software
 * @license		
 * @link		http://wap.develop.datanet-pt.net
 * @since		Version 0.01
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Session Class
 *
 * @package		WAP
 * @subpackage          Libraries
 * @category            Sessions
 * @author		AJG @ Epsilon Software
 * @link		http://wap.develop.datanet-pt.net/App_code/MVC/user_guide/libraries/presentation_sessions.html
 */
class WAP_Presentation_Session {

	var $p_sess_encrypt_cookie		= TRUE ;
	var $p_sess_use_database		= TRUE ;
	var $p_sess_table_name			= '' ;
	var $p_sess_expiration			= 7200 ;
	var $p_sess_expire_on_close		= FALSE ;
	var $p_sess_match_ip			= FALSE ;
	var $p_sess_match_useragent		= TRUE ;
	var $p_sess_cookie_name			= 'WAP_P_session' ;
	var $p_cookie_prefix			= '' ;
	var $p_cookie_path			= '' ;
	var $p_cookie_domain			= '' ;
	var $p_cookie_secure			= FALSE ;
	var $p_sess_time_to_update		= 300 ;
	var $p_encryption_key			= '' ;
	var $p_flashdata_key			= 'flash' ;
	var $p_time_reference			= 'time' ;
	var $p_gc_probability			= 5 ;
	var $p_userdata				= array() ;
	var $CI ;
	var $now ;

	/**
	 * Presentation Session Constructor
	 *
	 * The constructor runs the session routines automatically
	 * whenever the class is instantiated.
	 */
	public function __construct( $params = array() )
	{
		log_message('debug', "Presentation Session Class Initialized");

		// Set the super object to a local variable for use throughout the class
		$this->CI =& get_instance();

		// Set all the session preferences, which can either be set
		// manually via the $params array above or via the config file
		foreach ( array( 'p_sess_encrypt_cookie',
                                 'p_sess_use_database',
                                 'p_sess_table_name',
                                 'p_sess_expiration',
                                 'p_sess_expire_on_close',
                                 'p_sess_match_ip',
                                 'p_sess_match_useragent',
                                 'p_sess_cookie_name',
                                 'p_cookie_path',
                                 'p_cookie_domain',
                                 'p_cookie_secure',
                                 'p_sess_time_to_update',
                                 'p_time_reference',
                                 'p_cookie_prefix',
                                 'p_encryption_key') 
                          as $key )
 		{
			$this->$key = ( isset( $params[$key] ) ) ? $params[$key] : $this->CI->config->item( $key ) ;
		}

		if ( $this->p_encryption_key == '' )
		{
			show_error('In order to use the Presentation Session class you are required to set an encryption key in your config file.' ) ;
		}

		// Load the string helper so we can use the strip_slashes() function
		$this->CI->load->helper( 'string' ) ;

		// Do we need encryption? If so, load the encryption class
		if ( $this->p_sess_encrypt_cookie == TRUE )
		{
			$this->CI->load->library( 'encrypt' ) ;
		}

		// Are we using a database?  If so, load it
		if ( $this->p_sess_use_database === TRUE AND $this->p_sess_table_name != '' )
		{
			$this->CI->load->database() ;
		}

		// Set the "now" time.  Can either be GMT or server time, based on the
		// config prefs.  We use this to set the "last activity" time
		$this->now = $this->_p_get_time() ;

		// Set the session length. If the session expiration is
		// set to zero we'll set the expiration two years from now.
		if ( $this->p_sess_expiration == 0 )
		{
			$this->p_sess_expiration = ( 60 * 60 * 24 * 365 * 2 ) ;
		}

		// Set the cookie name
		$this->p_sess_cookie_name = $this->p_cookie_prefix.$this->p_sess_cookie_name ;

		// Run the Session routine. If a session doesn't exist we'll
		// create a new one.  If it does, we'll update it.
		if ( ! $this->p_sess_read() )
		{
			$this->p_sess_create() ;
		}
		else
		{
			$this->p_sess_update() ;
		} 

		// Delete 'old' flashdata (from last request)
		$this->_p_flashdata_sweep() ;

		// Mark all new flashdata as old (data will be deleted before next request)
		$this->_p_flashdata_mark() ;

		// Delete expired sessions if necessary
		$this->_p_sess_gc() ;

		log_message('debug', "Presentation Session routines successfully run") ;
	}

        
	// --------------------------------------------------------------------

	/**
	 * Fetch the current presentation session data if it exists
	 *
	 * @access	public
	 * @return	bool
	 */
	public function p_sess_read()
	{
		// Fetch the cookie
		$session = $this->CI->input->cookie( $this->p_sess_cookie_name ) ;

		// No cookie?  Goodbye cruel world!...
		if ( $session === FALSE )
		{
			log_message( 'debug', 'A presentation session cookie was not found.' ) ;
			return FALSE;
		}

		// Decrypt the cookie data
		if ( $this->p_sess_encrypt_cookie == TRUE )
		{
			$session = $this->CI->encrypt->decode( $session ) ;
		}
		else
		{
			// encryption was not used, so we need to check the md5 hash
			$hash	 = substr( $session, strlen( $session ) - 32 ) ;  // get last 32 chars
			$session = substr( $session, 0, strlen( $session ) - 32 ) ;

			// Does the md5 hash match?  This is to prevent manipulation of session data in userspace
			if ( $hash !==  md5( $session . $this->p_encryption_key ) )
		 	{
				log_message( 'error', 'The session cookie data did not match what was expected. This could be a possible hacking attempt.' ) ;
				$this->p_sess_destroy() ;
				return FALSE ;
			}
		}

		// Unserialize the session array
		$session = $this->_p_unserialize( $session ) ;

		// Is the session data we unserialized an array with the correct format?
		if ( ! is_array( $session ) OR
                     ! isset( $session[ 'session_id' ] ) OR
                     ! isset( $session[ 'ip_address' ] ) OR
                     ! isset( $session[ 'user_agent' ] ) OR
                     ! isset( $session[ 'last_activity' ] )
                   )
		{
			$this->p_sess_destroy();
			return FALSE ;
		}

		// Is the session current?
		if ( ( $session[ 'last_activity' ] + $this->p_sess_expiration ) < $this->now )
		{
			$this->p_sess_destroy() ;
			return FALSE ;
		}

		// Does the IP Match?
		if ( $this->p_sess_match_ip == TRUE AND
                     $session[ 'ip_address' ] != $this->CI->input->ip_address()
                   )
		{
			$this->p_sess_destroy() ;
			return FALSE ;
		}

		// Does the User Agent Match?
		if ( $this->p_sess_match_useragent == TRUE AND
                     trim( $session[ 'user_agent' ] ) != trim( substr( $this->CI->input->user_agent(), 0, 120) )
                   )
		{
			$this->p_sess_destroy() ;
			return FALSE ;
		}

		// Is there a corresponding session in the DB?
		if ( $this->p_sess_use_database === TRUE )
		{
			$this->CI->db->where( 'session_id', $session[ 'session_id' ] ) ;

			if ( $this->p_sess_match_ip == TRUE )
			{
				$this->CI->db->where( 'ip_address', $session[ 'ip_address' ] ) ;
			}

			if ( $this->p_sess_match_useragent == TRUE )
			{
				$this->CI->db->where( 'user_agent', $session[ 'user_agent' ] ) ;
			}

			$query = $this->CI->db->get( $this->p_sess_table_name ) ;

			// No result?  Kill it!
			if ( $query->num_rows() == 0 )
			{
				$this->p_sess_destroy() ;
				return FALSE ;
			}

			// Is there custom data?  If so, add it to the main session array
			$row = $query->row() ;
			if ( isset( $row->user_data ) AND $row->user_data != '' )
			{
				$custom_data = $this->_p_unserialize( $row->user_data ) ;

				if ( is_array( $custom_data ) )
				{
					foreach ( $custom_data as $key => $val )
					{
						$session[ $key ] = $val ;
					}
				}
			}
		}

		// Session is valid!
		$this->p_userdata = $session ;
		unset( $session ) ;

		return TRUE ;
	}

        
	// --------------------------------------------------------------------

	/**
	 * Write the session data
	 *
	 * @access	public
	 * @return	void
	 */
	public function p_sess_write()
	{
		// Are we saving custom data to the DB?  If not, all we do is update the cookie
		if ( $this->p_sess_use_database === FALSE )
		{
			$this->_p_set_cookie() ;
			return ;
		}

		// set the custom userdata, the session data we will set in a second
		$custom_userdata = $this->p_userdata ;
		$cookie_userdata = array() ;

		// Before continuing, we need to determine if there is any custom data to deal with.
		// Let's determine this by removing the default indexes to see if there's anything left
                // in the array and set the session data while we're at it
		foreach ( array( 'session_id',
                                 'ip_address',
                                 'user_agent',
                                 'last_activity'
                               )
                          as $val
                        )
		{
			unset( $custom_userdata[ $val ] ) ;
			$cookie_userdata[ $val ] = $this->p_userdata[ $val ] ;
		}

		// Did we find any custom data?  If not, we turn the empty array into a string
		// since there's no reason to serialize and store an empty array in the DB
		if ( count( $custom_userdata ) === 0 )
		{
			$custom_userdata = '' ;
		}
		else
		{
			// Serialize the custom data array so we can store it
			$custom_userdata = $this->_p_serialize( $custom_userdata ) ;
		}

		// Run the update query
		$this->CI->db->where( 'session_id', $this->p_userdata[ 'session_id' ] ) ;
		$this->CI->db->update( $this->p_sess_table_name, array( 'last_activity' => $this->p_userdata[ 'last_activity' ],
                                                                        'user_data' => $custom_userdata ) ) ;

		// Write the cookie.  Notice that we manually pass the cookie data array to the
		// _p_set_cookie() function. Normally that function will store $this->p_userdata, but
		// in this case that array contains custom data, which we do not want in the cookie.
		$this->_p_set_cookie( $cookie_userdata ) ;
	}


        // --------------------------------------------------------------------

	/**
	 * Create a new session
	 *
	 * @access	public
	 * @return	void
	 */
	public function p_sess_create()
	{
		$sessid = '' ;
		while ( strlen( $sessid ) < 32 )
		{
			$sessid .= mt_rand( 0, mt_getrandmax() ) ;
		}

		// To make the session ID even more secure we'll combine it with the user's IP
		$sessid .= $this->CI->input->ip_address() ;

		$this->p_userdata = array(
						'session_id'	=> md5( uniqid( $sessid, TRUE ) ),
						'ip_address'	=> $this->CI->input->ip_address(),
						'user_agent'	=> substr( $this->CI->input->user_agent(), 0, 120 ),
						'last_activity'	=> $this->now,
						'user_data'	=> ''
					 );

		// Save the data to the DB if needed
		if ( $this->p_sess_use_database === TRUE )
		{
			$this->CI->db->query( $this->CI->db->insert_string( $this->p_sess_table_name,
                                                                            $this->p_userdata
                                                                          )
                                            ) ;
		}

		// Write the cookie
		$this->_p_set_cookie() ;
	}


        // --------------------------------------------------------------------

	/**
	 * Update an existing session
	 *
	 * @access	public
	 * @return	void
	 */
	public function p_sess_update()
	{
		// We only update the session every five minutes by default
		if ( ( $this->p_userdata[ 'last_activity' ] + $this->p_sess_time_to_update) >= $this->now )
		{
			return ;
		}

		// Save the old session id so we know which record to
		// update in the database if we need it
		$old_sessid = $this->p_userdata[ 'session_id' ] ;
		$new_sessid = '' ;
		while ( strlen( $new_sessid ) < 32 )
		{
			$new_sessid .= mt_rand( 0, mt_getrandmax() ) ;
		}

		// To make the session ID even more secure we'll combine it with the user's IP
		$new_sessid .= $this->CI->input->ip_address() ;

		// Turn it into a hash
		$new_sessid = md5( uniqid( $new_sessid, TRUE ) ) ;

		// Update the session data in the session data array
		$this->p_userdata[ 'session_id' ] = $new_sessid ;
		$this->p_userdata[ 'last_activity' ] = $this->now ;

		// _p_set_cookie() will handle this for us if we aren't using database sessions
		// by pushing all userdata to the cookie.
		$cookie_data = NULL ;

		// Update the session ID and last_activity field in the DB if needed
		if ( $this->p_sess_use_database === TRUE )
		{
			// set cookie explicitly to only have our session data
			$cookie_data = array() ;
			foreach ( array( 'session_id',
                                         'ip_address',
                                         'user_agent',
                                         'last_activity'
                                       )
                                  as $val
                                )
			{
				$cookie_data[ $val  ] = $this->p_userdata[ $val ] ;
			}

			$this->CI->db->query( $this->CI->db->update_string( $this->p_sess_table_name,
                                                                            array( 'last_activity' => $this->now,
                                                                                   'session_id' => $new_sessid
                                                                                 ),
                                                                            array( 'session_id' => $old_sessid )
                                                                          )
                                            ) ;
		}

		// Write the cookie
		$this->_p_set_cookie( $cookie_data ) ;
	}


        // --------------------------------------------------------------------

	/**
	 * Destroy the current session
	 *
	 * @access	public
	 * @return	void
	 */
	public function p_sess_destroy()
	{
		// Kill the session DB row
		if ( $this->p_sess_use_database === TRUE && isset( $this->p_userdata[ 'session_id' ] ) )
		{
			$this->CI->db->where( 'session_id', $this->p_userdata[ 'session_id' ] ) ;
			$this->CI->db->delete( $this->p_sess_table_name ) ;
		}

		// Kill the cookie
		setcookie(
				$this->p_sess_cookie_name,
				addslashes( serialize( array() ) ),
				( $this->now - 31500000 ),
				$this->p_cookie_path,
				$this->p_cookie_domain,
				0
			 ) ;

		// Kill session data
		$this->p_userdata = array() ;
	}


        // --------------------------------------------------------------------

	/**
	 * Fetch a specific item from the session array
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function p_userdata( $item )
	{
		return ( ! isset( $this->p_userdata[ $item ] ) ) ? FALSE : $this->p_userdata[ $item ] ;
	}


        // --------------------------------------------------------------------

	/**
	 * Fetch all session data
	 *
	 * @access	public
	 * @return	array
	 */
	public function p_all_userdata()
	{
		return $this->p_userdata ;
	}


        // --------------------------------------------------------------------

	/**
	 * Add or change data in the "p_userdata" array
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	public function p_set_userdata( $newdata = array(), $newval = '' )
	{
		if ( is_string( $newdata ) )
		{
			$newdata = array( $newdata => $newval ) ;
		}

		if ( count( $newdata ) > 0 )
		{
			foreach ( $newdata as $key => $val )
			{
				$this->p_userdata[ $key ] = $val ;
			}
		}

		$this->p_sess_write() ;
	}

        
	// --------------------------------------------------------------------

	/**
	 * Delete a session variable from the "userdata" array
	 *
	 * @access	public
         * @param       array
	 * @return	void
	 */
	public function p_unset_userdata( $newdata = array() )
	{
		if ( is_string( $newdata ) )
		{
			$newdata = array( $newdata => '' ) ;
		}

		if ( count( $newdata ) > 0 )
		{
			foreach ( $newdata as $key => $val )
			{
				unset( $this->p_userdata[ $key ] ) ;
			}
		}

		$this->p_sess_write() ;
	}


        // ------------------------------------------------------------------------

	/**
	 * Add or change flashdata, only available
	 * until the next request
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	public function p_set_flashdata( $newdata = array(), $newval = '' )
	{
		if ( is_string( $newdata ) )
		{
			$newdata = array( $newdata => $newval ) ;
		}

		if ( count( $newdata) > 0 )
		{
			foreach ( $newdata as $key => $val )
			{
				$flashdata_key = $this->p_flashdata_key . ':new:' . $key ;
				$this->p_set_userdata( $flashdata_key, $val ) ;
			}
		}
	}


        // ------------------------------------------------------------------------

	/**
	 * Keeps existing flashdata available to next request.
	 *
	 * @access	public
	 * @param	string
	 * @return	void
	 */
	public function p_keep_flashdata( $key )
	{
		// 'old' flashdata gets removed.  Here we mark all
		// flashdata as 'new' to preserve it from _flashdata_sweep()
		// Note the function will return FALSE if the $key
		// provided cannot be found
		$old_flashdata_key = $this->p_flashdata_key . ':old:' . $key ;
		$value = $this->p_userdata( $old_flashdata_key ) ;

		$new_flashdata_key = $this->p_flashdata_key . ':new:' . $key ;
		$this->p_set_userdata( $new_flashdata_key, $value ) ;
	}


        // ------------------------------------------------------------------------

	/**
	 * Fetch a specific flashdata item from the session array
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	public function p_flashdata( $key )
	{
		$flashdata_key = $this->p_flashdata_key . ':old:' . $key ;
		return $this->p_userdata( $flashdata_key ) ;
	}

        
	// ------------------------------------------------------------------------

	/**
	 * Identifies flashdata as 'old' for removal
	 * when _flashdata_sweep() runs.
	 *
	 * @access	private
	 * @return	void
	 */
	private function _p_flashdata_mark()
	{
		$userdata = $this->p_all_userdata() ;
		foreach ( $userdata as $name => $value )
		{
			$parts = explode( ':new:', $name ) ;
			if ( is_array( $parts ) && count( $parts ) === 2 )
			{
				$new_name = $this->p_flashdata_key . ':old:' . $parts[ 1 ] ;
				$this->p_set_userdata( $new_name, $value ) ;
				$this->p_unset_userdata( $name ) ;
			}
		}
	}

        
	// ------------------------------------------------------------------------

	/**
	 * Removes all flashdata marked as 'old'
	 *
	 * @access	private
	 * @return	void
	 */

	private function _p_flashdata_sweep()
	{
		$userdata = $this->p_all_userdata() ;
		foreach ( $userdata as $key => $value )
		{
			if ( strpos( $key, ':old:' ) )
			{
				$this->p_unset_userdata( $key ) ;
			}
		}

	}

        
	// --------------------------------------------------------------------

	/**
	 * Get the "now" time
	 *
	 * @access	private
	 * @return	string
	 */
	private function _p_get_time()
	{
		if ( strtolower( $this->p_time_reference) == 'gmt')
		{
			$now = time() ;
			$time = mktime( gmdate( "H", $now ),
                                        gmdate( "i", $now ),
                                        gmdate( "s", $now ),
                                        gmdate( "m", $now ),
                                        gmdate( "d", $now ),
                                        gmdate( "Y", $now )
                                      ) ;
		}
		else
		{
			$time = time() ;
		}

		return $time ;
	}
        

	// --------------------------------------------------------------------

	/**
	 * Write the session cookie
	 *
	 * @access	public
	 * @return	void
	 */
	public function _p_set_cookie( $cookie_data = NULL )
	{
		if ( is_null( $cookie_data ) )
		{
			$cookie_data = $this->p_userdata ;
		}

		// Serialize the userdata for the cookie
		$cookie_data = $this->_p_serialize( $cookie_data ) ;

		if ( $this->p_sess_encrypt_cookie == TRUE)
		{
			$cookie_data = $this->CI->encrypt->encode( $cookie_data ) ;
		}
		else
		{
			// if encryption is not used, we provide an md5 hash to prevent userside tampering
			$cookie_data = $cookie_data . md5( $cookie_data . $this->p_encryption_key ) ;
		}

		$expire = ( $this->p_sess_expire_on_close === TRUE ) ? 0 : $this->p_sess_expiration + time() ;

		// Set the cookie
		setcookie(
				$this->p_sess_cookie_name,
				$cookie_data,
				$expire,
				$this->p_cookie_path,
				$this->p_cookie_domain,
				$this->p_cookie_secure
			 ) ;
	}


	// --------------------------------------------------------------------

	/**
	 * Serialize an array
	 *
	 * This function first converts any slashes found in the array to a temporary
	 * marker, so when it gets unserialized the slashes will be preserved
	 *
	 * @access	private
	 * @param	array
	 * @return	string
	 */
	private function _p_serialize( $data )
	{
		if ( is_array( $data ) )
		{
			foreach ( $data as $key => $val )
			{
				if ( is_string( $val ) )
				{
					$data[ $key ] = str_replace( '\\', '{{slash}}', $val ) ;
				}
			}
		}
		else
		{
			if ( is_string( $data ) )
			{
				$data = str_replace( '\\', '{{slash}}', $data ) ;
			}
		}

		return serialize( $data ) ;
	}

        
	// --------------------------------------------------------------------

	/**
	 * Unserialize
	 *
	 * This function unserializes a data string, then converts any
	 * temporary slash markers back to actual slashes
	 *
	 * @access	private
	 * @param	array
	 * @return	string
	 */
	private function _p_unserialize( $data )
	{
		$data = @unserialize( strip_slashes( $data ) ) ;

		if ( is_array( $data ) )
		{
			foreach ( $data as $key => $val )
			{
				if ( is_string($val ) )
				{
					$data[ $key ] = str_replace( '{{slash}}', '\\', $val ) ;
				}
			}

			return $data ;
		}

		return ( is_string( $data ) ) ? str_replace( '{{slash}}', '\\', $data ) : $data ;
	}

        
	// --------------------------------------------------------------------

	/**
	 * Garbage collection
	 *
	 * This deletes expired session rows from database
	 * if the probability percentage is met
	 *
	 * @access	public
	 * @return	void
	 */
	public function _p_sess_gc()
	{
		if ( $this->p_sess_use_database != TRUE )
		{
			return ;
		}

		srand( time() ) ;
		if ( ( rand() % 100 ) < $this->p_gc_probability )
		{
			$expire = $this->now - $this->p_sess_expiration ;

			$this->CI->db->where( "last_activity < {$expire}" ) ;
			$this->CI->db->delete( $this->p_sess_table_name ) ;

			log_message('debug', 'Presentation Session garbage collection performed.');
		}
	}
}
// END Session Class

/* End of file Presentatiom_session.php */
/* Location: ./system/libraries/Presentation_session.php */