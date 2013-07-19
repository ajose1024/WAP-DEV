<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;
/* 
 * Epsilon Software -- (c) 2012
 * ----------------------------
 * 
 * Global database configuration file
 *
 */



    // Definition and initialization of the GLOBAL variable with the number of
    // registered databases existing in the system
	
    $GLOBALS[ 'app_DBs_nr' ] = 2 ;
	
	
    // Definition and initialization of the GLOBAL array with the name of the
    // configuration data file for each of the registered databases ion the
    // system
	
    $GLOBALS[ 'app_DBs' ] = array (   'app_DB'      =>  $GLOBALS[ 'DOC_ROOT' ] .
                                      '/App_code/config/databases/app_DB_inc.php' ,
                                      'app_r_DB'    =>  $GLOBALS[ 'DOC_ROOT' ] .
                                      '/App_code/config/databases/app_r_DB_inc.php'
                                  ) ;

    // Creation of the GLOBAL 'sys_DBs_obj' object as instance of the
    // 'app_databases_init' class
    $GLOBALS[ 'sys_DBs_obj' ] = new app_databases_init ;

    // Initialization of all registered databases
    $GLOBALS[ 'sys_DBs_obj' ]->init_DBs() ;

