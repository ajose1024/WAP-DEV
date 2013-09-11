<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// The  banner  local PHP file


// Initialize the local variable  $param_vars  with an empty  parameter data
// structure

$param_vars = array( 't_vars' => array() ,
                     'r_vars' => array()
                   ) ;


// Local definition for template vars initial data

$banner_display_initdata     = '' ;
$banner_link_href_initdata   = '' ;
$banner_link_style_initdata  = '' ;
$banner_link_class_initdata  = '' ;
$banner_link_target_initdata = '' ;
$banner_img_src_initdata     = '/@pics/banners/banner.jpg' ;
$banner_img_style_initdata   = '' ;
$banner_img_class_initdata   = '' ;


// Initial data passed in:
//
//  WAP_data::$G_DATA[ 'banner_data' ] = array( 'display' => < TRUE | FALSE > ,
//                                              'link'  => array( 'href'   => '' ,
//                                                                'target' => '' ,
//                                                                'style'  => '' ,
//                                                                'class'  => '' 
//                                                              ) ,
//                                              'image' => array( 'src'    => '' ,
//                                                                'style'  => '' ,
//                                                                'class'  => ''
//                                                              )
//                                            ) ;


// Initialize:  $banner_display

if( ! isset( $banner_display ) )
{
    if( key_exists( 'display' , WAP_data::$G_DATA[ 'banner_data' ] ) )
    {
        if( WAP_data::$G_DATA[ 'banner_data' ][ 'display' ] === TRUE )
        {
            $param_vars[ 't_vars' ] = array( 'banner_display' => 'TRUE' ) ;
        }
        else
        {
            $param_vars[ 't_vars' ] = array( ) ;
        }
    }
}


// Initialize:  $banner_link_href

if( ! isset( $banner_link_href ) )
{
    if( key_exists( 'href' , WAP_data::$G_DATA[ 'banner_data' ][ 'link' ] ) )
    {
        $banner_link_href = WAP_data::$G_DATA[ 'banner_data' ][ 'link' ][ 'href' ] ;
    }
    else
    {
        $banner_link_href = $banner_link_href_initdata ;
    }
}


// Initialize:  $banner_link_style

if( ! isset( $banner_link_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'banner_data' ][ 'link' ] ) )
    {
        $banner_link_style = WAP_data::$G_DATA[ 'banner_data' ][ 'link' ][ 'style' ] ;
    }
    else
    {
        $banner_link_style = $banner_link_style_initdata ;
    }
}


// Initialize:  $banner_link_class

if( ! isset( $banner_link_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'banner_data' ][ 'link' ] ) )
    {
        $banner_link_class = WAP_data::$G_DATA[ 'banner_data' ][ 'link' ][ 'class' ] ;
    }
    else
    {
        $banner_link_class = $banner_link_class_initdata ;
    }
}


// Initialize:  $banner_link_target

if( ! isset( $banner_link_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'banner_data' ][ 'link' ] ) )
    {
        $banner_link_target = WAP_data::$G_DATA[ 'banner_data' ][ 'link' ][ 'target' ] ;
    }
    else
    {
        $banner_link_target = $banner_link_target_initdata ;
    }
}


// Initialize:  $banner_img_src

if( ! isset( $banner_img_src ) )
{
    if( key_exists( 'src' , WAP_data::$G_DATA[ 'banner_data' ][ 'image' ] ) )
    {
        $banner_img_src = WAP_data::$G_DATA[ 'banner_data' ][ 'image' ][ 'src' ] ;
    }
    else
    {
        $banner_img_src = $banner_img_src_initdata ;
    }
}


// Initialize:  $banner_img_style

if( ! isset( $banner_img_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'banner_data' ][ 'image' ] ) )
    {
        $banner_img_style = WAP_data::$G_DATA[ 'banner_data' ][ 'image' ][ 'style' ] ;
    }
    else
    {
        $banner_img_style = $banner_img_style_initdata ;
    }
}


// Initialize:  $banner_img_class

if( ! isset( $banner_img_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'banner_data' ][ 'image' ] ) )
    {
        $banner_img_class = WAP_data::$G_DATA[ 'banner_data' ][ 'image' ][ 'class' ] ;
    }
    else
    {
        $banner_img_class = $banner_img_class_initdata ;
    }
}


// Add the vars to the 't_vars' array on the $param_vars data structure

$param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                       array( 'banner_link_href'   => $banner_link_href ,
                                              'banner_link_style'  => $banner_link_style ,
                                              'banner_link_class'  => $banner_link_class ,
                                              'banner_link_target' => $banner_link_target ,
                                              'banner_img_src'     => $banner_img_src ,
                                              'banner_img_style'   => $banner_img_style ,
                                              'banner_img_class'   => $banner_img_class
                                            )
                                     ) ;


// Store the parameters in  WAP_data::$G_DATA[ 'view_data' ][ $element_name ]
WAP_data::$G_DATA[ 'view_data' ][ 'banner' ] = $param_vars ;
