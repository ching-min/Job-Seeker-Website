<?php
session_save_path("/amd/cs/102/.../public_html");
session_start(); 
$db_host= "dbhome.cs.nctu.edu.tw";//connect
$db_name= "...";
$db_user= "...";
$db_password= "...";
$dsn= "mysql:host=$db_host;dbname=$db_name";
$db=new PDO($dsn,$db_user,$db_password);
$u_id=$_POST['action'];
$r_id=$_POST['v'];
$sql="SELECT * FROM favorite";
$sth=$db->prepare($sql);
$sth->execute();
$sql="DELETE FROM `favorite` WHERE user_id =:id AND recruit_id=:r_id";
$sth=$db->prepare($sql);
$sth->bindParam(':id',$u_id);
$sth->bindParam(':r_id',$r_id);
$sth->execute();
echo '<meta http-equiv=REFRESH CONTENT=1;url=favorite.php>';

?>