<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


interface Interface_Relogios {

    // Interface para defenir os parametros de acesso à base de dados
    // 'app_DB' a ser utilizada dentro desta classe

    public function set_DB($driver,$host,$user,$password,$database);


        // Interface para retornar o objecto que representa a ligação à base
        // de dados, se esta estiver aberta.
        //
        // Este método retorna um array associativo com 2 elementos:
        //
        //      'DB_obj' = Objecto de conexão a base de dados se a ligação
        //                  à mesma estiver aberta
        //                 -1 se a ligação a base de dados estiver fechada
        //      'status' =  0:  'DB_obj' tem o objecto de ligação a base de dados
        //                 -1:  'DB_obj' tem um código de erro.

    public function get_DB_obj();


    // Interface para abrir a ligação a base de dados 'Relogios'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function open($conn_type);


    // Interface para fechar a ligação a base de dados 'Relogios'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Fecho da conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function close();


}


    class Relogios implements Interface_Relogios
    {
        // Variavel que mantem o objecto que representa a ligação a base
        // de dados dentro da classe

        private $Relogios_obj;


        // Array que guarda os dados necessarios para fazer a ligação a
        // base de dados, dentro da classe.
        // Os dados são: ( driver, host, user, password, database )

        private $Relogios_DB = array (  "driver" => "",
                                        "host" => "",
                                        "user" => "",
                                        "password" => "",
                                        "database" => ""
                                      );


        // Esta flag indica se a base de dados foi aberta ou não

        private $DB_open = FALSE;


        // Este metodo da classe recebe os parâmetros para a ligação a
        // base de dados e guarda os respectivos valores no array
        // associativo $Relogios_DB[]

        public function set_DB($driver,$host,$user,$password,$database)
        {
            $this->Relogios_DB['driver'] = $driver;
            $this->Relogios_DB['host'] = $host;
            $this->Relogios_DB['user'] = $user;
            $this->Relogios_DB['password'] = $password;
            $this->Relogios_DB['database'] = $database;
        }


        // Interface para retornar o objecto que representa a ligação à base
        // de dados, se esta estiver aberta.
        //
        // Este método retorna um array associativo com 2 elementos:
        //
        //      'DB_obj' = Objecto de conexão a base de dados se a ligação
        //                  à mesma estiver aberta
        //                 -1 se a ligação a base de dados estiver fechada
        //      'status' =  0:  'DB_obj' tem o objecto de ligação a base de dados
        //                 -1:  'DB_obj' tem um código de erro.

        public function get_DB_obj()
        {
            if ( $this->DB_open == TRUE )
            {
                // Foi invocado o método open($con_type) desta classe
                // A ligação a base de dados foi aberta, o objecto $app_DB_obj
                // é válido
                return array (  'DB_obj' => $this->Relogios_obj,
                                'status' => 0
                             );
            }
            else
            {
                // Foi invocado o método close() desta classe
                // A ligação a base de dados foi fechada, o objecto $app_DB_obj
                // não é valido
                return array (  'DB_obj' => -1 ,
                                'status' => -1
                             );
            }
        }


        // Este metodo da classe recebe um parametro indicando se a
        // conexão à base de dados é pressistente ou não.
        //
        //      $conn_type :
        //          0  =    Ligação não pressistente à base de dados
        //          1  =    Ligação pressistente à base de dados

        public function open($conn_type)
        {
            $this->Relogios_obj = &ADONewConnection($this->Relogios_DB['driver']);

            $this->DB_open = TRUE;

            switch ($conn_type)
            {
                case 0:
                    $this->Relogios_obj->Connect( $this->Relogios_DB['host'],
                                          $this->Relogios_DB['user'],
                                          $this->Relogios_DB['password'],
                                          $this->Relogios_DB['database']
                                        );
                    break;

                case 1:
                    $this->Relogios_obj->PConnect( $this->Relogios_DB['host'],
                                           $this->Relogios_DB['user'],
                                           $this->Relogios_DB['password'],
                                           $this->Relogios_DB['database']
                                         );
                    break;

                default:
                    $this->Relogios_obj->Connect( $this->Relogios_DB['host'],
                                          $this->Relogios_DB['user'],
                                          $this->Relogios_DB['password'],
                                          $this->Relogios_DB['database']
                                        );
            }

        }


        // Interface para fechar a ligação a base de dados 'Relogios'
        //
        // Este método retorna um código de erro indicando o resultado da
        // operação:
        //      0  = Fecho da conexão a base de dados feita com sucesso.
        //      -1 = Erro no acesso à base de dados

        public function close()
        {
            $this->Relogios_obj->Close();

            $this->DB_open = FALSE;
        }

    }



interface Interface_Milus {

