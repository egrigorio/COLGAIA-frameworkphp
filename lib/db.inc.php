<?php
# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Funções conexão à BD e comandos
# ---------------------------------------

function db_connect() {
	global $arrSETTINGS;
	$link = mysqli_connect($arrSETTINGS['hostname'], $arrSETTINGS['username'], $arrSETTINGS['password'], $arrSETTINGS['database']);
	if (!$link) {
		echo "Error: Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
		echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
	mysqli_set_charset($link, "UTF8");
	return $link;
}

function db_query($sql) {
	global $arrSETTINGS;	
	$result = mysqli_query($arrSETTINGS['db_link'], $sql);
	if(is_bool($result)) {
		if($id = mysqli_insert_id($arrSETTINGS['db_link'])) {
			// INSERT - Enviar o ID (campo chave) do novo registo criado
			return $id;
		}
		// GERAL - Por defeito envia o valor TRUE ou FALSE gerado da operação realizada
		return $result;
	} elseif($result) { 
		// SELECT - Guardar dados num vetor
		$arrQuery = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $arrQuery;
	}
	// PROBLEMA - Se não entrar em nunhum IF envia 0
	return 0;
}

function db_close() {
	global $arrSETTINGS;
	return mysqli_close($arrSETTINGS['db_link']);
}
?>