<?php
	session_save_path("/amd/cs/102/.../public_html");
	session_start(); 
	if($_SESSION['username'] != null)
{
	$db_host= "dbhome.cs.nctu.edu.tw";//database connect
	$db_name= "...";
	$db_user= "...";
	$db_password= "...";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);//database connect
	$db->query('SET NAMES "utf8")');
	//®³¨ìHiddenªºrecruit_id
	$action=$_POST['action'];
	$id=$_POST['v'];
	$sql3="INSERT INTO application(`user_id`,`recruit_id`)"."VALUES(?,?)";
	$sth3=$db->prepare($sql3);
	$result3=$sth3->execute(array($id,$action));
	//
	if($result3)
	{
	header('location:joblist2.php');
	}
	else
	{
		echo 'wrong ';
		echo '<meta http-equiv=REFRESH CONTENT=1;url=joblist2.php>';
	}
}
else
{
echo 'wrong connect......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';	
}
 ?>