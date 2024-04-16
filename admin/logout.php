<?php 
include_once '../include/settings.inc.php'; 
//unset($_SESSION['USER_LOGIN']);
session_unset($_SESSION['USER_LOGIN']);
session_destroy();
header('Location: '.$arrSETTINGS['url_site_admin'].'/login.php');
exit;
?>