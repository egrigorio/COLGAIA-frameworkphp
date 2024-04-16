<?php 
include_once '../../include/settings.inc.php'; 
include_once $arrSETTINGS['dir_site_admin'].'/include/control.inc.php'; 
include_once $arrSETTINGS['dir_site_admin'].'/include/topo.inc.php'; 
include_once 'db_info.inc.php'; 
?>
<div id="content">
<?php
if(!isset($_GET['task'])) {
	$task = 'list';
} else {
	$task = $_GET['task'];
}

switch($task) {
	case 'list': 
		db_mostra_tabela($arrForm);
		break;

	case 'insert': 
		db_insert_form($arrForm);
		break;

	case 'do_insert': 
		db_do_insert_form($arrForm);
		break;

	case 'edit': 
		db_edit_form($arrForm);
		break;

	case 'do_edit': 
		db_do_edit_form($arrForm);
		break;

	case 'delete': 
		db_delete_form($arrForm);
		break;
}
?>
</div>

<?php 
include_once $arrSETTINGS['dir_site_admin'].'/include/rodape.inc.php'; 
?>