<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * WAP - WEB Application Platform
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		WAP
 * @author		Epsilon Software
 * @copyright           Copyright (c) 2010 - 2013, Epsilon Software 
 * @license		http://wap.develop.datanet-pt.net/App_core/MVC/user_guide/license.html
 * @link		http://wap.develop.datanet-pt.net
 * @since		Version 0.01
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * WAP Application Controller Class
 *
 * This class object is the super class that every controler in WAP is
 * to extend from, if it is to have the WAP_data_interface
 *
 * @package		WAP
 * @subpackage          Libraries
 * @category            Libraries
 * @author		AJG @ Epsilon Software
 * @link		http://wap.develop.datanet-pt.net/App_code/MVC/user_guide/general/controllers.html
 */
class Wap_Controller extends CI_Controller
{
        private $WAP_DI = "" ;
        
        private $controller_level ;


	/**
	 * Constructor
	 */
	public function __construct()
	{
            // Call CI_Controller contructor
            parent::__construct() ;

            // Create the $params array
            $params = array( 'controller_level' => $this->controller_level ) ;

            // Load the 'WAP_data_interface' library, passing the $controller_level
            // to the 'WAP_data_interface' library
            $this->load->library( 'WAP_data_interface', $params ) ;
            
            // Load the 'data_context' model
            $this->load->model( 'data_context' ) ;
            
            // Write to the log
	    log_message( 'debug', "WAP Controller Class Initialized" ) ;

        }


        // Method:  set_controller_level( $controler_level )
        //
        // This method sets the Controller Level, in order to adjust the
        // PATH_INFO data as needed
        
        public function set_controller_level( $level )
        {
            $this->controller_level = $level ;
        }


        // Method:  action()
        //
        // This method is the controler's method for action call from the
        // browser and has the following general form:
        //
        //  http://wap.dev.escrita-virtual.pt/main/action/
        //          /<command>/<act_ctx_id>/<data>
        //
        //      DEFAULT:    COMMAND:    NOOP
        //                  CONTEXT:    ''
        //                  DATA:       ''
        
