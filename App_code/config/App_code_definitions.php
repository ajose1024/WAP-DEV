<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;

include( $GLOBALS[ 'DOC_ROOT' ] . '/App_code/include/classes/WAP_base_class.php' ) ;
include( $GLOBALS[ 'DOC_ROOT' ] . '/App_code/include/classes/WAP_base_data_class.php' ) ;
include( $GLOBALS[ 'DOC_ROOT' ] . '/App_code/include/classes/WAP_base_data_context_class.php') ;

define( "WAP_USE_ADODB" , TRUE ) ;

define( "WAP_USE_ADODB_SESSIONS" , TRUE ) ;
define( "WAP_ENCRYPTED_SESSIONS" , FALSE ) ;
define( "WAP_ADODB_SESSIONS_AUTOSTART" , FALSE ) ;

define( "WAP_STATIC_SESSIONS" , TRUE ) ;

define( "WAP_SIMPLE_TEMPLATES" , FALSE ) ;
define( "WAP_SMARTY_TEMPLATES" , TRUE ) ;

define( "WAP_JSON_SUPPORT", TRUE ) ;

define( "WAP_SYSTEM_FUNCTIONS" , TRUE ) ;

define( "WAP_GET_HTTP_DATA" , TRUE ) ;

define( "WAP_REGISTRY" , FALSE ) ;

define( "WAP_DATABASES" , TRUE ) ;


define( "TEMPLATE_BASE_DIR"  , '/templates/Smarty/templates' ) ;
define( "TEMPLATE_COMP_DIR"  , '/templates/Smarty/compile' ) ;
define( "TEMPLATE_CACHE_DIR" , '/templates/Smarty/cache' ) ;

define( "RESOURCES_DATA_DIR" , '/App_data/resources' ) ;
define( "RESOURCES_DATA_IMAGES_DIR" , '/App_data/resources/images' ) ;
define( "RESOURCES_DATA_SCRIPT" , '/App_data/resources/script' ) ;
define( "RESOURCES_DATA_CSS" , '/App_data/resources/css' ) ;

