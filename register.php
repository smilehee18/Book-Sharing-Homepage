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
	  width : 900PX;
	  height : 800px;
	  margin : 1em auto;
      background-color: #FDF5E6;
	  border : 10px #CCFF33 double;
	  text-align: center;

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
		<title>Registration page</title>
	</head>
	<body style = "text-align: center;">
   <?php
     if(isset($_GET['MSG']))
     {
     	 echo "<b>" . $_GET['MSG'] . "</b>";
     }
    ?>
     <h2> Welcome to Free Book - Sharing HomePage ! </h2>
     <h3> Please fill out all of the fields </h3>
	 <form action = "register.php" method = "POST">
		<table border="2" align="center">
			<tr><th colspan="2">Registration</th></tr>
			<tr><td>Username</td><td><input type = "text" name ="username"></td></tr>
			<tr><td>Password</td><td><input type = "password" name ="password"></tr>
			<tr><td>Phone</td><td><input type = "text" name ="phone"></tr>
			<tr><td colspan = "2"><input type = "submit" name = "submit" value="Register"></td></tr>
		</table>
	 </form>
	 <?php
	 $servername = 'localhost';
	 $username = 'root';
	 $password = '';
	 $dbname = 'mylibraries';
     
     $conn = mysqli_connect($servername, $username, $password, $dbname);

     if(!$conn)
     {
     	die("connection failed : " . mysqli_connect_error()); 
     }
     
     //echo "Success in connection ! . <br>";
     
     if(isset($_POST['submit']))
     {
     	$username = $_POST['username'];
     	$password = $_POST['password'];
     	$phone = $_POST['phone'];

     	if(empty($username) || empty($password) || empty($phone))
     	{
     		echo "<script>alert('please enter all required fields!')</script>";
     	}

     	$query = "SELECT * FROM user WHERE name='$username' OR phone = '$phone'";
     	$result = mysqli_query($conn, $query);

     	if(mysqli_num_rows($result) > 0)
     	{
     		header("Location:register.php?MSG=Username:$username or Phone:$phone is already exist, Please use another one!");
     	}
     	else 
     	{
     		$query = "INSERT INTO user (name, pass, phone) VALUES ('$username', '$password', '$phone')";
     		if(mysqli_query($conn, $query))
     		{
     			$_SESSION['login'] = $username;
     			$_SESSION['phone'] = $phone;
     			header("Location:index.php");
     		}
     	}
     }
     mysqli_close($conn);
     echo "<p><b><a href='index.php'>go to the Login Page</a></b></p>";
	 ?>
	</body>
</html>