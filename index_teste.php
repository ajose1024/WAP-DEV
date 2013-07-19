<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?
 //   include(dirname($_SERVER["SCRIPT_FILENAME"]) . "/App_code/config/App_code_init.php");


    $path_parts = pathinfo( $_SERVER['SCRIPT_FILENAME'] ) ;
    $back_path = '' ;
    $GLOBALS['DOC_ROOT'] = $path_parts['dirname'] . $back_path ;


print( $GLOBALS['DOC_ROOT']) ;

 
    include("App_code/config/App_code_init.php");




    $app_DB = $GLOBALS['sys_DBs_obj']->get_DB_params("app_DB");


    if ( $app_DB['status'] != 0 )
    {
        // Não consegui ter os dados de ligação a base de dados!!!
    }

    print_r( $app_DB );

    // Instancializa a classe 'app_DB' em $app_DB_obj
    $app_DB_obj = new app_DB;

    // Passa os dados para a ligação a base de dados 'app_DB'
    $app_DB_obj->set_DB( $app_DB['driver'],
                         $app_DB['host'],
                         $app_DB['user'],
                         $app_DB['password'],
                         $app_DB['database']
                       );

    // Liga a base de dados 'app_DB' (connecção não presistente, tipo 0)
    $app_DB_obj->open(0);

    $DB_conn_obj_array = $app_DB_obj->get_DB_obj();
    $DB_conn_obj = $DB_conn_obj_array['DB_obj'];

    // Instancializa a classe 'app_acl' em $app_acl_obj
    $app_acl_obj = new app_acl;



    $result_insert = $app_acl_obj->insert( $DB_conn_obj, array (
                                                                 'acl_ID'  => '',
                                                                 'prog_ID' => 0 ,
                                                                 'user_ID' => 1 ,
                                                                 'access_class_ID' => 1,
                                                                 'access_type_ID'  => 0 )
                                                               );



 
    $result_update = $app_acl_obj->update( $DB_conn_obj, array (
                                     'acl_ID' => 13,
                                     'prog_ID' => 5,
                                     'user_ID' => 4,
                                     'access_class_ID' => 1,
                                     'access_type_ID' => 2)
                                    );


    $result_query = $app_acl_obj->query($DB_conn_obj,13);

$result_delete = $app_acl_obj->delete($DB_conn_obj, array (
                                     'acl_ID' => 13,
                                     'prog_ID' => 0,
                                     'user_ID' => 0,
                                     'access_class_ID' => 0,
                                     'access_type_ID' => 0)
                                                           );

    $app_DB_obj->close($DB_conn_obj);




?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Main Page</title>
        <script type="text/javascript" src="@js/ajax.js">
        </script>
        <script type="text/javascript">
            function LoadHeader()
            {
                var res_data_obj = SyncExchangeData("@pics/logos/milus_logo_small.png","");
                document.getElementById('header').innerHTML = res_data_obj.responseText;
            }
        </script>
    </head>
    <body>
        <?php
        // put your code here ereddf
        ?>
        <table border="1">
            <tr>
                <td width="180px" id="logo">
                    <a href="index.php"><img src="@pics/logos/userv_logo_small.png" width="170" height="64"></a>
                </td>
                <td width="800px" id="header">
                  &nbsp;
                </td>
            </tr>
            <tr>
                <td width="180px" id="menu">
                  <?
                    print("Menu item 1" . "<br/>");
                    print("Menu item 2" . "<br/>");
                    print("Menu item 3" . "<br/>");
                  ?>
                </td>
                <td width="800px" id="main">
                    <?
//                      get_page("192.168.1.216","192.168.1.216","/~userv/phpinfo.php", 80, 5);

//  get_data_by_GET($host, $port, $req_headers, $url, $query_str, $timeout)
//  get_data_by_POST($host, $port, $req_headers, $url, $query_str, $timeout)
//  get_data($host, $port, $method, $req_headers, $url, $query_str, $timeout)

                        $sub_app_data = get_data_by_POST(
                            "192.168.1.216",
                            80,
                            array('Content-type' => 'application/x-www-form-urlencoded'),
//                            array(),
                            "/~userv/App_code/apps/idle/app_index.php",
                            "type=frame",
                            1
                                                        );
                        print($sub_app_data['body']);
                    ?>
                </td>
            </tr>
        </table>

    </body>
</html>
