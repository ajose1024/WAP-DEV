<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// This class is the base class for the HTML page layout element renderization

interface Page_Layout_View_Interface
{
    public function __construct( $element_name , $data = array() ) ;
    
    
    public function render() ;
    
    
    public function get_rendered_HTML() ;
    
    
    public function display_HTML() ;
    
    
    public function add_META_element( $data , $literal = false ) ;
    
    public function add_LINK_element( $data ) ;
    
    public function add_STYLE_element( $data , $remote = false ) ;
    
    public function add_SCRIPT_element( $data , $remote ) ;
    

    public function get_LINK_element() ;

    public function get_META_element() ;

    public function get_STYLE_element() ;

    public function get_SCRIPT_element() ;

    
    public function add_template_var( $data_name , $data_value ) ;
    
    public function set_t_var( $t_var_name , $t_var_data ) ;
    
    public function set_r_var( $r_var_name , $r_var_data ) ;
    
    
    public function dump_LINK_data() ;
    
    public function dump_META_data() ;
    
    public function dump_STYLE_data() ;
    
    public function dump_SCRIPT_data() ;
}


class Page_Layout_View implements Page_Layout_View_Interface
{
    // Private property to hold the template name
    private $element_name = null ;
    
    // Private property to hold the layout bash path
    private $page_layout_element_base_path = null ;
    
    // Private property to hold the passed template name
    private $page_layout_view_template = null ;
    
    // Private property to hold the passed data structure
    private $page_layout_view_data = null ;
    
    // Private property to hold the rendered HTML
    private $page_layout_view_HTML = '' ;
    
    // Protected property to hold the Smarty object
    private $smarty_obj = null ;
    
    
    // META Data Section
    private $META_data_HTML = array( '' ) ;
    
    // LINK Data Section
    private $LINK_data_HTML = array( '' ) ;
    
    // STYLE Data Section
    private $STYLE_data_HTML = array( '' ) ;
    
    // SCRIPT Data Section
    private $SCRIPT_data_HTML = array( '' ) ;


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
        
        $this->page_layout_element_base_path = WAP::get_page_layout_template( $element_name ) ;
        
        $this->page_layout_view_template = $this->page_layout_element_base_path . '.tpl' ;
        
        $this->smarty_obj =  $GLOBALS[ 'smarty_obj' ] ;


        // Compute the absolute path for the template directory
        $absolute_template_path = $GLOBALS[ 'DOC_ROOT' ] . TEMPLATE_BASE_DIR . '/' ;
        
        // Test if there is a local CSS file and, if there is, add it to the
        // WAP::$local_layout_css_files  associative array
        if( file_exists( $absolute_template_path . $this->page_layout_element_base_path . '.css' ) )
        {
            WAP::set_page_layout_css_file( $element_name ,
                                           TEMPLATE_BASE_DIR .
                                           $this->page_layout_element_base_path .
                                           '.css'
                                         ) ;
        }

        // Test if there is a local JS dile and, if there is, add it to the 
        // WAP::local_layout_js_files  associative array
        if( file_exists( $absolute_template_path . $this->page_layout_element_base_path . '.js' ) )
        {
            WAP::set_page_layout_js_file( $element_name ,
                                          TEMPLATE_BASE_DIR .
                                          $this->page_layout_element_base_path .
                                          '.js'
                                        ) ;
        }
        
        // If the $data parameter is not passed, get the Page Layout view data
        // from the  WAP::$page_layout_view_data  associative array
        if( empty( $data ) )
        {
            // Get the Page Layout view data from the  WAP::$page_layout_view_data
            // property if no  $data  parameter is passed
            $data = WAP::get_page_layout_view_data( $element_name ) ;
        }

        $this->page_layout_view_data = $data ;

        echo "<h2>page_layout data:</h2>" ;
        var_dump( $data ) ;
        echo "<h2>page_layout_element_base_path</h2>" ;
        var_dump( $this->page_layout_element_base_path ) ;
        echo "<h2>page_layout_view_template</h2>" ;
        var_dump( $this->page_layout_view_template ) ;
        echo "<h2>page_layout_view_data</h2>" ;
        var_dump( $this->page_layout_view_data ) ;
        echo "<h2>page_layout_view_HTML</h2>" ;
        var_dump( $this->page_layout_view_HTML ) ;
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
    
    
    // This method renders the page layout template file, getting the rendered HTML
    // code and storing it in the  $this->element_view_HTML  private property
    
