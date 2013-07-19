<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


interface Interface_app_data_storage
{
    // Esta classe implementa um sistema de armazenamento pressistente utilizando
    // a tabela 'app_data_storage' na base de dados 'app_DB'
    //
    // Isto permite o armazenameto de informação que seja necessária à aplicação
    // sendo gerada uma chave de acesso, aleatória, para cada elemento que for
    // guardado (a mesma é garantida ser única), a qual seervirá para todos os
    // acessos posteriores à informação guardada até a mesma ser apagada.


    // Método:  set_key_len( $len )
    //
    // Este método define o tamanho da chave a ser utilizada no 'data_store',
    // o qual tem de ser entre 16 e 64 caracteres.
    //
    // Se o tamanho estiver fora do valor referido, a mesma é defenida, por
    // defeito como sendo de 32 caracteres
    //
    // Uma vez utilizado este método, o tamanho da chave não pode ser mais
    // mudado para o objecto instancializado

    public function set_key_len( $len );


    // Método:	get_key_len()
    //
    // Este método retorna o tamanho da chave em uso no presente 'data_storage'

    public function get_key_len();


    // Método:  $result = store( $data )
    //
    // Este método recebe uma string com os dados a armazenar, gera uma chave
    // alfanumérica aleatória de comprimento fixo
    //
    // O valor retornado é um array com a seguinte estrutura:
    //	$result['status'] = 0 --> Os dados foram aramzenados com exito e o
    //				  elemento 'data_key' é valido
    //			  = -1 -> Não foi possivel armazenar os dados e o
    //				  elemento 'data_key' não é válido
    //	$result['data_key] = String vazia ou string com a 'data_key'

    public function store( $data );


    // Método:  $data = load( $data_key )
    //
    // Este método recebe uma chave alfanumérica retornada por uma utilização
    // anterior do método store($data) e retorna os dados guardados associados
    // a essa chave sem, no entanto, os apagar da tabela 'app_data_storage' da
    // base de dados 'app_DB'
    //
    // O valor retornado é um array com a seguinte estrutura:
    //	$result['status'] = 0 --> Os dados foram lidos com exito e estão no
    //				  elemento 'data'
    //			  = -1 -> Não foi possivel ler os dados e o elemento
    //				  'data' é uma string vazia
    //	$result['data]    = String vazia ou string com os dados pedidos

    public function load( $data_key );


    // Método:  $data = fetch( $data_key )
    //
    // Este método recebe uma chave alfanumérica retornada por uma utilização
    // anterior do método store($data) e retorna os dados guardados associados
    // a essa chave apagando-os da tabela 'app_data_storage' da base de dados
    // 'app_DB'
    //
    // O valor retornado é um array com a seguinte estrutura:
    //	$result['status'] = 0 --> Os dados foram lidos com exito e estão no
    //				  elemento 'data'
    //			  = -1 -> Não foi possivel ler os dados e o elemento
    //				  'data' é uma string vazia
    //	$result['data]    = String vazia ou string com os dados pedidos

    public function fetch( $data_key );


    // Método:  (void) = delete( $data_key )
    //
    // Este método recebe uma chave alfanumerica retornada por uma utilização
    // anterior do método store($data) e apaga os dados guardados associados
    // a essa chave da tabela 'app_data_storage' na base de dados 'app_DB'
    //
    // O valor retornado é um array com a seguinte estrutura:
    //	$result['status'] = 0 --> Os dados foram apagados com exito e o elemento
    //				  'data' é uma string vazia
    //			  = -1 -> Não foi possivel apagar os dados com exito e o
    //				  elemento 'data' é uma string vazia
    //	$result['data]    = Neste método este elemento é sempre uma string vazia


    public function delete( $data_key );

}


class app_data_storage implements Interface_app_data_storage
{
    // Esta classe implementa um sistema de armazenamento pressistente utilizando
    // a tabela 'app_data_storage' na base de dados 'app_DB'
    //
    // Isto permite o armazenameto de informação que seja necessária à aplicação
    // sendo gerada uma chave de acesso, aleatória, para cada elemento que for
    // guardado (a mesma é garantida ser única), a qual seervirá para todos os
    // acessos posteriores à informação guardada até a mesma ser apagada.


