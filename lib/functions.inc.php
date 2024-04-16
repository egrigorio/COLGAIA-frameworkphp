<?php
# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Funções genéricas da framework
# ---------------------------------------

function data_extenso($dia_semana = 0, $data = NULL) {
	if($data=='0000-00-00') {
		return;
	}
	$meses = array(1 => 'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
	$dias_da_semana = array('Domingo','Segunda-Feira','Terça-Feira','Quarta-Feira','Quinta-Feira','Sexta-Feira','Sábado');
	
	if($data == NULL) {
		$str = ($dia_semana == 1 ? $dias_da_semana[date('w')] . ', ' : '' ) . date('j').' de '.$meses[date('n')].' de '.date('Y');
	} else {
		list($year, $month, $day) = explode('-', $data);
		$d_dia_semana = date("w", mktime(0, 0, 0, intval($month), intval($day), intval($year)));
		$str = ($dia_semana == 1 ? $dias_da_semana[$d_dia_semana] . ', ' : '' ) . intval($day).' de '.$meses[intval($month)].' de '.intval($year);
	}
	
	return $str;
}

function stats() {
	$url = $_SERVER['REQUEST_URI'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$sessao = session_id();
	$data = date('Y-m-d H:i:s');
	$id_user = isset($_SESSION['USER_ID']) ? $_SESSION['USER_ID'] : 0 ;
	
	$query = "INSERT INTO stats (url, ip, sessao, data, id_user) VALUES ('$url', '$ip','$sessao','$data','$id_user')";
	$res = db_query($query);
}

function callback($interno = 0) {
	global $arrSETTINGS;

    $buffer = ob_get_contents();
    ob_end_clean();
    $b = $buffer;
	
    // Se for o callback principal, trata 
    // da questão do template a usar no layout
    if ($interno == 0) {
		
		# definir o modelo de página a utilizar
		if(!isset($arrSETTINGS['template'])) { $arrSETTINGS['template'] = 'default'; }
		$templateToInclude = $arrSETTINGS['dir_template'] . $arrSETTINGS['template'] . ".html";
		if(!is_file($templateToInclude)) { die("ERRO: Template inválido!"); }

        ob_start();
            include "$templateToInclude";
            $mostrar = ob_get_contents();
        ob_end_clean();

        $b = str_replace("{conteudo}", $b, $mostrar);
    }

    // Obtém o array matches com 
    // todas as funções chamadas no código
    preg_match_all ("/{([^} ]+)}/", $b, $matches);

    if (isset($matches[1])) {				
        $smarttag_total	= count($matches[1]);

        if(is_readable($arrSETTINGS['dir_smarttag'])) {
            for ($i_SMARTTAGS = 0; $i_SMARTTAGS < $smarttag_total; $i_SMARTTAGS++) {
                $string    		= $matches[1][$i_SMARTTAGS];              			// a string dentro de chavetas
                $temp      		= explode(":", $string, 2);      					// o array com nome da funcao e parametros
                $funcao    		= $temp[0];                      					// o nome da funcao
                $smarttag_file	= $arrSETTINGS['dir_smarttag'] . $funcao . ".php"; 	// o ficheiro a ser executado
                $params    		= array();

                // Se existem parametros
                if (isset($temp[1])) {

                    // Se os parametros vêm tipo query-string
                    // Ex: id=1&doc=teste
                    if (strpos($temp[1], "=")) {

                        // $params["id"]  = 1; 
                        // $params["doc"] = "teste"
                        parse_str($temp[1], $params);

                    // Se os parametros vêm apenas separados por :
                    // Ex: 1:teste 
                    } else {

                        // $params["0"] = 1; 
                        // $params["1"] = "teste";
                        $params = explode(":", $temp[1]);
                    }
                }

                ob_start();
                    // Ignora chamada da função se o ficheiro não existe 
                    if (!is_readable($smarttag_file))  {
                        $smarttag_result = "{" . $string . "}";
                    } else {
                        include "$smarttag_file";
                        $smarttag_result = callback(1); // recursividade de tags
                    }
                #ob_end_clean();
                $b = str_replace("{".$string."}", $smarttag_result, $b);
            }
        } 
    }
	
    // Se for um callback interno devolve html gerado
	// Se for callback principal envia html final para o browser
    if ($interno == 1) {
		return $b; 
	} else {
		echo $b;
	}
}

function generate_password($username, $password) {
	$nova_password = md5($username.$password);
	$nova_password = substr($nova_password,0,3).$nova_password;
	return md5($nova_password);
}

function pr($arr) {
	echo '<div class="clear"></div>';
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}
?>