<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;

// Main Page Layout
$page_title = "Main Page" ;
$meta_data  = "<!--META Section -->\n" ;
$link_data  = "<!--LINK Section -->\n" ;
$style_data = "<!--STYLE Section -->\n" ;
$scripts    = "<!--SCRIPTS Section -->\n" ;


// Header Element
$header_style       = '' ;
$header_class       = '' ;
$logo_style         = '' ;
$logo_class         = '' ;
$banner_style       = '' ;
$banner_class       = '' ;
$lang_menu_style    = '' ;
$lang_menu_class    = '' ;
$soc_menu_style     = '' ;
$soc_menu_class     = '' ;
$nav_menu_style     = '' ;
$nav_menu_class     = '' ;


// Logo Element
$logo_link_href   = '' ;
$logo_link_style  = '' ;
$logo_link_class  = '' ;
$logo_link_target = '' ;
$logo_img_style   = '' ;
$logo_img_class   = '' ;

// Lang Menu Element
$lang_pt_pt_link    = '' ;
$lang_pt_pt_target  = '' ;
$lang_en_us_link    = '' ;
$lang_en_us_target  = '' ;
$lang_pt_br_link    = '' ;
$lang_pt_br_target  = '' ;


// Display Element
$display_class          = '' ;
$display_style          = '' ;
$display_whole_class    = '' ;
$display_whole_style    = '' ;
$display_left_class     = '' ;
$display_left_style     = '' ;
$display_middle_class   = '' ;
$display_middle_style   = '' ;
$display_right_class    = '' ;
$display_right_style    = '' ;
$display_left_content   = '' ;
$display_middle_content = '' ;
$display_right_content  = '' ;

$body_class_1   = '' ;
$body_style_1   = '' ;
$body_class_2   = '' ;
$body_style_2   = '' ;
$body_class_3   = '' ;
$body_style_3   = '' ;
$body_class_4   = '' ;
$body_style_4   = '' ;
$body_class_5   = '' ;
$body_style_5   = '' ;

$body_1_class     = '' ;
$body_1_style     = '' ;
$body_1_href_1    = '' ;
$body_1_class_1   = '' ;
$body_1_style_1   = '' ;
$body_1_target_1  = '' ;
$body_1_img_src   = '' ;
$body_1_img_class = '' ;
$body_1_img_style = '' ;
$body_1_href_2    = '' ;
$body_1_class_2   = '' ;
$body_1_style_2   = '' ;
$body_1_target_2  = '' ;
$body_1_text      = '' ;

$body_2_class     = '' ;
$body_2_style     = '' ;
$body_2_href_1    = '' ;
$body_2_class_1   = '' ;
$body_2_style_1   = '' ;
$body_2_target_1  = '' ;
$body_2_img_src   = '' ;
$body_2_img_class = '' ;
$body_2_img_style = '' ;
$body_2_href_2    = '' ;
$body_2_class_2   = '' ;
$body_2_style_2   = '' ;
$body_2_target_2  = '' ;
$body_2_text      = '' ;

$body_3_class     = '' ;
$body_3_style     = '' ;
$body_3_href_1    = '' ;
$body_3_class_1   = '' ;
$body_3_style_1   = '' ;
$body_3_target_1  = '' ;
$body_3_img_src   = '' ;
$body_3_img_class = '' ;
$body_3_img_style = '' ;
$body_3_href_2    = '' ;
$body_3_class_2   = '' ;
$body_3_style_2   = '' ;
$body_3_target_2  = '' ;
$body_3_text      = '' ;

$body_4_class     = '' ;
$body_4_style     = '' ;
$body_4_href_1    = '' ;
$body_4_class_1   = '' ;
$body_4_style_1   = '' ;
$body_4_target_1  = '' ;
$body_4_img_src   = '' ;
$body_4_img_class = '' ;
$body_4_img_style = '' ;
$body_4_href_2    = '' ;
$body_4_class_2   = '' ;
$body_4_style_2   = '' ;
$body_4_target_2  = '' ;
$body_4_text      = '' ;

