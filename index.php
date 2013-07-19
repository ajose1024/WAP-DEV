<?php

DEFINE( 'WAP_EXEC', TRUE ) ;

if (  $_SERVER[ 'HTTP_HOST' ] !== 'wap.dev.escrita-virtual.pt' )
{
    header( 'Location: http://wap.dev.escrita-virtual.pt' . $_SERVER[ 'SCRIPT_URL' ] ) ;
}

include( "./code_init.php" ) ;
