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
	<title>Delete.php</title>
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
	  width : 1000PX;
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
	<h2> Hello, <?php if(isset($_SESSION['admin_login'])) echo $_SESSION['admin_login']; else if(isset($_SESSION['login'])) echo $_SESSION['login']; ?> !<br>
	Your Borrowed Book List is... </h2>

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
    
    if(isset($_SESSION['login'])) {
    	$req = "SELECT * FROM borrow WHERE username = '$_SESSION[login]'";
    }
    else if(isset($_SESSION['admin_login']))
    {
    	$req = "SELECT * FROM borrow WHERE username = '$_SESSION[admin_login]'";
    }
    $sum = mysqli_query($conn,$req);

    if(mysqli_num_rows($sum)>0)
    {
    echo "<table align='center' border='1'>
	<tr>
	<th>NO</th>
	<th>Reg_date</th>
	<th>UserName</th>
	<th>Title</th>
	<th>Author</th>
	<th>Return_Date</th>
	<th>STATE</th>
	<th>DELETE</th>
	</tr>";

	while($row = mysqli_fetch_array($sum))
  	{
  	echo "<tr>";
  	echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['reg_date'] . "</td>";
    echo "<td>" . $row['username'] . "</td>";
    echo "<td>" . $row['title'] . "</td>";
    echo "<td>" . $row['author'] . "</td>";
  	echo "<td>" . $row['return_date'] . "</td>";
  	echo "<td>" . $row['state'] . "</td>";
  	echo "<td><a href='book_delete.php?id=".$row['id']."&title=". $row['title'] ."&author=".$row['author']."'>Return</a></td>";
  	echo "</tr>";
  	}
	echo "</table>";
    }
    else
    {
    	echo "<h3 style='color:red;'>There are any book records you borrowed</h3>";
    }
    
    echo "<p><b>Do you want to Logout ? <a href ='logout.php'>Logout</a></b></p>";
	echo "<p><b><a href='home.php'>go to the home</a></b></p>";

	?>
</body>
</html>
