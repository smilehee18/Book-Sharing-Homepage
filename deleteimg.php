<?php
$id = $_GET['id'];
$con = mysqli_connect("localhost","root","","mylibraries") or die(mysqli_connect_error());
mysqli_query($con, "DELETE FROM images WHERE id=$id");
mysqli_close($con);
header("location: image.php");
?>