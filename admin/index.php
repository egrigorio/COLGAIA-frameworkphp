<?php 
include_once '../include/settings.inc.php'; 
include_once $arrSETTINGS['dir_site_admin'].'/include/control.inc.php'; 
include_once $arrSETTINGS['dir_site_admin'].'/include/topo.inc.php'; 
?>
<div id="content">
Backoffice - Bem vindo <?php echo $_SESSION['USER_NOME']; ?><br />
</div>

<?php 
include_once $arrSETTINGS['dir_site_admin'].'/include/rodape.inc.php'; 
?>