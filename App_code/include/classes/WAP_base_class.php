<?php if ( !defined( 'WAP_EXEC' ) ) exit( 'No direct script access allowed' ) ;


interface WAP__Interface {

    public static function get_version() ;

    
    public static function noop() ;

    public static function default_function() ;

    
    public static function set_view_data( $element_name, $data ) ;

    public static function get_view_data( $element_name ) ;

    
    public static function set_page_layout_view_data( $element_name, $data = null ) ;

    public static function get_page_layout_view_data( $element_name ) ;

    
    public static function set_element_view_data( $element_name, $data = null ) ;

    public static function get_element_view_data( $element_name ) ;

    
    public static function set_page_layout_template( $template_name, $template ) ;

    public static function get_page_layout_template( $template_name ) ;

    
    public static function set_element_template( $template_name, $template ) ;

    public static function get_element_template( $template_name ) ;

    
    public static function set_page_layout_css_file( $element_name, $css_file_URI ) ;

    public static function get_page_layout_css_file( $element_name ) ;

    
    public static function set_element_css_file( $element_name, $css_file_URI ) ;

    public static function get_element_css_file( $element_name ) ;

    
    public static function set_page_layout_js_file( $element_name, $js_file_URI ) ;

    public static function get_page_layout_js_file( $element_name ) ;

    
    public static function set_element_js_file( $element_name, $js_file_URI ) ;

    public static function get_element_js_file( $element_name ) ;

    
    public static function get_element_rendered_result() ;

    public static function get_render_order() ;

    public static function get_rendered_elements( $element_name ) ;

    
    public static function set_view_structure( $view_structure ) ;

    public static function add_view_element_structure( $element_name, $element_structure_data ) ;

    
    public static function compute_render_order( $view_element_structure ) ;

    public static function render_view_elements( $scope, $element ) ;

    
}

class WAP implements WAP__Interface {

    /**
     * Construct won't be called inside this class and is uncallable from
     * the outside.
     * This prevents instantiating this class.
     * This is by purpose, because we want a static class.
     */
    private function __construct()
    {
        
    }

    
    // Class private properties

    private static $initialized = FALSE ;
    
    private static $version = '0.010' ;
    
    private static $default_function_handler = 'noop' ;
    
    private static $action_handler = array( 'GET_method'     => 'noop' ,
                                            'POST_method'    => 'noop' ,
                                            'PUT_method'     => 'noop' ,
                                            'DELETE_method'  => 'noop' ,
                                            'HEAD_method'    => 'noop' ,
                                            'OPTIONS_method' => 'noop'
                                          ) ;
    
    private static $input_handler = array( 'GET_method'     => 'noop' ,
                                           'POST_method'    => 'noop' ,
                                           'PUT_method'     => 'noop' ,
                                           'DELETE_method'  => 'noop' ,
                                           'HEAD_method'    => 'noop' ,
                                           'OPTIONS_method' => 'noop'
                                         ) ;
    
    private static $mqueue_handler = array( 'GET_method'     => 'noop' ,
                                            'POST_method'    => 'noop' ,
                                            'PUT_method'     => 'noop' ,
                                            'DELETE_method'  => 'noop' ,
                                            'HEAD_method'    => 'noop' ,
                                            'OPTIONS_method' => 'noop'
                                          ) ;
    
    private static $sadr_handler = array( 'GET_method'     => 'noop' ,
                                          'POST_method'    => 'noop' ,
                                          'PUT_method'     => 'noop' ,
                                          'DELETE_method'  => 'noop' ,
                                          'HEAD_method'    => 'noop' ,
                                          'OPTIONS_method' => 'noop'
                                        ) ;
    
    private static $storage_handler = array( 'GET_method'     => 'noop' ,
                                             'POST_method'    => 'noop' ,
                                             'PUT_method'     => 'noop' ,
                                             'DELETE_method'  => 'noop' ,
                                             'HEAD_method'    => 'noop' ,
                                             'OPTIONS_method' => 'noop'
                                           ) ;
    
    private static $resources_handler = array( 'GET_method' => 'noop' ,
                                               'POST_method' => 'noop' ,
                                               'PUT_method' => 'noop' ,
                                               'DELETE_method' => 'noop' ,
                                               'HEAD_method' => 'noop' ,
                                               'OPTIONS_method' => 'noop '
                                             ) ;
    
    private static $forms_handler = array( 'GET_method' => 'noop' ,
                                           'POST_method' => 'noop' ,
                                           'PUT_method' => 'noop' ,
                                           'DELETE_method' => 'noop' ,
                                           'HEAD_method' => 'noop' ,
                                           'OPTIONS_method' => 'noop'
                                         ) ;
    
    
    // -----------
    // WAP objects
    // -----------
    
    // WAP::$data_interface
    
    public static $data_interface = null ;

    public static $CI_session = null ;
    
    public static $CI_presentation_session = null ;

    
    // ----------------------
    // CodeIgniter Base Class
    // ----------------------
    
    public static $CI = null ;
    
    
    // -------------------
    // CodeIgniter Objects
    // -------------------
    
    // CodeIgniter Benchmark Object
    public static $CI_Benchmark = null ;

    // CodeIgniter Hooks Object
    public static $CI_Hooks     = null ;

    // CodeIgniter Config Object
    public static $CI_Config    = null ;
    
    // CodeIgniter Utf_8 Object
    public static $CI_Utf_8     = null ;
    
    // CodeIgniter URI Object
    public static $CI_URI       = null ;
    
    // CodeIgniter Router Object
    public static $CI_Router    = null ;
    
    // CodeIgniter Output Object
    public static $CI_Output    = null ;
    
    // CodeIgniter Security Object
    public static $CI_Security  = null ;
    
    // CodeIgniter Input Object
    public static $CI_Input     = null ;
    
    
    
    
    // ------------------------
    // WAP View data structures
    // ------------------------

    
    // $view_structure
    //
    // This property holds an array with the structure of elements that make
    // the current page

    private static $view_structure = array() ;

    
    // $view_data  private property
    //
    // This property holds an array with the structure of the working data of
    // the current view

