<?php
session_save_path("/amd/cs/102/.../public_html");
session_start(); 
$db_host= "dbhome.cs.nctu.edu.tw";//connect
$db_name= "...";
$db_user= "...";
$db_password= "...";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);

$action=$_POST['action'];
/*$sql="SELECT * FROM recruit WHERE id =:id";//
$sth=$db->prepare($sql);
$sth->bindParam(':id',$action);
$sth->execute();
$result=$sth->fetchObject();*/
$sql="DELETE FROM `recruit` WHERE id =:id";
$sth=$db->prepare($sql);
$sth->bindParam(':id',$action);
$sth->execute();
$sql2="SELECT * FROM `recruit`";
$sth2=$db->prepare($sq2);
$sth2->execute();
$num=1;

echo '<meta http-equiv=REFRESH CONTENT=1;url=joblist1.php>';

?>
