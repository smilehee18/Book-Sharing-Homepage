<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['admin_login']))
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
	  width : 800PX;
	  height : 1500px;
	  margin : 1em auto;
      background-color: #FDF5E6;
	  border : 10px #CCFF33 double;
	  text-align: center;

	}
</style>

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
    
    $sql = "INSERT INTO borrow (username, title, author, state)
	VALUES ('$_SESSION[login]','$_GET[title]','$_GET[author]','NO')";

	$sql1 = "update borrow set return_date = adddate(reg_date, INTERVAL 7 DAY) where (curdate() = return_date);";

	if (mysqli_query($conn, $sql)) {
	} 
	else
	{
		echo "Error: " . $sql . mysqli_error($conn);
	}

    if (mysqli_query($conn, $sql1)) {
	echo "<h3>The Book has been Borrowed Successfully</h3>";
	}

	else {
	echo "Error: "  . mysqli_error($conn);
         }

    $sql2 = "SELECT * FROM borrow order by id DESC";
	$result = mysqli_query($conn, $sql2);

	echo "<table align='center' border='1'>
	<tr>
	<th>ID</th>
	<th>Reg_date</th>
	<th>UserName</th>
	<th>Title</th>
	<th>Author</th>
	<th>Return_Date</th>
	<th>STATE</th>
	</tr>";

	while($row = mysqli_fetch_array($result))
  	{
  	echo "<tr>";
  	echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['reg_date'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['author'] . "</td>";
  	echo "<td>" . $row['return_date'] . "</td>";
  	echo "<td>" . $row['state'] . "</td>";
  	echo "</tr>";
  	}
	echo "</table>";
   
   // $val = "SELECT return_date FROM borrow WHERE "
	echo "<h3> You have to RETURN until 7 DAYS </h3>";
    
    echo "<ul type ='circle'>";
	echo "<li><b><a href='info.php'>go to the back</a></b></li>";
	echo "<li><b><a href='logout.php'>logout</a></b></li>";
	echo "<li><p><b><a href='home.php'>go to the home</a></b></p></li>";
	echo "</ul>";
    mysqli_close($conn);

	?>
</body>
</html>