    public function render()
    {
        // Before rendering the template we must assign to the Smarty object the
        // current values of the 'r_vars' (output from previously rendered elements)
        $data = WAP::get_page_layout_view_data( $this->element_name ) ;
        
        // Assign to SMARTY object the 'r-vars' variables
        if( is_array( $data[ 'r_vars' ] ) )
        {
            foreach( $data[ 'r_vars' ] as $var_name => $var_data )
            {
                $this->smarty_obj->assign( $var_name , $var_data ) ;
            }
        }
        
        // Get the Smarty template rendered HTML
        $this->page_layout_view_HTML = $this->smarty_obj->fetch( $this->page_layout_view_template ) ;
    }
    
    
    // This method returns the rendered HTML code
    
    public function get_rendered_HTML()
    {
        return  $this->page_layout_view_HTML ;
    }
    
    
    // This method sends the rendered HTML code to the browser
    public function display_HTML()
    {
        print( $this->page_layout_view_HTML ) ;
    }
    
    
    // This method adds a META element to the META section
    //
    // Examples:
    //  <META NAME="AUTHOR" CONTENT="Tex Texin">
    //  <META NAME="COPYRIGHT" CONTENT="&copy; 2004 Tex Texin">
    //  <META NAME="DESCRIPTION" CONTENT="...summary of web page...">
    //  <META NAME="KEYWORDS" CONTENT="sex, drugs, rock & roll">
    //  <META NAME="ROBOTS" CONTENT="ALL">
    //  <META NAME="ROBOTS" CONTENT="INDEX,NOFOLLOW">
    //  <META NAME="ROBOTS" CONTENT="NOINDEX,FOLLOW">
    //  <META NAME="ROBOTS" CONTENT="NONE">
    //  <META NAME="GOOGLEBOT" CONTENT="NOARCHIVE">
    //  
    //  <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    //  <META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="en-US,fr">
    //  <META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; charset=UTF-8">
    //  <META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
    //  <META HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
    //  <META HTTP-EQUIV="REFRESH" CONTENT="15;URL=http://www.I18nGuy.com/index.html">
    //  
    // If the optional $literal parameter is absent or FALSE, the $data parameter
    // can have a META tag (in literal form), as a string, or several (in literal
    // form), as an array.
    // 
    //  $data = '<meta xxxxx="nnnn" yyyyy="mmmmm">'
    //  
    //  ou
    //  
    //  $data = array( '<meta xxxxx="nnnn" yyyyy="mmmm">' ,
    //                 '<meta xxxxx="nnnn" yyyyy="mmmm">' ,
    //                  ......
    //                 '<meta xxxxx="nnnn" yyyyy="mmmm">'
    //               )
    //
    // If the optional $literal parameter is not FALSE, the $data parameter is
    // an array of associative arrays.
    // 
    //  $data = array( array( 'name' => 'nnnn' ,
    //                        'content' => 'mmmm'
    //                      ) ,
    //                 array( 'name' => 'nnnn' ,
    //                        'content' => 'mmmm'
    //                      )
    //               )
    //
    
