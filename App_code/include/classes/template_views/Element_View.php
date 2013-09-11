<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// This class is the base class for the HTML element renderization


interface Element_View_Interface
{
    public function __construct( $element_name , $data = array() ) ;

    public function render() ;
    
    public function get_rendered_HTML() ;
    
    public function display_HTML() ;

    
    public function add_template_var( $data_name , $data_value ) ;
    
    public function set_t_var( $t_var_name , $t_var_data ) ;

    public function set_r_var( $r_var_name , $r_var_data ) ;

}

class Element_View implements Element_View_Interface
{
    // Private property to hold the template name
    private $element_name = null ;
    
    // Private property to hold the template base path
    private $element_view_element_base_path = null ;
    
    // Private property to hold the passed template name
    private $element_view_template = null ;
    
    // Private property to hold the passed data structure
    private $element_view_data = array() ;
    
    // Private property to hold the rendered HTML
    private $element_view_HTML = '' ;
    
    // Protected property to hold the Smarty object
    protected $smarty_obj = null ;
    
    

    // This is the class constructor, which assigns the passed template name and
    // data structure to the respective class private properties and gets and
    // stores the Smarty object.
    //
    // It receives the $template parameter with the path/name of the Smarty
    // template and the optional $data associative array, with the following
    // format:
    //
    //  $data   =>  array(  't-vars' => array( 't-var-name-1' => 't-var-data-1' ,
    //                                         't-var-name-2' => 't-var-data-2' ,
    //                                         't-var-name-3' => 't-var-data-3' ,
    //                                          .......
    //                                         't-var-name-n' => 't-var-data-n'
    //                                       ) ,
    //                      'r-vars' => array( 'r-var-name-1' => 'r-var-data-1' ,
    //                                         'r-var-name-2' => 'r-var-data-2' ,
    //                                         'r-var-name-3' => 'r-var-data-3' ,
    //                                          .......
    //                                         'r-var-name-n' => 'r-var-data-n'
    //                                       )
    //                   )
    
    public function __construct( $element_name , $data = array() )
    {
        $this->element_name = $element_name ;
        
        $this->element_view_element_base_path = WAP::get_element_template( $element_name ) ;
        
        $this->element_view_template = $this->element_view_element_base_path . '.tpl' ;
        
        $this->smarty_obj =  $GLOBALS[ 'smarty_obj' ] ;


        // Compute the absolute path for the template directory
        $absolute_template_path = $GLOBALS[ 'DOC_ROOT' ] . TEMPLATE_BASE_DIR . '/' ;
        
        // Test if there is a local CSS file and, if there is, add it to the
        // WAP::$local_layout_css_files  associative array
        if( file_exists( $absolute_template_path . $this->element_view_element_base_path . '.css' ) )
        {
            WAP::set_element_css_file( $element_name ,
                                       TEMPLATE_BASE_DIR .
                                       $this->element_view_element_base_path .
                                       '.css'
                                     ) ;
        }

        // Test if there is a local JS dile and, if there is, add it to the 
        // WAP::local_layout_js_files  associative array
        if( file_exists( $absolute_template_path . $this->element_view_element_base_path . '.js' ) )
        {
            WAP::set_element_js_file( $element_name ,
                                      TEMPLATE_BASE_DIR .
                                      $this->element_view_element_base_path .
                                      '.js'
                                    ) ;
        }
        
        // If the $data parameter is not passed, get the Page Layout view data
        // from the  WAP::$element_view_data  associative array
        if( empty( $data ) )
        {
            // Get the Element view data from the  WAP::$element_view_data
            // property if no  $data  parameter is passed
            $data = WAP::get_element_view_data( $element_name ) ;
        }

        $this->element_view_data = $data ;

        echo "<h2>element data:</h2>" ;
        var_dump( $data ) ;
        echo "<h2>element_element_base_path</h2>" ;
        var_dump( $this->element_view_element_base_path ) ;
        echo "<h2>element_view_template</h2>" ;
        var_dump( $this->element_view_template ) ;
        echo "<h2>element_view_data</h2>" ;
        var_dump( $this->element_view_data ) ;
        echo "<h2>element_view_HTML</h2>" ;
        var_dump( $this->element_view_HTML ) ;
        echo "<br/><br/>" ;
        
        // Assign to SMARTY object the 't-vars' variables
        if( is_array( $data[ 't_vars' ] ) )
        {
            foreach( $data[ 't_vars' ] as $var_name => $var_data )
            {
                $this->smarty_obj->assign( $var_name , $var_data ) ;
            }
        }
        
//        // Assign to SMARTY object the 'r-vars' variables
//        if( is_array( $data[ 'r_vars' ] ) )
//        {
//            foreach( $data[ 'r_vars' ] as $var_name => $var_data )
//            {
//                $this->smarty_obj->assign( $var_name , $var_data ) ;
//            }
//        }
    }
    
    
    // Method:  render()
    // 
    // This method renders the element template file, getting the rendered HTML
    // code and storing it in the  $this->element_view_HTML  private property
    
