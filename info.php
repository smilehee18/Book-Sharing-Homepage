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
	<title></title>
</head>
<body>
    <h2> You can Borrow the Book you want here !! </h2>

	 <form action='info.php' method='POST'> 
		Title : <input type='text' name = 'title'> <br>
		Author : <input type='text' name = 'author'> <br>
		<input type='submit' value='submit' name='submit'> <br>
		<br>
	</form>
    <hr><hr>
	<br><h2> You can search the books which you will borrow HERE 
	<br>Be Careful that You can borrow books <br> ONLY &lt; STATE is YES &gt; on this TABLE</h2><br> 
	<h3> ======= Select the field from the drop box ======= </h3>
	<form action = "info.php" method = "POST">
            Select One of the Fields : <select id="field" name = "sel">
                  <option value = "Title" <?php if(isset($_POST['sel'])) if($_POST['sel'] == "Title") /*선택한 값을 유지하기 위해 작성한 조건문*/
                          echo "selected = 'selected'";?>> Title </option>
                   <option value = "Register" <?php if(isset($_POST['sel'])) if($_POST['sel'] == "Register") 
                          echo "selected = 'selected'";?>> Registrant </option>
                   <option value = "state" <?php if(isset($_POST['sel'])) if($_POST['sel'] == "state") 
                          echo "selected = 'selected'";?>> State </option>
                  </select>
		<input type='text' size='20' name='search' value='<?php if(isset($_POST['search'])) echo "$_POST[search]";?>'>
		<input type='submit' name='submit2' value='search'>
		<input type='submit' name='all' value='Show All of the list'>
		<br>
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
    
    if(isset($_POST['submit2']))
    {
      $sel = $_POST['sel'];
      if($sel == "Title")
      {
      	$bname = $_POST['search'];
        if(empty($_POST['search']))
        {
      	  echo "<script> alert('Please enter the Title !!')</script>";
        }
        else 
       {
      	$query = "SELECT * FROM ourbook WHERE title like '%$bname%'";
      	$result = mysqli_query($conn, $query);
      	if(mysqli_num_rows($result) > 0)
      	{
      		echo "<table align ='center' border='1'>
			<tr>
			<th>ID</th>
			<th>Reg_date</th>
			<th>Title</th>
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
      	}
      	else
      	{
      		echo "<h3> Sorry, The book you searched doesn't exist on our book-sharing homepage</h3>";
      	}
      }
    }
    if($sel == "Register")
    {
    	  $reg = $_POST['search'];
        if(empty($_POST['search']))
        {
      	  echo "<script> alert('Please enter the registrant name !!')</script>";
        }
        else 
       {
      	 $query = "SELECT * FROM ourbook WHERE registrant like '%$reg%'";
      	 $result = mysqli_query($conn, $query);
      	 if(mysqli_num_rows($result) > 0)
      	{
      		echo "<table align ='center' border='1'>
			<tr>
			<th>ID</th>
			<th>Reg_date</th>
			<th>Title</th>
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
      	}
      	else
      	{
      		echo "<h3> Sorry, The book you searched doesn't exist on our book-sharing homepage</h3>";
      	}
      }
    }
    if($sel == "state")
    {
    	  $state = $_POST['search'];
        if(empty($_POST['search']))
        {
      	  echo "<script> alert('Please enter the registrant name !!')</script>";
        }
        else 
       {
      	 $query = "SELECT * FROM ourbook WHERE state like '%$state%'";
      	 $result = mysqli_query($conn, $query);
      	 if(mysqli_num_rows($result) > 0)
      	{
      		echo "<table align ='center' border='1'>
			<tr>
			<th>ID</th>
			<th>Reg_date</th>
			<th>Title</th>
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
      	}
      	else
      	{
      		echo "<h3> Sorry, The book you searched doesn't exist on our book-sharing homepage</h3>";
      	}
      }
    }
  }

     if(isset($_POST['submit'])) {

    	$title = $_POST['title'];
    	$author = $_POST['author'];
    	$veri = "SELECT * FROM ourbook WHERE title = '$title' AND state = 'NO'";
    	$res2 = mysqli_query($conn,$veri);
    	if(empty($title)||empty($author))
    	{
    		echo "<script> alert('Please enter the Title and Author Name!')</script>";
    	}
    	else if(mysqli_num_rows($res2)>0)  {
    		echo "<script> alert('This book has borrowed by someone!')</script>";
    	}
    	else
    	{
    		$sel = "SELECT * FROM ourbook WHERE title = '$title' AND author ='$author'";
    		$sum = mysqli_query($conn,$sel);
    		if(mysqli_num_rows($sum)>0)
    		{
    			header("Location:sql.php?title=".$title."&author=" . $author);
    			$val = "UPDATE ourbook SET state='NO' WHERE title='$title'";
    			mysqli_query($conn,$val);
    		}
    		else
    		{
    			echo "<script>alert('Wrong Title Name or Author Name !')</script>";
    		}
    	}
    }

      if(isset($_POST['all']))
      {
      	$query2 = "SELECT * FROM ourbook";
      	$result2 = mysqli_query($conn, $query2);
      	if(mysqli_num_rows($result2) > 0)
      	{
      		echo "<table align ='center' border='1'>
			<tr>
			<th>ID</th>
			<th>Reg_date</th>
			<th>Title</th>
			<th>Author</th>
			<th>Registrant</th>
			<th>STATE</th>
			</tr>";

			while($row = mysqli_fetch_array($result2))
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
      	}
      }
      echo "<p><b><a href='home.php'>go to the home</a></b></p>";
      echo "<p><b>Do you want to Logout ? <a href ='logout.php'>Logout</a></b></p>";
	?>
</body>
</html>