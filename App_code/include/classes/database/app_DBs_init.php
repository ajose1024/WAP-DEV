<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;
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
 * @link		http://wap.develop.datanet-pt.net/App_code/include/classes/app_databases_init.html
 */

interface Interface_app_DBs_init {

    // Method:  init_DBs()
    // 
    // This method is used to initialize the access parameters to the registered
    // databases within the private storage array
    //
    // For each existing database, there is an entry in an associative array,
    // stored in the $GLOBALS[ 'app_DBs' ] array, in which the key is the database
    // name (ex. 'app_DB') and which contents os the file to be included with the
    // access data for that database.
    // 
    // The relevant data are stored in an array, private to this class, which
    // can only be accessed through the relevant public methods of this class.

    public function init_DBs();


    // Method:  get_DB_params( $DB_name )
    // 
    // This method is used to get the access parameters to a specific database
    // registered into the application.
    //
    // This method returns an array with the following structure:
    //
    //          array ( 'driver'   => <driver> ,
    //                  'host'     => <host> ,
    //                  'user'     => <database_user> ,
    //                  'password' => <database_password> ,
    //                  'database' => <database_name> ,
    //                  'dbprefix' => <db_prefix> ,
    //                  'pconnect' => TRUE | FALSE ,
    //                  'db_debug' => TRUE | FALSE,
    //                  'cache_on' => TRUE | FALSE ,
    //                  'cachedir' => <cache_dir> ,
    //                  'char_set' => <char_set> ,
    //                  'dbcollat' => <db_collat> ,
    //                  'swap_pre' => <swap_pre> ,
    //                  'autoinit' => TRUE | FALSE ,
    //                  'stricton' => TRUE | FALSE ,
    //                  'status'   => 0 | -1
    //                //    0: The database is registered and data is valid
    //                //   -1: The database is not defined and data is not valid
    //                //   -2: The database is not initialized and data is not valid
    //                )

    public function get_DB_params( $DB_name ) ;


    // Method:  get_DB_conn_obj( $DB_name )
    // 
    // This method is used to get the ADODB connection object to the selected
    // database.
    //
    // This method returns an array with the following structure:
    // 
    //          array ( 'conn_obj' => <ADODB_conn_obj_instance> ,
    //                  'status'   => 0 | -1
    //              //    0: The database is registered and the ADODB connection
    //              //       object is valid
    //              //   -1: The database is registered but the ADODB connection
    //              //       object is not valid
    //                )

    public function get_DB_conn_obj( $DB_name ) ;


    // Method:  get_DB_stats( $DB_name )
    // 
    // This method is used to get the database status array for the selected
    // database.
    //
    // This method returns an array with the following structure:
    // 
    //          array ( 'DB_stats' => array( 'open'       => TRUE | FALSE ,
    //                                       'fetch_mode' => 'ADODB_FETCH_ASSOC' | 'ADODB_FETCH_NUM' ,
    //                                       'error_nr'   => <error_nr> ,
    //                                       'error_msg'  => <error_message>
    //                                     ) | NULL ,
    //                  'status'   => 0 | -1 | -2
    //              //    0: The database is registered and the database name is
    //              //       valid
    //              //   -1: The database is registered and the database name is
    //              //       not valid
    //                )

    public function get_DB_status( $DB_name ) ;

    
    // Method:  DB_open( $DB_name, $conn_type )
    // 
    // This method is used to open the selected database, whose name is passed
    // as parameter.
    //
    // This method returns an array with the following structure:
    // 
    //          array ( 'DB_stats' => array( 'open'       => TRUE | FALSE ,
    //                                       'fetch_mode' => 'ADODB_FETCH_ASSOC' | 'ADODB_FETCH_NUM' ,
    //                                       'error_nr'   => <error_nr> ,
    //                                       'error_msg'  => <error_message>
    //                                     ) | NULL ,
    //                  'status'   => 0 | -1 | -2
    //              //    0: The database is registered, the database name is
    //              //       valid and it is open.
    //              //   -1: The database is registered and the database name is
    //              //       not valid
    //                )

