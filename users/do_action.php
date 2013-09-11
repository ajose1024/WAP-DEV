<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$GLOBALS['DOC_ROOT'] = $_SERVER['DOCUMENT_ROOT'] ;


	ini_set("include_path",".:./App_code:./App_code/include");


    include( $GLOBALS['DOC_ROOT'] . "/App_code/config/App_code_init.php" );


// session_handling::destroy_session();

/* @var $start_session <type> */
$start_session = session_handling::start_session();
/* @var $set_session_data <type> */
$set_session_data = session_handling::set_session_data('Last_Access', date('D, d M Y H:i:s') );

if ( ! isset( $_SESSION['UID'] ) )
{
    /* @var $set_session_data <type> */
    $set_session_data = session_handling::set_session_data( 'UID', '-1' );
}

switch ( $_REQUEST['action'] )
{
    // Action: 'show_vars'
    //
    // Esta acção da como reultado as seguintes variáveis:
    //  SESSID=<session_ID>
    //  todas as variáves guardadas na sessão
    //  username=<username>
    //  passwd=<password>
    //  RESULT=OK
    case 'show_vars':
        print("SESSID". "=" . session_ID() . "\n");

        foreach( $_SESSION as $key => $value )
        {
            print( $key . "=". $value . "\n" );
        }

        print("USERNAME" . "=" . $_REQUEST['username'] . "\n");
        print("PASSWD" . "=" . $_REQUEST['passwd'] . "\n");

        print("RESULT" ."=" . "OK" . "\n");
        break;


    case 'init':
        print("SESSID" . "=" . session_ID() . "\n");
        print("RESULT" . "=" . "OK" . "\n");

        break;


    case 'login':
        $username = $_REQUEST['username'];
        $password = $_REQUEST['passwd'];

        $Auth_obj = new Auth_DAO() ;

        $result = $Auth_obj->user_login( $username, $password ) ;

        print_r( $result );
        print("<br><br>");

        if( $result['status'] == TRUE )
        {
            // Login feito com sucesso
            $set_session_data = session_handling::set_session_data(
                                                            'UID',
                                                            $result['user_ID']
                                                                  );
            print("RESULT" . "=" . "OK" . "\n");
            print("UID" . "=" . $_SESSION['UID'] . "\n");
            print("COMMENT" . "=" . "Login bem sucedido!");
            
        }
        else
        {
            // Login sem sucesso
            $set_session_data = session_handling::set_session_data(
                                                            'UID',
                                                            $result['user_ID']
                                                                  );
            print("RESULT" . "=" . "NOK" . "\n");
            print("UID" . "=" . $_SESSION['UID'] . "\n");
            print("COMMENT" . "=" . "Credenciais erradas!");
            
            
        }

        break;


    case 'logout':
        $Auth_obj = new Auth_DAO() ;

        $user_ID = session_handling::get_session_data( 'UID' );

        $result = $Auth_obj->user_logout( $user_ID ) ;

        print_r( $result );
        print("<br><br>");

//        $destroy_session = session_handling::destroy_session();
        print("RESULT" . "=" . "OK" . "\n");
        print("COMMENT" . "=" . "Logout feito!");

        break;


    case 'list_vars':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {
            print("RESULT" . "=" . "OK" . "\n");
            foreach( $_SESSION as $key => $value )
            {
                print( $key . "\n" );
            }
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    // Action: 'store'
    //
    // Esta acção recebe como parametros os seguintes:
    //  name=<var_name>
    //  value=<var_value>
    //
    // Da como resultado as seguintes variáveis:
    //  RESULT=OK

    case 'store':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {
            $set_session_data = session_handling::set_session_data(
                    $_REQUEST['name'],
                    $_REQUEST['value'] );
            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    case 'store_vars':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {
            // Lê linha a linha o conteudo do input e, para cada linha:

            $set_session_data = session_handling::set_session_data(
                    $_REQUEST['name'],
                    $_REQUEST['value'] );

            // termina com o resultado
            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    case 'load':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {
            print( $_REQUEST['name'] . "=" .
            $get_session_data = session_handling::get_session_data(
                    $_REQUEST['name'] ) . "\n" ) ;
            print("RESULT" . "=" . "OK" . "\n") ;
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    case 'load_vars':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {
            // Lê linha a linha o conteudo do input e, para cada linha:

            print( $_REQUEST['name'] . "=" .
            $get_session_data = session_handling::get_session_data(
                    $_REQUEST['name'] ) . "\n" ) ;

            // termina com o resultado
            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    case 'delete':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {
            $unset_session_data = session_handling::unset_session_data(
                    $_REQUEST['name'] );
            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    case 'delete_vars':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {
            // Lê linha a linha o conteudo do input e, para cada linha:

            $unset_session_data = session_handling::unset_session_data(
                    $_REQUEST['name'] );

            // termina com o resultado
            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    case 'delete_all_vars':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    case 'list_users':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;
    
    
    case 'send_msg':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;
    
    
    case 'receive_msg':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    case 'receive_msgs':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;

    
    case 'list_pending_msg':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;
    
    
    case 'send_mail':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;
    
    
    case 'receive_mail':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;
    
    
    case 'receive_mails':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;


    case 'list_pending_mail':
        $UID = session_handling::get_session_data( 'UID' );
        if ( $UID == '3' )
        {

            // to be implemented

            print("RESULT" . "=" . "OK" . "\n");
        }
        else
        {
            print("RESULT" . "=" . "NOK" . "\n");
        }

        break;

        

    default:
        print( "RESULT" . "=" . "OK" . "\n" );
        print( "MSG" . "=" . "Invalid command" . "\n");
}



//session_handling::start_session();

//var_dump($GLOBALS);


?>