<?php
session_save_path("/amd/cs/102/.../public_html");
session_start();
$user=$_POST['email'];
$password=$_POST['password'];
$db_host= "dbhome.cs.nctu.edu.tw";//connect
$db_name= "...";
$db_user= "...";
$db_password= "...";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);

?>
<!doctype html>
<html lang="en">
	
	<head>
		<title>
			favorite list
		</title>
	</head>
	<table border="1">
	<body>
	<?php
		if($_SESSION['username'] != null)
		{//
			echo "hi " .$_SESSION['username']."<br>";
			echo" Favorite List<br>";
			/*尋找employ_id*/
			$sql2="SELECT * FROM user WHERE account=:account";
			$sth2=$db->prepare($sql2);
			$sth2->bindParam(':account',$_SESSION['username']);
			$sth2->execute();
			$result2=$sth2->fetchObject();
			$id=$result2->id;//將id找出
			
			$sql="SELECT * FROM recruit INNER JOIN favorite
			ON recruit.id=favorite.recruit_id";
			
			$sth=$db->prepare($sql);
			$sth->execute();
			echo"<tr><td>ID</td><td>Occupation</td><td>Location</td><td>Work Time</td><td>Education Required</td><td>Minimun Of Working Experience</td><td>Salary Per Month</td><td>Operation</td></tr><br>";
			while($result=$sth->fetchObject()){//
				if($id==$result->user_id)
				{
					echo"<tr><td>";
					echo"$result->recruit_id";
					echo"</td><td>";
					
					//occupation
					$sql2="SELECT * FROM `occupation` WHERE Id=:Id";
					$sth2=$db->prepare($sql2);
					$sth2->bindParam(':Id',$result->occupation_id);
					$sth2->execute();
					$result2=$sth2->fetchObject();
					echo "$result2->occupation";
					echo"</td><td>";
					//location
					$sql2="SELECT * FROM `location` WHERE Id=:id";
					$sth2=$db->prepare($sql2);
					$sth2->bindParam(':id',$result->location_id);
					$sth2->execute();
					$result2=$sth2->fetchObject();
					echo"$result2->location";				
					echo"</td><td>";					
					echo"$result->working_time";
					echo"</td><td>";
					echo"$result->education";
					echo"</td><td>";
					if($result->experience==6)
					echo "NO experience required";
				else if($result->experience==1)
					echo"1 year";
				else if($result->experience==2)
					echo"2 years";
				else if($result->experience==3)
					echo"3 years";
				else if($result->experience==4)
					echo"4 years";
				else if($result->experience==5)
					echo"5 years";
				else if($result->experience==10)
					echo"10 years";			
					//salary
					echo"</td><td>";					
					echo"$result->salary";
					echo"</td><td>";						
					echo'<form action="delete_fav.php" method="POST">';
					echo'<input name="action" type="hidden" value='.$result->user_id .'>';
					echo'<input name="v" type="hidden" value='.$result->recruit_id .'>';
					echo '<input type="submit" name="deletefav" value="delete"/>';
					echo'</form>';
					
					echo"</td></tr>";
				}
			}
				
			?>
				<body>
				
				<form action="logout.php" method="POST">
				<button type="submit"> Log out</button>
				</form>
				
				<form action="joblist2.php" method="POST">
				<button type="submit"> back to job vacancy</button>
				</form>
				
				</body>
				</html>
		<?php	}//
			else
			{	//
				echo 'wrong connect......';
				echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
			}//	?>
	</body>
	</table>
</html>