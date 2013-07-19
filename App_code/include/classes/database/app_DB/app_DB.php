<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  Class:  app_DB
 * 
 *  Methods:    set_DB( $driver, $host, $user, $password, $database )
 *              get_DB_obj( )
 *              get_instance( )
 *              open( $conn_type )
 *              close( )
 */

interface Interface_app_DB
{

    // Interface para defenir os parametros de acesso à base de dados
    // 'app_DB' a ser utilizada dentro desta classe
    //
    // Esta classe é implementada como um Singleton a fim de tratar da
    // concorrencia de acessos à base de dados reutilizando a mesma ligação
    //
    // Este metodo da classe recebe os parâmetros para a ligação a base de
    // dados e guarda os respectivos valores no array associativo 
    // $app_priv_DB[]
    //
    // Este método retorna self::$DB_available

    public function set_DB( $driver, $host, $user, $password, $database ) ;


    // Interface para retornar o objecto que representa a ligação à base
    // de dados, se esta estiver aberta.
    //
    // Este método retorna um array associativo com 2 elementos:
    //
    //      'status' =  0:  'DB_obj' tem o objecto de ligação a base de dados
    //                 -1:  'DB_obj' tem um código de erro.
    //      'DB_obj' = Objecto de conexão a base de dados se a ligação
    //                  à mesma estiver aberta
    //                 -1 se a ligação a base de dados estiver fechada

    public function get_DB_obj( ) ;


    // Método para retornar a instância do objecto.
    //
    // Como Singleton, retorna sempre a mesma instância, não novas instâncias
    // para cada objecto criado

    public function getInstance( ) ;
            

    // Interface para abrir a ligação a base de dados 'app_DB'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      FALSE   = Ligação à base de dados sem sucesso
    //      TRUE    = Ligação à base de dados com sucesso

    public function open( $conn_type ) ;


    // Interface para fechar a ligação a base de dados 'app_DB'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      TRUE    = Fecho da conexão a base de dados feita com sucesso.

    public function close( ) ;


}


class app_DB implements Interface_app_DB
{
    // Esta classe é implementada como um Singleton a fim de tratar da
    // concorrencia de acessos à base de dados reutilizando a mesma ligação

    private static $instance = null;


    // Esta propriedade privada indica se os dados de acesso à base de dados
    // foram correctamente inicializados ou não

    private static $DB_available = FALSE ;


    // Variavel que mantem o objecto que representa a ligação a base
    // de dados dentro da classe

    private static $app_DB_obj;


    // Array que guarda os dados necessarios para fazer a ligação a
    // base de dados, dentro da classe.
    // Os dados são: ( driver, host, user, password, database )

    private static $app_priv_DB = array (  "driver"   => "" ,
                                           "host"     => "" ,
                                           "user"     => "" ,
                                           "password" => "" ,
                                           "database" => ""
                                        ) ;


    // Esta flag indica se a base de dados foi aberta ou não

    private static $DB_opened = FALSE ;


    // Este é o construtor da classe (privado, uma vez que esta classe é um
    // Singleton, para que só haja uma única ligação à base de dados)

    private function __construct( )
    {
        // É colocado aqui o código do contrutor da classe, seja ele qual fôr
        //
        // Neste caso, vamos buscar os dados de acesso à base de dados que
        // nos interessa e colocar esses dados na nossa propriedade privada
        // $app_priv_DB

        $app_DB_data = $GLOBALS[ 'sys_DBs_obj' ]->get_DB_params( 'app_DB' );

        if( $app_DB_data[ 'status' ] == 0 )
        {
            self::$app_priv_DB = array (  'driver'   => $app_DB_data[ 'driver' ]   ,
                                          'host'     => $app_DB_data[ 'host' ]     ,
                                          'user'     => $app_DB_data[ 'user' ]     ,
                                          'password' => $app_DB_data[ 'password' ] ,
                                          'database' => $app_DB_data[ 'database' ]
                                 );

            self::$DB_available = TRUE ;
        }
        else
        {
            self::$app_priv_DB = array (  'driver'   => "" ,
                                          'host'     => "" ,
                                          'user'     => "" ,
                                          'password' => "" ,
                                          'database' => ""
                                 );

            self::$DB_available = FALSE ;
        }

    }


    // Método para retornar a instância do objecto.
    //
    // Como Singleton, retorna sempre a mesma instância, não novas instâncias
    // para cada objecto criado

