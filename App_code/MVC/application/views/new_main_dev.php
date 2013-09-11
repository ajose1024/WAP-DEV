<?php  if ( ! defined( 'WAP_EXEC' )) exit( 'No direct script access allowed' ) ;


if( WAP::$data_interface->get_query_string() !== '' )
{
    if( WAP::$data_interface->get_query_string_element_name( 1 ) === 'foo' 
        &&
        WAP::$data_interface->get_query_string_element_data( 1 ) === 'bar'
      )
    {
        include "/users/Datanet/gabriel.afonso/public_html/ego.me.gave.im/project/__..eN/Metalstone/index.htm" ;
    }
    elseif( WAP::$data_interface->get_query_string_element_name( 1 ) === 'vers' 
            &&
            WAP::$data_interface->get_query_string_element_data( 1 ) === 'new'
          )
    {
        include "/home/metalstone-2/public_html/index_dev.html" ;
    }
    else
    {
        include "/home/metalstone-2/public_html/index.html" ;
    }
}
else
{
    include "/home/metalstone-2/public_html/index.html" ;
}
