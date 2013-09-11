<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// The  nav_menu  local PHP file


// Initialize the local variable  $param_vars  with an empty  parameter data
// structure

$param_vars = array( 't_vars' => array() ,
                     'r_vars' => array()
                   ) ;


// Initialize  $date  variable

if( ! isset( $date ) )
{
    if( key_exists( 'date' , WAP_data::$G_DATA[ 'nav_menu_data' ] ) )
    {
        $date = WAP_data::$G_DATA[ 'nav_menu_data' ][ 'date' ] ;
    }
    else
    {
        $date = date( 'D, d M Y H:i:s' ) ;
    }

    if( key_exists( 'date' , WAP_data::$G_DATA[ 'nav_menu_data' ] ) )
    {
        $param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                               array( 'date' => $date ) 
                                             ) ;
    }

} 




// Get the number of menu items

if( key_exists( 'nav_menu_data' , WAP_data::$G_DATA ) )
{
    if( key_exists( 'nr_items' , WAP_data::$G_DATA[ 'nav_menu_data' ] ) )
    {
        $nr_items = WAP_data::$G_DATA[ 'nav_menu_data' ][ 'nr_items' ] ;
    }
    else
    {
        $nr_items = 0 ;
    }

    // Initialize  $var_name  with the base name of the template variables
    $var_name = array( 'href'   => 'nav_menu_href_' ,
                       'target' => 'nav_menu_target_' ,
                       'class'  => 'nav_menu_class_' ,
                       'data'   => 'nav_menu_data_'
                     ) ;

    // Set start menu item number
    $item_nr = 1 ;

    
    // Get the menu items

    foreach( WAP_data::$G_DATA[ 'nav_menu_data' ] as $menu_item_array )
    {
        if( is_array( $menu_item_array ) )
        {
            // Get either the passed or locally defined 'nav_menu_href_' parameter
            
            // Get the actual variable name into  $href_var_name  variable
            $href_var_name = $var_name[ 'href' ] . $item_nr ;
            if( key_exists( 'href' , $menu_item_array ) )
            {
                // Copy the passed  'nav_menu_href_x'  data to the variable whose
                // name is on  $href_var_name
                $$href_var_name = WAP_data::$G_DATA[ 'nav_menu_data' ][ $item_nr ][ 'href' ] ;
            }
            else
            {
                // Setup the variable whose name is on  $href_var_name  with a literal
                // local value
                $$href_var_name = 'item_' . $item_nr . '_href' ;
            }
            $param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                                   array( $href_var_name => $$href_var_name ) 
                                                 ) ;

            $href_var_name = $var_name[ 'target' ] . $item_nr ;
            if( key_exists( 'target' , $menu_item_array ) )
            {
                // Copy the passed  'nav_menu_target_x'  data to the variable whose
                // name is on  $href_var_name
                $$href_var_name = WAP_data::$G_DATA[ 'nav_menu_data' ][ $item_nr ][ 'target' ] ;
            }
            else
            {
                // Setup the variable whose name is on  $href_var_name  with a literal
                // local value
                $$href_var_name = 'item_' . $item_nr . '_target' ;
            }
            $param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                                   array( $href_var_name => $$href_var_name ) 
                                                 ) ;
            
            $href_var_name = $var_name[ 'class' ] . $item_nr ;
            if( key_exists( 'class' , $menu_item_array ) )
            {
                // Copy the passed  'nav_menu_class_x'  data to the variable whose
                // name is on  $href_var_name
                $$href_var_name = WAP_data::$G_DATA[ 'nav_menu_data' ][ $item_nr ][ 'class' ] ;
            }
            else
            {
                // Setup the variable whose name is on  $href_var_name  with a literal
                // local value
                $$href_var_name = 'item_' . $item_nr . '_class' ;
            }
            $param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                                   array( $href_var_name => $$href_var_name ) 
                                                 ) ;
            
            $href_var_name = $var_name[ 'data' ] . $item_nr ;
            if( key_exists( 'data' , $menu_item_array ) )
            {
                // Copy the passed  'nav_menu_data_x'  data to the variable whose
                // name is on  $href_var_name
                $$href_var_name = WAP_data::$G_DATA[ 'nav_menu_data' ][ $item_nr ][ 'data' ] ;
            }
            else
            {
                // Setup the variable whose name is on  $href_var_name  with a literal
                // local value
                $$href_var_name = 'item_' . $item_nr . '_data' ;
            }
            $param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                                   array( $href_var_name => $$href_var_name ) 
                                                 ) ;
            
            $item_nr = $item_nr + 1 ;
            
        }

    }
    
}

var_dump( $param_vars ) ;

/*
var_dump( $nav_menu_href_1 ) ;
var_dump( $nav_menu_target_1 ) ;
var_dump( $nav_menu_class_1 ) ;
var_dump( $nav_menu_data_1 ) ;
var_dump( $nav_menu_href_2 ) ;
var_dump( $nav_menu_target_2 ) ;
var_dump( $nav_menu_class_2 ) ;
var_dump( $nav_menu_data_2 ) ;
var_dump( $nav_menu_href_3 ) ;
var_dump( $nav_menu_target_3 ) ;
var_dump( $nav_menu_class_3 ) ;
var_dump( $nav_menu_data_3 ) ;
var_dump( $nav_menu_href_4 ) ;
var_dump( $nav_menu_target_4 ) ;
var_dump( $nav_menu_class_4 ) ;
var_dump( $nav_menu_data_4 ) ;
var_dump( $nav_menu_href_5 ) ;
var_dump( $nav_menu_target_5 ) ;
var_dump( $nav_menu_class_5 ) ;
var_dump( $nav_menu_data_5 ) ;
var_dump( $nav_menu_href_6 ) ;
var_dump( $nav_menu_target_6 ) ;
var_dump( $nav_menu_class_6 ) ;
var_dump( $nav_menu_data_6 ) ;
var_dump( $nav_menu_href_7 ) ;
var_dump( $nav_menu_target_7 ) ;
var_dump( $nav_menu_class_7 ) ;
var_dump( $nav_menu_data_7 ) ;
var_dump( $nav_menu_href_8 ) ;
var_dump( $nav_menu_target_8 ) ;
var_dump( $nav_menu_class_8 ) ;
var_dump( $nav_menu_data_8 ) ;
var_dump( $nav_menu_href_9 ) ;
var_dump( $nav_menu_target_9 ) ;
var_dump( $nav_menu_class_9 ) ;
var_dump( $nav_menu_data_9 ) ;
var_dump( $nav_menu_href_10 ) ;
var_dump( $nav_menu_target_10 ) ;
var_dump( $nav_menu_class_10 ) ;
var_dump( $nav_menu_data_10 ) ;
*/

// Store the parameters in  WAP_data::$G_DATA[ 'view_data' ][ $element_name]
WAP_data::$G_DATA[ 'view_data' ][ 'nav_menu' ] = $param_vars ;

// var_dump( WAP_data::$G_DATA ) ;