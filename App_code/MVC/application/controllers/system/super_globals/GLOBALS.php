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
            $this->load->view( 'sys_debug_main' ) ;
	}

        /**
	 * php_data  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_debug/php_data
         */
        public function php_data( )
        {
            $this->load->view( 'system/php_data' ) ;
        }

        
        public function session_data( )
        {
            $GLOBALS['WAP_SID'] = session_handling::get_session_id() ;
            $this->load->view('session_data') ;
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */