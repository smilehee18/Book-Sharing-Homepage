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
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>home.php</title>
	<link href='style/style.css' rel='stylesheet'></link>
</head>
<body>
	<h2> Welcome to Free Book-Sharing Homepage !
	<br> <h2> You can borrow/donate/share any books on this site !! </h2>
    <h3> Click the Button you want ~ </h3>

    <br>

       <p><a href="donate.php" class="btn1">Donate Books</a></p>
       <p><a href="info.php" class="btn1">Search/Borrow Books</a></p>
       <p><a href="delete.php" class="btn1">Return Books</a></p>
       <p><a href="list.php" class="btn1">Share Books</a></p>

       <img src='https://cdn.pixabay.com/photo/2017/01/31/19/26/book-2026675_960_720.png' width='300' hegiht='300' align='center'>

       <p><b>Do you want to Logout ? <a href ="logout.php">Logout</a></b></p>
</body>
</html>
