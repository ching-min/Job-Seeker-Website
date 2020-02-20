<?php
session_save_path("/amd/cs/102/.../public_html");
session_start(); 
if($_SESSION['username'] != null)
{
	echo "hi ".$_SESSION['username']."!!<br>";//印出上方列
	$db_host= "dbhome.cs.nctu.edu.tw";//database connect
	$db_name= "...";
	$db_user= "...";
	$db_password= "...";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);//database connect
	$db->query('SET NAMES "utf8")');
	/*尋找employ_id*/
	$sql2="SELECT * FROM user WHERE account=:account";
	$sth2=$db->prepare($sql2);
	$sth2->bindParam(':account',$_SESSION['username']);
	$sth2->execute();
	$result2=$sth2->fetchObject();
	$id=$result2->id;//將id找出
 ?>

<!doctype html>
<html lang="en">
	<form action="logout.php" method="POST">
		<button type="submit"> Log Out</button>
	</form>
	<h1>Job Vacancy</h1>
	<form method=post action='search_jb.php'>
	Occupation<select name="occupation"></option>
		<option value=""> </option>
		<?php 
			$db_host= "dbhome.cs.nctu.edu.tw";//connect
			$db_name= "...";
			$db_user= "...";
			$db_password= "...";
			$dsn= "mysql:host=$db_host;dbname=$db_name";
			$db=new PDO($dsn,$db_user,$db_password);
			$sql1="SELECT * FROM `occupation` ";
			$sth1=$db->prepare($sql1);
			$sth1->execute();
			
			while($result1=$sth1->fetchObject()){				
				echo"<option value=".$result1->Id .">".$result1->occupation ."</option>";				
			}
		?>
		</select>
	Location<select name="location"></option>
		<option value=""> </option>
		<?php 
			$db_host= "dbhome.cs.nctu.edu.tw";//connect
			$db_name= "...";
			$db_user= "...";
			$db_password= "...";
			$dsn= "mysql:host=$db_host;dbname=$db_name";
			$db=new PDO($dsn,$db_user,$db_password);
			$sql4="SELECT * FROM `location` ";
			$sth4=$db->prepare($sql4);
			$sth4->execute();
			
			while($result4=$sth4->fetchObject()){			
				echo"<option value=". $result4->Id . ">" . $result4->location . "</option>";				
			}
		?>
		</select>
	work time<select name="work_time"></option>
			<option value=""> </option>
			<option value="morning">morning</option>
			<option value="night">night</option>
	</select>
	education<select name="edu">
			<option value=""> </option>
			<option value="Elementary School">Elementary School</option>
			<option value="Junior High School">Junior High School</option>
			<option value="Senior High School">Senior High School</option>
			<option value="Undergraduate School">Undergraduate School</option>
			<option value="Graduate School">Graduate School</option>
	</select>
	experience<select name="exp">
		<option value=""> </option>
		<option value="6">No experience required</option>
		<option value="1">1 year</option>
		<option value="2">2 years</option>
		<option value="3">3 years</option>
		<option value="4">4 years</option>
		<option value="5">5 years</option>
		<option value="10">10 years</option>
	</select>
	salary<select name="salary">
		<option value=""> </option>
		<option value="10000"><10000</option>
		<option value="20000"><20000</option>
		<option value="30000"><30000</option>
		<option value="40000">30000+</option>
	</select>
	<input type="submit"name="dosearch"value="search"><br>
	</form>
	<table border="1">
	<body>
		
		<?php 
			
			echo"order by:";
			echo'<form action="joblist2.php" method="POST">';
			echo'<input name="action" type="hidden" value="up">';
			echo'<input type="submit" name="up" value="up"/>';
			echo'</form>';
			echo'<form action="joblist2.php" method="POST">';
			echo'<input name="action" type="hidden" value="down">';
			echo'<input type="submit" name="down" value="down"/>';
			echo'</form>';
		?>
		<?php
			$user=$_POST['email'];
			$password=$_POST['password'];
			$db_host= "dbhome.cs.nctu.edu.tw";//connect
			$db_name= "...";
			$db_user= "...";
			$db_password= "...";
			$dsn= "mysql:host=$db_host;dbname=$db_name";
			$db=new PDO($dsn,$db_user,$db_password);
			$action=$_POST['action'];
			if($action=="up"){$sql="SELECT * FROM recruit ORDER BY salary ,id ";}
			else if($action=="down"){$sql="SELECT * FROM recruit ORDER BY salary  DESC,id DESC ";}
			else{$sql="SELECT * FROM recruit ORDER BY id  "; }
			//$sql="SELECT * FROM recruit";
			$sth=$db->prepare($sql);
			$sth->execute();
			//$result=$sth->fetchObject();
			//$sth=$db->prepare($sql);
			//$sth->execute(array($user,$password));
			
		?>
		<?php
			
			echo"<tr><td>ID</td><td>Occupation</td><td>Location</td><td>Work Time</td><td>Education Required</td><td>Minimun Of Working Experience</td><td>Salary Per Month</td><td>operation</td></tr><br>";
			while($result=$sth->fetchObject()){
				
				echo"<tr><td>";
				echo"$result->id";
				echo"</td><td>";//$result->occupation_id
				$sql2="SELECT * FROM occupation WHERE Id=:Id";
				$sth2=$db->prepare($sql2);
				$sth2->bindParam(':Id',$result->occupation_id);
				$sth2->execute();
				$result2=$sth2->fetchObject();
				echo "$result2->occupation";				
				//
				//echo"$result->occupation";
				echo"</td><td>";
				
				$sql2="SELECT * FROM location WHERE id=:id";
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
				echo"</td><td>";
				echo"$result->salary";
				echo"</td><td>";
				$sql3="SELECT * FROM favorite WHERE user_id=:id AND recruit_id=:r_id";//userid
				$sth3=$db->prepare($sql3);
				$sth3->bindParam(':id',$id);
				$sth3->bindParam(':r_id',$result->id);
				$sth3->execute();
				$result3=$sth3->fetchObject();
				if(!$result3)//有沒有案過favorite
				{
					echo'<form action="favorite_post.php" method="POST">';
					echo'<input name="action" type="hidden" value='.$result->id .'>';
					echo'<input name="v" type="hidden" value='.$id.'>';
					echo '<input type="submit" name="favorite" value="favorite"/>';
					echo'</form>';
				}
				else
				{
					echo'Already in favorite list<br>';
				}
				$sql3="SELECT * FROM application WHERE user_id=:id AND recruit_id=:r_id";//userid
				$sth3=$db->prepare($sql3);
				$sth3->bindParam(':id',$id);
				$sth3->bindParam(':r_id',$result->id);
				$sth3->execute();
				$result3=$sth3->fetchObject();
				if(!$result3)//有沒有案過application
				{
					echo'<form action="application_post.php" method="POST">';
					echo'<input name="action" type="hidden" value='.$result->id .'>';
					echo'<input name="v" type="hidden" value='.$id.'>';
					echo '<input type="submit" name="apply" value="apply"/>';
					echo'</form>';
				}
				else
				{
					echo'Waiting for employer';
				}
				//echo"$result->salary";
				echo"</td></tr>";
			}
		?>	
		
		
			
			
	</body>
	<body>
		<form action="favorite.php" method="POST">
		<button type="submit"> Favorite List</button>
		</form>
	</body>
	</table>
</html>
<?php
	}
	else
	{//否則跳回
		echo 'wrong connect......';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
	}
?>	