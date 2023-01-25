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