    public function DB_open( $DB_name, $conn_type = NULL ) ;

    
    // Method:  DB_close( $DB_name )
    // 
    // This method is used to close the selected database, whose name is passed
    // as parameter.
    //
    // This method returns an array with the following structure:
    // 
    //          array ( 'DB_stats' => array( 'open'       => FALSE ,
    //                                       'fetch_mode' => 'ADODB_FETCH_ASSOC' | 'ADODB_FETCH_NUM' ,
    //                                       'error_nr'   => <error_nr> ,
    //                                       'error_msg'  => <error_message>
    //                                     ) | NULL ,
    //                  'status'   => 0 | -1 | -2
    //              //    0: The database is registered, the database name is
    //              //       valid and the database is closed
    //              //   -1: The database is registered and the database name is
    //              //       not valid
    //                )

    public function DB_close( $DB_name ) ;

    
    
    
}


class app_DBs_init implements Interface_app_DBs_init
{

    // Array which stores the necessary data to connect to the configured
    // databases, registered on this class.
    //
    // The array has an element ( 'nr_DBs' ) which holds the number of registered
    // databases.
    // 
    // The array also has an element ( 'DBs_data' ) which holds an associative
    // array with the access data to a specific database and which key is the
    // database name.
    // For each registered database, each element in array in 'DBs_data' has the
    // following structure:
    //
    //  $app_priv_DBs_data[ 'DBs_data' ] = array( 'DB_name' => array( 'driver' => '' ,
    //                                                                'host' => '' ,
    //                                                                'user' => '' ,
    //                                                                'password' => '' ,
    //                                                                'database' => '' ,
    //                                                                'dbprefix' => '' ,
    //                                                                'pconnect' => FALSE ,
    //                                                                'db_debug' => FALSE ,
    //                                                                'cache_on' => FALSE ,
    //                                                                'cachedir' => '' ,
    //                                                                'char_set' => '' ,
    //                                                                'dbcollat' => '' ,
    //                                                                'swap_pre' => '' ,
    //                                                                'autoinit' => FALSE ,
    //                                                                'stricton' => FALSE
    //                                                               )
    //                                          )
    //
    // The array also has an element ( 'DBs_conn_obj' ) which holds an associative
    // array with the ADODB object for connection with each registered database,
    // and which key is the database name.
    // For each registered database, each element in array in 'DBs_conn_obj' has
    // the following structure:
    //
    //  $app_priv_DBs_data[ 'DBs_conn_obj' ] = array( 'DB_name' => ADODB_conn_obj )
    //
    // By last, the array also has an element ( 'DBs_stats' ) which holds an
    // associative array with verious status information fot each registered
    // database, and which key is the database name.
    // For each registered database, each element in the array in 'DBs_stats' has
    // the following structure:
    //
    //  $app_priv_DBs_data[ 'DBs_stats' ] = array( 'DB_name' => array( 'open'       => TRUE|FALSE ,
    //                                                                 'fetch_mode' => 'ADODB_FETCH_ASSOC' | 'ADODB_FETCH_NUM' ,
    //                                                                 'error_nr'   => <error_nr> ,
    //                                                                 'error_msg'  => <error_message>
    //                                                               )
    //                                           )

    protected $app_priv_DBs_data = array ( 'nr_DBs'       => 0 ,
                                           'DBs_data'     => array( ) ,
                                           'DBs_conn_obj' => array( ) ,
                                           'DBs_stats'    => array( )
                                         ) ;


    // Array to store the necessary data to establish a connection to a database