$body_5_class     = '' ;
$body_5_style     = '' ;
$body_5_href_1    = '' ;
$body_5_class_1   = '' ;
$body_5_style_1   = '' ;
$body_5_target_1  = '' ;
$body_5_img_src   = '' ;
$body_5_img_class = '' ;
$body_5_img_style = '' ;
$body_5_href_2    = '' ;
$body_5_class_2   = '' ;
$body_5_style_2   = '' ;
$body_5_target_2  = '' ;
$body_5_text      = '' ;


// --------------------------------
// Element:  'header'  initial data
// --------------------------------

WAP_data::$G_DATA[ 'header_data' ] = array( 'header'    => array( 'style'  => '' ,
                                                                  'class'  => '' 
                                                                ) ,
                                            'logo'      => array( 'style'  => '' ,
                                                                  'class'  => '' 
                                                                ) ,
                                            'banner'    => array( 'style'  => '' ,
                                                                  'class'  => '' 
                                                                ) ,
                                            'lang_menu' => array( 'style'  => '' ,
                                                                  'class'  => '' 
                                                                ) ,
                                            'soc_menu'  => array( 'style'  => '' ,
                                                                  'class'  => '' 
                                                                ) ,
                                            'nav_menu'  => array( 'style'  => '' ,
                                                                  'class'  => '' 
                                                                ) ,
                                        ) ;


// ------------------------------
// Element:  'logo'  initial data
// ------------------------------

WAP_data::$G_DATA[ 'logo_data' ] = array( 'link'  => array( 'href'   => '' ,
                                                            'target' => '' ,
                                                            'style'  => '' ,
                                                            'class'  => '' 
                                                          ) ,
                                          'image' => array( 'style'  => '' ,
                                                            'class'  => ''
                                          )
                                        ) ;


// --------------------------------
// Element:  'banner'  initial data
// --------------------------------

WAP_data::$G_DATA[ 'banner_data' ] = array( 'display' => TRUE ,
                                            'link'  => array( 'href'   => 'http://www.google.com' ,
                                                              'target' => '_blank' ,
                                                              'style'  => '' ,
                                                              'class'  => '' 
                                                            ) ,
                                            'image' => array( 'src'    => '/@pics/banners/banner.jpg' ,
                                                              'style'  => '' ,
                                                              'class'  => ''
                                                            )
                                          ) ;


// -----------------------------------
// Element:  'lang_menu'  initial data
// -----------------------------------

WAP_data::$G_DATA[ 'lang_menu_data' ] = array( 'lang_pt'  => array( 'href'      => '#' ,
                                                                    'target'    => '' ,
                                                                    'style'     => '' ,
                                                                    'class'     => '' ,
                                                                    'img_style' => 'width:28px ; height: 18px ;' ,
                                                                    'img_class' => ''
                                                                  ) ,
                                               'lang_us'  => array( 'href'      => '#' ,
                                                                    'target'    => '' ,
                                                                    'style'     => '' ,
                                                                    'class'     => '' ,
                                                                    'img_style' => 'width:28px ; height: 18px ;' ,
                                                                    'img_class' => ''
                                                                  ) ,
                                               'lang_br'  => array( 'href'      => '#' ,
                                                                    'target'    => '' ,
                                                                    'style'     => '' ,
                                                                    'class'     => '' ,
                                                                    'img_style' => 'width:28px ; height: 18px ;' ,
                                                                    'img_class' => ''
                                                                  )
                                             ) ;


