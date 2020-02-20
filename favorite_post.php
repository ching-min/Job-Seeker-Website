<?php
	session_save_path("/amd/cs/102/0216335/public_html");
	session_start(); 
	if($_SESSION['username'] != null)
{
	$db_host= "dbhome.cs.nctu.edu.tw";//database connect
	$db_name= "tsaimy8112_cs";
	$db_user= "tsaimy8112_cs";
	$db_password= "meng811275";
	$dsn= "mysql:host=$db_host;dbname=$db_name";
	$db= new PDO($dsn, $db_user, $db_password);//database connect
	$db->query('SET NAMES "utf8")');
	/*尋找employ_id*/
	/*$sql2="SELECT * FROM user WHERE account=:account";
	$sth2=$db->prepare($sql2);
	$sth2->bindParam(':account',$_SESSION['username']);
	$sth2->execute();
	$result2=$sth2->fetchObject();
	$id=$result2->id;//將id找出*/
	//拿到Hidden的recruit_id
	$action=$_POST['action'];
	$id=$_POST['v'];
	$sql3="INSERT INTO favorite(`user_id`,`recruit_id`)"."VALUES(?,?)";
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
