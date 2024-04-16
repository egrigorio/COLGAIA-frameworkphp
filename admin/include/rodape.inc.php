
	<div id="rodape"><?php echo $arrSETTINGS['developer_site']; ?> &copy; <?php echo $arrSETTINGS['ano_site']; ?> - Backoffice</div>
</body>
</html>

<?php 
db_close(); 

if(isset($arrSETTINGS['debug_time']) && $arrSETTINGS['debug_time']) {
	echo '<div id="debug_time">Tempo = <span>' . round(microtime(true) - $microtimeref,3) . 's</span></div>'; 
}
?>