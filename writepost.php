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
	
 if(isset($_POST['submit'])) {
	if(!empty($_POST['id'])) 
	{
		  $con = mysqli_connect("localhost", "root", "", "mylibraries");

        if(!$con)
       {
        	die("Connection Failed " . mysqli_connect_error());
       }

		   $subject = $_POST['subject'];
	     $memo = $_POST['memo'];
	     $id = $_POST['id'];

	     $subject = mysqli_real_escape_string($con, $subject);
	     $memo = mysqli_real_escape_string($con, $memo);
	     $id = mysqli_real_escape_string($con, $id);
      
       if(!empty($_FILES['image']['name'])) {

       $image_name = addslashes($_FILES['image']['name']);
       $image_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
       $image_size = getimagesize($_FILES['image']['tmp_name']);

       if($image_size == FALSE)
       {
          header("Location:view.php?". $_POST['id']);
       }
       else
       {
         $sql = "UPDATE sboard SET subject='$subject', memo='$memo', img_data='$image_data' WHERE id = '$id'";
         if(!mysqli_query($con,$sql))
         {
           echo "Problem in Uploading Image ! " . mysqli_error($con);
         }
         else 
         {
  	   	    header("Location:list.php");
         }
     }
   }
   else {
         $sql = "UPDATE sboard SET subject='$subject', memo='$memo' WHERE id = '$id'";
         if(!mysqli_query($con,$sql))
         {
           echo "Problem in Update Record " . mysqli_error($con);
         }
         else 
         {
            header("Location:view.php?id=".$_POST['id']);
         }
       }
      }

    else {
    	  $con = mysqli_connect("localhost", "root", "", "mylibraries");

       if(!$con)
       {
    	     die("Connection Failed " . mysqli_connect_error());
       }

    	 $subject2 = $_POST['subject'];
	     $memo2 = $_POST['memo'];


	     $subject2 = mysqli_real_escape_string($con, $subject2);
	     $memo2 = mysqli_real_escape_string($con, $memo2);
       
      if(!empty($_FILES['image']['name'])) {
  	  ($_FILES['image']['name']);
  
       $image_name = addslashes($_FILES['image']['name']);
       $image_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
       $image_size = getimagesize($_FILES['image']['tmp_name']);

       if($image_size == FALSE)
       {
          echo "<h2>That's not an image file.</h2>";
       }
       else
       {
         if(isset($_SESSION['login'])) {
         $sql = "INSERT INTO sboard (subject,memo,name,img_data) VALUES ('$subject2','$memo2','$_SESSION[login]','$image_data')";
       }
         elseif(isset($_SESSION['admin_login'])) {
          $sql = "INSERT INTO sboard (subject,memo,name,img_data) VALUES ('$subject2','$memo2','$_SESSION[admin_login]','$image_data')";
       }
         if(!mysqli_query($con,$sql))
         {
           echo "Problem in Uploading Image ! " . mysqli_error($con);
         }
         else 
         {
            echo "<h2> Newly uploaded image : $image_name </h2>";
            echo "<img src='get.php?name=$image_name' width='250' height='200'>";
  	   	 header("Location:list.php");
         }
       }
     }
     else 
     {
       $sql = "INSERT INTO sboard (subject,memo,name) VALUES ('$subject2','$memo2','$_SESSION[login]')";
         if(!mysqli_query($con,$sql))
         {
           echo "Problem in Uploading Image ! " . mysqli_error($con);
         }
         else 
         {
            echo "<h2> Newly uploaded image : $image_name </h2>";
            echo "<img src='get.php?name=$image_name' width='250' height='200'>";
         header("Location:list.php");
         }
     }
  	}
  }

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>writepost.php</title>
</head>
<body>
 <li><b><a href='home.php'>go to the Home</a></b></li>
</body>
</html>