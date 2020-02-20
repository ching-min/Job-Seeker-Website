<?php
echo"Fill in your resume <br>";?>
<!doctype html>
<html lang="en">
	<head>
		<title>
			Jobseeker_signup
		</title>
	</head>
	<body>
	<form action="jobseeker_signup_post.php"method="POST">
		Account<br>
		<input type="text"name="account"><br>
		
		Password <br>
		<input type="password"name="password"><br>
		
		Phone<br>
		<input type="text"name="phone"><br>
		
		Gender <br>
		<input list="gender" name="gender"/>
		<datalist id="gender">
			<option value="Female">
			<option value="Male">
		</datalist><br>
		
		Age<br>
		<input type="number"  min="0" step="1" value="20" name="age"><br>
		
		Email address<br>
		<input type="text" name="email"><br>
		
		Expected Salary<br>
		<input type="text" name="salary"><br>
		
		Major Education<br>
		<input list="education" name="education"/>
		<datalist id="education">
			<option value="Elementary School">
			<option value="Junior High School">
			<option value="Senior High School">
			<option value="Undergraduate School">
			<option value="Graduate School">
		</datalist><br>
		<br><br>What is your speciality?<br>
		<!------連接資料庫----->
		<?php
		$db_host= "dbhome.cs.nctu.edu.tw";//database connect
		$db_name= "...";
		$db_user= "...";
		$db_password= "...";
		$dsn= "mysql:host=$db_host;dbname=$db_name";
		$db= new PDO($dsn, $db_user, $db_password);//database connect
		$db->query('SET NAMES "utf8")');
		$sql="SELECT * FROM `...`.`specialty`";//取出id
		$sth=$db->prepare($sql);
		$sth->execute();
		while($result=$sth->fetchObject()){
			echo '<input type="checkbox" name="specialty[]" value='. $result->id. '>' .$result->specialty;
		}
		?>
		<button type="submit">submit</button>

		
	</form>
	</body>
</html>



