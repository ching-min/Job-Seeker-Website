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
$sql="DELETE FROM recruit WHERE id=:id";
$sth=$db->prepare($sql);
$sth->bindParam(':id',$action);
$sth->execute();

echo '<meta http-equiv=REFRESH CONTENT=1;url=applylist.php>';
?>