    private static $view_data = array() ;

    
    // $render_order  private property
    //
    // This property holds an associative array with the element nesting level
    // and the elements that belong to that level

    private static $render_order = array( 'head' => array() ,
                                          'list' => array( array()
                                                         ) ,
                                          'tail' => array()
                                        ) ;
    
    
    // $view_element_object  private property
    //
    // This property holds an associative array with the instatialized object
    // for each view element, according with the following structure:
    //
    //  $view_element_object -> array( 'main_page'  =>  <main_page_obj> ,
    //                                 'header'     =>  <header_obj> ,
    //                                 'display'    =>  <display_obj> ,
    //                                  .......
    //                                 'footer'     =>  <footer_obj>

    private static $view_element_object = array() ;
    
    
    // $render_elements  private property
    //
    // This property holds an associative array with the element names of each
    // rendering case

    private static $render_elements = array() ;

    
    // $rendered_elements  private property
    //
    // This property holds an associative array with all rendered view element's
    // result HTML, accessed by a key with the name of the element

    private static $rendered_elements = array() ;
    
    
    // $element_rendered_result  private property
    //
    // This property holds the result HTML of the last rendered view element

    private static $element_rendered_result = '' ;
    
    
    // ------------------------------------
    // WAP Page Layout View data structures
    // ------------------------------------
    // $page_layout_view_data  private property
    //
    // This property holds an array with the structure of the working data of
    // the current page layout
    //
    // The stored data has the followiwng format:
    //
    //  'element_name'  =>  array( 't-vars' =>  array( 'var-name-1' =>  'var-data-1' ,
    //                                                 'var-name-2' =>  'var-data-2' ,
    //                                                 'var-name-3' =>  'var-data-3' ,
    //                                                  .......
    //                                                 'var-name-n' =>  'var-data-n'
    //                                               ) ,
    //                             'r-vars' =>  array( 'var-name-1' =>  'var-data-1' ,
    //                                                 'var-name-2' =>  'var-data-2' ,
    //                                                 'var-name-3' =>  'var-data-3' ,
    //                                                  .......
    //                                                 'var-name-n' =>  'var-data-n'
    //                                               )
    //                           )

    private static $page_layout_view_data = array() ;
    
    
    // $page_layout_view_templates  private property
    //
    // This property holds an associative array with the name of the page layout
    // templates and their respective paths

    private static $page_layout_view_templates = array() ;
    
    
    // $page_layout_view_css  private property
    //
    // This property holds an associative array with the name of the page layout
    // view element and it's local CSS file URI, if it exists

    private static $page_layout_view_css = array() ;
    
    
    // $page_layout_view_js  private property
    // 
    // This property holds an associative array with the name of the page layout
    // view element and it's local JS file URI, if it exists

    private static $page_layout_view_js = array() ;
    
    
    // --------------------------------
    // WAP Element View data structures
    // --------------------------------

    // $element_view_data  private property
    //
    // This property holds an array with the structure of the working data of
    // the current page elements
    //
    // The stored data has the followiwng format:
    //
    //  'element_name'  =>  array( 't-vars' =>  array( 'var-name-1' =>  'var-data-1' ,
    //                                                 'var-name-2' =>  'var-data-2' ,
    //                                                 'var-name-3' =>  'var-data-3' ,
    //                                                  .......
    //                                                 'var-name-n' =>  'var-data-n'
    //                                               ) ,
    //                             'r-vars' =>  array( 'var-name-1' =>  'var-data-1' ,
    //                                                 'var-name-2' =>  'var-data-2' ,
    //                                                 'var-name-3' =>  'var-data-3' ,
    //                                                  .......
    //                                                 'var-name-n' =>  'var-data-n'
    //                                               )
    //                           )

    private static $element_view_data = array() ;
    
    
    // $element_view_templates  private property
    //
    // This property holds an associative array with the name of the element
    // templates and their respective paths

    private static $element_view_templates = array() ;
    
    
    // $element_view_css  private property
    //
    // This property holds an associative array with the name of the element
    // view element and it's local CSS file URI, if it exists

    private static $element_view_css = array() ;
    
    
    // $element_view_js  private property
    // 
    // This property holds an associative array with the name of the element
    // view element and it's local JS file URI, if it exists

    private static $element_view_js = array() ;

    
    // -----------------------
    // Class public properties
    // -----------------------

    // Class private initialize fuction

    private static function initialize()
    {
        if ( self::$initialized )
        {
            return ;
        }

        self::$initialized = TRUE ;
    }

    
    // Method:  get_version()
    //
    // This method returns the  self::$version  property

    public static function get_version()
    {
        self::initialize() ;
        return self::$version ;
    }

    
    // Method:  noop()
    //
    // This method just does nothing!....  :-)

    public static function noop()
    {
        
    }

    
    // Method:  default_function()
    //
    // This method just does nothing!.... :-) (by default....  :-) )

    public static function default_function()
    {
        
    }

    
    // ------------------------------------------------------------
    // Set / Get the data on the  WAP::$view_data  private property
    // ------------------------------------------------------------

    // Method:  set_view_data( $data )
    //
    // This method stores the passed array $data on the class static's
    // private associative array  self::$view_data

    public static function set_view_data( $element_name, $data )
    {
        if ( is_array( $data ) )
        {
            self::$view_data[ $element_name ] = $data ;
        }
    }

    
    public static function get_view_data( $element_name )
    {
        if ( array_key_exists( $element_name, self::$view_data ) )
        {
            return self::$view_data[ $element_name ] ;
        }
    }

    
    // ------------------------------------------------------------------------
    // Set / Get the data on the  WAP::$page_layout_view_data  private property
    // ------------------------------------------------------------------------

