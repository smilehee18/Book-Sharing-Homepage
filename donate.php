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
	<title></title>
	<link href='style/style.css' rel='stylesheet'></link>
</head>
<body>
	<h2 style="text-align:center;"> Thank you for your valuable Donation <br> to Our Free Book-Sharing homepage! </h2> <br><br>

	<form action='ourbooks.php' method='POST'> 
		BookTitle : <input type='text' name = 'title'> <br>
		Author : <input type='text' name = 'author'> <br>
		YourName : <input type = 'text' name = 'name'> <br>
		<input type='submit' value='submit' name='submit'> <br><br><br>
	</form>
    
       <?php
        $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "Mylibraries";

        $conn = mysqli_connect($servername, $username, $password, $dbname);
	
	
	if(isset($_POST['submit']))  //submit 버튼을 눌렀을 때
	{
	   $sql2 = "INSERT INTO ourbook (title, author, registrant)
	   VALUES ('$_POST[title]','$_POST[author]','$_POST[name]')";
	   if (mysqli_query($conn, $sql2)) {
	     echo "<h3> Thank You, <br> Your donation recorded Successfully ! </h3>";
	   } 
	   else
	   {
	     echo "Error: " . $sql . mysqli_error($conn);
	   }
        }

        $sql = "SELECT * FROM ourbook";
	$result = mysqli_query($conn, $sql);

	echo "<table align='center' border='1'>
	<tr>
	<th>ID</th>
	<th>Reg_date</th>
	<th>BookTitle</th>
	<th>Author</th>
	<th>Registrant</th>
	<th>STATE</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
  	{
  	  echo "<tr>";
  	  echo "<td>" . $row['id'] . "</td>";
          echo "<td>" . $row['reg_date'] . "</td>";
          echo "<td>" . $row['title'] . "</td>";
          echo "<td>" . $row['author'] . "</td>";
          echo "<td>" . $row['registrant'] . "</td>";
          echo "<td>" . $row['state'] . "</td>";
  	  echo "</tr>";
  	}
	echo "</table>";
	?>

	<p><b>Do you want to Logout ? <a href ="logout.php">Logout</a></b></p>
	<p><b><a href='home.php'>go to the home</a></b></p>

</body>
</html>
