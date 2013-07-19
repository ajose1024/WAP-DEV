<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  Class:  app_DB_Auth
 * 
 *  Methods:    query_by_username( $DB_conn_obj, $auth_data )
 *              query_by_user_ID( $DB_conn_obj, $auth_data )
 *              insert( $DB_conn_obj, $auth_data )
 *              delete_by_username( $DB_conn_obj, $auth_data )
 *              delete_by_user_ID( $DB_conn_obj, $auth_data )
 *              update_by_username( $DB_conn_obj, $auth_data )
 *              update_by_user_ID( $DB_conn_obj, $auth_data )
 */

interface Interface_app_DB_Auth
{
    // A tabela 'Auth' da base de dados 'app_DB' é criada com o seguinte
    // comando SQL:
    //
    //  CREATE TABLE IF NOT EXISTS `Auth` (
    //  `username` varchar(64) NOT NULL,
    //  `password` varchar(64) default NULL,
    //  `user_ID` int(11) NOT NULL auto_increment,
    //  `user_type` smallint(6) default '0',
    //  `is_Logon` int(1) default '0',
    //  PRIMARY KEY  (`user_ID`)
    //  ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    //
    //
    // Assim sendo o array $auth_data tem a seguinte estrutura:
    //
    //  $auth_data = array ( 'username'  = '<username>',     // String(64)
    //                       'password'  = '<password>',     // String(32)
    //                       'user_ID'   = '<user_ID>',      // Integer
    //                       'user_type' = '<user_type>',    // Small integer
    //                       'is_Logon'  = TRUE | FALSE      // Boolean
    //                     )


    // Interface para queries sobre a tabela auth da base de dados
    // app_DB usando 'username' como chave
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> O campo 'username' com o nome do utilizador

    public function query_by_username( $DB_conn_obj, $username );


    // Interface para queries sobre a tabela auth da base de dados
    // app_DB usando 'user_ID' como chave
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> O campo 'user_ID' com o UID

    public function query_by_user_ID( $DB_conn_obj, $user_ID );


    // Interface para inserção de dados na tabela auth da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function insert( $DB_conn_obj, $auth_data );


    // Interface para update de dados na tabela auth da base de dados
    // app_DB usando 'username' como chave
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Update feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function update_by_username( $DB_conn_obj, $auth_data );


    // Interface para update de dados na tabela auth da base de dados
    // app_DB usando 'user_name_ID' como chave
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Update feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function update_by_user_ID( $DB_conn_obj, $auth_data );


    // Interface para apagar rows da tabela Auth da base de dados
    // app_DB usando 'username' como chave
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método apaga a linha na base de dados cujo 'usdername' corresponde
    // ao username que é passado.
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Delete feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function delete_by_username( $DB_conn_obj, $auth_data );


    // Interface para apagar rows da tabela Auth da base de dados
    // app_DB usando 'user_name_ID' como chave
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método apaga a linha na base de dados cujo 'user_name_ID' corresponde
    // ao user_ID que é passado.
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Delete feito com sucesso.
    //      -1 = Erro no acesso à bbase de dados.

    public function delete_by_user_ID( $DB_conn_obj, $auth_data );



}


class app_DB_Auth implements Interface_app_DB_Auth
{
    // The table 'Auth' in the 'app_DB' database is created with the following
    // SQL statement:
    //
    //  CREATE TABLE IF NOT EXISTS `Auth` (
    //  `username` varchar(64) NOT NULL,
    //  `password` varchar(64) default NULL,
    //  `user_ID` int(11) NOT NULL auto_increment,
    //  `user_type` smallint(6) default '0',
    //  `is_Logon` int(1) default '0',
    //  PRIMARY KEY  (`user_ID`)
    //  ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    //
    //
    // The $auth_data array has the following structure:
    //
    //  $auth_data = array ( 'username'  = '<username>',     // String(64)
    //                       'password'  = '<password>',     // String(32)
    //                       'user_ID'   = '<user_ID>',      // Integer
    //                       'user_type' = '<user_type>',    // Small integer
    //                       'is_Logon'  = TRUE | FALSE      // Boolean
    //                     )
    

    // Array to store the row data from the 'Auth' table
    //
    //  username  = This field holds the username
    //  password  = This field holds the user password's hash
    //  user_ID   = This field holds the user's unique 'user_ID'
    //  user_type = This field holds the user's user_type
    //  is_Logon  = This field indicates if the user has logged in or not

    private $Auth_data = array ( 'username'  => '',
                                 'password'  => '',
                                 'user_ID'   => -1,
                                 'user_type' => 0,
                                 'is_Logon'  => FALSE
                               );

