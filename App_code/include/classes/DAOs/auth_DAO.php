<?php
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  Class:  Auth_DAO
 * 
 *  Methods:    user_login( $username, $password )
 *              user_logout( $user_ID )
 *              get_UID( $username )
 *              is_user_valid( $username )
 *              is_user_ID_valid( $user_ID )
 *              get_user_type( $username )
 *              get_user_perms( $user_ID )
 */


Interface Interface_Auth_DAO
{
    // Método:  user_login( $username, $password )
    //
    // Este método recebe o username em $username e a password em $password
    // e acede à tabela 'Auth' da base de dados 'app_DB' para validar ou não
    // o acesso destas credenciais.
    // 
    // O username em $username e a password em $password, encontram-se na forma
    // como foram introduzidas, sendo dentro desta classe que a password é
    // encriptada com o mesmo algoritmo que foi utilizado quando a mesma foi
    // armazenada na base de dados.
    //
    // Retorna:
    //  Se o nome de utilizador não existir:
    //      $result = array ( 'user_ID'  => -1,
    //                        'status'   => FALSE,
    //                        'ret_code' => -1  --> Utilizador não existe
    //                        'updt_res' => -2  --> Não foi feito update
    //                      )
    //  Se o utilizador existir mas a password for errada:
    //      $result = array ( 'user_ID'  => -1,
    //                        'status'   => FALSE,
    //                        'ret_code' => -2  --> Password errada
    //                        'updt_res' => 0 | -1  --> Resultado do update
    //                      )
    //  Se o utilizador existir e a password for correcta:
    //      $result = array ( 'user_ID'  => user_ID,
    //                        'status'   => TRUE,
    //                        'ret_code' => 0   --> Utlizador e password certos
    //                        'updt_res' => 0 | -1  --> Resultado do update
    //                      )

    public function user_login( $username, $password );


    // Método:  user_logout( $user_ID )
    //
    // Este método recebe o 'user_ID' de um utilizador que tenha feito login
    // anteriormente e faz logout dele.
    // Se o utilizador não tiver feito login anteriormente ou o 'user_ID' não
    // for válido, retorna o código de erro correspondente.
    //
    // Retorna:
    //      $result = array ( 'user_ID' = -1,
    //                        'error_code' =  0 : logout com sucesso |
    //                                     = -1 : utilizador existe mas sem login |
    //                                     = -2 : utilizador não existe )
    //                        'updt_res'   = -2     -> não foi necessário fazer update
    //                                     = 0 | -1 -> resultado do update
    //                       )

    public function user_logout( $user_ID );


    // Método:  get_UID( $username )
    //
    // Este método recebe o nome de utilizador em $username e, caso ele exista,
    // retorna o 'user_ID' ou -1, se ele não existir, e se o utilizador tem
    // login feito ou não.
    //
    // Retorna:
    //  $username existe:
    //      $result = array ( 'user_ID' = UID do utilizador,
    //                        'logon'   = TRUE  -> o utilizador tem login feito
    //                        'logon'   = FALSE -> o utilizador não tem login feito
    //                      )
    //  $username não existe:
    //      $result = array ( 'user_ID' = -1, -->  Utilizador é anónimo
    //                        'logon'   = FALSE -> o utilizador não tem login feito
    //                      )

    public function get_UID( $username );


    // Método:  is_user_valid( $username )
    //
    // Este método recebe o nome de utilizador em $username e, caso ele exista,
    // retorna TRUE.
    // Caso contrário, retorna FALSE.

    public function is_user_valid( $username );


    // Método:  is_user_ID_valid( $user_ID )
    //
    // Este método recebe o 'user_ID' em $user_ID e, caso o mesmo exista e seja
    // válido, retorna TRUE. O 'user_ID' -1 é SEMPRE válido!
    // Caso contrário, retorna FALSE.

    public function is_user_ID_valid( $user_ID );


    // Método:  get_user_type( $username )
    //
    // Este método recebe o nome de utilizador em $username e, caso ele exista,
    // retorna o tipo de utilizador.
    // Se o utilizador não existir indica que o utilizador não é valido.
    //
    // Retorna:
    //  Se o utilizador existir:
    //      $result = array ( 'user_valid' = TRUE,
    //                        'user_type'  = 'user_type',
    //                        'user_ID'    = 'user_ID'
    //                      )
    //  Se o utlizador não existir:
    //      $result = array ( 'user_valid' = FALSE,
    //                        'user_type'  = -1,
    //                        'user_ID'    = -1
    //                      )

    public function get_user_type( $username );


    // Método:  get_user_perms( $user_ID )
    //
    // Este método recebe o 'user_ID' em $user_ID e retorna um array com as
    // permissões válidas para o respectivo utilizador.
    //
    // Retorna:
    //  'user_ID' existe:
    //      $result = array ( 'UID_valid'  = TRUE,
    //                        'anon_user'  = TRUE if UID = -1, false otherwise,
    //                        'user_perms' = array com as permissões do utilizador
    //                      )
    //  'user_ID' não existe:
    //      $result = array ( 'UID_valid'  = FALSE,
    //                        'anon_user'  = TRUE,
    //                        'user_perms' = null
    //                      )
    //
    // OBS: Neste momento, uma vez que 'user_perms' não está ainda defenido
    //      (2010.07.04), o item 'user_perms', retorna null em vez de um array

    public function get_user_perms( $user_ID );

}


