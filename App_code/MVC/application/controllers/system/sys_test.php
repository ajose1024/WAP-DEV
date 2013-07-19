<?php  if ( ! defined( 'BASEPATH' )) exit( 'No direct script access allowed' ) ;

class Sys_test extends WAP_Controller {

    
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
	 * 		http://<server>/system/sys_test
	 *	- or -  
	 * 		http://<server>/system/sys_test/index
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /system/sys_debug/<method_name>
	 */
	public function index( )
	{
            $this->load->view( 'system/test/sys_test_main' ) ;
	}

        
        /**
	 * databases  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_test/databases/<db_name>/function
         */
        public function databases( $DB_name )
        {
            switch( $DB_name )
            {
                // If the selected 
                case 'app_DB':
                    $this->load->view( 'system/test/databases/app_DB/app_DB_view.php' ) ;
                    break ;
                
                default:
                    $this->load->view( 'system/test/databases/app_DB/default_view.php' ) ;
                    break ;
                    
            }
        }

        
        /**
	 * sys_DBs_obj  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_test/sys_DBs_obj/<function>/<params>
         */
        public function app_databases_init( $function = '', $params = '' )
        {
            switch( $function )
            {
                // If the selected 
                case 'DBs_init':
                    $this->load->view( 'system/test/databases/app_databases_init_view.php' ) ;
                    break ;

                case 'get_DB_params':
                    $this->load->view( 'system/test/databases/app_databases_init_view.php' ) ;
                    break ;

                case 'get_DB_conn_obj':
                    $this->load->view( 'system/test/databases/app_databases_init_view.php' ) ;
                    break ;

                case 'get_DB_status':
                    $this->load->view( 'system/test/databases/app_databases_init_view.php' ) ;
                    break ;

                case 'DB_open':
                    $this->load->view( 'system/test/databases/app_databases_init_view.php' ) ;
                    break ;

                case 'DB_close':
                    $this->load->view( 'system/test/databases/app_databases_init_view.php' ) ;
                    break ;

                default:
                    $this->load->view( 'system/test/databases/app_DB/default_view.php' ) ;
                    break ;
                    
            }
        }

                
        /**
	 * sys_DBs_obj  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_test/sys_DBs_obj/<function>/<params>
         */
        public function wap_db_interface( $function = '', $params = '' )
        {
            switch( $function )
            {
                // If the selected 
                case 'DBs_init':
                    $this->load->view( 'system/test/databases/wap_db_interface_view.php' ) ;
                    break ;

                case 'get_DB_params':
                    $this->load->view( 'system/test/databases/wap_db_interface_view.php' ) ;
                    break ;

                case 'get_DB_conn_obj':
                    $this->load->view( 'system/test/databases/wap_db_interface_view.php' ) ;
                    break ;

                case 'get_DB_status':
                    $this->load->view( 'system/test/databases/wap_db_interface_view.php' ) ;
                    break ;

                case 'DB_open':
                    $this->load->view( 'system/test/databases/wap_db_interface_view.php' ) ;
                    break ;

                case 'DB_close':
                    $this->load->view( 'system/test/databases/wap_db_interface_view.php' ) ;
                    break ;

                default:
                    $this->load->view( 'system/test/databases/app_DB/default_view.php' ) ;
                    break ;
                    
            }
        }

                
        /**
	 * super_globals  page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://<server>/system/sys_debug/super_globals
         */        
        public function super_globals( )
        {
            $this->load->view( 'system/super_globals' ) ;
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