<?php

require_once("config.php");
include("header.php");
if(isUserLoggedIn()) { header("Location: myaccount.php"); die(); }
if (!empty($_POST))
{
	$errors = array();
	$username = trim($_POST['inputUser']);
	$password = trim($_POST['inputPassword']);
	$userDetails = fetchUserDetails($username,NULL);
	$entered_pass = generateHash($password,$userDetails['Password']);
	if ($userDetails == null)
	{
		$errors[] = "Username does not exists.";
	}
	else if ($entered_pass!= $userDetails['Password'])
	{
		$errors[] = "Invalid Password";
	}

	else if ($userDetails["Active"] == 0)
	{
		$errors[] = "User Inactive";
	}
	else
	{
		$loggedInUser = new loggedInUser();
		$loggedInUser->user_id = $userDetails["UserID"];
		$loggedInUser->first_name = $userDetails["FirstName"];
		$loggedInUser->last_name =  $userDetails["LastName"];
		$loggedInUser->hash_pw = $userDetails["Password"];
		$loggedInUser->email = $userDetails["Email"];
		$loggedInUser->created_by =   $userDetails["Crd_by"];
		$loggedInUser->member_since = $userDetails["Crd_date"];
		$_SESSION["ThisUser"] = $loggedInUser;
		header("Location: myaccount.php");
		exit();
	}
}
?>

<!--Page Title-->
<div class="container page-header" id="banner">
	<div class="row">
		<div class="col-lg-8 col-md-7 col-sm-6">
			<h1>User Manager</h1>
			<p class="lead">Welcome to the user management portal!</p>
		</div>
	</div>
</div>

<!--Login Section-->
<div class="container">
	<div class="row">
		<div class="col-lg-6">
			<div class="well bs-component">
				<form name="login" class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
					<fieldset>
						<legend>Login</legend>
						<div class="form-group">
							<label for="inputUser" class="col-lg-2 control-label">Username</label>
							<div class="col-lg-10">
								<input type="text" class="form-control" name="inputUser" placeholder="Username" required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword" class="col-lg-2 control-label">Password</label>
							<div class="col-lg-10">
								<input type="password" class="form-control" name="inputPassword" placeholder="Password" required />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2">
								<input type="submit" value="Login" class="btn btn-primary" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2">
								<a href='register.php'>Sign up for an account</a>
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-10 col-lg-offset-2">
								<?php
								if (count($errors)>0){
									foreach ($errors as $value){?>
								<p style="color:red;">
									<?php print $value;?>
								</p><?php }?><?php }?>
							</div>
						</div>
					</fieldset>
				</form>
			</div>
		</div>
	</div>
</div>
