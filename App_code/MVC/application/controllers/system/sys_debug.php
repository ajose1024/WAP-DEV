<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sys_debug extends WAP_Controller {

    
        public function __construct()
        {
            // Define the controller directory level
            // Corresponds to a level 2 directory
            parent::set_controller_level( 2 ) ;

            // Call the WAP_Controller contructor
            parent::__construct();

        }

    
	/**
	 * index  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_debug
	 *	- or -  
	 * 		http://<server>/system/sys_debub/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /system/sys_debug/<method_name>
	 */
	public function index( )
	{
            $this->load->view( 'system/sys_debug/sys_debug_main' ) ;
	}

        
        /**
	 * php_data  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_debug/php_data
         */
        public function php_data( )
        {
            $this->load->view( 'system/sys_debug/php_data' ) ;
        }

        
        /**
	 * super_globals  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_debug/super_globals
         */        
        public function super_globals( )
        {
            log_message( 'debug', "Super GLOBALS View Initialized" ) ;

            $this->load->view( 'system/sys_debug/super_globals' ) ;
            
            log_message( 'debug', "Super GLOBALS View Finalized" ) ;
        }

        
        /**
	 * wap_sessions  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_debug/wap_sessions
         */        
        public function wap_sessions( )
        {
            $this->load->view( 'system/wap_sessions' ) ;
        }


        /**
	 * wap_data_interface  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_debug/wap_data_interface
         */        
        public function wap_data_interface( )
        {
            $this->load->view( 'system/wap_data_interface' ) ;
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */