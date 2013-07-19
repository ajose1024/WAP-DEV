<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$path_parts = pathinfo( $_SERVER['SCRIPT_FILENAME'] );

$GLOBALS['DOC_ROOT'] = $path_parts['dirname'] . '/..' ;


	ini_set("include_path",".:./App_code:./App_code/include");


    include( $GLOBALS['DOC_ROOT'] . "/App_code/config/App_code_init.php" );


// session_handling::destroy_session();
session_handling::start_session();

session_handling::set_session_data("PSID", "qwertyuiop");



print("SESSID=" . session_ID() . "\n");
print("UID=" . "-1" . "\n");

//session_handling::start_session();



print("username=" . $_REQUEST['username'] . "\n");
print("passwd=" . $_REQUEST['passwd'] . "\n");


//session_handling::start_session();

//var_dump($GLOBALS);


?>