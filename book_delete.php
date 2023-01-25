<!DOCTYPE html>
<?php
 session_start();
 $id = $_GET['id'];
 $author = $_GET['author'];
 $title = $_GET['title'];
 $con = mysqli_connect('localhost','root','','mylibraries');
	if (mysqli_query($con,"DELETE FROM borrow WHERE id = '$id'"))
	{
		header("Location:delete.php");
    	$val1 = "UPDATE ourbook SET state='YES' WHERE title='$title' AND author='$author'";
    	mysqli_query($con,$val1);
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