<?php
//    include "/home/dns/public_html/index.orig.php" ;

// var_dump( $GLOBALS ) ;

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
$smarty_obj->assign( 'style_data', '<!-- STYLE Data -->' . "\n\n" ) ;
$smarty_obj->assign( 'scripts',    '<!-- SCRIPTS -->' . "\n\n" ) ;
$smarty_obj->assign( 'header',     '<!-- Page HEADER -->' . "\n" .
                                        $header_HTML . "\n\n"
                   ) ;
$smarty_obj->assign( 'body',       '<!-- Page BODY -->' . "\n\n" ) ;
$smarty_obj->assign( 'footer',     '<!-- Page FOOTER -->' . "\n\n" ) ;

$smarty_obj->display( 'layout/main_page.html.tpl') ;