    // Method:  set_page_layout_view_data( $element_name , $data )
    //
    // This method stores the passed array $data on the class static's
    // private associative array  self::$page_layout_view_data
    // 
    // This method receives the name of a page layout view element and its
    // parameter data, in the following structure:
    //
    //  layout_data ->  array( 't-vars' =>  array( 't-var-name-1' => 't-var-data-1' ,
    //                                             't-var-name-2' => 't-var-data-2' ,
    //                                             't-var-name-3' => 't-var-data-3' ,
    //                                              .......
    //                                             't-var-name-n' => 't-var-data-n'
    //                                           ) ,
    //                         'r-vars' =>  array( 'r-var-name-1' => 'r-var-data-1' ,
    //                                             'r-var-name-2' => 'r-var-data-2' ,
    //                                             'r-var-name-3' => 'r-var-data-3' ,
    //                                              .......
    //                                             'r-var-name-n' => 'r-var-data-n'
    //                                           )
    //                       )
    //
    // If the parameter data is NULL, then the values are obtained as follows:
    // 
    //  $data = array( 't_vars' => self::$view_structure[ <element_name> ][ 't_vars' ] ,
    //                 'r_vars' => self::$view_structure[ <element_name> ][ 'r_vars' ]
    //               )

    public static function set_page_layout_view_data( $element_name , $data = null )
    {
        if ( $data === null )
        {
            self::$page_layout_view_data[ $element_name ] = array( 't_vars' => self::$view_structure[ $element_name ][ 't_vars' ] ,
                                                                   'r_vars' => self::$view_structure[ $element_name ][ 'r_vars' ]
                                                                 ) ;
        }
        else
        {    
            if ( is_array( $data ) )
            {
                self::$page_layout_view_data[ $element_name ] = $data ;
            }
        }
    }

    // Method:  get_page_layout_view_data( $element_name )
    //
    // This method receives the name of a page layout view element and returns
    // its parameter data, in the following structure:
    //
    //  layout_data ->  array( 't-vars' =>  array( 't-var-name-1' => 't-var-data-1' ,
    //                                             't-var-name-2' => 't-var-data-2' ,
    //                                             't-var-name-3' => 't-var-data-3' ,
    //                                              .......
    //                                             't-var-name-n' => 't-var-data-n'
    //                                           ) ,
    //                         'r-vars' =>  array( 'r-var-name-1' => 'r-var-data-1' ,
    //                                             'r-var-name-2' => 'r-var-data-2' ,
    //                                             'r-var-name-3' => 'r-var-data-3' ,
    //                                              .......
    //                                             'r-var-name-n' => 'r-var-data-n'
    //                                           )
    //                       )

    public static function get_page_layout_view_data( $element_name )
    {
        if ( array_key_exists( $element_name, self::$page_layout_view_data ) )
        {
            return  self::$page_layout_view_data[ $element_name ] ;
        }
        else
        {
            return  '' ;
        }
    }

    
    // --------------------------------------------------------------------
    // Set / Get the data on the  WAP::$element_view_data  private property
    // --------------------------------------------------------------------

    // Method:  set_element_view_data( $element_name , $data )
    //
    // This method stores the passed array $data on the class static's
    // private associative array  self::$element_view_data
    //
    // This method receives the name of an element view element and its parameter
    // data, in the following structure:
    //
    //  layout_data ->  array( 't-vars' =>  array( 't-var-name-1' => 't-var-data-1' ,
    //                                             't-var-name-2' => 't-var-data-2' ,
    //                                             't-var-name-3' => 't-var-data-3' ,
    //                                              .......
    //                                             't-var-name-n' => 't-var-data-n'
    //                                           ) ,
    //                         'r-vars' =>  array( 'r-var-name-1' => 'r-var-data-1' ,
    //                                             'r-var-name-2' => 'r-var-data-2' ,
    //                                             'r-var-name-3' => 'r-var-data-3' ,
    //                                              .......
    //                                             'r-var-name-n' => 'r-var-data-n'
    //                                           )
    //                       )
    //                       
    // If the parameter data is NULL, then the values are obtained as follows:
    // 
    //  $data = array( 't_vars' => self::$view_structure[ <element_name> ][ 't_vars' ] ,
    //                 'r_vars' => self::$view_structure[ <element_name> ][ 'r_vars' ]
    //               )

    public static function set_element_view_data( $element_name, $data = null )
    {
        if ( $data === null )
        {
            self::$element_view_data[ $element_name ] = array( 't_vars' => self::$view_structure[ $element_name ][ 't_vars' ] ,
                                                               'r_vars' => self::$view_structure[ $element_name ][ 'r_vars' ]
                                                             ) ;
        }
        else
        {
            if ( is_array( $data ) )
            {
                self::$element_view_data[ $element_name ] = array( 't_vars' => $data[ 't_vars' ] ,
                                                                   'r_vars' => $data[ 'r_vars' ]
                                                                 ) ;
                
//                echo '<h1>$data</h1>' ;
//                var_dump( $data ) ;
//                echo '<h1>self::$element_view_data[ $element_name ]</h1>' ;
//                var_dump( $element_name ) ;
//                var_dump( self::$element_view_data ) ;
            }
        }
    }

    
    // Method:  get_element_view_data( $element_name )
    //
    // This method receives the name of an element view element and returns its
    // parameter data, in the following structure:
    //
    //  layout_data ->  array( 't-vars' =>  array( 't-var-name-1' => 't-var-data-1' ,
    //                                             't-var-name-2' => 't-var-data-2' ,
    //                                             't-var-name-3' => 't-var-data-3' ,
    //                                              .......
    //                                             't-var-name-n' => 't-var-data-n'
    //                                           ) ,
    //                         'r-vars' =>  array( 'r-var-name-1' => 'r-var-data-1' ,
    //                                             'r-var-name-2' => 'r-var-data-2' ,
    //                                             'r-var-name-3' => 'r-var-data-3' ,
    //                                              .......
    //                                             'r-var-name-n' => 'r-var-data-n'
    //                                           )
    //                       )

    public static function get_element_view_data( $element_name )
    {
        if ( array_key_exists( $element_name, self::$element_view_data ) )
        {
            return  self::$element_view_data[ $element_name ] ;
        }
    }

    
    // ---------------------------------
    // Set / Get template name functions
    // ---------------------------------

