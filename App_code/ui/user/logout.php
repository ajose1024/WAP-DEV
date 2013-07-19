<?php

$GLOBALS['DOC_ROOT'] = dirname( $_SERVER['SCRIPT_FILENAME'] );
$GLOBALS['DOC_ROOT'] = $GLOBALS['DOC_ROOT'] . '/../../..';


	ini_set("include_path",".:./rss_reader/App_code:./App_code/include");


    include( $GLOBALS['DOC_ROOT'] . "/App_code/config/App_code_init.php" );


// Code starts here!


    $serialized_User_Auth_obj = (
			session_handling::get_session_data( 'User_Auth' )
					   ) ;

    $user_auth_obj = unserialize( $serialized_User_Auth_obj ) ;


	if( ! session_handling::is_variable_set( 'PSID' ) )
	{
		session_handling::unset_session_data( 'User_Auth' );
		session_handling::set_session_data( 'user_ID' , '-1' );
	}
	else
	{
		session_handling::set_session_data(
					'user_ID' ,
					$user_auth_obj->logout()
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