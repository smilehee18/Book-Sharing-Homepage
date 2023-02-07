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
	<h3> You can search the records </h3>
	 <form action="list.php" method="POST">
	 Select One of the Fields : <select id = "field" name = "sel">
                  <option value = "Title" <?php if(isset($_POST['sel'])) if($_POST['sel'] == "Title") /*선택한 값을 유지하기 위해 작성한 조건문*/
                          echo "selected = 'selected'";?>> Title </option>
                   <option value = "writer" <?php if(isset($_POST['sel'])) if($_POST['sel'] == "writer") 
                          echo "selected = 'selected'";?>> Writer </option>
                       </select>
     <input type="text" name="bname" size="20" value="<?php if(isset($_POST['bname'])) echo "$_POST[bname]";?>">
     <input type="submit" name="submit" value="Search">
     <input type="submit" name="all" value="Show All of the Records">
   </form>
   <br>
	<?php 
	  $con = mysqli_connect("localhost", "root", "", "mylibraries");

 	  if(!$con)
      {
    	   die("Connection Failed " . mysqli_connect_error());
      }
      
      if(isset($_POST['submit']))
      {
      	$sel = $_POST['sel'];
      	if($sel == "Title") {
           $title = $_POST['bname'];
           $sql = "SELECT * FROM sboard WHERE subject LIKE '%$title%' order by id DESC";
           $val = mysqli_query($con, $sql);

         echo "<table width='600' align ='center' border='1'>
	  		<tr>
	  		<th>ID</th>
	  		<th>Writer</th>
	  		<th>IMG</th>
	  		<th>Title</th>
	  		<th>Reg_Date</th>
	  		</tr>";

      	while($row = mysqli_fetch_array($val))
      	{
        		echo "<tr>";
  	     		echo "<td>" . $row['id'] . "</td>";
  	     		echo "<td>" . $row['name'] . "</td>";
  	     		echo "<td> <img src='data:image/jpeg;base64,".base64_encode($row['img_data']) . "'width=100 height=100 /></td>";
         	echo "<td><a href='view.php?id=".$row['id']."'>" . $row['subject'] . "</td>";
         	echo "<td>" . $row['reg_date'] . "</td>";
  	     		echo "</tr>";
      	}
         echo "</table>";
      }
      else if($sel == "writer")
      {
           $writer = $_POST['bname'];
           $sql = "SELECT * FROM sboard WHERE name LIKE '%$writer%' order by id DESC";
           $val = mysqli_query($con, $sql);

         echo "<table width='600' align ='center' border='1'>
	  		<tr>
	  		<th>ID</th>
	  		<th>Writer</th>
	  		<th>IMG</th>
	  		<th>Title</th>
	  		<th>Reg_Date</th>
	  		</tr>";

      	while($row = mysqli_fetch_array($val))
      	{
        		echo "<tr>";
  	     		echo "<td>" . $row['id'] . "</td>";
  	     		echo "<td>" . $row['name'] . "</td>";
  	     		echo "<td> <img src='data:image/jpeg;base64,".base64_encode($row['img_data']) . "'width=100 height=100 /></td>";
         	echo "<td><a href='view.php?id=".$row['id']."'>" . $row['subject'] . "</td>";
         	echo "<td>" . $row['reg_date'] . "</td>";
  	     		echo "</tr>";
      	}
         echo "</table>";
      }
   }
      elseif(isset($_POST['all']))
      {

         $qul = "SELECT * FROM sboard order by id DESC";
         $rres = mysqli_query($con, $qul);

         echo "<table width='600' align ='center' border='1'>
	  		<tr>
	  		<th>ID</th>
	  		<th>Writer</th>
	  		<th>IMG</th>
	  		<th>Title</th>
	  		<th>Reg_Date</th>
	  		</tr>";

      	while($row = mysqli_fetch_array($rres))
      	{
        		echo "<tr>";
  	     		echo "<td>" . $row['id'] . "</td>";
  	     		echo "<td>" . $row['name'] . "</td>";
  	     		echo "<td> <img src='data:image/jpeg;base64,".base64_encode($row['img_data']) . "'width=100 height=100 /></td>";
         	echo "<td><a href='view.php?id=".$row['id']."'>" . $row['subject'] . "</td>";
         	echo "<td>" . $row['reg_date'] . "</td>";
  	     		echo "</tr>";
      	}
         echo "</table>";
      }
      else {

      $sel = "SELECT * FROM sboard order by id DESC";
      $res = mysqli_query($con,$sel);

      echo "<table width='600' align ='center' border='1'>
	  <tr>
	  <th>ID</th>
	  <th>Writer</th>
	  <th>IMG</th>
	  <th>Title</th>
	  <th>Reg_Date</th>
	  </tr>";

      while($row = mysqli_fetch_array($res))
      {
        echo "<tr>";
  	     echo "<td>" . $row['id'] . "</td>";
  	     echo "<td>" . $row['name'] . "</td>";
  	     echo "<td> <img src='data:image/jpeg;base64,".base64_encode($row['img_data']) . "'width=100 height=100 /></td>";
         echo "<td><a href='view.php?id=".$row['id']."'>" . $row['subject'] . "</td>";
         echo "<td>" . $row['reg_date'] . "</td>";
  	     echo "</tr>";
      }
      echo "</table>";
   }
	?>
	<div><a href='write.php'>Write</a></div>
	<ul type ='circle'>
	<li><b><a href='home.php'>go to the Home</a></b></li>
	<li><b><a href='logout.php'>logout</a></b></li>
	</ul>
</body>
</html>
