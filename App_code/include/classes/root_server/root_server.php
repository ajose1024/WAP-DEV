<?php

interface Interface_Root_Server
{

	// This method returns the current user_ID
	//
	// If the access is anonymous, the user_ID is -1
	// If the access is authenticated, the user_ID is > 0

	public function get_user_ID();






}


class Root_Server implements Interface_Root_Server
{
	// This property stores the PSID
	// (Presentation Session ID)

	private $PSID ;


	// This method returns the current user_ID
	//
	// If the access is anonymous, the user_ID is -1
	// If the access is authenticated, the user_ID is > 0

	public function get_user_ID()
	{


	}






}




?>