    // Method:  set_page_layout_template( $element_name , $template )
    //
    // This method set's the template for the page layout in the
    // self::$page_layout_view_templates associative array, with the
    // $template_name key.
    //
    // If $template_name is not a boolean FALSE, then it is the element name
    // and $template has the template path, with exception of the file extention.
    // 
    // If $template_name is a boolean FALSE, then $template has an associative
    // array with several element names and respective template paths.

    public static function set_page_layout_template( $template_name, $template )
    {
        if ( $template_name === false )
        {
            // In this case, $template has an associative array of template names
            // and their respective template paths

            if ( is_array( $template ) )
            {
                foreach ( $template as $template_key => $template_path )
                {
                    $temp_array = array( $template_key => $template_path ) ;
                    $new_array = array_merge( self::$page_layout_view_templates, $temp_array
                                            ) ;
                    self::$page_layout_view_templates = $new_array ;
                }
            }
        }
        else
        {
            // In this case, $template has a string, with the template path and
            // $template_name has a string, with template name.

            self::$page_layout_view_templates[ $template_name ] = $template ;
        }
    }

    
    // Method:  get_page_layout_template( $template_name )
    //
    // If the $template_name is boolean and TRUE, then this method returns all
    // stored page layout templates, in an associative array with 'template_name'
    // and 'template_path'
    //
    // If the $template_name is a string, with the template name, this method
    // returns a string with the template path, if the template name exists, or
    // a null if the template name does not exist

    public static function get_page_layout_template( $template_name )
    {
        if ( $template_name === TRUE )
        {
            // Return ALL the stored templates in self::$page_layout_view_templates
            // in an associative array with 'template_name' as key and the
            // template path as the contents

            $return_array = array() ;

            foreach ( self::$page_layout_view_templates as $template_key => $template )
            {
                $return_array[ $template_key ] = $template ;
            }

            return  $return_array ;
        }
        else
        {
            // Return the template path if $template_name is a valid key
            // Return NULL otherwise.

            if ( array_key_exists( $template_name, self::$page_layout_view_templates ) )
            {
                return  self::$page_layout_view_templates[ $template_name ] ;
            }
            else
            {
                return NULL;
            }
        }
    }

    
    // Method:  set_element_template( $template_name , $template )
    //
    // This method set's the template for the page element in the
    // self::$element_view_templates associative array, with the $template_name
    // key.
    //
    // If $template_name is not a boolean FALSE, then it is the element name
    // and $template has the template path, with exception of the file extention.
    // 
    // If $template_name is a boolean FALSE, then $template has an associative
    // array with several element names and respective template paths.

    public static function set_element_template( $template_name, $template )
    {
        if ( $template_name === false )
        {
            // In this case, $template has an associative array of template names
            // and their respective template paths

            if ( is_array( $template ) )
            {
                foreach ( $template as $template_key => $template_path )
                {
                    $temp_array = array( $template_key => $template_path ) ;
                    $new_array = array_merge( self::$element_view_templates, $temp_array
                                            ) ;
                    self::$element_view_templates = $new_array ;
                }
            }
        }
        else
        {
            // In this case, $template has a string, with the template path and
            // $template_name has a string, with template name.

            self::$element_view_templates[ $template_name ] = $template ;
        }
    }

    
    // Method:  get_element_template( $template_name )
    //
    // If the $template_name is boolean and TRUE, then this method returns all
    // stored page layout templates, in an associative array with 'template_name'
    // and 'template_path'
    //
    // If the $template_name is a string, with the template name, this method
    // returns a string with the template path, if the template name exists, or
    // a null if the template name does not exist

    public static function get_element_template( $template_name )
    {
        if ( $template_name === TRUE )
        {
            // Return ALL the stored templates in self::$element_view_templates
            // in an associative array with 'template_name' as key and the
            // template path as the contents

            $return_array = array() ;

            foreach ( self::$element_view_templates as $template_key => $template )
            {
                $return_array[ $template_key ] = $template ;
            }

            return  $return_array;
        }
        else
        {
            // Return the template path if $template_name is a valid key
            // Return NULL otherwise.

            if ( array_key_exists( $template_name, self::$element_view_templates ) )
            {
                return  self::$element_view_templates[ $template_name ] ;
            }
            else
            {
                return  NULL;
            }
        }
    }

    
    // ---------------------------------
    // Set / Get functions for local CSS
    // ---------------------------------
    // Method:  set_page_layout_css_file( $template_name , $css_file_URI )
    //
    // This method receives the page layout element name in the $element_name
    // parameter and the CSS local file URI in the $css_file_URI parameter

    public static function set_page_layout_css_file( $element_name, $css_file_URI )
    {
        if ( is_string( $element_name ) )
        {
            self::$page_layout_view_css[ $element_name ] = $css_file_URI ;
        }
    }

    
    // Method:  get_page_layout_css_file( $element_name )
    //
    // This method received the page layout element name in the $element_name
    // parameter and returns the CSS local file URI

    public static function get_page_layout_css_file( $element_name )
    {
        if ( is_string( $element_name ) )
        {
            return  self::$page_layout_view_css[ $element_name ] ;
        }
        else
        {
            return  '' ;
        }
    }

    
    // Method:  set_element_css_file( $template_name , $css_file_URI )
    //
    // This method receives the element view element name in the $element_name
    // parameter and the CSS local file URI in the $css_file_URI parameter

    public static function set_element_css_file( $element_name, $css_file_URI )
    {
        if ( is_string( $element_name ) )
        {
            self::$element_view_css[ $element_name ] = $css_file_URI ;
        }
    }

    
    // Method:  get_element_css_file( $element_name )
    //
    // This method received the element view element name in the $element_name
    // parameter and returns the CSS local file URI

    public static function get_element_css_file( $element_name )
    {
        if ( is_string( $element_name ) )
        {
            return self::$element_view_css[ $element_name ] ;
        }
        else
        {
            return  '' ;
        }
    }

    
    // --------------------------------
    // Set / Get functions for local JS
    // --------------------------------
    // Method:  set_page_layout_js_file( $template_name , $js_file_URI )
    //
    // This method receives the page layout element name in the $element_name
    // parameter and the JS local file URI in the $js_file_URI parameter

