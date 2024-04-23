<?php 
include_once '../include/settings.inc.php'; 
include_once $arrSETTINGS['dir_site_admin'].'/include/topo_login.inc.php'; 

echo generate_password('admin', 'admin');


?>
<div id="content">
LOGIN
<form name="frm" method="post" action="validar.php">
<input type="text" name="user" id="user" value="" autocomplete="off" required />
<input type="password" name="pass" id="pass" value="" autocomplete="off" required />
<input type="submit" name="submeter" value="Login" />
</form>
</div>

<?php 
include_once $arrSETTINGS['dir_site_admin'].'/include/rodape.inc.php'; 
?>