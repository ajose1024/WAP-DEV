<?php

DEFINE( 'WAP_EXEC', TRUE ) ;

if (  $_SERVER[ 'HTTP_HOST' ] !== 'www.metalstone.pt' )
{
    header( 'Location: http://www.metalstone.pt' . $_SERVER[ 'SCRIPT_URL' ] ) ;
}

include( "./code_init.php" ) ;
