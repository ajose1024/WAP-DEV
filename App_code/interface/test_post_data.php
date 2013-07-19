<?
  /* 
  * To change this template, choose Tools | Templates
  * and open the template in the editor.
  */

  include("/home/userv/public_html/App_code/config/App_code_init.php");

  //  get_data_by_GET($host, $port, $req_headers, $url, $query_str, $timeout)
  //  get_data_by_POST($host, $port, $req_headers, $url, $query_str, $timeout)
  //  get_data($host, $port, $method, $req_headers, $url, $query_str, $timeout)



	// Validação dos parâmetros de entrada

	// src_prog_ID=<int>
	if( isset( $_GET['src_prog_ID'] ) )
	{
	    // $_GET['src_prog_ID'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_GET['src_prog_ID'] = (int) $_GET['src_prog_ID'];
	}
	else
	{
	    // $GET['src_prog_ID'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_GET['src_prog_ID'] = (int) -1;
	}

	// dst_prog_ID=<int>
	if( isset( $_GET['dst_prog_ID'] ) )
	{
	    // $_GET['dst_prog_ID'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_GET['dst_prog_ID'] = (int) $_GET['dst_prog_ID'];
	}
	else
	{
	    // $GET['dst_prog_ID'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_GET['dst_prog_ID'] = (int) -1;
	}

	// seq_num=<int>
	if( isset( $_GET['seq_num'] ) )
	{
	    // $_GET['seq_num'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_GET['seq_num'] = (int) $_GET['seq_num'];
	}
	else
	{
	    // $GET['seq_num'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_GET['seq_num'] = (int) 0;
	}

	// acl_ID=<int>
	if( isset( $_GET['acl_ID'] ) )
	{
	    // $_GET['acl_ID'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_GET['acl_ID'] = (int) $_GET['acl_ID'];
	}
	else
	{
	    // $GET['acl_ID'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_GET['acl_ID'] = (int) -1;
	}

	// msg_type=<int>
	if( isset( $_GET['msg_type'] ) )
	{
	    // $_GET['msg_type'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_GET['msg_type'] = (int) $_GET['msg_type'];
	}
	else
	{
	    // $GET['msg_type'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_GET['msg_type'] = (int) -1;
	}

	// msg_data=<string>
	if( isset( $_GET['msg_data'] ) )
	{
	    // $_GET['msg_data'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_GET['msg_data'] = (string) $_GET['msg_data'];
	}
	else
	{
	    // $GET['msg_data'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_GET['msg_data'] = (string) '';
	}

	// sesskey=<string>
	if( isset( $_GET['sesskey'] ) )
	{
	    // $_GET['sesskey'] está definido
	    // Utilizar o valor passado, depois de garantido o tipo correcto
	    $_GET['sesskey'] = (string) $_GET['sesskey'];
	}
	else
	{
	    // $GET['sesskey'] NÃO está definido
	    // Utilizar um valor por defeito (-1 neste caso)
	    $_GET['sesskey'] = (string) '';
	}

print("<hr/>");
print_r($_GET);
print("<hr/>");

	$prog_ID  = $_GET['src_prog_ID'];
	$prog_ID  = $_GET['dst_prog_ID'];
	$seq_num  = $_GET['seq_num'];
	$acl_ID   = $_GET['acl_ID'];
	$msg_type = $_GET['msg_type'];
	$msg_data = $_GET['msg_data'];
	$sesskey  = $_GET['sesskey'];



	$query_data  =	'src_prog_ID='	. urlencode($src_prog_ID) . '&' .
			'dst_prog_ID='	. urlencode($dst_prog_ID) . '&' .
			'seq_num='	. urlencode($seq_num)     . '&' .
			'acl_ID='	. urlencode($acl_ID)      . '&' .
			'msg_type='	. urlencode($msg_type)    . '&' .
			'msg_data='	. urlencode($msg_data)    . '&' .
			'sesskey='	. urlencode($sesskey)
		     ;

print($query_data);
print("<hr/>");

	$req_headers = array('Content-type' => 'application/x-www-form-urlencoded');

	$ret_data = get_data_by_POST( 	"localhost",
					80,
					$req_headers,
					"/~userv/App_code/interface/post_msg.php",
					$query_data,
					1
				    );

	print_r($ret_data);

  ?>