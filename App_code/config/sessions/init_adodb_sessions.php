<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;

if( ! isset( $app_DB ) )
{
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/config/databases/app_DB_inc.php'
            ) ;
}

// Get the app_DB connection details
$driver   = $app_DB[ 'driver' ] ;
$host     = $app_DB[ 'host' ] ;
$user     = $app_DB[ 'user' ] ;
$password = $app_DB[ 'password' ] ;
$database = $app_DB[ 'database' ] ;
$options  = FALSE ;

// Initialize ADOdb Session DB connection details
ADOdb_Session::config( $driver, $host, $user, $password, $database, $options ) ;

// Open the database connection
adodb_sess_open( FALSE, FALSE, $connectMode = FALSE ) ;

// Start sessions if WAP_ADODB_SESSIONS_AUTOSTART is true
if( WAP_ADODB_SESSIONS_AUTOSTART )
{
    session_start() ;
}

// Clear the defined variables
unset( $app_DB ) ;
unset( $driver ) ;
unset( $host ) ;
unset( $user ) ;
unset( $password ) ;
unset( $options ) ;
