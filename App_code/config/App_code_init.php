<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;

//      Any included file, should be define with the following:
//      include(    $GLOBALS[ 'DOC_ROOT' ] .
//                  "/path/to/file.php"
//             ) ;


    // Include the ADOdb main file if WAP_USE_ADODB is defined
    if( WAP_USE_ADODB )
    {
        include (   $GLOBALS[ 'DOC_ROOT' ] . 
                    '/App_code/db/adodb/adodb.inc.php'
                );
    }
    
    // Include the ADOdb session file with DB stored session data
    if( WAP_USE_ADODB_SESSIONS )
    {
        if( ! WAP_ENCRYPTED_SESSIONS )
        {
            include (   $GLOBALS[ 'DOC_ROOT' ] .
                        '/App_code/db/adodb/session/adodb-session2.php'
                    ) ;
        }
        else
        {
            include (   $GLOBALS[ 'DOC_ROOT' ] .
                        '/App_code/db/adodb/session/adodb-cryptsession2.php'
                    ) ;
        }
        include (   $GLOBALS[ 'DOC_ROOT' ] .
                    '/App_code/config/sessions/init_adodb_sessions.php'
                ) ;
    }


// Include Static Session's handling
if ( WAP_STATIC_SESSIONS )
{
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/include/classes/sessions/static_sessions.php'
            ) ;
}

// Include simple template handling
if ( WAP_SIMPLE_TEMPLATES )
{
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/templates/Template.class.php'
            ) ;
}

// Include SMARTY Templates
if ( WAP_SMARTY_TEMPLATES )
{
    include (   $GLOBALS[ 'DOC_ROOT' ] . 
                '/App_code/templates/Smarty/libs/Smarty.class.php'
            ) ;

    include (	$GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/config/Smarty/Smarty.conf.php'
            ) ;
    
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/include/classes/template_views/Element_View.php'
            ) ;
    
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/include/classes/template_views/Page_Layout_View.php'
            ) ;
}


// Include WAP JSON Support
if ( WAP_JSON_SUPPORT )
{
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/include/classes/PEAR/JSON/JSON.php'
            ) ;
}

include (   $GLOBALS[ 'DOC_ROOT' ] .
            '/App_code/include/functions/wap_json_support.php'
        ) ;

// Include WAP System Functions
if ( WAP_SYSTEM_FUNCTIONS )
{
    include (	$GLOBALS[ 'DOC_ROOT' ] . 
                '/App_code/include/functions/system_functions.php'
            ) ;
}


// Include WAP_GET_HTTP_DATA
if ( WAP_GET_HTTP_DATA )
{
    include (	$GLOBALS[ 'DOC_ROOT' ] . 
                '/App_code/include/functions/get_http_data.php'
            ) ;
}


// Include WAP_REGISTRY
if ( WAP_REGISTRY )
{
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/include/classes/registry/registry.php'
            ) ;
}

    // Incluir os ficheiros de definição de classes
    //


// Include WAP_DATABASES
if ( WAP_DATABASES )
{
    // Initialize the WAP Database system
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/include/classes/database/app_databases_init.php'
            ) ;

    // Initialize the database access data
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/config/app_DBs_init.php'
            ) ;
    
    // Include database related functions
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/include/functions/database_functions.php'
            ) ;

    // Include the app_DB database access Interface and Class
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/include/classes/database/app_DB/app_DB.php'
            ) ;
    
    include (   $GLOBALS[ 'DOC_ROOT' ] .
                '/App_code/include/classes/database/app_DB/Auth/app_DB__Auth.php'
            ) ;
}

    
//    $new_obj = new app_DB_Auth ;

//    var_dump( $new_obj ) ;

//    include(	$GLOBALS['DOC_ROOT'] . 
//		"/App_code/include/classes/database/Relogios.php"
//	   );
//    include(	$GLOBALS['DOC_ROOT'] . 
//		"/App_code/include/classes/database/Equipamento.php"
//	   );
//    include(	$GLOBALS['DOC_ROOT'] . 
//		"/App_code/include/classes/database/Empresas.php"
//	   );


//     // Incluir os ficheiros com dados de configuração.
//     //
//     // Incluir o ficheiro com os dados para o registo das bases de dados app_DB
//     include(	$GLOBALS['DOC_ROOT'] . 
//		"/App_code/config/app_DBs_init.php"
//	   );


//    // Classe de difinição da autenticação de utilizadores
//    include(    $GLOBALS['DOC_ROOT'] .
//                "App_code/include/classes/user_auth/user_auth.php"
//	   );

//    // Classe de definição da autenticação de utilizadores
//    include(	$GLOBALS['DOC_ROOT'] .
//		"/App_code/include/classes/DAOs/auth_DAO.php"
//	   );




//    // Classe de definição do menu
//    include(	$GLOBALS['DOC_ROOT'] . 
//		"/App_code/include/classes/menu/menu.php"
//	   );
//    include(	$GLOBALS['DOC_ROOT'] . 
//		"/App_code/include/classes/menu/menu_item_HTML.php"
//	   );


