<?php
global $arrSETTINGS;
echo '<ul>';
foreach($arrSETTINGS['idiomas'] as $k => $v) {
	echo '<li><a href="'.$arrSETTINGS['url_site'].'/lang.php?id='.$k.'">'.$v.'</a></li>';
}
echo '</ul>';
?>
