<?php 
session_save_path("/amd/cs/102/0216335/public_html");
session_start(); 
$user=$_POST['account'];
$passwd=$_POST['password'];
/*-----test whether space or empty------*/
if(!$user){
	//echo 'account can not be empty';
	header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/index.php");
	exit;
}
if(!$passwd){
	//echo 'password can not be empty';
	header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/index.php");
	exit;	
}
$a=$_POST['account'];
if(substr_count($a,' ')>0)
{
	header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/index.php");
	exit;
}//echo "hi";/*-----test whether space or empty------*/

$hash=md5($passwd);//encrpyt
$db_host= "dbhome.cs.nctu.edu.tw";//database connect
$db_name= "tsaimy8112_cs";
$db_user= "tsaimy8112_cs";
$db_password= "meng811275";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db= new PDO($dsn, $db_user, $db_password);//database connect
$db->query('SET NAMES "utf8")');
$sql="SELECT * FROM `tsaimy8112_cs`.`user`"
	."WHERE account=? AND password =?";
$sth=$db->prepare($sql);
$sth->execute(array($user,$hash));
$result=$sth->fetch(PDO::FETCH_OBJ);
if($result)
{
	$_SESSION['username']=$result->account;
	header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/joblist2.php");
}
else
{
	header("Location:http://people.cs.nctu.edu.tw/~tsaimy8112/index.php");
	
       
}
//$db=NULL;

?>
