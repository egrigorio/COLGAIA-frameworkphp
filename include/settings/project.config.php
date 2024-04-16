<?php
# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Configurações gerais do projeto
# ---------------------------------------

# Configurações gerais
# ---------------------------------------
$arrSETTINGS['nome_site'] = 'Framework';
$arrSETTINGS['ano_site'] = '2016';
$arrSETTINGS['developer_site'] = 'Hélder Couto';

# Caminhos absolutos para o directório (dir_site) e url (url_site) do backoffice
# ---------------------------------------
$backoffice = 'admin';
$arrSETTINGS['dir_site_admin'] = $arrSETTINGS['dir_site'].'/'.$backoffice;
$arrSETTINGS['url_site_admin'] = $arrSETTINGS['url_site'].'/'.$backoffice;

# Caminhos absolutos para o directório  das fotografias
# ---------------------------------------
$pasta = 'upload';
$arrSETTINGS['dir_fotos'] = $arrSETTINGS['dir_site'].'/'.$pasta;
$arrSETTINGS['url_fotos'] = $arrSETTINGS['url_site'].'/'.$pasta;
$arrSETTINGS['dir_fotos_admin'] = $arrSETTINGS['dir_site_admin'].'/'.$pasta;
$arrSETTINGS['url_fotos_admin'] = $arrSETTINGS['url_site_admin'].'/'.$pasta;

# Caminhos absolutos para o directório dos icons
# ---------------------------------------
$pasta = 'icons';
$arrSETTINGS['dir_icons'] = $arrSETTINGS['dir_site'].'/imgs/'.$pasta;
$arrSETTINGS['url_icons'] = $arrSETTINGS['url_site'].'/imgs/'.$pasta;
$arrSETTINGS['dir_icons_admin'] = $arrSETTINGS['dir_site_admin'].'/imgs/'.$pasta;
$arrSETTINGS['url_icons_admin'] = $arrSETTINGS['url_site_admin'].'/imgs/'.$pasta;

# Definições de tipos de ficheiros permitidos para upload e tamanho máximo
# ---------------------------------------
$arrSETTINGS['arrFILES_upload'] = array('gif','jpg','png');
$arrSETTINGS['maxFILES_upload'] = 10485760; # 2Mb = 2 * 1024 (Kb) * 1024 (Bytes);

# Tema por defeito
# ---------------------------------------
$arrSETTINGS['dir_template'] = $arrSETTINGS['dir_site'].'/templates/';
$arrSETTINGS['dir_smarttag'] = $arrSETTINGS['dir_site'].'/templates/tags/';
$arrSETTINGS['template'] = 'default';

# Idiomas
# ---------------------------------------
$arrSETTINGS['idiomas'] = array('pt'=>'Português', 'en'=>'English', 'es'=>'Spanish', 'fr'=>'French', 'it'=>'Italiano', 'de'=>'German', 'ch'=>'中國', 'ru'=>'Russo');

?>