    // Interface para queries sobre a tabela Milus da base de dados
    // Relogios
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Produto);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Relogios
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function insert($DB_conn_obj,$Milus_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Relogios
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //
    //
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Update feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function update($DB_conn_obj,$Milus_data);


    // Interface para apagar rows da tabela Milus da base de dados Relogios
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //
    //
    // Este método apaga a linha na base de dados cujo ID corresponde ao ID
    // que é passado.
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Delete feito com sucesso.
    //      -1 = Erro no acesso à bbase de dados.

    public function delete($DB_conn_obj,$Milus_data);


}


    class Milus implements Interface_Milus
    {
        // Array que guarda os dados de uma row da tabela 'Milus'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Milus_data = array (   'ID_Produto' => 0,
                                        'Referencia' => '',
                                        'Ref_Milus' => '',
                                        'Colecao' => '',
                                        'Descricao' => '',
                                        'Corpo_Relogio' => '',
                                        'Cor_Mostrador' => '',
                                        'Diamantes_Corats' => 0,
                                        'Funcionalidades' => '',
                                        'Pictogramas' => 0

                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Milus_data

        private $Milus_result_set = array ( 'num_items' => 0 );


        // Variavel que guarda a linha SQL a ser executada pelo motor
        // da base de dados

        private $sql_string;


        // Variavel que guarda o objecto retornado pelo metodo Execute()
        // do objecto que identifica a ligação a base de dados.

        private $Result_Set;


        // Esta variavel é utilizada para guardar temporariamente uma
        // linha da tabela da base de dados durante o processamento do
        // result set da query

        private $table_row = array ();


        public function query($DB_conn_obj,$ID_Produto)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Milus " .
                                "WHERE " .
                                "ID_Produto='" . $ID_Produto . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Milus_result_set, $this->table_row );
                    $this->Milus_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Milus_result_set['num_items'] = -1;
            }
            return $this->Milus_result_set;
        }



        public function insert($DB_conn_obj,$Milus_data)
        {
            $this->sql_string = "INSERT INTO ".
                                "Milus (" .
                                " ID_Produto," .
                                " Referencia," .
                                " Ref_Milus," .
                                " Colecao," .
                                " Descricao," .
                                " Corpo_Relogio," .
                                " Cor_Mostrador," .
                                " Diamantes_Corats," .
                                " Funcionalidades," .
                                " Pictogramas)" .
                                " VALUES  (" .
                                " '" . $Milus_data['ID_Produto'] . "'," .
                                " '" . $Milus_data['Referencia'] . "'," .
                                " '" . $Milus_data['Ref_Milus'] . "'," .
                                " '" . $Milus_data['Colecao'] . "'," .
                                " '" . $Milus_data['Descricao'] . "'," .
                                " '" . $Milus_data['Corpo_Relogio'] . "'," .
                                " '" . $Milus_data['Cor_Mostrador'] . "'," .
                                " '" . $Milus_data['Diamantes_Corats'] . "'," .
                                " '" . $Milus_data['Funcionalidades'] . "'," .
                                " '" . $Milus_data['Pictogramas'] . "')"
                               ;


            $this->Result_Set = $DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set === false )
            {
               return -1;
            }
            else
            {
                return 0;
            }
       }


        public function update($DB_conn_obj,$Milus_data)
        {
            $this->sql_string = "UPDATE ".
                                "Milus " .
                                "SET " .
                                " Referencia='" . $Milus_data['Referencia'] . "'," .
                                " Ref_Milus='" . $Milus_data['Ref_Milus'] . "'," .
                                " Colecao='" . $Milus_data['Colecao'] . "'," .
                                " Descricao='" . $Milus_data['Descricao'] . "'," .
                                " Corpo_Relogio='" . $Milus_data['Corpo_Relogio'] . "'," .
                                " Cor_Mostrador='" . $Milus_data['Cor_Mostrador'] . "'," .
                                " Diamantes_Corats='" . $Milus_data['Diamantes_Corats'] . "'," .
                                " Funcionalidades='" . $Milus_data['Funcionalidades'] . "'," .
                                " Pictogramas='" . $Milus_data['Pictogramas'] . "' " .
                                "WHERE " .
                                "ID_Produto='" . $Milus_data['ID_Produto'] . "' "
                              ;


            $this->Result_Set = $DB_conn_obj->Execute( $this->sql_string );



            if ( $this->Result_Set === false )
            {
                return -1;
            }
            else
            {
                return 0;
            }
        }


        public function delete($DB_conn_obj,$Milus_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Milus " .
                                "WHERE " .
                                "ID_Produto='" . $Milus_data['ID_Produto'] . "' "
                              ;
print('<hr/>');
print($this->sql_string);
print('<hr/>');

            $this->Result_Set = $DB_conn_obj->Execute( $this->sql_string );

print('<hr/>');
print_r($this->Result_Set);
print('<hr/>');

            if ( $this->Result_Set === false )
            {
                return -1;
            }
            else
            {
                return 0;
            }
        }

    }



?>
