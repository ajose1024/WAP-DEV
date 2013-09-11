<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

    $path_parts = pathinfo( $_SERVER['SCRIPT_FILENAME'] );
    $back_path = '/..' ;
    $GLOBALS['DOC_ROOT'] = $path_parts['dirname'] . $back_path ;


	ini_set("include_path",".:./App_code:./App_code/include");

print( $GLOBALS['DOC_ROOT']) ;

    include( $GLOBALS['DOC_ROOT'] . "/App_code/config/App_code_init.php" );


//    print_r( $GLOBALS );

//    print("<hr/>");
//    print("<hr/>");

    print_r( $GLOBALS['sys_DBs_obj']->get_DB_params( 'app_DB' ) );

    print("<hr/>");

    // Obtem um objecto a partir da classe (como Singleton obtem sempre o mesmo
    // objecto)
    $app_DB_instance_1 = app_DB::getInstance() ;

    var_dump( $app_DB_instance_1 );

    print("<hr/>");

    print("<br>");
    $ret_val = $app_DB_instance_1->open(0);
    print(" Valor de retorno do metodo open(): " . $ret_val );
    print("<br>");
    var_dump( $app_DB_instance_1 );
/*
    $app_data_array = $GLOBALS['sys_DBs_obj']->get_DB_params('app_DB');
    $app_DB_instance_1->set_DB( $app_data_array['driver'],
                                $app_data_array['host'],
                                $app_data_array['user'],
                                $app_data_array['password'],
                                $app_data_array['database']
                              );
 */

    print("<hr/>");
    print("<br>");
    $ret_val = $app_DB_instance_1->open(0);
    print(" Valor de retorno do metodo open(): " . $ret_val );
    print("<br>");
    var_dump( $app_DB_instance_1 );

    print("<hr/>");

    $ret_val = $app_DB_instance_1->close();

    print(" Valor de retorno do metodo close(): " . $ret_val );
    print("<br>");
    var_dump( $app_DB_instance_1 );

    print("<hr/>");
    print("<hr/>");

    app_DB_open(0);

    print("<hr/>");
    var_dump( app_DB::getInstance() );
    print("<hr/>");

    app_DB_open(0);

    print("<hr/>");
    var_dump( app_DB::getInstance() );
    print("<hr/>");

    app_DB_close(0);

    print("<hr/>");
    var_dump( app_DB::getInstance() );
    print("<hr/>");


?>