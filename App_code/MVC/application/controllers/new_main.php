<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;

class New_main extends Wap_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

//            var_dump( $this->WAP_data_interface->get_base_data() ) ;
            
            $this->load->view('new_main') ;

	}
        
        
        public function resources( $type = "images", $res_ctx_id = "", $res_name = "" )
        {
            $parameters = array( 'parameters' => array( 'type'     => $type ,
                                                        'context'  => $res_ctx_id ,
                                                        'res_name' => $res_name 
                                                      )
                               ) ;
                    
            switch ( $type )
            {
                case 'images':
                    $this->load->view( 'wap/resources/images.php', $parameters ) ;

                    break ;
                
                case 'background':
                    $this->load->view( 'wap/resources/background.php' , $parameters ) ;
                    
                    break ;
                    
                case 'logos':
                    $this->load->view( 'wap/resources/logos.php' , $parameters ) ;
                    
                    break ;
            }
        }
        
        
        
        public function dump_LINK()
        {
            $this->load->view( 'new_main_dump_link' ) ;
        }
        
        public function dump_META()
        {
            $this->load->view( 'new_main_dump_meta' ) ;
        }
        
        public function dump_STYLE()
        {
            $this->load->view( 'new_main_dump_style' ) ;
        }
        
        public function dump_SCRIPT()
        {
            $this->load->view( 'new_main_dump_script' ) ;
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */