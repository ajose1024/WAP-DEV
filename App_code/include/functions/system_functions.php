<?php
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  System Functions:
 * 
 *  Functions:  mk_rnd_akey( $length )
 *              within( $val, $min, $max )
 *              object_to_array( $object )
 */



    // Function:  mk_rnd_akey( $length )
    //
    // This function returns a string that contains $length characters, randomly
    // generated, within the valid character-set for BASE64
    //
    // The maximum $length calue is defined as 64 (hardcoded, so far)

    function mk_rnd_akey( $length )
    {
        $work_str = "" ;

        $length = $length % 64 ;

        for( $i = 0 ; $i <= $length ; $i++ )
        {
            $work_str .= chr( mt_rand( 0, 255 ) ) ;
        }

        $work_str = base64_encode( $work_str ) ;

        return substr( $work_str, 0, $length ) ;
    }


    // Function:  within( $val, $min, $max )
    //
    // This function receives a value in $val, the minimum value that it can have
    // in $min and the maximum value that it can have in $max.
    //
    // Returns a value that obeys to the following conditions:
    //	If  $val < $min  			-->  $val = $min 
    //	If  $val >= $min AND $val <= $max  	-->  $val = $val
    //	If  $val > $max  			-->  $val = $max

    function within( $val, $min, $max )
    {
        if( $val < $min )
        {
            return  $min ;
        }
        elseif( $val > $max )
        {
            return  $max ;
        }
        else
        {
            return  $val ;
        }
    }

    
    // Function:  object_to_array( $object )
    //
    // This function receives a standard object with other nested objects and
    // converts it all to an array structure with all objects converted to the
    // correspondent arrays. 
    
    function object_to_array( $object )
    {
        if( is_object( $object ) )
        {
            $object = (array) $object ;
        }

        if( is_array( $object ) )
        {
            $new_object = array() ;
            
            foreach( $object as $object_key => $object_val )
            {
                $new_object[ $object_key ] = object_to_array( $object_val ) ;
            }
        }
        else
        {
            $new_object = $object ;
        }

        return  $new_object ;       
    }

    
    // Function:  delTree( $directory )
    //
    // This function receives an absolute path to a directory and recursivelly
    // deletes all files and directories in it.
    //
    // NOTE: ensure $directory ends with a slash 
    
    function delTree( $directory )
    { 
        $files = glob( $directory . '*', GLOB_MARK ) ; 
        foreach( $files as $file )
        { 
            if( substr( $file, -1 ) == '/' )
            {
                delTree( $file ) ;
            }
            else
            {
                unlink( $file ) ; 
            }
        }
        rmdir( $directory ) ; 
    }
    