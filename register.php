<?php

require_once("config.php");
include("header.php");
if (!empty($_POST))
{
	$errors = array();
	$username = trim($_POST["inputUser"]);
	$firstname = trim($_POST["inputFname"]);
	$lastname = trim($_POST["inputLname"]);
	$password = trim($_POST["inputPassword"]);
	$confirm_pass = trim($_POST["inputConfirm"]);
	$email = trim($_POST["inputEmail"]);
	if ($password!=$confirm_pass)
	{
		$errors[] = "Entered passwords do not match.";
	}
	if (count($errors) == 0)
	{
		$user = createNewUser($username, $firstname, $lastname, $email, $password,NULL);
		if ($user == 1)
		{
			$loggedInUser = new loggedInUser();
			$loggedInUser->user_id = $uid;
			$loggedInUser->first_name = trim($_POST["inputFname"]);
			$loggedInUser->last_name =  trim($_POST["inputLname"]);
			$loggedInUser->email = trim($_POST["inputEmail"]);
			$_SESSION["ThisUser"] = $loggedInUser;
			header("Location:myaccount.php");
			die();
		}

	}
}
?>

<div class="container page-header" id="banner">
	<div class="row">
		<div class="col-lg-8 col-md-7 col-sm-6">
			<h1>Register</h1>
		</div>
	</div>
</div>


<div class="container">
	<div class="row">
		<div class="col-lg-6">
			<div class="well bs-component">
				<form class="form-horizontal" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
					<fieldset>
						<div class="form-group">
							<label for="inputUser" class="col-lg-3 control-label">Username</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="inputUser" placeholder="Username" required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputFname" class="col-lg-3 control-label">First Name</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="inputFname" placeholder="First Name" required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputLname" class="col-lg-3 control-label">Last Name</label>
							<div class="col-lg-9">
								<input type="text" class="form-control" name="inputLname" placeholder="Last Name" required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword" class="col-lg-3 control-label">Password</label>
							<div class="col-lg-9">
								<input type="password" class="form-control" name="inputPassword" placeholder="Password" required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputConfirm" class="col-lg-3 control-label">Confirm Password</label>
							<div class="col-lg-9">
								<input type="password" class="form-control" name="inputConfirm" placeholder="Confirm Password" required />
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail" class="col-lg-3 control-label">Email Id</label>
							<div class="col-lg-9">
								<input type="email" class="form-control" name="inputEmail" placeholder="Email Id" required />
							</div>
						</div>
						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>

						<div class="form-group">
							<div class="col-lg-9 col-lg-offset-3">
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
