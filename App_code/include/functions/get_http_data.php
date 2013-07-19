<?php
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  GET/POST Functions:
 * 
 *  Functions:  get_data_by_GET($host, $port, $req_headers, $url, $query_str, $timeout)
 *              get_data_by_POST($host, $port, $req_headers, $url, $query_str, $timeout)
 *              get_data($host, $port, $method, $req_headers, $url, $query_str, $timeout)
 */


// Esta funções destinam-se a ir buscar conteudo por HTTP, quer ao servidor
// local quer a qualquer servidor WEB que seja acessivel

// Funções definidas:
//
//  get_data_by_GET($host, $port, $req_headers, $url, $query_str, $timeout)
//  get_data_by_POST($host, $port, $req_headers, $url, $query_str, $timeout)
//  get_data($host, $port, $method, $req_headers, $url, $query_str, $timeout)


    // Função:  get_data_by_GET( )
    //
    // Esta função vai buscar conteudo a um servidor WEB, local ou remoto.,
    // desde que acessivel, pelo método GET.
    // Eventuais parâmetros a passar são passados no URI, como é normal no
    // método GET
    //
    // Parâmetros de entrada:
    //  $host           = String com o nome ou IP do servidor a que se acede
    //  $port           = Inteiro com o porto onde se acede ao servidor
    //  $req_headers    = Array associativo com os HTTP headers a serem enviados
    //  $url            = String com o URI para o conteudo a aceder
    //  $query_str      = String com os dados passados (se existirem)
    //  $timeout        = Inteiro com o timeout (em segundos)
    //
    // Parâmetros de retorno:
    //  array ( 'status'  => $result_code,
    //          'headers' => Array associativo com os HTTP headers da resposta,
    //          'body'    => String com o conteudo do HTTP body
    //          'err_num' => HTTP error code
    //          'err_msg' => HTTP error message
    //        )
    //      result =  0: O conteudo do ficheiro foi obtido com sucesso
    //             = -1: O HTTP resource especificado não foi encontrado

    function get_data_by_GET($host, $port, $req_headers, $url, $query_str, $timeout)
    {
        return get_data($host, $port, 'GET', $req_headers, $url, $query_str, $timeout);
    }


    // Função:  get_data_by_POST( )
    //
    // Esta função vai buscar conteudo a um servidor WEB, local ou remoto.,
    // desde que acessivel, pelo método POST.
    // Eventuais parâmetros a passar são passados no HTTP body, como é normal
    // no método POST
    //
    // Parâmetros de entrada:
    //  $host           = String com o nome ou IP do servidor a que se acede
    //  $port           = Inteiro com o porto onde se acede ao servidor
    //  $req_headers    = Array associativo com os HTTP headers a serem enviados
    //  $url            = String com o URI para o conteudo a aceder
    //  $query_str      = String com os dados passados (se existirem)
    //  $timeout        = Inteiro com o timeout (em segundos)
    //
    // Parâmetros de retorno:
    //  array ( 'status'  => $result_code,
    //          'headers' => Array associativo com os HTTP headers da resposta,
    //          'body'    => String com o conteudo do HTTP body
    //          'err_num' => HTTP error code
    //          'err_msg' => HTTP error message
    //        )
    //      result =  0: O conteudo do ficheiro foi obtido com sucesso
    //             = -1: O HTTP resource especificado não foi encontrado

    function get_data_by_POST($host, $port, $req_headers, $url, $query_str, $timeout )
    {
        return get_data($host, $port, 'POST', $req_headers, $url, $query_str, $timeout );
    }


    // Função:  get_data( )
    //
    // Esta função vai buscar conteudo a um servidor WEB, local ou remoto.,
    // desde que acessivel, pelo método GET ou POST.
    // Eventuais parâmetros a passar são passados de acordo com o método
    // escolhido
    //
    // Parâmetros de entrada:
    //  $host           = String com o nome ou IP do servidor a que se acede
    //  $port           = Inteiro com o porto onde se acede ao servidor
    //  $method         = String com o valor de GET ou POST. Outro valor qualquer
    //                  = retorna erro
    //  $req_headers    = Array associativo com os HTTP headers a serem enviados
    //  $url            = String com o URI para o conteudo a aceder
    //  $query_str      = String com os dados passados (se existirem)
    //  $timeout        = Inteiro com o timeout (em segundos)
    //
    // Parâmetros de retorno:
    //  array ( 'status'      => $result_code,
    //          'http_status' => HTTP status line
    //          'headers'     => Array associativo com os HTTP headers da resposta,
    //          'body'        => String com o conteudo do HTTP body
    //          'err_num'     => HTTP error code
    //          'err_msg'     => HTTP error message
    //        )
    //      result =  0: O conteudo do ficheiro foi obtido com sucesso
    //             = -1: O HTTP resource especificado não foi encontrado
    //             = -2: O request method não é válido (não é GET ou POST)
    
    function get_data($host, $port, $method, $req_headers, $url, $query_str, $timeout )
    {
        $err_num = 0 ;
        $err_msg = "" ;
        $out_str = "" ;
        $in_str = "" ;
        $HTTP_version = "HTTP/1.1" ;
        $result_headers = array () ;
        $valid_req_headers = array ( 'Host' => "" ,
                                     'Content-length' => 0 ,
                                     'Content-type' => "" ,
                                     'Connection' => ""
                                   ) ;

// print("<hr/>");
// print("Goin to open socket: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

        $f_handle = fsockopen($host, $port, $err_num, $err_msg, $timeout ) ;
        if ( ! $f_handle )
        {
            return array ( 'status'      => -1,
                           'http_status' => "",
                           'headers'     => array (),
                           'body'        => "",
                           'err_num'     => $err_num,
                           'err_msg'     => $err_msg
                         ) ;
        }
        else
        {
            // Set socket to blocking mode
            set_socket_blocking( $f_handle, TRUE ) ;

// print("<hr/>");
// print("Processing start: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

// print("Requesting headers (1st): ");
// print_r($req_headers);
// print("<hr/>");

            // Verifica se existe o header HTTP 'Host', caso o protocolo HTTP
            // seja HTTP/1.1, pois neste caso o mesmo é obrigatório
            if( $HTTP_version == 'HTTP/1.1' )
            {
                if( ! array_key_exists( 'Host', $req_headers ) )
                {
                    $req_headers['Host'] = chop( $host ) ;
                }
            }

// print("Requesting headers (2nd): ");
// print_r($req_headers);
// print("<hr/>");

// print ("Test string: [Host:] (with  chop) : " . chop( $req_headers['Host'] ) . "<br/>" );
// print ("Test string: [Host:] (w/out chop) : " . $req_headers['Host'] . "<br/>");

// print("<hr/>");
// print("Test method: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

            switch ( $method )
            {
                case 'GET':
                    if ( $query_str != "" )
                    {
                        $query_str = "?" . $query_str ;
                    }
                    $out_str = "GET " .
                               $url . $query_str .
                               " " .
                               $HTTP_version .
                               "\r\n"
                             ;
                    break ;

                case 'POST':
                    $out_str = "POST " .
                               $url .
                               " " .
                               $HTTP_version .
                               "\r\n"
                             ;
                    $req_headers['Content-length'] = strlen($query_str) ;
                    break ;

                default:
                    return array ( 'status'      => -2,
                                   'http_status' => "",
                                   'headers'     => array (),
                                   'body'        => "",
                                   'err_num'     => $err_num,
                                   'err_msg'     => $err_msg
                                 ) ;
                    break ;
            }

// print("<hr/>");
// print("Pos Test method: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() ) . "<br/>";
// print("Requesting headers (3rd): ");
// print_r($req_headers);
// print("<hr/>");

            // Adiciona cada um dos headers HTTP existentes no array $req_header
            // a string $out_str

// print("<hr/>");
// print("Prepare headers: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

            // Ajusta a string $out_str para garantir que tem APENAS UM "\r\n"
            // no fim!
            $out_str = chop( $out_str ) ;
            $out_str = $out_str . "\r\n" ;

// print("Print the size of the req_headers array: " . sizeof($req_headers) ."<br/>");
// print("<hr/>");

            foreach( $valid_req_headers as $array_key => $array_value )
            {
                if ( $array_key != "" )
                {
// print("----<br/>");
// print("Array Key: " . $array_key . "<br/>");
// print("Array Value: " . $req_headers[$array_key] . "<br/>");
// print("---------<br/>");
                    if( array_key_exists( $array_key, $req_headers ) )
                    {
                        $out_str .= $array_key . ": " . chop($req_headers[$array_key]) ;
                        $out_str = chop( $out_str ) ;
                        $out_str .= "\r\n" ;
                    }
// print("Outpout string: " . $out_str .  "<br/>" );
// print("---------<br/>");

                }
            }

            // Ajusta a string $out_str para garantir que tem APENAS UM "\r\n"
            // no fim!
            $out_str = chop( $out_str ) ;
            $out_str = $out_str . "\r\n" ;

            // Adiciona o header HTTP 'Connection: Close' para fechar a ligação
            $out_str .= "Connection: Close\r\n" ;

            // Termina o HTTP header
            $out_str .= "\r\n" ;

// print("<hr/>");
// print("Goin to write header: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

// print("<hr/>");
// print($out_str);
// print("<hr/>");

            // Manda o HTTP header para o servidor de destino, fazendo o pedido
            fwrite ($f_handle, $out_str) ;

// print("<hr/>");
// print("Header written: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

            // Se o método for POST, manda agora o HTTP body com a $query_str
            if( $method == 'POST')
            {
                fwrite ( $f_handle, $query_str ) ;
            }

            // uma vez enviado o HTTP_REQUEST vamos ler os dados que o servidor
            // retorne
            //
            // Os mesmos, se existirem, contem duas partea, separadas por uma
            // linha em branco
            // A primeira é o HTTP header e a segunda é o HTTP body.
            // A primeira vamos retorná-la num array associativo, com todos os
            // headers que lá estiveres presentes e a segunda, vamos retorná-la
            // numa string

// print("<hr/>");
// print("POST data written: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

// print("<hr/>");
// print("<p>---------------</p><br/>");
// print("<hr/>");

            while( ! feof ( $f_handle ) )
            {
                $in_str .= fread ( $f_handle, 1024 ) ;
// print("<hr/>");
// print("HTTP body data chunk: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

            }

// print("<hr/>");
// print("Got input data: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

            fclose($f_handle) ;

// print("<hr/>");
// print("Socket closed: " . date('l jS \of F Y h:i:s A') . "\r\n" . time() );
// print("<hr/>");

// print("<hr/>");
// print($in_str);
// print("<hr/>");

            // Em primeiro lugar necessitamos de saber onde se encontra a
            // 1ª ocorrência de '\r\n\r\n', uma vez que isso separa o HTTP
            // header do HTP body.

            $header_body_marker = strpos( $in_str, "\r\n\r\n", 0 ) ;
            $HTTP_header = substr( $in_str, 0, $header_body_marker ) . "\r\n" ;
            $HTTP_body   = substr( $in_str, $header_body_marker ) ;

            // No HTTP header separa a primeira linha das restantes
            // A primeira linha tem o 'status code' e as restantes os
            // headers HTTP

            $HTTP_status_marker = strpos( $HTTP_header, "\r\n", 0 ) ;
            $HTTP_status  = substr( $HTTP_header, 0, $HTTP_status_marker ) . "\r\n" ;
            $HTTP_headers_str = substr( $HTTP_header, $HTTP_status_marker ) ;

//             print( $header_body_marker );
//             print("<hr/>");
//             print( $HTTP_header );
//             print("<hr/>");
//             print( $HTTP_status );
//             print("<hr/>");
//             print( $HTTP_headers );
//             print("<hr/>");
//             print( $HTTP_body );
//             print("<hr/>");

            // É agora necessário processar os headers HTTP de modo a que
            // os mesmos fiquem num array associativo.
            // Para isso, em primeiro lugar, é necessário transformar a
            // string que os contem num array, separando por "\r\n"
            
            $HTTP_headers = explode( "\r\n", $HTTP_headers_str ) ;

            foreach( $HTTP_headers AS $http_header_data )
            {
                $work_str = explode( ":", $http_header_data ) ;

                // $work_str[0] = HTTP header name
                // $work_str[1] = HTTP header value
                $result_headers[ $work_str[0] ] = $work_str[1] ;
            }

            return array ( 'status'      => 0,
                           'http_status' => $HTTP_status,
                           'headers'     => $result_headers,
                           'body'        => $HTTP_body,
                           'err_num'     => $err_num,
                           'err_msg'     => $err_msg
                         ) ;
        }
    }
