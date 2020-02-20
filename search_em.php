<!doctype html>
<html lang="en">
	
	<head>
		<title>
			search
		</title>
	</head>
	<table border="1">
	<body>
<?php
	$db_host= "dbhome.cs.nctu.edu.tw";//connect
	$db_name= "tsaimy8112_cs";
	$db_user= "tsaimy8112_cs";
	$db_password= "meng811275";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db=new PDO($dsn,$db_user,$db_password);
	
	$oc=$_POST['occupation'];
	$lo=$_POST['location'];
	$wt=$_POST['work_time'];//work time
	$edu=$_POST['edu'];
	$exp=$_POST['exp'];
	$salary=$_POST['salary'];
	if(!$oc&&!$lo&&!$wt&&!$edu&&!$exp&&!$salary)
	{
		echo 'you can not leave the space......';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=joblist1.php>';
	}
	else if(!$salary)
	{
		$sql=" SELECT * FROM `recruit` 
		WHERE occupation_id LIKE :o_id AND location_id LIKE :l_id  
		AND working_time LIKE :wt AND education LIKE :edu 
		AND experience LIKE :exp ";
		$sth=$db->prepare($sql);
		$oc = "%".$oc."%";
		$lo = "%".$lo."%";
		$wt = "%".$wt."%";
		$edu = "%".$edu."%";
		$exp = "%".$exp."%";
		
		$sth->bindParam(':o_id',$oc);
		$sth->bindParam(':l_id',$lo);
		$sth->bindParam(':wt',$wt);
		$sth->bindParam(':edu',$edu);
		$sth->bindParam(':exp',$exp);

		$sth->execute();
		echo"<tr><td>ID</td><td>Occupation</td><td>Location</td><td>Work Time</td><td>Education Required</td><td>Minimun Of Working Experience</td><td>Salary Per Month</td></tr><br>";
		while($result=$sth->fetchObject()){
			echo"<tr><td>";
			//id
			echo"$result->id";
			echo"</td><td>";
			//occupation
			$sql2="SELECT * FROM occupation WHERE Id=:Id";
			$sth2=$db->prepare($sql2);
			$sth2->bindParam(':Id',$result->occupation_id);
			$sth2->execute();
			$result2=$sth2->fetchObject();
			echo "$result2->occupation";
			echo"</td><td>";
			//location
			$sql2="SELECT * FROM location WHERE id=:id";
			$sth2=$db->prepare($sql2);
			$sth2->bindParam(':id',$result->location_id);
			$sth2->execute();
			$result2=$sth2->fetchObject();
			echo"$result2->location";				
			echo"</td><td>";
			//work_time
			echo"$result->working_time";
			echo"</td><td>";
			//education
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
			//salary
			echo"$result->salary";
				echo"</td></tr>";
		}//while
	}
	else if($salary==40000)
	{
		$sql=" SELECT * FROM `recruit` 
		WHERE occupation_id LIKE :o_id AND location_id LIKE :l_id  
		AND working_time LIKE :wt AND education LIKE :edu 
		AND experience LIKE :exp AND salary >:sa ";
		$sth=$db->prepare($sql);
		$oc = "%".$oc."%";
		$lo = "%".$lo."%";
		$wt = "%".$wt."%";
		$edu = "%".$edu."%";
		$exp = "%".$exp."%";
		
		$sth->bindParam(':o_id',$oc);
		$sth->bindParam(':l_id',$lo);
		$sth->bindParam(':wt',$wt);
		$sth->bindParam(':edu',$edu);
		$sth->bindParam(':exp',$exp);
		$sth->bindParam(':sa',$salary);

		$sth->execute();
		echo"<tr><td>ID</td><td>Occupation</td><td>Location</td><td>Work Time</td><td>Education Required</td><td>Minimun Of Working Experience</td><td>Salary Per Month</td></tr><br>";
		while($result=$sth->fetchObject()){
			echo"<tr><td>";
			//id
			echo"$result->id";
			echo"</td><td>";
			//occupation
			$sql2="SELECT * FROM occupation WHERE Id=:Id";
			$sth2=$db->prepare($sql2);
			$sth2->bindParam(':Id',$result->occupation_id);
			$sth2->execute();
			$result2=$sth2->fetchObject();
			echo "$result2->occupation";
			echo"</td><td>";
			//location
			$sql2="SELECT * FROM location WHERE id=:id";
			$sth2=$db->prepare($sql2);
			$sth2->bindParam(':id',$result->location_id);
			$sth2->execute();
			$result2=$sth2->fetchObject();
			echo"$result2->location";				
			echo"</td><td>";
			//work_time
			echo"$result->working_time";
			echo"</td><td>";
			//education
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
			//salary
			echo"$result->salary";
				echo"</td></tr>";
		}//while
	}
	else if($salary!=40000)
	{
		$sql=" SELECT * FROM `recruit` 
		WHERE occupation_id LIKE :o_id AND location_id LIKE :l_id  
		AND working_time LIKE :wt AND education LIKE :edu 
		AND experience LIKE :exp AND salary <=:sa ";
		$sth=$db->prepare($sql);
		$oc = "%".$oc."%";
		$lo = "%".$lo."%";
		$wt = "%".$wt."%";
		$edu = "%".$edu."%";
		$exp = "%".$exp."%";
		
		$sth->bindParam(':o_id',$oc);
		$sth->bindParam(':l_id',$lo);
		$sth->bindParam(':wt',$wt);
		$sth->bindParam(':edu',$edu);
		$sth->bindParam(':exp',$exp);
		$sth->bindParam(':sa',$salary);

		$sth->execute();
		echo"<tr><td>ID</td><td>Occupation</td><td>Location</td><td>Work Time</td><td>Education Required</td><td>Minimun Of Working Experience</td><td>Salary Per Month</td></tr><br>";
		while($result=$sth->fetchObject()){
			echo"<tr><td>";
			//id
			echo"$result->id";
			echo"</td><td>";
			//occupation
			$sql2="SELECT * FROM occupation WHERE Id=:Id";
			$sth2=$db->prepare($sql2);
			$sth2->bindParam(':Id',$result->occupation_id);
			$sth2->execute();
			$result2=$sth2->fetchObject();
			echo "$result2->occupation";
			echo"</td><td>";
			//location
			$sql2="SELECT * FROM location WHERE id=:id";
			$sth2=$db->prepare($sql2);
			$sth2->bindParam(':id',$result->location_id);
			$sth2->execute();
			$result2=$sth2->fetchObject();
			echo"$result2->location";				
			echo"</td><td>";
			//work_time
			echo"$result->working_time";
			echo"</td><td>";
			//education
			echo"$result->education";
			echo"</td><td>";
			if($result->experience==6)
				echo "NO experience";
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
			//salary
			echo"$result->salary";
				echo"</td></tr>";
		}//while
	}

?>
	<form action="joblist1.php" method="POST">
			<button type="submit"> back to joblist</button>
	</form>
	<form action="logout.php" method="POST">
	<button type="submit"> Log out</button>
	</form>
	</body>
	</table>
</html>