    public static function set_page_layout_js_file( $element_name, $js_file_URI )
    {
        if ( is_string( $element_name ) )
        {
            self::$page_layout_view_js[ $element_name ] = $js_file_URI ;
        }
    }

    
    // Method:  get_page_layout_js_file( $element_name )
    //
    // This method received the page layout element name in the $element_name
    // parameter and returns the JS local file URI

    public static function get_page_layout_js_file( $element_name )
    {
        if ( is_string( $element_name ) )
        {
            return  self::$page_layout_view_js[ $element_name ] ;
        }
        else
        {
            return  '' ;
        }
    }

    
    // Method:  set_element_js_file( $template_name , $js_file_URI )
    //
    // This method receives the element view element name in the $element_name
    // parameter and the JS local file URI in the $js_file_URI parameter

    public static function set_element_js_file( $element_name, $js_file_URI )
    {
        if ( is_string( $element_name ) )
        {
            self::$element_view_js[ $element_name ] = $js_file_URI ;
        }
    }

    
    // Method:  get_element_js_file( $element_name )
    //
    // This method received the element view element name in the $element_name
    // parameter and returns the JS local file URI

    public static function get_element_js_file( $element_name )
    {
        if ( is_string( $element_name ) )
        {
            return  self::$element_view_js[ $element_name ] ;
        }
        else
        {
            return  '' ;
        }
    }

    
    // Method:  get_element_rendered_result()
    //
    // This method returns the rendered HTML of the last rendered view element

    public static function get_element_rendered_result()
    {
        return  self::$element_rendered_result ;
    }

    
    // Method:  get_render_order()
    //
    // This method returns the  self::$render:order  data structure

    public static function get_render_order()
    {
        return  self::$render_order ;
    }

    
    // Method:  get_rendered_elements( $element_name = FALSE )
    //
    // This method returns the rendered HTML of the selected $element_name, if it
    // has already been rendered or NULL if it has not been rendered yet.
    //
    // If the $element_name is omited or passed as boolean FALSE, the returned
    // result is an associative array with all the elements already rendered,
    // having the respective element names as data keys.
    //
    // If the $element_name is given, the returned result is either a string with
    // the rendered HTML of the selected $element_name, or NULL if it has not
    // been rendered yet.

    public static function get_rendered_elements( $element_name )
    {
        if ( $element_name === FALSE )
        {
            // The $element_name parameter is either omited or is boolean FALSE
            // So, return an associative array with all existing elements in the
            // self::$rendered_elements array

            $return_result_array = array() ;

            if ( is_array( self::$rendered_elements ) )
            {
                foreach ( self::$rendered_elements as $element_key => $element_data )
                {
                    $return_result_array = array_merge( $return_result_array,
                                                        array( $element_key => $element_data )
                                                      ) ;
                }
            }

            return  $return_result_array ;
            
        }
        else
        {
            if ( array_key_exists( $element_name, self::$rendered_elements ) )
            {
                return  self::$rendered_elements[ $element_name ] ;
            }
            else
            {
                // The $element_name parameter DOES NOT exist in the
                // self::$rendered_elements  associative array

                return  NULL ;
                
            }
        }
    }

    
    // Method:  set_view_structure( $view_structure )
    //
    // If the $view_structure is an array, it will be an associative array with
    // the following structure:
    // 
    //  key     ->  This is the layout/element official name
    //  data    ->  This is an associative array with the layout/element structure
    //
    
