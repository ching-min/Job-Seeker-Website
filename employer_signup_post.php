<?php
session_save_path("/amd/cs/102/0216335/public_html");
session_start(); 
$user=$_POST['account'];
$passwd=$_POST['password'];
$phone=$_POST['phone'];
$mail=$_POST['mail'];
//echo $user,$passwd,$phone,$mail;
/*-----test whether space or empty------*/
if(!$user){
	//echo 'account can not be empty';
	header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/employer_signup.php");
	exit;
}
if(!$passwd){
	//echo 'password can not be empty';
	header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/employer_signup.php");
	exit;	
}
$a=$_POST['account'];
if(substr_count($a,' ')>0)
{
	header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/employer_signup.php");
	exit;
}
/*-----------hash passwd,database connect*/
$passwd=md5($passwd);//encrpyt
$db_host= "dbhome.cs.nctu.edu.tw";//database connect
$db_name= "tsaimy8112_cs";
$db_user= "tsaimy8112_cs";
$db_password= "meng811275";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);//database connect
$db->query('SET NAMES "utf8")');
/*沒有人的account是一樣的*/
$sql="SELECT * FROM `tsaimy8112_cs`.`employer`"
	."WHERE account=? ";
$sth=$db->prepare($sql);
$sth->execute(array($user));
$result=$sth->fetch(PDO::FETCH_OBJ);
if($result)//如果有account相同，跳回sign up
{
	
	header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/employer_signup.php");
	exit;
}

/*插入*/	
$sql="INSERT INTO `tsaimy8112_cs`. `employer` (`account`,`password`,`phone`,`mail`)"
	."VALUES(?,?,?,?)";
$sth=$db->prepare($sql);
$result=$sth->execute(array($user,$passwd,$phone,$mail));

if($result)
{
	$_SESSION['username']=$user;
	header('location:joblist1.php');
	//exit;
}
else
{header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/employer_signup.php");
}

$db=NULL;

?>