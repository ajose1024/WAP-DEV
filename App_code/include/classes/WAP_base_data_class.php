<?php  if ( !defined( 'WAP_EXEC' ) ) exit( 'No direct script access allowed' ) ;

/**
 * Description of WAP_base_data
 *
 * @author System Adminstrator
 */

interface WAP_data__Interface {

    public static function get_version() ;

}


class WAP_data implements WAP_data__Interface
{
    /**
     * Construct won't be called inside this class and is uncallable from
     * the outside.
     * This prevents instantiating this class.
     * This is by purpose, because we want a static class.
     */
    private function __construct()
    {
        
    }

    
    // Class private properties

    private static $initialized = FALSE ;
    
    private static $version = '0.010' ;


    // -----------------------
    // Class public properties
    // -----------------------

    // Property:  G_DATA
    //
    // This property is a public property having an associative array where data
    // can be freelly read, stored and modified as needed.
    
    public static $G_DATA ;
    
    
    // Property:  sys_DBs_obj
    //
    // This property is a public property to hold the object that controls the
    // initialization and access to the declared databases
    
    public static $sys_DBs_obj ;
    
    
    // Class private initialize fuction

    private static function initialize()
    {
        if ( self::$initialized )
        {
            return ;
        }

        self::$initialized = TRUE ;
    }

    
    // Method:  get_version()
    //
    // This method returns the  self::$version  property

    public static function get_version()
    {
        self::initialize() ;
        return self::$version ;
    }

    
    

}


$GLOBALS[ 'WAP_data_version' ] = WAP_data::get_version() ;
