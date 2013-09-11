<?php


$render_order = array( ) ;

function element_push( $view_element )
{
    $render_order_count = array_push( $render_order , $view_element ) ;
}


function element_pop( )
{
    return  array_pop( $view_element ) ;
} 

$render_order = array(  'level-1' => array( 'main_page' ),
                        'level-2' => array( 'header',
                                            'display',
                                            'body',
                                            'footer'
                                          ) ,
                        'level-3' => array( 'logo' ,
                                            'banner' ,
                                            'lang_menu' ,
                                            'soc_menu' ,
                                            'nav_menu' ,
                                            'display_21'
                                          ) ,
                     ) ;