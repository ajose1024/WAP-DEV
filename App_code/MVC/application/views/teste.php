<!DOCTYPE html>
<?php

// var_dump( $GLOBALS ) ;
// var_dump( $smarty_obj ) ;
// var_dump( $smarty ) ;

    $top_left_data = 'Top Left' ;
    $top_middle_data = 'Top Middle' ;
    $top_right_data = 'Top Right' ;
    
    $main_body_data = 'Main Body' ;
    
    $bottom_left_data = 'Bottom Left' ;
    $bottom_middle_data = 'Bottom Middle' ;
    $bottom_right_data = 'Bottom Right' ;
    
    
    $GLOBALS['smarty_obj']->assign( 'top_left', $top_left_data ) ;
    $GLOBALS['smarty_obj']->assign( 'top_middle', $top_middle_data ) ;
    $GLOBALS['smarty_obj']->assign( 'top_right', $top_right_data ) ;
    
    $GLOBALS['smarty_obj']->assign( 'main_body', $main_body_data ) ;
    
    $GLOBALS['smarty_obj']->assign( 'bottom_left', $bottom_left_data ) ;
    $GLOBALS['smarty_obj']->assign( 'bottom_middle', $bottom_middle_data ) ;
    $GLOBALS['smarty_obj']->assign( 'bottom_right', $bottom_right_data ) ;
    
    $GLOBALS['smarty_obj']->display( '/home/wap-dev/public_html/templates/Smarty/templates/test.tmpl.html' ) ;

?>
<!--
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        ?>
    </body>
</html>

-->