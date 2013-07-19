<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


interface Interface_Equipamento {

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


    // Interface para abrir a ligação a base de dados 'Equipamento'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function open($conn_type);


    // Interface para fechar a ligação a base de dados 'Equipamento'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Fecho da conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function close();


}


    class Equipamento implements Interface_Equipamento
    {
        // Variavel que mantem o objecto que representa a ligação a base
        // de dados dentro da classe

        private $Equipamento_obj;


        // Array que guarda os dados necessarios para fazer a ligação a
        // base de dados, dentro da classe.
        // Os dados são: ( driver, host, user, password, database )

        private $Equipamento_DB = array (  "driver" => "",
                                        "host" => "",
                                        "user" => "",
                                        "password" => "",
                                        "database" => ""
                                      );


        // Esta flag indica se a base de dados foi aberta ou não

        private $DB_open = FALSE;


        // Este metodo da classe recebe os parâmetros para a ligação a
        // base de dados e guarda os respectivos valores no array
        // associativo $Equipamento_DB[]

        public function set_DB($driver,$host,$user,$password,$database)
        {
            $this->Equipamento_DB['driver'] = $driver;
            $this->Equipamento_DB['host'] = $host;
            $this->Equipamento_DB['user'] = $user;
            $this->Equipamento_DB['password'] = $password;
            $this->Equipamento_DB['database'] = $database;
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
                return array (  'DB_obj' => $this->Equipamento_obj,
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
            $this->Equipamento_obj = &ADONewConnection($this->Equipamento_DB['driver']);

            $this->DB_open = TRUE;

            switch ($conn_type)
            {
                case 0:
                    $this->Equipamento_obj->Connect( $this->Equipamento_DB['host'],
                                          $this->Equipamento_DB['user'],
                                          $this->Equipamento_DB['password'],
                                          $this->Equipamento_DB['database']
                                        );
                    break;

                case 1:
                    $this->Equipamento_obj->PConnect( $this->Equipamento_DB['host'],
                                           $this->Equipamento_DB['user'],
                                           $this->Equipamento_DB['password'],
                                           $this->Equipamento_DB['database']
                                         );
                    break;

                default:
                    $this->Equipamento_obj->Connect( $this->Equipamento_DB['host'],
                                          $this->Equipamento_DB['user'],
                                          $this->Equipamento_DB['password'],
                                          $this->Equipamento_DB['database']
                                        );
            }

        }


        // Interface para fechar a ligação a base de dados 'Equipamento'
        //
        // Este método retorna um código de erro indicando o resultado da
        // operação:
        //      0  = Fecho da conexão a base de dados feita com sucesso.
        //      -1 = Erro no acesso à base de dados

        public function close()
        {
            $this->Equipamento_obj->Close();

            $this->DB_open = FALSE;
        }

    }



interface Interface_Caixa {

    // Interface para queries sobre a tabela Caixa da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Caixa);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Caixa_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Caixa_data);


    // Interface para apagar rows da tabela Caixa da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Caixa_data);


}


    class Caixa implements Interface_Caixa
    {
        // Array que guarda os dados de uma row da tabela 'Caixa'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Caixa_data = array (   'Referencia_Caixa' => 0,
                                        'Fabricante' => '',
                                        'Modelo' => '',
                                        'Descricao' => '',
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Caixa_data

        private $Caixa_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Caixa)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Caixa " .
                                "WHERE " .
                                "Referencia_Caixa='" . $Referencia_Caixa . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Caixa_result_set, $this->table_row );
                    $this->Caixa_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Caixa_result_set['num_items'] = -1;
            }
            return $this->Caixa_result_set;
        }



        public function insert($DB_conn_obj,$Caixa_data)
        {
            $this->sql_string = "INSERT INTO ".
                                "Caixa (" .
                                " Referencia_Caixa," .
                                " Fabricante," .
                                " Modelo," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Caixa_data['Referencia_Caixa'] . "'," .
                                " '" . $Caixa_data['Fabricante'] . "'," .
                                " '" . $Caixa_data['Modelo'] . "'," .
                                " '" . $Caixa_data['Descricao'] ."')"
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


        public function update($DB_conn_obj,$Caixa_data)
        {
            $this->sql_string = "UPDATE ".
                                "Caixa " .
                                "SET " .
                                " Fabricante='" . $Caixa_data['Fabricante'] . "'," .
                                " Modelo='" . $Caixa_data['Modelo'] . "'," .
                                " Descricao='" . $Caixa_data['Descricao'] . "' " .
                                "WHERE " .
                                "Referencia_Caixa='" . $Caixa_data['Referencia_Caixa'] . "' "
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


        public function delete($DB_conn_obj,$Caixa_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Caixa " .
                                "WHERE " .
                                "Referencia_Caixa='" . $Caixa_data['Referencia_Caixa'] . "' "
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

interface Interface_Cpu {

    // Interface para queries sobre a tabela Cpu da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Cpu);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Cpu_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Cpu_data);


    // Interface para apagar rows da tabela Cpu da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Cpu_data);


}


    class Cpu implements Interface_Cpu
    {
        // Array que guarda os dados de uma row da tabela 'Cpu'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Cpu_data = array (    'Referencia_Cpu' => 0,
                                        'Fabricante' => '',
                                        'Modelo' => '',
                                        'Velocidade' => 0,
                                        'Cache' => 0,
                                        'Descricao' => '',
                                        'Cor_Mostrador' => ''

                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Cpu_data

        private $Cpu_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Cpu)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Cpu " .
                                "WHERE " .
                                "Referncia_Cpu='" . $Referencia_Cpu . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Cpu_result_set, $this->table_row );
                    $this->Cpu_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Cpu_result_set['num_items'] = -1;
            }
            return $this->Cpu_result_set;
        }



        public function insert($DB_conn_obj,$Cpu_data)
        {
            $this->sql_string = "INSERT INTO ".
                                "Cpu (" .
                                " Referencia_Cpu," .
                                " Fabricante," .
                                " Modelo," .
                                " Velocidade," .
                                " cache," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Cpu_data['Referencia_Cpu'] . "'," .
                                " '" . $Cpu_data['Fabricante'] . "'," .
                                " '" . $Cpu_data['Modelo'] . "'," .
                                " '" . $Cpu_data['Velocidade'] . "'," .
                                " '" . $Cpu_data['Cache'] . "'," .
                                " '" . $Cpu_data['Descricao'] . "')"
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


        public function update($DB_conn_obj,$Cpu_data)
        {
            $this->sql_string = "UPDATE ".
                                "Cpu " .
                                "SET " .
                                " Fabricante='" . $Cpu_data['Fabricante'] . "'," .
                                " Modelo='" . $Cpu_data['Modelo'] . "'," .
                                " Velocidade='" . $Cpu_data['Velocidade'] . "'," .
                                " Cache='" . $Cpu_data['Cache'] . "'," .
                                " Descricao='" . $Cpu_data['Descricao'] . "' " .
                                "WHERE " .
                                "Referencia_Cpu='" . $Cpu_data['Referencia_Cpu'] . "' "
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


        public function delete($DB_conn_obj,$Cpu_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Cpu " .
                                "WHERE " .
                                "Referencia_Cpu='" . $Cpu_data['Referencia_Cpu'] . "' "
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

interface Interface_Disco_Rigido {

    // Interface para queries sobre a tabela Disco_Rigido da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Disco);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Disco_Rigido_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Disco_Rigido_data);


    // Interface para apagar rows da tabela Disco_Rigido da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Disco_Rigido_data);


}


    class Disco_Rigido implements Interface_Disco_Rigido
    {
        // Array que guarda os dados de uma row da tabela 'Disco_Rigido'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Disco_Rigido_data = array (
                                        'Referencia_Disco' => 0,
                                        'Fabricante' => '',
                                        'Tipo' => '',
                                        'Descricao' => '',
                                        'Capacidade_GB' => 0
                                           );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Disco_Rigido_data

        private $Disco_Rigido_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Disco)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Disco_Rigido " .
                                "WHERE " .
                                "Referncia_Disco='" . $Referencia_Disco . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Disco_Rigido_result_set, $this->table_row );
                    $this->Disco_Rigido_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Disco_Rigido_result_set['num_items'] = -1;
            }
            return $this->Disco_Rigido_result_set;
        }



        public function insert($DB_conn_obj,$Disco_Rigido_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Disco_Rigido (" .
                                " Referencia_Disco," .
                                " Fabricante," .
                                " Tipo," .
                                " Descricao," .
                                " Capacidade_GB)" .
                                " VALUES  (" .
                                " '" . $Disco_Rigido_data['Referencia_Disco'] . "'," .
                                " '" . $Disco_Rigido_data['Fabricante'] . "'," .
                                " '" . $Disco_Rigido_data['Tipo'] . "'," .
                                " '" . $Disco_Rigido_data['Descricao'] . "'," .
                                " '" . $Disco_Rigido_data['Capcaidade_GB'] . "')"
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


        public function update($DB_conn_obj,$Disco_Rigido_data)
        {
            $this->sql_string = "UPDATE ".
                                "Disco_Rigido " .
                                "SET " .
                                " fabricante='" . $Disco_Rigido_data['Fabricante'] . "'," .
                                " Tipo='" . $Disco_Rigido_data['Tipo'] . "'," .
                                " Descricao='" . $Disco_Rigido_data['Descricao'] . "'," .
                                " Capacidade_GB='" . $Disco_Rigido_data['Capacidae_GB'] . "' " .
                                "WHERE " .
                                "Referencia_Disco='" . $Disco_Rigido_data['Referencia_Disco'] . "' "
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


        public function delete($DB_conn_obj,$Disco_Rigido_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Disco_Rigido " .
                                "WHERE " .
                                "Referencia_Disco='" . $Disco_Rigido_data['Referencia_Disco'] . "' "
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

interface Interface_Equipamentos {

    // Interface para queries sobre a tabela Equipamentos da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Equipamento);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Equipamentos_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Equipamentos_data);


    // Interface para apagar rows da tabela Equipamentos da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Equipamentos_data);


}


    class Equipamentos implements Interface_Equipamentos
    {
        // Array que guarda os dados de uma row da tabela 'Equipamentos'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Equipamentos_data = array (
                                        'Referencia_Equipamento' => 0,
                                        'Referencia_Caixa' => 0,
                                        'Referencia_Cpu' => 0,
                                        'Referencia_Disco' => 0,
                                        'Referencia_Fonte' => 0,
                                        'Referencia_Leitor' => 0,
                                        'Referencia_Memoria' => 0,
                                        'Referencia_Monitor' => 0,
                                        'Referencia_Motherboard' => 0,
                                        'Referencia_Grafica' => 0,
                                        'Referencia_Software' => 0,
                                        'Descricao' => ''
                                          );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Equipamentos_data

        private $Equipamentos_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Equipamento)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Equipamentos " .
                                "WHERE " .
                                "Referencia_Equipamento='" . $Referencia_Equipamento . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Equipamentos_result_set, $this->table_row );
                    $this->Equipamentos_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Equipamentos_result_set['num_items'] = -1;
            }
            return $this->Equipamentos_result_set;
        }



        public function insert($DB_conn_obj,$Equipamentos_data)
        {
            $this->sql_string = "INSERT INTO ".
                                "Equipamentos (" .
                                " Referencia_Equipamento," .
                                " Referencia_Caixa," .
                                " Referencia_Cpu," .
                                " Referencia_Disco," .
                                " Referencia_Fonte," .
                                " Referencia_Leitor," .
                                " Referencia_Memoria," .
                                " Referencia_Monitor," .
                                " Referencia_Motherboard," .
                                " Referencia_Grafica," .
                                " Referencia_Software," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Equipamentos_data['Referencia_Equipamento'] . "'," .
                                " '" . $Equipamentos_data['Referencia_Caixa'] . "'," .
                                " '" . $Equipamentos_data['Referencia_Cpu'] . "'," .
                                " '" . $Equipamentos_data['Referencia_Disco'] . "'," .
                                " '" . $Equipamentos_data['Referencia_Fonte'] . "'," .
                                " '" . $Equipamentos_data['Referencia_leitor'] . "'," .
                                " '" . $Equipamentos_data['Referencia_Memoria'] . "'," .
                                " '" . $Equipamentos_data['Referencia_Monitor'] . "'," .
                                " '" . $Equipamentos_data['Referencia_Motherboard'] . "'," .
                                " '" . $Equipamentos_data['Referencia_Grafica'] . "'," .
                                " '" . $Equipamentos_data['Referencia_Software'] . "'," .
                                " '" . $Equipamentos_data['Descricao'] . "')"
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


        public function update($DB_conn_obj,$Equipamentos_data)
        {
            $this->sql_string = "UPDATE ".
                                "Equipamentos " .
                                "SET " .
                                " Referencia_Caixa ='" . $Equipamentos_data['Referencia_Caixa'] . "'," .
                                " Referencia_Cpu ='" . $Equipamentos_data['Referencia_Cpu'] . "'," .
                                " Referencia_Disco ='" . $Equipamentos_data['Referencia_Disco'] . "'," .
                                " Referencia_Fonte ='" . $Equipamentos_data['Referencia_Fonte'] . "'," .
                                " Referencia_Leitor ='" . $Equipamentos_data['Referencia_Leitor'] . "'," .
                                " Referencia_Memoria ='" . $Equipamentos_data['Referencia_Memoria'] . "'," .
                                " Referencia_Monitor ='" . $Equipamentos_data['Referencia_Monitor'] . "'," .
                                " Referencia_Motherboard ='" . $Equipamentos_data['Referencia_Motherboard'] . "'," .
                                " Referencia_Grafica ='" . $Equipamentos_data['Referencia_Grafica'] . "'," .
                                " Referencia_Software ='" . $Equipamentos_data['Referencia_Software'] . "'," .
                                " Descricao ='" . $Equipamentos_data['Descricao'] . "' " .
                                "WHERE " .
                                "Referencia_Equipamento='" . $Equipamentos_data['Referencia_Equipamento'] . "' "
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


        public function delete($DB_conn_obj,$Equipamentos_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Equipamentos " .
                                "WHERE " .
                                "Referencia_Equipamento='" . $Equipamentos_data['Referencia_Equipamento'] . "' "
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

interface Interface_Fonte_Alimentacao {

    // Interface para queries sobre a tabela Fonte_Alimentacao da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Fonte);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Fonte_Alimentacao_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Fonte_Alimentacao_data);


    // Interface para apagar rows da tabela Fonte_Alimentacao da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Fonte_Alimentacao_data);


}


    class Fonte_Alimentacao implements Interface_Fonte_Alimentacao
    {
        // Array que guarda os dados de uma row da tabela 'Fonte_Alimentacao'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Fonte_Alimentacao_data = array (  
                                                'Referencia_Fonte' => 0,
                                                'Fabricante' => '',
                                                'Potencia_Watt' => 0,
                                                'Tipo_Fonte' => '',
                                                'Descricao' => ''
                                                 );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Fonte_Alimentacao_data

        private $Fonte_Alimentacao_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Fonte)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Fonte_Alimentacao " .
                                "WHERE " .
                                "Referencia_Fonte='" . $Referencia_Fonte . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Fonte_Alimentacao_result_set, $this->table_row );
                    $this->Fonte_Alimentacao_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Fonte_Alimentacao_result_set['num_items'] = -1;
            }
            return $this->Fonte_Alimentacao_result_set;
        }



        public function insert($DB_conn_obj,$Fonte_Alimentacao_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Fonte_Alimentacao (" .
                                " Referencia_Fonte," .
                                " Fabricante," .
                                " Potencia_Watt," .
                                " Tipo_Fonte," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Fonte_Alimentacao_data['Referencia_Fonte'] . "'," .
                                " '" . $Fonte_Alimentacao_data['Fabricante'] . "'," .
                                " '" . $Fonte_Alimentacao_data['Potencia_Watt'] . "'," .
                                " '" . $Fonte_Alimentacao_data['Tipo_Fonte'] . "'," .
                                " '" . $Fonte_Alimentacao_data['Descricao'] . "')"
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


        public function update($DB_conn_obj,$Fonte_Alimentacao_data)
        {
            $this->sql_string = "UPDATE ".
                                "Fonte_Alimentacao " .
                                "SET " .
                                " Fabricante='"    . $Fonte_Alimentacao_data['Fabricante']    . "'," .
                                " Potencia_Watt='" . $Fonte_Alimentacao_data['Potencia_Watt'] . "'," .
                                " Tipo_Fonte='"    . $Fonte_Alimentacao_data['Tipo_Fonte']    . "'," .
                                " Descricao='"     . $Fonte_Alimentacao_data['Descricao']     . "' " .
                                "WHERE " .
                                "Referencia_Fonte='" . $Fonte_Alimentacao_data['Referencia_Fonte'] . "' "
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


        public function delete($DB_conn_obj,$Fonte_Alimentacao_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Fonte_Alimentacao " .
                                "WHERE " .
                                "Referencia_Fonte='" . $Fonte_Alimentacao_data['Referencia_Fonte'] . "' "
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

    interface Interface_Leitor {

    // Interface para queries sobre a tabela Leitor da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Leitor);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Leitor_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Leitor_data);


    // Interface para apagar rows da tabela Leitor da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Leitor_data);


}


    class Leitor implements Interface_Leitor
    {
        // Array que guarda os dados de uma row da tabela 'Leitor'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Leitor_data = array (
                                        'Referencia_Leitor' => 0,
                                        'Fabricante' => '',
                                        'Modelo' => '',
                                        'Tipo' => '',
                                        'Descricao' => ''
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Leitor_data

        private $Leitor_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Leitor)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Leitor " .
                                "WHERE " .
                                "Referencia_Leitor='" . $Referencia_Leitor . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Leitor_result_set, $this->table_row );
                    $this->Leitor_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Leitor_result_set['num_items'] = -1;
            }
            return $this->Leitor_result_set;
        }



        public function insert($DB_conn_obj,$Leitor_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Leitor (" .
                                " Referencia_Leitor," .
                                " Fabricante," .
                                " Modelo," .
                                " Tipo," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Leitor_data['Referencia_Leitor'] . "'," .
                                " '" . $Leitor_data['Fabricante'] . "'," .
                                " '" . $Leitor_data['Modelo'] . "'," .
                                " '" . $Leitor_data['Tipo'] . "'," .
                                " '" . $Leitor_data['Descricao'] . "')"
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


        public function update($DB_conn_obj,$Leitor_data)
        {
            $this->sql_string = "UPDATE ".
                                "Leitor " .
                                "SET " .
                                " Fabricante='" . $Leitor_data['Fabricante'] . "'," .
                                " Modelo='"     . $Leitor_data['Modelo'] . "'," .
                                " Tipo='"       . $Leitor_data['Tipo'] . "'," .
                                " Descricao='"  . $Leitor_data['Descricao'] . "' " .
                                "WHERE " .
                                "Referencia_Leitor='" . $Leitor_data['Referencia_Leitor'] . "' "
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


        public function delete($DB_conn_obj,$Leitor_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Leitor " .
                                "WHERE " .
                                "Referencia_Leitor='" . $Leitor_data['Referencia_Leitor'] . "' "
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

interface Interface_Memoria {

    // Interface para queries sobre a tabela Memoria da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Memoria);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Memoria_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Memoria_data);


    // Interface para apagar rows da tabela Memoria da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Memoria_data);


}


    class Memoria implements Interface_Memoria
    {
        // Array que guarda os dados de uma row da tabela 'Memoria'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Memoria_data = array (
                                        'Referencia_Memoria' => 0,
                                        'Fabricante' => '',
                                        'Modelo' => '',
                                        'Velocidade' => 0,
                                        'Tipo' => '',
                                        'Frequencia' => 0,
                                        'Descricao' => ''

                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Memoria_data

        private $Memoria_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Memoria)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Memoria " .
                                "WHERE " .
                                "Referencia_Memoria='" . $Referencia_Memoria . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Memoria_result_set, $this->table_row );
                    $this->Memoria_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Memoria_result_set['num_items'] = -1;
            }
            return $this->Memoria_result_set;
        }



        public function insert($DB_conn_obj,$Memoria_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Memoria (" .
                                " Referencia_Memoria," .
                                " Fabricante," .
                                " Modelo," .
                                " Velocidade," .
                                " Tipo," .
                                " Frequencia," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Memoria_data['Referencia_Memoria'] . "'," .
                                " '" . $Memoria_data['Fabricante'] . "'," .
                                " '" . $Memoria_data['Modelo'] . "'," .
                                " '" . $Memoria_data['Velocidade'] . "'," .
                                " '" . $Memoria_data['Tipo'] . "'," .
                                " '" . $Memoria_data['Frequencia'] . "'," .
                                " '" . $Memoria_data['Descricao'] . "')"
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


        public function update($DB_conn_obj,$Memoria_data)
        {
            $this->sql_string = "UPDATE ".
                                "Memoria " .
                                "SET " .
                                " Fabricante='"  . $Memoria_data['Fabricante'] . "'," .
                                " Modelo='"      . $Memoria_data['Modelo']     . "'," .
                                " Velocidade='"  . $Memoria_data['Velocidade'] . "'," .
                                " Tipo='"        . $Memoria_data['Tipo']       . "'," .
                                " Frequencia='"  . $Memoria_data['Frequencia'] . "'," .
                                " Descricao='"   . $Memoria_data['Descricao']  . "' " .
                                "WHERE " .
                                "Referencia_Memoria='" . $Memoria_data['Referencia_Memoria'] . "' "
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


        public function delete($DB_conn_obj,$Memoria_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Memoria " .
                                "WHERE " .
                                "Referencia_Memoria='" . $Memoria_data['Referencia_Memoria'] . "' "
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

interface Interface_Monitor {

    // Interface para queries sobre a tabela Monitor da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Monitor);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Monitor_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Monitor_data);


    // Interface para apagar rows da tabela Monitor da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Monitor_data);


}


    class Monitor implements Interface_Monitor
    {
        // Array que guarda os dados de uma row da tabela 'Monitor'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Monitor_data = array (
                                        'Referencia_Monitor' => 0,
                                        'Fabricante' => '',
                                        'Modelo' => '',
                                        'Tipo' => '',
                                        'Tamanho' => 0,
                                        'Descricao' => ''

                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Monitor_data

        private $Monitor_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Monitor)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Monitor " .
                                "WHERE " .
                                "Referencia_Monitor='" . $Referencia_Monitor . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Monitor_result_set, $this->table_row );
                    $this->Monitor_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Monitor_result_set['num_items'] = -1;
            }
            return $this->Monitor_result_set;
        }



        public function insert($DB_conn_obj,$Monitor_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Monitor (" .
                                " Referencia_Monitor," .
                                " Fabricante," .
                                " Modelo," .
                                " Tipo," .
                                " Tamanho," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Monitor_data['Referencia_Monitor'] . "'," .
                                " '" . $Monitor_data['Fabricante'] . "'," .
                                " '" . $Monitor_data['Modelo'] . "'," .
                                " '" . $Monitor_data['Tipo'] . "'," .
                                " '" . $Monitor_data['Tamanho'] . "'," .
                                " '" . $Monitor_data['Descricao'] . "')"
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


        public function update($DB_conn_obj,$Monitor_data)
        {
            $this->sql_string = "UPDATE ".
                                "Monitor " .
                                "SET " .
                                " Fabricante='" . $Monitor_data['Fabricante'] . "'," .
                                " Modelo='" . $Monitor_data['Modelo'] . "'," .
                                " Tipo='" . $Monitor_data['Tipo'] . "'," .
                                " Tamanho='" . $Monitor_data['Tamanho'] . "'," .
                                " Descricao ='" . $Monitor_data['descricao'] . "' " .
                                "WHERE " .
                                "Referencia_Monitor='" . $Monitor_data['Referencia_Monitor'] . "' "
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


        public function delete($DB_conn_obj,$Monitor_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Monitor " .
                                "WHERE " .
                                "Referencia_Monitor='" . $Monitor_data['Referencia_Monitor'] . "' "
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

interface Interface_Motherboard {

    // Interface para queries sobre a tabela Motherboard da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Motherboard);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Motherboard_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Motherboard_data);


    // Interface para apagar rows da tabela Motherboard da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Motherboard_data);


}


    class Motherboard implements Interface_Motherboard
    {
        // Array que guarda os dados de uma row da tabela 'Motherboard'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Motherboard_data = array (
                                            'Referencia_Motherboard' => 0,
                                            'Fabricante' => '',
                                            'Modelo' => '',
                                            'Chipset' => '',
                                            'Descricao' => ''
                                           );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Motherboard_data

        private $Motherboard_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Motherboard)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Motherboard " .
                                "WHERE " .
                                "Referencia_Motherboard='" . $Referencia_Motherboard . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Motherboard_result_set, $this->table_row );
                    $this->Motherboard_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Motherboard_result_set['num_items'] = -1;
            }
            return $this->Motherboard_result_set;
        }



        public function insert($DB_conn_obj,$Motherboard_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Motherboard (" .
                                " Referencia_Motherboard," .
                                " Fabricante," .
                                " Modelo," .
                                " Chipset," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Motherboard_data['Referencia_Motherboard'] . "'," .
                                " '" . $Motherboard_data['Fabricante'] . "'," .
                                " '" . $Motherboard_data['Modelo'] . "'," .
                                " '" . $Motherboard_data['Chipset'] . "'," .
                                " '" . $Motherboard_data['Descricao'] . "')"
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


        public function update($DB_conn_obj,$Motherboard_data)
        {
            $this->sql_string = "UPDATE ".
                                "Motherboard " .
                                "SET " .
                                " Fabricante='" . $Motherboard_data['Referencia'] . "'," .
                                " Modelo='"     . $Motherboard_data['Modelo'] . "'," .
                                " Chipset='"    . $Motherboard_data['Chipset'] . "'," .
                                " Descricao='"  . $Motherboard_data['Descricao'] . "' " .
                                "WHERE " .
                                "Referencia_Motherboard='" . $Motherboard_data['Referencia_Motherboard'] . "' "
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


        public function delete($DB_conn_obj,$Motherboard_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Motherboard " .
                                "WHERE " .
                                "Referencia_Motherboard='" . $Motherboard_data['Referencia_Motherboard'] . "' "
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

interface Interface_Placa_Grafica {

    // Interface para queries sobre a tabela Placa_Grafica da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Grafica);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Placa_Grafica_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Placa_Grafica_data);


    // Interface para apagar rows da tabela Placa_Grafica da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Placa_Grafica_data);


}


    class Placa_Grafica implements Interface_Placa_Grafica
    {
        // Array que guarda os dados de uma row da tabela 'Placa_Grafica'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Placa_Grafica_data = array (
                                        'Referencia_Grafica' => 0,
                                        'Fabricante' => '',
                                        'Modelo' => '',
                                        'Velocidade' => 0,
                                        'Memoria' => 0,
                                        'Descricao' => ''
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Placa_Grafica_data

        private $Placa_Grafica_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Grafica)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Placa_Grafica " .
                                "WHERE " .
                                "Referencia_Grafica='" . $Referencia_Grafica . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Placa_Grafica_result_set, $this->table_row );
                    $this->Placa_Grafica_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Placa_Grafica_result_set['num_items'] = -1;
            }
            return $this->Placa_Grafica_result_set;
        }



        public function insert($DB_conn_obj,$Placa_Grafica_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Placa_Grafica (" .
                                " Referencia_Grafica," .
                                " Fabricante," .
                                " Modelo," .
                                " Velocidade," .
                                " Memoria," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Placa_Grafica_data['Referencia_Grafica'] . "'," .
                                " '" . $Placa_Grafica_data['Fabricante'] . "'," .
                                " '" . $Placa_Grafica_data['Modelo'] . "'," .
                                " '" . $Placa_Grafica_data['Velocidade'] . "'," .
                                " '" . $Placa_Grafica_data['Memoria'] . "'," .
                                " '" . $Placa_Grafica_data['Descricao'] . "')"
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


        public function update($DB_conn_obj,$Placa_Grafica_data)
        {
            $this->sql_string = "UPDATE ".
                                "Placa_Grafica " .
                                "SET " .
                                " Fabricante='" . $Placa_Grafica_data['Fabricante'] . "'," .
                                " Modelo='"     . $Placa_Grafica_data['Modelo'] . "'," .
                                " Velocidade='" . $Placa_Grafica_data['Velocidade'] . "'," .
                                " Memoria='"    . $Placa_Grafica_data['Memoria'] . "'," .
                                " Descricao='"  . $Placa_Grafica_data['Descricao'] . "' " .
                                "WHERE " .
                                "Referencia_Grafica='" . $Placa_Grafica_data['Referencia_Grafica'] . "' "
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


        public function delete($DB_conn_obj,$Placa_Grafica_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Placa_Grafica " .
                                "WHERE " .
                                "Referencia_Grafica='" . $Placa_Grafica_data['Referencia_Grafica'] . "' "
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

 interface Interface_Software {

    // Interface para queries sobre a tabela Software da base de dados
    // Equipamento
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // -->
    // -->

    public function query($DB_conn_obj,$Referencia_Software);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function insert($DB_conn_obj,$Software_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // Equipamento
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

    public function update($DB_conn_obj,$Software_data);


    // Interface para apagar rows da tabela Software da base de dados Equipamento
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

    public function delete($DB_conn_obj,$Software_data);


}


    class Software implements Interface_Software
    {
        // Array que guarda os dados de uma row da tabela 'Software'
        //
        //
        //
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $Software_data = array (
                                        'Referencia_Software' => 0,
                                        'Fabricante' => '',
                                        'Tipo' => '',
                                        'OS' => '',
                                        'Descricao'=> ''
                                        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $Software_data

        private $Software_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$Referencia_Software)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "Software " .
                                "WHERE " .
                                "Referencia_Software='" . $Referencia_Software . "' "
                              ;
            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->Software_result_set, $this->table_row );
                    $this->Software_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->Software_result_set['num_items'] = -1;
            }
            return $this->Software_result_set;
        }



        public function insert($DB_conn_obj,$Software_data)
        {
            $this->sql_string = "INSERT INTO ".
                                " Software (" .
                                " Referencia_Software," .
                                " Fabricante," .
                                " Tipo," .
                                " OS," .
                                " Descricao)" .
                                " VALUES  (" .
                                " '" . $Software_data['Referencia_Software'] . "'," .
                                " '" . $Software_data['Fabricante'] . "'," .
                                " '" . $Software_data['Tipo'] . "'," .
                                " '" . $Software_data['OS'] . "'," .
                                " '" . $Software_data['Descricao'] . "')"
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


        public function update($DB_conn_obj,$Software_data)
        {
            $this->sql_string = "UPDATE ".
                                "Software " .
                                "SET " .
                                " Fabricante='" . $Software_data['Fabricante'] . "'," .
                                " Tipo='"       . $Software_data['Tipo'] . "'," .
                                " OS='"         . $Software_data['OS'] . "'," .
                                " Descricao='"  . $Software_data['Descricao'] . "' " .
                                "WHERE " .
                                "Referencia_Software='" . $Software_data['Referencia_Software'] . "' "
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


        public function delete($DB_conn_obj,$Software_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "Software " .
                                "WHERE " .
                                "Referencia_Software='" . $Software_data['Referencia_Software'] . "' "
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
