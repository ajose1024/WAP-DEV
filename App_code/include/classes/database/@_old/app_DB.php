 <?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Admin
 */

interface Interface_app_DB {

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


    // Interface para abrir a ligação a base de dados 'app_DB'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function open($conn_type);


    // Interface para fechar a ligação a base de dados 'app_DB'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Fecho da conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function close();


}


    class app_DB implements Interface_app_DB
    {
        // Variavel que mantem o objecto que representa a ligação a base
        // de dados dentro da classe

        private $app_DB_obj;


        // Array que guarda os dados necessarios para fazer a ligação a
        // base de dados, dentro da classe.
        // Os dados são: ( driver, host, user, password, database )

        private $app_priv_DB = array (  "driver" => "",
                                        "host" => "",
                                        "user" => "",
                                        "password" => "",
                                        "database" => ""
                                      );


        // Esta flag indica se a base de dados foi aberta ou não

        private $DB_open = FALSE;


        // Este metodo da classe recebe os parâmetros para a ligação a
        // base de dados e guarda os respectivos valores no array
        // associativo $app_priv_DB[]

        public function set_DB($driver,$host,$user,$password,$database)
        {
            $this->app_priv_DB['driver'] = $driver;
            $this->app_priv_DB['host'] = $host;
            $this->app_priv_DB['user'] = $user;
            $this->app_priv_DB['password'] = $password;
            $this->app_priv_DB['database'] = $database;
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
                return array (  'DB_obj' => $this->app_DB_obj,
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
            $this->app_DB_obj = &ADONewConnection($this->app_priv_DB['driver']);

            $this->DB_open = TRUE;

            switch ($conn_type)
            {
                case 0:
                    $this->app_DB_obj->Connect( $this->app_priv_DB['host'],
                                          $this->app_priv_DB['user'],
                                          $this->app_priv_DB['password'],
                                          $this->app_priv_DB['database']
                                        );
                    break;

                case 1:
                    $this->app_DB_obj->PConnect( $this->app_priv_DB['host'],
                                           $this->app_priv_DB['user'],
                                           $this->app_priv_DB['password'],
                                           $this->app_priv_DB['database']
                                         );
                    break;

                default:
                    $this->app_DB_obj->Connect( $this->app_priv_DB['host'],
                                          $this->app_priv_DB['user'],
                                          $this->app_priv_DB['password'],
                                          $this->app_priv_DB['database']
                                        );
            }

        }


        // Interface para fechar a ligação a base de dados 'app_DB'
        //
        // Este método retorna um código de erro indicando o resultado da
        // operação:
        //      0  = Fecho da conexão a base de dados feita com sucesso.
        //      -1 = Erro no acesso à base de dados

        public function close()
        {
            $this->app_DB_obj->Close();

            $this->DB_open = FALSE;
        }

    }



interface Interface_app_menu {

    // Interface para queries sobre a tabela app_menu da base de dados
    // app_DB
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Uma string com o 'menu_level' desejado
    // --> Uma string com o 'user_ID'
    
    public function query($DB_conn_obj,$menu_level,$user_ID);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      id              = Inteiro (não interessa o valor para o insert)
    //      menu_level      = String com o 'menu_level'
    //      new_menu_level  = String com o novo 'menu_level' ou string vazia
    //      item_type       = Inteiro:
    //          1 = Este item do menu é um elemento apenas em texto.
    //          2 = Este item do menu é uma imagem standard.
    //          3 = Este item do menu é um rollover de imagem que muda no
    //              envento 'onmouseover'
    //          4 = Este menu é um espaço em branco.
    //          5 = Este menu é um seprador (em texto).
    //          6 = Este menu é um separador (em imagem).
    //      item_link       = String com o link para onde o menu salta
    //      item_data_1     = String com dados (depende do tipo de item)
    //      item_data_2     = String com dados (depende do tipo de item)
    //      item_class      = String com o nome da classe para a CSS
    //      item_alt        = String com o texto de ALT
    //      item_order      = Inteiro com a ordem dos items do menu
    //      item_width      = Inteiro com a largura em pixels do elemento
    //      item_height     = Inteiro com a altura em pixels do elemento
    //      item_active     = Flag:
    //          0 = O item do menu existe, mas não tem link activo
    //          1 = O item do menu existe e tem link activo
    //      item_hidden     = Flag:
    //          0 = O item do menu existe e é visivel
    //          1 = O item do menu existe mas não é visivel (não e desenhado)
    //      user_ID = Este campo tem o user_ID para que o menu é valido ou
    //                -1 no caso de não haver menus diferenciados
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados
    
    public function insert($DB_conn_obj,$menu_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      id              = Inteiro (selecciona o record para o update)
    //      menu_level      = String com o 'menu_level'
    //      new_menu_level  = String com o novo 'menu_level' ou string vazia
    //      item_type       = Inteiro:
    //          1 = Este item do menu é um elemento apenas em texto.
    //          2 = Este item do menu é uma imagem standard.
    //          3 = Este item do menu é um rollover de imagem que muda no
    //              envento 'onmouseover'
    //          4 = Este menu é um espaço em branco.
    //          5 = Este menu é um seprador (em texto).
    //          6 = Este menu é um separador (em imagem).
    //      item_link       = String com o link para onde o menu salta
    //      item_data_1     = String com dados (depende do tipo de item)
    //      item_data_2     = String com dados (depende do tipo de item)
    //      item_class      = String com o nome da classe para a CSS
    //      item_alt        = String com o texto de ALT
    //      item_order      = Inteiro com a ordem dos items do menu
    //      item_width      = Inteiro com a largura em pixels do elemento
    //      item_height     = Inteiro com a altura em pixels do elemento
    //      item_active     = Flag:
    //          0 = O item do menu existe, mas não tem link activo
    //          1 = O item do menu existe e tem link activo
    //      item_hidden     = Flag:
    //          0 = O item do menu existe e é visivel
    //          1 = O item do menu existe mas não é visivel (não e desenhado)
    //      user_ID = Este campo tem o user_ID para que o menu é valido ou
    //                -1 no caso de não haver menus diferenciados
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Update feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function update($DB_conn_obj,$menu_data);


    // Interface para apagar rows da tabela app_menu da base de dados app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      id              = Inteiro (selecciona o record para o update)
    //      menu_level      = String com o 'menu_level'
    //      new_menu_level  = String com o novo 'menu_level' ou string vazia
    //      item_type       = Inteiro:
    //          1 = Este item do menu é um elemento apenas em texto.
    //          2 = Este item do menu é uma imagem standard.
    //          3 = Este item do menu é um rollover de imagem que muda no
    //              envento 'onmouseover'
    //          4 = Este menu é um espaço em branco.
    //          5 = Este menu é um seprador (em texto).
    //          6 = Este menu é um separador (em imagem).
    //      item_link       = String com o link para onde o menu salta
    //      item_data_1     = String com dados (depende do tipo de item)
    //      item_data_2     = String com dados (depende do tipo de item)
    //      item_class      = String com o nome da classe para a CSS
    //      item_alt        = String com o texto de ALT
    //      item_order      = Inteiro com a ordem dos items do menu
    //      item_width      = Inteiro com a largura em pixels do elemento
    //      item_height     = Inteiro com a altura em pixels do elemento
    //      item_active     = Flag:
    //          0 = O item do menu existe, mas não tem link activo
    //          1 = O item do menu existe e tem link activo
    //      item_hidden     = Flag:
    //          0 = O item do menu existe e é visivel
    //          1 = O item do menu existe mas não é visivel (não e desenhado)
    //      user_ID = Este campo tem o user_ID para que o menu é valido ou
    //                -1 no caso de não haver menus diferenciados
    //
    // Este método apaga a linha na base de dados cujo ID corresponde ao ID
    // que é passado.
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Delete feito com sucesso.
    //      -1 = Erro no acesso à bbase de dados.

    public function delete($DB_conn_obj,$menu_data);


}


    class app_menu implements Interface_app_menu
    {
        // Array que guarda os dados de uma row da tabela 'app_menu'
        //
        //  id              = Inteiro (selecciona o record para o update)
        //  menu_level      = String com o 'menu_level'
        //  new_menu_level  = String com o novo 'menu_level' ou string vazia
        //  item_type       = Inteiro:
        //      1 = Este item do menu é um elemento apenas em texto.
        //      2 = Este item do menu é uma imagem standard.
        //      3 = Este item do menu é um rollover de imagem que muda no
        //              evento 'onmouseover'
        //      4 = Este menu é um espaço em branco.
        //      5 = Este menu é um seprador (em texto).
        //      6 = Este menu é um separador (em imagem).
        //  item_link       = String com o link para onde o menu salta
        //  item_data_1     = String com dados (depende do tipo de item)
        //  item_data_2     = String com dados (depende do tipo de item)
        //  item_class      = String com o nome da classe para a CSS
        //  item_alt        = String com o texto de ALT
        //  item_order      = Inteiro com a ordem dos items do menu
        //  item_width      = Inteiro com a largura em pixels do elemento
        //  item_height     = Inteiro com a altura em pixels do elemento
        //  item_active     = Flag:
        //      0 = O item do menu existe, mas não tem link activo
        //      1 = O item do menu existe e tem link activo
        //  item_hidden     = Flag:
        //      0 = O item do menu existe e é visivel
        //      1 = O item do menu existe mas não é visivel (não e desenhado)
        //  user_ID = Este campo tem o user_ID para que o menu é valido ou
        //            -1 no caso de não haver menus diferenciados

        private $priv_menu_data = array (   'ID' => '',
                                            'menu_level' => '',
                                            'new_menu_level' => '',
                                            'item_type' => '',
                                            'item_link' => '',
                                            'item_data_1' => '',
                                            'item_data_2' => '',
                                            'item_class' => '',
                                            'item_alt' => '',
					    'item_order' => '',
                                            'item_width' => '',
                                            'item_height' => '',
                                            'item_active' => '',
                                            'item_hidden' => '',
                                            'user_ID' => ''
        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_menu.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $priv_menu_data

        private $priv_menu_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj,$menu_level,$user_ID)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "app_menu " .
                                "WHERE " .
                                "menu_level='" . $menu_level . "' " .
                                "AND " .
                                "user_ID='" . $user_ID . "' " .
				"ORDER BY " .
				"'item_order'"
                              ;

            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->priv_menu_result_set, $this->table_row );
                    $this->priv_menu_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->priv_menu_result_set['num_items'] = -1;
            }
            return $this->priv_menu_result_set;
        }



        public function insert($DB_conn_obj,$menu_data)
        {
            $this->sql_string = "INSERT INTO ".
                                "app_menu (" .
                                " menu_level," .
                                " new_menu_level," .
                                " item_type," .
                                " item_link," .
                                " item_data_1," .
                                " item_data_2," .
                                " item_class," .
                                " item_alt," .
				" item_order," .
                                " item_width," .
                                " item_height," .
                                " item_active," .
                                " item_hidden," .
                                " user_ID ) " .
                                " VALUES  (" .
                                " '" . $menu_data['menu_level'] . "'," .
                                " '" . $menu_data['new_manu_level'] . "'," .
                                " '" . $menu_data['item_type'] . "'," .
                                " '" . $menu_data['item_link'] . "'," .
                                " '" . $menu_data['item_data_1'] . "'," .
                                " '" . $menu_data['item_data_2'] . "'," .
                                " '" . $menu_data['item_class'] . "'," .
                                " '" . $menu_data['item_alt'] . "'," .
				" '" . $menu_data['item_order'] . "'," .
                                " '" . $menu_data['item_width'] . "'," .
                                " '" . $menu_data['item_height'] . "'," .
                                " '" . $menu_data['item_active'] . "'," .
                                " '" . $menu_data['item_hidden'] . "'," .
                                " '" . $menu_data['user_ID'] . "' )"
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


        public function update($DB_conn_obj,$menu_data)
        {
            $this->sql_string = "UPDATE ".
                                "app_menu " .
                                "SET " .
                                " menu_level='" . $menu_data['menu_level'] . "'," .
                                " new_menu_level='" . $menu_data['new_manu_level'] . "'," .
                                " item_type='" . $menu_data['item_type'] . "'," .
                                " item_link='" . $menu_data['item_link'] . "'," .
                                " item_data_1='" . $menu_data['item_data_1'] . "'," .
                                " item_data_2='" . $menu_data['item_data_2'] . "'," .
                                " item_class='" . $menu_data['item_class'] . "'," .
                                " item_alt='" . $menu_data['item_alt'] . "'," .
				" item_order='" . $menu_data['item_order'] . "'," .
                                " item_width='" . $menu_data['item_width'] . "'," .
                                " item_height='" . $menu_data['item_height'] . "'," .
                                " item_active='" . $menu_data['item_active'] . "'," .
                                " item_hidden='" . $menu_data['item_hidden'] . "'," .
                                " user_ID='" . $menu_data['user_ID'] . "' " .
                                "WHERE " .
                                "ID='" . $menu_data['ID'] . "' "
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


        public function delete($DB_conn_obj,$menu_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "app_menu " .
                                "WHERE " .
                                "ID='" . $menu_data['ID'] . "' "
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

    interface Interface_app_progs {

    // Interface para queries sobre a tabela app_progs da base de dados
    // app_DB
    //
    // Este método recebe como parametros:
    //
    // -->
    // -->
    // -->

    public function query($DB_conn_obj,$program_name);


    // Interface para inserção de dados na tabela app_progs da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      prog_id         = Inteiro (não interessa o valor para o insert)
    //      program_name    = String com o nome da sub-aplicação
    //      app_base_dir    = String com o path para a directoria (a partir de
    //                        '/App_code/apps/'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function insert($DB_conn_obj,$progs_data);


    // Interface para update de dados na tabela app_progs da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      prog_id         = Inteiro (não interessa o valor para o insert)
    //      program_name    = String com o nome da sub-aplicação
    //      app_base_dir    = String com o path para a directoria (a partir de
    //                        '/App_code/apps/'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Update feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function update($DB_conn_obj,$progs_data);


    // Interface para apagar rows da tabela app_progs da base de dados app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      prog_id         = Inteiro (não interessa o valor para o insert)
    //      program_name    = String com o nome da sub-aplicação
    //      app_base_dir    = String com o path para a directoria (a partir de
    //                        '/App_code/apps/'
    //
    // Este método apaga a linha na base de dados cujo ID corresponde ao ID
    // que é passado.
    //

    public function delete($DB_conn_obj,$progs_data);


}


    class app_progs implements Interface_app_progs
    {
        // Array que guarda os dados de uma row da tabela 'app_progs'
        //
    //      prog_id         = Inteiro (não interessa o valor para o insert)
    //      program_name    = String com o nome da sub-aplicação
    //      app_base_dir    = String com o path para a directoria (a partir de
    //                        '/App_code/apps/'

        private $priv_progs_data = array (   'prog_ID' => '',
                                             'program_name' => '',
                                             'app_base_dir' => ''
        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_progs.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $priv_progs_data

        private $priv_progs_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj, $program_name)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "app_progs " .
                                "WHERE " .
                                "program_name='" . $program_name . "' " ;
                              ;

            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->priv_progs_result_set, $this->table_row );
                    $this->priv_progs_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->priv_progs_result_set['num_items'] = -1;
            }
            return $this->priv_progs_result_set;
        }



        public function insert($DB_conn_obj,$progs_data)
        {
            $this->sql_string = "INSERT INTO ".
                                "app_progs (" .
                                " program_name," .
                                " app_base_dir)" .
                                " VALUES  (" .
                                " '" . $progs_data['program_name'] . "'," .
                                " '" . $progs_data['app_base_dir'] . "')"
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


        public function update($DB_conn_obj,$progs_data)
        {
            $this->sql_string = "UPDATE ".
                                "app_progs " .
                                "SET " .
                                " program_name='" . $progs_data['program_name'] . "'," .
                                " app_base_dir='" . $progs_data['app_base_dir'] . "' " .
                                "WHERE " .
                                "prog_ID='" . $progs_data['prog_ID'] . "' "
                              ;
print("<hr/>");
print($this->sql_string);
print("<hr/>");

            $this->Result_Set = $DB_conn_obj->Execute( $this->sql_string );
print('<hr/>');
print_r($this->Result_set);
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


        public function delete($DB_conn_obj,$progs_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "app_progs " .
                                "WHERE " .
                                "prog_ID='" . $progs_data['prog_ID'] . "' "
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


    interface Interface_app_user {

    // Interface para queries sobre a tabela app_user da base de dados
    // app_DB
    //
    // Este método recebe como parametros:
    //
    // -->
    // -->
    // -->

    public function query($DB_conn_obj,$username);


    // Interface para inserção de dados na tabela app_user da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      user_ID     = Inteiro (não interessa o valor para o insert)
    //      username    = String com o nome do utilizador
    //      password    = String com o MD5 da password
    //      User_Admin  = Flag que indica se o user tem permissao de Admin.
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function insert($DB_conn_obj,$user_data);

    // Interface para update de dados na tabela app_user da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      user_ID     = Inteiro (não interessa o valor para o insert)
    //      username    = String com o nome do utilizador
    //      password    = String com o MD5 da password
    //      User_Admin  = Flag que indica se o user tem permissao de Admin.
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados


    public function update($DB_conn_obj,$user_data);


    // Interface para delete de dados na tabela app_user da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      user_ID     = Inteiro (não interessa o valor para o insert)
    //      username    = String com o nome do utilizador
    //      password    = String com o MD5 da password
    //      User_Admin  = Flag que indica se o user tem permissao de Admin.
    //
    // Este método apaga a linha na base de dados cujo ID corresponde ao ID
    // que é passado.
    //

    public function delete($DB_conn_obj,$user_data);


}


    class app_user implements Interface_app_user
    {
    // Array que guarda os dados de uma row da tabela 'app_user'
    //
    //      user_ID     = Inteiro (não interessa o valor para o insert)
    //      username    = String com o nome da sub-aplicação
    //      password    = String com o MD5 da password
    //      User_Admin  = Flag que indica se o user tem permissao de Admin.

        private $priv_user_data = array (    'user_ID'    => '',
                                             'username'   => '',
                                             'password'   => '',
                                             'User_Admin' => 0
        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_user.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $priv_user_data

        private $priv_user_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj, $username)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "app_user " .
                                "WHERE " .
                                "username='" . $username . "' " ;
                              ;

            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->priv_user_result_set, $this->table_row );
                    $this->priv_user_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->priv_user_result_set['num_items'] = -1;
            }
            return $this->priv_user_result_set;
        }



        public function insert($DB_conn_obj,$user_data)
        {
            $this->sql_string = "INSERT INTO " .
                                "app_user ("   .
                                " username,"   .
                                " password,"   .
                                " User_Admin)" .
                                " VALUES  ("   .
                                " '" . $user_data['username']    . "'," .
                                " '" . $user_data['password']    . "'," .
                                " '" . $user_data['User_Admin']  . "')"
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


        public function update($DB_conn_obj,$user_data)
        {
            $this->sql_string = "UPDATE ".
                                "app_user " .
                                "SET " .
                                " username='"   . $user_data['username']   . "'," .
                                " password='"   . $user_data['password']   . "'," .
                                " User_Admin='" . $user_data['User_Admin'] . "' " .
                                "WHERE " .
                                "user_ID='" . $user_data['user_ID'] . "' "
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


        public function delete($DB_conn_obj,$user_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "app_user " .
                                "WHERE " .
                                "user_ID='" . $user_data['user_ID'] . "' "
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


    interface Interface_app_acl {

    // Interface para queries sobre a tabela app_acl da base de dados
    // app_DB
    //
    // Este método recebe como parametros:
    //
    // -->
    // -->
    // -->

    public function query($DB_conn_obj,$acl_ID);


    // Interface para inserção de dados na tabela app_acl da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      acl_ID           = Inteiro (não interessa o valor para o insert)
    //      prog_ID          = program id (Inteiro)
    //      user_ID          = user id (Inteiro)
    //      access_class_ID  = access class id (Inteiro)
    //      access_type_ID   = access type id (Inteiro)
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function insert($DB_conn_obj,$acl_data);

    // Interface para update de dados na tabela app_acl da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      acl_ID           = Inteiro (não interessa o valor para o insert)
    //      prog_ID          = program id (Inteiro)
    //      user_ID          = user id (Inteiro)
    //      access_class_ID  = access class id (Inteiro)
    //      access_type_ID   = access type id (Inteiro)
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados


    public function update($DB_conn_obj,$acl_data);


    // Interface para delete de dados na tabela app_acl da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      acl_ID           = Inteiro (não interessa o valor para o insert)
    //      prog_ID          = program id (Inteiro)
    //      user_ID          = user id (Inteiro)
    //      access_class_ID  = access class id (Inteiro)
    //      access_type_ID   = access type id (Inteiro)
    //
    // Este método apaga a linha na base de dados cujo ID corresponde ao ID
    // que é passado.
    //

    public function delete($DB_conn_obj,$acl_data);


}


    class app_acl implements Interface_app_acl
    {
    // Array que guarda os dados de uma row da tabela 'app_acl'
    //
    //      acl_ID           = Inteiro (não interessa o valor para o insert)
    //      prog_ID          = program id (Inteiro)
    //      user_ID          = user id (Inteiro)
    //      access_class_ID  = access class id (Inteiro)
    //      access_type_ID   = access type id (Inteiro)

        private $priv_acl_data = array (     'acl_ID'          => 0,
                                             'prog_ID'         => 0,
                                             'user_ID'         => 0,
                                             'access_class_ID' => 0,
                                             'access_type_ID'  => 0
        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_acl.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $priv_acl_data

        private $priv_acl_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj, $acl_ID)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "app_acl " .
                                "WHERE " .
                                "acl_ID='" . $acl_ID . "' " ;
                              ;

            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->priv_acl_result_set, $this->table_row );
                    $this->priv_acl_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->priv_acl_result_set['num_items'] = -1;
            }
            return $this->priv_acl_result_set;
        }



        public function insert($DB_conn_obj,$acl_data)
        {
            $this->sql_string = "INSERT INTO "      .
                                " app_acl ("        .
                                " prog_ID,"         .
                                " user_ID,"         .
                                " access_class_ID," .
                                " access_type_ID )"  .
                                " VALUES  ("   .
                                " '" . $acl_data['prog_ID']          . "'," .
                                " '" . $acl_data['user_ID']          . "'," .
                                " '" . $acl_data['access_class_ID']  . "'," .
                                " '" . $acl_data['access_type_ID']   ."')"
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


        public function update($DB_conn_obj,$acl_data)
        {
            $this->sql_string = "UPDATE "  .
                                "app_acl " .
                                "SET " .
                                "prog_ID='"   . $acl_data['prog_ID']   . "'," .
                                " user_ID='"   . $acl_data['user_ID']   . "'," .
                                " access_class_ID='"  . $acl_data['access_class_ID'] . "'," .
                                " access_type_ID='"   . $acl_data['access_type_ID']  . "' " .
                                "WHERE " .
                                "acl_ID='" . $acl_data['acl_ID'] . "' "
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


        public function delete($DB_conn_obj,$acl_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "app_acl " .
                                "WHERE " .
                                "acl_ID='" . $acl_data['acl_ID'] . "' "
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


    interface Interface_app_access_class {

    // Interface para queries sobre a tabela app_access_class da base de dados
    // app_DB
    //
    // Este método recebe como parametros:
    //
    // -->
    // -->
    // -->

    public function query($DB_conn_obj,$access_class_ID);


    // Interface para inserção de dados na tabela app_access_class da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      access_class_ID    = Inteiro (não interessa o valor para o insert)
    //      access_class_name  = String com o nome da sub-aplicação
    //      access_class_allow = flag que indica se tem acesso ou nao
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function insert($DB_conn_obj,$access_class_data);


    // Interface para update de dados na tabela app_access_class da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //     access_class_ID     = Inteiro (não interessa o valor para o insert)
    //     access_class_name   = String com o nome da sub-aplicação
    //     access_class_allow  = flag que indica se tem acesso ou nao
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Update feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function update($DB_conn_obj,$access_class_data);


    // Interface para apagar rows da tabela app_acess_class da base de dados app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      access_class_ID     = Inteiro (não interessa o valor para o insert)
    //      access_class_name   = String com o nome da sub-aplicação
    //      access_class_allow  = flag que indica se tem acesso ou nao
    //
    // Este método apaga a linha na base de dados cujo ID corresponde ao ID
    // que é passado.
    //

    public function delete($DB_conn_obj,$access_class_data);


}


    class app_access_class implements Interface_app_access_class
    {
    // Array que guarda os dados de uma row da tabela 'app_class_data'
    //
    //      access_class_ID     = Inteiro (não interessa o valor para o insert)
    //      access_class_name   = String com o nome da sub-aplicação
    //      access_class_allow  = flag que indica se tem acesso ou nao

        private $priv_access_class_data = array (
                                                 'access_class_ID'   => '',
                                                 'access_class_name' => '',
                                                 'access_base_allow' => ''
        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_access_class.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $priv_access_class_data

        private $priv_access_class_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj, $access_class_ID)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "app_access_class " .
                                "WHERE " .
                                "=access_class_ID'" . $access_class_ID . "' " ;
                              ;


            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->priv_access_class_result_set, $this->table_row );
                    $this->priv_access_class_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->priv_access_class_result_set['num_items'] = -1;
            }
            return $this->priv_access_class_result_set;
        }



        public function insert($DB_conn_obj,$access_class_data)
        {
            $this->sql_string = "INSERT INTO ".
                                "app_access_class (" .
                                " access_class_name," .
                                " access_base_allow)" .
                                " VALUES  (" .
                                " '" . $access_class_data['access_class_name' ] . "'," .
                                " '" . $access_class_data['access_base_allow'] . "')"
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


        public function update($DB_conn_obj,$access_class_data)
        {
            $this->sql_string = "UPDATE ".
                                "app_access_class " .
                                "SET " .
                                " access_class_name='"  . $access_class_data['access_class_name' ] . "'," .
                                " access_base_allow='" . $access_base_data['access_base_allow'] . "' " .
                                "WHERE " .
                                "access_class_ID='"     . $access_class_data['access_class_ID'   ] . "' "
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


        public function delete($DB_conn_obj,$access_class_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "app_access_class " .
                                "WHERE " .
                                "access_class_ID='" . $access_class_data['access_class_ID'] . "' "
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


    interface Interface_app_access_type {

    // Interface para queries sobre a tabela app_access_type da base de dados
    // app_DB
    //
    // Este método recebe como parametros:
    //
    // -->
    // -->
    // -->

    public function query($DB_conn_obj,$access_type_ID);


    // Interface para inserção de dados na tabela app_access_type da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      access_type_ID           = Inteiro (não interessa o valor para o insert)
    //      access_type_name         = String com o nome da sub-aplicação
    //      access_type_is_admin     = flag que indica se é admin ou nao
    //      access_type_is_user      = flag que indica se é user
    //      access_type_is_guest     = flag que indica se é guest
    //      access_type_is_restrict  = flag que indica tipo restrito ou nao
    //
    //      Este método retorna um código de erro indicando o resultado da
    //      operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function insert($DB_conn_obj,$access_type_data);


    // Interface para update de dados na tabela app_access_type da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      access_type_ID           = Inteiro (não interessa o valor para o insert)
    //      access_type_name         = String com o nome da sub-aplicação
    //      access_type_is_admin     = flag que indica se é admin ou nao
    //      access_type_is_user      = flag que indica se é user
    //      access_type_is_guest     = flag que indica se é guest
    //      access_type_is_restrict  = flag que indica tipo restrito ou nao
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Update feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function update($DB_conn_obj,$access_type_data);


    // Interface para apagar rows da tabela app_access_type da base de dados app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //      access_class_ID     = Inteiro (não interessa o valor para o insert)
    //      access_class_name   = String com o nome da sub-aplicação
    //      access_class_allow  = flag que indica se tem acesso ou nao
    //
    // Este método apaga a linha na base de dados cujo ID corresponde ao ID
    // que é passado.
    //

    public function delete($DB_conn_obj,$access_type_data);


}


    class app_access_type implements Interface_app_access_type
    {
    // Array que guarda os dados de uma row da tabela 'app_class_data'
    //
    //      access_type_ID           = Inteiro (não interessa o valor para o insert)
    //      access_type_name         = String com o nome da sub-aplicação
    //      access_type_is_admin     = flag que indica se é admin ou nao
    //      access_type_is_user      = flag que indica se é user
    //      access_type_is_guest     = flag que indica se é guest
    //      access_type_is_restrict  = flag que indica tipo restrito ou nao


        private $priv_access_type_data = array (
                                                 'access_type_ID'           => 0,
                                                 'access_type_name'         => '',
                                                 'access_type_is_admin'     => 0,
                                                 'access_type_is_user'      => 0,
                                                 'access_type_is_guest'     => 0,
                                                 'access_type_is_restrict'  => 0
        );

        // Array que guarda todo o result set de um query sobre a tabela
        // app_access_type.
        //
        // É um array com indice numerico e cada elemento deste array é
        // um array associativo igual a $priv_access_type_data

        private $priv_access_type_result_set = array ( 'num_items' => 0 );


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


        public function query($DB_conn_obj, $access_type_ID)
        {

            // Seleccionar o modo de retorno por array associativo
            $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "app_access_type " .
                                "WHERE " .
                                "=access_type_ID'" . $access_type_ID . "' " ;
                              ;

            $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

            if ( $this->Result_Set )
            {
                // Se o SELECT é valido, retorna o campo 'num_items'
                // como numero de rows retornadas pelo SELECT e um array
                // para cada row do resultado
                while( $this->table_row  = $this->Result_Set->FetchRow() )
                {
                    array_push( $this->priv_access_type_result_set, $this->table_row );
                    $this->priv_access_type_result_set['num_items'] += 1;
                }
            }
            else
            {
                // Se o SELECT deu erro, retorna -1 no campo 'num_items'
                // do array de resultado
                $this->priv_access_type_result_set['num_items'] = -1;
            }
            return $this->priv_access_type_result_set;
        }



        public function insert($DB_conn_obj,$access_type_data)
        {
            $this->sql_string = "INSERT INTO "             .
                                "app_access_type ("        .
                                "access_type_name,"        .
                                "access_type_is_admin,"    .
                                "access_type_is_user,"     .
                                "access_type_is_guest,"    .
                                "access_type_is_restrict )" .
                                " VALUES  (" .
                                " '" . $access_type_data['access_type_name' ]       ."'," .
                                " '" . $access_type_data['access_type_is_admin']    ."'," .
                                " '" . $access_type_data['access_type_is_user']     ."'," .
                                " '" . $access_type_data['access_type_is_guest']    ."'," .
                                " '" . $access_type_data['access_type_is_restrict'] ."')"
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


        public function update($DB_conn_obj,$access_type_data)
        {
            $this->sql_string = "UPDATE ".
                                "app_access_type " .
                                "SET " .
                                "access_type_name        ='" . $access_type_data['access_type_name' ]       ."',".
                                "access_type_is_admin    ='" . $access_type_data['access_type_is_admin']    ."',".
                                "access_type_is_user     ='" . $access_type_data['access_type_is_user']     ."',".
                                "access_type_is_guest    ='" . $access_type_data['access_type_guest']       ."',".
                                "access_type_is_restrict ='" . $access_type_data['access_type_is_restrict'] ."' ".
                                "WHERE " .
                                "access_type_ID          ='" . $access_type_data['access_type_ID']          ."' "
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


        public function delete($DB_conn_obj,$access_type_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "app_access_type " .
                                "WHERE " .
                                "access_type_ID='" . $access_type_data['access_type_ID'] . "' "
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