    public function getInstance( )
    {
        if( ! isset( self::$instance ) )
        {
            $class = __CLASS__ ;
            self::$instance = new $class ;
        }

        return self::$instance ;
    }


    // Método:  set_DB( $driver, $host, $user, $password, $database )
    // 
    // Este metodo da classe recebe os parâmetros para a ligação a
    // base de dados e guarda os respectivos valores no array
    // associativo $app_priv_DB[]
    //
    // Retorna self::$DB_available

    public function set_DB( $driver, $host, $user, $password, $database )
    {
        self::$app_priv_DB['driver']   = $driver ;
        self::$app_priv_DB['host']     = $host ;
        self::$app_priv_DB['user']     = $user ;
        self::$app_priv_DB['password'] = $password ;
        self::$app_priv_DB['database'] = $database ;

        self::$DB_available = TRUE ;
        
        return  self::$DB_available ;
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

    public function get_DB_obj( )
    {
        if ( self::$DB_opened == TRUE )
        {
            // Foi invocado o método open( $con_type ) desta classe
            // A ligação a base de dados foi aberta, e o objecto $app_DB_obj
            // é válido
            return array (  'status' => 0 ,
                            'DB_obj' => self::$app_DB_obj
                         ) ;
        }
        else
        {
            // Foi invocado o método close() desta classe
            // A ligação a base de dados foi fechada, o objecto $app_DB_obj
            // não é valido
            return array (  'status' => -1 ,
                            'DB_obj' => -1
                         ) ;
        }
    }


    // Este metodo da classe recebe um parametro indicando se a
    // conexão à base de dados é pressistente ou não.
    //
    //      $conn_type :
    //          0  =    Ligação não pressistente à base de dados
    //          1  =    Ligação pressistente à base de dados
    //
    //      Retorna:
    //          FALSE   = Ligação à base de dados sem sucesso
    //          TRUE    = Ligação à base de dados com sucesso

    public function open( $conn_type )
    {
        // Se a ligação à base de dados não tiver sido ainda aberta, e os
        // dados da ligação tiveren sido definidos, abre-a e define 'DB_opened'
        // como TRUE
        if ( self::$DB_opened == FALSE && self::$DB_available == TRUE )
        {
            self::$app_DB_obj = &ADONewConnection( self::$app_priv_DB[ 'driver' ] ) ;

            $error = null ;

            switch ( $conn_type )
            {
                case 0:
                    $error = self::$app_DB_obj->Connect(
                                            self::$app_priv_DB[ 'host' ]      ,
                                            self::$app_priv_DB[ 'user' ]      ,
                                            self::$app_priv_DB[ 'password' ]  ,
                                            self::$app_priv_DB[ 'database' ]
                                                       ) ;
                    break;

                case 1:
                    $error = self::$app_DB_obj->PConnect(
                                            self::$app_priv_DB[ 'host' ]      ,
                                            self::$app_priv_DB[ 'user' ]      ,
                                            self::$app_priv_DB[ 'password' ]  ,
                                            self::$app_priv_DB[ 'database' ]
                                                        ) ;
                    break;

                default:
                    $error = self::$app_DB_obj->Connect(
                                            self::$app_priv_DB[ 'host' ]      ,
                                            self::$app_priv_DB[ 'user' ]      ,
                                            self::$app_priv_DB[ 'password' ]  ,
                                            self::$app_priv_DB[ 'database' ]
                                                       ) ;
            }

            if ( $error == FALSE )
            {
                // Se a ligação à base de dados falhou:
                //  Retorna: FALSE
                //  $DB_opened = FALSE
                //  self::$app_DB_obj = NULL

                self::$DB_opened = FALSE ;
                self::$app_DB_obj = NULL ;

                return FALSE ;
            }
            else
            {
                // Se a ligação à base de dados teve sucesso:
                //  Retorna: TRUE
                //  $DB_opened = TRUE
                //  self::$app_DB_obj = <Objecto de acesso à base de dados>

                self::$DB_opened = TRUE ;

                return TRUE ;
            }
        }

    }


    // Interface para fechar a ligação a base de dados 'app_DB'
    //
    // Este método retorna um código de erro indicando o resultado da
    // operação:
    //      TRUE    = Fecho da conexão a base de dados feita com sucesso.

    public function close( )
    {
        self::$app_DB_obj->Close( ) ;

        self::$DB_opened = FALSE ;

        return TRUE ;
    }

}
