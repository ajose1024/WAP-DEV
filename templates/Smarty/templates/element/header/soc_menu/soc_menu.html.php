<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// The  social menu  local PHP file


// Initialize the local variable  $param_vars  with an empty  parameter data
// structure

$param_vars = array( 't_vars' => array() ,
                     'r_vars' => array()
                   ) ;


// Local definition for template vars initial data

$soc_menu_display_initdata   = '' ;

$soc_menu_style_initdata     = '' ;
$soc_menu_class_initdata     = '' ;

$linkedin_href_initdata      = '' ;
$linkedin_style_initdata     = '' ;
$linkedin_class_initdata     = '' ;
$linkedin_target_initdata    = '' ;
$linkedin_img_style_initdata = '' ;
$linkedin_img_class_initdata = '' ;

$facebook_href_initdata      = '' ;
$facebook_style_initdata     = '' ;
$facebook_class_initdata     = '' ;
$facebook_target_initdata    = '' ;
$facebook_img_style_initdata = '' ;
$facebook_img_class_initdata = '' ;

$twitter_href_initdata       = '' ;
$twitter_style_initdata      = '' ;
$twitter_class_initdata      = '' ;
$twitter_target_initdata     = '' ;
$twitter_img_style_initdata  = '' ;
$twitter_img_class_initdata  = '' ;

$g_plus_href_initdata        = '' ;
$g_plus_style_initdata       = '' ;
$g_plus_class_initdata       = '' ;
$g_plus_target_initdata      = '' ;
$g_plus_img_style_initdata   = '' ;
$g_plus_img_class_initdata   = '' ;

$youtube_href_initdata       = '' ;
$youtube_style_initdata      = '' ;
$youtube_class_initdata      = '' ;
$youtube_target_initdata     = '' ;
$youtube_img_style_initdata  = '' ;
$youtube_img_class_initdata  = '' ;


// Initial data passed in:
//
//  WAP_data::$G_DATA[ 'soc_menu_data' ] = array( 'display'   => < TRUE | FALSE > ,
//                                                'soc_menu'  => array( 'style' => '' ,
//                                                                      'class' => '' 
//                                                                    ) ,
//                                                'linkedin'  => array( 'href'      => '' ,
//                                                                      'style'     => '' ,
//                                                                      'class'     => '' ,
//                                                                      'target'    => '' ,
//                                                                      'img_style' => '' ,
//                                                                      'img_class' => ''
//                                                                    ) ,
//                                                'facebook'  => array( 'href'      => '' ,
//                                                                      'style'     => '' ,
//                                                                      'class'     => '' ,
//                                                                      'target'    => '' ,
//                                                                      'img_style' => '' ,
//                                                                      'img_class' => ''
//                                                                    ) ,
//                                                'twitter'   => array( 'href'      => '' ,
//                                                                      'style'     => '' ,
//                                                                      'class'     => '' ,
//                                                                      'target'    => '' ,
//                                                                      'img_style' => '' ,
//                                                                      'img_class' => ''
//                                                                    ) ,
//                                                'g_plus'    => array( 'href'      => '' ,
//                                                                      'style'     => '' ,
//                                                                      'class'     => '' ,
//                                                                      'target'    => '' ,
//                                                                      'img_style' => '' ,
//                                                                      'img_class' => ''
//                                                                    ) ,
//                                                'youtube'   => array( 'href'      => '' ,
//                                                                      'style'     => '' ,
//                                                                      'class'     => '' ,
//                                                                      'target'    => '' ,
//                                                                      'img_style' => '' ,
//                                                                      'img_class' => ''
//                                                                    ) ,
//                                            ) ;

echo "++++---------------------------------------------------" ;
var_dump( WAP_data::$G_DATA ) ;
echo "++++---------------------------------------------------" ;


// Initialize:  $soc_menu_display

