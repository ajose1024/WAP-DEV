<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends WAP_Controller {

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
            $this->load->view('main') ;
	}

        
        public function action($command = "NOOP", $act_ctx_id = "", $data = "")
        {
            echo "COMMAND: " . $command . "<br/>";
            echo "CONTEXT: " . $act_ctx_id . "<br/>";
            echo "DATA: " . $data . "<br/>";
            echo "<br/>";
            
            echo  WAP_data_context::generate_id() ;
            echo "<br><br>" ;
            print( time() ) ;
            echo "<br><br>" ;
            echo WAP_data_context::get_context_ID( 2 ) ;
            echo "<br><br>" ;

            echo '<h1>$this->wap_data_interface->get_data_elements()</h1>' ;
            var_dump($data_elements = $this->wap_data_interface->get_data_elements() ) ;
            echo "<br/><br/>";

            echo '<h1>$this->wap_data_interface->get_base_data()</h1>' ;
            var_dump($data_elements = $this->wap_data_interface->get_base_data() ) ;
            echo "<br/><br/>";

            echo '<h1>$this->wap_data_interface->get_extra_data()</h1>' ;
            var_dump($data_elements = $this->wap_data_interface->get_extra_data() ) ;
            echo "<br/><br/>";

            echo '<h1>$this->wap_data_interface->get_query_string()</h1>' ;
            var_dump($data_elements = $this->wap_data_interface->get_query_string() ) ;
            echo "<br/><br/>";

            echo '<h1>$this->wap_data_interface->get_query_string_element_count()</h1>' ;
            var_dump( $data_elements = $this->wap_data_interface->get_query_string_element_count() ) ;
            echo "<br/><br/>";

            echo '<h1>$this->wap_data_interface->get_query_string_element_name( "2" )</h1>' ;
            var_dump( $data_elements = $this->wap_data_interface->get_query_string_element_name( '2' ) ) ;
            echo "<br/><br/>";

            echo '<h1>$this->wap_data_interface->get_query_string_element_data( "2" )</h1>' ;
            var_dump( $data_elements = $this->wap_data_interface->get_query_string_element_data( '2' ) ) ;
            echo "<br/><br/>";

            echo '<h1>$this->wap_data_interface->get_query_string_element_by_name( "wap" )</h1>' ;
            var_dump( $data_elements = $this->wap_data_interface->get_query_string_element_by_name( 'wap' ) ) ;
            echo "<br/><br/>";

            
            print( $this->data_context->get_act_ctx_id());
            echo "<br/><br/>";
            print( $this->data_context->get_act_ctx_id(TRUE));
            echo "<br/><br/>";
            print( $this->data_context->get_act_ctx_id(FALSE));
            echo "<br/><br/>";

            phpinfo();
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
                case 'scripts':
                    $this->load->view( 'wap/resources/app-start.php', $parameters ) ;
                    
                    break ;
                    
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