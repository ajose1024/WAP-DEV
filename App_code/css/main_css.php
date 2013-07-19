<?php

    header('Content-Type: text/css', $replace = TRUE );
    
    $URI = substr( $_SERVER['PATH_INFO'], 1 ) ;

    SWITCH( $URI )
    {
        CASE    'index-2':
        {
            print( index_2_css() ) ;
            break;
        }
        
        DEFAULT:
        {
            break;
        }

    }
            
    function index_2_css()
    {
        $css_data = <<<CSSDATA
            #bodyContainer1
            {
                display: inline-block ;
                left: 0 ;
                position: fixed ;
                top: 0 ;
                background-color: #888888 ;
                text-align: left ;
            }
            #bodyContainer2
            {
                display: inline-block ;
                position: fixed ;
                top: 0 ;
                background-color: #CCCCCC ;
                text-align: center ;
            }
            #bodyContainer3
            {
                display: inline-block ;
                position: fixed ;
                right: 0 ;
                top: 0 ;
                background-color: #888888 ;
                text-align: right ;
            }
            #bodyContainer4
            {
                display: block ;
                left: 0 ;
                position: fixed ;
                right: 0 ;
                background-color: #444444 ;
                text-align: justify ;
            }
            #bodyContainer5
            {
                bottom: 0 ;
                display: inline-block ;
                left: 0 ;
                position: fixed ;
                background-color: #888888 ;
                text-align: left ;
            }
            #bodyContainer6
            {
                bottom: 0 ;
                display: inline-block ;
                position: fixed ;
                background-color: #CCCCCC ;
                text-align: center ;
            }
            #bodyContainer7
            {
                bottom: 0 ;
                display: inline-block ;
                position: fixed ;
                right: 0 ;
                background-color: #888888 ;
                text-align: right ;
            }

            #bodyContainer
            {
                width: 1024px ;
                height: 768px ;
                background-position: 0 0 ;
            }
            
            .bodyContainerClassSeparator1a
            {
                width: 35% ;
            }
            .bodyContainerClassSeparator1b
            {
                left: 35% ;
            }
            .bodyContainerClassSeparator2a
            {
                right: 35% ;
            }
            .bodyContainerClassSeparator2b
            {
                width: 35% ;
            }
            .bodyContainerClassSeparator3a
            {
                height: 32px ;
            }
            .bodyContainerClassSeparator3b
            {
                top: 32px ;
            }
            .bodyContainerClassSeparator4a
            {
                bottom: 32px ;
            }
            .bodyContainerClassSeparator4b
            {
                height: 32px ;
            }
            .bodyContainerClassSeparator5a
            {
                width: 35% ;
            }
            .bodyContainerClassSeparator5b
            {
                left: 35% ;
            }
            .bodyContainerClassSeparator6a
            {
                right: 35% ;
            }
            .bodyContainerClassSeparator6b
            {
                width: 35% ;
            }

CSSDATA;
            return $css_data ;
        }
        




?>