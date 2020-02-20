<?php
session_save_path("/amd/cs/102/0216335/public_html");
session_start(); 

unset($_SESSION['username']);
echo 'log out......';
echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
?>