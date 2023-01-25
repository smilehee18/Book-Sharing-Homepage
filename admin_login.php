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
	<style>
	html 
	{
	  background-color : #FFE4B5;
	  background-image: url('https://cdn.pixabay.com/photo/2017/01/31/00/09/books-2022464_960_720.png');
	  background-repeat : no-repeat;
	  background-position: right top;
	}
	body
	{
	  width : 700PX;
	  height : 1500px;
	  margin : 1em auto;
      background-color: #FDF5E6;
	  border : 10px #CCFF33 double;
	  text-align: center;
	}
	a
	{
      color: blue;
	}
	.red
	{
	  color: red;
	}
	table
	{
		border-collapse: collapse;
	}
	th, td {
    padding: 15px;
    text-align: center;
  }
  th 
  {
  	background-color: greenyellow;
  }
	</style>
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