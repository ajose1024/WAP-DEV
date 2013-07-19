<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  Database Functions:
 * 
 *  Functions:  app_DB_open( $conn_type )
 *              app_DB_close( )
 *              session_DB_access_init( )
 */



    // Function:    app_DB_open( $conn_type )
    //
    // This function received the defined value for the connection type to the
    // 'app_DB' database, returning an array with following format:
    //
    //          array ( 'DB_stats'   => array( 'open'       => TRUE | FALSE ,
    //                                         'fetch_mode' => 'ADODB_FETCH_ASSOC' | 'ADODB_FETCH_NUM' ,
    //                                         'error_nr'   => <error_nr> ,
    //                                         'error_msg'  => <error_message>
    //                                       ) | NULL ,
    //                  'DB_conn_obj => <ADODB_connection_object> ,
    //                  'status'     => 0 | -1 | -2
    //              //    0: The database is registered and the database name is
    //              //       valid
    //              //   -1: The database is registered and the database name is
    //              //       not valid
    //                )

    function app_DB_open( $conn_type )
    {
        // Call the $GLOBALS[ 'sys_DBs_obj' ]->DB_open( 'app_DB' ) to open the
        // ADODB connection to the 'app_DB' database
        $ret_data = $GLOBALS[ 'sys_DBs_obj' ]->DB_open( 'app_DB', $conn_type ) ;
        $DB_conn_obj = $GLOBALS[ 'sys_DBs_obj' ]->get_DB_conn_obj( 'app_DB' ) ;
        
        return   array_merge( $ret_data,
                              array( 'DB_conn_obj' => $DB_conn_obj[ 'conn_obj' ] )
                            ) ;
    }


    // Function:    app_DB_close( )
    //
    // This function closes the connection to the 'app_DB' database, returning
    // an array with following format:
    //
    //          array ( 'DB_stats'   => array( 'open'       => TRUE | FALSE ,
    //                                         'fetch_mode' => 'ADODB_FETCH_ASSOC' | 'ADODB_FETCH_NUM' ,
    //                                         'error_nr'   => <error_nr> ,
    //                                         'error_msg'  => <error_message>
    //                                       ) | NULL ,
    //                  'DB_conn_obj => null ,
    //                  'status'     => 0 | -1 | -2
    //              //    0: The database is registered and the database name is
    //              //       valid
    //              //   -1: The database is registered and the database name is
    //              //       not valid
    //                )

    function app_DB_close( )
    {
        // Call the $GLOBALS[ 'sys_DBs_obj' ]->DB_close( 'app_DB' ) to close the
        // ADODB connection to the 'app_DB' database
        $ret_data = $GLOBALS[ 'sys_DBs_obj' ]->DB_close( 'app_DB' ) ;

        return  array_merge( $ret_data,
                              array( 'DB_conn_obj' => null )
                            ) ;
    }


    // Function:    session_DB_access_init();
    //
    // This function gets the database parameters for the 'app_DB' database and
    // initializes the following static method:
    //
    //      ADODB_session::config(  'driver' ,
    //                              'host' ,
    //                              'user' ,
    //                              'password' ,
    //                              'database'
    //                            )
    // If the database access data for the 'app_DB' database, returns -1, otherwise
    // returns 0.

    function session_DB_access_init( )
    {
        // Get the database access parameters for the 'app_DB' database
        $sess_DB_data = $GLOBALS[ 'sys_DBs_obj' ]->get_DB_params( 'app_DB' ) ;

        // Test to see if the returned 'status' is 0
        if( $sess_DB_data[ 'status' ] === 0 )
        {
            ADOdb_Session::config( $sess_DB_data[ 'driver' ] ,
                                   $sess_DB_data[ 'host' ] ,
                                   $sess_DB_data[ 'user' ] ,
                                   $sess_DB_data[ 'password' ] ,
                                   $sess_DB_data[ 'database' ] ,
                                   $options=false
                                  ) ;
            // ADODB_Session database access sucessfully configured
            return  0 ;
        }
        else
        {
            // ADODB_Session database access not sucessfully configured
            return  -1 ;
        }
    }