// ----------------------------------
// Element:  'soc_menu'  initial data
// 
// ----------------------------------
WAP_data::$G_DATA[ 'soc_menu_data' ] = array( 'display'   => TRUE ,
                                              'soc_menu'  => array( 'style' => '' ,
                                                                    'class' => '' 
                                                                  ) ,
                                              'linkedin'  => array( 'href'      => 'http://www.linkedin.com' ,
                                                                    'style'     => '' ,
                                                                    'class'     => '' ,
                                                                    'target'    => '_blank' ,
                                                                    'img_style' => '' ,
                                                                    'img_class' => ''
                                                                  ) ,
                                              'facebook'  => array( 'href'      => 'http://www.facebook.com' ,
                                                                    'style'     => '' ,
                                                                    'class'     => '' ,
                                                                    'target'    => '_blank' ,
                                                                    'img_style' => '' ,
                                                                    'img_class' => ''
                                                                  ) ,
                                              'twitter'   => array( 'href'      => 'http://www.twitter.com' ,
                                                                    'style'     => '' ,
                                                                    'class'     => '' ,
                                                                    'target'    => '_blank' ,
                                                                    'img_style' => '' ,
                                                                    'img_class' => ''
                                                                  ) ,
                                              'g_plus'    => array( 'href'      => 'http://plus.google.com' ,
                                                                    'style'     => '' ,
                                                                    'class'     => '' ,
                                                                    'target'    => '_blank' ,
                                                                    'img_style' => '' ,
                                                                    'img_class' => ''
                                                                  ) ,
                                              'youtube'   => array( 'href'      => 'http://www.youtube.com' ,
                                                                    'style'     => '' ,
                                                                    'class'     => '' ,
                                                                    'target'    => '_blank' ,
                                                                    'img_style' => '' ,
                                                                    'img_class' => ''
                                                                  ) ,
                                            ) ;


// ----------------------------------
// Element:  'nav_menu'  initial data
// ----------------------------------

WAP_data::$G_DATA[ 'nav_menu_data' ] = array( 'date'      => date( 'D, d M Y H:i:s' ) ,
                                              'nr_items'  => 10 ,
                                              '1'         => array( 'href'   => '#' ,
                                                                    'target' => '' ,
                                                                    'class'  => 'current' ,
                                                                    'data'   => 'A Metalstone'
                                                                  ) ,
                                              '2'         => array( 'href'   => '#' ,
                                                                    'target' => '' ,
                                                                    'class'  => '' ,
                                                                    'data'   => 'O que fazemos'
                                                                  ) ,
                                              '3'         => array( 'href'   => '#' ,
                                                                    'target' => '' ,
                                                                    'class'  => '' ,
                                                                    'data'   => 'Clientes'
                                                                  ) ,
                                              '4'         => array( 'href'   => '#' ,
                                                                    'target' => '' ,
                                                                    'class'  => '' ,
                                                                    'data'   => 'Portfólio'
                                                                  ) ,
                                              '5'         => array( 'href'   => '#' ,
                                                                    'target' => '' ,
                                                                    'class'  => '' ,
                                                                    'data'   => 'Parceiros'
                                                                  ) ,
                                              '6'         => array( 'href'   => '#' ,
                                                                    'target' => '' ,
                                                                    'class'  => '' ,
                                                                    'data'   => 'Links'
                                                                  ) ,
                                              '7'         => array( 'href'   => '#' ,
                                                                    'target' => '' ,
                                                                    'class'  => '' ,
                                                                    'data'   => 'Onde estamos'
                                                                  ) ,

                                            ) ;


// var_dump( WAP_data::$G_DATA[ 'nav_menu_data' ] ) ;


// --------------
// PAGE STRUCTURE
// --------------

// main_page --> | header -->  | logo
//               |             | banner
//               |             | lang_menu
//               |             | soc_menu
//               |             | nav_menu
//               |
//               | display --> | display_111, display_12, display_21, display_3
//               |
//               | body -->    | body_1
//               |             | body_2
//               |             | body_3
//               |             | body_4
//               |             | body_5
//               |
//               | footer


