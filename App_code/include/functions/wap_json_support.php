<?php
/*  Epsilon Software -- (c) 2013
 *  ----------------------------
 * 
 *  WAP JSON Functions:
 * 
 *  Functions:  json_decode ( string $json [, bool $assoc = false ] )
 *              json_encode ( mixed $content )
 *              read_json_file ( $file_url )
 *              write_json_file ( $file_url , $file_data )
 */


    // Function:  json_decode( $json, $assoc )
    //
    // This function tests if the 'json_decode' function (present since version
    // 5.2 of PHP) exists and, if it does not, defines it through the use of
    // the Services_JSON class.
    //
    // This function receives as parameters the $json string, with the JSON data
    // to be decoded and an optional $assoc flag.
    //
    // It returns a string with the decoded content.

    if ( ! function_exists( 'json_decode' ) )
    {
        function json_decode( $content, $assoc=false )
        {

            if( WAP_JSON_SUPPORT == FALSE )
            {
                require_once '/App_code/include/classes/PEAR/JSON/JSON.php' ;
            }
            
            if ( $assoc )
            {
                $json = new Services_JSON( SERVICES_JSON_LOOSE_TYPE ) ;
            }
            else
            {
                $json = new Services_JSON ;
            }

            return $json->decode( $content ) ;
        }
    }


    // Function:  json_encode( $content )
    //
    // This function tests if the 'json_encode' function (present since version
    // 5.2 of PHP) exists and, if it does not, defines it through the use of
    // the Services_JSON class.
    //
    // This function receives as parameters the $content string, with the PHP
    // data to be JSON encoded.
    //
    // It returns a string with the JSON encoded content.

    if ( ! function_exists( 'json_encode' ) )
    {
        function json_encode( $content )
        {
            if( WAP_JSON_SUPPORT == FALSE )
            {
                require_once '/App_code/include/classes/PEAR/JSON/JSON.php' ;
            }
            
            $json = new Services_JSON ;

            return $json->encode( $content ) ;
        }
    }


    // Function:  read_JSON_file ( $file_url )
    //
    // This function reads the JSON file passed, returning either the file
    // contents or an error code.
    //
    // It receives as parameters the $file_url string, with the file URI (either
    // relative or absolute) and returns a string accordind the following:
    // 
    // $result = 'string_data'  --> The file exists and the contents could be
    //                              read.
    //         = FALSE          --> The file could not be found
    //         = NULL           --> The 'allow_url_fopen' setting is disabled
    //                              in PHP.INI file
    //

    function read_JSON_file ( $file_url )
    {
        return json_decode( file_get_contents( $file_url ) ) ;
    }


    // Function:  write_JSON_file ( $file_url , $file_data )
    //
    // This function writes the JSON data correspondent to the passed data
    // in the $file_data string to the file whose name is in the $file_url
    // string.
    //
    // It receives as parameters the $file_url string, with the file URI (either
    // relative or absolute) and the $file_data with the file contents.
    // 

    function write_JSON_file ( $file_url, $file_data )
    {
        $file_handle = fopen( $file_url, FOPEN_READ_WRITE_CREATE_DESTRUCTIVE )
                OR die( "Error creating file to write to" ) ;
        fwrite( $file_handle, json_encode( $file_data ) ) ;
        fclose( $file_handle ) ;
    }

    