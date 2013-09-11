<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// Handler:  /<controller>/resources/banners/<res_ctx_id>/<banner-id>
//
// This file returns an image, with correct content_type, according to the
// parameter  <banner-id>
//
//  <background> :
//      banners:    Returns a banner image.
//                  This banner image is choosen from a set of images, one at a
//                  time.
//                  The needed information is stored in the JSON data structure
//                  at:
//                      /App_data/resources/images/banners/banner_images.json
//                      {
//                          "current_res": "468x60",
//                          "nr_resolutions": "r",
//                          "resolutions":
//                          {
//                              "0": "468x60"
//                          },
//                          "468x60":
//                          {
//                              "default":
//                              {
//                                  "current": "k",
//                                  "nr_images": "n",
//                                  "0": 
//                                  {
//                                      "file": "\/dir-1\/dir-2\/....\/dir-m\/file-name-1.jpg",
//                                      "type": "image\/jpg"
//                                  },
//                                  ......
//                                  "n-1":
//                                  {
//                                      "file": "\/dir-n1\/dir-n2\/....\/dir-nm\/file-name-n.jpg",
//                                      "type": "image\/jpg"
//                                  }
//                              },
//                              "set-1":
//                              {
//                                  "current": "k",
//                                  "nr_images": "n",
//                                  "0": 
//                                  {
//                                      "file": "\/dir-1\/dir-2\/....\/dir-m\/file-name-1.jpg",
//                                      "type": "image\/jpg"
//                                  },
//                                  ......
//                                  "n-1":                                                                                                                                                                                                                                   
//                                  {
//                                      "file": "\/dir-n1\/dir-n2\/....\/dir-nm\/file-name-n.jpg",
//                                      "type": "image\/jpg"
//                                  }
//                              }
//                          },
//                          "usage_count": "x"
//                      }

$banners_data_file = 'App_data/resources/images/banners/banner_images.json' ;
        
$banners_data = object_to_array( read_JSON_file( $banners_data_file ) ) ;

$banner_extra_data = WAP::$data_interface->get_extra_data() ;

// Get the 6th element of URI (if it exists, at all) as it indicates the banner
// dimention (in string form; eg: 468x60)
//
// If the element does not exist in the URI, the $banner_size variable is NULL
// If the element exists but is empty, the $banner_size variable is ´´
$banner_size = array_shift( $banner_extra_data ) ;

$banner_real_size = array() ;

if( ! is_null( $banner_size ) )
{
    foreach( $banners_data[ 'resolutions' ] as $resolution )
    {
        
    }
    
}

if( ! empty( $banner_extra_data ) )
{
    $banner_size = array_shift( $banner_extra_data ) ;
}
else
{
    $banner_size = '' ;
}

var_dump( WAP::$data_interface->get_extra_data() ) ;

var_dump( $banner_size ) ;



/*
switch( $parameters[ 'res_name' ] )
{
    case 'default':
        
        
        header( "Content-type: image/jpg" ) ;
        
        
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
 */


