<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




Interface Interface_Registry {

    Public function open ($acl_ID);

    public function set_valor($seccao, $chave, $valor);

    // retorna : array ('status'; 0 ou -1)

    public function get_valor($seccao, $chave);

    //retorna : array ('status' ; 0 ou -1 ; valor)

    public function close();

   // retorna : array ('status' : 0 ou -1 )


                              }

 Class Registry implements Interface_Registry {

     private $ADODB_conn_obj = null ;



     public function open($acl_ID) {

         $result = app_DB_open( 0 );

         if( $result['status'] != 0 )
         {
             $this->ADODB_conn_obj = null ;

             return  array ('status' => $result['status'] );
         }
         else
         {
             $this->ADODB_conn_obj = $result['conn_obj'];

             return  array ('status' => $result['status'] );
         }
     }

    public function set_valor ($seccao ,$chave, $valor) {

        if ($this->ADODB_conn_obj == null)
        {
            return array ('status' => -1);
        }
        else
        {
            $sql_string = "INSERT INTO ".
                                   " app_config (" .
                                    " cfg_ID," .
                                    " seccao," .
                                    " chave," .
                                    " valor)" .
                                    " VALUES  (" .
                                    " ''," .
                                    " '" . $seccao . "'," .
                                    " '" . $chave . "'," .
                                    " '" . $valor . "')     "
                                   ;

            if ( $this->ADODB_conn_obj->Execute($sql_string) === false )
            {
                return array ('status' => -2 ,
                              'sql' => $sql_string );
            }
            else
            {
                return array ('status' => 0 );
            }
        }
     }

    public function get_valor ($seccao ,$chave) {

        if ($this->ADODB_conn_obj == null)
        {
            return array ('status' => -1);
        }
        else
        {
            $this->ADODB_conn_obj->SetFetchMode(ADODB_FETCH_ASSOC);

                        $sql_string = "SELECT * FROM ".
                                "app_config " .
                                "WHERE " .
                                "chave='" . $chave . "' " .
                                "AND " .
                                "seccao='" . $seccao . "'"
                              ;

            $record_set = $this->ADODB_conn_obj->Execute($sql_string);

            if ( $record_set === false )
            {
                return array ('status' => -2 ,
                              'sql' => $sql_string );
            }
            else
            {
                $query_result = $record_set->FetchRow();

                return array ('status' => 0 ,
                              'valor' => $query_result['valor'] );
            }
        }
     }


     public function close() {

        app_DB_close ( $this->ADODB_conn_obj );

        return  array ('status' => 0 );

     }

                                               }


?>