    public function render()
    {
        // Before rendering the template we must assign to the Smarty object the
        // current values of the 'r_vars' (output from previously rendered elements)
        $data = WAP::get_element_view_data( $this->element_name ) ;
        
        // Assign to SMARTY object the 'r-vars' variables
        if( is_array( $data[ 'r_vars' ] ) )
        {
            foreach( $data[ 'r_vars' ] as $var_name => $var_data )
            {
                $this->smarty_obj->assign( $var_name , $var_data ) ;
            }
        }
        
        // Get the Smarty template rendered HTML
        $this->element_view_HTML = $this->smarty_obj->fetch( $this->element_view_template ) ;
    }
    
    
    // Method:  get_render_HTML()
    // 
    // This method returns the rendered HTML code
    
    public function get_rendered_HTML()
    {
        return  $this->element_view_HTML ;
    }
    
    
    // Method:  display_HTML
    // 
    // This method sends the rendered HTML code to the browser
    
    public function display_HTML()
    {
        print( $this->element_view_HTML ) ;
    }
    
    
    // Method:  add_template_var( $var_name , $var_data )
    // 
    // This method assigns a data variable to the $this->element_view_data
    // associative array and assigns it to the Smarty template
    //
    // If $data_name is equal to boolean FALSE, then $data_value is an associative
    // array with one or more data variables to add, with the following format:
    // 
    //  $data_value ->  array( 't-vars' =>  array( 't-var-name-1' => 't-var-data-1' ,
    //                                             't-var-name-2' => 't-var-name-2' ,
    //                                             't-var-name-3' => 't-var-name-3' ,
    //                                              .......
    //                                             't-var-name-n' => 't-var-data-n'
    //                                           ) ,
    //                         'r-vars' =>  array( 'r-var-name-1' => 'r-var-data-1' ,
    //                                             'r-var-name-2' => 'r-var-data-2' ,
    //                                             'r-var-name-3' => 'r-var-data-3' ,
    //                                              .......
    //                                             'r-var-name-n' => 'r-var-name-n'
    //                                           )
    //                       )
    //
    // Otherwise, $data_name has the variable name and $data_value has the variable
    // value, and is added to the 'r_vars' variable set.
    
    public function add_template_var( $data_name , $data_value )
    {
        if( $data_name === FALSE )
        {
            // In this case $data_value has the associative array of data
            // with both 't-vars' associative array and 'r-vars' associative
            // array
            if( is_array( $data_value ) )
            {
                $t_vars = $data_value[ 't_vars' ] ;
    
                if( is_array( $data_value[ 't_vars' ] ) )
                {
                    foreach( $t_vars as $data_key => $data_element )
                    {
                        $this->element_view_data[ 't_vars' ] = array_merge( $this->element_view_data[ 't_vars' ] ,
                                                                            array( $data_key => $data_element )
                                                                          ) ;
                        $this->smarty_obj->assign( $data_key, $data_element ) ;
                    }
                }
                
                $r_vars = $data_value[ 'r_vars' ] ;
                
                if( is_array( $data_value[ 'r_vars' ] ) )
                {
                    foreach( $r_vars as $data_key => $data_element )
                    {
                        $this->element_view_data[ 'r_vars' ] = array_merge( $this->element_view_data[ 'r_vars' ] ,
                                                                            array( $data_key => $data_element )
                                                                          ) ;
                        $this->smarty_obj->assign( $data_key, $data_element ) ;
                    }
                }
                
            }
        }
        else
        {
            // In this case, the variable is a 'r-vars' variable.
            // In this case, $data_name has the variable name and $data_value
            // the variable data
            $this->element_view_data[ 'r_vars' ] = array_merge( $this->element_view_data[ 'r_vars' ] ,
                                                                array( $data_name => $data_value )
                                                              ) ;
            $this->smarty_obj->assign( $data_name, $data_value ) ;
        }
    }
    
    
    // Method:  set_t_var( $t_var_name , $t_var_data )
    //
    // This public method sets one or more t-var variables.
    //
    // If the $t_var_name parameter is boolean and FALSE, the $t-var-data parameter
    // is an associative array with the following format:
    //
    //  $t_var_data ->  array( 't-var-name-1' => 't-var-data-1' ,
    //                         't-var-name-2' => 't-var-data-2' ,
    //                         't-var-name-3' => 't-var-data-3' ,
    //                          .......
    //                         't-var-name-n' => 't-var-data-n'
    //                       )
    //
    // Otherwise, $t_var_name parameter has the variable name and the $t_var_data
    // parameter has the variable data
    
