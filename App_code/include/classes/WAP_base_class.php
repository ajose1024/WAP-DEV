<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;

class WAP
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

    private static $default_function_handler = 'noop' ;
    
    private static $action_handler    = array( 'GET_method'     => 'noop',
                                               'POST_method'    => 'noop',
                                               'PUT_method'     => 'noop',
                                               'DELETE_method'  => 'noop',
                                               'HEAD_method'    => 'noop',
                                               'OPTIONS_method' => 'noop'
                                             ) ;
    private static $input_handler     = array( 'GET_method'     => 'noop',
                                               'POST_method'    => 'noop',
                                               'PUT_method'     => 'noop',
                                               'DELETE_method'  => 'noop',
                                               'HEAD_method'    => 'noop',
                                               'OPTIONS_method' => 'noop'
                                             ) ;
    private static $mqueue_handler    = array( 'GET_method'     => 'noop',
                                               'POST_method'    => 'noop',
                                               'PUT_method'     => 'noop',
                                               'DELETE_method'  => 'noop',
                                               'HEAD_method'    => 'noop',
                                               'OPTIONS_method' => 'noop'
                                             ) ;
    private static $sadr_handler      = array( 'GET_method'     => 'noop',
                                               'POST_method'    => 'noop',
                                               'PUT_method'     => 'noop',
                                               'DELETE_method'  => 'noop',
                                               'HEAD_method'    => 'noop',
                                               'OPTIONS_method' => 'noop'
                                             ) ;
    private static $storage_handler   = array( 'GET_method'     => 'noop',
                                               'POST_method'    => 'noop',
                                               'PUT_method'     => 'noop',
                                               'DELETE_method'  => 'noop',
                                               'HEAD_method'    => 'noop',
                                               'OPTIONS_method' => 'noop'
                                             ) ;
    private static $resources_handler = array( 'GET_method'     => 'noop',
                                               'POST_method'    => 'noop',
                                               'PUT_method'     => 'noop',
                                               'DELETE_method'  => 'noop',
                                               'HEAD_method'    => 'noop',
                                               'OPTIONS_method' => 'noop'
                                             ) ;
    private static $forms_handler     = array( 'GET_method'     => 'noop',
                                               'POST_method'    => 'noop',
                                               'PUT_method'     => 'noop',
                                               'DELETE_method'  => 'noop',
                                               'HEAD_method'    => 'noop',
                                               'OPTIONS_method' => 'noop'
                                             ) ;
    
    
    // Class public properties
    
    
    
    // Class private initialize fuction
    
    private static function initialize()
    {
        if( self::$initialized )
        {
            return ;
        }

        self::$initialized = TRUE ;
    }

    
    public static function get_version()
    {
        self::initialize() ;
        return  self::$version ;
    }
    
    
    public static function noop()
    {
        
    }
    
    
    public static function default_function()
    {
        
    }
}

$GLOBALS[ 'WAP_version' ] = WAP::get_version() ;

