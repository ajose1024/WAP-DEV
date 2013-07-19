#!/usr/bin/php
<?

    include("/home/userv/public_html/App_code/config/App_code_init.php");

    for( $i = 0 ; $i < 1000 ; $i++ )
    {
        print( mk_rnd_akey($i) . "\r\n");

//        system("sleep 1");
        usleep(1000000);
    }
//echo phpinfo();

?>