    protected $app_priv_DB_data = array ( 'driver' => '',
                                          'host' => '',
                                          'user' => '',
                                          'password' => '',
                                          'database' => '' ,
                                          'dbprefix' => '' ,
                                          'pconnect' => FALSE ,
                                          'db_debug' => FALSE ,
                                          'cache_on' => FALSE ,
                                          'cachedir' => '' ,
                                          'char_set' => '' ,
                                          'dbcollat' => '' ,
                                          'swap_pre' => '' ,
                                          'autoinit' => FALSE ,
                                          'stricton' => FALSE
                                        );

    
    // This class ins implemented as a Singleton in order to deal with the
    // concurrent accesses to the databases, re-using always the same connection

    protected static $instance = null ;


    // This is the class constructor.
    // This is a private constructor, since this class is a Singleton.

    public function __construct( )
    {

    }


    // Method to return the instance of the object.
    // 
    // As a Singleton, this method returns always the same instance and not
    // new instances, for each created object from this class.

    public static function Get_Instance( )
    {
        if( ! isset( self::$instance ) )
        {
            $class = __CLASS__ ;
            self::$instance = new $class ;
        }

        return self::$instance ;
    }


    // Method to initialize the access parameters to the database, passed by
    // name
    //
    // For each database exists an entry in an associative array, stored in the
    // $GLOBALS['app_DBs'] array, in which the key in the database's name
    // (ex. 'app_DB') and which contents is the file to be included with the
    // database access data.
    // 
    // The data is stored in an array private to this class, which can only be
    // accessed throughh the class appropriated public methods.

