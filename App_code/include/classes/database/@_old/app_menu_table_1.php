 <?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Admin
 */
interface Interface_app_menu {

    // Interface para defenir os parametros de acesso a base de dados
    // a ser utilizada dentro desta classe

    public function set_DB($driver,$host,$user,$password,$database);


    // Interface para abrir a ligação a base de dados e permitir o acesso
    // a tabela app_menu
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function open($conn_type);


    // Interface para fechar a ligação a base de dados
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Fecho da conexão a base de dados feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function close();
    

    // Interface para queries sobre a tabela app_menu da base de dados
    // app_DB
    public function query($menu_level,$user_ID);


    // Interface para inserção de dados na tabela app_menu da base de dados
    // app_DB
    //
    // Este metodo recebe como parametro de entrada um array com os seguintes
    // campos:
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
    
    public function insert($menu_data);


    // Interface para update de dados na tabela app_menu da base de dados
    // app_DB
    //
    // Este metodo recebe como parametro de entrada um array com os seguintes
    // campos:
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

    public function update($menu_data);


    // Interface para apagar rows da tabela app_menu da base de dados app_DB
    //
    // Este meétodo recebe o ID da row na base de dados e apaga a respectiva
    // row.
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Delete feito com sucesso.
    //      -1 = Erro no acesso à bbase de dados.

    public function delete($menu_data);


}


    class app_menu implements Interface_app_menu
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


        // Este metodo da classe recebe um parametro indicando se a
        // conexão à base de dados é pressistente ou não.
        //
        //      $conn_type :
        //          0  =    Ligação não pressistente à base de dados
        //          1  =    Ligação pressistente à base de dados

        public function open($conn_type)
        {
            $this->app_DB_obj = &ADONewConnection($this->app_priv_DB['driver']);

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


        public function close()
        {
            $this->app_DB_obj->Close();
        }


        public function query($menu_level,$user_ID)
        {
        
            // Seleccionar o modo de retorno por array associativo
            $this->app_DB_obj->SetFetchMode(ADODB_FETCH_ASSOC);

            $this->sql_string = "SELECT * FROM ".
                                "app_menu " .
                                "WHERE " .
                                "menu_level='" . $menu_level . "' " .
                                "AND " .
                                "user_ID='" . $user_ID . "' "
                              ;
            $this->Result_Set = &$this->app_DB_obj->Execute( $this->sql_string );

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



        public function insert($menu_data)
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
                                " '" . $menu_data['item_width'] . "'," .
                                " '" . $menu_data['item_height'] . "'," .
                                " '" . $menu_data['item_active'] . "'," .
                                " '" . $menu_data['item_hidden'] . "'," .
                                " '" . $menu_data['user_ID'] . "' )"
            ;

            $this->Result_Set = $this->app_DB_obj->Execute( $this->sql_string );

            if ( $this->Result_Set === false )
            {
                return -1;
            }
            else
            {
                return 0;
            }

       }


        public function update($menu_data)
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
                                " item_width='" . $menu_data['item_width'] . "'," .
                                " item_height='" . $menu_data['item_height'] . "'," .
                                " item_active='" . $menu_data['item_active'] . "'," .
                                " item_hidden='" . $menu_data['item_hidden'] . "'," .
                                " user_ID='" . $menu_data['user_ID'] . "' " .
                                "WHERE " .
                                "ID='" . $menu_data['ID'] . "' "
            ;

            $this->Result_Set = $this->app_DB_obj->Execute( $this->sql_string );

            if ( $this->Result_Set === false )
            {
                return -1;
            }
            else
            {
                return 0;
            }
        }


        public function delete($menu_data)
        {
            $this->sql_string = "DELETE FROM ".
                                "app_menu " .
                                "WHERE " .
                                "ID='" . $menu_data['ID'] . "' "
            ;

            $this->Result_Set = $this->app_DB_obj->Execute( $this->sql_string );

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
