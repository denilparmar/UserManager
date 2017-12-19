<?php
require_once("config.php");
$userId = $_GET['userId'];
$userDetails = fetchUserDetails(NULL,$userId);
$roles = getRoles();
if (!empty($_POST))
{
	if(isset($_POST['update']))
	{
		$affectedRows = updateUser($_POST['inputFname'],$_POST['inputLname'],$_POST['inputEmail'],$_POST['selectRole'],$userId);
		if ($affectedRows == 1)
		{
			header("Location:myaccount.php");
			die();
		}
	}
	if(isset($_POST['delete']))
	{
		$affectedRows = deleteUser($userId);
		if ($affectedRows == 1)
		{
			header("Location:myaccount.php");
			die();
		}
		
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>User Manager</title>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="Content/bootstrap.css" rel="stylesheet" />
	<link href="Content/bootstrap.min.css" rel="stylesheet" />
	<script src="Scripts/jquery-1.9.1.js"></script>
</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand">CS 612</a>
				<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse" id="navbar-main">
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="logout.php">Log Out</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="container page-header" id="banner">
		<div class="row">
			<div class="col-lg-8 col-md-7 col-sm-6">
				<h1>
					Update / Delete User
				</h1>
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
								<label for="inputFname" class="col-lg-3 control-label">First Name</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="inputFname" placeholder="First Name" value="<?php print $userDetails['FirstName'];?>" required />
								</div>
							</div>
							<div class="form-group">
								<label for="inputLname" class="col-lg-3 control-label">Last Name</label>
								<div class="col-lg-9">
									<input type="text" class="form-control" name="inputLname" placeholder="Last Name" value="<?php print $userDetails['LastName'];?>" required />
								</div>
							</div>
							<div class="form-group">
								<label for="inputEmail" class="col-lg-3 control-label">Email Id</label>
								<div class="col-lg-9">
									<input type="email" class="form-control" name="inputEmail" placeholder="Email Id" value="<?php print $userDetails['Email'];?>" required />
								</div>
							</div>
							<div class="form-group">
								<label for="selectRole" class="col-lg-3 control-label">Role</label>
								<div class="col-lg-9">
									<select class="form-control" name="selectRole" required>
										<option value="">Select Role</option><?php foreach ($roles as $value){?>
										<option value="<?php print $value['id'];?>" <?php if ($userDetails['Role_id']== $value['id']) print "selected"; ?>><?php print $value['name'];?></option><?php }?> />
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3">
									<button type="submit" name="update" class="btn btn-primary">Update</button>
									<button type="submit" name="delete" class="btn btn-primary">Delete</button>
								</div>
							</div>

							<div class="form-group">
								<div class="col-lg-9 col-lg-offset-3"><?php
								if (count($errors)>0){
									foreach ($errors as $value){?>
									<p style="color:red;"><?php print $value;?>
									</p><?php }?><?php }?>
								</div>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>
