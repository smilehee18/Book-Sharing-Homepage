<!DOCTYPE html>
<?php
session_start();
  $id = $_GET['id'];
  $memo_id = $_GET['memo_id'];

  $con = mysqli_connect('localhost','root','','mylibraries');

      $sel = "SELECT * FROM comment WHERE memo_id='$memo_id'";
      $val2 = mysqli_query($con,$sel);
 	  $row = mysqli_fetch_array($val2);

    if (mysqli_query($con,"DELETE FROM comment WHERE id = '$id'"))
    {
	  header("Location:view.php?id='".$row['memo_id']."'");
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