WAP::set_view_structure( array( 
                                // Page Layout --> main_page (1st level)
                                'main_page' =>    array( 'template'  => 'layout/main_page/main_page.html' ,
                                                         'type'      => 'layout' ,
                                                         'parent'    => null ,
                                                         'children'  => array( 'header' ,
                                                                               'display' ,
                                                                               'body' ,
                                                                               'footer'
                                                                             ) ,
                                                         't_vars'    => array( 'page_title'  => $page_title ,
                                                                               'meta_data'   => $meta_data ,
                                                                               'link_data'   => $link_data ,
                                                                               'style_data'  => $style_data ,
                                                                               'scripts'     => $scripts
                                                                             ) ,
                                                         'r_vars'    => array( 'header_data'  => 'header|Element|HTML' ,
                                                                               'display_data' => 'display|Element|HTML' ,
                                                                               'body_data'    => 'body|Element|HTML' ,
                                                                               'footer_data'  => 'footer|Element|HTML'
                                                                             ) ,
                                                         'output'    => null
                                                       ) ,

                                // Element --> header (2nd level)
                                'header' =>       array( 'template'  => 'element/header/header.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'main_page' ) ,
                                                         'children'  => array( 'logo' ,
                                                                               'banner' ,
                                                                               'lang_menu' ,
                                                                               'soc_menu' ,
                                                                               'nav_menu'
                                                                             ) ,
                                                         't_vars'    => '%%INBUILT%%|header_data' ,
                                                         'r_vars'    => array( 'logo_data'      => 'logo_data|element|HTML' ,
                                                                               'banner_data'    => 'banner_data|element|HTML' ,
                                                                               'lang_menu_data' => 'lang_menu_data|element|HTML' ,
                                                                               'soc_menu_data'  => 'soc_menu_data|element|HTML' ,
                                                                               'nav_menu_data'  => 'nav_menu_data|element|HTML' ,
                                                                             ) ,
                                                         'output'    => array( 'main_page'   => 'header_data' )
                                                       ) ,

                                // Element --> display (2nd level)
                                'display' =>      array( 'template'  => 'element/display/display.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'main_page' ) ,
                                                         'children'  => array( 'display_21' ) ,
                                                         't_vars'    => array( 'display_class' => $display_class ,
                                                                               'display_style' => $display_style
                                                                             ) ,
                                                         'r_vars'    => array( 'display_content' => 'display_21|element|HTML' ,
                                                                               'display_3_content'   => 'display_3|element|HTML' ,
                                                                               'display_21_content'  => 'display_21|element|HTML' ,
                                                                               'display_12_content'  => 'display_12|element|HTML' ,
                                                                               'display_111_content' => 'display_111|element|HTML'
                                                                             ) ,
                                                         'output'    => array( 'main_page'   => 'display_data' )
                                                       ) ,

                                // Element --> body (3nd level)
                                'body' =>         array( 'template'  => 'element/body/body.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'main_page' ) ,
                                                         'children'  => array( 'body_1' ,
                                                                               'body_2' ,
                                                                               'body_3' ,
                                                                               'body_4' ,
                                                                               'body_5'
                                                                             ) ,
                                                         't_vars'    => array( 'body_class_1' => $body_class_1 ,
                                                                               'body_style_1' => $body_style_1 ,
                                                                               'body_class_2' => $body_class_2 ,
                                                                               'body_style_2' => $body_style_2 ,
                                                                               'body_class_3' => $body_class_3 ,
                                                                               'body_style_3' => $body_style_3 ,
                                                                               'body_class_4' => $body_class_4 ,
                                                                               'body_style_4' => $body_style_4 ,
                                                                               'body_class_5' => $body_class_5 ,
                                                                               'body_style_5' => $body_style_5
                                                                             ) ,
                                                         'r_vars'    => array( 'body_content_1' => 'body_1|element|HTML' ,
                                                                               'body_content_2' => 'body_2|element|HTML' ,
                                                                               'body_content_3' => 'body_3|element|HTML' ,
                                                                               'body_content_4' => 'body_4|element|HTML' ,
                                                                               'body_content_5' => 'body_5|element|HTML'
                                                                             ) ,
                                                         'output'    => array( 'main_page' => 'body_data' )
                                                       ) ,

                                // Element --> footer (2nd level)
                                'footer' =>       array( 'template'  => 'element/footer/footer.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'main_page' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array(
                                                                             ) ,
                                                         'r_vars'    => null ,
                                                         'output'    => array( 'main_page' => 'footer_data' )
                                                       ) ,

                                // Element --> logo (3nd level)
                                'logo' =>         array( 'template'  => 'element/header/logo/logo.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'header' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'logo_link_href'   => $logo_link_href ,
                                                                               'logo_link_style'  => $logo_link_style ,
                                                                               'logo_link_class'  => $logo_link_class ,
                                                                               'logo_link_target' => $logo_link_target ,
                                                                               'logo_img_style'   => $logo_img_style ,
                                                                               'logo_img_class'   => $logo_img_class
                                                                             ) ,
                                                         'r_vars'    => null ,
                                                         'output'    => array( 'header' => 'logo_data' )
                                                       ) ,

                                // Element --> banner (3nd level)  [ main_page --> header --> banner ]
                                'banner' =>       array( 'template'  => 'element/header/banner/banner.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'header' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => '%%INBUILT%%|banner_data' ,
                                                         'r_vars'    => null ,
                                                         'output'    => array( 'header' => 'banner_data' )
                                                       ) ,

                                // Element --> lang_menu (3nd level)
                                'lang_menu' =>    array( 'template'  => 'element/header/lang_menu/lang_menu.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'header' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => '%%INBUILT%%|lang_menu_data' ,
                                                         'r_vars'    => null ,
                                                         'output'    => array( 'header' => 'lang_menu_data' )
                                                       ) ,

                                // Element --> soc_menu (3nd level)
                                'soc_menu' =>     array( 'template'  => 'element/header/soc_menu/soc_menu.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'header' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => '%%INBUILT%%|soc_menu_data' ,
                                                         'r_vars'    => null ,
                                                         'output'    => array( 'header' => 'soc_menu_data' )
                                                       ) ,

                                // Element --> nav_menu (3nd level)
                                'nav_menu' =>     array( 'template'  => 'element/header/nav_menu/nav_menu.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'header' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => '%%INBUILT%%|nav_menu_data' ,
                                                         'r_vars'    => null ,
                                                         'output'    => array( 'header' => 'nav_menu_data' )
                                                       ) ,

                                // Element --> display_3 (3nd level)
                                'display_3' =>    array( 'template'  => 'element/display/display_3/display_3.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'display' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'display_whole_class'  => $display_whole_class ,
                                                                               'display_whole_style'  => $display_whole_style
                                                                             ) ,
                                                         'r_vars'    => array( 'display_whole_content' => 'display_3|element|HTML'
                                                                             ) ,
                                                         'output'    => array( 'display' => 'display_3_content' )
                                                       ) ,

                                // Element --> display_21 (3nd level)
                                'display_21' =>   array( 'template'  => 'element/display/display_21/display_21.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'display' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'display_left_class'  => $display_left_class ,
                                                                               'display_left_style'  => $display_left_style ,
                                                                               'display_right_class' => $display_right_class ,
                                                                               'display_right_style' => $display_right_style
                                                                             ) ,
                                                         'r_vars'    => array( 'display_left_content'  => $display_left_content ,
                                                                               'display_right_content' => $display_right_content
                                                                             ) ,
                                                         'output'    => array( 'display' => 'display_21_content' )
                                                       ) ,

                                // Element --> display_12 (3nd level)
                                'display_12' =>   array( 'template'  => 'element/display/display_12/display_12.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'display' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'display_left_class'  => $display_left_class ,
                                                                               'display_left_style'  => $display_left_style ,
                                                                               'display_right_class' => $display_right_class ,
                                                                               'display_right_style' => $display_right_style
                                                                             ) ,
                                                         'r_vars'    => array( 'display_left_content'  => $display_left_content ,
                                                                               'display_right_content' => $display_right_content
                                                                             ) ,
                                                         'output'    => array( 'display' => 'display_12_content' )
                                                       ) ,

                                // Element --> display_111 (3nd level)
                                'display_111'  => array( 'template'  => 'element/display/display_111/display_111.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'display' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'display_left_class'   => $display_left_class ,
                                                                               'display_left_style'   => $display_left_style ,
                                                                               'display_middle_class' => $display_middle_class ,
                                                                               'display_middle_style' => $display_middle_style ,
                                                                               'display_right_class'  => $display_right_class ,
                                                                               'display_right_style'  => $display_right_style
                                                                             ) ,
                                                         'r_vars'    => array( 'display_left_content'   => $display_left_content ,
                                                                               'display_middle_content' => $display_middle_content ,
                                                                               'display_right_content'  => $display_right_content
                                                                             ) ,
                                                         'output'    => array( 'display' => 'display_111_content' )
                                                       ) ,

                                // Element --> body_1 (3nd level)
                                'body_1' =>       array( 'template'  => 'element/body/body_1/body_1.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'body' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'body_1_class'       =>  $body_1_class ,
                                                                               'body_1_style'       =>  $body_1_style ,
                                                                               'body_1_href_1'      =>  $body_1_href_1 ,
                                                                               'body_1_class_1'     =>  $body_1_class_1 ,
                                                                               'body_1_style_1'     =>  $body_1_style_1 ,
                                                                               'body_1_target_1'    =>  $body_1_target_1 ,
                                                                               'body_1_img_src'     =>  $body_1_img_src ,
                                                                               'body_1_img_class'   =>  $body_1_img_class ,
                                                                               'body_1_img_style'   =>  $body_1_img_style ,
                                                                               'body_1_href_2'      =>  $body_1_href_2 ,
                                                                               'body_1_class_2'     =>  $body_1_class_2 ,
                                                                               'body_1_style_2'     =>  $body_1_style_2 ,
                                                                               'body_1_target_2'    =>  $body_1_target_2 ,
                                                                               'body_1_text'        =>  $body_1_text
                                                                             ) ,
                                                         'r_vars'    => array( ) ,
                                                         'output'    => array( 'body' => 'body_content_1' )
                                                       ) ,

                                // Element --> body_2 (3nd level)
                                'body_2' =>       array( 'template'  => 'element/body/body_2/body_2.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'body' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'body_2_class'       =>  $body_2_class ,
                                                                               'body_2_style'       =>  $body_2_style ,
                                                                               'body_2_href_1'      =>  $body_2_href_1 ,
                                                                               'body_2_class_1'     =>  $body_2_class_1 ,
                                                                               'body_2_style_1'     =>  $body_2_style_1 ,
                                                                               'body_2_target_1'    =>  $body_2_target_1 ,
                                                                               'body_2_img_src'     =>  $body_2_img_src ,
                                                                               'body_2_img_class'   =>  $body_2_img_class ,
                                                                               'body_2_img_style'   =>  $body_2_img_style ,
                                                                               'body_2_href_2'      =>  $body_2_href_2 ,
                                                                               'body_2_class_2'     =>  $body_2_class_2 ,
                                                                               'body_2_style_2'     =>  $body_2_style_2 ,
                                                                               'body_2_target_2'    =>  $body_2_target_2 ,
                                                                               'body_2_text'        =>  $body_2_text
                                                                             ) ,
                                                         'r_vars'    => array( ) ,
                                                         'output'    => array( 'body' => 'body_content_2' )
                                                       ) ,

                                // Element --> body_3 (3nd level)
                                'body_3' =>       array( 'template'  => 'element/body/body_3/body_3.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'body' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'body_3_class'       =>  $body_3_class ,
                                                                               'body_3_style'       =>  $body_3_style ,
                                                                               'body_3_href_1'      =>  $body_3_href_1 ,
                                                                               'body_3_class_1'     =>  $body_3_class_1 ,
                                                                               'body_3_style_1'     =>  $body_3_style_1 ,
                                                                               'body_3_target_1'    =>  $body_3_target_1 ,
                                                                               'body_3_img_src'     =>  $body_3_img_src ,
                                                                               'body_3_img_class'   =>  $body_3_img_class ,
                                                                               'body_3_img_style'   =>  $body_3_img_style ,
                                                                               'body_3_href_2'      =>  $body_3_href_2 ,
                                                                               'body_3_class_2'     =>  $body_3_class_2 ,
                                                                               'body_3_style_2'     =>  $body_3_style_2 ,
                                                                               'body_3_target_2'    =>  $body_3_target_2 ,
                                                                               'body_3_text'        =>  $body_3_text
                                                                             ) ,
                                                         'r_vars'    => array( ) ,
                                                         'output'    => array( 'body' => 'body_content_3' )
                                                       ) ,

                                // Element --> body_4 (3nd level)
                                'body_4' =>       array( 'template'  => 'element/body/body_4/body_4.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'body' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'body_4_class'       =>  $body_4_class ,
                                                                               'body_4_style'       =>  $body_4_style ,
                                                                               'body_4_href_1'      =>  $body_4_href_1 ,
                                                                               'body_4_class_1'     =>  $body_4_class_1 ,
                                                                               'body_4_style_1'     =>  $body_4_style_1 ,
                                                                               'body_4_target_1'    =>  $body_4_target_1 ,
                                                                               'body_4_img_src'     =>  $body_4_img_src ,
                                                                               'body_4_img_class'   =>  $body_4_img_class ,
                                                                               'body_4_img_style'   =>  $body_4_img_style ,
                                                                               'body_4_href_2'      =>  $body_4_href_2 ,
                                                                               'body_4_class_2'     =>  $body_4_class_2 ,
                                                                               'body_4_style_2'     =>  $body_4_style_2 ,
                                                                               'body_4_target_2'    =>  $body_4_target_2 ,
                                                                               'body_4_text'        =>  $body_4_text
                                                                             ) ,
                                                         'r_vars'    => array( ) ,
                                                         'output'    => array( 'body' => 'body_content_4' )
                                                       ) ,

                                // Element --> body_5 (3nd level)
                                'body_5' =>       array( 'template'  => 'element/body/body_5/body_5.html' ,
                                                         'type'      => 'element' ,
                                                         'parent'    => array( 'body' ) ,
                                                         'children'  => null ,
                                                         't_vars'    => array( 'body_5_class'       =>  $body_5_class ,
                                                                               'body_5_style'       =>  $body_5_style ,
                                                                               'body_5_href_1'      =>  $body_5_href_1 ,
                                                                               'body_5_class_1'     =>  $body_5_class_1 ,
                                                                               'body_5_style_1'     =>  $body_5_style_1 ,
                                                                               'body_5_target_1'    =>  $body_5_target_1 ,
                                                                               'body_5_img_src'     =>  $body_5_img_src ,
                                                                               'body_5_img_class'   =>  $body_5_img_class ,
                                                                               'body_5_img_style'   =>  $body_5_img_style ,
                                                                               'body_5_href_2'      =>  $body_5_href_2 ,
                                                                               'body_5_class_2'     =>  $body_5_class_2 ,
                                                                               'body_5_style_2'     =>  $body_5_style_2 ,
                                                                               'body_5_target_2'    =>  $body_5_target_2 ,
                                                                               'body_5_text'        =>  $body_5_text
                                                                             ) ,
                                                         'r_vars'    => array( ) ,
                                                         'output'    => array( 'body' => 'body_content_5' )
                                                       ) ,
                              )
                       ) ;


