<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * WAP -- WEB Application Platform
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		WAP
 * @author		Epsilon Software
 * @copyright           Copyright (c) 2010 - 2013, Epsilon Software.
 * @license		
 * @link		http://wap.develop.datanet-pt.net
 * @since		Version 0.01
 * @filesource
 */

class Data_context extends CI_Model
{
    private $presentation_context_id = "" ;

    private $act_ctx_id  = "" ;
    private $in_ctx_id   = "" ;
    private $mq_ctx_id   = "" ;
    private $sadr_ctx_id = "" ;
    private $mem_ctx_id  = "" ;
    private $res_ctx_id  = "" ;
    private $form_ctx_id = "" ;
    
    private $act_context_id  = 0 ;
    private $in_context_id   = 0 ;
    private $mq_context_id   = 0 ;
    private $sadr_context_id = 0 ;
    private $mem_context_id  = 0 ;
    private $res_context_id  = 0 ;
    private $form_context_id = 0 ;
    
    private $last_p_sess_id = "" ;
    
    private $CI ;
    
    
    public function __construct()
    {
        parent::__construct();
    
        $this->CI =& get_instance() ;
        
        $p_context = $this->CI->presentation_session->p_userdata( 'presentation_context' ) ;
        if ( $p_context === FALSE )
        {
            $this->presentation_context_id = $this->get_presentation_context_id( TRUE ) ;
        }
        else
        {
            $this->presentation_context_id = $this->get_presentation_context_id( FALSE ) ;
        }

        $this->act_ctx_id   = $this->CI->presentation_session->p_userdata( 'act_ctx_id' ) ;
        $this->in_ctx_id    = $this->CI->presentation_session->p_userdata( 'in_ctx_id' ) ;
        $this->mq_ctx_id    = $this->CI->presentation_session->p_userdata( 'mq_ctx_id' ) ;
        $this->sadr_ctx_id  = $this->CI->presentation_session->p_userdata( 'sadr_ctx_id' ) ;
        $this->mem_ctx_id   = $this->CI->presentation_session->p_userdata( 'mem_ctx_id' ) ;
        $this->res_ctx_id   = $this->CI->presentation_session->p_userdata( 'res_ctx_id' ) ;
        $this->form_ctx_id  = $this->CI->presentation_session->p_userdata( 'form_ctx_id' ) ;

        $this->last_p_sess_id = $this->CI->presentation_session->p_userdata( 'session_id' ) ;
        
        $result = $this->check_data_context_exists( ) ;
        
//        var_dump( $result ) ;
//        echo "<br><hr>" ;
        
//        $this->act_context_id   = $this->adjust_context_data( 'act_ctx_id'  , $this->act_ctx_id  ) ;
//        $this->in_context_id    = $this->adjust_context_data( 'in_ctx_id'   , $this->in_ctx_id   ) ;
//        $this->mq_context_id    = $this->adjust_context_data( 'mq_ctx_id'   , $this->mq_ctx_id   ) ;
//        $this->sadr_context_id  = $this->adjust_context_data( 'sadr_ctx_id' , $this->sadr_ctx_id ) ;
//        $this->mem_context_id   = $this->adjust_context_data( 'mem_ctx_id'  , $this->mem_ctx_id  ) ;
//        $this->res_context_id   = $this->adjust_context_data( 'res_ctx_id'  , $this->res_ctx_id  ) ;
//        $this->form_context_id  = $this->adjust_context_data( 'form_ctx_id' , $this->form_ctx_id ) ;

        
        
//        print_r( $this->CI->presentation_session->p_all_userdata() ) ;

//        print_r( $this->CI->session->all_userdata() ) ;
        
    }
    
    
    public function generate_id()
    {
        return  md5( uniqid( rand(), true) ) ;
    }
    
    
    public function get_presentation_context_id( $new = FALSE )
    {
        if( $new === TRUE )
        {
            $this->presentation_context_id = $this->generate_id() ;
            $this->CI->presentation_session->p_set_userdata( 'presentation_context',
                                                             $this->presentation_context_id ) ;
        }

        return  $this->presentation_context_id ;
    }
    

    public function get_act_ctx_id( $new = FALSE )
    {
        if( $new === TRUE )
        {
            $old_act_ctx_id = $this->act_ctx_id ;
            
            $this->act_ctx_id = $this->generate_id() ;
            $this->CI->presentation_session->p_set_userdata( 'act_ctx_id', $this->act_ctx_id ) ;

            $session_id = $this->CI->presentation_session->p_userdata( 'session_id' ) ;
                        
            $data = array(
                            'ctx_id' => $this->act_ctx_id ,
                            'ctx_id_name' => 'act_ctx_id',
                            'p_sessid' => $session_id
                         ) ;

            $this->db->where( 'ctx_id', $old_act_ctx_id ) ;
            $this->db->where( 'ctx_id_name', 'act_ctx_id' ) ;
            $this->db->update( 'data_context', $data ) ;

        }

        return  $this->act_ctx_id ;
    }
    

