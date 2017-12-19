<?php

/**
 * @version 1.0
 * @author denil
 */
class loggedInUser
{
	public $email = NULL;
	public $hash_pw = NULL;
	public $user_id = NULL;

	//Logout
	public function userLogOut()
	{
		destroySession("ThisUser");
	}

}