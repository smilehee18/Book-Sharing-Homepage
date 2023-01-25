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
	<title>edit_admin</title>
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
	  width : 700PX;
	  height : 1500px;
	  margin : 1em auto;
      background-color: #FDF5E6;
	  border : 10px #CCFF33 double;
	  text-align: center;
	}
	a
	{
      color: blue;
	}
	.red
	{
	  color: red;
	}
	</style>
</head>
<body>
	<h2>If you want to <a class ='red'>Edit admin profile imformation</a> <br>such as P/W, or PHONE Number,<br> Please Enter your own <a class='red'>PASSWORD</a> again HERE !!</h2><br>
    <form action='edit_admin.php' method='POST'>
    <h2>Your Account : Admin Account </h2>
    <h2>Your P/W : <input type='password' size='10' name='pass'></h2>
    <input type='submit' name='submit' value='Submit'>
    </form>

    <?php
    $servername = "localhost";
	  $username = "root";
	  $password = "";
	  $dbname = "Mylibraries";

      $conn = mysqli_connect($servername, $username, $password, $dbname);

      if(!$conn)
      {
    	die("Connection Failed " . mysqli_connect_error());
      }
    
      if(isset($_POST['submit']))
      {
        $pass = $_POST['pass'];

        $req = " SELECT * FROM admin WHERE pass = '$pass' AND name = '$_SESSION[admin_login]'";
        $sel = mysqli_query($conn,$req);

        if(mysqli_num_rows($sel)>0)
        {   
        	echo "<hr>";
        	echo "<h3 style='color:red';>Please click Submit button, NOT ENTER </h3>";
        	echo "<form action='edit_admin.php' method='POST'>";
        	echo "<h2>New password : <input type='password' name='new'></h2>";
        	echo "<h2>password confirm : <input type='password' name='newnew'></h2>";
        	echo "<input type='submit' name='pass2' value='Submit'>";
        	echo "<hr>";
        	echo "<h2>New PhoneNumber : <input type='text' name='phone' size='15'></h2>";
        	echo "<input type='submit' name='phone2' value='Submit'>";
        	echo "<br></form>";
          }
          else
          {
          	echo "<h3>Wrong Password ! </h3>";
          }
        }

        if(isset($_POST['pass2']))
        {
           $pass1 = $_POST['new'];
           $pass2 = $_POST['newnew'];
           if($pass1 == $pass2)
           {
             echo "<script>alert('Password has been changed')</script>";
             $val = "UPDATE admin SET pass='$pass1' where name = '$_SESSION[admin_login]'";
             mysqli_query($conn,$val);
             $sql = "SELECT * FROM admin WHERE name = '$_SESSION[admin_login]'";
             $sql2 = mysqli_query($conn, $sql);
             if(mysqli_num_rows($sql2)>0)
             {
             	echo "<br><table align ='center' border='1'>
				<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Pass</th>
				<th>Phone</th>
				</tr>";

			while($row = mysqli_fetch_array($sql2))
  			{
  			echo "<tr>";
  			echo "<td>" . $row['id'] . "</td>";
    		echo "<td>" . $row['name'] . "</td>";
    		echo "<td>" . $row['pass'] . "</td>";
    		echo "<td>" . $row['phone'] . "</td>";
  			echo "</tr>";
  			}
	        echo "</table>";
            }

           }
           else
           {
           	echo "<h3 class='red'>Password is not corresponded </h3>";
           }

       }

         if(isset($_POST['phone2']))
         {
         	 $phone = $_POST['phone'];
         	 echo "<script>alert('Phone-Number has been changed')</script>";
             $call = "UPDATE admin SET phone='$phone', pass=pass WHERE name = '$_SESSION[admin_login]'";
             mysqli_query($conn,$call);
             $vall = "SELECT * FROM admin WHERE name = '$_SESSION[admin_login]'";
             $val2 = mysqli_query($conn, $vall);

             if(mysqli_num_rows($val2)>0)
             {
             	echo "<br><table align ='center' border='1'>
				<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Pass</th>
				<th>Phone</th>
				</tr>";

			while($row = mysqli_fetch_array($val2))
  			{
  			echo "<tr>";
  			echo "<td>" . $row['id'] . "</td>";
    		echo "<td>" . $row['name'] . "</td>";
    		echo "<td>" . $row['pass'] . "</td>";
    		echo "<td>" . $row['phone'] . "</td>";
  			echo "</tr>";
  			}
	        echo "</table>";
            }

         }
       echo "<p><b>Do you want to Logout ? <a href ='logout.php'>Logout</a></b></p>";
	   echo "<p><b><a href='home.php'>go to the home</a></b></p>";
    ?>
</body>
</html>