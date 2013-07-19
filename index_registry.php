<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?
 //   include(dirname($_SERVER["SCRIPT_FILENAME"]) . "/App_code/config/App_code_init.php");
    include("App_code/config/App_code_init.php");




    $Registry = $GLOBALS['sys_DBs_obj']->get_DB_params("Registry");


    if ( $Registry['status'] != 0 )
    {
        // Não consegui ter os dados de ligação a base de dados!!!
    }

    // Instancializa a classe 'app_DB' em $Registry_obj
    $Registry_obj = new Registry;

    // Passa os dados para a ligação a base de dados 'Registry'
    // Liga a base de dados 'Registry' (connecção não presistente, tipo 0)
    $result_open = $Registry_obj->open(0);

    $result_set_valor = $Registry_obj->set_valor('seccao_1','chave_1','xpto');
    print("<hr/>");
    print_r($result_set_valor);
    print("<hr/>");
    $result_get_valor = $Registry_obj->get_valor('seccao_1','chave_1');
    print("<hr/>");
    print_r($result_get_valor);
    print("<hr/>");
    $result_close = $Registry_obj->close();




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
                var res_data_obj = SyncExchangeData("@pics/logos/app_config_logo_small.png","");
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
