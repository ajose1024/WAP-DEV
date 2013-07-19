<?php
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  Class:  app_DB_Auth_QUID
 * 
 *  Methods:    __construct( $DB_conn_obj )
 *              select( $DB_conn_obj, $SQL_data )
 *              insert( $DB_conn_obj, $SQL_data )
 *              update( $DB_conn_obj, $SQL_data )
 *              delete( $DB_conn_obj, $SQL_data )
 */

interface Interface_app_DB_Auth_QUID
{
    // Method:  select( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT statement to perform a SELECT over the 'Auth' table
    //
    // The SQL statement MUST start with 'SELECT' or, otherwise, an error is
    // returned

    public function select( $DB_conn_obj, $SQL_data ) ;


    // Method:  insert( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL INSERT statement to perform a INSERT over the 'Auth' table
    //
    // The SQL statement MUST start with 'INSERT' or, otherwise, an error is
    // returned

    public function insert( $DB_conn_obj, $SQL_data ) ;


    // Method:  update( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL INSERT statement to perform a UPDATE over the 'Auth' table
    //
    // The SQL statement MUST start with 'UPDATE' or, otherwise, an error is
    // returned

    public function update( $DB_conn_obj, $SQL_data ) ;


    // Method:  delete( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL INSERT statement to perform a DELETE over the 'Auth' table
    //
    // The SQL statement MUST start with 'DELETE' or, otherwise, an error is
    // returned

    public function delete( $DB_conn_obj, $SQL_data ) ;
    
}

class app_DB_Auth_QUID implements Interface_app_DB_Auth_QUID
{
    public function __construct( )
    {
        
    }


    // Method:  select( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT statement to perform a SELECT over the 'Auth' table
    //
    // The SQL statement MUST start with 'SELECT' or, otherwise, an error is
    // returned
    //
    //  SELECT * FROM sessions2 ....
    
    public function select( $DB_conn_obj, $SQL_data )
    {
        
    }


    // Method:  insert( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL INSERT statement to perform a INSERT over the 'Auth' table
    //
    // The SQL statement MUST start with 'INSERT' or, otherwise, an error is
    // returned

    public function insert( $DB_conn_obj, $SQL_data )
    {
        
    }


    // Method:  update( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL INSERT statement to perform a UPDATE over the 'Auth' table
    //
    // The SQL statement MUST start with 'UPDATE' or, otherwise, an error is
    // returned

    public function update( $DB_conn_obj, $SQL_data )
    {
        
    }


    // Method:  delete( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL INSERT statement to perform a DELETE over the 'Auth' table
    //
    // The SQL statement MUST start with 'DELETE' or, otherwise, an error is
    // returned

    public function delete( $DB_conn_obj, $SQL_data )
    {
        
    }

}