if( ! isset( $soc_menu_display ) )
{
    if( key_exists( 'display' , WAP_data::$G_DATA[ 'soc_menu_data' ] ) )
    {
        if( WAP_data::$G_DATA[ 'soc_menu_data' ][ 'display' ] === TRUE )
        {
            $param_vars[ 't_vars' ] = array( 'soc_menu_display' => 'TRUE' ) ;
        }
        else
        {
            $param_vars[ 't_vars' ] = array( ) ;
        }
    }
}


// -----------------------------------
// Initialize:  'soc_menu' DIV section
// -----------------------------------

// Initialize:  $soc_menu_style

if( ! isset( $soc_menu_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'soc_menu' ] ) )
    {
        $soc_menu_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'soc_menu' ][ 'style' ] ;
    }
    else
    {
        $soc_menu_style = $soc_menu_style_initdata ;
    }
}


// Initialize:  $soc_menu_class

if( ! isset( $soc_menu_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'soc_menu' ] ) )
    {
        $soc_menu_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'soc_menu' ][ 'class' ] ;
    }
    else
    {
        $soc_menu_class = $soc_menu_class_initdata ;
    }
}


// -----------------------------
// Initialize:  LinkedIN section
// -----------------------------

// Initialize:  $linkedin_href

if( ! isset( $linkedin_href ) )
{
    if( key_exists( 'href' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ] ) )
    {
        $linkedin_href = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ][ 'href' ] ;
    }
    else
    {
        $linkedin_href = $linkedin_href_initdata ;
    }
}


// Initialize:  $linkedin_style

if( ! isset( $linkedin_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ] ) )
    {
        $linkedin_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ][ 'style' ] ;
    }
    else
    {
        $linkedin_style = $linkedin_style_initdata ;
    }
}


// Initialize:  $linkedin_class

if( ! isset( $linkedin_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ] ) )
    {
        $linkedin_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ][ 'class' ] ;
    }
    else
    {
        $linkedin_class = $linkedin_class_initdata ;
    }
}


// Initialize:  $linkedin_target

if( ! isset( $linkedin_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ] ) )
    {
        $linkedin_target = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ][ 'target' ] ;
    }
    else
    {
        $linkedin_target = $linkedin_target_initdata ;
    }
}


// Initialize:  $linkedin_img_style

if( ! isset( $linkedin_img_style ) )
{
    if( key_exists( 'img_style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ] ) )
    {
        $linkedin_img_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ][ 'img_style' ] ;
    }
    else
    {
        $linkedin_img_style = $linkedin_img_style_initdata ;
    }
}


// Initialize:  $linkedin_img_style

if( ! isset( $linkedin_img_class ) )
{
    if( key_exists( 'img_class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ] ) )
    {
        $linkedin_img_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'linkedin' ][ 'img_class' ] ;
    }
    else
    {
        $linkedin_img_class = $linkedin_img_class_initdata ;
    }
}


// -----------------------------
// Initialize:  FaceBook section
// -----------------------------

// Initialize:  $facebook_href

if( ! isset( $facebook_href ) )
{
    if( key_exists( 'href' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ] ) )
    {
        $facebook_href = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ][ 'href' ] ;
    }
    else
    {
        $facebook_href = $facebook_href_initdata ;
    }
}


// Initialize:  $facebook_style

if( ! isset( $facebook_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ] ) )
    {
        $facebook_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ][ 'style' ] ;
    }
    else
    {
        $facebook_style = $facebook_style_initdata ;
    }
}


// Initialize:  $facebook_class

if( ! isset( $facebook_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ] ) )
    {
        $facebook_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ][ 'class' ] ;
    }
    else
    {
        $facebook_class = $facebook_class_initdata ;
    }
}


// Initialize:  $facebook_target

if( ! isset( $facebook_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ] ) )
    {
        $facebook_target = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ][ 'target' ] ;
    }
    else
    {
        $facebook_target = $facebook_target_initdata ;
    }
}


// Initialize:  $facebook_img_style

