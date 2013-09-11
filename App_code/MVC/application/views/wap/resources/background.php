<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// Handler:  /<controller>/resources/background/<res_ctx_id>/<background>
//
// This file returns an image, with correct content_type, according to the
// parameter  <background>
//
//  <background> :
//      page_background:    Returns an image for the whole site background.
//                          This background is not static but on of the files
//                          in the JSON data structure at:
//                              /App_data/resources/images/background/background_images.json
//                              {
//                                  "current": "k",
//                                  "nr_images": "n",
//                                  "background":
//                                  {
//                                      "0": 
//                                      {
//                                          "file": "\/dir-1\/dir-2\/....\/dir-m\/file-name-1.jpg",
//                                          "type": "image\/jpg"
//                                      },
//                                    ......
//                                      "n":
//                                      {
//                                          "file": "\/dir-n1\/dir-n2\/....\/dir-nm\/file-name-n.jpg",
//                                          "type": "image\/jpg"
//                                      }
//                                  },
//                                  "usage_count": "x"
//                              }

switch( $parameters[ 'res_name' ] )
{
    case 'page_background':
        header( "Content-type: image/jpg" ) ;
        
        $background_data_file = 'App_data/resources/images/background/background_images.json' ;
        
        $background_data = get_object_vars( read_JSON_file( $background_data_file ) ) ;
        
        $current_img = $background_data[ 'current' ] ;
        $nr_images   = $background_data[ 'nr_images' ] ;

        $backgrounds = get_object_vars( $background_data[ 'background' ] ) ;
        
        $curr_background = get_object_vars( $backgrounds[ $current_img ] ) ;
                
        $f_handle = fopen( $GLOBALS[ 'DOC_ROOT' ] . $curr_background[ 'file' ] , 'rb' ) ;
        $f_char_num = fpassthru( $f_handle ) ;
        fclose( $f_handle ) ;
        
        $background_data[ 'current' ] = ( $current_img + 1 ) % $nr_images ;
        
        // Increment usage count
        if( key_exists( 'usage_count' , $background_data ) )
        {
            $background_data[ 'usage_count' ] = $background_data[ 'usage_count' ] + 1 ;
        }
        else
        {
            $background_data[ 'usage_count' ] = 1 ;
        }

        write_JSON_file( $background_data_file , $background_data ) ;
        
        break ;
    
    default:
        
        break ;
}