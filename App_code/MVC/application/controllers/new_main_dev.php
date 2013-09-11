<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class New_main_dev extends WAP_Controller {

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
            $this->load->view('new_main_dev') ;
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
                
                case 'social_logos':
                    $this->load->view( 'wap/resources/social_logos' , $parameters ) ;
                    
                    break ;
                    
                case 'lang_flags':
                    $this->load->view( 'wap/resources/lang_flags' , $parameters ) ;
                    
                    break ;
                
                case 'banners':
                    $this->load->view( 'wap/resources/banners' , $parameters ) ;
                    
                    break ;
            }
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */