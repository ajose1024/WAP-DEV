<?php


interface Interface_User_Auth
{
	// This method is a private method to get the $username data
	//
	//


	// This method performs the user login
	//
	// It returns the user_ID which is -1 if there is no user
	// authenticated or the respective user_ID if the user is
	// authenticated
	//
	// If the user is not authenticated 	-->	Return: -1
	// If the user is authenticated			Return: user_ID

	public function login();


	// This methos performs the user logout
	//
	// It returns the 'anonymous user' user_ID (-1)

	public function logout();


	// This method returns if the user is authenticated successfully
	//
	// If the user is authed -->		Return: TRUE
	// If the user is not authed ->		Return: FALSE

	public function user_is_auth();


	// This method returns if the user exists
	//
	// If the user exists -->		Return:	TRUE
	// If the user does not exist -->	Return:	FALSE

	public function user_exists( $username );


	// This method returns an array with the user data if the user exists
	//
	// If the user exists -->	Return:
	//	array(	'user_exists'	=> TRUE ,
	//		'user_is_auth'	=> TRUE / FALSE ,
	//		'user_ID'	=> user_ID ,
	//		'

	public function get_user_data( $username );

}


class User_Auth implements Interface_User_Auth
{
	private	$username ;

	private $password ;

	private $user_is_authed ;

	private $authed_user_ID ;

	private $login_error_code ;

	private $user_data_result_set ;


	// This method is the __sleep() method
	//
	// This method is automatically called before the object is
	// serialized and returns a serialized array with all the
	// object's private variables (object's state)

	public function __sleep()
	{
		return	array(  'username' ,
				'password' ,
				'user_is_authed' ,
				'authed_user_ID' ,
				'login_error_code' ,
				'user_data_result_set'
			      ) ;
	}


	// This method is the __wakeup() method
	//
	// This method is automatically called after the object is de-
	// serialized and initializes the object private variables with
	// the serialized values.

	public function __wakeup()
	{
		
	}


	// This method is a test method to dump the inner content of
	// the object

	public function property_dump()
	{
		return	array(	$this->username ,
				$this->password ,
				$this->user_is_authed ,
				$this->authed_user_ID ,
				$this->login_error_code ,
				$this->user_data_result_set
			     );
	}

	// This method is a private method to get the $username data
	//
	// This function uses the passed $username and opens the auth table
	// of the app_DB database, performing a query to the table, returning
	// the result set of the mmetching row(s)
	//
	// Nothing stops from having more than one user with the same $username
	// at present, although only the 1st one will be considered.

	private function priv_get_user_data( $username )
	{
		// Abrir a base de dados app_DB
  		$app_DB_open_result_array = app_DB_open( 0 );

		if( $app_DB_open_result_array['status'] != 0 )
		{
			//Não foi possivel abrir a base de dados!!!
			print('<hr/>');
			print_r($app_DB_open_result_array);
			print('<hr/>');
		}
		else
		{
        	// $ADODB_conn_obj  tem o objecto de ligação a base de dados
        	$ADODB_conn_obj = $app_DB_open_result_array['conn_obj'];
		}


		$Auth_obj = new Auth;


		$this->user_data_result_set = $Auth_obj->query(
							$ADODB_conn_obj,
							$username
								);


		app_DB_close( $ADODB_conn_obj );

	}


	// This method is the class constructor
	//
	// It receives the $username and the $password and store it on
	// the object's private $username and $password variables

	public function __construct( $username, $password )
	{
		$this->username = $username ;
		$this->password = $password ;

		$this->user_is_authed = FALSE ;
	}


	// This method performs the user login
	//
	// It returns the user_ID which is -1 if there is no user
	// authenticated or the respective user_ID if the user is
	// authenticated
	//
	// If the user is not authenticated 	-->	Return: -1
	// If the user is authenticated			Return: user_ID

	public function login()
	{
		// Assume anonymous user!
		$user_ID = -1 ;

		$user_exist = $this->user_exists( $this->username ) ;

		if ( $user_exist == TRUE )
		{
			// The given Username exists
			$this->priv_get_user_data( $this->username ) ;

			// Consider only the 1st matching $username
			$user_data = $this->user_data_result_set[0] ;

			// Validate the stored password MD5 hash against
			// the computed MD5 hash of the passed password
			if( md5( $this->password ) == $user_data['password'] )
			{
				// The password's hashes match
				$user_ID = $user_data['user_ID'] ;
				$this->login_error_code = 0 ;
			}
			else
			{
				// The password's hashes do not match
				$this->login_error_code = -1 ;
			}
		}
		else
		{
			// The given Username does not exist
			$this->login_error_code = -2 ;
		}

		return  $user_ID ;
	}


	// This methos performs the user logout
	//
	// It returns the 'anonymous user' user_ID (-1)

	public function logout()
	{
		$this->username = NULL ;
		$this->password = NULL ;
		$this->user_is_authed = NULL ;
		$this->authed_user_ID = NULL ;
		$this->login_error_code = NULL ;
		$this->user_data_result_set = NULL ;

		return  -1 ;
	}


	// This method returns if the user is authenticated successfully
	//
	// If the user is authed -->		Return: TRUE
	// If the user is not authed ->		Return: FALSE

	public function user_is_auth()
	{
		return  $this->user_is_authed ;
	}


	// This method returns if the user exists
	//
	// If the user exists -->		Return:	TRUE
	// If the user does not exist -->	Return:	FALSE

	public function user_exists( $username )
	{
		$this->priv_get_user_data( $username );

		if ( $this->user_data_result_set['num_items'] > 0 )
		{
			return  TRUE ;
		}
		else
		{
			return  FALSE ;
		}

	}



	// This method gets the $username data
	//

	public function get_user_data( $username )
	{

	}

}

?>