    // Esta variável privada guarda o valor do tamanho da chave para ser utilizado
    // no objecto de 'data_store'.

    private $key_len = 0;


    // Método:  set_key_len( $len )
    //
    // Este método define o tamanho da chave a ser utilizada no 'data_store',
    // o qual tem de ser entre 16 e 63 caracteres.
    //
    // Se o tamanho estiver fora do valor referido, a mesma é defenida, por
    // defeito como sendo de 32 caracteres
    //
    // Uma vez utilizado este método, o tamanho da chave não pode ser mais
    // mudado para o objecto instancializado

    public function set_key_len( $len )
    {
        if( $this->key_len == 0 )
        {
            $this->key_len = within( $len, 16, 63 ) ;
        }
    }


    // Método:	get_key_len()
    //
    // Este método retorna o tamanho da chave em uso no presente 'data_storage'

    public function get_key_len()
    {
        return  $this->key_len ;
    }


    // Método:  $result = store( $data )
    //
    // Este método recebe uma string com os dados a armazenar, gera uma chave
    // alfanumérica aleatória de comprimento fixo
    //
    // O valor retornado é um array com a seguinte estrutura:
    //	$result['status'] = 0 --> Os dados foram aramzenados com exito e o
    //				  elemento 'data_key' é valido
    //			  = -1 -> Não foi possivel armazenar os dados e o
    //				  elemento 'data_key' não é válido
    //			  = -2 -> O comprimento da chave ainda não foi definido
    //	$result['data_key] = String vazia ou string com a 'data_key'

    public function store( $data )
    {
	$result = array ( 'status'   => 0,
			  'data_key' => ''
			);

        if( $this->key_len == 0 )
        {
            $result['status'] = -2;
            return  $result;
        }

	// Gera uma chave alatória e garante que a mesma não existe ainda na tabela
	// na base de dados

	$key_repeated = 0;


	while ( $key_repeated == 0 )
	{

        	$data_key = mk_rnd_akey( $this->key_len );

		



	}

    }


    // Método:  $data = load( $data_key )
    //
    // Este método recebe uma chave alfanumérica retornada por uma utilização
    // anterior do método store($data) e retorna os dados guardados associados
    // a essa chave sem, no entanto, os apagar da tabela 'app_data_storage' da
    // base de dados 'app_DB'
    //
    // O valor retornado é um array com a seguinte estrutura:
    //	$result['status'] = 0 --> Os dados foram lidos com exito e estão no
    //				  elemento 'data'
    //			  = -1 -> Não foi possivel ler os dados e o elemento
    //				  'data' é uma string vazia
    //	$result['data]    = String vazia ou string com os dados pedidos

    public function load( $data_key )
    {

    }


    // Método:  $data = fetch( $data_key )
    //
    // Este método recebe uma chave alfanumérica retornada por uma utilização
    // anterior do método store($data) e retorna os dados guardados associados
    // a essa chave apagando-os da tabela 'app_data_storage' da base de dados
    // 'app_DB'
    //
    // O valor retornado é um array com a seguinte estrutura:
    //	$result['status'] = 0 --> Os dados foram lidos com exito e estão no
    //				  elemento 'data'
    //			  = -1 -> Não foi possivel ler os dados e o elemento
    //				  'data' é uma string vazia
    //	$result['data]    = String vazia ou string com os dados pedidos

    public function fetch( $data_key )
    {

    }


    // Método:  (void) = delete( $data_key )
    //
    // Este método recebe uma chave alfanumerica retornada por uma utilização
    // anterior do método store($data) e apaga os dados guardados associados
    // a essa chave da tabela 'app_data_storage' na base de dados 'app_DB'
    //
    // O valor retornado é um array com a seguinte estrutura:
    //	$result['status'] = 0 --> Os dados foram apagados com exito e o elemento
    //				  'data' é uma string vazia
    //			  = -1 -> Não foi possivel apagar os dados com exito e o
    //				  elemento 'data' é uma string vazia
    //	$result['data]    = Neste método este elemento é sempre uma string vazia


    public function delete( $data_key )
    {

    }

}


?>