    // Array that holds the whole result set of a query over the database 'Auth'
    // table.
    //
    // Its an array with a numeric indice and each element is an associative
    // array with the same structure than $Auth_data

    private $Auth_result_set = array ( 'num_items' => 0 );


    // This property holds the SQL statement to be executed by the RDBMS engine

    private $sql_string;


    // This property holds the result_set returned by the ADODB->Execute() method.

    private $Result_Set;


    // This property is used to store temporarly one table row of the 'Auth' table
    // during the processing of the query's result_set

    private $table_row = array ();


    // In the class constructor, we are going to execute the followinf SQL statement:
    //
    //  CREATE TABLE IF NOT EXISTS `Auth` (
    //  `username` varchar(64) NOT NULL,
    //  `password` varchar(64) default NULL,
    //  `user_ID` int(11) NOT NULL auto_increment,
    //  `user_type` smallint(6) default '0',
    //  `is_Logon` smallint(1) default '0',
    //  PRIMARY KEY  (`user_ID`)
    //  ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    //
    // This way, if the 'Auth' table does not exist, it will be automatically
    // created for latter use.
    
    public function __construct()
    {

        
//        $sys_DBs_obj = new app_databases_init ;
//        $result = $sys_DBs_obj->DB_open( 'app_DB', TRUE ) ;
//        var_dump( $result ) ;

//        var_dump( $GLOBALS[ 'sys_DBs_obj' ] ) ;
//        var_dump( $GLOBALS ) ;
        
//        $ret_val = app_DB_open( 0 ) ;
//        $result = $GLOBALS[ 'sys_DBs_obj' ]->DB_open( 'app_DB', FALSE ) ;
//
//        if ( $result[ 'status' ] == 0 )
//        {
//            // Select the ADODB FETCH ASSOC mode
//            $GLOBALS[ 'sys_DBs_obj' ]->getDBs_conn_obj()->SetFetchMode( 'ADODB_FETCH_ASSOC' ) ;
//      
//            // Insert the CREATE TABLE string into the 'sql_string' 
//            $this->sql_string = "CREATE TABLE IF NOT EXISTS `Auth` (" .
//                                "  `username` varchar(64) NOT NULL," .
//                                "  `password` varchar(64) default NULL," .
//                                "  `user_ID` int(11) NOT NULL auto_increment," .
//                                "  `user_type` smallint(6) default '0'," .
//                                "  `is_Logon` int(1) default '0'," .
//                                "  PRIMARY KEY  (`user_ID`)" .
//                                ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;" 
//                              ;
//
//            $this->Result_Set = $GLOBALS[ 'sys_DBs_obj' ]->Execute( $this->sql_string ) ;
//
//            var_dump( $this->sql_string ) ;
//        
//            var_dump( $this->Result_Set ) ;
      
//            app_DB_close() ;
//        }
//        else
//        {
//            
//            
//        }
        /*
        if ( $this->Result_Set )
        {
            // Se o SELECT é valido, retorna o campo 'num_items'
            // como numero de rows retornadas pelo SELECT e um array
            // para cada row do resultado
            while( $this->table_row  = $this->Result_Set->FetchRow() )
            {
                array_push( $this->Auth_result_set, $this->table_row );
                $this->Auth_result_set['num_items'] += 1;
            }
        }
        else
        {
            // Se o SELECT deu erro, retorna -1 no campo 'num_items'
            // do array de resultado
            $this->Auth_result_set['num_items'] = -1;
        }
        return $this->Auth_result_set;
*/
    }
 
    
    
    
    // Interface para queries sobre a tabela auth da base de dados
    // app_DB usando 'username' como chave
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> O campo 'username' com o nome do utilizador

    public function query_by_username( $DB_conn_obj, $username )
    {
        // Seleccionar o modo de retorno por array associativo
        $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);
        $this->sql_string = "SELECT * FROM " .
                            "Auth " .
                            "WHERE " .
                            "username='" . $username . "' "
                          ;

        $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