// var_dump( WAP::get_page_layout_view_data( 'main_page' ) ) ;
// 
// var_dump( WAP::get_page_layout_view_data( 'header' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'display' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'body' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'footer' ) ) ;
//
// var_dump( WAP::get_page_layout_view_data( 'logo' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'banner' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'lang_menu' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'social_menu' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'nav_menu' ) ) ;
//
// var_dump( WAP::get_page_layout_view_data( 'display_3' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'display_12' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'display_21' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'display_3' ) ) ;
//
// var_dump( WAP::get_page_layout_view_data( 'body_1' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'body_2' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'body_3' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'body_4' ) ) ;
// var_dump( WAP::get_page_layout_view_data( 'body_5' ) ) ;


echo "<hr>" ;
echo '<h1>WAP::get_render_order()</h1>' ;
var_dump( WAP::get_render_order() ) ;
echo "<hr>" ;



WAP::render_view_elements( 'set' , 
                            WAP::get_render_order()
                         ) ;

// echo $page_layout_obj->get_rendered_HTML()  ;


// WAP::render_view_elements( 'unique' , 'soc_menu' ) ;

// echo WAP::get_rendered_elements( 'main_page' ) ;
//
// echo WAP::get_rendered_elements( 'header' ) ;
// echo WAP::get_rendered_elements( 'display' ) ;
// echo WAP::get_rendered_elements( 'body' ) ;
// echo WAP::get_rendered_elements( 'footer' ) ;
// 
// echo WAP::get_rendered_elements( 'logo' ) ;
// echo WAP::get_rendered_elements( 'banner' ) ;
// echo WAP::get_rendered_elements( 'lang_menu' ) ;
// echo WAP::get_rendered_elements( 'social_menu' ) ;
// echo WAP::get_rendered_elements( 'nav_menu' ) ;
//
// echo WAP::get_rendered_elements( 'display_3' ) ;
// echo WAP::get_rendered_elements( 'display_12' ) ;
// echo WAP::get_rendered_elements( 'display_21' ) ;
// echo WAP::get_rendered_elements( 'display_111' ) ;
//
// echo WAP::get_rendered_elements( 'body_1' ) ;
// echo WAP::get_rendered_elements( 'body_2' ) ;
// echo WAP::get_rendered_elements( 'body_3' ) ;
// echo WAP::get_rendered_elements( 'body_4' ) ;
// echo WAP::get_rendered_elements( 'body_5' ) ;