if( ! isset( $facebook_img_style ) )
{
    if( key_exists( 'img_style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ] ) )
    {
        $facebook_img_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ][ 'img_style' ] ;
    }
    else
    {
        $facebook_img_style = $facebook_img_style_initdata ;
    }
}


// Initialize:  $facebook_img_style

if( ! isset( $facebook_img_class ) )
{
    if( key_exists( 'img_class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ] ) )
    {
        $facebook_img_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'facebook' ][ 'img_class' ] ;
    }
    else
    {
        $facebook_img_class = $facebook_img_class_initdata ;
    }
}


// ----------------------------
// Initialize:  Twitter section
// ----------------------------

// Initialize:  $twitter_href

if( ! isset( $twitter_href ) )
{
    if( key_exists( 'href' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ] ) )
    {
        $twitter_href = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ][ 'href' ] ;
    }
    else
    {
        $twitter_href = $twitter_href_initdata ;
    }
}


// Initialize:  $twitter_style

if( ! isset( $twitter_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ] ) )
    {
        $twitter_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ][ 'style' ] ;
    }
    else
    {
        $twitter_style = $twitter_style_initdata ;
    }
}


// Initialize:  $twitter_class

if( ! isset( $twitter_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ] ) )
    {
        $twitter_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ][ 'class' ] ;
    }
    else
    {
        $twitter_class = $twitter_class_initdata ;
    }
}


// Initialize:  $twitter_target

if( ! isset( $twitter_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ] ) )
    {
        $twitter_target = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ][ 'target' ] ;
    }
    else
    {
        $twitter_target = $twitter_target_initdata ;
    }
}


// Initialize:  $twitter_img_style

if( ! isset( $twitter_img_style ) )
{
    if( key_exists( 'img_style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ] ) )
    {
        $twitter_img_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ][ 'img_style' ] ;
    }
    else
    {
        $twitter_img_style = $twitter_img_style_initdata ;
    }
}


// Initialize:  $twitter_img_style

if( ! isset( $twitter_img_class ) )
{
    if( key_exists( 'img_class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ] ) )
    {
        $twitter_img_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'twitter' ][ 'img_class' ] ;
    }
    else
    {
        $twitter_img_class = $twitter_img_class_initdata ;
    }
}


// ----------------------------
// Initialize:  Google+ section
// ----------------------------

// Initialize:  $g_plus_href

if( ! isset( $g_plus_href ) )
{
    if( key_exists( 'href' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ] ) )
    {
        $g_plus_href = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ][ 'href' ] ;
    }
    else
    {
        $g_plus_href = $g_plus_href_initdata ;
    }
}


// Initialize:  $g_plus_style

if( ! isset( $g_plus_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ] ) )
    {
        $g_plus_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ][ 'style' ] ;
    }
    else
    {
        $g_plus_style = $g_plus_style_initdata ;
    }
}


// Initialize:  $g_plus_class

if( ! isset( $g_plus_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ] ) )
    {
        $g_plus_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ][ 'class' ] ;
    }
    else
    {
        $g_plus_class = $g_plus_class_initdata ;
    }
}


// Initialize:  $g_plus_target

if( ! isset( $g_plus_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ] ) )
    {
        $g_plus_target = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ][ 'target' ] ;
    }
    else
    {
        $g_plus_target = $g_plus_target_initdata ;
    }
}


// Initialize:  $g_plus_img_style

if( ! isset( $g_plus_img_style ) )
{
    if( key_exists( 'img_style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ] ) )
    {
        $g_plus_img_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ][ 'img_style' ] ;
    }
    else
    {
        $g_plus_img_style = $g_plus_img_style_initdata ;
    }
}


// Initialize:  $g_plus_img_style

if( ! isset( $g_plus_img_class ) )
{
    if( key_exists( 'img_class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ] ) )
    {
        $g_plus_img_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'g_plus' ][ 'img_class' ] ;
    }
    else
    {
        $g_plus_img_class = $g_plus_img_class_initdata ;
    }
}


// -----------------------------
// Initialize:  YouTube section
// -----------------------------

// Initialize:  $youtube_href

if( ! isset( $youtube_href ) )
{
    if( key_exists( 'href' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ] ) )
    {
        $youtube_href = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ][ 'href' ] ;
    }
    else
    {
        $youtube_href = $youtube_href_initdata ;
    }
}


