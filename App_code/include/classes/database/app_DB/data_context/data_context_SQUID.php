<?php
/*  Epsilon Software -- (c) 2012
 *  ----------------------------
 * 
 *  Class:  app_DB_Auth_SQUID
 * 
 *  Methods:    __construct( $DB_conn_obj )
 *              sql_exec( $DB_conn_obj, $SQL_data )
 *              select( $DB_conn_obj, $SQL_struct_data )
 *              insert( $DB_conn_obj, $SQL_struct_data )
 *              update( $DB_conn_obj, $SQL_struct_data )
 *              delete( $DB_conn_obj, $SQL_struct_data )
 */

interface Interface_app_DB_Auth_SQUID
{
    
    // Method:  sql_exec( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL statement to be executed on the 'Auth' table
    
    public function sql_exec( $DB_conn_obj, $SQL_struct_data ) ;


    // Method:  select( $DB_conn_obj, $SQL_struct_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT data to construct and perform a SELECT over the 'Auth'
    // table
    //
    // In the simplest form, the $SQL_struct_data, is a named array with 5
    // elements, on the following form:
    // 
    //  $SQL_struct_data = array( 'columns'  => <column string> ,
    //                            'where'    => <where clause string> ,
    //                            'group_by' => <group by clause string> ,
    //                            'having'   => <having clause string> ,
    //                            'order_by' => <order by clause string>

    public function select( $DB_conn_obj, $SQL_data ) ;


    // Method:  insert( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT data to construct and perform a INSERT over the 'Auth'
    // table
    //
    // In the simplest form, the $SQL_struct_data, is a named array with 
    // several elements with the information referent to the INSERT statement
    // 
    //  $SQL_struct_data = array( 
    //                          )

    public function insert( $DB_conn_obj, $SQL_data ) ;


    // Method:  update( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT data to construct and perform a UPDATE over the 'Auth'
    // table
    //
    // In the simplest form, the $SQL_struct_data, is a named array with 
    // several elements with the information referent to the UPDATE statement
    // 
    //  $SQL_struct_data = array( 
    //                          )

    public function update( $DB_conn_obj, $SQL_data ) ;


    // Method:  delete( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT data to construct and perform a DELETE over the 'Auth'
    // table
    //
    // In the simplest form, the $SQL_struct_data, is a named array with 
    // several elements with the information referent to the UPDATE statement
    // 
    //  $SQL_struct_data = array( 
    //                          )

    public function delete( $DB_conn_obj, $SQL_data ) ;
    
}

class app_DB_sessions2_QUID implements Interface_app_DB_sessions2_QUID
{
    public function __construct( )
    {
        
    }


    // Method:  sql_exec( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL statement to be executed on the 'Auth' table
    
    public function sql_exec( $DB_conn_obj, $SQL_struct_data )
    {
        
    }


    // Method:  select( $DB_conn_obj, $SQL_struct_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT data to construct and perform a SELECT over the 'Auth'
    // table
    //
    // In the simplest form, the $SQL_struct_data, is a named array with 5
    // elements, on the following form:
    // 
    //  $SQL_struct_data = array( 'columns'  => <column string> ,
    //                            'where'    => <where clause string> ,
    //                            'group_by' => <group by clause string> ,
    //                            'having'   => <having clause string> ,
    //                            'order_by' => <order by clause string>

    public function select( $DB_conn_obj, $SQL_struct_data )
    {
        
    }


    // Method:  insert( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT data to construct and perform a INSERT over the 'Auth'
    // table
    //
    // In the simplest form, the $SQL_struct_data, is a named array with 
    // several elements with the information referent to the INSERT statement
    // 
    //  $SQL_struct_data = array( 
    //                          )

    public function insert( $DB_conn_obj, $SQL_data )
    {
        
    }


    // Method:  update( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT data to construct and perform a UPDATE over the 'Auth'
    // table
    //
    // In the simplest form, the $SQL_struct_data, is a named array with 
    // several elements with the information referent to the UPDATE statement
    // 
    //  $SQL_struct_data = array( 
    //                          )

    public function update( $DB_conn_obj, $SQL_data )
    {
        
    }


    // Method:  delete( $DB_conn_obj, $SQL_data )
    //
    // This method receives the app_DB database connection object and the
    // SQL SELECT data to construct and perform a DELETE over the 'Auth'
    // table
    //
    // In the simplest form, the $SQL_struct_data, is a named array with 
    // several elements with the information referent to the UPDATE statement
    // 
    //  $SQL_struct_data = array( 
    //                          )

    public function delete( $DB_conn_obj, $SQL_data )
    {
        
    }

}