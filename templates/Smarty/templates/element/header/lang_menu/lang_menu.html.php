<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// The  lang_menu  local PHP file


// Initialize the local variable  $param_vars  with an empty  parameter data
// structure

$param_vars = array( 't_vars' => array() ,
                     'r_vars' => array()
                   ) ;


// Local definition for template vars initial data

$lang_pt_pt_link_initdata       = '' ;
$lang_pt_pt_target_initdata     = '' ;
$lang_pt_pt_style_initdata      = '' ;
$lang_pt_pt_class_initdata      = '' ;

$lang_pt_pt_img_style_initdata  = '' ;
$lang_pt_pt_img_class_initdata  = '' ;

$lang_en_us_link_initdata       = '' ;
$lang_en_us_target_initdata     = '' ;
$lang_en_us_style_initdata      = '' ;
$lang_en_us_class_initdata      = '' ;

$lang_en_us_img_style_initdata  = '' ;
$lang_en_us_img_class_initdata  = '' ;

$lang_pt_br_link_initdata       = '' ;
$lang_pt_br_target_initdata     = '' ;
$lang_pt_br_style_initdata      = '' ;
$lang_pt_br_class_initdata      = '' ;

$lang_pt_br_img_style_initdata  = '' ;
$lang_pt_br_img_class_initdata  = '' ;


// Initial data passed in:
//
//  WAP_data::$G_DATA[ 'lang_menu_data' ] = array( 'lang_pt'  => array( 'href'      => '#' ,
//                                                                      'target'    => '' ,
//                                                                      'style'     => '' ,
//                                                                      'class'     => '' ,
//                                                                      'img_style' => '' ,
//                                                                      'img_class' => ''
//                                                                    ) ,
//                                                 'lang_us'  => array( 'href'      => '' ,
//                                                                      'target'    => '' ,
//                                                                      'style'     => '' ,
//                                                                      'class'     => '' ,
//                                                                      'img_style' => '' ,
//                                                                      'img_class' => ''
//                                                                    ) ,
//                                                 'lang_br'  => array( 'href'      => '' ,
//                                                                      'target'    => '' ,
//                                                                      'style'     => '' ,
//                                                                      'class'     => '' ,
//                                                                      'img_style' => '' ,
//                                                                      'img_class' => ''
//                                                                    )
//                                               ) ;


// ----------------
// Language:  PT-pt
// ----------------

// Initialize:  $lang_pt_pt_link

if( ! isset( $lang_pt_pt_link ) )
{
    if( key_exists( 'link' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ] ) )
    {
        $lang_pt_pt_link = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ][ 'link' ] ;
    }
    else
    {
        $lang_pt_pt_link = $lang_pt_pt_link_initdata ;
    }
}


// Initialize:  $lang_pt_pt_target

if( ! isset( $lang_pt_pt_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ] ) )
    {
        $lang_pt_pt_target = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ][ 'target' ] ;
    }
    else
    {
        $lang_pt_pt_target = $lang_pt_pt_target_initdata ;
    }
}


// Initialize:  $lang_pt_pt_style

if( ! isset( $lang_pt_pt_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ] ) )
    {
        $lang_pt_pt_style = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ][ 'style' ] ;
    }
    else
    {
        $lang_pt_pt_style = $lang_pt_pt_style_initdata ;
    }
}


// Initialize:  $lang_pt_pt_class

if( ! isset( $lang_pt_pt_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ] ) )
    {
        $lang_pt_pt_class = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ][ 'class' ] ;
    }
    else
    {
        $lang_pt_pt_class = $lang_pt_pt_class_initdata ;
    }
}


// Initialize:  $lang_pt_pt_img_style

if( ! isset( $lang_pt_pt_img_style ) )
{
    if( key_exists( 'img_style' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ] ) )
    {
        $lang_pt_pt_img_style = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ][ 'img_style' ] ;
    }
    else
    {
        $lang_pt_pt_img_style = $lang_pt_pt_img_style_initdata ;
    }
}


// Initialize:  $lang_pt_pt_img_style

if( ! isset( $lang_pt_pt_img_class ) )
{
    if( key_exists( 'img_class' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ] ) )
    {
        $lang_pt_pt_img_class = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_pt' ][ 'img_class' ] ;
    }
    else
    {
        $lang_pt_pt_img_class = $lang_pt_pt_img_class_initdata ;
    }
}


// ----------------
// Language:  EN-us
// ----------------

// Initialize:  $lang_en_us_link

if( ! isset( $lang_en_us_link ) )
{
    if( key_exists( 'link' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ] ) )
    {
        $lang_en_us_link = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ][ 'link' ] ;
    }
    else
    {
        $lang_en_us_link = $lang_en_us_link_initdata ;
    }
}


// Initialize:  $lang_en_us_target

if( ! isset( $lang_en_us_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ] ) )
    {
        $lang_en_us_target = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ][ 'target' ] ;
    }
    else
    {
        $lang_en_us_target = $lang_en_us_target_initdata ;
    }
}


