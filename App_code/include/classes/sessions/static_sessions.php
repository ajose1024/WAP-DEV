<?php
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  Class:  Session_Handeling
 * 
 *  Methods:    start_session( )
 *              get_session_id( )
 *              set_session_data( $name, $value )
 *              get_session_data( $name )
 *              is_variable_set( $name )
 *              unset_session_data( $name )
 *              destroy_session( $name )
 */

interface Interface_session_handeling
{
    // Method:  __construct( )
    //
    // This is the class cosntructor method

    public function __construct( ) ;


    // Method:  start_session( )
    //
    // This methis initializes the session

    public function start_session( ) ;
    
    
    // Method:  get_session_id( )
    //
    // This method returns the Session_ID (WAP_SID)
    
    public function get_session_id( ) ;


    // Method:  set_session_data( $name, $value )
    //
    // This method creates a session variable with the name and value passed

    public function set_session_data( $name, $value ) ;


    // Method:  get_session_data( $ name )
    //
    // This method returns the value of a session variable whose name is given

    public function get_session_data( $name ) ;


    // Method:  is_variable_set( )
    //
    // This method verifies if a session variable whose name is givenm exist or not

    public function is_variable_set ( $name ) ;


    // Method:  unset_session_data( ) ;
    //
    // This method unsets a session variable whose name is given

    public function unset_session_data( $name ) ;


    // Method:  destroy_session( )
    //
    // This method destroys the session and all session variables

    public function destroy_session( ) ;

}


class session_handling implements Interface_session_handeling
{
    // Method:  __construct( )
    //
    // This is the class cosntructor method

    public function __construct()
    {
        self::start_session();
    }


    // Method:  start_session( )
    //
    // This methis initializes the session

    public function start_session( )
    {
        if ( ! isset( $_SESSION ['ready'] ) )
        {
            session_name( "WAP_SID" ) ;
            adodb_session_regenerate_id( ) ;
            session_start( ) ;
            
            $_SESSION ['ready'] = TRUE ;
        }
        else
        {
            session_name( "WAP_SID" ) ;
            adodb_session_regenerate_id( ) ;
            session_start( ) ;
        }
    }


    // Method:  get_session_id( )
    //
    // This method returns the Session_ID (WAP_SID)
    
    public function get_session_id( )
    {
        return session_id( ) ;
    }


    // Method:  set_session_data( $name, $value )
    //
    // This method creates a session variable with the name and value passed

    public function set_session_data( $name , $value )
    {
        self::start_session( ) ;
        $_SESSION[ $name ] = $value ;
    }


    // Method:  get_session_data( $ name )
    //
    // This method returns the value of a session variable whose name is given

    public function get_session_data( $name )
    {
        self::start_session( ) ;
        return  $_SESSION[ $name ] ;
    }


    // Method:  get_session_data( $ name )
    //
    // This method returns the value of a session variable whose name is given

    public function is_variable_set ( $name )
    {
        self::start_session( ) ;
        return  isset( $_SESSION[ $name ] ) ;
    }


    // Method:  unset_session_data( ) ;
    //
    // This method unsets a session variable whose name is given

    public function unset_session_data( $name ) 
    {
        self::start_session( ) ;
        unset( $_SESSION[ $name ] ) ;
    }


    // Method:  destroy_session( )
    //
    // This method destroys the session and all session variables

    public function destroy_session( )
    {
        self::start_session( ) ;
        unset( $_SESSION ) ;
        session_destroy( ) ;
    }
}