// Initialize:  $youtube_style

if( ! isset( $youtube_style ) )
{
    if( key_exists( 'style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ] ) )
    {
        $youtube_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ][ 'style' ] ;
    }
    else
    {
        $youtube_style = $youtube_style_initdata ;
    }
}


// Initialize:  $youtube_class

if( ! isset( $youtube_class ) )
{
    if( key_exists( 'class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ] ) )
    {
        $youtube_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ][ 'class' ] ;
    }
    else
    {
        $youtube_class = $youtube_class_initdata ;
    }
}


// Initialize:  $youtube_target

if( ! isset( $youtube_target ) )
{
    if( key_exists( 'target' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ] ) )
    {
        $youtube_target = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ][ 'target' ] ;
    }
    else
    {
        $youtube_target = $youtube_target_initdata ;
    }
}


// Initialize:  $youtube_img_style

if( ! isset( $youtube_img_style ) )
{
    if( key_exists( 'img_style' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ] ) )
    {
        $youtube_img_style = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ][ 'img_style' ] ;
    }
    else
    {
        $youtube_img_style = $youtube_img_style_initdata ;
    }
}


// Initialize:  $youtube_img_style

if( ! isset( $youtube_img_class ) )
{
    if( key_exists( 'img_class' , WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ] ) )
    {
        $youtube_img_class = WAP_data::$G_DATA[ 'soc_menu_data' ][ 'youtube' ][ 'img_class' ] ;
    }
    else
    {
        $youtube_img_class = $youtube_img_class_initdata ;
    }
}











// Add the vars to the 't_vars' array on the $param_vars data structure

$param_vars[ 't_vars' ] = array_merge( $param_vars[ 't_vars' ] ,
                                       array( 'soc_menu_style' => $soc_menu_style ,
                                              'soc_menu_class' => $soc_menu_class ,
                                              
                                              'linkedin_href'      => $linkedin_href ,
                                              'linkedin_style'     => $linkedin_style ,
                                              'linkedin_class'     => $linkedin_class ,
                                              'linkedin_target'    => $linkedin_target ,
                                              'linkedin_img_style' => $linkedin_img_style ,
                                              'linkedin_img_class' => $linkedin_img_class ,
                                           
                                              'facebook_href'      => $facebook_href ,
                                              'facebook_style'     => $facebook_style ,
                                              'facebook_class'     => $facebook_class ,
                                              'facebook_target'    => $facebook_target ,
                                              'facebook_img_style' => $facebook_img_style ,
                                              'facebook_img_class' => $facebook_img_class ,
                                           
                                              'twitter_href'       => $twitter_href ,
                                              'twitter_style'      => $twitter_style ,
                                              'twitter_class'      => $twitter_class ,
                                              'twitter_target'     => $twitter_target ,
                                              'twitter_img_style'  => $twitter_img_style ,
                                              'twitter_img_class'  => $twitter_img_class ,
                                           
                                              'g_plus_href'        => $g_plus_href ,
                                              'g_plus_style'       => $g_plus_style ,
                                              'g_plus_class'       => $g_plus_class ,
                                              'g_plus_target'      => $g_plus_target ,
                                              'g_plus_img_style'   => $g_plus_img_style ,
                                              'g_plus_img_class'   => $g_plus_img_class ,
                                           
                                              'youtube_href'       => $youtube_href ,
                                              'youtube_style'      => $youtube_style ,
                                              'youtube_class'      => $youtube_class ,
                                              'youtube_target'     => $youtube_target ,
                                              'youtube_img_style'  => $youtube_img_style ,
                                              'youtube_img_class'  => $youtube_img_class
                                            )
                                     ) ;

echo "????<hr>" ;
var_dump( $param_vars ) ;
echo "????<hr>" ;

// Store the parameters in  WAP_data::$G_DATA[ 'view_data' ][ $element_name ]
WAP_data::$G_DATA[ 'view_data' ][ 'soc_menu' ] = $param_vars ;