    public function add_META_element( $data , $literal = false )
    {
        if( $literal === false )
        {
            if( is_array( $data ) )
            {
                // The $data parameter is an array.

                // so it either is an associative array or an array of 
                // associative arrays
                                
                foreach ( $data as $data_value )
                {
                    if( array_key_exists( 'content' , $data_value ) )
                    {
                        if( array_key_exists( 'name' , $data_value ) )
                        {
                            $this->META_data_HTML[] = '<meta ' .
                                                      'name="' .
                                                      $data_value[ 'name' ] .
                                                      '" content="' .
                                                      $data_value[ 'content' ] .
                                                      '">'
                                                    ;
                        }
                        elseif( array_key_exists( 'http-equiv' , $data_value ) )
                        {
                            $this->META_data_HTML[] = '<meta ' .
                                                      'http-equiv="' .
                                                      $data_value[ 'http-equiv' ] .
                                                      '" content="' .
                                                      $data_value[ 'content' ] .
                                                      '">'
                                                    ;
                        }
                    }
                }
            }
            else
            {
                // The $data parameter in NOT an array, so no valid META tag
                // is set
                
                
            }
        }
        else
        {
            if( is_array( $data ) )
            {
                // The $data parameter is an array and the $literal parameter
                // is not boolean FALSE
            
                foreach( $data as $data_value )
                {
                    $this->META_data_HTML[] = $data_value ;
                }
            }
            elseif ( is_string( $data ) )
            {
                // The $data parameter is a string and the $literal parameter
                // is not boolean FALSE
                $this->META_data_HTML[] = $data ;
            }
            else
            {
                // The $data parameter is not an array nor a string and the
                // $literal parameter in not boolean FALSE
                
            }
        }
    }
    
    
    // This method adds a LINK element to the LINK section
    public function add_LINK_element( $data )
    {
        $this->LINK_data_HTML[] = $data ;
    }
    
    
    // This method adds a STYLE element to the STYLE section
    //
    // If the optional $remote parameter is absent or FALSE, the $data parameter
    // will have the inner_HTML of the <style type="text/css"> ... </style>
    // container
    // 
    //  $data = 'xx {ttt: yyy ;} yy {rrr: zzz ;}'
    //
    // If the optional $remote parameter is not FALSE, the $data parameter is
    // either a string, with the name of a CSS URI, or an array of several
    // CSS URIs
    //
    //  $data = 'http://<servidor>/<resource>'
    //  
    //  ou
    //  
    //  $data = array( 'http://<servidor>/<resource-1>' ,
    //                 'http://<servidor>/<resource-2>' ,
    //                 'http://<servidor>/<resource-3>' ,
    //                   ...........                    ,
    //                 'http://<servidor>/<resource-n>
    //               )
    //

    public function add_STYLE_element( $data , $remote = false )
    {
        if( $remote === false )
        {
            // $data is just the inner_HTML data for the <slyle ...> .. </style>
            // container

            $this->STYLE_data_HTML[] = str_replace( '\\n', PHP_EOL,
                                                    '<style type="text/css">\n' .
                                                    $data .
                                                    '\n</style>'
                                                  ) ;
        }
        else
        {
            // In this case, $data is either a string, with just one CSS URI
            // or an array with a number of CSS URIs
            
            if( is_string( $data ) )
            {
                // $data is a string: just with one CSS URI

                $this->STYLE_data_HTML[] = '<link ' .
                                           'rel="stylesheet" ' .
                                           'type="text/css" ' .
                                           'href="' .
                                           $data .
                                           '">'
                                         ;
            }
            elseif ( is_array( $data ) )
            {
                // $data is an array: with one or more CSS URIs
                
                foreach( $data as $data_value )
                {
                    $this->STYLE_data_HTML[] = '<link ' .
                                               'rel="stylesheet" ' .
                                               'type="text/css" ' .
                                               'href="' .
                                               $data_value .
                                               '">'
                                             ;
                }
            }
            else
            {
                // $data is in unknown format. Just do nothing.
                
            }
        }
    }
    
    
    // This method adds a SCRIPT element to the SCRIPT section
    //
    // If the optional $remote parameter is absent or FALSE, the $data parameter
    // will have the inner_HTML of the <script type="text/javascript"> ... </script>
    // container
    // 
    //  $data = 'var i=10; if (i<5) { // some code }'
    //
    // If the optional $remote parameter is not FALSE, the $data parameter is
    // either a string, with the name of a SCRIPT URI, or an array of several
    // SCRIPT URIs
    //
    //  $data = 'http://<servidor>/<resource>'
    //  
    //  ou
    //  
    //  $data = array( 'http://<servidor>/<resource-1>' ,
    //                 'http://<servidor>/<resource-2>' ,
    //                 'http://<servidor>/<resource-3>' ,
    //                   ...........                    ,
    //                 'http://<servidor>/<resource-n>
    //               )
    //
    
    public function add_SCRIPT_element( $data , $remote )
    {
        if( $remote === false )
        {
            // $data is just the inner_HTML data for the <script ...> .. </script>
            // container

            $this->SCRIPT_data_HTML[] = str_replace( '\\n', PHP_EOL,
                                                     '<script type="text/javascript">\n' .
                                                     $data .
                                                     '\n</script>'
                                                   ) ;
        }
        else
        {
            // In this case, $data is either a string, with just one CSS URI
            // or an array with a number of CSS URIs
            
            if( is_string( $data ) )
            {
                // $data is a string: just with one CSS URI

                $this->SCRIPT_data_HTML[] = '<script ' .
                                            'type="text/javascript" ' .
                                            'src="' .
                                            $data .
                                            '">'
                                          ;
            }
            elseif ( is_array( $data ) )
            {
                // $data is an array: with one or more CSS URIs
                
                foreach( $data as $data_value )
                {
                    $this->SCRIPT_data_HTML[] = '<script ' .
                                                'type="text/javascript" ' .
                                                'src="' .
                                                $data_value .
                                                '">'
                                              ;
                }
            }
            else
            {
                // $data is in unknown format. Just do nothing.
                
            }
        }
    }
    

