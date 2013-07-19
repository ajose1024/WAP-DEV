<?php
/*
 * Epsilon Software -- (c) 2012
 * ----------------------------
 * 
 * Code Init (Bootstrap)
 */

// Define the DEFAULT timezone

date_default_timezone_set( 'GMT' ) ;


// Define in a portable way the code base directory

if( $_SERVER[ 'SCRIPT_FILENAME' ] === "" )
{
    if( isset( $_SERVER[ 'ORIG_SCRIPT_FILENAME' ] ) )
    {
        if( $_SERVER[ 'ORIG_SCRIPT_FILENAME' ] !== "" )
        {
            $GLOBALS[ 'DOC_ROOT' ] = dirname( $_SERVER[ 'ORIG_SCRIPT_FILENAME' ] ) ;
        }
        else
        {
            $GLOBALS[ 'DOC_ROOT' ] = '' ;
        }
    }
    else
    {
        $GLOBALS[ 'DOC_ROOT' ] = '' ;
    }
}
else
{
    $GLOBALS[ 'DOC_ROOT' ] = dirname( $_SERVER[ 'SCRIPT_FILENAME' ] ) ;
}


// Redefine the PATH_TRANSLATED, PATH_INFO, SCRIPT_NAME and SCRIPT_FILENAME
// $_SERVER vars:

if( isset( $_SERVER[ 'ORIG_PATH_TRANSLATED' ] ) )
{
    if( $_SERVER[ 'PATH_TRANSLATED' ] === '' )
    {
        $_SERVER[ 'PATH_TRANSLATED' ] = $_SERVER[ 'ORIG_PATH_TRANSLATED' ] ;
    }
    else
    {
        $_SERVER[ 'PATH_TRANSLATED' ] = $_SERVER[ 'PATH_TRANSLATED' ] ;
    }
}

if( isset( $_SERVER[ 'ORIG_PATH_INFO' ] ) )
{
    if( $_SERVER[ 'ORIG_PATH_INFO' ] === '' )
    {
        $_SERVER[ 'PATH_INFO' ] = $_SERVER[ 'ORIG_PATH_INFO' ] ;
    }
    else
    {
        $_SERVER[ 'PATH_INFO' ] = $_SERVER[ 'PATH_INFO' ] ;
    }
}

if( isset( $_SERVER[ 'ORIG_SCRIPT_NAME' ] ) )
{
    if( $_SERVER[ 'ORIG_SCRIPT_NAME' ] === '' )
    {
        $_SERVER[ 'SCRIPT_NAME' ] = $_SERVER[ 'ORIG_SCRIPT_NAME' ] ;
    }
    else
    {
        $_SERVER[ 'SCRIPT_NAME' ] = $_SERVER[ 'SCRIPT_NAME' ] ;
    }
}

if( isset( $_SERVER[ 'ORIG_SCRIPT_FILENAME' ] ) )
{
    if( $_SERVER[ 'ORIG_SCRIPT_FILENAME' ] === '' )
    {
        $_SERVER[ 'SCRIPT_FILENAME' ] = $_SERVER[ 'ORIG_SCRIPT_FILENAME' ] ;
    }
    else
    {
        $_SERVER[ 'SCRIPT_FILENAME' ] = $_SERVER[ 'SCRIPT_FILENAME' ] ;
    }
}


// var_dump( $GLOBALS ) ;


// Include the GLOBAL code definitions files

include( $GLOBALS[ 'DOC_ROOT' ] . '/App_code/config/App_code_definitions.php' ) ;

// var_dump( $GLOBALS ) ;

// Include the global configuration file
include( $GLOBALS[ 'DOC_ROOT' ] . '/App_code/config/App_code_init.php' ) ;

// var_dump( $GLOBALS ) ;

// Include the Code Igniter initialization file
include( $GLOBALS[ 'DOC_ROOT' ] . '/CI_init.php' ) ;

// var_dump( $GLOBALS ) ;

// Include the global post configuration file
include( $GLOBALS[ 'DOC_ROOT' ] . '/App_code/config/App_code_post_init.php' ) ;

// var_dump( $GLOBALS ) ;


// session_handling::start_session() ;

// var_dump( $GLOBALS ) ;

// var_dump( $GLOBALS['sys_DBs_obj']->get_DB_params( 'app_DB' ) ) ;

// echo '<div style="text-align: left ; background-color: #000000 ; ">' ;

// var_dump( app_DB_open( TRUE ) ) ;

// var_dump( app_DB_close() ) ;

// echo '</div>' ;