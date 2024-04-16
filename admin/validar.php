<?php 
include_once '../include/settings.inc.php'; 
$username = $_POST['user'];
$password = $_POST['pass'];

$nova_password = generate_password($username, $password);

$query = "SELECT * FROM users WHERE username = '$username' AND password = '$nova_password' AND activo = '1'";
$res = db_query($query);

if($res[0]['username'] == $username && $res[0]['password'] == $nova_password) {
	$_SESSION['USER_LOGIN'] = 1;
	$_SESSION['encrypt'] 	= $arrSETTINGS['encrypt'];
	$_SESSION['USER_NOME'] 	= $res[0]['nome'];
	$_SESSION['USER_ID'] 	= $res[0]['id'];
	
	header('Location: '.$arrSETTINGS['url_site_admin'].'/index.php');
	exit;
}
header('Location: '.$arrSETTINGS['url_site_admin'].'/login.php');
exit;
?>