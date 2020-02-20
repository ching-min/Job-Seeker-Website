<?php
echo "Hello!!<br>"
?>
<!doctype html>
<html lang="en">
	<head>
		<title>
			Job
		</title>
	</head>
	<form method=post action='search.php'>
	Occupation<select name="occupation"></option>
		<option value=""> </option>
		<?php 
			$db_host= "dbhome.cs.nctu.edu.tw";//connect
			$db_name= "tsaimy8112_cs";
			$db_user= "tsaimy8112_cs";
			$db_password= "meng811275";
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
			$db_name= "tsaimy8112_cs";
			$db_user= "tsaimy8112_cs";
			$db_password= "meng811275";
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
			echo'<form action="index.php" method="POST">';
			echo'<input name="action" type="hidden" value="up">';
			echo'<input type="submit" name="up" value="up"/>';
			echo'</form>';
			echo'<form action="index.php" method="POST">';
			echo'<input name="action" type="hidden" value="down">';
			echo'<input type="submit" name="down" value="down"/>';
			echo'</form>';	
		?>
		<?php
			
			$user=$_POST['email'];
			$password=$_POST['password'];
			$db_host= "dbhome.cs.nctu.edu.tw";//connect
			$db_name= "tsaimy8112_cs";
			$db_user= "tsaimy8112_cs";
			$db_password= "meng811275";
			$dsn= "mysql:host=$db_host;dbname=$db_name";
			$db=new PDO($dsn,$db_user,$db_password);			
			$action=$_POST['action'];
			if($action=="up"){$sql="SELECT * FROM recruit ORDER BY Salary ,id ";}
			else if($action=="down"){$sql="SELECT * FROM recruit ORDER BY Salary  DESC,id DESC ";}
			else{$sql="SELECT * FROM recruit ORDER BY id  "; }
			$sth=$db->prepare($sql);
			$sth->execute();
			
		?>
<?		
		echo"<tr><td>ID</td><td>Occupation</td><td>Location</td><td>Work Time</td><td>Education Required</td><td>Minimun Of Working Experience</td><td>Salary Per Month</td></tr><br>";
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
				echo"</td></tr>";
			}?>
		<h1>Job Vacancy</h1>
		
		<h3>Employer</h3>
			<p>Looking for a staff?</p>
	<form action="employer_login.php"method="POST">
		<input type="text"name="account"><br>
		<input type="password"name="password"><br>
		<input type="submit" value="Log in">		
	</form>
	<form action="employer_signup.php"method="POST">
		<button type="submit">Sign up now</button>
	</form>
	
		<h3>Job Seeker</h3>
			<p>Fill in resume right now!</p>
	<form action="jobseeker_login.php"method="POST">
		<input type="text"name="account"><br>
		<input type="password"name="password"><br>
		<button type="submit">Log in</button>
	</form>
	<form action="Jobseeker_signup.php"method="POST">
		<button type="submit">Sign up now</button>
	</form>
	</body>	

</html>
