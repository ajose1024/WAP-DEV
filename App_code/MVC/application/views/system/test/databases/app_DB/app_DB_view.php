<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
        <title>WAP - Database Functions</title>

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
		<p>This page shows the results from app_DB database modules</p><br/>

                <?php 
                    $data_elements = $this->wap_data_interface->get_data_elements() ;
  

                    switch ( $data_elements[ 3 ] )
                    {
                        // Module:  app_DB.php
                        case 'app_DB.php':

                            echo "<h2>CLASS: app_DB  (test module)</h2>" ;

                            switch ( $data_elements[ 4 ] )
                            {
                                // Method:  set_DB( $driver, $host, $user, $password, $database )
                                case 'set_DB':
                                    echo "<h3>METHOD: set_DB<h3>" ;
                                    echo "<hr/>" ;
                                    echo "<h4>USAGE: http://homepages.datanet-pt.net/~anemona-do-mar/system/sys_test/databases/app_DB/app_DB.php/set_DB/driver/host/user/password/database</h4>" ;
                                    echo "<hr/>" ;

                                    $extra_data_elements = $this->wap_data_interface->get_extra_data() ;

                                    $app_db_params = $GLOBALS['sys_DBs_obj']->get_DB_params('app_DB') ;

                                    $extra_data_elements_nr = count( $extra_data_elements ) ;

                                    switch ( $extra_data_elements_nr )
                                    {
                                        case 5:
                                            $driver   = $extra_data_elements[ 0 ] ;
                                            $host     = $extra_data_elements[ 1 ] ;
                                            $user     = $extra_data_elements[ 2 ] ;
                                            $password = $extra_data_elements[ 3 ] ;
                                            $database = $extra_data_elements[ 4 ] ;
                                            break;
                                        
                                        case 4:
                                            $driver   = $extra_data_elements[ 0 ] ;
                                            $host     = $extra_data_elements[ 1 ] ;
                                            $user     = $extra_data_elements[ 2 ] ;
                                            $password = $extra_data_elements[ 3 ] ;
                                            $database = $app_db_params[ 'database' ] ;
                                            break;
                                        
                                        case 3:
                                            $driver   = $extra_data_elements[ 0 ] ;
                                            $host     = $extra_data_elements[ 1 ] ;
                                            $user     = $extra_data_elements[ 2 ] ;
                                            $password = $app_db_params[ 'password' ] ;
                                            $database = $app_db_params[ 'database' ] ;
                                            break;
                                        
                                        case 2:
                                            $driver   = $extra_data_elements[ 0 ] ;
                                            $host     = $extra_data_elements[ 1 ] ;
                                            $user     = $app_db_params[ 'user' ] ;
                                            $password = $app_db_params[ 'password' ] ;
                                            $database = $app_db_params[ 'database' ] ;
                                            break;
                                        
                                        case 1:
                                            $driver   = $extra_data_elements[ 0 ] ;
                                            $host     = $app_db_params[ 'host' ] ;
                                            $user     = $app_db_params[ 'user' ] ;
                                            $password = $app_db_params[ 'password' ] ;
                                            $database = $app_db_params[ 'database' ] ;
                                            break;
                                        
                                        default:
                                            $driver   = $app_db_params[ 'driver' ] ;
                                            $host     = $app_db_params[ 'host' ] ;
                                            $user     = $app_db_params[ 'user' ] ;
                                            $password = $app_db_params[ 'password' ] ;
                                            $database = $app_db_params[ 'database' ] ;
                                            break;
                                    }

                                    $result = app_DB::set_DB( $driver,
                                                              $host ,
                                                              $user ,
                                                              $password ,
                                                              $database
                                                            ) ;
                                        
                                    var_dump( $result ) ;
                                        
                                    break ;
                                
                                // Method:  open( $conn_type )
                                case 'open':
                                    echo "<h3>METHOD: open( \$conn_type )<h3>" ;
                                    echo "<hr/>" ;
                                    echo "<h4>USAGE: http://homepages.datanet-pt.net/~anemona-do-mar/system/sys_test/databases/app_DB/app_DB.php/open/#conn_type</h4>" ;
                                    echo "<hr/>" ;

                                    $extra_data_elements = $this->wap_data_interface->get_extra_data() ;

                                    // Get the app_DB access parameters
                                    $app_db_params = $GLOBALS['sys_DBs_obj']->get_DB_params('app_DB') ;
                                    // Set them to the appropriate place
                                    $result = app_DB::set_DB( $app_db_params[ 'driver' ] ,
                                                              $app_db_params[ 'host' ] ,
                                                              $app_db_params[ 'user' ] ,
                                                              $app_db_params[ 'password' ] ,
                                                              $app_db_params[ 'database' ]
                                                            ) ;

                                    $extra_data_elements_nr = count( $extra_data_elements ) ;

                                    switch ( $extra_data_elements_nr )
                                    {
                                        case 0:
                                            $conn_type = $extra_data_elements[ 0 ] ;
                                            break;

                                        case 1:
                                            $conn_type = $extra_data_elements[ 0 ] ;
                                            break;

                                        default:
                                            $conn_type = 0 ;
                                            break;

                                    }

                                    $result = app_DB::open( $conn_type ) ;
                                        
                                    var_dump( $result ) ;
                                        
                                    break ;
                                
                                // Method:  get_DB_obj( )
                                case 'get_DB_obj':
                                    echo "<h3>METHOD: get_DB_obj( )<h3>" ;
                                    echo "<hr/>" ;
                                    echo "<h4>USAGE: http://homepages.datanet-pt.net/~anemona-do-mar/system/sys_test/databases/app_DB/app_DB.php/get_DB_obj/[open|close]/#conn_type</h4>" ;
                                    echo "<hr/>" ;

                                    $extra_data_elements = $this->wap_data_interface->get_extra_data() ;

                                    // Get the app_DB access parameters
                                    $app_db_params = $GLOBALS['sys_DBs_obj']->get_DB_params('app_DB') ;
                                    // Set them to the appropriate place
                                    $result = app_DB::set_DB( $app_db_params[ 'driver' ] ,
                                                              $app_db_params[ 'host' ] ,
                                                              $app_db_params[ 'user' ] ,
                                                              $app_db_params[ 'password' ] ,
                                                              $app_db_params[ 'database' ]
                                                            ) ;
                                    
                                    $extra_data_elements_nr = count( $extra_data_elements ) ;

                                    switch ( $extra_data_elements_nr )
                                    {
                                        case 2:
                                            $conn_type = $extra_data_elements[ 1 ] ;
                                            break ;

                                        default:
                                            $conn_type = 0 ;
                                            break ;

                                    }

                                    // Open the access to the app_DB database
                                    switch ( $extra_data_elements[ 0 ] )
                                    {
                                        case 'open':
                                            $result = app_DB::open( $conn_type ) ;
                                            break ;
                                            
                                        case 'close':
                                            $result = app_DB::open( $conn_type ) ;
                                            $result = app_DB::close( ) ;
                                            break ;
                                            
                                        default:
                                            $result = app_DB::open( $conn_type ) ;
                                            break ;
                                    }
                                    
                                    $result = app_DB::get_DB_obj( ) ;
                                        
                                    var_dump( $result ) ;
                                        
                                    break ;
                                
                                // Method:  getInstance( )
                                case 'getInstance':
                                    echo "<h3>METHOD: getInstance( )<h3>" ;
                                    echo "<hr/>" ;
                                    echo "<h4>USAGE: http://homepages.datanet-pt.net/~anemona-do-mar/system/sys_test/databases/app_DB/app_DB.php/getInstance/[open|close]/#conn_type</h4>" ;
                                    echo "<hr/>" ;

                                    $extra_data_elements = $this->wap_data_interface->get_extra_data() ;

                                    // Get the app_DB access parameters
                                    $app_db_params = $GLOBALS['sys_DBs_obj']->get_DB_params('app_DB') ;
                                    // Set them to the appropriate place
                                    $result = app_DB::set_DB( $app_db_params[ 'driver' ] ,
                                                              $app_db_params[ 'host' ] ,
                                                              $app_db_params[ 'user' ] ,
                                                              $app_db_params[ 'password' ] ,
                                                              $app_db_params[ 'database' ]
                                                            ) ;
                                    
                                    $extra_data_elements_nr = count( $extra_data_elements ) ;

                                    switch ( $extra_data_elements_nr )
                                    {
                                        case 2:
                                            $conn_type = $extra_data_elements[ 1 ] ;
                                            break ;

                                        default:
                                            $conn_type = 0 ;
                                            break ;

                                    }

                                    // Open the access to the app_DB database
                                    switch ( $extra_data_elements[ 0 ] )
                                    {
                                        case 'open':
                                            $result = app_DB::open( $conn_type ) ;
                                            break ;
                                            
                                        case 'close':
                                            $result = app_DB::open( $conn_type ) ;
                                            $result = app_DB::close( ) ;
                                            break ;
                                            
                                        default:
                                            $result = app_DB::open( $conn_type ) ;
                                            break ;
                                    }
                                    
                                    $result = app_DB::getInstance( ) ;
                                        
                                    var_dump( $result ) ;
                                        
                                    break ;
                                
                                // Method:  close( )
                                case 'close':
                                    echo "<h3>METHOD: close( )<h3>" ;
                                    echo "<hr/>" ;
                                    echo "<h4>USAGE: http://homepages.datanet-pt.net/~anemona-do-mar/system/sys_test/databases/app_DB/app_DB.php/close</h4>" ;
                                    echo "<hr/>" ;

                                    $extra_data_elements = $this->wap_data_interface->get_extra_data() ;

                                    // Get the app_DB access parameters
                                    $app_db_params = $GLOBALS['sys_DBs_obj']->get_DB_params('app_DB') ;
                                    // Set them to the appropriate place
                                    $result = app_DB::set_DB( $app_db_params[ 'driver' ] ,
                                                              $app_db_params[ 'host' ] ,
                                                              $app_db_params[ 'user' ] ,
                                                              $app_db_params[ 'password' ] ,
                                                              $app_db_params[ 'database' ]
                                                            ) ;

                                    $extra_data_elements_nr = count( $extra_data_elements ) ;

                                    $result = app_DB::open( 0 ) ;
                                    $result = app_DB::close( ) ;
                                        
                                    var_dump( $result ) ;
                                        
                                    break ;
                                
                                // Method:  unknown
                                DEFAULT:
                                    echo "<h3>METHOD: <b><i>unknown</i></b><h3>" ;
                                    echo "<hr/>" ;
                                    
                                    break ;
                            }
                            break ;

                        // Module:  get_DB_params
                        case 'get_DB_params':
                            $DB_params = $GLOBALS[ 'sys_DBs_obj' ]->get_DB_params( $data_elements[ 4 ] ) ;
                            break ;

                        // Module:  not valid
                        DEFAULT:

                            echo "<h2>INVALID app_DB module</h2>" ;
                            
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
                
            </div>

            <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
        </div>

    </body>

</html>