    public static function set_view_structure( $view_structure )
    {
        if ( is_array( $view_structure ) )
        {
            // The $view_structure parameter is an array
            foreach ( $view_structure as $template_key => $template_data )
            {
                // Add the element view to the self::$view_structure array
                self::add_view_element_structure( $template_key, $template_data ) ;

                // Compute the absolute path for the template directory
                $absolute_template_path = $GLOBALS[ 'DOC_ROOT' ] . TEMPLATE_BASE_DIR . '/' ;

                // Test if there is a local PHP file and, if there is, include it
                if ( file_exists( $absolute_template_path . $template_data[ 'template' ] . '.php' ) )
                {
                    // Include each element's PHP file, if it exists
                    include_once $absolute_template_path . $template_data[ 'template' ] . '.php' ;
                }

                // Add the layout / element template paths to the correct associative
                // array
                if ( $template_data[ 'type' ] === 'layout' )
                {
                    // The present element is a layout view element, so set the
                    // template path on the  self::$page_layout_view_templates
                    // array
                    self::set_page_layout_template( $template_key, $template_data[ 'template' ] ) ;

                    if( is_array( $template_data[ 't_vars' ] ) )
                    {
                        // Set page layout view element data into the
                        // self::$page_layout_view_data  associative array
                        // from the  'view_structure'  passed data
                        self::set_page_layout_view_data( $template_key, array( 't_vars' => $template_data[ 't_vars' ] ,
                                                                               'r_vars' => $template_data[ 'r_vars' ]
                                                                             )
                                                       ) ;
                    }
                    else
                    {
                        // Set page layout view element data into the
                        // self::$page_layout_view_data  associative array
                        // from the  WAP_data::$G_DATA[ 'view_data' ][ $template_name ]
                        // associative array
                        self::set_page_layout_view_data( $template_key, WAP_data::$G_DATA[ 'view_data' ][ $template_key ]
                                                      ) ;
                    }

                    // Create the view element object and store it in the
                    // associative array  self::$view_element_object
                    self::$view_element_object[ $template_key ] = new Page_Layout_View( $template_key,
                                                                                        array( 't_vars' => self::$page_layout_view_data[ $template_key][ 't_vars' ] ,
                                                                                               'r_vars' => self::$page_layout_view_data[ $template_key][ 'r_vars' ]
                                                                                             )
                                                                                      ) ;

                    echo "<h2>Element View Page Layout OBJECT:</h2>" ;
                    var_dump( self::$view_element_object[ $template_key ] ) ;
                    echo "<br/><br/>" ;

                }
                elseif ( $template_data[ 'type' ] === 'element' )
                {
                    // The present element is an element view element, so set the
                    // template path on the  self::$element_view_templates array
                    self::set_element_template( $template_key, $template_data[ 'template' ] ) ;

                    if( is_array( $template_data[ 't_vars' ] ) )
                    {
                        // Set element view element into the  self::$element_view_data
                        // associative array from the  'view_structure'  passed data
                        self::set_element_view_data( $template_key, array( 't_vars' => $template_data[ 't_vars' ] ,
                                                                           'r_vars' => $template_data[ 'r_vars' ]
                                                                         )
                                                   );
                    }
                    else
                    {
                        // Set page layout view element data into the
                        // self::$page_layout_view_data  associative array
                        // from the  WAP_data::$G_DATA[ 'view_data' ][ $template_name ]
                        // associative array
                        self::set_element_view_data( $template_key, WAP_data::$G_DATA[ 'view_data' ][ $template_key ]
                                                   ) ;
                    }
                    
                    // Create the view element object and store it in the
                    // associative array  self::$view_element_object
                    self::$view_element_object[ $template_key ] = new Element_View( $template_key, array( 't_vars' => self::$element_view_data[ $template_key][ 't_vars' ] ,
                                                                                                          'r_vars' => self::$element_view_data[ $template_key][ 'r_vars' ]
                                                                                                        )
                                                                                  ) ;

                    echo "<h2>Element View Element OBJECT:</h2>" ;
                    var_dump( self::$view_element_object[ $template_key ] ) ;
                    echo "<br/><br/>" ;

                }
                else
                {
                    // The present element is something else
                    
                }

                /*
                  print( "<h1>" . $template_key . "</h1>" ) ;
                  print( "<br/>" ) ;
                  var_dump( $template_data ) ;
                  print( "<hr/>" ) ;
                 */

            }
        }
        else
        {
            // The $view_structure is not an array
            
        }


//        print( "<hr/><hr/>" ) ;

        // Compute parent / child elements and insert their name in the
        // right place of the  self::$render_order  associative array
        // Get the 'parent' and 'children' information and add them to the correct
        // position in the  self::$render_order  associative array considering
        // their inter-dependencies

        self::compute_render_order(self::$view_structure);

//        foreach( self::$view_structure as $template_key => $template_data )
//        {
//            print( "<h1>" . $template_key . "</h1>" ) ;
//            print( "<hr/>" ) ;
//            var_dump( $template_data ) ;
//        }
//        echo "<h1>Page Layout view templates</h1><hr/>" ;
//        var_dump( self::$page_layout_view_templates ) ;
//        echo "<br/><br/>" ;
//        echo "<h1>Element view templates</h1><hr/>" ;
//        var_dump( self::$element_view_templates ) ;
//        echo "<br/><br/>" ;
    }

    
    // Method:  add_view_element_structure( $element_name , $element_structure_data )
    //
    // This method adds the element structure data to the self::$view_structure
    // array.
    //
    // If the $element_name is a boolean false, then $element_structure_data has
    // an associative array with one or more element structure data
    //
    // Otherwise, the $element_name has the name of the view element to be added
    // to the self::$view_structure and $element_structure_data has an associative
    // array with the element structure

    public static function add_view_element_structure( $element_name, $element_structure_data )
    {
        // Create a temporary copy of the self::$view_structure array
        $view_structure_temp = self::$view_structure ;

        if ( $element_name === FALSE )
        {
            // In this case the $element_structure_data has an associative array
            // where each key has the name of a view element (either a layout or
            // an element), and the key content's has an associative array with
            // the view element structural data

            foreach ( $element_structure_data as $element_key => $element_data )
            {
                self::$view_structure = array_merge( $view_structure_temp ,
                                                     array( $element_key => $element_data )
                                                   ) ;
                $view_structure_temp = self::$view_structure ;
            }
        }
        else
        {
            // In this case the $element_name has the name of a view element
            // (either a layout or an element), and the $element_structure_data
            // has an associative array with the view element structural data

            self::$view_structure = array_merge( $view_structure_temp ,
                                                 array( $element_name => $element_structure_data )
                                               ) ;
        }
    }

    
    // Method:  compute_render_order( $view_element_structure )
    //
    // This method receives the self::$view_structure and computes the render
    // order needed to render the whole view structure

