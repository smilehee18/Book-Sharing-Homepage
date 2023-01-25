<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['admin_login']))
{
  $id = $_GET['id'];
	$con = mysqli_connect('localhost','root','','mylibraries');
	if (mysqli_query($con,"DELETE FROM user WHERE id = '$id'"))
	{
		header("Location:admin_users.php");
	}
	else
	{
		header("Location:admin_login.php");
	}
}
  else
  {
  	header("Location:admin_login");
  }
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>

</body>
</html>