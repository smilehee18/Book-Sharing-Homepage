<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style>
	  .head{
	  	text-align: right;
	  	color :blue;
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
echo "<div><h3 class='head'> Hello, " . $_SESSION['admin_login'] . "</h3></div>";
echo "<h4><div><a href='edit_admin.php'>Edit Profiles</a></div></h4>";
echo "<h4><div><a href='admin_users.php'>Management User</a></div></h4>";
?>