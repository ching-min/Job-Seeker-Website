<?php
session_save_path("/amd/cs/102/0216335/public_html");
session_start(); 
$db_host= "dbhome.cs.nctu.edu.tw";//connect
$db_name= "tsaimy8112_cs";
$db_user= "tsaimy8112_cs";
$db_password= "meng811275";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);

$occupation=$_POST['occupation'];
$location=$_POST['location'];
$work_time=$_POST['work_time'];
$edu=$_POST['edu'];
$exp=$_POST['exp'];
$Salary=$_POST['Salary'];
$action=$_POST['action'];//id

$sql="UPDATE recruit SET occupation_id=?, location_id=?, working_time=?, education=?, experience=?, salary=? WHERE id=?";
$sth=$db->prepare($sql);
$sth->execute(array($occupation,$location,$work_time,$edu,$exp,$Salary,$action));
echo '<meta http-equiv=REFRESH CONTENT=1;url=joblist1.php>';

?>