echo WAP::get_element_rendered_result() ;

/*
WAP::set_view_data( 'header', array( 'style_data' => array( 'header_style' =>     '' ,
                                                            'logo_style' =>       '' ,
                                                            'lang_menu_style' =>  '' ,
                                                            'soc_menu_style' =>   '' ,
                                                            'nav_menu_style' =>   ''
                                                          ) ,
                                     'logo_data' => array( 'logo_link'   => '' ,
                                                           'logo_target' => ''
                                                         ) ,
                                     'lang_menu_data' => '' ,
                                     'social_menu_data' => '' ,
                                     'nav_menu_data' => ''
                                   )
                  ) ;

WAP::set_view_data( 'display' , array( )
                  ) ;

WAP::set_view_data( 'body' , array( )
                  ) ;

WAP::set_view_data( 'footer' , array( )
                  ) ;

*/

/*
WAP::set_page_layout_template( FALSE , array ( 'page_layout' => 'layout/main_page/main_page.html'
                                             )
                             ) ;

WAP::set_page_element_template( FALSE , array( 'header'      => 'element/header/header.html' ,
                                               'display'     => 'element/display/display.html' ,
                                               'body'        => 'element/body/body.html' ,
                                               'footer'      => 'element/footer/footer.html' ,
    
                                               'logo'        => 'element/header/logo/logo.html' ,
                                               'lang_menu'   => 'element/header/lang_menu/lang_menu.html' ,
                                               'social_menu' => 'element/header/social_menu/social_menu.html' ,
                                               'nav_menu'    => 'element/header/nav_menu/nav_menu.html'
                                             )
                              ) ;

*/
/*
print( "<hr/>" ) ;

var_dump( WAP::get_page_layout_template( TRUE ) ) ;

print( "<hr/>" ) ;

var_dump( WAP::get_page_element_template( TRUE ) ) ;

print( "<hr/>" ) ;





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
*/

// $body_data = '<pre>' . var_dump( get_object_vars( read_JSON_file( 'http://www.metalstone.pt/App_data/resources/images/background/background_images.json' , true ) ) ) . '</pre>' .
//              '<hr/>' . json_encode( $data )
        
/*
$body_data = '' ;        
        ;


$smarty_obj = $GLOBALS[ 'smarty_obj' ] ;

// Instatialize the HEADER view

$smarty_obj->assign( 'header_style',    '' ) ;
$smarty_obj->assign( 'logo_style',      '' ) ;
$smarty_obj->assign( 'lang_menu_style', '' ) ;
$smarty_obj->assign( 'soc_menu_style',  '' ) ;
$smarty_obj->assign( 'nav_menu_style',  '' ) ;

$header_HTML = $smarty_obj->fetch( 'element/header/header.html.tpl' ) ;


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

$smarty_obj->display( 'layout/main_page/main_page.html.tpl') ;

 */