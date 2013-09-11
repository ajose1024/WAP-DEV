<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * WAP -- WEB Application Platform
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		WAP
 * @author		Epsilon Software
 * @copyright           Copyright (c) 2010 - 2013, Epsilon Software.
 * @license		
 * @link		http://wap.develop.datanet-pt.net
 * @since		Version 0.01
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * WAP Library Template
 *
 * @package		WAP
 * @subpackage          Libraries
 * @category            Libraries
 * @author		AJG @ Epsilon Software
 * @link		http://wap.dev.escrita-virtual.pt/App_code/MVC/application/libraries/data_interface.html
 */
class WAP_data_interface {

	private $CI ;
        private $path_info ;
        private $request_uri ;
        private $query_string ;
        private $data_elements = array();
        
        private $request_method = "" ;
        private $cookies = array() ;

        private $controler = "" ;
        private $function  = "" ;
        private $command   = "" ;
        private $context   = "" ;
        private $data      = "" ;
        
        private $base_data  = array( "", "", "", "", "") ;
        private $extra_data = array() ;
        private $query_string_array = array() ;
        private $query_string_name_array = array() ;
        private $query_string_data_array = array() ;
        private $query_string_data_table = array() ;
        
        private $request_body_data = "" ;
        
        private $controller_level = 1 ;


	/**
	 * Constructor
	 *
	 * Simply determines whether the mcrypt library exists.
	 *
	 */
	public function __construct( $params )
	{
                // Get the Super Object instance
		$this->CI =& get_instance() ;
		$this->_data_interface = ( ! function_exists( 'data_interface' ) ) ? FALSE : TRUE ;

                // Get the $_SERVER[ 'REQUEST_URI' ]
                $this->request_uri = $this->CI->input->server( 'REQUEST_URI' ) ;
                
                // Get the $_SERVER[ 'PATH_INFO' ]
                $this->path_info = $this->CI->input->server( 'PATH_INFO' ) ;

                if( $this->path_info === '' )
                {
                    // PATH_INFO is not set, so get it through the alternative method
                    // using REQUEST_URI
                    if ( strpos( $this->request_uri, '?' ) !== FALSE )
                    {
                        $work_data = explode( '?', $this->request_uri ) ;
                        $this->path_info = $work_data[0] ;
                    }
                    else
                    {
                        $this->path_info = $this->request_uri ;
                    }
                }
                else
                {
                    // PATH_INFO is set, so use it
                    $this->path_info = $this->path_info ;
                }
                
                // Get the passed 'controller_level' and store it into the private
                // property $cotroller_level
                $this->controller_level = $params[ 'controller_level' ] ;

                // Get the REQUEST BODY raw data
                $request_body_data = file_get_contents( 'php://input' ) ;
                        
                
                $this->query_string = $this->CI->input->server('QUERY_STRING') ;
                $this->request_method = strtoupper( $this->CI->input->server('REQUEST_METHOD') );
                
                $this->data_elements = explode( '/', substr( $this->path_info, 1 ) ) ;

                // Adjust the $this->data_elements to get rid of the sub-directories
                for ( $i = 1 ; $i < $this->controller_level ; $i++ )
                {
                    $val = array_shift( $this->data_elements ) ;
                }

                // Get the first 5 elements off
                if ( count( $this->data_elements ) < 5 )
                {
                    for( $i = count( $this->data_elements ) ; $i < 5 ; $i++  )
                    {
                        array_push( $this->data_elements, "" ) ;
                    }
                }

                // The remaining elements are the $this->extra_data
                $this->extra_data = $this->get_extra_data() ;
                
                // Construct the $this->base_data
                $this->base_data = array (
                                            $this->controler,   // Controler
                                            $this->function,    // Function
                                            $this->command,     // Command
                                            $this->context,     // Context
                                            $this->data         // Data
                                         ) ;

                // Generate an array with the QUERY_STRING data
                $this->query_string_array = explode( '&', $this->query_string ) ;
                
                if ( $this->query_string !== "" )
                {
                    for ( $i = 0 ; $i < count( $this->query_string_array ) ; $i++ )
                    {
//                        print( "Element nr. " . $i . " : " . $this->query_string_array[ $i ] . "<br/>") ;

                        if ( strpos( $this->query_string_array[ $i ], '=' ) !== FALSE )
                        {
                            $work_data = explode( '=', $this->query_string_array[ $i ] ) ;
                        }
                        else
                        {
                            $work_data = array( $this->query_string_array[ $i ] , "" ) ;
                        }
                        array_push( $this->query_string_name_array, $work_data[0] ) ;
                        array_push( $this->query_string_data_array, $work_data[1] ) ;

                        $this->query_string_data_table[ $work_data[0] ] = $work_data[1] ;
                    }
                
                }

                // Write to the log
                log_message('debug', "Data_Interface Class Initialized");
	}


