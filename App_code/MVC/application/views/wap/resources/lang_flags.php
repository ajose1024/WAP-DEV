<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// Handler:  /<controller>/resources/lang_flags/<res_ctx_id>/<lang_id>
//
// This file returns an image, with correct content_type, according to the
// parameter  <lang_id>
//
//  <lang_id> :
//      pt-pt:              Returns the PT flag with a default dimension
//                          
//      en-us:              Returns the US flag with a default dimension
//      
//      pt-br:              Returns the BR flag with a default dimension
//  
// The mapping information between the resource name and the file that will be
// used is given on a JSON file, stored at:
//
//      /App_data/resources/images/lang_flags/language_flags.json
//
// The data file has the following format:
//
//  language_flags.json ->  {
//                              "current": "1",
//                              "nr_langs": "3",
//                              "language_flags":
//                              {
//                                  "pt-pt":
//                                  {
//                                      "nr_res": "1",  
//                                      "default":
//                                      {
//                                          "file": "/@pics/lang_flags/pt.png",
//                                          "type": "image/png"
//                                      }
//                                  },
//                                  "en-us":
//                                  {
//                                      "nr_res": "1",  
//                                      "default":
//                                      {
//                                          "file": "/@pics/lang_flags/us.png",
//                                          "type": "image/png"
//                                      }
//                                  },
//                                  "pt-br":
//                                  {
//                                      "nr_res": "1",                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              
//                                      "default":
//                                      {
//                                          "file": "/@pics/lang_flags/br.png",
//                                          "type": "image/png"
//                                      }
//                                  }
//´                             },
//                              "usage_count": 1
//                          }

$lang_flags_data_file = 'App_data/resources/images/lang_flags/language_flags.json' ;
        
$lang_flags_data = object_to_array( read_JSON_file( $lang_flags_data_file ) ) ;
        

if( array_key_exists( $parameters[ 'res_name' ] ,
                      $lang_flags_data[ 'language_flags' ] 
                   )
  )
{
    // If the selected 'res_name' exists:
    //  Get the file name and the file type
    $lang_flags_file_data = $lang_flags_data[ 'language_flags' ][ $parameters[ 'res_name' ] ] ;
    
    if( array_key_exists( 'default' , $lang_flags_file_data ) )
    {
        // The 'default' flag resolution exists.
        // Use it.
        //
        // Get the file path/name is it exists
        if( array_key_exists( 'file' , $lang_flags_file_data[ 'default' ] ) )
        {
            // File key exists; get the file path/name
            $data_img_file = $lang_flags_file_data[ 'default' ][ 'file' ] ;
        }
        else
        {
            // File key does not exit; mark the file name as null
            $data_img_file = null ;
        }
        
        // Get the file type if it exists
        if( array_key_exists( 'type' , $lang_flags_file_data[ 'default' ] ) )
        {
            // File type key exists; get the file type
            $data_img_type = $lang_flags_file_data[ 'default' ][ 'type'] ;
        }
        else
        {
            // File type key exists; mark the file type as null
            $data_img_type = null ;
        }
    }

    if( ! is_null( $data_img_file ) && ! is_null( $data_img_type ) )
    {
        // Both the file name and file type exist.
        // So, send the appropriated Content-type and output the file
        header( 'Content-type: ' . $data_img_type ) ;
//          echo "<h1>Print image file $data_img_file</h1>" ;
        $f_handle = fopen( $GLOBALS[ 'DOC_ROOT' ] . $data_img_file , 'rb' ) ;
        $f_char_num = fpassthru( $f_handle ) ;
        fclose( $f_handle ) ;
        
    }
    

    // Increment usage count
    if( key_exists( 'usage_count' , $lang_flags_data ) )
    {
        $lang_flags_data[ 'usage_count' ] = $lang_flags_data[ 'usage_count' ] + 1 ;
    }
    else
    {
        $lang_flags_data[ 'usage_count' ] = 1 ;
    }

    // Write data back to JSON file
    write_JSON_file( $lang_flags_data_file , $lang_flags_data ) ;
        
}

 