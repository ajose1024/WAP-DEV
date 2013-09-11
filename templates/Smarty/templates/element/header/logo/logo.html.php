<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// The  logo  local PHP file


// Initialize the local variable  $param_vars  with an empty  parameter data
// structure

$param_vars = array( 't_vars' => array() ,
                     'r_vars' => array()
                   ) ;


// Local definition for template vars initial data

$logo_link_href_initdata   = '' ;
$logo_link_style_initdata  = '' ;
$logo_link_class_initdata  = '' ;
$logo_link_target_initdata = '' ;
$logo_img_style_initdata   = '' ;
$logo_img_class_initdata   = '' ;


// Initial data passed in:
//
//  WAP_data::$G_DATA[ 'logo_data' ] = array( 'link'  => array( 'href'   => '#' ,
//                                                              'target' => '' ,
//                                                              'style'  => '' ,
//                                                              'class'  => '' 
//                                                            ) ,
//                                            'image' => array( 'style'  => '' ,
//                                                              'class'  => ''
//                                                            )
//                                          ) ;


// Initialize:  $logo_link_href

if( ! isset( $logo_link_href ) )
{
    if( key_exists( 'href' , WAP_data::$G_DATA[ 'logo_data' ] ) )
    {
        $logo_link_href = WAP_data::$G_DATA[ 'logo_data' ][ 'href' ] ;
    }
    else
    {
        $logo_link_href = $logo_link_href_initdata ;
    }
}


// Initialize:  $logo_link_style

if( ! isset( $logo_link_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'logo_data' ][ 'link' ] ) )
    {
        $logo_link_style = WAP_data::$G_DATA[ 'logo_data' ][ 'link' ][ 'style' ] ;
    }
    else
    {
        $logo_link_style = $logo_link_style_initdata ;
    }
}


// Initialize:  $logo_link_class

if( ! isset( $logo_link_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'logo_data' ][ 'link' ] ) )
    {
        $logo_link_class = WAP_data::$G_DATA[ 'logo_data' ][ 'link' ][ 'class' ] ;
    }
    else
    {
        $logo_link_class = $logo_link_class_initdata ;
    }
}


// Initialize:  $logo_link_target

if( ! isset( $logo_link_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'logo_data' ][ 'link' ] ) )
    {
        $logo_link_target = WAP_data::$G_DATA[ 'logo_data' ][ 'link' ][ 'target' ] ;
    }
    else
    {
        $logo_link_target = $logo_link_target_initdata ;
    }
}


// Initialize:  $logo_img_style

if( ! isset( $logo_img_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'logo_data' ][ 'image' ] ) )
    {
        $logo_img_style = WAP_data::$G_DATA[ 'logo_data' ][ 'image' ][ 'style' ] ;
    }
    else
    {
        $logo_img_style = $logo_img_style_initdata ;
    }
}


// Initialize:  $logo_img_class

if( ! isset( $logo_img_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'logo_data' ][ 'image' ] ) )
    {
        $logo_img_class = WAP_data::$G_DATA[ 'logo_data' ][ 'image' ][ 'class' ] ;
    }
    else
    {
        $logo_img_class = $logo_img_class_initdata ;
    }
}


// Add the vars to the 't_vars' array on the $param_vars data structure

$param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                       array( 'logo_link_href'   => $logo_link_href ,
                                              'logo_link_style'  => $logo_link_style ,
                                              'logo_link_class'  => $logo_link_class ,
                                              'logo_link_target' => $logo_link_target ,
                                              'logo_img_style'   => $logo_img_style ,
                                              'logo_img_class'   => $logo_img_class
                                            )
                                     ) ;


// Store the parameters in  WAP_data::$G_DATA[ 'view_data' ][ $element_name]
WAP_data::$G_DATA[ 'view_data' ][ 'logo' ] = $param_vars ;