// Initialize:  $lang_en_us_style

if( ! isset( $lang_en_us_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ] ) )
    {
        $lang_en_us_style = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ][ 'style' ] ;
    }
    else
    {
        $lang_en_us_style = $lang_en_us_style_initdata ;
    }
}


// Initialize:  $lang_en_us_class

if( ! isset( $lang_en_us_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ] ) )
    {
        $lang_en_us_class = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ][ 'class' ] ;
    }
    else
    {
        $lang_en_us_class = $lang_en_us_class_initdata ;
    }
}


// Initialize:  $lang_en_us_img_style

if( ! isset( $lang_en_us_img_style ) )
{
    if( key_exists( 'img_style' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ] ) )
    {
        $lang_en_us_img_style = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ][ 'img_style' ] ;
    }
    else
    {
        $lang_en_us_img_style = $lang_en_us_img_style_initdata ;
    }
}


// Initialize:  $lang_en_us_img_style

if( ! isset( $lang_en_us_img_class ) )
{
    if( key_exists( 'img_class' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ] ) )
    {
        $lang_en_us_img_class = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_us' ][ 'img_class' ] ;
    }
    else
    {
        $lang_en_us_img_class = $lang_en_us_img_class_initdata ;
    }
}


// ----------------
// Language:  PT-br
// ----------------

// Initialize:  $lang_pt_br_link

if( ! isset( $lang_pt_br_link ) )
{
    if( key_exists( 'link' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ] ) )
    {
        $lang_pt_br_link = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ][ 'link' ] ;
    }
    else
    {
        $lang_pt_br_link = $lang_pt_br_link_initdata ;
    }
}


// Initialize:  $lang_pt_br_target

if( ! isset( $lang_pt_br_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ] ) )
    {
        $lang_pt_br_target = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ][ 'target' ] ;
    }
    else
    {
        $lang_pt_br_target = $lang_pt_br_target_initdata ;
    }
}


// Initialize:  $lang_pt_br_style

if( ! isset( $lang_pt_br_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ] ) )
    {
        $lang_pt_br_style = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ][ 'style' ] ;
    }
    else
    {
        $lang_pt_br_style = $lang_pt_br_style_initdata ;
    }
}


// Initialize:  $lang_pt_br_class

if( ! isset( $lang_pt_br_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ] ) )
    {
        $lang_pt_br_class = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ][ 'class' ] ;
    }
    else
    {
        $lang_pt_br_class = $lang_pt_br_class_initdata ;
    }
}


// Initialize:  $lang_pt_br_img_style

if( ! isset( $lang_pt_br_img_style ) )
{
    if( key_exists( 'img_style' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ] ) )
    {
        $lang_pt_br_img_style = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ][ 'img_style' ] ;
    }
    else
    {
        $lang_pt_br_img_style = $lang_pt_br_img_style_initdata ;
    }
}


// Initialize:  $lang_pt_br_img_style

if( ! isset( $lang_pt_br_img_class ) )
{
    if( key_exists( 'img_class' , WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ] ) )
    {
        $lang_pt_br_img_class = WAP_data::$G_DATA[ 'lang_menu_data' ][ 'lang_br' ][ 'img_class' ] ;
    }
    else
    {
        $lang_pt_br_img_class = $lang_pt_br_img_class_initdata ;
    }
}


// Add the vars to the 't_vars' array on the $param_vars data structure

$param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                       array( 'lang_pt_pt_link'      => $lang_pt_pt_link ,
                                              'lang_pt_pt_target'    => $lang_pt_pt_target ,
                                              'lang_pt_pt_style'     => $lang_pt_pt_style ,
                                              'lang_pt_pt_class'     => $lang_pt_pt_class ,
                                              'lang_pt_pt_img_style' => $lang_pt_pt_img_style ,
                                              'lang_pt_pt_img_class' => $lang_pt_pt_img_class ,
                                           
                                              'lang_en_us_link'      => $lang_en_us_link ,
                                              'lang_en_us_target'    => $lang_en_us_target ,
                                              'lang_en_us_style'     => $lang_en_us_style ,
                                              'lang_en_us_class'     => $lang_en_us_class ,
                                              'lang_en_us_img_style' => $lang_en_us_img_style ,
                                              'lang_en_us_img_class' => $lang_en_us_img_class ,

                                              'lang_pt_br_link'      => $lang_pt_br_link ,
                                              'lang_pt_br_target'    => $lang_pt_br_target ,
                                              'lang_pt_br_style'     => $lang_pt_br_style ,
                                              'lang_pt_br_class'     => $lang_pt_br_class ,
                                              'lang_pt_br_img_style' => $lang_pt_br_img_style ,
                                              'lang_pt_br_img_class' => $lang_pt_br_img_class
                                            )
                                     ) ;

// Store the parameters in  WAP_data::$G_DATA[ 'view_data' ][ $element_name]
WAP_data::$G_DATA[ 'view_data' ][ 'lang_menu' ] = $param_vars ;



