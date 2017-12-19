<?php
require_once("config.php");
if (isset($_POST['btnCreate']))
{
	header("Location:createUser.php");
	exit;
}
$userId = $loggedInUser->user_id;
$fname = $loggedInUser->first_name;
$lname = $loggedInUser->last_name;
$createdUsers = fetchCreatedUsers($userId);
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

	<!--Page Title-->
	<div class="container page-header" id="banner">
		<div class="row">
			<div class="col-lg-8 col-md-7 col-sm-6">
				<h1>
					Welcome <?php print $fname." ".$lname?>
				</h1>
				<p class="lead">
					<?php print welcome();?>! Manage all users created by you.
				</p>
			</div>
		</div>
	</div>

	<div class="container container-fluid">
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Username</th>
					<th>Firstname</th>
					<th>Lastname</th>
					<th>Email</th>
					<th>Active</th>
					<th>Role</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>

				<?php
				if (!empty($createdUsers))
				{
					foreach ($createdUsers as $value){?>
				<tr>
					<td>
						<a href="updateDelete.php?userId=<?php print $value['UserID'];?>">
							<?php print $value['UserName']; ?>
						</a>
					</td>
					<td>
						<?php print $value['FirstName']; ?>
					</td>
					<td>
						<?php print $value['LastName']; ?>
					</td>
					<td>
						<?php print $value['Email']; ?>
					</td>
					<td>
						<?php $value['Active'] == 1 ? print "YES" : "NO"; ?>
					</td>
					<td>
						<?php print $value['Role_Name']; ?>
					</td>
					<td>
						<?php
						$date = date_create($value['Crd_date']);
						print date_format($date,'d/m/Y g:i A'); ?>
					</td>
				</tr><?php
					}
				}?>

			</tbody>
		</table>
	</div>



	<div class="container container-fluid">
		<form action="<?php $_SERVER['PHP_SELF'];?>" method="post">
			<input type="submit" name="btnCreate" value="Create Users" class="btn btn-primary" href="createUser.php" />
		</form>
	</div>
</body>
</html>

