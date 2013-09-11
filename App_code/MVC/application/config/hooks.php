<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook[ 'pre_controller' ] = array( 'class'      => 'wap_data_init' ,
                                   'function'   => 'get_CI_objects' ,
                                   'filename'   => 'wap_data_init.php' ,
                                   'filepath'   => 'hooks/wap' ,
                                   'params'     => '' 
                                 ) ;

$hook[ 'post_controller_constructor' ] = array( 'class'      => 'wap_data_init' ,
                                                'function'   => 'get_CI_instance' ,
                                                'filename'   => 'wap_data_init.php' ,
                                                'filepath'   => 'hooks/wap' ,
                                                'params'     => '' 
                                              ) ;


/* End of file hooks.php */
/* Location: ./application/config/hooks.php */