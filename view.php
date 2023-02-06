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
	<link href='style/style.css' rel='stylesheet'></link>
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
            if(isset($_SESSION['login'])) { //로그인한 사람이 사용자일 때
             $ql = "INSERT INTO comment (memo_id, content, name) VALUES ('$id', '$comment','$_SESSION[login]')";
           }
		  
           elseif(isset($_SESSION['admin_login'])) //로그인한 사람이 관리자일 때
          {
      	     $ql = "INSERT INTO comment (memo_id, content, name) VALUES ('$id', '$comment','$_SESSION[admin_login]')";
          }
          mysqli_query($con,$ql);
          $qul = "SELECT * FROM comment WHERE memo_id='$id'"; //게시글의 댓글을 불러오기 위한 쿼리문, 즉 게시글의 id가 일치해야 한다
          $val2 = mysqli_query($con,$qul);

          $id =  stripslashes($id);
          $id = trim($id,"'");
         }

         $qul = "SELECT * FROM comment WHERE memo_id='$id'";
         $val = mysqli_query($con,$qul);

	   echo "<table align='center' border='1'>
	   <tr><th>Name</th><th>Comment</th><th>Reg_Date</th><th>Delete?</th></tr>";

	  while($mow = mysqli_fetch_array($val))  //fetch해서 한 줄 한 줄 읽어온다
  	  {
  		echo "<tr>";
  		echo "<td>" . $mow['name'] . "</td>";
   		echo "<td>" . $mow['content'] . "</td>";
    	        echo "<td>" . $mow['reg_date'] . "</td>";
       
               if(isset($_SESSION['login'])) { //로그인한 세션이 있을 때, 즉 사용자이고
    	       if($_SESSION['login'] == $mow['name']) {  //로그인한 사용자의 이름과 글쓴이의 이름이 일치한다면,
    		echo "<td><a href='com_delete.php?id=".$mow['id']."&memo_id=". $mow['memo_id'] . "'>delete</a></td>"; //표의 마지막 열에 삭제할 수 있는 링크 추가
                  }
                 }
             elseif(isset($_SESSION['admin_login'])) //만약 관리자로 로그인했다면,
             {
      	        echo "<td><a href='com_delete.php?id=".$mow['id']."&memo_id=". $mow['memo_id'] . "'>delete</a></td>"; //삭제 링크 당연히 추가
             }
    	     echo "<tr>";//행 출력
  	}
  	echo "</table>"; //테이블 출력의 끝지점
  ?>
</body>
</html>
