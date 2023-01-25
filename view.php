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

 if(isset($_GET['id'])) 
    {
 	$id = $_GET['id'];
 	$id =  stripslashes($id);
 	$id = trim($id,"'");

 	$sel = "SELECT * FROM sboard WHERE id='$id'";
  $val2 = mysqli_query($con,$sel);
 	$row = mysqli_fetch_array($val2);
   }  
 
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>view.php</title>
	<style>
	div
	{
		text-align: center;
	}
	html 
	{
	  background-color : #FFE4B5;
	  background-image: url('https://cdn.pixabay.com/photo/2017/01/31/00/09/books-2022464_960_720.png');
	  background-repeat : no-repeat;
	  background-position: right top;
	}
	body
	{
	  width : 1000px;
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
    padding: 10px;
    text-align: center;
  }
	</style>
</head>
<body>    
	    <form action="writepost.php" method="POST">
	        <table align='center' width='500' border='1' cellpadding=5>
	    <tr>
			<th> UserName </th>
			<td><?=$row['name']?></td>
			</tr>
	    <tr>
			<th> Title </th>
			<td><?=$row['subject']?></td>
			</tr>
			<tr>
			<th> Image </th>
			<td><?php echo"<img src='data:image/jpeg;base64,".base64_encode($row['img_data']) ."'width=300 height=400 />"?></td>
			</tr>
			<tr>
				<th> Memo </th>
				<td><?=$row['memo']?></td>
		</tr>
		<tr> <td colspan="2">

			<?php 
			if(isset($_SESSION['login'])) {
			if($row['name'] == $_SESSION['login']) {
			echo "<div style='text-align:center;'>
				   <a href='delrecord.php?id=$id'>Delete Record</a>
				   <a href='write.php?id=$id'>Edit Record</a>
           <a href='list.php'>Go to the List</a>
			</div></td>"; 
		  }
		  else
		  {
			  echo "<div style='text-align:center;'>
           <a href='list.php'>Go to the List</a>
			     </div></td>"; 
		  }
		}
		elseif(isset($_SESSION['admin_login']))
		{
			echo "<div style='text-align:center;'>
				   <a href='delrecord.php?id=$id'>Delete Record</a>
				   <a href='write.php?id=$id'>Edit Record</a>
           <a href='list.php'>Go to the List</a>
			     </div></td>"; 
		}
		?>
		</tr>
	</table>
	</form>
	<br>
	<h3>You can write some comments here Up to 5 lines</h3>
	<form action="view.php?id='<?=$id?>'" method="POST">
				<textarea name="comment" cols="60" rows="15" placeholder="Input text" style="width:70%; height:30px;"></textarea>
				<input type="submit" name="save" value="save"> 
	</form>
	<?php
	  if(isset($_POST['save']) || isset($_POST['comment']))
  	{
  		$id = $_GET['id'];
 	    $id =  stripslashes($id);
 	    $id = trim($id,"'");

      $comment = $_POST['comment'];
      if(isset($_SESSION['login'])) {
      $ql = "INSERT INTO comment (memo_id, content, name) VALUES ('$id', '$comment','$_SESSION[login]')";
    }
      elseif(isset($_SESSION['admin_login']))
      {
      	$ql = "INSERT INTO comment (memo_id, content, name) VALUES ('$id', '$comment','$_SESSION[admin_login]')";
      }
      mysqli_query($con,$ql);
      $qul = "SELECT * FROM comment WHERE memo_id='$id'";
      $val2 = mysqli_query($con,$qul);


 	    $id =  stripslashes($id);
     	$id = trim($id,"'");
     }

     $qul = "SELECT * FROM comment WHERE memo_id='$id'";
     $val = mysqli_query($con,$qul);

	   echo "<table align='center' border='1'>
	           <tr><th>Name</th><th>Comment</th><th>Reg_Date</th><th>Delete?</th></tr>";

		  while($mow = mysqli_fetch_array($val))
  	  {
  		echo "<tr>";
  		echo "<td>" . $mow['name'] . "</td>";
   		echo "<td>" . $mow['content'] . "</td>";
    	echo "<td>" . $mow['reg_date'] . "</td>";
       
      if(isset($_SESSION['login'])) {
    	if($_SESSION['login'] == $mow['name']) {
    		echo "<td><a href='com_delete.php?id=".$mow['id']."&memo_id=". $mow['memo_id'] . "'>delete</a></td>";
      }
    }
      elseif(isset($_SESSION['admin_login']))
      {
      	echo "<td><a href='com_delete.php?id=".$mow['id']."&memo_id=". $mow['memo_id'] . "'>delete</a></td>";
      }
    	echo "<tr>";
  	}
  	echo "</table>";
  ?>
</body>
</html>