    public function set_t_var( $t_var_name , $t_var_data )
    {
        if( $t_var_name === FALSE )
        {
            if( is_array( $t_var_data ) )
            {
                // In this case, $t_var_data is an associative array
            
                // Add the variables in the array to the $this->element_view_data
                $this->element_view_data[ 't_vars' ] = array_merge( $this->element_view_data[ 't_vars' ] ,
                                                                    $t_var_data
                                                                  ) ;
            
                // Assign each of the variables in the associative array in $t_var_data
                // to the SMARTY object
                foreach( $t_var_data as $var_name => $var_data )
                {
                    $this->smarty_obj->assign( $var_name , $var_data ) ;
                }
            }
        }
        else
        {
            // In this case, $t-var_name has the variable name and $t_var_data
            // has the variable data
            
            // Add the variable to the $this->element_view_data
            $this->element_view_data[ 't_vars' ] = array_merge( $this->element_view_data[ 't_vars' ] ,
                                                                array( $t_var_name , $t_var_data )
                                                              ) ;
            
            // Assign the varibale to the SMARTY object
            $this->smarty_obj->assign( $t_var_name , $t_var_data ) ;
        }
    }
    
    
    // Method:  set_r_var( $r_var_name , $r_var_data )
    //
    // This public method sets one or more r-var variables.
    //
    // If the $r_var_name parameter is boolean and FALSE, the $r_var_data parameter
    // is an associative array with the following format:
    //
    //  $r_var_data ->  array( 'r-var-name-1' => 'r-var-data-1' ,
    //                         'r-var-name-2' => 'r-var-data-2' ,
    //                         'r-var-name-3' => 'r-var-data-3' ,
    //                          .......
    //                         'r-var-name-n' => 'r-var-data-n'
    //                       )
    //
    // Otherwise, $r_var_name parameter has the variable name and the $r_var_data
    // parameter has the variable data
    
    public function set_r_var( $r_var_name , $r_var_data )
    {
        if( $r_var_name === FALSE )
        {
            if( is_array( $r_var_data) )
            {
                // In this case, $r_var_data is an associative array
            
                // Add the variables in the array to the $this->element_view_data
                $this->element_view_data[ 'r_vars' ] = array_merge( $this->element_view_data[ 'r_vars' ] ,
                                                                        $r_var_data
                                                                      ) ;
            
                // Assign each of the variables in the associative array in $r_var_data
                // to the SMARTY object
                foreach( $r_var_data as $var_name => $var_data )
                {
                    $this->smarty_obj->assign( $var_name , $var_data ) ;
                }
            }
        }
        else
        {
            // In this case, $r-var_name has the variable name and $r_var_data
            // has the variable data
            
            // Add the variable to the $this->element_view_data
            $this->element_view_data[ 'r_vars' ] = array_merge( $this->element_view_data[ 'r_vars' ] ,
                                                                array( $r_var_name , $r_var_data )
                                                              ) ;
            
            // Assign the varibale to the SMARTY object
            $this->smarty_obj->assign( $r_var_name , $r_var_data ) ;
        }
    }
    
}