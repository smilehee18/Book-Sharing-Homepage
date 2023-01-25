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
	  width : 800PX;
	  height : auto;
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
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Book-Sharing</title>
</head>
<body>
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
    
    $sql = "INSERT INTO ourbook (title, author, registrant)
	VALUES ('$_POST[title]','$_POST[author]','$_POST[name]')";

	if (mysqli_query($conn, $sql)) {
	echo "<h3> Thank You, <br> Your donation recorded Successfully ! </h3>";
	} 
	else
	{
		echo "Error: " . $sql . mysqli_error($conn);
	}

   $sql2 = "SELECT * FROM ourbook";
	$result = mysqli_query($conn, $sql2);

	echo "<table align ='center' border='1'>
	<tr>
	<th>ID</th>
	<th>Reg_date</th>
	<th>Title</th>
	<th>Author</th>
	<th>Registrant</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
  	{
  	echo "<tr>";
  	echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['reg_date'] . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['author'] . "</td>";
    echo "<td>" . $row['registrant'] . "</td>";
  	echo "</tr>";
  	}
	echo "</table>";
    
    echo "<ul type ='circle'>";
	echo "<li><b><a href='donate.php'>go to the back</a></b></li>";
	echo "<li><b><a href='logout.php'>logout</a></b></li>";
	echo "<li><p><b><a href='home.php'>go to the home</a></b></p></li>";
	echo "</ul>";
    mysqli_close($conn);

	?>

</body>
</html>