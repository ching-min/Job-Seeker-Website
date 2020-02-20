<?php
$user=$_POST['email'];
$password=$_POST['password'];
$db_host= "dbhome.cs.nctu.edu.tw";//connect
$db_name= "...";
$db_user= "...";
$db_password= "...";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);
//var_dump($dsn."\n\n");
//$db= new PDO($dsn, $db_user, $db_password);
//
//user,user,user,user,user,user,user,,
$sql="SELECT id,account,gender,age,education,expected_salary,phone,email FROM user";
$sth=$db->prepare($sql);
$sth->execute();

//$result=$sth->fetchObject();
//$sth=$db->prepare($sql);
//$sth->execute(array($user,$password));
echo"hi <br>";
?>

<!doctype html>
<html lang="en">
	<table border="1">
	<body>
		<form action="logout.php"method="POST">
		<button type="submit">logout</button><br>
	</form>
		<?php
			echo"Job Seeker List<br>";
			echo"<tr><td>ID</td><td>Name</td><td>Gender</td><td>Age</td><td>Education</td><td>Expected Salary</td><td>";
			echo"Phone Number</td><td>Email</td><td>Speciality</td></tr><br>";
			while($result=$sth->fetchObject()){
				echo"<tr><td>";
				echo"$result->id";
				echo"</td><td>";
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
				
					$user=$_POST['email'];
					$password=$_POST['password'];
					$db_host= "dbhome.cs.nctu.edu.tw";//connect
					$db_name= "...";
					$db_user= "...";
					$db_password= "...";
					$dsn= "mysql:host=$db_host;dbname=$db_name";
					$db=new PDO($dsn,$db_user,$db_password);
					//echo"<select>";
					$sql1="SELECT user_specialty.user_id,specialty.specialty FROM `user_specialty` INNER JOIN `specialty` ON user_specialty.specialty_id=specialty.id";
					$sth1=$db->prepare($sql1);
					$sth1->execute();
										
					while($result1=$sth1->fetchObject()){
						if($result->id==$result1->user_id){
							echo$result1->specialty;
							echo"<br>";
						}
					}
					
					
				
						
				echo"</td></tr>";
			}		
		?>	
	<form action="joblist1.php"method="POST">
		<button type="submit">job vancy</button><br>
	</form>
	</body>
	</table>
</html>