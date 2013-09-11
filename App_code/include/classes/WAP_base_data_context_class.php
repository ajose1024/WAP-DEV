<?php if ( !defined( 'WAP_EXEC' ) ) exit( 'No direct script access allowed' ) ;


interface WAP_data_context__Interface
{

    public static function get_version() ;


    
}

class WAP_data_context implements WAP_data_context__Interface
{

    /**
     * Construct won't be called inside this class and is uncallable from
     * the outside.
     * This prevents instantiating this class.
     * This is by purpose, because we want a static class.
     */
    private function __construct()
    {
        
    }

    
    // Class private properties

    // This property indicates if the calss has been already intitialized or not
    private static $initialized = FALSE ;
    
    // This property holds the version of this static class
    private static $version = '0.010' ;
 
    // This property holds the current presentation context ID
    private static $presentation_context_id = "" ;

    
    // ---------------------------------------------------------
    // The current Presentation Session Data Channel Context_IDs
    // ---------------------------------------------------------
    
    // ACTION Data Channel Context_ID
    private static $act_ctx_id  = "" ;
    // INPUT Data Channel Context_ID
    private static $in_ctx_id   = "" ;
    // MQUEUE Data Channel Context_ID
    private static $mq_ctx_id   = "" ;
    // SADR Data Channel Context_ID
    private static $sadr_ctx_id = "" ;
    // STORAGE Data Channel Context_ID
    private static $mem_ctx_id  = "" ;
    // RESOURCE Data Channel Context_ID
    private static $res_ctx_id  = "" ;
    // FORM Data Channel Context_ID
    private static $form_ctx_id = "" ;
    
    private static $act_context_id  = 0 ;
    private static $in_context_id   = 0 ;
    private static $mq_context_id   = 0 ;
    private static $sadr_context_id = 0 ;
    private static $mem_context_id  = 0 ;
    private static $res_context_id  = 0 ;
    private static $form_context_id = 0 ;
    
    private static $last_p_sess_id = "" ;
    
    private static $CI ;
    
    
    // Data structure to store the Data context_IDs
    //
    // The active data context IDs are stored in this structure
    //
    //  $data_context_IDs = array( 'presentation_context' => '' ,
    //                             'data_context_IDs'     => array( <ctxid-1> => array( 'TTL' => <ttl> ,
    //                                                                                  'timestamp => <timestamp> ,
    //                                                                                  'type' => <type>
    //                                                                                ) ,
    //                                                                  ........
    //                                                              <ctxid-n> => array( 'TTL' => <ttl> ,
    //                                                                                  'timestamp => <timestamp> ,
    //                                                                                  'type' => <type>
    //                                                                                )
    //                                                            ) ,
    //                             'timestamp'            => 0
    //                          ) ;
    //
    
    private static $data_context_IDs = array( 'presentation_context' => null ,
                                              'data_context_IDs' => array( ) ,
                                              'timestamp' => 0
                                            ) ;
    
    private static $data_context_IDs_loaded = false ;
    
    
    
    // Method:  get_version()
    //
    // This method returns the version of the WAP_data_context static class
    
    public static function get_version()
    {
        return  self::$version ;
    }


    // Method:  generate_id()
    //
    // This method returns an unique random ID
    
    public static function generate_id()
    {
        return  md5( uniqid( rand(), true) ) ;
    }
    
    
    // Method:  get_context_ID( $TTL = 1 )
    //
    // This method generates a context_ID, stores it and it's relevant data,
    // returning it
    
    public static function get_context_ID( $TTL = 1 )
    {
        // Generate a context_ID
        $context_id = self::generate_id() ;

        // Store the context_ID in the  $data_context_IDs  data structure
        self::add_to_data_context_IDs( $context_id ,
                                       array( 'TTL' => $TTL ,
                                              'timestamp' => time() ,
                                              'type' => 'general'
                                            )
                                     ) ;
        
        return  $context_id ;
    }
    

    // Method:  add_to_data_context_IDs( $context_id , $context_id_data )
    //
    // This method adds the new context ID data to the  $data_context_IDs
    // data structure and saves it on the permanent storage copy.
    //
    // The  $data_context_IDs  data strgucture has the following format:
    // 
    //  $data_context_IDs = array( 'presentation_context' => '' ,
    //                             'data_context_IDs'     => array( <ctxid-1> => array( 'TTL' => 1 ,
    //                                                                                  'timestamp => 0 ,
    //                                                                                  'type' => 'general'
    //                                                                                ) ,
    //                                                                  ........
    //                                                              <ctxid-n> => array( 'TTL' => 1 ,
    //                                                                                  'timestamp => 0 ,
    //                                                                                  'type' => 'general'
    //                                                                                )
    //                                                            ) ,
    //                             'timestamp'            => 0
    //                          ) ;
    //
    // The  $context_id_data  is an array with the context_id details, with the
    // following structure:
    //
    //  $context_id_data = array( 'TTL' => <context-id_time_to_live> ,
    //                            'timestamp' => <current-time-stamp> ,
    //                            'type' => <type-of-context-id>
    //                          )

    public static function add_to_data_context_IDs( $context_id , $context_id_data )
    {
        if( self::$data_context_IDs_loaded === false )
        {
            // Load the $data_context_IDs from permanent storage
            self::load_data_context_IDs() ;
        }
        
        self::$data_context_IDs[ 'data_context_IDs' ] = array_merge(
                    self::$data_context_IDs[ 'data_context_IDs' ] ,
                    array( $context_id => array( 'TTL'       => $context_id_data[ 'TTL' ] ,
                                                 'timestamp' => $context_id_data[ 'timestamp' ] ,
                                                 'type'      => $context_id_data[ 'type' ]
                                            )
                     )
                ) ;

        // Save the  $data_context_IDs  back to permanent storage
        self::save_data_context_IDs() ;
    }
    
    
    // Method:  load_data_context_IDs()
    //
    // This method loads the  $data_context_IDs  from permanent storage
    //
    // The  self::$data_context_IDs  is read from a JSON data file at:
    //
    //  /App_code/system/data_context/data_context_IDs.json
    
    public static function load_data_context_IDs()
    {
        $data_context_IDs_file = $GLOBALS[ 'DOC_ROOT' ] . '/App_data/system/data_context/data_context_IDs.json' ;
        
        // Read data from JSON file
        self::$data_context_IDs = object_to_array( read_JSON_file( $data_context_IDs_file ) ) ;
        
//        var_dump( self::$data_context_IDs ) ;
    }
    
    
    // Method:  save_data_context_IDs()
    //
    // This method saves the  $data_context_IDs  onto permanent storage
    //
    // The  self::$data_context_IDs  is stored onto a JSON data file at:
    //
    //  /app_code/systems/data_context/data_context_IDs.json
    
    public static function save_data_context_IDs()
    {
        $data_context_IDs_file = $GLOBALS[ 'DOC_ROOT' ] . '/App_data/system/data_context/data_context_IDs.json' ;
        
        // Write data back to JSON file
        write_JSON_file( $data_context_IDs_file , self::$data_context_IDs ) ;
    }
    
    
    // Method:  get_presentation_context_id( $new )
    //
    // This method returns the current  'presentation_session_id', if no parameter
    // is passed or FALSE is passed, or a generates a new  'presentation_session_id'
    // is TRUE is passed as parameter
    
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
    


    
}