    public static function init_DBs()
    {
        // Get the 'app_DBs' array, which holds all the databases to be used and
        // the absolute path to the respective file with the database access data.
        $app_DBs = $GLOBALS[ 'app_DBs' ] ;

        // For each element of the array, include the respective file and add the
        // database access data into the 'app_priv_DBs_data' associative array
        foreach ( $app_DBs as $DB_name => $DB_init_file )
        {
            // Include the database access data config file
            include( $DB_init_file ) ;
            
            // Increment the number of registered databases
            $this->app_priv_DBs_data[ 'nr_DBs' ] += 1 ;

            // Store the database access data into the 'app_priv_DBs_data' array
            $this->app_priv_DBs_data[ 'DBs_data' ][ $DB_name ] = $$DB_name ;

        }

        // Now that we have already the database access data, we will access
        // each one, in turn, and store the success/unsuccess result accessing
        // it and, if we are successfull, we store the ADODB connection object
        // reference.
            
        foreach ( $this->app_priv_DBs_data[ 'DBs_data' ] as $DB_name => $DB_data )
        {
            // Select the ADODB database driver and open the selected database
            $this->DB_open( $DB_name, TRUE ) ;
            
//
//         $conn->SetFetchMode( ADODB_FETCH_ASSOC ) ;
//
            $this->app_priv_DBs_data[ 'DBs_conn_obj' ][ $DB_name ]->
                                      SetFetchMode( ADODB_FETCH_ASSOC ) ;
            $this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name ][ 'fetch_mode' ] = 'ADODB_FETCH_ASSOC' ;

//
//         $conn->ErrorNo() ;
//
            $this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name ][ 'error_nr' ] =
                $this->app_priv_DBs_data[ 'DBs_conn_obj' ][ $DB_name ]->
                                              ErrorNo() ;

//
//         $conn->ErrorMsg() ;
//            
            $this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name ][ 'error_msg' ] =
                $this->app_priv_DBs_data[ 'DBs_conn_obj' ][ $DB_name ]->
                                              ErrorMsg() ;
            
        }

}


    // Method to get the access data to a registered database in the application
    //
    // This method returs an array with the following structure:
    //
    //          array ( 'driver'   => <driver> ,
    //                  'host'     => <host> ,
    //                  'user'     => <database_user> ,
    //                  'password' => <database_password> ,
    //                  'database' => <database_name> ,
    //                  'dbprefix' => <db_prefix> ,
    //                  'pconnect' => TRUE | FALSE ,
    //                  'db_debug' => TRUE | FALSE,
    //                  'cache_on' => TRUE | FALSE ,
    //                  'cachedir' => <cache_dir> ,
    //                  'char_set' => <char_set> ,
    //                  'dbcollat' => <db_collat> ,
    //                  'swap_pre' => <swap_pre> ,
    //                  'autoinit' => TRUE | FALSE ,
    //                  'stricton' => TRUE | FALSE ,
    //                  'status'   => 0 | -1
    //                //    0: The database is registered and data is valid
    //                //   -1: The database is not defined and data is not valid
    //                //   -2: The database is not initialized and data is not valid
    //                )

    public static function get_DB_params( $DB_name )
    {
        if( array_key_exists( $DB_name, $GLOBALS[ 'app_DBs' ] ) )
        {
            if ( array_key_exists( $DB_name, $this->app_priv_DBs_data[ 'DBs_data' ] ) )
            {
                $DB_data = $this->app_priv_DBs_data[ 'DBs_data' ][ $DB_name ];

                return array ( 'status'   => 0 ,
                               'driver'   => $DB_data[ 'driver' ] ,
                               'host'     => $DB_data[ 'host' ] ,
                               'user'     => $DB_data[ 'user' ] ,
                               'password' => $DB_data[ 'password' ] ,
                               'database' => $DB_data[ 'database' ] ,
                               'dbprefix' => $DB_data[ 'dbprefix' ] ,
                               'pconnect' => $DB_data[ 'pconnect' ] ,
                               'db_debug' => $DB_data[ 'db_debug' ] ,
                               'cache_on' => $DB_data[ 'cache_on' ] ,
                               'cachedir' => $DB_data[ 'cachedir' ] ,
                               'char_set' => $DB_data[ 'char_set' ] ,
                               'dbcollat' => $DB_data[ 'dbcollat' ] ,
                               'swap_pre' => $DB_data[ 'swap_pre' ] ,
                               'autoinit' => $DB_data[ 'autoinit' ] ,
                               'stricton' => $DB_data[ 'stricton' ] 
                             );
            }
            else
            {
                return array ( 'status'   => -2 ,
                               'driver'   => '' ,
                               'host'     => '' ,
                               'user'     => '' ,
                               'password' => '' ,
                               'database' => '' ,
                               'dbprefix' => '' ,
                               'pconnect' => FALSE ,
                               'db_debug' => FALSE ,
                               'cache_on' => FALSE ,
                               'cachedir' => '' ,
                               'char_set' => '' ,
                               'dbcollat' => '' ,
                               'swap_pre' => '' ,
                               'autoinit' => FALSE ,
                               'stricton' => FALSE
                              );
            }
        }
        else
        {
            return array ( 'status'   => -1 ,
                           'driver'   => '' ,
                           'host'     => '' ,
                           'user'     => '' ,
                           'password' => '' ,
                           'database' => '' ,
                           'pconnect' => FALSE ,
                           'db_debug' => FALSE ,
                           'cache_on' => FALSE ,
                           'cachedir' => '' ,
                           'char_set' => '' ,
                           'dbcollat' => '' ,
                           'swap_pre' => '' ,
                           'autoinit' => FALSE ,
                           'stricton' => FALSE
                         );
        }
    }

    
    // Method:  get_DB_conn_obj( $DB_name )
    // 
    // This method is used to get the ADODB connection object to the selected
    // database.
    //
    // This method returns an array with the following structure:
    // 
    //          array ( 'conn_obj' => <ADODB_conn_obj_instance> ,
    //                  'status'   => 0 | -1
    //              //    0: The database is registered and the ADODB connection
    //              //       object is valid
    //              //   -1: The database is registered but the ADODB connection
    //              //       object is not valid
    //                )

    public static function get_DB_conn_obj( $DB_name )
    {
        if( array_key_exists( $DB_name, $GLOBALS[ 'app_DBs' ] ) )
        {
            if ( array_key_exists( $DB_name, $this->app_priv_DBs_data[ 'DBs_conn_obj' ] ) )
            {
                $DB_data = $this->app_priv_DBs_data[ 'DBs_conn_obj' ][ $DB_name ];

                return array ( 'status'   => 0 ,
                               'conn_obj' => $DB_data
                             );
            }
            else
            {
                return array ( 'status'   => -2 ,
                               'conn_obj' => NULL
                              );
            }
        }
        else
        {
            return array ( 'status'   => -1 ,
                           'conn_obj' => NULL
                         );
        }
    }
    

    // Method:  get_DB_stats( $DB_name )
    // 
    // This method is used to get the database status array for the selected
    // database.
    //
    // This method returns an array with the following structure:
    // 
    //          array ( 'DB_stats' => array( 'open'       => TRUE | FALSE ,
    //                                       'fetch_mode' => 'ADODB_FETCH_ASSOC' | 'ADODB_FETCH_NUM' ,
    //                                       'error_nr'   => <error_nr> ,
    //                                       'error_msg'  => <error_message>
    //                                     ) | NULL ,
    //                  'status'   => 0 | -1 | -2
    //              //    0: The database is registered and the database name is
    //              //       valid
    //              //   -1: The database is registered and the database name is
    //              //       not valid
    //                )

    public static function get_DB_status( $DB_name )
    {
        if( array_key_exists( $DB_name, $GLOBALS[ 'app_DBs' ] ) )
        {
            if ( array_key_exists( $DB_name, $this->app_priv_DBs_data[ 'DBs_stats' ] ) )
            {
                $DB_stats = $this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name ];

                return array ( 'status'   => 0 ,
                               'DB_stats' => $DB_stats
                             );
            }
            else
            {
                return array ( 'status'   => -2 ,
                               'DB_stats' => NULL
                              );
            }
        }
        else
        {
            return array ( 'status'   => -1 ,
                           'DB_stats' => NULL
                         );
        }
    }


    // Method:  DB_open( $DB_name, $conn_type )
    // 
    // This method is used to open the selected database, whose name is passed
    // as parameter.
    //
    // This method returns an array with the following structure:
    // 
    //          array ( 'DB_stats' => array( 'open'       => TRUE | FALSE ,
    //                                       'fetch_mode' => 'ADODB_FETCH_ASSOC' | 'ADODB_FETCH_NUM' ,
    //                                       'error_nr'   => <error_nr> ,
    //                                       'error_msg'  => <error_message>
    //                                     ) | NULL ,
    //                  'status'   => 0 | -1 | -2
    //              //    0: The database is registered, the database name is
    //              //       valid and it is open.
    //              //   -1: The database is registered and the database name is
    //              //       not valid
    //                )

    public static function DB_open( $DB_name, $conn_type = NULL )
    {
        if( array_key_exists( $DB_name, $GLOBALS[ 'app_DBs' ] ) )
        {
            if ( array_key_exists( $DB_name, $this->app_priv_DBs_data[ 'DBs_data' ] ) )
            {
                // Get the selected database access parameter array
                $DB_data = $this->app_priv_DBs_data[ 'DBs_data' ][ $DB_name ] ;
//
//         $conn = & ADONewConnection( 'mysql' ) ; 
//
                // Call 'ADONewConnection( 'driver' ) to get the ADODB database
                // connection object and store it on to:
                //  $this->app_priv_DBs_data[ 'DBs_conn_obj' ][ $DB_name ]
                $this->app_priv_DBs_data[ 'DBs_conn_obj' ][ $DB_name ] =
                        & ADONewConnection( $DB_data[ 'driver' ] ) ;
//
//         $conn->PConnect( 'localhost', 'userid', 'password', 'database' ) ;
//            
                // Get the select database access parameter array onto the private
                // property:    $this->app_priv_DB_data
                $this->app_priv_DB_data = $this->get_DB_params( $DB_name ) ;
            
                // See if the connection is presistent or not and call
                //      PConnect( 'host', 'user', 'password', 'database' )
                // or
                //      Connect( 'host', 'user', 'password', 'database' )
                // as appropriated
                if ( $conn_type === NULL )
                {
                    $conn_type = $this->app_priv_DBs_data[ 'DBs_data' ][ $DB_name ][ 'pconnect' ] ;
                }
                if ( $conn_type === TRUE )
                {
                    $this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name ][ 'open' ] =
                        $this->app_priv_DBs_data[ 'DBs_conn_obj' ][ $DB_name ]->
                                                  PConnect( $this->app_priv_DB_data['host'] ,
                                                            $this->app_priv_DB_data['user'] ,
                                                            $this->app_priv_DB_data['password'] ,
                                                            $this->app_priv_DB_data['database']
                                                          ) ;
                }
                else
                {
                    $this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name ][ 'open' ] =
                        $this->app_priv_DBs_data[ 'DBs_conn_obj' ][ $DB_name ]->
                                                  Connect( $this->app_priv_DB_data['host'] ,
                                                           $this->app_priv_DB_data['user'] ,
                                                           $this->app_priv_DB_data['password'] ,
                                                           $this->app_priv_DB_data['database']
                                                         ) ;
                }

                // Get the #this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name] data
                // array and return
                $DB_stats = $this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name ];

                return array ( 'status'   => 0 ,
                               'DB_stats' => $DB_stats
                             );
            }
            else
            {
                return array ( 'status'   => -2 ,
                               'DB_stats' => NULL
                              );
            }
        }
        else
        {
            return array ( 'status'   => -1 ,
                           'DB_stats' => NULL
                         );
        }
    }

    
    // Method:  DB_close( $DB_name )
    // 
    // This method is used to close the selected database, whose name is passed
    // as parameter.
    //
    // This method returns an array with the following structure:
    // 
    //          array ( 'DB_stats' => array( 'open'       => FALSE ,
    //                                       'fetch_mode' => 'ADODB_FETCH_ASSOC' | 'ADODB_FETCH_NUM' ,
    //                                       'error_nr'   => <error_nr> ,
    //                                       'error_msg'  => <error_message>
    //                                     ) | NULL ,
    //                  'status'   => 0 | -1 | -2
    //              //    0: The database is registered, the database name is
    //              //       valid and the database is closed
    //              //   -1: The database is registered and the database name is
    //              //       not valid
    //                )

    public static function DB_close( $DB_name )
    {
        if( array_key_exists( $DB_name, $GLOBALS[ 'app_DBs' ] ) )
        {
            if ( array_key_exists( $DB_name, $this->app_priv_DBs_data[ 'DBs_stats' ] ) )
            {
                // Get the selected database access parameter array
                $DB_data = $this->app_priv_DBs_data[ 'DBs_data' ][ $DB_name ] ;
//
//         $conn->Close( ) ;
//                            {
                // Set  $this->app_priv_DBs_data[ 'DBs_stats][ $DB_name ][ 'open' ]
                // to FALSE to indicate that the connection to the selected database
                // is not open
                $this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name ][ 'open' ] = FALSE ;

                // Call the ADODB->Close() method to close the connection to the
                // selected database
                $this->app_priv_DBs_data[ 'DBs_conn_obj' ][ $DB_name ]->
                                                  Close( ) ;

                // Get the #this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name] data
                // array and return
                $DB_stats = $this->app_priv_DBs_data[ 'DBs_stats' ][ $DB_name ];

                return array ( 'status'   => 0 ,
                               'DB_stats' => $DB_stats
                             );
            }
            else
            {
                return array ( 'status'   => -2 ,
                               'DB_stats' => NULL
                              );
            }
        }
        else
        {
            return array ( 'status'   => -1 ,
                           'DB_stats' => NULL
                         );
        }
    }

    
}