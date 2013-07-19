<?php

$GLOBALS['DOC_ROOT'] = dirname( $_SERVER['SCRIPT_FILENAME'] );
$GLOBALS['DOC_ROOT'] = $GLOBALS['DOC_ROOT'] . '/../../..';


	ini_set("include_path",".:./rss_reader/App_code:./App_code/include");


    include( $GLOBALS['DOC_ROOT'] . "/App_code/config/App_code_init.php" );


// Code starts here!


	$user_auth_obj = new User_Auth(
					$_POST['Username'],
					$_POST['Password']
				      );


	if( ! session_handling::is_variable_set('PSID') )
	{
		session_handling::unset_session_data( 'User_Auth' );
		session_handling::set_session_data( 'user_ID' , '-1' );
	}
	else
	{
		session_handling::set_session_data(
					'user_ID' ,
					$user_auth_obj->login()
						  );
		session_handling::set_session_data(
					'User_Auth' ,
					serialize( $user_auth_obj )
						  );
	}

	$init_page = 	'http://localhost/' .
			'~php-summer/' . 
			'rss_reader/' .
			'index.php' ;

	header( 'Location: ' . $init_page, 302 ) ;

?>