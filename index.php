<!DOCTYPE html>
<?php
session_start();
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
	  width : 800PX;
	  height : 1500px;
	  margin : 1em auto;
      background-color: #FDF5E6;
	  border : 10px #CCFF33 double;
	  text-align: center;
	}
    .red
    {
        color: red;
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body style="text-align:center">
    <h2> Welcome to Free Book-Sharing Homepage ! </h2>
    <h3> Before you access this Site, You have to <a class='red'>LOGIN</a> first. </h3>

    <img src='https://cdn.pixabay.com/photo/2020/05/07/17/59/bookshelves-5142509_960_720.png' width='300' heigth='300' align='center'>
    <br><br>
	<form action="index.php" method="POST">
		<table border="2" align="center"> 
       <tr>
           <th colspan="2" align="center"> Login to Free-Sharing Library ! </th>
        </tr>
        <tr>
            <td width="100"> UserName </td>
            <td> <input type="text" name="username" > </td>
       </tr>
       <tr>
            <td width="100"> Password </td>
            <td> <input type="password" name="password" > </td>
       </tr>
       <tr>
            <td colspan="2" align="center"> <input type="submit" name="submit" value="Login" > </td>
       </tr>
   </table>
	</form>
	 <p><b> Not Registered Yet? <a href="register.php">-> Registeration <-</a></b></p>
     <p><b> Admin Login : <a href='admin_login.php'>-> Admin <-</a></b></p>
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
     
     if(isset($_POST['submit'])) 
     {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($_POST['username']))
        {
        	echo "<script> alert('Please enter your name !') </script>";
        }
        if(empty($_POST['password']))
        {
           echo "<script> alert('Please enter your password !') </script>";
        }

        $query = "SELECT name, pass FROM user WHERE name = '$username' AND pass = '$password'";
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result) > 0)
        {
        	$_SESSION['login'] = $username;
        	$_SESSION['phone'] = $phone;
        	header("Location: home.php");
        }
        else
        {
        	echo "<h3 style='color:red'>wrong username or password !</h3>";
        }
     }
     mysqli_close($conn);
    ?>
    </body>
</html>