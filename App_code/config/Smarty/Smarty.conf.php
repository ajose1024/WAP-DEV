<?php

// Create the main Smarty object

	$GLOBALS[ 'smarty_obj' ] = new Smarty;


// Configure the Smarty template system

	$GLOBALS[ 'smarty_obj' ]->template_dir	=   $GLOBALS['DOC_ROOT'] . 
                                                    '/templates/Smarty/templates/';
				
	$GLOBALS[ 'smarty_obj' ]->compile_dir	=   $GLOBALS['DOC_ROOT'] .
                                                    '/templates/Smarty/compile/';

	$GLOBALS[ 'smarty_obj' ]->cache_dir	=   $GLOBALS['DOC_ROOT'] .
                                                    '/templates/Smarty/cache/';

	$GLOBALS[ 'smarty_obj' ]->caching = FALSE ;
