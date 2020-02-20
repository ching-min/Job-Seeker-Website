<?php
session_save_path("/amd/cs/102/.../public_html");
session_start();
$db_host= "dbhome.cs.nctu.edu.tw";//connect
$db_name= "...";
$db_user= "...";
$db_password= "...";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);
$sql="SELECT * FROM recruit";
$sth=$db->prepare($sql);
$sth->execute();
?>
<!doctype html>
<html lang="en">
	<head>
		<title>
			addjob
		</title>
	</head>
	 <!--Required</td><td>Minimun Of Working Experience</td><td>Salary Per Month</td><td>Operation</td></tr><br>";-->
	<table border="1">
	<body>	
		<?php
	if($_SESSION['username'] != null)
	{echo "hi ".$_SESSION['username']."!!<br>";//印出上方列
		echo"<tr><td>ID</td><td>Occupation</td><td>Location</td><td>Work Time</td><td>Education Required</td><td>Minimun Of Working Experience</td><td>Salary Per Month</td><td>Operation</td></tr>";
		while($result=$sth->fetchObject()){
				
				echo"<tr><td>";
				echo"$result->id";
				echo"</td><td>";
				$sql2="SELECT * FROM occupation WHERE Id=:Id";
				$sth2=$db->prepare($sql2);
				$sth2->bindParam(':Id',$result->occupation_id);
				$sth2->execute();
				$result2=$sth2->fetchObject();
				echo "$result2->occupation";
//				echo"$result->occupation";
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
				echo"</td></tr>";
			}
			?>
	</body>
	<body>
	<form action="logout.php"method="POST">
		<button type="submit">logout</button>
	</form>
	<form action="jobadd_post.php"method="POST">	
		<!--//增加的選取欄 occupation -->	
		<tr><td></td><td>
		<select name="occupation">
		<?php 		
			$sql1="SELECT * FROM `occupation` ";
			$sth1=$db->prepare($sql1);
			$sth1->execute();
			while($result1=$sth1->fetchObject()){
				
				echo"<option value=".$result1->Id .">".$result1->occupation ."</option>";
				
			}
		?>
		</select>
		</td><td>
		<!-- location -->
		<select name="location">
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
		</td><td>
		<!-- work time -->
		<input list="work_time" name="work_time"/>
		<datalist id="work_time">
			<option value="morning">
			<option value="night">
		</datalist></td><td>
		<!--Major Education-->
		<input list="edu" name="edu"/>
		<datalist id="edu">
			<option value="Elementary School">
			<option value="Junior High School">
			<option value="Senior High School">
			<option value="Undergraduate School">
			<option value="Graduate School">
		</datalist></td><td>
		<!--experience-->
		
		<select name="exp">
		<option value=""> </option>
		<option value="6">No experience required</option>
		<option value="1">1 year</option>
		<option value="2">2 years</option>
		<option value="3">3 years</option>
		<option value="4">4 years</option>
		<option value="5">5 years</option>
		<option value="10">10 years</option>
	</select></td><td>
		
		<!--Salary-->
		<input type="number" min="0" step="1000" value="10000" name="Salary"></td><td>
		<button type="submit">save</button>
	</html>	
	</form>
	</body>		
	<body>
		<form action="joblist1.php"method="POST">
		<button type="submit">cancel</button>
		</form>
		</td></tr>
		</body>	
<?php
	}
	else
	{//否則跳回
		echo 'wrong connect......';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
	}
?>	
	</table>
</html>
