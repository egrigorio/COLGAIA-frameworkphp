<?php
session_start();
if(!isset($_SESSION['lingua'])) { $_SESSION['lingua'] = 'pt'; }

error_reporting(-1);
header('Content-Type: text/html; charset=utf-8');

$arrSETTINGS['debug_time'] = 1;
$microtimeref = microtime(true); 

# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Definições gerais da aplicação
# ---------------------------------------

# Caminhos absolutos para o directório (dir_site) e url (url_site) do projeto
# ---------------------------------------
$arrSETTINGS['dir_site'] = '/Applications/XAMPP/xamppfiles/htdocs/frameworkphp';
$arrSETTINGS['url_site'] = 'http://localhost/frameworkphp';
$arrSETTINGS['encrypt']  = 'qraOPMBFEÇD/(/Yha^^Ç#$231312414';
# ---------------------------------------

# Definições gerais do projeto
# ---------------------------------------
include_once $arrSETTINGS['dir_site'].'/include/settings/project.config.php'; 
# ---------------------------------------

# Definições gerais do acesso à base de dados remota (mysql)
# ---------------------------------------
include_once $arrSETTINGS['dir_site'].'/include/settings/db.config.php'; 
include_once $arrSETTINGS['dir_site'].'/lib/db.inc.php'; 
$arrSETTINGS['db_link'] = db_connect();
# ---------------------------------------

# Incluir todas as librarias, tais como a libraria de funções
# ---------------------------------------
include_once $arrSETTINGS['dir_site'].'/lib/functions.inc.php'; 
include_once $arrSETTINGS['dir_site'].'/lib/functions.db.inc.php'; 
include_once $arrSETTINGS['dir_site'].'/include/langs/lang.'.$_SESSION['lingua'].'.php'; 
# ---------------------------------------

if(!isset($info_stats) || $info_stats == 1) {
	stats();
}
?>