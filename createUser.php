<?php
require_once("config.php");
include("header.php");
$userId = $loggedInUser->user_id;
$fname = $loggedInUser->first_name;
$lname = $loggedInUser->last_name;
$roles = getRoles();
if (!empty($_POST))
{
	$errors = array();
	$username = trim($_POST["inputUser"]);
	$firstname = trim($_POST["inputFname"]);
	$lastname = trim($_POST["inputLname"]);
	$email = trim($_POST["inputEmail"]);
	$role = $_POST["selectRole"];
	if (count($errors) == 0)
	{
		$user = createNewUser($username, $firstname, $lastname, $email, $password = NULL,$role);
		if ($user == 1)
		{
		    header("Location:myaccount.php");
		    die();
		}
	}
}
?>

<div class="container page-header" id="banner">
	<div class="row">
		<div class="col-lg-8 col-md-7 col-sm-6">
			<h1>Create User</h1>
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
							<label for="inputEmail" class="col-lg-3 control-label">Email Id</label>
							<div class="col-lg-9">
								<input type="email" class="form-control" name="inputEmail" placeholder="Email Id" required />
							</div>
						</div>
						<div class="form-group">
							<label for="selectRole" class="col-lg-3 control-label">Role</label>
							<div class="col-lg-9">
								<select class="form-control" name="selectRole" required>
									<option value="">Select Role</option>
									<?php foreach ($roles as $value){?>
									<option value="<?php print $value['id'];?>"><?php print $value['name'];?></option>
										<?php }?> />
								</select>
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