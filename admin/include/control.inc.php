<?php
# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Controlo do utilizador na navegação do backoffice
# ---------------------------------------

global $arrSETTINGS;
if(!(isset($_SESSION['USER_LOGIN']) && $_SESSION['encrypt'] == $arrSETTINGS['encrypt'])) {
	header("Location: ".$arrSETTINGS['url_site_admin']."/login.php");
	exit;
}
?>