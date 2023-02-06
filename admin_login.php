<!DOCTYPE html>
<?php
session_start();
$con = mysqli_connect('localhost','root','','mylibraries');

if(isset($_POST['submit']))
{
	$adminname = $_POST['name'];
	$adminpass = $_POST['pass'];

	$one = mysqli_query($con, "SELECT name, pass, phone FROM admin WHERE name ='$adminname' AND pass='$adminpass'");

	if (mysqli_num_rows($one) > 0)
	{
		$_SESSION['admin_login'] = $adminname;
		header("Location:admin_users.php");
	}
	else
	{
		echo "<h3 style='color:red'>Wrong password </h3>";
	}
    mysqli_close($con);
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin_Login</title>
	<link href='style/style.css' rel='stylesheet'></link>
</head>
<body>
	<h2> Welcome to Free Book - Sharing HomePage ! </h2>
     <h3> This is Admin-Login Page</h3>
     <form action = "admin_login.php" method ="POST">
		<table border = "2" align = "center">
			<tr><th colspan = "2" align = "center">Admin Login</th></tr>
			<tr><td>Admin Name</td><td><input type = "text" name ="name"></td></tr>
			<tr><td>Admin Pass</td><td><input type = "password" name ="pass"></td></tr>
			<tr><td align = "center" colspan = "2"><input type="submit" name="submit" value = "Admin Login"></td></tr>
		</table>
	</form>

	<ul type ='circle'>
	<li><b><a href='index.php'>go to the Login Page</a></b></li>
	</ul>

</body>
</html>
