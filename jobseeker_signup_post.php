<?php
session_save_path("/amd/cs/102/.../public_html");
session_start(); 
$user=$_POST['account'];
$passwd=$_POST['password'];
/*-----test whether space or empty------*/
if(!$user){
	//echo 'account can not be empty';
	header("Location:http://people.cs.nctu.edu.tw/.../Jobseeker_signup.php");
	exit;
}
if(!$passwd){
	//echo 'password can not be empty';
	header("Location:http://people.cs.nctu.edu.tw/.../Jobseeker_signup.php");
	exit;	
}
$a=$_POST['account'];
if(substr_count($a,' ')>0)
{
	header("Location:http://people.cs.nctu.edu.tw/.../Jobseeker_signup.php");
	exit;
}
/*-----------hash passwd,database connect*/
$passwd=md5($passwd);//encrpyt
$db_host= "dbhome.cs.nctu.edu.tw";//database connect
$db_name= "...";
$db_user= "...";
$db_password= "...";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);//database connect
$db->query('SET NAMES "utf8")');
/*沒有人的account是一樣的*/
$sql="SELECT * FROM `...`.`user`"
	."WHERE account=? ";
$sth=$db->prepare($sql);
$sth->execute(array($user));
$result=$sth->fetch(PDO::FETCH_OBJ);
if($result)//如果有account相同，跳回sign up
{
	
	header("Location:http://people.cs.nctu.edu.tw/.../Jobseeker_signup.php");
	exit;
}
		$phone=$_POST['phone'];
		$gender=$_POST['gender'];
		$age=$_POST['age'];
		$email=$_POST['email'];
		$salary=$_POST['salary'];
		$education=$_POST['education'];
/*----插入----*/
$sql="INSERT INTO `...`.`user` (`account`,`password`,`education`,`expected_salary`,`phone`,`gender`,`age`,`email`)"
	."VALUES(?,?,?,?,?,?,?,?)";
    //echo $_POST['salary'],$user;
	//echo $user," ",$education," ",$salary," ",$phone,$gender,$age," ",$email;
$sth=$db->prepare($sql);
$result=$sth->execute(array($user,$passwd,$education,$salary,$phone,$gender,$age,$email));
/*尋找employ_id*/
	$sql2="SELECT * FROM user WHERE account=:account";
	$sth2=$db->prepare($sql2);
	$sth2->bindParam(':account',$user);
	$sth2->execute();
	$result2=$sth2->fetchObject();
	$id=$result2->id;//將id找出
//計算id是第幾個
/*$sql0="SELECT count(*)  FROM user";
$sth0=$db->prepare($sql0);
$sth0->execute();
$rows = $sth0->fetch(PDO::FETCH_NUM);
$id=$rows[0];*/
//存入specialty計算id到第幾個在加1
/*$sql2="SELECT count(*) FROM user_specialty";
$sth2=$db->prepare($sql2);
$sth2->execute();
$result2=$sth2->fetch(PDO::FETCH_NUM);
$count=$result2[0]+1;*/
$checkbox=$_POST['specialty'];
foreach($checkbox as $value)
{
	$sql3="INSERT INTO user_specialty(`user_id`,`specialty_id`)"."VALUES(?,?)";
	$sth3=$db->prepare($sql3);
	$result3=$sth3->execute(array($id,$value));
	
}
if($result)
{
	$_SESSION['username']=$user;
header('location:joblist2.php');
}
else
{
	header('location:Jobseeker_signup.php');//exit;
}
$db=NULL;
?>