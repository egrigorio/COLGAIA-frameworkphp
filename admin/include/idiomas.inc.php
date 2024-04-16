<?php
global $arrSETTINGS;

$interno = 0;
$idioma_link = '';
if(isset($arrSETTINGS['idiomas_interno']) && $arrSETTINGS['idiomas_interno'] == 1) {
	$interno = 1;
	$idioma_link = 'set_lingua '; // precisa de espaço no final da string
}

$idiomas_class = 'idiomas_flags'; // idiomas
$flags_iso = 1;
$flags_iso_tamanho = 32;

echo '<div class="'.$idiomas_class.'">';
echo '<ul>';
foreach($arrSETTINGS['idiomas'] as $k => $v) {
	$link = ( !$interno ? 'href="'.$arrSETTINGS['url_site_admin'].'/lang.php?id='.$k.'&referer='.$_SERVER['REQUEST_URI'].'"' : 'href="javascript: void(0);" rel="'.$k.'"' );
	echo '<li><a class="'.$idioma_link.''.( $k == $_SESSION['lingua'] ? 'active' : '' ).'" '.$link.'>'.( $flags_iso ? '<img src="'.$arrSETTINGS['url_site'].'/imgs/flags_iso/'.$flags_iso_tamanho.'/'.$k.'.png" />' : $k ).'</a></li>';
}
echo '</ul>';
echo '</div>';
echo '<div class="clear"></div>';
?>