Class Auth_DAO implements Interface_Auth_DAO
{

    // Esta propriedade privada guarda a instância do objecto 'app_DB' que
    // permite o acesso à tabela 'Auth' da base de dados 'app_DB'

    private $app_DB_instance ;


    // Esta propriedade privada guarda o objecto ADODB que representa a conexão
    // à base de dados 'app_DB' via ADODB

    private $ADODB_obj ;


    // Esta propriedade privada guarda a instância do objecto 'app_DB_Auth' que
    // permite a interacçao com a tabela 'Auth' da base de dados 'app_DB'

    private $app_DB_Auth_instance ;



    // Método:  __construct()
    //
    // Este método é o construtor da classe e é ele o responsável por obter
    // o objecto que representa a ligação à base de dados 'app_DB'.
    //
    // O objecto ADODB necessário para poder aceder à base de dados, uma vez
    // obtido, é guardado numa propriedade privada desta classe.

    public function __construct()
    {
        $this->app_DB_instance = app_DB::getInstance() ;

        $this->app_DB_instance->open( 0 );

        $result = $this->app_DB_instance->get_DB_obj() ;
        if( $result[ 'status' ] == 0 )
        {
            $this->ADODB_obj = $result['DB_obj'] ;
        }
        else
        {
            $this->ADODB_obj = null ;
        }

        $this->app_DB_Auth_instance = new app_DB_Auth ;

    }


    // Método:  get_user_data_by_username( $username )
    //
    // Este método recebe o 'username' em $username e vai tentar obter a linha
    // da tabela 'Auth' da base de dados 'app_DB', se esta existir.
    //
    // Retorna:
    //  $auth_data = array ( 'username'  = '<username>',     // String(64)
    //                       'password'  = '<password>',     // String(64)
    //                       'user_ID'   = '<user_ID>',      // Integer
    //                       'user_type' = '<user_type>',    // Small integer
    //                       'is_Logon'  = TRUE | FALSE      // Boolean
    //                       'status'    = TRUE | FALSE
    //                     )
    //
    // OBS: A fim de simplificar, no caso de haver mais do que uma row para o
    // mesmo 'username' (que não poderá existir, por definição), retornamos
    // apenas a primeira encontrada.


    private function get_user_data_by_username( $username )
    {
        // $query_result_set = array() ;

        $query_result_set = $this->app_DB_Auth_instance->query_by_username(
                                                        $this->ADODB_obj,
                                                        $username
                                                      ) ;

        if( $query_result_set['num_items'] == 0 )
        {
            // Se o SELECT não retornar dados
            return array( 'username'  => '',
                          'password'  => '',
                          'user_ID'   => -1,
                          'user_type' => 0,
                          'is_Logon'  => FALSE,
                          'status'    => FALSE
                        );
        }
        else
        {
            // Se o SELECT retornar dados, assumimos que retorna apenas uma row
            // ignorando quaisquer outras.

            $rs_0 = $query_result_set[ 0 ] ;

            return array( 'username'  => $rs_0['username'] ,
                          'password'  => $rs_0['password'] ,
                          'user_ID'   => $rs_0['user_ID'] ,
                          'user_type' => $rs_0['user_type'] ,
                          'is_Logon'  => $rs_0['is_Logon'] ,
                          'status'    => TRUE
                        );
        }

    }


    // Método:  get_user_data_by_user_name_ID( $user_ID )
    //
    // Este método recebe o 'user_ID' em $user_ID e vai tentar obter a linha
    // da tabela 'Auth' da base de dados 'app_DB', se esta existir.
    //
    // Retorna:
    //  $auth_data = array ( 'username'  = '<username>',     // String(64)
    //                       'password'  = '<password>',     // String(64)
    //                       'user_ID'   = '<user_ID>',      // Integer
    //                       'user_type' = '<user_type>',    // Small integer
    //                       'is_Logon'  = TRUE | FALSE      // Boolean
    //                       'status'    = TRUE | FALSE
    //                     )
    //
    // OBS: A fim de simplificar, no caso de haver mais do que uma row para o
    // mesmo 'user_ID' (que não poderá existir, por definição), retornamos
    // apenas a primeira encontrada.

    private function get_user_data_by_user_ID( $user_ID )
    {
        $query_result_set = array() ;

        $query_result_set = $this->app_DB_Auth_instance->query_by_user_ID(
                                                        $this->ADODB_obj,
                                                        $user_ID
                                                      ) ;

        if( $query_result_set['num_items'] == 0 )
        {
            // Se o SELECT não retornar dados
            return array( 'username'  => '',
                          'password'  => '',
                          'user_ID'   => -1,
                          'user_type' => 0,
                          'is_Logon'  => FALSE,
                          'status'    => FALSE
                        );
        }
        else
        {
            // Se o SELECT retornar dados, assumimos que retorna apenas uma row
            // ignorando quaisquer outras.

            $rs_0 = $query_result_set[0];

            return array( 'username'  => $rs_0['username'],
                          'password'  => $rs_0['password'],
                          'user_ID'   => $rs_0['user_ID'],
                          'user_type' => $rs_0['user_type'],
                          'is_Logon'  => $rs_0['is_Logon'],
                          'status'    => TRUE
                        );
        }

    }


    // Método:  user_login( $username, $password )
    //
    // Este método recebe o username em $username e a password em $password
    // e acede à tabela 'Auth' da base de dados 'app_DB' para validar ou não
    // o acesso destas credenciais.
    //
    // O username em $username e a password em $password, encontram-se na forma
    // como foram introduzidas, sendo dentro desta classe que a password é
    // encriptada com o mesmo algoritmo que foi utilizado quando a mesma foi
    // armazenada na base de dados.
    //
    // Retorna:
    //  Se o nome de utilizador não existir:
    //      $result = array ( 'user_ID'  => -1,
    //                        'status'   => FALSE,
    //                        'ret_code' => -1  --> Utilizador não existe
    //                        'updt_res' => -2  --> Não foi feito update
    //                      )
    //  Se o utilizador existir mas a password for errada:
    //      $result = array ( 'user_ID'  => -1,
    //                        'status'   => FALSE,
    //                        'ret_code' => -2  --> Password errada
    //                        'updt_res' => 0 | -1  --> Resultado do update
    //                      )
    //  Se o utilizador existir e a password for correcta:
    //      $result = array ( 'user_ID'  => user_ID,
    //                        'status'   => TRUE,
    //                        'ret_code' => 0   --> Utlizador e password certos
    //                        'updt_res' => 0 | -1  --> Resultado do update
    //                      )
    
    public function user_login( $username, $password )
    {
        $user_data = $this->get_user_data_by_username( $username );

        if( $user_data['status'] == FALSE )
        {
            return  array( 'user_ID'  => -1,
                           'status'   => FALSE,
                           'ret_code' => -1,
                           'updt_res' => -2
                         );
        }
        else
        {
            $user = $user_data['username'] ;
            $pass = $user_data['password'] ;

            if( strtoupper( md5( $password )) === $pass )
            {
                // A password fornecida e a passowrd armazenada são iguais
                $new_user_data = array( 'username'  => $user_data['username'],
                                        'password'  => $user_data['password'],
                                        'user_ID'   => $user_data['user_ID'],
                                        'user_type' => $user_data['user_type'],
                                        'is_Logon'  => true
                                      );

                // Faz um update sobre a tabela 'Auth' da base de dados 'app_DB'
                // para marcar o utilizador como 'is_Logon'

                $result = $this->app_DB_Auth_instance->update_by_username(
                                                        $this->ADODB_obj,
                                                        $new_user_data
                                                       ) ;

                return  array( 'user_ID'  => $user_data['user_ID'],
                               'status'   => TRUE,
                               'ret_code' => 0,
                               'updt_res' => $result
                             );
            }
            else
            {
                // A password fornecida e a password armazenada não são iguais
                $new_user_data = array( 'username'  => $user_data['username'],
                                        'password'  => $user_data['password'],
                                        'user_ID'   => $user_data['user_ID'],
                                        'user_type' => $user_data['user_type'],
                                        'is_Logon'  => false
                                      );

                // Faz um update sobre a tabela 'Auth' da base de dados 'app_DB'
                // para marcar o utilizador como 'is_Logoff'

                $result = $this->app_DB_Auth_instance->update_by_username(
                                                        $this->ADODB_obj,
                                                        $new_user_data
                                                       ) ;

                return  array( 'user_ID'  => -1,
                               'status'   => FALSE,
                               'ret_code' => -2,
                               'updt_res' => $result
                             );
            }

        }
        
    }


    // Método:  user_logout( $user_ID )
    //
    // Este método recebe o 'user_ID' de um utilizador que tenha feito login
    // anteriormente e faz logout dele.
    // Se o utilizador não tiver feito login anteriormente ou o 'user_ID' não
    // for válido, retorna o código de erro correspondente.
    //
    // Retorna:
    //      $result = array ( 'user_ID' = -1,
    //                        'error_code' =  0 : logout com sucesso |
    //                                     = -1 : utilizador existe mas sem login |
    //                                     = -2 : utilizador não existe )
    //                        'updt_res'   = -2     -> não foi necessário fazer update
    //                                     = 0 | -1 -> resultado do update
    //                      )

    public function user_logout( $user_ID )
    {
        $user_data = $this->get_user_data_by_user_ID( $user_ID );

        if( $user_data['status'] == FALSE )
        {
            return  array( 'user_ID'    => -1,
                           'error_code' => -2,
                           'updt_res'   => -2
                         );
        }
        else
        {
            if( $user_data['is_Logon'] == FALSE )
            {
                // O utilizador existe ma não tem login feito

                return  array( 'user_ID'    => -1,
                               'error_code' => -1,
                               'updt_res'   => 0
                             );
            }
            else
            {
                // O utilizador existe e tem login feito

                $new_user_data = array( 'username'  => $user_data['username'],
                                        'password'  => $user_data['password'],
                                        'user_ID'   => $user_data['user_ID'],
                                        'user_type' => $user_data['user_type'],
                                        'is_Logon'  => FALSE
                                      );

                // Faz um update sobre a tabela 'Auth' da base de dados 'app_DB'
                // para marcar o utilizador como 'is_Logon'

                $result = $this->app_DB_Auth_instance->update_by_user_ID(
                                                                $this->ADODB_obj,
                                                                $new_user_data
                                                            ) ;

                return  array( 'user_ID'    => -1,
                               'error_code' => 0,
                               'updt_res'   => $result
                             );
            }

        }

    }


    // Método:  get_UID( $username )
    //
    // Este método recebe o nome de utilizador em $username e, caso ele exista,
    // retorna o 'user_ID' ou -1, se ele não existir, e se o utilizador tem
    // login feito ou não.
    //
    // Retorna:
    //  $username existe:
    //      $result = array ( 'user_ID' = UID do utilizador,
    //                        'logon'   = TRUE  -> o utilizador tem login feito
    //                        'logon'   = FALSE -> o utilizador não tem login feito
    //                      )
    //  $username não existe:
    //      $result = array ( 'user_ID' = -1, -->  Utilizador é anónimo
    //                        'logon'   = FALSE -> o utilizador não tem login feito
    //                      )

    public function get_UID( $username )
    {
        $user_data = $this->get_user_data_by_username( $username );

        if( $user_data['status'] == TRUE )
        {
            // O utilizador existe

            return  array(  'user_ID' => $user_data['user_ID'],
                            'logon'   => $user_data['is_Logon']
                         );
        }
        else
        {
            // O utilizador não existe

            return  array(  'user_ID' => -1,
                            'logon'   => FALSE
                         );
        }

    }


    // Método:  is_user_valid( $username )
    //
    // Este método recebe o nome de utilizador em $username e, caso ele exista,
    // retorna TRUE.
    // Caso contrário, retorna FALSE.

    public function is_user_valid( $username )
    {
        $user_data = $this->get_user_data_by_username( $username );

        return $user_data['status'] ;

    }


    // Método:  is_user_ID_valid( $user_ID )
    //
    // Este método recebe o 'user_ID' em $user_ID e, caso o mesmo exista e seja
    // válido, retorna TRUE. O 'user_ID' -1 é SEMPRE válido!
    // Caso contrário, retorna FALSE.

    public function is_user_ID_valid( $user_ID )
    {
        $user_data = $this->get_user_data_by_user_ID( $user_ID );

        return $user_data['status'] ;

    }


    // Método:  get_user_type( $username )
    //
    // Este método recebe o nome de utilizador em $username e, caso ele exista,
    // retorna o tipo de utilizador.
    // Se o utilizador não existir indica que o utilizador não é valido.
    //
    // Retorna:
    //  Se o utilizador existir:
    //      $result = array ( 'user_valid' = TRUE,
    //                        'user_type'  = 'user_type',
    //                        'user_ID'    = 'user_ID'
    //                      )
    //  Se o utlizador não existir:
    //      $result = array ( 'user_valid' = FALSE,
    //                        'user_type'  = -1,
    //                        'user_ID'    = -1
    //                      )

    public function get_user_type( $username )
    {
        $user_data = $this->get_user_data_by_username( $username );

        if( $user_data['status'] == TRUE )
        {
            // O utilizador existe

            return  array(  'user_valid' => TRUE,
                            'user_type'  => $user_data['user_type'],
                            'user_ID'    => $user_data['user_ID']
                         );
        }
        else
        {
            // O utilizador não existe

            return  array(  'user_valid' => FALSE,
                            'user_type'  => -1,
                            'user_ID'    => -1
                         );
        }

    }


    // Método:  get_user_perms( $user_ID )
    //
    // Este método recebe o 'user_ID' em $user_ID e retorna um array com as
    // permissões válidas para o respectivo utilizador.
    //
    // Retorna:
    //  'user_ID' existe:
    //      $result = array ( 'UID_valid'  = TRUE,
    //                        'anon_user'  = TRUE if UID = -1, false otherwise,
    //                        'user_perms' = array com as permissões do utilizador
    //                      )
    //  'user_ID' não existe:
    //      $result = array ( 'UID_valid'  = FALSE,
    //                        'anon_user'  = TRUE,
    //                        'user_perms' = null
    //                      )
    //
    // OBS: Neste momento, uma vez que 'user_perms' não está ainda defenido
    //      (2010.07.04), o item 'user_perms', retorna null em vez de um array

    public function get_user_perms( $user_ID )
    {
        if( $user_ID == -1 )
        {
            return  array(  'user_valid' => TRUE,
                            'anon_user'  => TRUE,
                            'user_perms' => null
                         );
        }
        else
        {
            $user_data = $this->get_user_data_by_user_ID( $user_ID );

            if( $user_data['status'] == TRUE )
            {
                // O utilizador existe

                return  array(  'user_valid' => TRUE,
                                'anon_user'  => FALSE,
                                'user_perms' => null
                             );
            }
            else
            {
                // O utilizador não existe

                return  array(  'user_valid' => FALSE,
                                'user_type'  => TRUE,
                                'user_perms' => null
                             );
            }
            
        }
        
    }
    
    
    /**
     * This method checks is a table exists and, if it does not, it creates it
     * 
     * To perform its task it uses the following SQL sentence:
     * 
     *      SELECT  count(*) 
     *      FROM    information_schema.tables 
     *      WHERE   table_schema = <schema-or-db-name> 
     *      AND     table_name = <table-or-view-name>
     *      ;
     * 
     *  This method returns an array with the following results:
     * 
     *      The table exists:   return  array( 'table_exists'   => TRUE,
     *                                         'table_created'  => FALSE,
     *                                         'error_code'     => 0
     *                                       )
     *      The table does  :   return  array( 'table_exists'   => FALSE,
     *      not exist and is                   'table_created'  => TRUE,
     *      created                            'error_code'     => 0
     *                                       )
     *      The table does  :   return  array( 'table_exists'   => FALSE,
     *      not exist and is                   'table_created'  => FALSE,
     *      not created                        'error_code'     => -1
     *                                       )
     */
    private function check_data_context_exists( )
    {
        $query = $this->db->query( 'SELECT  count(*) ' .
                                   'FROM    information_schema.tables ' .
                                   'WHERE   table_schema = ' . "'" . 'u10022_app_db' . "' " .
                                   'AND     table_name = ' . "'" . 'data_context' . "';"
                                 );
        
//        var_dump( $query ) ;
//        echo "<br><hr>" ;

//        var_dump( $query->result_object() ) ;
//        echo "<br><hr>" ;

//        var_dump( $query->row() ) ;
//        echo "<br><hr>" ;

//        var_dump( $query->result_array() ) ;
//        echo "<br><hr>" ;

//        var_dump( $query->row_array() ) ;
//        echo "<br><hr>" ;

        $table_result = $query->row_array() ;
        
        if ( $table_result[ 'count(*)' ] === '0' )
        {
            // The selected table does not exist. So it must be created
            // Use a hardwired definition for now
            $db_result = $this->db->query( 
                                           'CREATE TABLE `Auth` ( ' .
                                           '`username` VARCHAR(64) NOT NULL, ' .
                                           '`password` VARCHAR(64), ' .
                                           '`user_ID` INT NOT NULL AUTO_INCREMENT, ' .
                                           '`user_type` SMALLINT DEFAULT 0 , ' .
                                           '`is_Logon` int(1) DEFAULT 0, ' .
                                           'PRIMARY KEY (`user_ID`) ' .
                                           ' ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;'
                                         );
            if ( $db_result === TRUE )
            {
                return  array( 'table_exists'   =>  FALSE ,
                               'table_created'  =>  TRUE ,
                               'error_code'     =>  0
                             ) ;
            }
            else
            {
                return  array( 'table_exists'   =>  FALSE ,
                               'table_created'  =>  FALSE ,
                               'error_code'     =>  -1
                             ) ;
            }
        }
        else
        {
            return  array( 'table_exists'   =>  TRUE ,
                           'table_created'  =>  FALSE ,
                           'error_code'     =>  0
                         ) ;
        }
    }
    


}