    public function get_in_ctx_id( $new = FALSE )
    {
        if( $new === TRUE )
        {
            $old_in_ctx_id = $this->in_ctx_id ;
            
            $this->in_ctx_id = $this->generate_id() ;
            $this->CI->presentation_session->p_set_userdata( 'in_ctx_id', $this->in_ctx_id ) ;

            $session_id = $this->CI->presentation_session->p_userdata( 'session_id' ) ;
            
            $data = array(
                            'ctx_id' => $this->in_ctx_id ,
                            'ctx_id_name' => 'in_ctx_id' ,
                            'p_sessid' => $session_id
                         ) ;

            $this->db->where( 'ctx_id', $old_in_ctx_id ) ;
            $this->db->where( 'ctx_id_name', 'in_ctx_id' ) ;
            $this->db->update( 'data_context', $data ) ;

        }
        
        return  $this->in_ctx_id ;
    }
    

    public function get_mq_ctx_id( $new = FALSE )
    {
        if( $new === TRUE )
        {
            $old_mq_ctx_id = $this->mq_ctx_id ;
            
            $this->mq_ctx_id = $this->generate_id() ;
            $this->CI->presentation_session->p_set_userdata( 'mq_ctx_id', $this->mq_ctx_id ) ;

            $session_id = $this->CI->presentation_session->p_userdata( 'session_id' ) ;
            
            $data = array(
                            'ctx_id' => $this->mq_ctx_id ,
                            'ctx_id_name' => 'mq_ctx_id' ,
                            'p_sessid' => $session_id
                         ) ;

            $this->db->where( 'ctx_id', $old_mq_ctx_id ) ;
            $this->db->where( 'ctx_id_name', 'mq_ctx_id' ) ;
            $this->db->update( 'data_context', $data ) ;

        }
        
        return  $this->mq_ctx_id ;
    }
    

    public function get_sadr_ctx_id( $new = FALSE )
    {
        if( $new === TRUE )
        {
            $old_sadr_ctx_id = $this->sadr_ctx_id ;
            
            $this->sadr_ctx_id = $this->generate_id() ;
            $this->CI->presentation_session->p_set_userdata( 'sadr_ctx_id', $this->sadr_ctx_id ) ;

            $session_id = $this->CI->presentation_session->p_userdata( 'session_id' ) ;
            
            $data = array(
                            'ctx_id' => $this->sadr_ctx_id ,
                            'ctx_id_name' => 'sadr_ctx_id' ,
                            'p_sessid' => $session_id
                         ) ;

            $this->db->where( 'ctx_id', $old_sadr_ctx_id ) ;
            $this->db->where( 'ctx_id_name', 'sadr_ctx_id' ) ;
            $this->db->update( 'data_context', $data ) ;

        }
        
        return  $this->sadr_ctx_id ;
    }
    

    public function get_mem_ctx_id( $new = FALSE )
    {
        if( $new === TRUE )
        {
            $old_mem_ctx_id = $this->mem_ctx_id ;
            
            $this->mem_ctx_id = $this->generate_id() ;
            $this->CI->presentation_session->p_set_userdata( 'mem_ctx_id', $this->mem_ctx_id ) ;

            $session_id = $this->CI->presentation_session->p_userdata( 'session_id' ) ;
            
            $data = array(
                            'ctx_id' => $this->mem_ctx_id ,
                            'ctx_id_name' => 'mem_ctx_id' ,
                            'p_sessid' => $session_id
                         ) ;

            $this->db->where( 'ctx_id', $old_mem_ctx_id ) ;
            $this->db->where( 'ctx_id_name', 'mem_ctx_id' ) ;
            $this->db->update( 'data_context', $data ) ;

        }
        
        return  $this->mem_ctx_id ;
    }
    

    public function get_res_ctx_id( $new = FALSE )
    {
        if( $new === TRUE )
        {
            $old_res_ctx_id = $this->res_ctx_id ;
            
            $this->res_ctx_id = $this->generate_id() ;
            $this->CI->presentation_session->p_set_userdata( 'res_ctx_id', $this->res_ctx_id ) ;

            $session_id = $this->CI->presentation_session->p_userdata( 'session_id' ) ;
            
            $data = array(
                            'ctx_id' => $this->res_ctx_id ,
                            'ctx_id_name' => 'res_ctx_id' ,
                            'p_sessid' => $session_id
                         ) ;

            $this->db->where( 'ctx_id', $old_res_ctx_id ) ;
            $this->db->where( 'ctx_id_name', 'res_ctx_id' ) ;
            $this->db->update( 'data_context', $data ) ;

        }
        
        return  $this->res_ctx_id ;
    }
    

    public function get_form_ctx_id( $new = FALSE )
    {
        if( $new === TRUE )
        {
            $old_form_ctx_id = $this->form_ctx_id ;
            
            $this->form_ctx_id = $this->generate_id() ;
            $this->CI->presentation_session->p_set_userdata( 'form_ctx_id', $this->form_ctx_id ) ;

            $session_id = $this->CI->presentation_session->p_userdata( 'session_id' ) ;
            
            $data = array(
                            'ctx_id' => $this->form_ctx_id ,
                            'ctx_id_name' => 'form_ctx_id' ,
                            'p_sessid' => $session_id
                         ) ;

            $this->db->where( 'ctx_id', $old_form_ctx_id ) ;
            $this->db->where( 'ctx_id_name', 'form_ctx_id' ) ;
            $this->db->update( 'data_context', $data ) ;

        }
        
        return  $this->form_ctx_id ;
    }
    

