<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['admin_login']))
{
	header("Location:admin_login.php");
}
if(isset($_SESSION['admin_login']))
{
   include 'admin_name.php';
}
if(isset($_SESSION['login']))
{
	include 'name.php';
}
?>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
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
	</style>
	</head>
	<body>
		<h1> Admin Panel for Users Management </h1>
		<table border ="2" align="center">
			<tr><th>id</th><th>name</th><th>password</th><th>phone</th><th>Delete?</th></tr>
			<?php
			$con = mysqli_connect('localhost','root','','mylibraries');
			$all = mysqli_query($con,'SELECT * FROM user');

			while($one = mysqli_fetch_array($all))
			{
			  echo "<tr>";
			  echo "<td>" . $one['id'] . "</td>";
			  echo "<td>" . $one['name'] . "</td>";
			  echo "<td>" . $one['pass'] . "</td>";
			  echo "<td>" . $one['phone'] . "</td>";
			  echo "<td><a href='admin_delete.php?id=".$one['id']."'>delete</a></td>";
			  echo "</tr>";
			}
			?>
			<tr></tr>
		</table>
          <a href="logout.php"><b>Logout</b></a><br>
          <p><b><a href='home.php'>go to the home</a></b></p>
	</body>
</html>