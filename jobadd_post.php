<?php
session_save_path("/amd/cs/102/.../public_html");
session_start();
$occupation=$_POST['occupation'];
$location=$_POST['location'];
$work_time=$_POST['work_time'];
$edu=$_POST['edu'];
$exp=$_POST['exp'];
$Salary=$_POST['Salary'];
/*-----test whether space or empty------*/
if(!$occupation){
	header("Location: http://people.cs.nctu.edu.tw/.../addjob.php");
	exit;
}
if(!$location){
	header("Location: http://people.cs.nctu.edu.tw/.../addjob.php");
	exit;	
}
if(!$work_time){
	header("Location: http://people.cs.nctu.edu.tw/.../addjob.php");
	exit;	
}
if(!$edu){
	header("Location: http://people.cs.nctu.edu.tw/.../addjob.php");
	exit;
}
if(!$exp){
	header("Location: http://people.cs.nctu.edu.tw/.../addjob.php");
	exit;	
}
if(!$Salary){
	header("Location: http://people.cs.nctu.edu.tw/.../addjob.php");
	exit;	
}

$db_host= "dbhome.cs.nctu.edu.tw";//database connect
$db_name= "...";
$db_user= "...";
$db_password= "...";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);//database connect
$db->query('SET NAMES "utf8")');
/*尋找employ_id*/
	$sql2="SELECT * FROM employer WHERE account=:account";
	$sth2=$db->prepare($sql2);
	$sth2->bindParam(':account',$_SESSION['username']);
	$sth2->execute();
	$result2=$sth2->fetchObject();
	$id=$result2->Id;//將id找出
/*插入*/	
$sql="INSERT INTO `...`. `recruit` (`employ_id`,`occupation_id`,`location_id`,`working_time`,`education`,`experience`,`salary`)"
	."VALUES(?,?,?,?,?,?,?)";
$sth=$db->prepare($sql);
$result=$sth->execute(array($id,$occupation,$location,$work_time,$edu,$exp,$Salary));

if($result)
{
	
	header("Location: http://people.cs.nctu.edu.tw/.../joblist1.php");
	//exit;
}
else
{echo $id,$occupation,$location,$work_time,$edu,$exp,$Salary;
	echo 'type wrong......';
	echo '<meta http-equiv=REFRESH CONTENT=1;url=addjob.php>';
}

$db=NULL;

?>