    public function ctx_update_sess_id( $old_sess_id, $new_sess_id )
    {
            $data = array(
                            'p_sessid' => $new_sess_id
                         ) ;
    }

    
    private function adjust_context_data( $ctx_data_type, $ctx_id )
    {
        
        $context_id_var = -1 ;
        
        $where_data = array( 'p_sessid' => $this->last_p_sess_id ,
                             'ctx_id_name' => $ctx_data_type
                           ) ;
        $this->CI->db->where( $where_data ) ;
        $this->CI->db->select( 'context_id' ) ;
        $query = $this->db->get( 'data_context' ) ;

//        print_r( $query ) ;
//        print("<br/><br/>") ;
        
        if ( $query->num_rows() > 0 )
        {
            $result = $query->row() ;
            $context_id_var = $result->context_id ;
        }
        else
        {
            $data = array(
                            'ctx_id'      => $ctx_id ,
                            'ctx_id_name' => $ctx_data_type ,
                            'p_sessid'    => $this->last_p_sess_id , 
                            'create_time' => time() ,
                            'last_update' => time()
                         ) ;
            $this->CI->db->insert( 'data_context', $data ) ;
        }
        
//        print( $this->last_p_sess_id ) ;
//        print("<br/><br/>") ;
        
//        print_r( $query->row() ) ;
//        print("<br/><br/>") ;

//        print( $context_id_var ) ;
//        print("<br/><br/>") ;

        return $context_id_var ;

    }
    
    
    private function insert_update_context( $context_id )
    {
        // In first place we see if there is already a record in the
    }

    
    /**
     * This method checks is a table exists and, if it does not, it creates it
     * 
     * To perform its task it uses the following SQL sentence:
     * 
     *      SELECT  count(*) 
     *      FROM    information_schema.tables 
     *      WHERE   table_schema = <schema-or-db-name> 
     *      AND     table_name = <table-or-view-name>
     *      ;
     * 
     *  This method returns an array with the following results:
     * 
     *      The table exists:   return  array( 'table_exists'   => TRUE,
     *                                         'table_created'  => FALSE,
     *                                         'error_code'     => 0
     *                                       )
     *      The table does  :   return  array( 'table_exists'   => FALSE,
     *      not exist and is                   'table_created'  => TRUE,
     *      created                            'error_code'     => 0
     *                                       )
     *      The table does  :   return  array( 'table_exists'   => FALSE,
     *      not exist and is                   'table_created'  => FALSE,
     *      not created                        'error_code'     => -1
     *                                       )
     */
    private function check_data_context_exists( )
    {
        $query = $this->db->query( 'SELECT  count(*) ' .
                                   'FROM    information_schema.tables ' .
                                   'WHERE   table_schema = ' . "'" . 'u10022_app_db' . "' " .
                                   'AND     table_name = ' . "'" . 'data_context' . "';"
                                 );
        
//        var_dump( $query ) ;
//        echo "<br><hr>" ;

//        var_dump( $query->result_object() ) ;
//        echo "<br><hr>" ;

//        var_dump( $query->row() ) ;
//        echo "<br><hr>" ;

//        var_dump( $query->result_array() ) ;
//        echo "<br><hr>" ;

//        var_dump( $query->row_array() ) ;
//        echo "<br><hr>" ;

        $table_result = $query->row_array() ;
        
        if ( $table_result[ 'count(*)' ] === '0' )
        {
            // The selected table does not exist. So it must be created
            // Use a hardwired definition for now
            $db_result = $this->db->query( 
                                           'CREATE TABLE IF NOT EXISTS `data_context` ( ' .
                                           '`context_id` int(11) NOT NULL auto_increment, ' .
                                           '`ctx_id` varchar(32) default NULL, ' .
                                           '`ctx_id_name` varchar(32) default NULL, ' .
                                           '`p_sessid` varchar(32) NOT NULL, ' .
                                           '`presentation_context` varchar(32) NOT NULL, ' .
                                           '`create_time` datetime NOT NULL, ' .
                                           '`last_update` datetime NOT NULL, ' .
                                           ' PRIMARY KEY (`context_id`), ' .
                                           ' KEY `p_sessid` (`p_sessid`), ' .
                                           ' KEY `presentation_context` (`presentation_context`) ' .
                                           ' ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;'
                                         ) ;
            if ( $db_result === TRUE )
            {
                return  array( 'table_exists'   =>  FALSE ,
                               'table_created'  =>  TRUE ,
                               'error_code'     =>  0
                             ) ;
            }
            else
            {
                return  array( 'table_exists'   =>  FALSE ,
                               'table_created'  =>  FALSE ,
                               'error_code'     =>  -1
                             ) ;
            }
        }
        else
        {
            return  array( 'table_exists'   =>  TRUE ,
                           'table_created'  =>  FALSE ,
                           'error_code'     =>  0
                         ) ;
        }
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */