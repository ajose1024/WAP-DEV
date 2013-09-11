<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

include "code_init.php" ;

// session_start() ;

// session_handling::start_session() ;

print_r( $_COOKIE ) ;
echo '<hr>' ;
print_r( $_SESSION ) ;
echo '<hr>' ;
print( '$SESSKEY: ' . $sesskey ) ;
echo '<hr>' ;
print( '$SID: ' . $SID ) ;

// session_destroy() ;