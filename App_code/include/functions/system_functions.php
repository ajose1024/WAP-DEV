<?php
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  System Functions:
 * 
 *  Functions:  mk_rnd_akey( $length )
 *              within( $val, $min, $max )
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
