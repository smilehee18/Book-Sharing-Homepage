<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
	  .head{
	  	text-align: right;
	  }
	  div 
	  {
	  	text-align: right;
	  }
	</style>
</head>
<body>

</body>
</html>
<?php
echo "<h3 style='text-align:right;'> UserName : ". $_SESSION['login'] . " </h3>";
echo "<h4 style='text-align:right;'><a href='edit_users.php'>Edit Profiles</a></h4>";
?>