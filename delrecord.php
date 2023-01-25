<!DOCTYPE html>
<?php
session_start(); 
if(isset($_SESSION['admin_login']))
{
   include 'admin_name.php';
}
if(isset($_SESSION['login']))
{
	include 'name.php';
}

$con = mysqli_connect("localhost", "root", "", "mylibraries");

 if(!$con)
 {
   die("Connection Failed " . mysqli_connect_error());
 }

 $id = $_GET['id'];
 $id = mysqli_real_escape_string($con, $id);

 $query = "DELETE from sboard WHERE id = '$id'";
 if(mysqli_query($con,$query))
 {
  header("Location:list.php");
 }

 ?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>delrecord.php</title>
</head>
<body>
</body>
</html>