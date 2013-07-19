<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
        <title>WAP - Databases -- wap_db_interface</title>

	<style type="text/css">

            ::selection{ background-color: #E13300; color: white; }
            ::moz-selection{ background-color: #E13300; color: white; }
            ::webkit-selection{ background-color: #E13300; color: white; }

            body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
            }

            a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
            }

            h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
            }

            code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
            }

            #body{
		margin: 0 15px 0 15px;
            }
	
            p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
            }
	
            #container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
            }
	</style>

    </head>

    <body>

        <div id="container">

            <h1>WAP (WEB Application Platform)</h1>

            <div id="body">
		<p>This page shows the results from 'wap_db_interface' module</p><br/>                
            </div>

                <?php 
                    $data_elements = $this->wap_data_interface->get_data_elements() ;

                    switch ( $data_elements[ 2 ] )
                    {
                        // Module:  DBs_init
                        case 'DBs_init':

                            echo "<h2>METHOD: DBs_init  (test module)</h2>" ;

                            var_dump( $GLOBALS[ 'sys_DBs_obj' ] ) ;
                            var_dump( $GLOBALS ) ;

                            break ;

                        // Module:  get_DB_params
                        case 'get_DB_params':

                            echo "<h2>METHOD: get_DB_params  (test module)</h2>" ;

//                            var_dump( $GLOBALS[ 'CI' ]->wap_db_interface->get_DB_parameters( $data_elements[ 3 ] ) ) ;

                            var_dump( $GLOBALS[ 'sys_DBs_obj' ]->get_DB_params( $data_elements[ 3 ] ) ) ;
                            
                            var_dump( $GLOBALS[ 'CI' ] ) ;
                            
                            break ;

                        // Module:  get_DB_conn_obj
                        case 'get_DB_conn_obj':

                            echo "<h2>METHOD: get_DB_conn_obj  (test module)</h2>" ;

                            var_dump( $GLOBALS[ 'sys_DBs_obj' ]->get_DB_conn_obj( $data_elements[ 3 ] ) ) ;
                            
                            break ;

                        // Module:  get_DB_stats
                        case 'get_DB_status':

                            echo "<h2>METHOD: get_DB_status  (test module)</h2>" ;

                            var_dump( $GLOBALS[ 'sys_DBs_obj' ]->get_DB_status( $data_elements[ 3 ] ) ) ;
                            
                            break ;

                        // Module:  DB_open
                        case 'DB_open':

                            echo "<h2>METHOD: DB_open  (test module)</h2>" ;

                            var_dump( $GLOBALS[ 'sys_DBs_obj' ]->DB_open( $data_elements[ 3 ] ) ) ;
                            
                            break ;

                        // Module:  DB_close
                        case 'DB_close':

                            echo "<h2>METHOD: DB_close  (test module)</h2>" ;

                            var_dump( $GLOBALS[ 'sys_DBs_obj' ]->DB_close( $data_elements[ 3 ]) ) ;
                            
                            break ;

                        // Module:  not valid
                        DEFAULT:

                            echo "<h2>INVALID app_databases_init method</h2>" ;
                            
                            foreach( array() as $key => $value )
                            {
                                echo( "CHAVE: " . $key  . "<br/>"  ) ;
                                var_dump( $value ) ;
                                echo( "<hr/>" ) ;
                            }
                            break ;
                    }

                    echo "<hr/>" ;
                    
                    var_dump( $data_elements ) ;
                    
                ?>

            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>

    </body>

</html>