        public function action( $command = "NOOP", $act_ctx_id = "", $data = "" )
        {
            echo "COMMAND: " . $command . "<br/>" ;
            echo "CONTEXT: " . $act_ctx_id . "<br/>" ;
            echo "DATA: " . $data . "<br/>" ;
            echo "<br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_data_elements() ) ;
            echo "<br/><br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_query_string() ) ;
            echo "<br/><br/>" ;
            
            print( $this->data_context->get_act_ctx_id( ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_act_ctx_id( TRUE ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_act_ctx_id( FALSE ) ) ;
            echo "<br/><br/>" ;

            phpinfo() ;
        }
        
        
        // Method:  input()
        //
        // This method is the controler's method for input data from the
        // browser and has the following general form:
        //
        //  http://wap.dev.escrita-virtual.pt/main/input/
        //          /<element>/<in_ctx_id>/<data>
        //      
        //      DEFAULT:    ELEMENT:    NULL
        //                  CONTEXT:    ''
        //                  DATA:       ''
        
        public function input( $element = "NULL", $in_ctx_id = "", $data = "" )
        {
            echo "ELEMENT: " . $element . "<br/>" ;
            echo "CONTEXT: " . $in_ctx_id . "<br/>" ;
            echo "DATA: " . $data . "<br/>" ;
            echo "<br/>" ;
            
            print_r($data_elements = $this->wap_data_interface->get_data_elements() ) ;
            echo "<br/><br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_query_string() ) ;
            echo "<br/><br/>" ;

            print( $this->data_context->get_in_ctx_id( ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_in_ctx_id( TRUE ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_in_ctx_id( FALSE ) ) ;
            echo "<br/><br/>" ;

            phpinfo() ;
        }
        
        
        // Method:  mqueue()
        //
        // This method is the controler's method for access from the browser
        // to the message queue and has the following general form:
        //
        //  http://homepages.datanet-pt.net/~anemona-do-mar/main/mqueue/
        //          /<message>/<mq_ctx_id>/<data>
        //      
        //      DEFAULT:    MESSAGE:    IDLE
        //                  CONTEXT:    ''
        //                  DATA:       ''
        //
        // Whenever the browser is to receive the oldest message on the
        // message queue, it access the URI through a GET method.
        // The message data is in the response body section
        //
        // Whenever the browser is to post a message on the message queue, it
        // access the URI through a POST method.
        // The message data is in the request body section.
        
        public function mqueue( $message = "IDLE", $mq_ctx_id = "", $data = "" )
        {
            echo "MESSAGE: " . $message . "<br/>" ;
            echo "CONTEXT: " . $mq_ctx_id . "<br/>" ;
            echo "DATA: " . $data . "<br/>" ;
            echo "<br/>" ;
            
            print_r($data_elements = $this->wap_data_interface->get_data_elements() ) ;
            echo "<br/><br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_query_string() ) ;
            echo "<br/><br/>" ;

            print( $this->data_context->get_mq_ctx_id( ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_mq_ctx_id( TRUE ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_mq_ctx_id( FALSE ) ) ;
            echo "<br/><br/>" ;

            phpinfo() ;
        }
        
        
        // Method:  sadr()
        //
        // This method is the controler's method for SARD data send and receive
        // from the browser and has the following general form:
        //
        //  http://homepages.datanet-pt.net/~anemona-do-mar/main/sadr/
        //          /<data_set>/<sadr_ctx_id>/<data>
        //      
        //      DEFAULT:    DATA_SET:   NULL
        //                  CONTEXT:    ''
        //                  DATA:       ''
        //
        // Whenever the browser is to receive the data from the server, it
        // access the URI through a GET method.
        // The data is in the response body section.
        //
        // Whenever the browser is to send data to the server, it access the
        // URI through a POST method.
        // The message data is in the request body section.

        public function sadr( $data_set = "NULL", $sadr_ctx_id = "", $data = "" )
        {
            echo "DATA_SET: " . $data_set . "<br/>" ;
            echo "CONTEXT: " . $sadr_ctx_id . "<br/>" ;
            echo "DATA: " . $data . "<br/>" ;
            echo "<br/>" ;
            
            print_r($data_elements = $this->wap_data_interface->get_data_elements() ) ;
            echo "<br/><br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_query_string() ) ;
            echo "<br/><br/>" ;

            print( $this->data_context->get_sadr_ctx_id( ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_sadr_ctx_id( TRUE ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_sadr_ctx_id( FALSE ) ) ;
            echo "<br/><br/>" ;

            phpinfo() ;
        }
        

        // Method:  storage()
        //
        // This method is the controler's method for presistent storage from the
        // browser and has the following general form:
        //
        //  http://wap.dev.escrita-virtual.pt/main/storage/
        //          /<command>/<mem_ctx_id>/<data>
        //
        //      DEFAULT:    COMMAND:    FETCH
        //                  CONTEXT:    ''
        //                  DATA:       ''
        
        public function storage( $command = "FETCH", $mem_ctx_id = "", $data = "" )
        {
            echo "COMMAND: " . $command . "<br/>" ;
            echo "CONTEXT: " . $mem_ctx_id . "<br/>" ;
            echo "DATA: " . $data . "<br/>" ;
            echo "<br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_data_elements() ) ;
            echo "<br/><br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_query_string() ) ;
            echo "<br/><br/>" ;

            print( $this->data_context->get_mem_ctx_id( ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_mem_ctx_id( TRUE ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_mem_ctx_id( FALSE ) ) ;
            echo "<br/><br/>" ;

            phpinfo() ;
        }
        
        
        // Method:  resources()
        //
        // This method is the controler's method for web resources, such as,
        // CSS, Images, Scripts, etc...
        //
        //  http://wap.dev.escrita-virtual/main/resources/
        //          /<type>/<res_ctx_id>/<res_name>
        //
        //      DEFAULT:    TYPE:       images
        //                  CONTEXT:    ''
        //                  NAME:       ''
        
        public function resources( $type = "images", $res_ctx_id = "", $res_name = "" )
        {
            echo "TYPE: " . $type . "<br/>" ;
            echo "CONTEXT: " . $res_ctx_id . "<br/>" ;
            echo "NAME: " . $res_name . "<br/>" ;
            echo "<br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_data_elements() ) ;
            echo "<br/><br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_query_string() ) ;
            echo "<br/><br/>" ;

            print( $this->data_context->get_res_ctx_id( ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_res_ctx_id( TRUE ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_res_ctx_id( FALSE ) ) ;
            echo "<br/><br/>" ;

            phpinfo() ;
        }
        
        
        // Method:  forms()
        //
        // This method is the controler's method for web FORMS
        //
        //  http://homepages.datanet-pt.net/~anemona-do-mar/main/forms/
        //          /<form-name>/<form_ctx_id>/<form_data>
        //
        //      DEFAULT:    FORM:       default
        //                  CONTEXT:    ''
        //                  DATA:       ''
        
        public function forms( $type = "default", $res_ctx_id = "", $res_name = "" )
        {
            echo "FORM: " . $type . "<br/>" ;
            echo "CONTEXT: " . $res_ctx_id . "<br/>" ;
            echo "DATA: " . $res_name . "<br/>" ;
            echo "<br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_data_elements() ) ;
            echo "<br/><br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_query_string() ) ;
            echo "<br/><br/>" ;

            print( $this->data_context->get_form_ctx_id( ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_form_ctx_id( TRUE ) ) ;
            echo "<br/><br/>" ;
            print( $this->data_context->get_form_ctx_id( FALSE ) ) ;
            echo "<br/><br/>" ;

            phpinfo() ;
        }
        
        

        
        
        
        public function teste( $command = "NOOP", $act_ctx_id = "", $data = "" )
        {
            echo "COMMAND: " . $command . "<br/>" ;
            echo "CONTEXT: " . $act_ctx_id . "<br/>" ;
            echo "DATA: " . $data . "<br/>" ;
            echo "<hr/>" ;
            echo 'wap_data_interface::controler = ' . $this->wap_data_interface->get_controler_name() . "<br/>" ;
            echo 'wap_data_interface::function  = ' . $this->wap_data_interface->get_controler_function_name()  . "<br/>" ;
            echo 'wap_data_interface::command   = ' . $this->wap_data_interface->get_command_name() . "<br/>" ;
            echo 'wap_data_interface::context   = ' . $this->wap_data_interface->get_context_token() . "<br/>" ;
            echo 'wap_data_interface::data      = ' . $this->wap_data_interface->get_data() . "<br/>" ;
            echo "<hr/>" ;
            echo 'wap_data_interface::base_data  = ' ;
            print_r( $this->wap_data_interface->get_base_data() ) ;
            echo "<br/>" ;
            echo "<hr/>" ;
            echo 'wap_data_interface::extra_data = ' ;
            print_r( $this->wap_data_interface->get_extra_data() ) ;
            echo "<br/>" ;
            echo "<hr/>" ;
            echo 'wap_data_interface::query_string = ' ;
            print( $this->wap_data_interface->get_query_string() ) ;
            echo "<br/>" ;
            echo "<hr/>" ;
            echo 'wap_data_interface::query_string_element_count = ' ;
            print( $this->wap_data_interface->get_query_string_element_count() ) ;
            echo "<br/>" ;
            echo "<hr/>" ;
            for( $i = 0 ; $i <= $this->wap_data_interface->get_query_string_element_count() - 1 ; $i++ )
            {
                echo 'wap_data_interface::query_string = ' ;
                print( $this->wap_data_interface->get_query_string_element_name( $i ) ) ;
                echo "<br/>" ;
                echo 'wap_data_interface::query_string = ' ;
                print( $this->wap_data_interface->get_query_string_element_data( $i ) ) ;
                echo "<br/><br/>" ;
                echo 'wap_data_interface::query_string_data_table[' .
                     $this->wap_data_interface->get_query_string_element_name( $i ) . '] = ' ;
                print( $this->wap_data_interface->get_query_string_element_by_name( 
                                    $this->wap_data_interface->get_query_string_element_name( $i )
                                                                                  )
                     ) ;
                echo '<br/><hr/>' ;
            }
            echo "<br/><br/>" ;

            $this->load->model('data_context') ;

            print( $this->data_context->generate_id() ) ;
            
            echo "<br/><br/>" ;
            

            print_r($data_elements = $this->wap_data_interface->get_data_elements() ) ;
            echo "<br/><br/>" ;

            print_r($data_elements = $this->wap_data_interface->get_query_string() ) ;
            echo "<br/><br/>" ;

            phpinfo() ;
        }
                
        
}
// END WAP Controller class

/* End of file WAP_Controller.php */
/* Location: ./application/core/WAP_Controller.php */