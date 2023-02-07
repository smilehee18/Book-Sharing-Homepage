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

$con = mysqli_connect("localhost", "root", "", "mylibraries");

 if(!$con)
 {
   die("Connection Failed " . mysqli_connect_error());
 }
  
 if(isset($_GET['id'])) {
 $id = $_GET['id'];
 $id = mysqli_real_escape_string($con, $id);

 $sql = "SELECT * FROM sboard WHERE id = '$id'";
 $res = mysqli_query($con,$sql);
 $row = mysqli_fetch_array($res);
}

  if(isset($_POST['submit'])) {
   if(empty($_POST['subject'])||empty($_POST['memo']))
      {
        echo "<script>alert('Please fill out Title and Memo')</script>";
      }
   else
   {
   	  header("Location:writepost.php");
   }
 }
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>write.php</title>
	<link href='style/style.css' rel='stylesheet'></link>
</head>

<body>    
	    <form action="writepost.php" method="POST" enctype="multipart/form-data">
	    	<input type="text" name="id" value="<?php if(isset($_GET['id'])) echo $id; ?>">
	        <table align='center' width='500' border='1' cellpadding=5>
	        <tr>
			<th> Title </th>
			<td> <input type ="text" name="subject" value="<?php if(isset($_GET['id'])) echo $row['subject'];?>"style="width:100%;"></td>
			</tr>
			<tr>
				<th> Memo </th>
				<td> <input type="textarea" name="memo" cols="50" rols="50" value="<?php if(isset($_GET['id'])) echo $row['memo'];?>" style="width:100%; height:300px;"></td>
		    </tr>
		    <tr>
		    	<th> Image </th>
		    	<td>
   				File : <input type = "file" name = "image">
   				<?php if(isset($_GET['id'])) echo "<img src='data:image/jpeg;base64,".base64_encode($row['img_data']) ."'width=300 height=400/>" ?>
   			 </td>
		   </tr>
		<tr> <td colspan="2">
			<div style="text-align:center;">
				       <input type="submit" value="Save" name="submit">
               <a href="list.php">Go to the List</a>
			</div></td>
		</tr>
	</table>
	</form>
</body>
</html>
