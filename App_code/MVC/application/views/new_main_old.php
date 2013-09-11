<?php

// $file_to_include = $GLOBALS[ 'DOC_ROOT' ] . '/index.orig.php' ;

// include $file_to_include;

$data = array( 'background_1' => array( 'image' => '/clients/colombo_shopping_center/Centro_Comercial_Colombo_1.jpg' ,
                                        'mime-type' => 'image/jpg'
                                      ) ,
               'background_2' => array( 'image' => '/clients/colombo_shopping_center/Centro_Comercial_Colombo_2.jpg' ,
                                        'mime-type' => 'image/jpg'
                                      ) ,
               'background_3' => array( 'image' => '/clients/colombo_shopping_center/Centro_Comercial_Colombo_3.jpg' ,
                                        'mime-type' => 'image/jpg'
                                      ) ,
               'background_4' => array( 'image' => '/clients/colombo_shopping_center/Centro_Comercial_Colombo_4.jpg' ,
                                        'mime-type' => 'image/jpg'
                                      ) ,
               'background_5' => array( 'image' => '/clients/colombo_shopping_center/Centro_Comercial_Colombo_5.jpg' ,
                                        'mime-type' => 'image/jpg'
                                      ) ,
               'background_6' => array( 'image' => '/clients/colombo_shopping_center/Centro_Comercial_Colombo_6.jpg' ,
                                        'mime-type' => 'image/jpg'
                                      ) ,
               'background_7' => array( 'image' => '/clients/colombo_shopping_center/Centro_Comercial_Colombo_7.jpg' ,
                                        'mime-type' => 'image/jpg'
                                      ) ,
               'background_8' => array( 'image' => '/clients/colombo_shopping_center/Centro_Comercial_Colombo_8.jpg' ,
                                        'mime-type' => 'image/jpg'
                                      ) ,
               'background_9' => array( 'image' => '/clients/colombo_shopping_center/Centro_Comercial_Colombo_9.jpg' ,
                                        'mime-type' => 'image/jpg'
                                      )
              ) ;

// $body_data = '<pre>' . var_dump( get_object_vars( read_JSON_file( 'http://www.metalstone.pt/App_data/resources/images/background/background_images.json' , true ) ) ) . '</pre>' .
//              '<hr/>' . json_encode( $data )
        
$body_data = '' ;        
        ;


$smarty_obj = $GLOBALS[ 'smarty_obj' ] ;

// Instatialize the HEADER view

$smarty_obj->assign( 'header_style',    '' ) ;
$smarty_obj->assign( 'logo_style',      '' ) ;
$smarty_obj->assign( 'lang_menu_style', '' ) ;
$smarty_obj->assign( 'soc_menu_style',  '' ) ;
$smarty_obj->assign( 'nav_menu_style',  '' ) ;

$header_HTML = $smarty_obj->fetch( 'element/header.html.tpl' ) ;


$smarty_obj->assign( 'page_title', 'Develop Main Page' ) ;

$smarty_obj->assign( 'meta_data',  '<!-- META Data -->' . "\n\n" ) ;
$smarty_obj->assign( 'link_data',  '<!-- LINK Data -->' . "\n\n" ) ;
$smarty_obj->assign( 'style_data', '<!-- STYLE Data -->' . "\n\n" .
                                   '<link rel="stylesheet" href="/templates/Smarty/templates/element/header.html.css" />'
                   ) ;
$smarty_obj->assign( 'scripts',    '<!-- SCRIPTS -->' . "\n\n" ) ;
$smarty_obj->assign( 'header',     '<!-- Page HEADER -->' . "\n" .
                                        $header_HTML . "\n\n"
                   ) ;
$smarty_obj->assign( 'display',    '<!-- Page DISPLAY section -->' . "\n\n" ) ;
$smarty_obj->assign( 'body',       '<!-- Page BODY -->' . "\n\n" .
                        $body_data
                   ) ;
$smarty_obj->assign( 'footer',     '<!-- Page FOOTER -->' . "\n\n" ) ;

$smarty_obj->display( 'layout/main_page.html.tpl') ;