        if ( $this->Result_Set )
        {
            // Se o SELECT é valido, retorna o campo 'num_items'
            // como numero de rows retornadas pelo SELECT e um array
            // para cada row do resultado
            while( $this->table_row  = $this->Result_Set->FetchRow() )
            {
                array_push( $this->Auth_result_set, $this->table_row );
                $this->Auth_result_set['num_items'] += 1;
            }
        }
        else
        {
            // Se o SELECT deu erro, retorna -1 no campo 'num_items'
            // do array de resultado
            $this->Auth_result_set['num_items'] = -1;
        }
        return $this->Auth_result_set;
    }


    // Interface para queries sobre a tabela auth da base de dados
    // app_DB usando 'user_ID' como chave
    //
    // Este método recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> O campo 'username' com o nome do utilizador
    // --> O caampo 'user_ID' com o UID

    public function query_by_user_ID( $DB_conn_obj, $user_ID )
    {
        // Seleccionar o modo de retorno por array associativo
        $DB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

        $this->sql_string = "SELECT * FROM " .
                            "Auth " .
                            "WHERE " .
                            "user_ID=" . $user_ID . " "
                          ;

        $this->Result_Set = &$DB_conn_obj->Execute( $this->sql_string );

        if ( $this->Result_Set )
        {
            // Se o SELECT é valido, retorna o campo 'num_items'
            // como numero de rows retornadas pelo SELECT e um array
            // para cada row do resultado
            while( $this->table_row  = $this->Result_Set->FetchRow() )
            {
                array_push( $this->Auth_result_set, $this->table_row );
                $this->Auth_result_set['num_items'] += 1;
            }
        }
        else
        {
            // Se o SELECT deu erro, retorna -1 no campo 'num_items'
            // do array de resultado
            $this->Auth_result_set['num_items'] = -1;
        }
        return $this->Auth_result_set;
    }


    // Interface para inserção de dados na tabela auth da base de dados
    // app_DB
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Insersão feita com sucesso.
    //      -1 = Erro no acesso à base de dados

    public function insert( $DB_conn_obj, $Auth_data )
    {
        $this->sql_string = "INSERT INTO ".
                            " Auth (" .
                            " username," .
                            " password," .
                            " user_type," .
                            " is_Logon)" .
                            " VALUES  (" .
                            " '" . $Auth_data['username'] . "'," .
                            " '" . $Auth_data['password'] . "'," .
                            " '" . $Auth_data['user_type'] . "'," .
                            " '" . $Auth_data['is_Logon'] . "')"
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


    // Interface para update de dados na tabela auth da base de dados
    // app_DB usando 'username' como chave
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Update feito com sucesso.
    //      -1 = Erro no acesso à base de dados.


    public function update_by_username( $DB_conn_obj, $Auth_data )
    {
        $this->sql_string = "UPDATE ".
                            "Auth " .
                            "SET " .
                            " username='"  . $Auth_data['username']  . "'," .
                            " password='"  . $Auth_data['password']  . "'," .
                            " user_type='" . $Auth_data['user_type'] . "'," .
                            " is_Logon='"  . $Auth_data['is_Logon']  . "' " .
                            "WHERE " .
                            "username='"  . $Auth_data['username'] . "' "
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


    // Interface para update de dados na tabela auth da base de dados
    // app_DB usando 'user_name_ID' como chave
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Update feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function update_by_user_ID( $DB_conn_obj, $Auth_data )
    {
        $this->sql_string = "UPDATE ".
                            "Auth " .
                            "SET " .
                            " username='"  . $Auth_data['username']  . "'," .
                            " password='"  . $Auth_data['password']  . "'," .
                            " user_type='" . $Auth_data['user_type'] . "'," .
                            " is_Logon='"  . $Auth_data['is_Logon']  . "' " .
                            "WHERE " .
                            "user_ID='"   . $Auth_data['user_ID'] . "' "
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


    // Interface para apagar rows da tabela Auth da base de dados
    // app_DB usando 'username' como chave
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método apaga a linha na base de dados cujo 'usdername' corresponde
    // ao username que é passado.
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Delete feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function delete_by_username( $DB_conn_obj, $Auth_data )
    {
        $this->sql_string = "DELETE FROM ".
                            "Auth " .
                            "WHERE " .
                            "username='" . $Auth_data['username'] . "' "
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


    // Interface para apagar rows da tabela Auth da base de dados
    // app_DB usando 'user_name_ID' como chave
    //
    // Este metodo recebe como parametros:
    //
    // --> O objecto que representa a ligação a base de dados.
    // --> Um array com os seguintes campos:
    //
    //      'username' -> Nome do utilizador
    //      'password' -> Campo com o hash da password
    //      'user_ID'  -> Campo com o user_ID
    //
    // Este método apaga a linha na base de dados cujo 'user_name_ID' corresponde
    // ao user_name_ID que é passado.
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      0  = Delete feito com sucesso.
    //      -1 = Erro no acesso à base de dados.

    public function delete_by_user_ID( $DB_conn_obj, $Auth_data )
    {
        $this->sql_string = "DELETE FROM ".
                            "Auth " .
                            "WHERE " .
                            "user_ID='" . $Auth_data['user_ID'] . "' "
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