	// --------------------------------------------------------------------

	/**
         * Method:  get_data_elements()
         * 
	 * Fetch the URI data elements
	 *
	 * This method returns an array with the individual elements passed on the
         * URL
         * 
	 * @access	public
	 * @param	none
	 * @return	array
	 */
        
	public function get_data_elements( )
	{
		return $this->data_elements ;
	}

        // --------------------------------------------------------------------


	/**
         * Method:  get_controler_name()
         * 
	 * Fetch the URL controler name
	 *
	 * This method returns a string with the name of the URL controler
         * 
	 * @access	public
	 * @param	none
	 * @return	string
	 */
        
	public function get_controler_name( )
	{
		return  $this->controler ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_controler_function_name()
         * 
	 * Fetch the URL controler function name
	 *
	 * This method returns a string with the name of the URL controler function
         * 
	 * @access	public
	 * @param	none
	 * @return	string
	 */
        
	public function get_controler_function_name( )
	{
		return  $this->function ;
	}

	// --------------------------------------------------------------------


	/**
         * Method:  get_command_name()
         * 
	 * Fetch the URL command name
	 *
	 * This method returns a string with the name of the URL command
         * 
	 * @access	public
	 * @param	none
	 * @return	string
	 */
        
	public function get_command_name( )
	{
		return  $this->command ;
	}

	// --------------------------------------------------------------------


	/**
         * Method:  get_context_token()
         * 
	 * Fetch the URL context token
	 *
	 * This method returns a string with the token of the URL context
         * 
	 * @access	public
	 * @param	none
	 * @return	string
	 */
        
	public function get_context_token( )
	{
		return  $this->context ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_data()
         * 
	 * Fetch the URL data
	 *
	 * This method returns a string with the data of the URL
         * 
	 * @access	public
	 * @param	none
	 * @return	string
	 */
        
	public function get_data( )
	{
		return $this->data ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_extra_data()
         * 
	 * Fetch the URL extra data
	 *
	 * This method returns an array with the extra data of the URL
         * 
	 * @access	public
	 * @param	none
	 * @return	array
	 */
        
	public function get_extra_data( )
	{
                $extra_data_elements = $this->data_elements ;
                $this->controler  = array_shift( $extra_data_elements ) ;
                $this->function   = array_shift( $extra_data_elements ) ;
                $this->command    = array_shift( $extra_data_elements ) ;
                $this->context    = array_shift( $extra_data_elements ) ;
                $this->data       = array_shift( $extra_data_elements ) ;
                
		return  $extra_data_elements ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_base_data()
         * 
	 * Fetch the URL base data
	 *
	 * This method returns an array with the base data of the URL
         * 
	 * @access	public
	 * @param	none
	 * @return	array
	 */
        
	public function get_base_data( )
	{
                $this->base_data = array(
                                          $this->data_elements[0],  // Controler
                                          $this->data_elements[1],  // Controler Function
                                          $this->data_elements[2],  // Command name
                                          $this->data_elements[3],  // Context token
                                          $this->data_elements[4]   // Data
                                        ) ;
                
                return  $this->base_data ;
	}

	// --------------------------------------------------------------------


	/**
         * Method:  get_query_string()
         * 
	 * Fetch the QUERY_STRING (if it exists)
	 *
	 * This method returns the whole QUERY_STRING, if it exists, or an empty
         * string, otherwise.
         * 
	 * @access	public
	 * @param	none
	 * @return	string
	 */
        
	public function get_query_string( )
	{
                return  $this->query_string ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_query_string_element_count()
         * 
	 * Return the number of element pairs in the QUERY_STRING
	 *
	 * This method returns the number of element pairs in the whole QUERY_STRING
         * 
	 * @access	public
	 * @param	none
	 * @return	integer
	 */
        
	public function get_query_string_element_count( )
	{
                return  count( $this->query_string_array ) ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_query_string_element_name( $element_nr )
         * 
	 * Return the name of the QUERY_STRING element whose number is passed
	 *
	 * This method returns the name of the QUERY_STRING element whose number
         * is passed.
         * In order to prevent "out of bound" errors, the value passed is MOD 
         * to the number of elements in the QUERY_STRING
         * 
	 * @access	public
	 * @param	none
	 * @return	string
	 */
        
	public function get_query_string_element_name( $element_nr )
	{
            $element_nr = $element_nr - 1 ;
            
            if( $element_nr >= 0 && $element_nr < $this->get_query_string_element_count() )
            {
            
//                var_dump( $element_nr ) ;
//                var_dump( $this->query_string_name_array ) ;
                
                if( is_array( $this->query_string_name_array ) )
                {
                    if( ! empty( $this->query_string_name_array ) )
                    {
                        return  $this->query_string_name_array[ $element_nr ] ;
                    }
                }
            }
            return  null ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_query_string_element_data( $element_nr )
         * 
	 * Return the data of the QUERY_STRING element whose number is passed
	 *
	 * This method returns the data of the QUERY_STRING element whose number
         * is passed.
         * In order to prevent "out of bound" errors, the value passed is MOD 
         * to the number of elements in the QUERY_STRING
         * 
	 * @access	public
	 * @param	none
	 * @return	string
	 */
        
	public function get_query_string_element_data( $element_nr )
	{
            $element_nr = $element_nr - 1 ;
            
            if( $element_nr >= 0 && $element_nr < $this->get_query_string_element_count() )
            {
            
//                var_dump( $element_nr ) ;
//                var_dump( $this->query_string_data_array ) ;
                
                if( is_array( $this->query_string_data_array ) )
                {
                    if( ! empty( $this->query_string_data_array ) )
                    {
                        return  $this->query_string_data_array[ $element_nr ] ;
                    }
                }
            }
            return  null ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_query_string_element_by_name( $element_name )
         * 
	 * Return the data of the QUERY_STRING element whose name is passed
	 *
	 * This method returns the data of the QUERY_STRING element whose name
         * is passed.
         * 
	 * @access	public
	 * @param	string
	 * @return	string
	 */
        
	public function get_query_string_element_by_name( $element_name )
	{
            if( array_key_exists( $element_name , $this->query_string_data_table ) )
            {
                return  $this->query_string_data_table[ $element_name ] ;
            }
            else
            {
                return  null ;
            }
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_request_body_data( )
         * 
	 * Return the data of the REQUEST BODY, when it exists (POST and PUT
         * HTTP methods) and it has not been consumed and stored in the $_POST
         * superglobal array
	 *         * 
	 * @access	public
	 * @param	none
	 * @return	string
	 */
        
	public function get_request_body_data( )
	{
                return  $this->request_body_data ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  get_request_method( )
         * 
	 * Return the REQUEST_METHOD used in the request
	 *
	 * This method returns the REQUEST_METHOD used in the request.
         * The REQUEST_METHOD returned is capitalized.
         * 
	 * @access	public
	 * @param	void
	 * @return	string
	 */
        
	public function get_request_method( )
	{
                return  $this->request_method ;
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  is_GET( )
         * 
	 * Return TRUE if the REQUEST_METHOD is GET.
	 *
	 * This method returns TRUE if the REQUEST_METHOD is GET and FALSE,
         * otherwise.
         * 
	 * @access	public
	 * @param	void
	 * @return	string
	 */
        
	public function is_GET( )
	{
                if( $this->request_method === "GET" )
                {
                    return  TRUE ;
                }
                else
                {
                    return  FALSE ;
                }
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  is_POST( )
         * 
	 * Return TRUE if the REQUEST_METHOD is POST.
	 *
	 * This method returns TRUE if the REQUEST_METHOD is POST and FALSE,
         * otherwise.
         * 
	 * @access	public
	 * @param	void
	 * @return	string
	 */
        
	public function is_POST( )
	{
                if( $this->request_method === "POST" )
                {
                    return  TRUE ;
                }
                else
                {
                    return  FALSE ;
                }
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  is_PUT( )
         * 
	 * Return TRUE if the REQUEST_METHOD is PUT.
	 *
	 * This method returns TRUE if the REQUEST_METHOD is PUT and FALSE,
         * otherwise.
         * 
	 * @access	public
	 * @param	void
	 * @return	string
	 */
        
	public function is_PUT( )
	{
                if( $this->request_method === "PUT" )
                {
                    return  TRUE ;
                }
                else
                {
                    return  FALSE ;
                }
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  is_DELETE( )
         * 
	 * Return TRUE if the REQUEST_METHOD is DELETE.
	 *
	 * This method returns TRUE if the REQUEST_METHOD is DELETE and FALSE,
         * otherwise.
         * 
	 * @access	public
	 * @param	void
	 * @return	string
	 */
        
	public function is_DELETE( )
	{
                if( $this->request_method === "DELETE" )
                {
                    return  TRUE ;
                }
                else
                {
                    return  FALSE ;
                }
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  is_HEAD( )
         * 
	 * Return TRUE if the REQUEST_METHOD is HEAD.
	 *
	 * This method returns TRUE if the REQUEST_METHOD is HEAD and FALSE,
         * otherwise.
         * 
	 * @access	public
	 * @param	void
	 * @return	string
	 */
        
	public function is_HEAD( )
	{
                if( $this->request_method === "HEAD" )
                {
                    return  TRUE ;
                }
                else
                {
                    return  FALSE ;
                }
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  is_OPTIONS( )
         * 
	 * Return TRUE if the REQUEST_METHOD is OPTIONS.
	 *
	 * This method returns TRUE if the REQUEST_METHOD is OPTIONS and FALSE,
         * otherwise.
         * 
	 * @access	public
	 * @param	void
	 * @return	string
	 */
        
	public function is_OPTIONS( )
	{
                if( $this->request_method === "OPTIONS" )
                {
                    return  TRUE ;
                }
                else
                {
                    return  FALSE ;
                }
	}

	// --------------------------------------------------------------------

        
	/**
         * Method:  private_data_dump( )
         * 
	 * Returns an array with all the private data
	 *
	 * This method returns an array with all the private data
         * 
	 * @access	public
	 * @param	void
	 * @return	string
	 */
        
         public function private_data_dump()
         {
             return  array( 'path_info' => $this->path_info ,
                            'request_uri' => $this->request_uri ,
                            'query_string' => $this->query_string ,
                            'data_elements' => $this->data_elements ,
                            'request_method' => $this->request_method ,
                            'request_body_data' => $this->request_body_data ,
                            'cookies' => $this->cookies ,
                            'controler' => $this->controler ,
                            'function' => $this->function  ,
                            'command' => $this->command ,
                            'context' => $this->context ,
                            'data' => $this->data ,
                            'base_data' => $this->base_data ,
                            'extra_data' => $this->extra_data ,
                            'query_string_array' => $this->query_string_array ,
                            'query_string_name_array' => $this->query_string_name_array ,
                            'query_string_data_array' => $this->query_string_data_array ,
                            'query_string_data_table' => $this->query_string_data_table ,
                            'controller_level' => $this->controller_level ,
                            'CI' => $this->CI ,
                          ) ;
         }


}

// END WAP_data_interface class

/* End of file data_interface.php */
/* Location: ./application/libraries/data_interface.php */