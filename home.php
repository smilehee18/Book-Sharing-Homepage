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
	  background-image : url('https://cdn.pixabay.com/photo/2016/01/11/16/06/bookmark-1133851_960_720.png');
     background-repeat : no-repeat;
     background-position: top;
	  width : 700PX;
	  height : 1500px;
	  margin : 1em auto;
      background-color: #FDF5E6;
	  border : 10px #CCFF33 double;
	  text-align: center;

	}
	.btn1
	{
     color: steelblue;
     display: block;
	 background-color:white;
	 padding: 30px 30px;
	 text-align: center;
	 font-size: 40px;
	 text-decoration: none;
	 border: 3px outset lime;
	 border-radius :10px;
	}
	.btn1:hover
	{
	  background-color: limegreen;
	  color: greenyellow;
	}
	</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>home.php</title>
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