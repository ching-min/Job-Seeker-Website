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
			applylist
		</title>
	</head>
	
	<body>
	<?php
	if($_SESSION['username'] != null)
	{
		echo "hi " .$_SESSION['username']."<br>";
	?>
	<form action="logout.php" method="POST">
	<button type="submit"> Log out</button>
	</form>
	<h1>Who Applies for Your Job</h1>
	<?php
	/*尋找employ_id*/
		$sql2="SELECT * FROM employer WHERE account=:account";
		$sth2=$db->prepare($sql2);
		$sth2->bindParam(':account',$_SESSION['username']);
		$sth2->execute();
		$result2=$sth2->fetchObject();
		$id=$result2->Id;//將id找出
		//INNER JOIN
		$sql="SELECT * FROM application INNER JOIN recruit
			ON recruit.id=application.recruit_id 
			INNER JOIN user ON application.user_id=user.id
			ORDER BY application.recruit_id";
		$sth=$db->prepare($sql);
		$sth->execute();
		$a=0;
		while($result=$sth->fetchObject()){
			if($id==$result->employ_id)//這個老闆的工作職缺
			{
				if($a!=$result->recruit_id)
				{$a=$result->recruit_id;
					?>
					
					<table border="1">
	<?php			echo"<tr><td>";	
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
					echo"</td><td>";
					echo"</td></tr>";						
					
				}//工作印完
				echo"<tr><td>";
				echo"$result->account";
				echo"</td><td>";					
				echo"$result->gender";
				echo"</td><td>";					
				echo"$result->age";
				echo"</td><td>";					
				echo"$result->education";
				echo"</td><td>";					
				echo"$result->expected_salary";
				echo"</td><td>";					
				echo"$result->phone";
				echo"</td><td>";
				echo"$result->email";
				echo"</td><td>";
				$sql1="SELECT user_specialty.user_id,specialty.specialty FROM `user_specialty` INNER JOIN `specialty` ON user_specialty.specialty_id=specialty.id";
				$sth1=$db->prepare($sql1);
				$sth1->execute();
				while($result1=$sth1->fetchObject()){
						if($result->user_id==$result1->user_id){
							echo$result1->specialty;
							echo"<br>";
						}
				}
				echo'<form action="hire.php" method="POST">';
				echo'<input name="action" type="hidden" value='.$result->recruit_id .'>';
				echo '<input type="submit" name="hire" value="hire"/>';
				echo'</form>';
					
				echo"</td></tr>";
			}	//這個工作結束
			else
			{	?>	
			</table>
			
			<?php	echo"<br>";}
		}
	}//session 成立
	else
	{	//
		echo 'wrong connect......';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
	}
	?>
	<form action="joblist1.php" method="POST">
	<button type="submit"> Back to job vacancy</button>
	</form>
	</body>
	</table>
</html>
	
		