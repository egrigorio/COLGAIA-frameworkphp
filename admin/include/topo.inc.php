<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $arrSETTINGS['nome_site']; ?></title>
<link href="<?php echo $arrSETTINGS['url_site_admin']; ?>/css/framework.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $arrSETTINGS['url_site_admin']; ?>/css/custom.datepicker.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $arrSETTINGS['url_site_admin']; ?>/js/jquery-1.12.3.min.js"></script>
<script src="<?php echo $arrSETTINGS['url_site_admin']; ?>/js/framework.js"></script>
<script src="<?php echo $arrSETTINGS['url_site_admin']; ?>/js/jscolor.min.js"></script>
<script src="<?php echo $arrSETTINGS['url_site_admin']; ?>/js/jquery-ui.js"></script>
<script src="<?php echo $arrSETTINGS['url_site']; ?>/plugins/ckeditor/ckeditor.js"></script>
<script>
$(function() {
	$(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>
<script>
var tabactivo = '<?php echo $_SESSION['lingua']; ?>';
var tabinicial = '<?php echo $_SESSION['lingua']; ?>';
</script>
</head>

<body>

	<!-- menu principal -->
    <div class="menu">
    <?php 
    include_once $arrSETTINGS['dir_site_admin'].'/include/menu.inc.php'; 
    ?>
    </div>
	<!-- end menu principal -->