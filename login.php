<!doctype html>

<?php
$user=$_POST['email'];
$password=$_POST['password'];
$db_host= "dbhome.cs.nctu.edu.tw";//connect
$db_name= "tsaimy8112_cs";
$db_user= "tsaimy8112_cs";
$db_password= "meng811275";
$dsn= "mysql:host=$db_host;dbname=$db_name";
//var_dump($dsn."\n\n");
$db= new PDO($dsn, $db_user, $db_password);//connect
//var_dump("==========================".$db."\n\n==================");
$sql="INSERT INTO `tsaimy8112_cs`.`user` (ID,password)"
	."VALUES(?,?)";
$sth=$db->prepare($sql);
$sth->execute(array($user,$password));
?>
<html>
<form action="index.php"method="POST">
		<button type="submit">logout</button>
	</form>
</html>