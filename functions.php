<?php

function destroySession($name)
{
	if (isset($_SESSION[$name])) {
		$_SESSION[$name] = NULL;
		unset($_SESSION[$name]);
	}
}


function generateHash($plainText, $salt = NULL)
{
	if ($salt === NULL) {
		$salt = substr(md5(uniqid(rand(), TRUE)), 0, 25);
	} else {
		$salt = substr($salt, 0, 25);
	}
	return $salt . sha1($salt . $plainText);
}


function fetchCreatedUsers($userId)
{
	global $mysqli, $db_table_prefix;
	$row = [];
	$stmt = $mysqli->prepare(
		"SELECT
	a.*, c.role_name
		FROM
	userdetails a
		INNER JOIN
	userdetails b ON a.crd_by = b.UserId
		INNER JOIN
	roles c ON a.role_id = c.role_id
		WHERE
	b.UserId = ?
		ORDER BY a.FirstName");
	$stmt->bind_param("s", $userId);
	$stmt->execute();
	$stmt->bind_result($UserID, $UserName, $FirstName, $LastName, $Email, $Password, $Active, $Role_id,$Crd_by,$Crd_date,$role_name);
	while ($stmt->fetch()) {
		$row[] = array('UserID' => $UserID,
			'UserName' => $UserName,
			'FirstName' => $FirstName,
			'LastName' => $LastName,
			'Email' => $Email,
			'Password' => $Password,
			'Active' => $Active,
			'Role_id'=>$Role_id,
			'Crd_by'=>$Crd_by,
			'Crd_date'=>$Crd_date,
			'Role_Name'=>$role_name);
	}
	$stmt->close();
	return ($row);
}


function fetchUserDetails($username = NULL,$userId = NULL)
{

	global $mysqli, $db_table_prefix;
	$row = null;
	$username = strtoupper($username);
	if ($userId != NULL)
	{
		$query = "SELECT UserID, UserName, FirstName, LastName, Email, Password, Active, role_id, crd_by, crd_date FROM userdetails WHERE UserID = ? LIMIT 1";
		$param = $userId;
	}
	else
	{
		$query = "SELECT UserID, UserName, FirstName, LastName, Email, Password, Active, role_id, crd_by, crd_date FROM userdetails WHERE UserName = ? LIMIT 1";
		$param = $username;
	}
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("s", $param);
	$stmt->execute();
	$stmt->bind_result($UserID, $UserName, $FirstName, $LastName, $Email, $Password, $Active, $Role_id,$Crd_by,$Crd_date);
	while ($stmt->fetch()) {
		$row = array('UserID' => $UserID,
			'UserName' => $UserName,
			'FirstName' => $FirstName,
			'LastName' => $LastName,
			'Email' => $Email,
			'Password' => $Password,
			'Active' => $Active,
			'Role_id'=>$Role_id,
			'Crd_by'=>$Crd_by,
			'Crd_date'=>$Crd_date);
	}
	$stmt->close();
	return ($row);
}


function createNewUser($username, $firstname, $lastname, $email, $password, $roleId)
{
	global $loggedInUser,$mysqli, $db_table_prefix,$uid;
	$createdBy = $loggedInUser->user_id ?? NULL;
	$username = strtoupper($username);
	if ($roleId == null)
	{
		$roleId = 1;
	}
	if ($password != null)
	{
		$password = generateHash($password);
	}
	$character_array = array_merge(range('A','Z'), range(0, 9));
	$rand_string = "";
	for ($i = 0; $i < 6; $i++) {
		$rand_string .= $character_array[rand(
			0, (count($character_array) - 1)
		)];
	}
	$uid = $rand_string;
	$stmt = $mysqli->prepare("INSERT INTO " . $db_table_prefix . "userdetails (UserID, UserName, FirstName, LastName, Email, Password, role_id, crd_by) VALUES (?,?,?,?,?,?,?,?)");
	$stmt->bind_param("ssssssis",$rand_string,$username , $firstname, $lastname, $email, $password,$roleId,$createdBy);
	$result = $stmt->execute();
	$stmt->close();
	return $result;

}

function isUserLoggedIn()
{
	global $loggedInUser, $mysqli, $db_table_prefix;
	$stmt = $mysqli->prepare("SELECT
		UserID,
		Password
		FROM " . $db_table_prefix . "userdetails
		WHERE
		UserID = ?
		AND
		Password = ?
		AND
		active = 1
		LIMIT 1");
	$stmt->bind_param("ss", $loggedInUser->user_id, $loggedInUser->hash_pw);
	$stmt->execute();
	$stmt->store_result();
	$num_returns = $stmt->num_rows;
	$stmt->close();

	if ($loggedInUser == NULL) {
		return false;
	} else {
		if ($num_returns > 0) {
			return true;
		} else {
			destroySession("ThisUser");
			return false;
		}
	}
}

function updateUser($FirstName,$LastName,$Email,$roleId,$UserID)
{
	global $loggedInUser, $mysqli, $db_table_prefix;
	$stmt = $mysqli->prepare("UPDATE userdetails SET FirstName = ?,LastName = ?,Email = ?,Role_id = ? where UserID=?");
	$stmt->bind_param("sssss", $FirstName,$LastName,$Email,$roleId,$UserID);
	$stmt->execute();
	$stmt->store_result();
	$num_returns = $stmt->affected_rows;
	$stmt->close();
	return $num_returns;
}

function deleteUser($UserID)
{
	global $loggedInUser, $mysqli, $db_table_prefix;
	$stmt = $mysqli->prepare("DELETE from userdetails where UserID=?");
	$stmt->bind_param("s", $UserID);
	$stmt->execute();
	$stmt->store_result();
	$num_returns = $stmt->affected_rows;
	$stmt->close();
	return $num_returns;
}


function getRoles()
{
	global $mysqli, $db_table_prefix;
	$stmt = $mysqli->prepare("SELECT ROLE_ID,ROLE_NAME FROM roles");
	$stmt->execute();
	$stmt->bind_result($role_id,$role_name);
	while ($stmt->fetch())
	{
		$row[]= array('id'=>$role_id,'name'=>$role_name);
	}
	$stmt->close();
	return($row);
}


function welcome(){
	$welcome = null;
	if (date("H") < 12) {
		$welcome = 'Good morning';
	} else if (date('H') > 11 && date("H") < 18) {
		$welcome = 'Good afternoon';
	} else if(date('H') > 17) {
		$welcome = 'Good evening';
	}
	return $welcome;
}



?>