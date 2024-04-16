<?php 
include_once '../include/settings.inc.php'; 
$_SESSION['lingua'] = mysqli_real_escape_string($arrSETTINGS['db_link'], $_GET['id']);

header('Location: '.$_GET['referer']);
exit;
?>