    public static function compute_render_order( $view_element_structure )
    {
        // This method goes through the whole linkage of the view elements,
        // starting with the first element that has an empty 'parent' link
        // field, and going all the way through until elements that have an
        // empty 'children' link field.

        $current_element = null ;

        $unique_elements = array() ;
        $start_elements = array() ;
        $terminal_elements = array() ;
        $middle_elements = array() ;

        // Iterate over the  $view_element_structure  and determine the element
        // category
        foreach ( $view_element_structure as $element_key => $element_data )
        {
            // Determine the elements that does not have any parents nor any
            // children
            if (   is_null( $element_data[ 'parent' ] ) &&
                   is_null( $element_data[ 'children' ] )
               )
            {
                $unique_elements[] = $element_key ;
            }

            // Determine the elements that does not have any parents but have
            // children
            if (   is_null( $element_data[ 'parent' ] ) &&
                 ! is_null( $element_data[ 'children' ] )
               )
            {
                $start_elements[] = $element_key ;
            }

            // Determine the elements that does have parent but do not have any
            // children
            if ( ! is_null( $element_data[ 'parent' ] ) &&
                   is_null( $element_data[ 'children' ] )
               )
            {
                $terminal_elements[] = $element_key ;
            }

            // Determine the elements that does have both parent and children
            if ( ! is_null( $element_data[ 'parent' ] ) &&
                 ! is_null( $element_data[ 'children' ] )
               )
            {
                $middle_elements[] = $element_key ;
            }

            // Assign each simple type ($unique_elements, $start_elements and
            // $terminal_elements) to the  self::$render_order  data structure
            // Assign  $start_elements  to  self::$render_order[ 'head' ]
            self::$render_order[ 'head' ] = $start_elements ;

            // Assign  $terminal_elements  to  self::$render_order[ 'tail' ]
            self::$render_order[ 'tail' ] = $terminal_elements ;

            // Assign  $unique_elements  to  self::$render_order[ 'tail' ]
            self::$render_order[ 'tail' ] = array_merge( self::$render_order['tail'] ,
                                                         $unique_elements
                                                       ) ;

            // Assign  $middle_elements  to  self::$render_order[ 'list' ]
            self::$render_order[ 'list' ] = array( $middle_elements ) ;
        }

        // To determine the order of the middle elements, the following process
        // is used:
        //
        // The  $middle_elements  array is copyied to the  $original_set  array.
        // Also, copy the 'tail' elements to the  $work_set  array.
        // 
        // From this point, the following steps are applied until the $original_set
        // array is empty:
        //
        //  --> Go through each element of the  $work_set  array and see which
        //      element is the 'parent'. Then add this element to the  $new_work_set
        //      array.
        //  --> Take off the element just added to the  $new_work_set  array from
        //      $original_set  array
        //  --> When ALL elements of the  $work_set  array are processed, then
        //      just UNSHIFT the  $new_work_set  array to the  $result_set  array
        //      and clear the  $new_work_set  array
        //  --> Repeat all the previous steps until the  $original_set  array is
        //      empty

        self::$render_elements = array( 'unique_elements'   => $unique_elements ,
                                        'start_elements'    => $start_elements,
                                        'terminal_elements' => $terminal_elements,
                                        'middle_elements'   => $middle_elements
                                      ) ;


//        echo "<hr/><hr/>" ;
//        echo "<h4>Current element:</h4>" ;
//        var_dump( $current_element ) ;
//        echo "<h4>Unique elements:</h4>" ;
//        var_dump( $unique_elements ) ;
//        echo "<h4>Start elements:</h4>" ;
//        var_dump( $start_elements ) ;
//        echo "<h4>Terminal elements:</h4>" ;
//        var_dump( $terminal_elements ) ;
//        echo "<h4>Middle elements:</h4>" ;
//        var_dump( $middle_elements ) ;
//        echo "<hr/><hr/>" ;
//        echo '<h2>self::$render_order  data array:</h2>' ;
//        var_dump( self::$render_order ) ;
//        echo "<hr/><hr/>" ;
//        echo '<h2>self::$render_elements  data array:</h2>' ;
//        var_dump( self::$render_elements ) ;
//        echo "<hr/><hr/>" ;

    }

    
    // Method:  render_view_elements
    //
    // This method with go through the self::$render_order data structure to
    // render the required view elements, storing it's rendered HTML in the
    // appropriated place
    //
    // If the $scope parameter is 'ALL', then the $element parameter is ignored
    // and all elements are rendered in order, acording to the information in
    // self::$render_order data structure
    //
    // If the $scope parameter is 'UNIQUE', then the $element parameter has the
    // name of the element to be rendered
    //
    // If the $scope parameter is 'SET', then the $element parameter has an
    // associative array with the elements to be rendered, in the same order as
    // they are in self::$render_order

