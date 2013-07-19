<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


interface Interface_Empresas {

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


    // Interface para abrir a ligação a base de dados 'Empresas'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function open($conn_type);


    // Interface para fechar a ligação a base de dados 'Empresas'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Fecho da conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function close();


}


    class Empresas implements Interface_Empresas
    {
        // Variavel que mantem o objecto que representa a ligação a base
        // de dados dentro da classe

        private $Empresas_obj;


        // Array que guarda os dados necessarios para fazer a ligação a
        // base de dados, dentro da classe.
        // os dados são: ( driver, hos, user, password, database )

        private $Empresas_DB = array (  "driver" => "",
                                        "host" => "",
                                        "user" => "",
                                        "password" => "",
                                        "database" => ""
                                      );


        // Esta flag indica se a base de dados foi aberta ou não

        private $DB_open = FALSE;


        // Este metodo da classe recebe os parâmetros para a ligação a
        // base de dados e guarda os respectivos valores no array
        // associativo $Empresas_DB[]

        public function set_DB($driver,$host,$user,$password,$database)
        {
            $this->Empresas_DB['driver'] = $driver;
            $this->Empresas_DB['host'] = $host;
            $this->Empresas_DB['user'] = $user;
            $this->Empresas_DB['password'] = $password;
            $this->Empresas_DB['database'] = $database;
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
                return array (  'DB_obj' => $this->Empresas_obj,
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
            $this->Empresas_obj = &ADONewConnection($this->Empresas_DB['driver']);

            $this->DB_open = TRUE;

            switch ($conn_type)
            {
                case 0:
                    $this->Empresas_obj->Connect( $this->Empresas_DB['host'],
                                          $this->Empresas_DB['user'],
                                          $this->Empresas_DB['password'],
                                          $this->Empresas_DB['database']
                                        );
                    break;

                case 1:
                    $this->Empresas_obj->PConnect( $this->Empresas_DB['host'],
                                           $this->Empresas_DB['user'],
                                           $this->Empresas_DB['password'],
                                           $this->Empresas_DB['database']
                                         );
                    break;

                default:
                    $this->Empresas_obj->Connect( $this->Empresas_DB['host'],
                                          $this->Empresas_DB['user'],
                                          $this->Empresas_DB['password'],
                                          $this->Empresas_DB['database']
                                        );
            }

        }


        // Interface para fechar a ligação a base de dados 'Empresas'
        //
        // Este método retorna um código de erro indicando o resultado da
        // operação:
        //      0  = Fecho da conexão a base de dados feita com sucesso.
        //      -1 = Erro no acesso à base de dados

        public function close()
        {
            $this->Empresas_obj->Close();

            $this->DB_open = FALSE;
        }

    }


 interface Interface_Clientes {

    // Interface para queries sobre a tabela Clientes da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Clientes);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Clientes_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Clientes_data);


    // Interface para apagar rows da tabela Clientes da base de dados Empresas
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

    public function delete($DB_conn_obj,$Clientes_data);


}


    class Clientes implements Interface_Clientes
    {
        // Array que guarda os dados de uma row da tabela 'Clientes'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Clientes_data = array (
                                        'ID_Clientes' => 0,
                                        'ID_Morada'   => 0,
                                        'ID_Contactos'=> 0,
                                        'ID_Empresa'  => 0,
                                        'Nome'        => ''
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Clientes_data

        private $Clientes_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$ID_Clientes)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Clientes " .
                                "WHERE " .
                                "ID_Clientes='" . $ID_Clientes . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Clientes_result_set, $this->table_row );
                    $this->Clientes_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Clientes_result_set['num_items'] = -1;
            }
            return $this->Clientes_result_set;
        }



        public function insert($DB_conn_obj,$Clientes_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Clientes (" .
                                " ID_Cliente," .
                                " ID_Morada," .
                                " ID_Contactos," .
                                " ID_Empresa," .
                                " Nome)" .
                                " VALUES  (" .
                                " '" . $Clientes_data['ID_Cliente'] . "'," .
                                " '" . $Clientes_data['ID_Morada'] . "'," .
                                " '" . $Clientes_data['ID_Contactos'] . "'," .
                                " '" . $Clientes_data['ID_Empresa'] . "'," .
                                " '" . $Clientes_data['Nome'] . "')"
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


        public function update($DB_conn_obj,$Clientes_data)
        {
            $this->sql_string = "UPDATE ".
                                "Clientes " .
                                "SET " .
                                " ID_Morada='"    . $Clientes_data['ID_Morada'] . "'," .
                                " ID_Contactos='" . $Clientes_data['ID_Contactos'] . "'," .
                                " ID_Empresa='"   . $Clientes_data['ID_Empresa'] . "'," .
                                " Nome='"         . $Clientes_data['Nome'] . "' " .
                                "WHERE " .
                                "ID_Cliente='"   . $Clientes_data['ID_Cliente'] . "' "
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


        public function delete($DB_conn_obj,$Clientes_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Clientes " .
                                "WHERE " .
                                "ID_Cliente='" . $Clientes_data['ID_Cliente'] . "' "
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

    }

 interface Interface_Cod_Postal {

    // Interface para queries sobre a tabela Cod_Postal da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Codigo_Postal);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Cod_Postal_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Cod_Postal_data);


    // Interface para apagar rows da tabela Cod_Postal da base de dados Empresas
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

    public function delete($DB_conn_obj,$Cod_Postal_data);


}


    class Cod_Postal implements Interface_Cod_Postal
    {
        // Array que guarda os dados de uma row da tabela 'Cod_Postal'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Cod_Postal_data = array (
                                        'ID_Codigo_Postal' => 0,
                                        'Codigo'           => 0,
                                        'Sub_Codigo'       => 0,
                                        'ID_Localidade'    => 0
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Cod_Postal_data

        private $Cod_Postal_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$ID_Codigo_Postal)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Cod_Postal " .
                                "WHERE " .
                                "ID_Codigo_Postal='" . $ID_Codigo_Postal . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Cod_Postal_result_set, $this->table_row );
                    $this->Cod_Postal_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Cod_Postal_result_set['num_items'] = -1;
            }
            return $this->Cod_Postal_result_set;
        }



        public function insert($DB_conn_obj,$Cod_Postal_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Cod_Postal (" .
                                " ID_Codigo_Postal," .
                                " Codigo," .
                                " Sub_Codigo," .
                                " ID_Localidade)" .
                                " VALUES  (" .
                                " '" . $Cod_Postal_data['ID_Codigo_Postal'] . "'," .
                                " '" . $Cod_Postal_data['Codigo'] . "'," .
                                " '" . $Cod_Postal_data['Sub_Codigo'] . "'," .
                                " '" . $Cod_Postal_data['ID_Localidade'] . "')"
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


        public function update($DB_conn_obj,$Cod_Postal_data)
        {
            $this->sql_string = "UPDATE ".
                                "Cod_Postal " .
                                "SET " .
                                " Codigo='"          . $Cod_Postal_data['Codigo'] . "'," .
                                " Sub_Codigo='"      . $Cod_Postal_data['Sub_Codigo'] . "'," .
                                " ID_Localidade='"   . $Cod_Postal_data['ID_Localidade'] . "' " .
                                "WHERE " .
                                "ID_Codigo_Postal='" . $Cod_Postal_data['ID_Codigo_Postal'] . "' "
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


        public function delete($DB_conn_obj,$Cod_Postal_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Cod_Postal " .
                                "WHERE " .
                                "ID_Codigo_Postal='" . $Cod_Postal_data['ID_Codigo_Postal'] . "' "
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

    }

 interface Interface_Empresa {

    // Interface para queries sobre a tabela Empresa da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Empresa);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Empresa_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Empresa_data);


    // Interface para apagar rows da tabela Empresa da base de dados Empresas
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

    public function delete($DB_conn_obj,$Empresa_data);


}


    class Empresa implements Interface_Empresa
    {
        // Array que guarda os dados de uma row da tabela 'Empresa'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Empresa_data = array (
                                        'ID_Empresa'     => 0,
                                        'ID_Contactos'   => 0,
                                        'ID_Fornecedores'=> 0,
                                        'ID_Morada'      => 0,
                                        'Nome'           => '',
                                        'Ramo'           => ''
                                    );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Empresa_data

        private $Empresa_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$ID_Empresa)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Empresa " .
                                "WHERE " .
                                "ID_Empresa='" . $ID_Empresa . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Empresa_result_set, $this->table_row );
                    $this->Empresa_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Empresa_result_set['num_items'] = -1;
            }
            return $this->Empresa_result_set;
        }



        public function insert($DB_conn_obj,$Empresa_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Empresa (" .
                                " ID_Empresa," .
                                " ID_Contactos," .
                                " ID_Fornecedores," .
                                " ID_Morada," .
                                " Nome," .
                                " Ramo)" .
                                " VALUES  (" .
                                " '" . $Empresa_data['ID_Empresa'] . "'," .
                                " '" . $Empresa_data['ID_Contactos'] . "'," .
                                " '" . $Empresa_data['ID_Fornecedores'] . "'," .
                                " '" . $Empresa_data['ID_Morada'] . "'," .
                                " '" . $Empresa_data['Nome'] . "',".
                                " '" . $Empresa_data['Ramo'] . "')"
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


        public function update($DB_conn_obj,$Empresa_data)
        {
            $this->sql_string = "UPDATE ".
                                "Empresa " .
                                "SET " .
                                " ID_Contactos='"   . $Empresa_data['ID_Contactos'] . "'," .
                                " ID_Fornecedores='". $Empresa_data['ID_Fornecedores'] . "'," .
                                " ID_Morada='"      . $Empresa_data['ID_Morada'] . "'," .
                                " Nome='"           . $Empresa_data['Nome']. "'," .
                                " Ramo='"           . $Empresa_data['Ramo'] . "' " .
                                "WHERE " .
                                "ID_Empresa='" . $Empresa_data['ID_Empresa'] . "' "
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


        public function delete($DB_conn_obj,$Empresa_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Empresa " .
                                "WHERE " .
                                "ID_Empresa='" . $Empresa_data['ID_Empresa'] . "' "
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

    }



 interface Interface_Fornecedores {

    // Interface para queries sobre a tabela Fornecedores da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Fornecedor);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Fornecedores_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Fornecedores_data);


    // Interface para apagar rows da tabela Fornecedores da base de dados Empresas
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

    public function delete($DB_conn_obj,$Fornecedores_data);


}


    class Fornecedores implements Interface_Fornecedores
    {
        // Array que guarda os dados de uma row da tabela 'Fornecedores'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Fornecedores_data = array (
                                        'ID_Fornecedor' => 0,
                                        'ID_Empresa'    => 0,
                                        'ID_Produto'    => 0
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Fornecedores_data

        private $Fornecedores_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$ID_Fornecedor)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Fornecedores " .
                                "WHERE " .
                                "ID_Fornecedor='" . $ID_Fornecedor . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Fornecedores_result_set, $this->table_row );
                    $this->Fornecedores_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Fornecedores_result_set['num_items'] = -1;
            }
            return $this->Fornecedores_result_set;
        }



        public function insert($DB_conn_obj,$Fornecedores_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Fornecedores (" .
                                " ID_Fornecedor," .
                                " ID_Empresa," .
                                " ID_Produto)" .
                                " VALUES  (" .
                                " '" . $Fornecedores_data['ID_Fornecedor'] . "'," .
                                " '" . $Fornecedores_data['ID_Empresa'] . "'," .
                                " '" . $Fornecedores_data['ID_Produto']. "')"
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


        public function update($DB_conn_obj,$Fornecedores_data)
        {
            $this->sql_string = "UPDATE ".
                                "Fornecedores " .
                                "SET " .
                                " ID_Empresa='" . $Fornecedores_data['ID_Empresa'] . "'," .
                                " ID_Produto='" . $Fornecedores_data['ID_Produto'] . "' " .
                                "WHERE " .
                                "ID_Fornecedor='" . $Fornecedores_data['ID_Fornecedor'] . "' "
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


        public function delete($DB_conn_obj,$Fornecedores_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Fornecedores " .
                                "WHERE " .
                                "ID_Fornecedor='" . $Fornecedores_data['ID_Fornecedor'] . "' "
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

    }





 interface Interface_ID_Tipo_Produto {

    // Interface para queries sobre a tabela ID_Tipo_Produto da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Tipo_Produto);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$ID_Tipo_Produto_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$ID_Tipo_Produto_data);


    // Interface para apagar rows da tabela ID_Tipo_Produto da base de dados Empresas
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

    public function delete($DB_conn_obj,$ID_Tipo_Produto_data);


}


    class ID_Tipo_Produto implements Interface_ID_Tipo_Produto
    {
        // Array que guarda os dados de uma row da tabela 'ID_Tipo_Produto'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $ID_Tipo_Produto_data = array (
                                        'ID_Tipo_Produto' => 0,
                                        'DB_Name'         => '',
                                        'DB_Table'        => '',
                                        'Tipo_Produto'    => ''
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $ID_Tipo_Produto_data

        private $ID_Tipo_Produto_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$ID_Tipo_Produto)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "ID_Tipo_Produto " .
                                "WHERE " .
                                "ID_Tipo_Produto='" . $ID_Tipo_Produto . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->ID_Tipo_Produto_result_set, $this->table_row );
                    $this->ID_Tipo_Produto_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->ID_Tipo_Produto_result_set['num_items'] = -1;
            }
            return $this->ID_Tipo_Produto_result_set;
        }



        public function insert($DB_conn_obj,$ID_Tipo_Produto_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " ID_Tipo_Produto (" .
                                " ID_Tipo_Produto," .
                                " DB_Name," .
                                " DB_Table," .
                                " Tipo_Produto)" .
                                " VALUES  (" .
                                " '" . $ID_Tipo_Produto_data['ID_Tipo_Produto'] . "'," .
                                " '" . $ID_Tipo_Produto_data['DB_Name'] . "'," .
                                " '" . $ID_Tipo_Produto_data['DB_Table'] . "'," .
                                " '" . $ID_Tipo_Produto_data['Tipo_Produto'] . "')"
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


        public function update($DB_conn_obj,$ID_Tipo_Produto_data)
        {
            $this->sql_string = "UPDATE ".
                                "ID_Tipo_Produto " .
                                "SET " .
                                " DB_Name='"      . $ID_Tipo_Produto_data['DB_Name'] . "'," .
                                " DB_Table='"     . $ID_Tipo_Produto_data['DB_Table'] . "'," .
                                " Tipo_Produto='" . $ID_Tipo_Produto_data['Tipo_Produto'] . "' " .
                                "WHERE " .
                                "ID_Tipo_Produto='" . $ID_Tipo_Produto_data['ID_Tipo_Produto'] . "' "
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


        public function delete($DB_conn_obj,$ID_Tipo_Produto_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "ID_Tipo_Produto " .
                                "WHERE " .
                                "ID_Tipo_Produto='" . $ID_Tipo_Produto_data['ID_Tipo_Produto'] . "' "
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

    }



 interface Interface_IVA {

    // Interface para queries sobre a tabela IVA da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Classe_IVA);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$IVA_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$IVA_data);


    // Interface para apagar rows da tabela IVA da base de dados Empresas
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

    public function delete($DB_conn_obj,$IVA_data);


}


    class IVA implements Interface_IVA
    {
        // Array que guarda os dados de uma row da tabela 'IVA'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $IVA_data = array (
                                        'Classe_IVA' => 0,
                                        'Taxa_IVA'   => 0
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $IVA_data

        private $IVA_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Classe_IVA)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "IVA " .
                                "WHERE " .
                                "Classe_IVA='" . $Classe_IVA . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->IVA_result_set, $this->table_row );
                    $this->IVA_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->IVA_result_set['num_items'] = -1;
            }
            return $this->IVA_result_set;
        }



        public function insert($DB_conn_obj,$IVA_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " IVA (" .
                                " Classe_IVA," .
                                " Taxa_IVA)" .
                                " VALUES  (" .
                                " '" . $IVA_data['Classe_IVA'] . "'," .
                                " '" . $IVA_data['Taxa_IVA'] . "')"
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


        public function update($DB_conn_obj,$IVA_data)
        {
            $this->sql_string = "UPDATE ".
                                "IVA " .
                                "SET " .
                                " Taxa_IVA='"   . $IVA_data['Taxa_IVA'] . "' " .
                                "WHERE " .
                                "Classe_IVA='" . $IVA_data['Classe_IVA'] . "' "
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


        public function delete($DB_conn_obj,$IVA_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "IVA " .
                                "WHERE " .
                                "Classe_IVA='" . $IVA_data['Classe_IVA'] . "' "
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

    }



 interface Interface_Img_Produto {

    // Interface para queries sobre a tabela Img_Produto da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Imagem);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Img_Produto_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Img_Produto_data);


    // Interface para apagar rows da tabela Img_Produto da base de dados Empresas
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

    public function delete($DB_conn_obj,$Img_Produto_data);


}


    class Img_Produto implements Interface_Img_Produto
    {
        // Array que guarda os dados de uma row da tabela 'Img_Produto'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Img_Produto_data = array (
                                        'ID_Imagem'   => 0,
                                        'ID_Produto'  => 0,
                                        'Image_Src'   => ''
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Img_Produto_data

        private $Img_Produto_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$ID_Imagem)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Img_Produto " .
                                "WHERE " .
                                "ID_Imagem='" . $ID_Imagem . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Img_Produto_result_set, $this->table_row );
                    $this->Img_Produto_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Img_Produto_result_set['num_items'] = -1;
            }
            return $this->Img_Produto_result_set;
        }



        public function insert($DB_conn_obj,$Img_Produto_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Img_Produto (" .
                                " ID_Imagem," .
                                " ID_Produto," .
                                " Image_Src)" .
                                " VALUES  (" .
                                " '" . $Img_Produto_data['ID_Imagem'] . "'," .
                                " '" . $Img_Produto_data['ID_Produto'] . "'," .
                                " '" . $Img_Produto_data['Image_Src'] . "')"
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


        public function update($DB_conn_obj,$Img_Produto_data)
        {
            $this->sql_string = "UPDATE ".
                                "Img_Produto " .
                                "SET " .
                                " ID_Produto='" . $Img_Produto_data['ID_Produto'] . "'," .
                                " Image_Src='"  . $Img_Produto_data['Image_Src'] . "' " .
                                "WHERE " .
                                "ID_Imagem='" . $Img_Produto_data['ID_Imagem'] . "' "
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


        public function delete($DB_conn_obj,$Img_Produto_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Img_Produto " .
                                "WHERE " .
                                "ID_Imagem='" . $Img_Produto_data['ID_Imagem'] . "' "
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

    }

 interface Interface_Localidade {

    // Interface para queries sobre a tabela Localidade da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Localidade);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Localidade_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Localidade_data);


    // Interface para apagar rows da tabela Localidade da base de dados Empresas
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

    public function delete($DB_conn_obj,$Localidade_data);


}


    class Localidade implements Interface_Localidade
    {
        // Array que guarda os dados de uma row da tabela 'Localidade'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Localidade_data = array (
                                        'ID_Localidade' => 0,
                                        'Localidade'    => ''
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Localidade_data

        private $Localidade_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$ID_Localidade)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Localidade " .
                                "WHERE " .
                                "ID_Localidade='" . $ID_Localidade . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Localidade_result_set, $this->table_row );
                    $this->Localidade_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Localidade_result_set['num_items'] = -1;
            }
            return $this->Localidade_result_set;
        }



        public function insert($DB_conn_obj,$Localidade_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Localidade (" .
                                " ID_Localidade," .
                                " Localidade)" .
                                " VALUES  (" .
                                " '" . $Localidade_data['ID_Localidade'] . "'," .
                                " '" . $Localidade_data['Localidade'] . "')"
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


        public function update($DB_conn_obj,$Localidade_data)
        {
            $this->sql_string = "UPDATE ".
                                "Localidade " .
                                "SET " .
                                " Localidade='" . $Localidade_data['Localidade'] . "' " .
                                "WHERE " .
                                "ID_Localidade='" . $Localidade_data['ID_Localidade'] . "' "
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


        public function delete($DB_conn_obj,$Localidade_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Localidade " .
                                "WHERE " .
                                "ID_Localidade='" . $Localidade_data['ID_Localidade'] . "' "
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

    }


 interface Interface_Morada {

    // Interface para queries sobre a tabela Morada da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Morada);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Morada_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Morada_data);


    // Interface para apagar rows da tabela Morada da base de dados Empresas
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

    public function delete($DB_conn_obj,$Morada_data);


}


    class Morada implements Interface_Morada
    {
        // Array que guarda os dados de uma row da tabela 'Morada'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Morada_data = array (
                                        'ID_Morada'       => 0,
                                        'ID_Localidade'   => 0,
                                        'ID_Codigo_Postal'=> 0,
                                        'Rua'             => '',
                                        'Pais'            => '',
                                        'Andar'           => '',
                                        'Numero_Lote'     => 0
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Morada_data

        private $Morada_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$ID_Morada)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Morada " .
                                "WHERE " .
                                "ID_Morada='" . $ID_Morada . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Morada_result_set, $this->table_row );
                    $this->Morada_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Morada_result_set['num_items'] = -1;
            }
            return $this->Morada_result_set;
        }



        public function insert($DB_conn_obj,$Morada_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Morada (" .
                                " ID_Morada," .
                                " ID_Localidade," .
                                " ID_Codigo_Postal," .
                                " Rua," .
                                " Pais," .
                                " Andar," .
                                " Numero_Lote)" .
                                " VALUES  (" .
                                " '" . $Morada_data['ID_Morada'] . "'," .
                                " '" . $Morada_data['ID_Localidade'] . "'," .
                                " '" . $Morada_data['ID_Codigo_Postal'] . "'," .
                                " '" . $Morada_data['Rua'] . "'," .
                                " '" . $Morada_data['Pais']. "'," .
                                " '" . $Morada_data['Andar']. "'," .
                                " '" . $Morada_data['Numero_lote'] . "')"
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


        public function update($DB_conn_obj,$Morada_data)
        {
            $this->sql_string = "UPDATE ".
                                "Morada " .
                                "SET " .
                                " ID_Localidade='"    . $Morada_data['ID_Localidade'] . "'," .
                                " ID_Codigo_Postal='" . $Morada_data['ID_Codigo_Postal'] . "'," .
                                " Rua='"              . $Morada_data['Rua'] . "'," .
                                " Pais='"             . $Morada_data ['Pais'] . "'," .
                                " Andar='"            . $Morada_data ['Andar']. "'," .
                                " Numero_Lote='"      . $Morada_data['Numero_Lote'] . "' " .
                                "WHERE " .
                                "ID_Morada='"         . $Morada_data['ID_Morada'] . "' "
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


        public function delete($DB_conn_obj,$Morada_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Morada " .
                                "WHERE " .
                                "ID_Morada='" . $Morada_data['ID_Morada'] . "' "
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

    }


 interface Interface_Preco {

    // Interface para queries sobre a tabela Preco da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Produto);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Preco_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Preco_data);


    // Interface para apagar rows da tabela Preco da base de dados Empresas
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

    public function delete($DB_conn_obj,$Preco_data);


}


    class Preco implements Interface_Preco
    {
        // Array que guarda os dados de uma row da tabela 'Preco'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Preco_data = array (
                                        'ID_Produto'       => 0,
                                        'Preco_compra'     => 0.0,
                                        'Preco_Revenda'    => 0.0,
                                        'Preco_PVP'        => 0.0,
                                        'Preco_Recomendado'=> 0.0,
                                        'Classe_IVA'       => 0
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Preco_data

        private $Preco_result_set = array ( 'num_items' => 0 );


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
                                "Preco " .
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
                    array_push( $this->Preco_result_set, $this->table_row );
                    $this->Preco_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Preco_result_set['num_items'] = -1;
            }
            return $this->Preco_result_set;
        }



        public function insert($DB_conn_obj,$Preco_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Preco (" .
                                " ID_Produto," .
                                " Preco_Compra," .
                                " Preco_Revenda," .
                                " Preco_PVP," .
                                " Preco_Recomendado," .
                                " Classe_IVA)" .
                                " VALUES  (" .
                                " '" . $Preco_data['ID_Produto'] . "'," .
                                " '" . $Preco_data['Preco_Compra'] . "'," .
                                " '" . $Preco_data['Preco_Revenda'] . "'," .
                                " '" . $Preco_data['Preco_PVP'] . "'," .
                                " '" . $Preco_data['Preco_Recomendado']. "'," .
                                " '" . $Preco_data['Classe_IVA'] . "')"
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


        public function update($DB_conn_obj,$Preco_data)
        {
            $this->sql_string = "UPDATE ".
                                "Preco " .
                                "SET " .
                                " Preco_Compra='"     . $Preco_data['Preco_Compra'] . "'," .
                                " Preco_Revenda='"    . $Preco_data['Preco_revenda'] . "'," .
                                " Preco_PVP='"        . $Preco_data['Preco_PVP'] . "'," .
                                " Preco_Recomendado='". $Preco_data ['Preco_Recomendado'] . "'," .
                                " Classe_IVA='"       . $Preco_data['Classe_IVA'] . "' " .
                                "WHERE " .
                                "ID_Produto='" . $Preco_data['ID_Produto'] . "' "
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


        public function delete($DB_conn_obj,$Preco_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Preco " .
                                "WHERE " .
                                "ID_Produto='" . $Preco_data['ID_Produto'] . "' "
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

    }


 interface Interface_Contactos {

    // Interface para queries sobre a tabela Contactos da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Contacto);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Contactos_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Contactos_data);


    // Interface para apagar rows da tabela Contactos da base de dados Empresas
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

    public function delete($DB_conn_obj,$Contactos_data);


}


    class Contactos implements Interface_Contactos
    {
        // Array que guarda os dados de uma row da tabela 'Contactos'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Contactos_data = array (
                                        'ID_Contacto' => 0,
                                        'Telefone' => '',
                                        'Telemovel' => '',
                                        'E_mail' => '',
                                        'Fax'=> ''
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Contactos_data

        private $Contactos_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$ID_Contacto)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Contactos " .
                                "WHERE " .
                                "ID_Contacto='" . $ID_Contacto . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Contactos_result_set, $this->table_row );
                    $this->Contactos_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Contactos_result_set['num_items'] = -1;
            }
            return $this->Contactos_result_set;
        }



        public function insert($DB_conn_obj,$Contactos_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Contactos (" .
                                " ID_Contacto," .
                                " Telefone," .
                                " Telemovel," .
                                " E_mail," .
                                " Fax)" .
                                " VALUES  (" .
                                " '" . $Contactos_data['ID_Contacto'] . "'," .
                                " '" . $Contactos_data['Telefone'] . "'," .
                                " '" . $Contactos_data['Telemovel'] . "'," .
                                " '" . $Contactos_data['E_mail'] . "'," .
                                " '" . $Contactos_data['Fax'] . "')"
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


        public function update($DB_conn_obj,$Contactos_data)
        {
            $this->sql_string = "UPDATE ".
                                "Contactos " .
                                "SET " .
                                " Telefone='" . $Contactos_data['Telefone'] . "'," .
                                " Telemovel='"       . $Contactos_data['Telemovel'] . "'," .
                                " E_mail='"         . $Contactos_data['E_mail'] . "'," .
                                " Fax='"  . $Contactos_data['Fax'] . "' " .
                                "WHERE " .
                                "ID_Contacto='" . $Contactos_data['ID_Contacto'] . "' "
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


        public function delete($DB_conn_obj,$Contactos_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Contactos " .
                                "WHERE " .
                                "ID_Contacto='" . $Contactos_data['ID_Contacto'] . "' "
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

    }



 interface Interface_Produtos {

    // Interface para queries sobre a tabela Produtos da base de dados
    // Empresas
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$ID_Produto);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Empresas
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

    public function insert($DB_conn_obj,$Produtos_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Empresas
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

    public function update($DB_conn_obj,$Produtos_data);


    // Interface para apagar rows da tabela Produtos da base de dados Empresas
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

    public function delete($DB_conn_obj,$Produtos_data);


}


    class Produtos implements Interface_Produtos
    {
        // Array que guarda os dados de uma row da tabela 'Produtos'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Produtos_data = array (
                                        'ID_Produto'             => 0,
                                        'ID_Fornecedor'          => 0,
                                        'ID_Tipo_Produto'        => 0,
                                        'Referencia_Equipamento' => 0
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Produtos_data

        private $Produtos_result_set = array ( 'num_items' => 0 );


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
                                "Produtos " .
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
                    array_push( $this->Produtos_result_set, $this->table_row );
                    $this->Produtos_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Produtos_result_set['num_items'] = -1;
            }
            return $this->Produtos_result_set;
        }



        public function insert($DB_conn_obj,$Produtos_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Produtos (" .
                                " ID_Produto," .
                                " ID_Fornecedor," .
                                " ID_Tipo_Produto," .
                                " Referencia_Equipamento)" .
                                " VALUES  (" .
                                " '" . $Produtos_data['ID_Produto'] . "'," .
                                " '" . $Produtos_data['ID_Fornecedor'] . "'," .
                                " '" . $Produtos_data['ID_Tipo_Produto'] . "'," .
                                " '" . $Produtos_data['Referencia_Equipamento'] . "')"
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


        public function update($DB_conn_obj,$Produtos_data)
        {
            $this->sql_string = "UPDATE ".
                                "Produtos " .
                                "SET " .
                                " ID_Fornecedor='"           . $Produtos_data['ID_Fornecedor'] . "'," .
                                " ID_Tipo_Produto='"         . $Produtos_data['ID_Tipo_Produto'] . "'," .
                                " Referencia_Equipamento='"  . $Produtos_data['Referencia_Equipamento'] . "' " .
                                "WHERE " .
                                "ID_Produto='" . $Produtos_data['ID_Produto'] . "' "
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


        public function delete($DB_conn_obj,$Produtos_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Produtos " .
                                "WHERE " .
                                "ID_Produto='" . $Produtos_data['ID_Produto'] . "' "
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

    }


?>
