<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class wap_data_init
{
    public function get_CI_objects()
    {
        // Store CodeIgniter Benchmark Object
        WAP::$CI_Benchmark = $GLOBALS[ 'BM' ] ;

        // Store CodeIgniter Hooks Object
        WAP::$CI_Hooks = $GLOBALS[ 'EXT' ] ;

        // Store CodeIgniter Config Object
        WAP::$CI_Config = $GLOBALS[ 'CFG' ] ;

        // Store CodeIgniter Utf_8 Object
        WAP::$CI_Utf_8 = $GLOBALS[ 'UNI' ] ;

        // Store CodeIgniter URI Object
        WAP::$CI_URI = $GLOBALS[ 'URI' ] ;

        // Store CodeIgniter Router Object
        WAP::$CI_Router = $GLOBALS[ 'RTR' ] ;

        // Store CodeIgniter Output Object
        WAP::$CI_Output = $GLOBALS[ 'OUT' ] ;

        // Store CodeIgniter Security Object
        WAP::$CI_Security = $GLOBALS[ 'SEC' ] ;

        // Store CodeIgniter Input Object
        WAP::$CI_Input = $GLOBALS[ 'IN' ] ;
        
    }
    
    public function get_CI_instance()
    {
        // CodeIgniter MAIN Object
        WAP::$CI = get_instance() ;
        
        // CodeIgniter CI_Session Object
        WAP::$CI_session = WAP::$CI->session ;
        
        // CodeIgniter WAP_Presentation_session Object
        WAP::$CI_presentation_session = WAP::$CI->presentation_session ;
        
    }
}