    public static function render_view_elements( $scope, $element_name )
    {
        if ( strtoupper( $scope ) === 'ALL' )
        {
            // $scope === 'ALL'
            // In this case, iterate through the  self::$render_order  data
            // structure in the following order:
            //
            //  1st place   ->  Render all elements in  self::$render_order[ 'tail' ]
            //                  associative array
            //  2nd place   ->  Render all elements in  self::$render_order[ 'list' ]
            //                  starting from the last element in the 'list' section
            //                  and going backwards until the fisrt one
            //  3rd place   ->  Render all elements in  self::$render_order[ 'head' ]
            //                  associative array
            
        }
        elseif ( strtoupper( $scope ) === 'UNIQUE' )
        {
            // $scope === 'UNIQUE'
            // In this case, the $element parameter has the view element's
            // name to be rendered and the rendering result is stored into
            // self::$element_rendered_result
            // Render the element and store the rendered HTML on the
            // self::$element_rendered_result  private property
            
//            echo "<h2>" . 'self::$view_element_object' . "</h2>" ;
//            var_dump( self::$view_element_object[ $element_name ] ) ;

            self::$view_element_object[ $element_name ]->render() ;

            self::$element_rendered_result = self::$view_element_object[ $element_name ]->get_rendered_HTML() ;

            // Store the just set  self::$element_rendered_result into the
            // self::$rendered_elements  associative array
            self::$rendered_elements = array_merge( self::$rendered_elements,
                                                    array( $element_name => self::$element_rendered_result )
                                                  ) ;
            echo "<h1>Rendered element: $element_name</h1>" ;
            var_dump( self::$rendered_elements[ $element_name ] ) ;
            
        }
        elseif ( strtoupper( $scope ) === 'SET' )
        {
            // $scope === 'SET'
            // In this case, iterate through the  $element  parameter, which has a
            // structure in the following order:
            //
            //  1st place   ->  Render all elements in  self::$render_order[ 'tail' ]
            //                  associative array
            //  2nd place   ->  Render all elements in  self::$render_order[ 'list' ]
            //                  starting from the last element in the 'list' section
            //                  and going backwards until the fisrt one
            //  3rd place   ->  Render all elements in  self::$render_order[ 'head' ]
            //                  associative array
            // The 'head' is just an ordered array with element names

            $render_order_head = $element_name[ 'head' ] ;

            // The 'list' is an array of ordered array(s) with element names
            $render_order_list = $element_name[ 'list' ] ;

            // The 'tail' is just an ordered array with element names
            $render_order_tail = $element_name[ 'tail' ] ;

//            echo "<h1>Processing the tail...</h1>";

            // Process the 'tail', in first place
            foreach ( $render_order_tail as $element_name )
            {
                self::render_view_elements( 'unique', $element_name ) ;

                $rendered_HTML = self::get_rendered_elements( $element_name ) ;

                // Get the 'output' associative array
                $out_element = self::$view_structure[ $element_name ][ 'output' ] ;
                
                if( is_array( $out_element ) )
                {
                    // Get the name of the element that receives the rendered output
                    $out_element_key = key( self::$view_structure[ $element_name ][ 'output' ] ) ;

                    // Get the name of the variable inside the 'r_vars' array where
                    // the output will be stored
                    $out_element_var = self::$view_structure[ $element_name ][ 'output' ][ $out_element_key ] ;

//                    // Store the rendered HTML in the right place
//                    self::$view_structure[ $out_element_key ][ 'r_vars' ][ $out_element_var ] =
//                            $rendered_HTML ;

                    // Store the rendered HTML in the right place.
                    if( self::$view_structure[ $element_name ][ 'type' ] === 'layout' )
                    {
                        // The current element is a  page_layout
                        // So, store the output HTML in the right place for the
                        // required parent element
                        self::$page_layout_view_data[ $out_element_key ]
                                                    [ 'r_vars' ]
                                                    [ $out_element_key ]
                                                        =
                                                    $rendered_HTML ;
                    }
                    elseif( self::$view_structure[ $element_name ][ 'type' ] === 'element' )
                    {
                        // The current element is an  element
                        // So, store the output HTML in the right place for the
                        // required parent element
                        self::$element_view_data[ $out_element_key ]
                                                [ 'r_vars' ]
                                                [ $out_element_key ]
                                                    =
                                                $rendered_HTML ;
                    }
                    else
                    {
                        // The current element is neither a  page_layout  nor a
                        // element
                        // So, do not do anything
                    }
                     
                }
            }

//            echo "<h1>Processing the list...</h1>";

            // Process the 'list' structure, in second place
            $reverse_render_order_list = array_reverse( $render_order_list ) ;
            
            foreach ( $reverse_render_order_list as $element_array )
            {
                foreach ( $element_array as $element_name )
                {
                    self::render_view_elements( 'unique', $element_name );

                    $rendered_HTML = self::get_rendered_elements( $element_name );

                    // Get the 'output' associative array
                    $out_element = self::$view_structure[ $element_name ][ 'output' ] ;
                
                    if( is_array( $out_element ) )
                    {
                        // Get the name of the element that receives the rendered output
                        $out_element_key = key( self::$view_structure[ $element_name ][ 'output' ] ) ;

                        // Get the name of the variable inside the 'r_vars' array where
                        // the output will be stored
                        $out_element_var = self::$view_structure[ $element_name ][ 'output' ][ $out_element_key ] ;

//                      // Store the rendered HTML in the right place
//                      self::$view_structure[ $out_element_key ][ 'r_vars' ][ $out_element_var ] =
//                      $rendered_HTML ;

                        // Store the rendered HTML in the right place.
                        if( self::$view_structure[ $element_name ][ 'type' ] === 'layout' )
                        {
                            // The current element is a  page_layout
                            // So, store the output HTML in the right place for the
                            // required parent element
                            self::$page_layout_view_data[ $out_element_key ]
                                                        [ 'r_vars' ]
                                                        [ $out_element_key ]
                                                            =
                                                        $rendered_HTML ;
                        }
                        elseif( self::$view_structure[ $element_name ][ 'type' ] === 'element' )
                        {
                            // The current element is an  element
                            // So, store the output HTML in the right place for the
                            // required parent element
                            self::$element_view_data[ $out_element_key ]
                                                    [ 'r_vars' ]
                                                    [ $out_element_key ]
                                                        =
                                                    $rendered_HTML ;
                        }
                        else
                        {
                            // The current element is neither a  page_layout  nor a
                            // element
                            // So, do not do anything
                        }
                            
                    }

                }
            }

//            echo "<h1>Processing the head...</h1>";

            // Process the 'head', finally
            foreach ( $render_order_head as $element_name )
            {
                self::render_view_elements( 'unique', $element_name );

                $rendered_HTML = self::get_rendered_elements( $element_name ) ;

                // Get the 'output' associative array
                $out_element = self::$view_structure[ $element_name ][ 'output' ] ;
                
                if( is_array( $out_element ) )
                {
                    // Get the name of the element that receives the rendered output
                    $out_element_key = key( self::$view_structure[ $element_name ][ 'output' ] ) ;

                    // Get the name of the variable inside the 'r_vars' array where
                    // the output will be stored
                    $out_element_var = self::$view_structure[ $element_name ][ 'output' ][ $out_element_key ] ;

//                    // Store the rendered HTML in the right place
//                    self::$view_structure[ $out_element_key ][ 'r_vars' ][ $out_element_var ] =
//                            $rendered_HTML ;

                    // Store the rendered HTML in the right place.
                    if( self::$view_structure[ $element_name ][ 'type' ] === 'layout' )
                    {
                        // The current element is a  page_layout
                        // So, store the output HTML in the right place for the
                        // required parent element
                        self::$page_layout_view_data[ $out_element_key ]
                                                    [ 'r_vars' ]
                                                    [ $out_element_key ]
                                                        =
                                                    $rendered_HTML ;
                    }
                    elseif( self::$view_structure[ $element_name ][ 'type' ] === 'element' )
                    {
                        // The current element is an  element
                        // So, store the output HTML in the right place for the
                        // required parent element
                        self::$element_view_data[ $out_element_key ]
                                                [ 'r_vars' ]
                                                [ $out_element_key ]
                                                    =
                                                $rendered_HTML ;
                    }
                    else
                    {
                        // The current element is neither a  page_layout  nor a
                        // element
                        // So, do not do anything
                    }
                            
                }
                else
                {
                    if( is_null( $out_element ) )
                    {
                        self::$element_rendered_result = $rendered_HTML ;
                        
                        echo "<hr/>" ;
                        echo "<h1>Pagina final renderizada:</h1>" ;
                        var_dump( self::$element_rendered_result) ;
                        echo "<hr/>" ;
                    }
                }
//                echo "<hr/>" ;
//                echo '<h1>self::$view_structure[]</h1>' ;
//                var_dump( self::$view_structure ) ;
//                echo "<hr/>" ;
            }
        }
        else
        {
            // If $scope as anything else, juist don't do anything
        }
    }

}


$GLOBALS[ 'WAP_version' ] = WAP::get_version() ;

