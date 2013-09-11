<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// The  header  local PHP file

// Initialize the local variable  $param_vars  with an empty  parameter data
// structure

$param_vars = array( 't_vars' => array() ,
                     'r_vars' => array()
                   ) ;


// Local definition for template vars initial data

$header_style_initdata = '' ;
$header_class_initdata = '' ;

$logo_style_initdata = '' ;
$logo_class_initdata = '' ;

$banner_style_initdata = '' ;
$banner_class_initdata = '' ;

$lang_menu_style_initdata = '' ;
$lang_menu_class_initdata = '' ;

$soc_menu_style_initdata = '' ;
$soc_menu_class_initdata = '' ;

$nav_menu_style_initdata = '' ;
$nav_menu_style_initdata = '' ;


// Initial data passed in:
//
//  WAP_data::$G_DATA[ 'header_data' ] = array( 'header'    => array( 'style'  => '' ,
//                                                                    'class'  => '' 
//                                                                  ) ,
//                                              'logo'      => array( 'style'  => '' ,
//                                                                    'class'  => '' 
//                                                                  ) ,
//                                              'banner'    => array( 'style'  => '' ,
//                                                                    'class'  => '' 
//                                                                  ) ,
//                                              'lang_menu' => array( 'style'  => '' ,
//                                                                    'class'  => '' 
//                                                                  ) ,
//                                              'soc_menu'  => array( 'style'  => '' ,
//                                                                    'class'  => '' 
//                                                                  ) ,
//                                              'nav_menu'  => array( 'style'  => '' ,
//                                                                    'class'  => '' 
//                                                                  ) ,
//                                          ) ;

// --------------------------------------------
// Initialize:  HEADER style & class properties
// --------------------------------------------

// Initialize:  $header_style

if( ! isset( $header_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'header_data' ][ 'header' ] ) )
    {
        $header_style = WAP_data::$G_DATA[ 'header_data' ][ 'header' ][ 'style' ] ;
    }
    else
    {
        $header_style = $header_style_initdata ;
    }
}


// Initialize:  $header_class

if( ! isset( $header_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'header_data' ][ 'header' ] ) )
    {
        $header_class = WAP_data::$G_DATA[ 'header_data' ][ 'header' ][ 'class' ] ;
    }
    else
    {
        $header_class = $header_class_initdata ;
    }
}


// ------------------------------------------
// Initialize:  LOGO style & class properties
// ------------------------------------------

// Initialize:  $logo_style

if( ! isset( $logo_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'header_data' ][ 'logo' ] ) )
    {
        $logo_style = WAP_data::$G_DATA[ 'header_data' ][ 'logo' ][ 'style' ] ;
    }
    else
    {
        $logo_style = $logo_style_initdata ;
    }
}


// Initialize:  $logo_class

if( ! isset( $logo_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'header_data' ][ 'logo' ] ) )
    {
        $logo_class = WAP_data::$G_DATA[ 'header_data' ][ 'logo' ][ 'class' ] ;
    }
    else
    {
        $logo_class = $logo_class_initdata ;
    }
}


// --------------------------------------------
// Initialize:  BANNER style & class properties
// --------------------------------------------

// Initialize:  $banner_style

if( ! isset( $banner_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'header_data' ][ 'banner' ] ) )
    {
        $banner_style = WAP_data::$G_DATA[ 'header_data' ][ 'banner' ][ 'style' ] ;
    }
    else
    {
        $banner_style = $banner_style_initdata ;
    }
}


// Initialize:  $banner_class

if( ! isset( $banner_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'header_data' ][ 'banner' ] ) )
    {
        $banner_class = WAP_data::$G_DATA[ 'header_data' ][ 'banner' ][ 'class' ] ;
    }
    else
    {
        $banner_class = $banner_class_initdata ;
    }
}


// -----------------------------------------------
// Initialize:  LANG_MENU style & class properties
// -----------------------------------------------

// Initialize:  $lang_menu_style

if( ! isset( $lang_menu_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'header_data' ][ 'lang_menu' ] ) )
    {
        $lang_menu_style = WAP_data::$G_DATA[ 'header_data' ][ 'lang_menu' ][ 'style' ] ;
    }
    else
    {
        $lang_menu_style = $lang_menu_style_initdata ;
    }
}


// Initialize:  $lang_menu_class

if( ! isset( $lang_menu_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'header_data' ][ 'lang_menu' ] ) )
    {
        $lang_menu_class = WAP_data::$G_DATA[ 'header_data' ][ 'lang_menu' ][ 'class' ] ;
    }
    else
    {
        $lang_menu_class = $lang_menu_class_initdata ;
    }
}


// ----------------------------------------------
// Initialize:  SOC_MENU style & class properties
// ----------------------------------------------

// Initialize:  $soc_menu_style

if( ! isset( $soc_menu_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'header_data' ][ 'soc_menu' ] ) )
    {
        $soc_menu_style = WAP_data::$G_DATA[ 'header_data' ][ 'soc_menu' ][ 'style' ] ;
    }
    else
    {
        $soc_menu_style = $soc_menu_style_initdata ;
    }
}


// Initialize:  $soc_menu_class

if( ! isset( $soc_menu_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'header_data' ][ 'soc_menu' ] ) )
    {
        $soc_menu_class = WAP_data::$G_DATA[ 'header_data' ][ 'soc_menu' ][ 'class' ] ;
    }
    else
    {
        $soc_menu_class = $soc_menu_class_initdata ;
    }
}


// ----------------------------------------------
// Initialize:  NAV_MENU style & class properties
// ----------------------------------------------

// Initialize:  $nav_menu_style

if( ! isset( $nav_menu_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'header_data' ][ 'nav_menu' ] ) )
    {
        $nav_menu_style = WAP_data::$G_DATA[ 'header_data' ][ 'nav_menu' ][ 'style' ] ;
    }
    else
    {
        $nav_menu_style = $nav_menu_style_initdata ;
    }
}


// Initialize:  $nav_menu_class

if( ! isset( $nav_menu_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'header_data' ][ 'nav_menu' ] ) )
    {
        $nav_menu_class = WAP_data::$G_DATA[ 'header_data' ][ 'nav_menu' ][ 'class' ] ;
    }
    else
    {
        $nav_menu_class = $nav_menu_class_initdata ;
    }
}


// Add the vars to the 't_vars' array on the $param_vars data structure

$param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                       array( 'header_style' => $header_style ,
                                              'header_class' => $header_class ,
                                              'logo_style' => $logo_style ,
                                              'logo_class' => $logo_class ,
                                              'banner_style' => $banner_style ,
                                              'banner_class' => $banner_class ,
                                              'lang_menu_style' => $lang_menu_style ,
                                              'lang_menu_class' => $lang_menu_class ,
                                              'soc_menu_style' => $soc_menu_style ,
                                              'soc_menu_class' => $soc_menu_class ,
                                              'nav_menu_style' => $nav_menu_style ,
                                              'nav_menu_class' => $nav_menu_class
                                            )
                                     ) ;


// Store the parameters in  WAP_data::$G_DATA[ 'view_data' ][ $element_name]
WAP_data::$G_DATA[ 'view_data' ][ 'header' ] = $param_vars ;
