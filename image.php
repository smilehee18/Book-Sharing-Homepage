<!DOCTYPE html>
<html>
<head>
<title> Image Uploading Example </title>
</head>
<body>
   <form action = "image.php" method = "POST" enctype="multipart/form-data">
   File : <input type = "file" name = "image">
   <input type = "submit" name ="submit" value = "Upload">
   </form>

   <?php 
   $con = mysqli_connect('localhost','root','', 'mylibraries') or die (mysqli_connect_error());

   $olds = mysqli_query($con, "SELECT * FROM images");

   if(isset($_POST['submit']))
   {
     if(empty($_FILES['image']['name']))
     {
       echo "<h2>Please Select an Image ! </h2>";
     } 
     else 
     {
       $image_name = addslashes($_FILES['image']['name']);
       $image_data = addslashes(file_get_contents($_FILES['image']['tmp_name']));
       $image_size = getimagesize($_FILES['image']['tmp_name']);

       if($image_size == FALSE)
       {
          echo "<h2>That's not an image file.</h2>";
       }
       else
       {
         $sql = "INSERT INTO sboard VALUES ('$img_data')";
         if(!mysqli_query($con,$sql))
         {
           echo "Problem in Uploading Image ! " . mysqli_error($con);
         }
         else 
         {
            echo "<h2> Newly uploaded image : $image_name </h2>";
            echo "<img src='get.php?name=$image_name' width='250' height='200'>";
         }
       }
     }
   }

   echo "<h2>Previously uploaded Pictures </h2>";
   while($one = mysqli_fetch_array($olds))
   {
      echo "<img src='data:image/jpeg;base64,".base64_encode($one['data']) . "'width=300 height=300 />";
      echo "<a href='deleteimg.php?id=" . $one['id'] . "'>Delete</a><br>";
   }
   ?>

</body>
</html>