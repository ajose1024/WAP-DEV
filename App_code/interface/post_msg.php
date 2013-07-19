<?
  /* 
  * To change this template, choose Tools | Templates
  * and open the template in the editor.
  */

  include("/home/userv/public_html/App_code/config/App_code_init.php");


  // Este ficheiro, quando chamado correctamente por método POST, introduz uma
  // mensagem no queue de mensagens, na tabela apropriada na base de dados app_DB.
  // Os parametros que são passados são os seguintes:
  //
  //	$_POST['prog_ID']  = 'prog_ID' do programa que coloca a mensagem no queue
  //	                     de mensagens
  //	$_POST['seq_num']  = Número seqquencial atribuido pelo programa que coloca
  //	                     a mensagem no queue de mensagens
  //	$_POST['acl_ID']   = ACL com as permissões relevantes para esta mensagem
  //	$_POST['msg_type'] = Tipo de mensagem colocada no queue de mensagens
  //	$_POST['msg_data'] = Dados específicos da mensagem (depende do tipo de
  //	                     mensagem
  //	$_POST['sesskey']  = Identificador de sessão em cujo contexto a mensagem
  //	                     é originada
  //
  // Estes parâmetros são validados quanto a terem sido passados ou não e valores
  // por defeito são utilizados onde for apropriado



    if( $_SERVER[ 'REQUEST_METHOD' ] == 'GET' )
    {
	// Acesso por método GET

    }
    elseif( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' )
    {
	// Acesso por método POST

	// Validação dos parâmetros de entrada


print("<hr/>");
print_r($_POST);
print("<hr/>");

	// src_prog_ID=<int>
	if( isset( $_POST['src_prog_ID'] ) )
	{
	    // $_POST['src_prog_ID'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_POST['src_prog_ID'] = (int) urldecode( $_POST['src_prog_ID'] );
	}
	else
	{
	    // $POST['src_prog_ID'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_POST['src_prog_ID'] = (int) -1;
	}

	// dst_prog_ID=<int>
	if( isset( $_POST['dst_prog_ID'] ) )
	{
	    // $_POST['dst_prog_ID'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_POST['dst_prog_ID'] = (int) urldecode( $_POST['dst_prog_ID'] );
	}
	else
	{
	    // $POST['dst_prog_ID'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_POST['dst_prog_ID'] = (int) -1;
	}

	// seq_num=<int>
	if( isset( $_POST['seq_num'] ) )
	{
	    // $_POST['seq_num'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_POST['seq_num'] = (int) urldecode( $_POST['seq_num'] );
	}
	else
	{
	    // $POST['seq_num'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_POST['seq_num'] = (int) 0;
	}

	// acl_ID=<int>
	if( isset( $_POST['acl_ID'] ) )
	{
	    // $_POST['acl_ID'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_POST['acl_ID'] = (int) urldecode( $_POST['acl_ID'] );
	}
	else
	{
	    // $POST['acl_ID'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_POST['acl_ID'] = (int) -1;
	}

	// msg_type=<int>
	if( isset( $_POST['msg_type'] ) )
	{
	    // $_POST['msg_type'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_POST['msg_type'] = (int) urldecode( $_POST['msg_type'] );
	}
	else
	{
	    // $POST['msg_type'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_POST['msg_type'] = (int) -1;
	}

	// msg_data=<string>
	if( isset( $_POST['msg_data'] ) )
	{
	    // $_POST['msg_data'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_POST['msg_data'] = (string) urldecode( $_POST['msg_data'] );
	}
	else
	{
	    // $POST['msg_data'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_POST['msg_data'] = (string) '';
	}

	// sesskey=<string>
	if( isset( $_POST['sesskey'] ) )
	{
	    // $_POST['sesskey'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_POST['sesskey'] = (string) urldecode( $_POST['sesskey'] );
	}
	else
	{
	    // $POST['sesskey'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_POST['sesskey'] = (string) '';
	}

/*
	// Obtem os dados para a ligação a base de dados 'app_DB'
	$app_DB = $GLOBALS['sys_DBs_obj']->get_DB_params("app_DB");


	if ( $app_DB['status'] != 0 )
	{
            // Não consegui ter os dados de ligação a base de dados!!!
	}

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

*/

	$app_DB_open_result_array = app_DB_open( 0 );

	if( $app_DB_open_result_array['status'] != 0 )
	{
		// Não foi possivel abrir a base de dados!!!
// 		print('<hr/>');
// 		print_r($app_DB_open_result_array);
// 		print('<hr/>');
	}
	else
	{
		$ADODB_conn_obj = $app_DB_open_result_array['conn_obj'];
	}

	$sql_string =   "INSERT INTO "		.
			"app_msg_queue " 	.
			"( "			.	
				"src_prog_ID,"	.
				"dst_prog_ID,"	.
				"seq_num,"	.
				"acl_ID,"	.
				"msg_type,"	.
				"msg_data,"	.
				"sesskey"	.
			") "			.
			"VALUES "		.
			"("			.
			"'" . $_POST['src_prog_ID']	. "',"	.
			"'" . $_POST['dst_prog_ID']	. "',"	.
			"'" . $_POST['seq_num']		. "',"	.
			"'" . $_POST['acl_ID']		. "',"	.
			"'" . $_POST['msg_type']	. "',"	.
			"'" . $_POST['msg_data']	. "',"	.
			"'" . $_POST['sesskey'] 	. "' "	.
			")"
			;

	$ADODB_conn_obj->Execute($sql_string);


    	app_DB_close( $ADODB_conn_obj );


    }
    else
    {
        // Qualquer outro método, é erro:

    }


// tronco comum

	$src_prog_ID 	= $_POST['src_prog_ID'];
	$dst_prog_ID 	= $_POST['dst_prog_ID'];
	$seq_num	= $_POST['seq_num'];
	$acl_ID		= $_POST['acl_ID'];
	$msg_type	= $_POST['msg_type'];
	$msg_data	= $_POST['msg_data'];
	$sesskey 	= $_POST['sesskey'];





  //  get_data_by_GET($host, $port, $req_headers, $url, $query_str, $timeout)
  //  get_data_by_POST($host, $port, $req_headers, $url, $query_str, $timeout)
  //  get_data($host, $port, $method, $req_headers, $url, $query_str, $timeout)

	$query_data  =	'src_prog_ID=' . urlencode($src_prog_ID) . '&' .
			'dst_prog_ID='	. urlencode($dst_prog_ID) . '&' .
			'seq_num='	. urlencode($seq_num)     . '&' .
			'acl_ID='	. urlencode($acl_ID)      . '&' .
			'msg_type='	. urlencode($msg_type)    . '&' .
			'msg_data='	. urlencode($msg_data)    . '&' .
			'sesskey='	. urlencode($sesskey)
		     ;

	$req_headers = array('Content-type' => 'application/x-www-form-urlencoded');

	$ret_data = get_data_by_POST( 	"localhost",
					80,
					$req_headers,
					"/~userv/phpinfo.php",
					$query_data,
					1
				    );

	print_r($ret_data);

  ?>