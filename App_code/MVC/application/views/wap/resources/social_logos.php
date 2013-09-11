<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


// Handler:  /<controller>/resources/social_logos/<res_ctx_id>/<logo_name>
//
// This file returns an image, with correct content_type, according to the
// parameter  <logo_name>
//
//  <social_logos> :
//      linkedin:           Returns the LinkedIN logo with a default dimension
//                          of 32x32 pixels
//                          
//      facebook:           Returns the Facebook logo with a default dimension
//                          of 32x32 pixels
//      
//      twitter:            Returns the Twitter logo with a default dimension
//                          of 32x32 pixels
//      
//      google_+_plus:      Returns the Google Plus logo with a default dimension
//                          of 32x32 pixels
//      
//      youtube:            Returns the YouTube logo with a default dimension
//                          of 32x32 pixels
//      
//      skype:              Returns the Skype logo with a default dimension of
//                          32x32 pixels
//  
// The mapping information between the resource name and the file that will be
// used is given on a JSON file, stored at:
//
//      /App_data/resources/images/flags/social_logos.json

$social_logos_data_file = 'App_data/resources/images/logos/social_logos.json' ;
        
$social_logos_data = object_to_array( read_JSON_file( $social_logos_data_file ) ) ;
        

if( array_key_exists( $parameters[ 'res_name' ] ,
                      $social_logos_data[ 'social_logos' ] 
                   )
  )
{
    // If the selected 'res_name' exists:
    //  Get the file name and the file type
    $social_logo_file_data = $social_logos_data[ 'social_logos' ][ $parameters[ 'res_name' ] ] ;
    
    if( array_key_exists( 'default' , $social_logo_file_data ) )
    {
        // The 'default' logo resolution exists.
        // Use it.
        //
        // Get the file path/name is it exists
        if( array_key_exists( 'file' , $social_logo_file_data[ 'default' ] ) )
        {
            // File key exists; get the file path/name
            $data_img_file = $social_logo_file_data[ 'default' ][ 'file' ] ;
        }
        else
        {
            // File key does not exit; mark the file name as null
            $data_img_file = null ;
        }
        
        // Get the file type if it exists
        if( array_key_exists( 'type' , $social_logo_file_data[ 'default' ] ) )
        {
            // File type key exists; get the file type
            $data_img_type = $social_logo_file_data[ 'default' ][ 'type'] ;
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
    if( key_exists( 'usage_count' , $social_logos_data ) )
    {
        $social_logos_data[ 'usage_count' ] = $social_logos_data[ 'usage_count' ] + 1 ;
    }
    else
    {
        $social_logos_data[ 'usage_count' ] = 1 ;
    }

    // Write data back to JSON file
    write_JSON_file( $social_logos_data_file , $social_logos_data ) ;
        
}

 