<!DOCTYPE html>
<?php
session_start();
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit_users</title>
	<link href='style/style.css' rel='stylesheet'></link>
</head>
<body>
	<?php include 'name.php';?>
    <h2>If you want to <a class ='red'>Edit your profile imformation</a> <br>such as P/W, or PHONE Number,<br> Please Enter your own <a class='red'>PASSWORD</a> again HERE !!</h2><br>
    <form action='edit_users.php' method='POST'>
    <h2>Your UserName : <?= $_SESSION['login'] ?> </h2>
    <h2>Your P/W : <input type='password' size='10' name='pass'></h2>
    <input type='submit' name='submit' value='Submit'>
    <input type ="submit" name ="show" value="Show my Profile">
    </form>

    <?php
	  $conn = mysqli_connect('localhost', 'root', '', 'Mylibraries');
		if(!$conn)
    {
    	die("Connection Failed " . mysqli_connect_error());
    }
    
      if(isset($_POST['submit']))
      {
        $pass = $_POST['pass'];

        $req = " SELECT * FROM user WHERE pass = '$pass' AND name = '$_SESSION[login]'";
        $sel = mysqli_query($conn,$req);
        if(mysqli_num_rows($sel)>0)
        { 
        	echo "<hr>";
        	echo "<h3 style='color:red';>Please click Submit button, NOT ENTER </h3>";
        	echo "<form action='edit_users.php' method='POST'>";
        	echo "<h2>New password : <input type='password' name='new'></h2>";
        	echo "<h2>password confirm : <input type='password' name='newnew'></h2>";
        	echo "<input type='submit' name='pass2' value='Submit'>";
        	echo "<hr>";
        	echo "<h3 style='color:red';>Please click Submit button, NOT ENTER </h3>";
        	echo "<h2>New PhoneNumber : <input type='text' name='phone'></h2>";
        	echo "<input type='submit' name='tel' value='Submit'>";
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
             $val = "UPDATE user SET pass='$pass1' WHERE name = '$_SESSION[login]'";
             mysqli_query($conn,$val);
             mysqli_close($conn);
            }
           else
           {
           	echo "<h3 class='red'>Password is not corresponded </h3>";
           }

       }

         if(isset($_POST['tel']))
         {
         	 	$phone = $_POST['phone'];
    				$sql = "UPDATE user SET phone='$phone',pass=pass WHERE name='$_SESSION[login]'";
    				if(mysqli_query($conn,$sql))
    				{
       					echo "<script>alert('Phone-Number has been changed')</script>";
       					mysqli_close($conn);
            }
         }

         if(isset($_POST['show']))
         { 
         	  $conn = mysqli_connect('localhost', 'root', '', 'Mylibraries');
						 if(!$conn)
      			 {
    						die("Connection Failed " . mysqli_connect_error());
      			 }
           $sql = "SELECT * FROM user WHERE name = '$_SESSION[login]'";
           $val2 = mysqli_query($conn,$sql);
           if(mysqli_num_rows($val2) > 0)
             {
             	echo "
             	<br><table align ='center'border='1'>
				    
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
           		 mysqli_close($conn);
           }
         echo "<p><b>Do you want to Logout ? <a href ='logout.php'>Logout</a></b></p>";
	       echo "<p><b><a href='home.php'>go to the home</a></b></p>";
    ?>
</body>
</html>
