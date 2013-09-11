<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// Handler:  /<controller>/resources/scripts/<res_ctx_id>/app-start
//
// This file returns a JS script with the initial values for several application
// data, including initial data_context IDs

switch( $parameters[ 'res_name' ] )
{
    case 'app-start':
        header( "Content-type: text/plain" ) ;
        
        $init_context_data_file = $GLOBALS[ 'DOC_ROOT' ] .
                                  '/App_data/resources/scripts/data_context/' .
                                  $parameters[ 'context' ] .
                                  '/app-start_data.js' ;
        
        if( file_exists( $init_context_data_file ) )
        {
//            $init_context_data = object_to_array( read_JSON_file( $init_context_data_file ) ) ;
            $init_context_data = file_get_contents( $init_context_data_file ) ;
        }
        else
        {
            $init_context_data = null ;
        }

        print( $init_context_data ) ;
        
        if(file_exists( dirname( $init_context_data_file ) ) )
        {
            delTree( dirname( $init_context_data_file ) . '/' ) ;
        }
        
        
        break ;
    
    default:
        
        break ;
}