    // ----------------
    // Get data section
    // ----------------

    // get_LINK_element() method
    //
    // This method returns the stored values in the LINK_data_HTML private
    // property.
    // The values are stored in an array, with each element in one element of
    // the array, but are returned as a simple string (with embebed newlines,
    // if needed).
    
    public function get_LINK_element()
    {
        $return_data = PHP_EOL ;
        
        foreach( $this->LINK_data_HTML as $LINK_element )
        {
            $return_data = $return_data . $LINK_element . PHP_EOL ;
        }
        
        return  $return_data ;
    }


    // get_META_element() method
    //
    // This method returns the stored values in the META_data_HTML private
    // property.
    // The values are stored in an array, with each element in one element of
    // the array, but are returned as a simple string (with embebed newlines,
    // if needed).
    
    public function get_META_element()
    {
        $return_data = PHP_EOL ;
        
        foreach( $this->META_data_HTML as $META_element )
        {
            $return_data = $return_data . $META_element . PHP_EOL ;
        }
        
        return  $return_data ;
    }


    // get_STYLE_element() method
    //
    // This method returns the stored values in the STYLE_data_HTML private
    // property.
    // The values are stored in an array, with each element in one element of
    // the array, but are returned as a simple string (with embebed newlines,
    // if needed).
    
    public function get_STYLE_element()
    {
        $return_data = PHP_EOL ;
        
        foreach( $this->STYLE_data_HTML as $STYLE_element )
        {
            $return_data = $return_data . $STYLE_element . PHP_EOL ;
        }
        
        return  $return_data ;
    }


    // get_SCRIPT_element() method
    //
    // This method returns the stored values in the SCRIPT_data_HTML private
    // property.
    // The values are stored in an array, with each element in one element of
    // the array, but are returned as a simple string (with embebed newlines,
    // if needed).
    
    public function get_SCRIPT_element()
    {
        $return_data = PHP_EOL ;
        
        foreach( $this->SCRIPT_data_HTML as $SCRIPT_element )
        {
            $return_data = $return_data . $SCRIPT_element . PHP_EOL ;
        }
        
        return  $return_data ;
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
            if( is_array( $t_var_name ) )
            {
                // In this case, $t_var_data is an associative array
            
                // Add the variables in the array to the $this->page_layout_view_data
                $this->page_layout_view_data[ 't_vars' ] = array_merge( $this->page_layout_view_data[ 't_vars' ] ,
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
            
            // Add the variable to the $this->page_layout_view_data
            $this->page_layout_view_data[ 't_vars' ] = array_merge( $this->page_layout_view_data[ 't_vars' ] ,
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
            if( is_array( $r_var_name ) )
            {
                // In this case, $r_var_data is an associative array
            
                // Add the variables in the array to the $this->page_layout_view_data
                $this->page_layout_view_data[ 'r_vars' ] = array_merge( $this->page_layout_view_data[ 'r_vars' ] ,
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
            
            // Add the variable to the $this->page_layout_view_data
            $this->page_layout_view_data[ 'r_vars' ] = array_merge( $this->page_layout_view_data[ 'r_vars' ] ,
                                                                    array( $r_var_name , $r_var_data )
                                                                  ) ;
            
            // Assign the varibale to the SMARTY object
            $this->smarty_obj->assign( $r_var_name , $r_var_data ) ;
        }
    }
    
    

    // -------------
    // Debug section
    // -------------
    
    public function dump_LINK_data()
    {
        var_dump( $this->LINK_data_HTML ) ;
    }
    
    public function dump_META_data()
    {
        var_dump( $this->LINK_data_HTML ) ;
    }
    
    public function dump_STYLE_data()
    {
        var_dump( $this->LINK_data_HTML ) ;
    }
    
    public function dump_SCRIPT_data()
    {
        var_dump( $this->LINK_data_HTML ) ;
    }
}