<?php
# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Funções específicas manutenção das BD da framework
# ---------------------------------------

function carrega_link_imagem($url='#', $label='', $img1='', $img2='') {
	global $arrSETTINGS;
	return '<a href="'.$url.'" '.( $img1 != '' && is_file($arrSETTINGS['dir_icons_admin'].'/'.$img1) && $img2 != '' && is_file($arrSETTINGS['dir_icons_admin'].'/'.$img2) ? 'class="rollhover_img"' : '' ).'>'.( $img1 != '' && is_file($arrSETTINGS['dir_icons_admin'].'/'.$img1) ? '<img align="texttop" src="'.$arrSETTINGS['url_icons_admin'].'/'.$img1.'" normal-src="'.$arrSETTINGS['url_icons_admin'].'/'.$img1.'" '.( $img2 != '' && is_file($arrSETTINGS['dir_icons_admin'].'/'.$img2) ? 'hover-src="'.$arrSETTINGS['url_icons_admin'].'/'.$img2.'"' : '' ).' />' : '' ).' '.$label.'</a>';
}

# ---------------------------------------
# ---------------------------------------
# ---------------------------------------

function seo_friendly_url($string){
    $string = str_replace(array('[\', \']'), '', $string);
    $string = preg_replace('/\[.*\]/U', '', $string);
    $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
    $string = htmlentities($string, ENT_COMPAT, 'utf-8');
    $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
    $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
    return strtolower(trim($string, '-'));
}

# ---------------------------------------
# ---------------------------------------
# ---------------------------------------
function salt($tamanho = 22) {
    return substr(sha1(mt_rand()), 0, $tamanho);  
}

function trata_nome_ficheiro($filename, $extension, $key_field, $modulo, $lingua = NULL) {
	global $arrSETTINGS;
	$arr = array();
	
	$id = '';
	$arrKey_field = explode(',',$key_field);
	foreach($arrKey_field as $k=>$v) {
		$v = explode('=',$v);
		$id .= str_pad($v[1], 4, "0", STR_PAD_LEFT).'-';
	}
	$id = substr($id, 0, strlen($id)-1);
	
	if(!is_dir($arrSETTINGS['dir_fotos'].'/'.$modulo)) {
		mkdir($arrSETTINGS['dir_fotos'].'/'.$modulo);
	}
	$arr['file'] = $id.'-'.seo_friendly_url($filename).( $lingua != NULL ? '-'.$lingua : '' ).'-'.salt(5).'.'.$extension;
	$arr['pathfile'] = $arrSETTINGS['dir_fotos'].'/'.$modulo.'/'.$arr['file'];
	
	return $arr;
}

# ---------------------------------------
# ---------------------------------------
# ---------------------------------------

function carrega_campo($arr, $k_arr_campos, $v_arr_campos, $inserir = 1, $lingua = 0, $res_dados = NULL) {
	global $arrSETTINGS;

	if( (isset($arr[$v_arr_campos]['editar_obrigatorio']) && $arr[$v_arr_campos]['editar_obrigatorio'] == 0) || $inserir == 1 ) {
		$valor = '';
	} elseif($lingua) {
		$valor = array();
		foreach($res_dados as $k=>$v) {
			if(isset($v['lingua'])) {
				$valor[$v['lingua']]=  $v[$v_arr_campos];
			}
		}
	} else {
		$valor =  $arr[$v_arr_campos]['developer_valor'];
	}
	$disable 	= ( isset($arr[$v_arr_campos]['editar_proibido']) && $arr[$v_arr_campos]['editar_proibido'] == 1 && $inserir == 0 ? 'disabled="disabled"' : '' );
	$tamanho 	= ( isset($arr[$v_arr_campos]['tamanho']) && $arr[$v_arr_campos]['tamanho'] == '' ? 'maxlength="'.$arr[$v_arr_campos]['tamanho'].'"' : '' );	

	if($disable != '') {
		echo '<input type="hidden" name="'.$v_arr_campos.'" value="'.$valor.'" />';
	}
	
	
	if($lingua) {

		# ---------------------------------------
		# campos com idioma
		# ---------------------------------------

		switch($arr[$v_arr_campos]['tipo']) {
			case 'hidden': 
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					$valor[$k] = (!isset($valor[$k]) ? '' : $valor[$k]);
					echo '<input type="hidden" class="custom-hidden-input form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'" value="'.( is_array($valor) ? $valor[$k] : '' ).'" />';
				}
				break;
	
			case 'file': 
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					echo '<input type="file" class="custom-file-input form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'" value="'.( is_array($valor) ? $valor[$k] : '' ).'" />';
				}
				break;
	
			case 'text': 
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					$valor[$k] = (!isset($valor[$k]) ? '' : $valor[$k]);
					echo '<input type="text" class="custom-text-input form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'" value="'.( is_array($valor) ? $valor[$k] : '' ).'" '.$tamanho.' '.$disable.' />';
				}
				break;
	
			case 'data': 
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					$valor[$k] = (!isset($valor[$k]) ? '' : $valor[$k]);
					echo '<input type="text" class="custom-data-input datepicker form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'" value="'.( is_array($valor) ? $valor[$k] : '' ).'" '.$tamanho.' '.$disable.' />';
				}
				break;
	
			case 'cor': 
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					$valor[$k] = (!isset($valor[$k]) ? '' : $valor[$k]);
					echo '<input type="text" class="custom-cor-input jscolor form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'" value="'.( is_array($valor) ? $valor[$k] : '' ).'" '.$tamanho.' '.$disable.' />';
				}
				break;
	
			case 'textarea': 
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					$valor[$k] = (!isset($valor[$k]) ? '' : $valor[$k]);
					echo '<textarea cols="60" rows="5" '.$disable.' class="custom-textarea-input form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'">'.( is_array($valor) ? $valor[$k] : '' ).'</textarea>';
				}
				break;

			case 'ckeditor': 
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					$valor[$k] = (!isset($valor[$k]) ? '' : $valor[$k]);
					echo '<input type="text" class="custom-ckeditor-input form_lingua_htmlarea form_lingua_htmlarea_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" rel="'.$v_arr_campos.'" name="'.$v_arr_campos.'_'.$k.'" value="'.( is_array($valor) ? $valor[$k] : '' ).'" />';
				}
				echo '<textarea class="custom-ckeditor-input" id="'.$v_arr_campos.'" cols="60" rows="5" '.$disable.' name="'.$v_arr_campos.'">'.( is_array($valor) ? $valor[$_SESSION['lingua']] : '' ).'</textarea>';
				echo '<script>CKEDITOR.replace("'.$v_arr_campos.'");</script>';
				break;
					
			case 'password': 
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					$valor[$k] = (!isset($valor[$k]) ? '' : $valor[$k]);
					echo '<input type="password" class="custom-password-input form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'" value="'.( is_array($valor) ? $valor[$k] : '' ).'" '.$tamanho.' '.$disable.' />';
				}
				break;
	
			case 'select':
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					echo '<select class="custom-select-input form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'" '.$disable.'>';
					foreach($arr[$v_arr_campos]['opcoes'] as $k=>$v) {
						echo '<option value="'.$k.'" '.( ( $inserir && $arr[$v_arr_campos]['default'] == $k ) || ( is_array($valor) ? $valor[$k] : '' ) == $k ? 'selected="selected"' : '' ).'>'.$v.'</option>';
					}
					echo '</select>';
				}
				break;
	
			case 'radio':
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					foreach($arr[$v_arr_campos]['opcoes'] as $k=>$v) {
						echo '<input type="radio" class="custom-radio-input form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'" value="'.$k.'" '.( ( $inserir && $arr[$v_arr_campos]['default'] == $k ) || ( is_array($valor) ? $valor[$k] : '' ) == $k ? 'checked="checked"' : '' ).' '.$disable.' />'.$v;
					}
				}
				break;
	
			case 'checkbox': 
				// resolver um problema se este campo for de idiomas, com o valor que recebe no editar
				$arrCheckbox = explode(',', $valor);
				foreach($arrSETTINGS['idiomas'] as $k => $v) {
					foreach($arr[$v_arr_campos]['opcoes'] as $k=>$v) {
						echo '<input type="checkbox" class="custom-checkbox-input form_lingua form_lingua_'.$k.'" id="'.$v_arr_campos.'_'.$k.'" name="'.$v_arr_campos.'_'.$k.'[]" value="'.$k.'" '.( ( $inserir && $arr[$v_arr_campos]['default'] == $k ) || in_array($k, $arrCheckbox) ? 'checked="checked"' : '' ).' '.$disable.' />'.$v;
					}
				}
				break;
		}
		
	} else {
	
		# ---------------------------------------
		# campos sem idioma
		# ---------------------------------------
	
		switch($arr[$v_arr_campos]['tipo']) {
			case 'hidden': 
				echo '<input type="hidden" class="custom-hidden-input" name="'.$v_arr_campos.'" value="'.$valor.'" />';
				break;
	
			case 'file': 
				echo '<input type="file" class="custom-file-input" name="'.$v_arr_campos.'" value="'.$valor.'" />';
				break;
	
			case 'text': 
				echo '<input type="text" class="custom-text-input" name="'.$v_arr_campos.'" value="'.$valor.'" '.$tamanho.' '.$disable.' />';
				break;
	
			case 'data': 
				echo '<input type="text" class="custom-data-input datepicker" name="'.$v_arr_campos.'" value="'.$valor.'" '.$tamanho.' '.$disable.' />';
				break;
	
			case 'cor': 
				echo '<input type="text" class="custom-cor-input jscolor" name="'.$v_arr_campos.'" value="'.$valor.'" '.$tamanho.' '.$disable.' />';
				break;
	
			case 'textarea': 
				echo '<textarea class="custom-textarea-input" cols="60" rows="5" '.$disable.' name="'.$v_arr_campos.'">'.$valor.'</textarea>';
				break;
				
			case 'ckeditor': 
				echo '<textarea class="custom-ckeditor-input" id="'.$v_arr_campos.'" cols="60" rows="5" '.$disable.' name="'.$v_arr_campos.'">'.$valor.'</textarea>';
				echo '<script>CKEDITOR.replace("'.$v_arr_campos.'");</script>';
				break;
	
			case 'password': 
				echo '<input type="password" class="custom-password-input" name="'.$v_arr_campos.'" value="'.$valor.'" '.$tamanho.' '.$disable.' />';
				break;
	
			case 'select':
				echo '<select class="custom-select-input" name="'.$v_arr_campos.'" '.$disable.'>';
				foreach($arr[$v_arr_campos]['opcoes'] as $k=>$v) {
					echo '<option value="'.$k.'" '.( ( $inserir && $arr[$v_arr_campos]['default'] == $k ) || $valor == $k ? 'selected="selected"' : '' ).'>'.$v.'</option>';
				}
				echo '</select>';
				break;
	
			case 'radio':
				foreach($arr[$v_arr_campos]['opcoes'] as $k=>$v) {
					echo '<input type="radio" class="custom-radio-input" name="'.$v_arr_campos.'" value="'.$k.'" '.( ( $inserir && $arr[$v_arr_campos]['default'] == $k ) || $valor == $k ? 'checked="checked"' : '' ).' '.$disable.' />'.$v;
				}
				break;
	
			case 'checkbox': 
				$arrCheckbox = explode(',', $valor);
				foreach($arr[$v_arr_campos]['opcoes'] as $k=>$v) {
					echo '<input type="checkbox" class="custom-checkbox-input" name="'.$v_arr_campos.'[]" value="'.$k.'" '.( ( $inserir && $arr[$v_arr_campos]['default'] == $k ) || in_array($k, $arrCheckbox) ? 'checked="checked"' : '' ).' '.$disable.' />'.$v;
				}
				break;
		}
	}
}

# ---------------------------------------
# ---------------------------------------
# ---------------------------------------

function db_mostra_tabela($arr) {
	global $arrSETTINGS;
	
	echo '<div id="content_listagem">';
	echo '<div class="breadcrumbs"><a href="'.$arrSETTINGS['url_site_admin'].'">Home</a> > Listagem de '.$arr['tabela']['label'].'</div>';
	
	include $arrSETTINGS['dir_site_admin'].'/include/idiomas.inc.php';
	
	// ---------------------------------------	
	// determinar os campos a apresentar e qual a ordem de apresentação	
	// é obrigatório definir a variável "listagem_ordem" no array
	// não pode existir dois números de ordem iguais
	// ---------------------------------------
	$arr_campos = array();
	$arr_campos_chave = array();
	$arr_campos_linguas = array();
	
	foreach($arr as $k=>$v) {
		if(isset($v['listagem']) && $v['listagem'] == 1 && isset($v['campo']) && $v['campo'] == 1) {
			$arr_campos[$v['listagem_ordem']] = $k;
		}
		if( (isset($v['chave']) && $v['chave'] == 1) && (isset($v['campo']) && $v['campo'] == 1) ) {
			$arr_campos_chave[] = $k;
		}
		if(isset($v['lingua']) && $v['lingua'] == 1 && isset($v['campo']) && $v['campo'] == 1) {
			$arr_campos_linguas[] = $k;
		}
	}
	ksort($arr_campos);
	
	// ---------------------------------------	
	// no SELECT podemos utilizar apenas os campos que serão necessários na listagem, 
	// mas nesse caso vamos ter a necessidade (sempre) de incluir os campos chave
	// ---------------------------------------
	if(isset($arr['tabela']['lingua']) && $arr['tabela']['lingua'] == 1) {
		$query = "SELECT ".$arr['tabela']['listagem_campos']." FROM ".$arr['tabela']['tabela_nome']." INNER JOIN ".$arr['tabela']['tabela_nome_lingua']." ON ".$arr['tabela']['join']." WHERE ".$arr['tabela']['tabela_nome_lingua'].".lingua = '".$_SESSION['lingua']."'";
	} else {
		$query = "SELECT ".$arr['tabela']['listagem_campos']." FROM ".$arr['tabela']['tabela_nome'];
	}
	
	$res = db_query($query);
	$total_registos = count($res);
	
	if(isset($arr['tabela']['ordenacao'])) {
		$query .= " ORDER BY ".$arr['tabela']['ordenacao'];
	}
	if(isset($arr['tabela']['paginacao'])) {
		$n_registos_pagina = $arr['tabela']['paginacao'];
		$pag = ( isset($_GET['p']) ? mysqli_real_escape_string($arrSETTINGS['db_link'], intval($_GET['p'])) : 1 );
		$inicio = ($pag - 1) * $arr['tabela']['paginacao'];
		$query .= " LIMIT $inicio,".$n_registos_pagina;
	}
	$res = db_query($query);
	
	if(isset($arr['tabela']['paginacao'])) {
		if($n_registos_pagina < $total_registos) {
			$str_paginacao = '';
			$str_paginacao .= '<div class="paginacao">';
			$n_paginas = ceil($total_registos / $n_registos_pagina);
			if($pag > 1) {
				$str_paginacao .= '<a href="?p=1">«</a>';
				$str_paginacao .= '<a href="?p='.($pag - 1).'" class="arrow"><</a>';
			}
			for($i=($pag-5 < 0 ? 1 : $pag-5); $i<=($pag+5 > $n_paginas ? $n_paginas : $pag+5); $i++) {
				$str_paginacao .= '<a href="?p='.$i.'" '.( $i == $pag ? 'class="active"' : '' ).'>'.$i.'</a>';
			}
			if($pag < $n_paginas) {
				$str_paginacao .= '<a href="?p='.($pag + 1).'" class="arrow">></a>';
				$str_paginacao .= '<a href="?p='.$n_paginas.'">»</a>';
			}
			$str_paginacao .= '</div>';
			echo $str_paginacao;
		}
	}

	if(isset($arr['inserir']['listagem']) && $arr['inserir']['listagem'] == 1) {
		echo '<div class="db_inserir_btn">';
		echo '<td>'.carrega_link_imagem('index.php?task=insert', ( isset($arr['inserir']['label']) ? $arr['inserir']['label'] : '' ), $arr['inserir']['icon'], $arr['inserir']['icon_hover']).'</td>';
		echo '</div>';
	}
		
	// ---------------------------------------	
	// criar o cabeçalho da tabela
	// ---------------------------------------
	echo '<table class="db_listagem">';
	echo '<tr>';
	foreach($arr_campos as $k_arr_campos=>$v_arr_campos) {
		$alinhamento = ( isset($arr[$v_arr_campos]['alinhamento']) ? ' style="text-align: '.$arr[$v_arr_campos]['alinhamento'].';"' : '' );
		$largura = ( isset($arr[$v_arr_campos]['listagem_width']) ? ' width="'.$arr[$v_arr_campos]['listagem_width'].'"' : '' );
		if(isset($arr[$v_arr_campos]['listagem']) && $arr[$v_arr_campos]['listagem'] == 1) {
			echo '<th '.$alinhamento.' '.$largura.'>'.$arr[$v_arr_campos]['label'].'</th>';
		}
	}
	if(isset($arr['editar']['listagem']) && $arr['editar']['listagem'] == 1) {
		echo '<th'.( isset($arr['editar']['listagem_width']) ? ' width="'.$arr['editar']['listagem_width'].'"' : '' ).'>'.( isset($arr['editar']['label']) ? $arr['editar']['label'] : '' ).'</th>';
	}
	if(isset($arr['eliminar']['listagem']) && $arr['eliminar']['listagem'] == 1) {
		echo '<th'.( isset($arr['eliminar']['listagem_width']) ? ' width="'.$arr['eliminar']['listagem_width'].'"' : '' ).'>'.( isset($arr['eliminar']['label']) ? $arr['eliminar']['label'] : '' ).'</th>';
	}
	echo '</tr>';

	// ---------------------------------------	
	// criar as linhas da tabela, de acordo com os resultados obtidos no SELECT
	// ---------------------------------------
	foreach($res as $k_res=>$v_res) {
		echo '<tr>';
		foreach($arr_campos as $k_arr_campos=>$v_arr_campos) {
			$alinhamento = ( isset($arr[$v_arr_campos]['alinhamento']) ? ' style="text-align: '.$arr[$v_arr_campos]['alinhamento'].';"' : '' );
			if(isset($arr[$v_arr_campos]['ip_tracer'])) {
				echo '<td '.$alinhamento.'><a target="_blank" href="http://www.infosniper.net/index.php?ip_address='.$v_res[$v_arr_campos].'">'.$v_res[$v_arr_campos].'</a></td>';
			} 
			elseif(isset($arr[$v_arr_campos]['ordem'])) {
				echo '<td '.$alinhamento.'><a target="_blank" href="http://www.infosniper.net/index.php?ip_address='.$v_res[$v_arr_campos].'">'.$v_res[$v_arr_campos].'</a></td>';
			} 
			else {
				echo '<td '.$alinhamento.'>'.$v_res[$v_arr_campos].'</td>';
			}
		}
		
		// ---------------------------------------	
		// preparar os campos chave para enviar por $_GET
		// ---------------------------------------	
		$strCamposChave = '';
		foreach($arr_campos_chave as $k=>$v) {
			$strCamposChave .= '&'.$v.'='.$v_res[$v];
		}
		// ---------------------------------------	
		
		if(isset($arr['editar']['listagem']) && $arr['editar']['listagem'] == 1) {
			echo '<td>'.carrega_link_imagem('index.php?task=edit'.$strCamposChave, ( isset($arr['editar']['label']) ? $arr['editar']['label'] : '' ), $arr['editar']['icon'], $arr['editar']['icon_hover']).'</td>';
		}
		if(isset($arr['eliminar']['listagem']) && $arr['eliminar']['listagem'] == 1) {
			echo '<td>'.carrega_link_imagem('index.php?task=delete'.$strCamposChave, ( isset($arr['eliminar']['label']) ? $arr['eliminar']['label'] : '' ), $arr['eliminar']['icon'], $arr['eliminar']['icon_hover']).'</td>';
		}
		echo '</tr>';
	}
	
	// ---------------------------------------	
	// fechar a tabela
	// ---------------------------------------
	echo '</table>';
	
	if(isset($arr['tabela']['paginacao'])) {
		if($n_registos_pagina < $total_registos) {
			echo $str_paginacao;
		}
	}
	echo '<div class="clear"></div>';
	echo '</div>';
}

# ---------------------------------------
# ---------------------------------------
# ---------------------------------------

function db_insert_form($arr) {
	global $arrSETTINGS;
	
	echo '<div id="content_inserir">';
	echo '<div class="breadcrumbs"><a href="'.$arrSETTINGS['url_site_admin'].'">Home</a> > Inserir '.$arr['tabela']['label'].'</div>';
	
	$arrSETTINGS['idiomas_interno'] = 1;
	include $arrSETTINGS['dir_site_admin'].'/include/idiomas.inc.php';
	
	// ---------------------------------------	
	// determinar os campos a apresentar e qual a ordem de apresentação	
	// é obrigatório definir a variável "inserir_ordem" no array
	// não pode existir dois números de ordem iguais
	// ---------------------------------------
	$arr_campos = array();
	$arr_campos_chave = array();
	$arr_campos_linguas = array();
		
	foreach($arr as $k=>$v) {
		if( (isset($v['inserir']) && $v['inserir'] == 1) && (isset($v['campo']) && $v['campo'] == 1) ) {
			$arr_campos[$v['inserir_ordem']] = $k;
		}
		if( (isset($v['chave']) && $v['chave'] == 1) && (isset($v['campo']) && $v['campo'] == 1) ) {
			$arr_campos_chave[] = $k;
		}
	}
	ksort($arr_campos);
	

	// ---------------------------------------	
	// criar o cabeçalho da tabela
	// ---------------------------------------
	echo '<form name="frmInserir" method="post" action="'.$_SERVER['PHP_SELF'].'?task=do_insert" enctype="multipart/form-data">';
	echo '<table class="db_inserir">';
	echo '<tr><td colspan"2">&nbsp;</td></tr>';
	foreach($arr_campos as $k_arr_campos=>$v_arr_campos) {
		if(isset($arr[$v_arr_campos]['inserir']) && $arr[$v_arr_campos]['inserir'] == 1) {
			$lingua = ( isset($arr[$v_arr_campos]['lingua']) && $arr[$v_arr_campos]['lingua'] == 1 ? 1 : 0 );
			echo '<tr>';
			echo '<td class="label">'.$arr[$v_arr_campos]['label'].':</td>';
			echo '<td>';
			echo carrega_campo($arr, $k_arr_campos, $v_arr_campos, 1, $lingua);
			echo '</td>';
			echo '</tr>';
		}
	}
	echo '<tr>';
	echo '<td></td>';
	//echo '<td><input id="submitform" type="submit" name="submit" value="Inserir" /></td>';
	echo '</tr>';
	
	// ---------------------------------------	
	// fechar a tabela
	// ---------------------------------------
	echo '<tr><td colspan"2">&nbsp;</td></tr>';
	echo '</table>';
	echo '<input id="submitform" type="submit" name="submit" value="Inserir" />';
	echo '</form>';
	echo '<div class="clear"></div>';
	echo '</div>';
}

# ---------------------------------------
# ---------------------------------------
# ---------------------------------------

function db_edit_form($arr) {
	global $arrSETTINGS;
	
	echo '<div id="content_editar">';
	echo '<div class="breadcrumbs"><a href="'.$arrSETTINGS['url_site_admin'].'">Home</a> > <a href="'.$arrSETTINGS['url_site_admin'].'/'.$arr['tabela']['folder'].'/">Listagem</a> > Editar '.$arr['tabela']['label'].'</div>';

	$arrSETTINGS['idiomas_interno'] = 1;
	include $arrSETTINGS['dir_site_admin'].'/include/idiomas.inc.php';

	// ---------------------------------------	
	// determinar os campos a apresentar e qual a ordem de apresentação	
	// é obrigatório definir a variável "editar_ordem" no array
	// não pode existir dois números de ordem iguais
	// ---------------------------------------
	$arr_campos = array();
	$arr_campos_chave = array();
	$arr_campos_linguas = array();
	
	foreach($arr as $k=>$v) {
		if( (isset($v['editar']) && $v['editar'] == 1) && (isset($v['campo']) && $v['campo'] == 1) ) {
			$arr_campos[$v['editar_ordem']] = $k;
		}
		if( (isset($v['chave']) && $v['chave'] == 1) && (isset($v['campo']) && $v['campo'] == 1) ) {
			$arr_campos_chave[] = $k;
		}
		if( (isset($v['editar']) && $v['editar'] == 1) && (isset($v['campo']) && $v['campo'] == 1) && (isset($v['lingua']) && $v['lingua'] == 1) ) {
			$arr_campos_linguas[] = $k;
		}
	}
	ksort($arr_campos);
	
	// ---------------------------------------	
	// no SELECT podemos utilizar apenas os campos que serão necessários na listagem, 
	// mas nesse caso vamos ter a necessidade (sempre) de incluir os campos chave
	// ---------------------------------------
	$strCamposChave = '';
	# preparar a string para usar os campos chave
	foreach($arr_campos_chave as $k=>$v) {
		// ------------ TRATAR DISTO ------------
		// posso vir a ter problemas aqui, se tiver mais do que um campo chave na tabela principal
		// mas o mysqli_insert_id só devolve o valor do campo auto_increment
		$strCamposChave .= $arr['tabela']['tabela_nome'].".$v = '".$_GET[$v]."' AND "; 
	}
	$strCamposChave = substr($strCamposChave, 0, strlen($strCamposChave)-5);
		
	if(isset($arr['tabela']['lingua']) && $arr['tabela']['lingua'] == 1) {
		//$query = "SELECT ".$arr['tabela']['listagem_campos']." FROM ".$arr['tabela']['tabela_nome']." INNER JOIN ".$arr['tabela']['tabela_nome_lingua']." ON ".$arr['tabela']['join']." WHERE ".$arr['tabela']['tabela_nome_lingua'].".lingua = '".$_SESSION['lingua']."'";
		$query = "SELECT ".$arr['tabela']['listagem_campos']." FROM ".$arr['tabela']['tabela_nome']." INNER JOIN ".$arr['tabela']['tabela_nome_lingua']." ON ".$arr['tabela']['join']." WHERE ".$strCamposChave;
	} else {
		$query = "SELECT ".$arr['tabela']['listagem_campos']." FROM ".$arr['tabela']['tabela_nome']." WHERE ".$strCamposChave;
	}

	$res = db_query($query);
	$total_registos = count($res);

	// ---------------------------------------	
	// criar o cabeçalho da tabela
	// ---------------------------------------
	echo '<form name="frmEditar" method="post" action="'.$_SERVER['PHP_SELF'].'?task=do_edit" enctype="multipart/form-data">';
	echo '<table class="db_editar">';
	echo '<tr><td colspan"2">&nbsp;</td></tr>';
	foreach($arr_campos_chave as $k_arr_campos_chave=>$v_arr_campos_chave) {
		$arr[$v_arr_campos_chave]['tipo']='hidden';
		$arr[$v_arr_campos_chave]['developer_valor']=$res[0][$v_arr_campos_chave];
		echo carrega_campo($arr, $k_arr_campos_chave, $v_arr_campos_chave, 0);
	}
	foreach($arr_campos as $k_arr_campos=>$v_arr_campos) {
		$arr[$v_arr_campos]['developer_valor']=$res[0][$v_arr_campos]; // só faz isto para campos da tabela normal, os campos de idiomas são feitos na function carrega_campo
		if(isset($arr[$v_arr_campos]['editar']) && $arr[$v_arr_campos]['editar'] == 1) {
			$lingua = ( isset($arr[$v_arr_campos]['lingua']) && $arr[$v_arr_campos]['lingua'] == 1 ? 1 : 0 );
			echo '<tr>';
			echo '<td class="label">'.$arr[$v_arr_campos]['label'].':</td>';
			echo '<td>';
			echo carrega_campo($arr, $k_arr_campos, $v_arr_campos, 0, $lingua, $res);
			echo '</td>';
			echo '</tr>';
		}
	}
	echo '<tr>';
	echo '<td></td>';
	//echo '<td><input id="submitform" type="submit" name="submit" value="Editar" /></td>';
	echo '</tr>';

	// ---------------------------------------	
	// fechar a tabela
	// ---------------------------------------
	echo '<tr><td colspan"2">&nbsp;</td></tr>';
	echo '</table>';
	echo '<input id="submitform" type="submit" name="submit" value="Editar" />';
	echo '</form>';
	echo '<div class="clear"></div>';
	echo '</div>';
}

# ---------------------------------------
# ---------------------------------------
# ---------------------------------------

function db_do_insert_form($arr) {
	global $arrSETTINGS;
	
	// ---------------------------------------	
	// determinar os campos para inserção
	// ---------------------------------------
	$arr_campos = array();
	$arr_campos_chave = array();
	$arr_campos_linguas = array();
		
	foreach($arr as $k=>$v) {
		if( (isset($v['inserir']) && $v['inserir'] == 1) && (isset($v['campo']) && $v['campo'] == 1) && !(isset($v['lingua']) && $v['lingua'] == 1) ) {
			$arr_campos[$v['inserir_ordem']] = $k;
		}
		if( (isset($v['chave']) && $v['chave'] == 1) && (isset($v['campo']) && $v['campo'] == 1) ) {
			$arr_campos_chave[] = $k;
		}
		if( (isset($v['inserir']) && $v['inserir'] == 1) && (isset($v['campo']) && $v['campo'] == 1) && (isset($v['lingua']) && $v['lingua'] == 1) ) {
			$arr_campos_linguas[] = $k;
			/*foreach($arrSETTINGS['idiomas'] as $k_idioma => $v_idioma) {
				$arr_campos_linguas[] = $k.'_'.$k_idioma;
			}*/
		}
	}
	ksort($arr_campos);

	// ---------------------------------------	
	// no INSERT vamos detetar registo duplicados em função da informação "inserir_unico"
	// ---------------------------------------
	// construir a query_1 e query_2, partes integrantes da instrução SELECT
	// ---------------------------------------
	$query_1 = '';
	$query_2 = '';
	
	foreach($arr as $k=>$v) {
		if(isset($v['inserir_unico']) && $v['inserir_unico'] == 1 && isset($v['campo']) && $v['campo'] == 1) {
			$query_1 .= "$k, ";
			$query_2 .= "$k = '".$_POST[$k]."' AND ";
		}
	}
	$query_1 = substr($query_1, 0, strlen($query_1)-2);
	$query_2 = substr($query_2, 0, strlen($query_2)-5);
	
	$query = "SELECT ".$query_1." FROM ".$arr['tabela']['tabela_nome']." WHERE ".$query_2;
	$res = db_query($query);

	if(is_array($res) && count($res) > 0) {
		header("Location: index.php?erro=1&campos=".$query_1); # melhorar a mensagem de erro para duplicados
		exit;
	}
	// ---------------------------------------	


	// ---------------------------------------	
	// depois de analisados os duplicados, podemos inserir na tabela o registo
	// ---------------------------------------
	// construir a query_1 e query_2, partes integrantes da instrução INSERT
	// ---------------------------------------
	$query_1 = '';
	$query_2 = '';
	
	foreach($arr_campos as $k=>$v) {
		$query_1 .= "$v, ";
		
		if($arr[$v]['tipo'] == 'file') {
			$query_2 .= "'', ";

		} elseif($arr[$v]['tipo'] == 'checkbox') {
			$valor = '';
			if(isset($_POST[$v])) {
				foreach($_POST[$v] as $k_checkbox=> $v_checkbox) {
					$valor .= $v_checkbox.',';
				}
				$valor = substr($valor, 0, strlen($valor)-1);
			} else {
				$valor = 0;
			}
			$query_2 .= "'".$valor."', ";
			
		} elseif(isset($arr[$v]['inserir_funcao'])) {
			$param = array();
			foreach($arr[$v]['inserir_funcao']['funcao_parametros'] as $k_funcao=> $v_funcao) {
				$param[]= $_POST[$v_funcao];
			}
			$valor = call_user_func_array($arr[$v]['inserir_funcao']['funcao_nome'],$param);
			$query_2 .= "'".$valor."', ";
			
		} else {
			$query_2 .= "'".$_POST[$v]."', ";
		}
	}
	$query_1 = substr($query_1, 0, strlen($query_1)-2);
	$query_2 = substr($query_2, 0, strlen($query_2)-2);

	// ---------------------------------------	
	// no INSERT vamos incluir todos os campos assinalados como inserir => 1
	// ---------------------------------------
	$query = "INSERT INTO ".$arr['tabela']['tabela_nome']." (".$query_1.") VALUES (".$query_2.")";
	$res = db_query($query);
	$key_value = $res;
	$key_field = 'id='.$res;
	
	
	
	// ---------------------------------------	
	// tratar campos de linguas, vamos utilizar o ID do insert para gravar na tabela de idiomas
	// ---------------------------------------
	if(count($arr_campos_linguas)) {
		foreach($arrSETTINGS['idiomas'] as $k_idioma => $v_idioma) {		
			$query_1 = '';
			$query_2 = '';
			
			foreach($arr_campos_linguas as $k=>$v) {
				$query_1 .= "$v, ";
				
				if($arr[$v]['tipo'] == 'file') {
					$query_2 .= "'', ";
		
				} elseif($arr[$v]['tipo'] == 'checkbox') {
					$valor = '';
					if(isset($_POST[$v.'_'.$k_idioma])) {
						foreach($_POST[$v.'_'.$k_idioma] as $k_checkbox=> $v_checkbox) {
							$valor .= $v_checkbox.',';
						}
						$valor = substr($valor, 0, strlen($valor)-1);
					} else {
						$valor = 0;
					}
					$query_2 .= "'".$valor."', ";
					
				} elseif(isset($arr[$v]['inserir_funcao'])) {
					$param = array();
					foreach($arr[$v]['inserir_funcao']['funcao_parametros'] as $k_funcao=> $v_funcao) {
						$param[]= $_POST[$v_funcao]; /* ver isto nos idiomas */
					}
					$valor = call_user_func_array($arr[$v]['inserir_funcao']['funcao_nome'],$param);
					$query_2 .= "'".$valor."', ";
					
				} else {
					$query_2 .= "'".$_POST[$v.'_'.$k_idioma]."', ";
				}
			}
			$query_1 = substr($query_1, 0, strlen($query_1)-2);
			$query_2 = substr($query_2, 0, strlen($query_2)-2);
			
			// ---------------------------------------	
			// no INSERT IDIOMA vamos incluir todos os campos assinalados como inserir => 1
			// ---------------------------------------
			$query = "INSERT INTO ".$arr['tabela']['tabela_nome_lingua']." (id, lingua, ".$query_1.") VALUES ('".$key_value."', '".$k_idioma."', ".$query_2.")";
			$res = db_query($query);
		}
	}
	
	// ---------------------------------------	
	// tratar campos de imagem, vamos utilizar o ID do insert para gravar no nome da foto
	// ---------------------------------------

	if(count($_FILES)) {
		$existe_campos_lingua = count($arr_campos_linguas);
		
		# preparar as strings, para usar na query
		$query_1 = '';
		$query_2 = '';
		
		# preparar as strings, para usar na query de idiomas
		if($existe_campos_lingua) {
			foreach($arrSETTINGS['idiomas'] as $k_idioma => $v_idioma) {
				$query_1_idioma[$k_idioma] = '';
				$query_2_idioma[$k_idioma] = '';
			}
		}

		# preparar a string para usar os campos chave
		foreach($arr_campos_chave as $k=>$v) {
			// ------------ TRATAR DISTO ------------
			// posso vir a ter problemas aqui, se tiver mais do que um campo chave na tabela principal
			// mas o mysqli_insert_id só devolve o valor do campo auto_increment
			$query_2 .= "$v = '".$res."' AND "; 
		}
		$query_2 = substr($query_2, 0, strlen($query_2)-5);


		# percorrer o vetor com as imagens enviadas
		# percorrer $_FILES
		foreach($_FILES as $k=>$v) {
			if(in_array($k, $arr_campos)) {
				if($v['error'] == 0) {
					$path_parts = pathinfo($v['name']);
					if($v['size'] < $arrSETTINGS['maxFILES_upload'] && in_array(strtolower($path_parts['extension']), $arrSETTINGS['arrFILES_upload'])) {
						$ficheiro = trata_nome_ficheiro($path_parts['filename'], strtolower($path_parts['extension']), $key_field, $arr['tabela']['tabela_nome']);
						$query_1 .= "$k = '".$ficheiro['file']."', ";
						move_uploaded_file($v['tmp_name'], $ficheiro['pathfile']);
					}
				}
			}
			// ---------------------------------------	
			// tratar campos de linguas, vamos utilizar o ID do insert para gravar na tabela de idiomas
			// ---------------------------------------
			if($existe_campos_lingua) {
				foreach($arrSETTINGS['idiomas'] as $k_idioma => $v_idioma) {
					$k_temp = str_replace('_'.$k_idioma, '', $k);
					if(in_array($k_temp, $arr_campos_linguas)) {
						if($v['error'] == 0) {
							$path_parts = pathinfo($v['name']);
							if($v['size'] < $arrSETTINGS['maxFILES_upload'] && in_array(strtolower($path_parts['extension']), $arrSETTINGS['arrFILES_upload'])) {
								$ficheiro = trata_nome_ficheiro($path_parts['filename'], strtolower($path_parts['extension']), $key_field, $arr['tabela']['tabela_nome'], $k_idioma);
								$query_1_idioma[$k_idioma] .= "$k_temp = '".$ficheiro['file']."', ";
								move_uploaded_file($v['tmp_name'], $ficheiro['pathfile']);
							}
						}
					}
				}
			}
		}

		# tratar ficheiros da tabela principal
		if($query_1 != '') {
			$query_1 = substr($query_1, 0, strlen($query_1)-2);
			$query = "UPDATE ".$arr['tabela']['tabela_nome']." SET ".$query_1." WHERE ".$query_2."";
			$res = db_query($query);
		}
		
		# tratar ficheiros da tabela de idiomas
		foreach($arrSETTINGS['idiomas'] as $k_idioma => $v_idioma) {				
			if($query_1_idioma[$k_idioma] != '') {
				$query_1_idioma[$k_idioma] = substr($query_1_idioma[$k_idioma], 0, strlen($query_1_idioma[$k_idioma])-2);
				$query_2_idioma[$k_idioma] = $query_2." AND lingua = '".$k_idioma."'";
				$query = "UPDATE ".$arr['tabela']['tabela_nome_lingua']." SET ".$query_1_idioma[$k_idioma]." WHERE ".$query_2_idioma[$k_idioma]."";
				$res = db_query($query);
			}
		}
	}
	
	header("Location: index.php");
	exit;
}

# ---------------------------------------
# ---------------------------------------
# ---------------------------------------

function db_do_edit_form($arr) {
	global $arrSETTINGS;
	
	// ---------------------------------------	
	// determinar os campos para edição
	// ---------------------------------------
	$arr_campos = array();
	$arr_campos_chave = array();
	$arr_campos_linguas = array();
	
	foreach($arr as $k=>$v) {
		if( (isset($v['editar']) && $v['editar'] == 1) && (isset($v['campo']) && $v['campo'] == 1) && !(isset($v['lingua']) && $v['lingua'] == 1) ) {
			$arr_campos[$v['editar_ordem']] = $k;
		}
		if( (isset($v['chave']) && $v['chave'] == 1) && (isset($v['campo']) && $v['campo'] == 1) ) {
			$arr_campos_chave[] = $k;
		}
		if( (isset($v['editar']) && $v['editar'] == 1) && (isset($v['campo']) && $v['campo'] == 1) && (isset($v['lingua']) && $v['lingua'] == 1) ) {
			$arr_campos_linguas[] = $k;
		}
	}
	ksort($arr_campos);

	// ---------------------------------------	
	// construir a query_1 e query_2, partes integrantes da instrução UPDATE
	// ---------------------------------------
	$query_1 = '';
	$query_2 = '';
	$arrFILES = array();
	
	foreach($arr_campos as $k=>$v) {
		$flag_alterar_campo = 1;

		if($arr[$v]['tipo'] == 'file' && isset($arr[$v]['editar_obrigatorio']) && $arr[$v]['editar_obrigatorio'] == 0 && $_FILES[$v]['error'] == 4 && $_FILES[$v]['size'] == 0) {
			$flag_alterar_campo = 0;
		} elseif($arr[$v]['tipo'] != 'file') {
			if(isset($arr[$v]['editar_obrigatorio']) && $arr[$v]['editar_obrigatorio'] == 0 && $_POST[$v] == '') {
				$flag_alterar_campo = 0;
			}
		}
		if(isset($arr[$v]['editar_proibido']) && $arr[$v]['editar_proibido'] == 1) {
			$flag_alterar_campo = 0;
		}

		
		if($flag_alterar_campo) {
			if($arr[$v]['tipo'] == 'file') {
				// não vai fazer nada aqui
				//$query_1 .= "$v = '', ";
				
			} elseif($arr[$v]['tipo'] == 'checkbox') {
				$valor = '';
				if(isset($_POST[$v])) {
					foreach($_POST[$v] as $k_checkbox=> $v_checkbox) {
						$valor .= $v_checkbox.',';
					}
					$valor = substr($valor, 0, strlen($valor)-1);
				} else {
					$valor = 0;
				}
				$query_1 .= "$v = '".$valor."', ";
			
			} elseif(isset($arr[$v]['inserir_funcao'])) {
				$param = array();
				foreach($arr[$v]['inserir_funcao']['funcao_parametros'] as $k_funcao=> $v_funcao) {
					$param[]= $_POST[$v_funcao];
				}
				$valor = call_user_func_array($arr[$v]['inserir_funcao']['funcao_nome'],$param);
				$query_1 .= "$v = '".$valor."', ";
				
			} else {
				$query_1 .= "$v = '".$_POST[$v]."', ";
			} 
		}
	}
	$key_field = '';
	foreach($arr_campos_chave as $k=>$v) {
		$key_field .= "$v=".$_POST[$v].",";
		$query_2 .= "$v = '".$_POST[$v]."' AND ";
	}
	$query_1 = substr($query_1, 0, strlen($query_1)-2);
	$query_2 = substr($query_2, 0, strlen($query_2)-5);
	$key_field = substr($key_field, 0, strlen($key_field)-1);

	// ---------------------------------------	
	// no UPDATE vamos incluir todos os campos assinalados como editar => 1
	// ---------------------------------------
	$query = "UPDATE ".$arr['tabela']['tabela_nome']." SET ".$query_1." WHERE ".$query_2."";
	$res = db_query($query);





	// ---------------------------------------	
	// tratar campos de linguas
	// ---------------------------------------
	if(count($arr_campos_linguas)) {
		foreach($arrSETTINGS['idiomas'] as $k_idioma => $v_idioma) {		
			$query_1 = '';
			$query_2 = '';
			
			foreach($arr_campos_linguas as $k=>$v) {
				$query_1 .= "$v = ";
				
				if($arr[$v]['tipo'] == 'file') {
					// não pode fazer isto, tem de deixar a imagem antiga
					$query_1 .= "'', ";
		
				} elseif($arr[$v]['tipo'] == 'checkbox') {
					$valor = '';
					if(isset($_POST[$v.'_'.$k_idioma])) {
						foreach($_POST[$v.'_'.$k_idioma] as $k_checkbox=> $v_checkbox) {
							$valor .= $v_checkbox.',';
						}
						$valor = substr($valor, 0, strlen($valor)-1);
					} else {
						$valor = 0;
					}
					$query_1 .= "'".$valor."', ";
					
				} elseif(isset($arr[$v]['inserir_funcao'])) {
					$param = array();
					foreach($arr[$v]['inserir_funcao']['funcao_parametros'] as $k_funcao=> $v_funcao) {
						$param[]= $_POST[$v_funcao]; /* ver isto nos idiomas */
					}
					$valor = call_user_func_array($arr[$v]['inserir_funcao']['funcao_nome'],$param);
					$query_1 .= "'".$valor."', ";
					
				} else {
					$query_1 .= "'".$_POST[$v.'_'.$k_idioma]."', ";
				}
			}
			$key_field = '';
			foreach($arr_campos_chave as $k=>$v) {
				$key_field .= "$v=".$_POST[$v].",";
				$query_2 .= "$v = '".$_POST[$v]."' AND ";
			}
			$query_1 = substr($query_1, 0, strlen($query_1)-2);
			$query_2 = substr($query_2, 0, strlen($query_2)-5);
			
			// ---------------------------------------	
			// no INSERT IDIOMA vamos incluir todos os campos assinalados como inserir => 1
			// ---------------------------------------
			$query = "UPDATE ".$arr['tabela']['tabela_nome_lingua']." SET ".$query_1." WHERE lingua = '".$k_idioma."' AND ".$query_2."";
			$res = db_query($query);
		}
	}


	// ---------------------------------------	
	// tratar campos de imagem, vamos utilizar o ID do insert para gravar no nome da foto
	// ---------------------------------------

	if(count($_FILES)) {
		$existe_campos_lingua = count($arr_campos_linguas);
		
		# preparar as strings, para usar na query
		$query_1 = '';
		$query_2 = '';
		
		# preparar as strings, para usar na query de idiomas
		if($existe_campos_lingua) {
			foreach($arrSETTINGS['idiomas'] as $k_idioma => $v_idioma) {
				$query_1_idioma[$k_idioma] = '';
				$query_2_idioma[$k_idioma] = '';
			}
		}

		# preparar a string para usar os campos chave
		foreach($arr_campos_chave as $k=>$v) {
			// ------------ TRATAR DISTO ------------
			// posso vir a ter problemas aqui, se tiver mais do que um campo chave na tabela principal
			// mas o mysqli_insert_id só devolve o valor do campo auto_increment
			$query_2 .= "$v = '".$res."' AND "; 
		}
		$query_2 = substr($query_2, 0, strlen($query_2)-5);


		# percorrer o vetor com as imagens enviadas
		# percorrer $_FILES
		foreach($_FILES as $k=>$v) {
			if(in_array($k, $arr_campos)) {
				if($v['error'] == 0) {
					$path_parts = pathinfo($v['name']);
					if($v['size'] < $arrSETTINGS['maxFILES_upload'] && in_array(strtolower($path_parts['extension']), $arrSETTINGS['arrFILES_upload'])) {
						$ficheiro = trata_nome_ficheiro($path_parts['filename'], strtolower($path_parts['extension']), $key_field, $arr['tabela']['tabela_nome']);
						$query_1 .= "$k = '".$ficheiro['file']."', ";
						move_uploaded_file($v['tmp_name'], $ficheiro['pathfile']);
					}
				}
			}
			// ---------------------------------------	
			// tratar campos de linguas, vamos utilizar o ID do insert para gravar na tabela de idiomas
			// ---------------------------------------
			if($existe_campos_lingua) {
				foreach($arrSETTINGS['idiomas'] as $k_idioma => $v_idioma) {
					$k_temp = str_replace('_'.$k_idioma, '', $k);
					if(in_array($k_temp, $arr_campos_linguas)) {
						if($v['error'] == 0) {
							$path_parts = pathinfo($v['name']);
							if($v['size'] < $arrSETTINGS['maxFILES_upload'] && in_array(strtolower($path_parts['extension']), $arrSETTINGS['arrFILES_upload'])) {
								$ficheiro = trata_nome_ficheiro($path_parts['filename'], strtolower($path_parts['extension']), $key_field, $arr['tabela']['tabela_nome'], $k_idioma);
								$query_1_idioma[$k_idioma] .= "$k_temp = '".$ficheiro['file']."', ";
								move_uploaded_file($v['tmp_name'], $ficheiro['pathfile']);
							}
						}
					}
				}
			}
		}


		# tratar ficheiros da tabela principal
		if($query_1 != '') {
			$query_1 = substr($query_1, 0, strlen($query_1)-2);
			$query = "UPDATE ".$arr['tabela']['tabela_nome']." SET ".$query_1." WHERE ".$query_2."";
			$res = db_query($query);
		}
		
		# tratar ficheiros da tabela de idiomas
		foreach($arrSETTINGS['idiomas'] as $k_idioma => $v_idioma) {				
			if($query_1_idioma[$k_idioma] != '') {
				$query_1_idioma[$k_idioma] = substr($query_1_idioma[$k_idioma], 0, strlen($query_1_idioma[$k_idioma])-2);
				$query_2_idioma[$k_idioma] = $query_2." AND lingua = '".$k_idioma."'";
				$query = "UPDATE ".$arr['tabela']['tabela_nome_lingua']." SET ".$query_1_idioma[$k_idioma]." WHERE ".$query_2_idioma[$k_idioma]."";
				$res = db_query($query);
			}
		}
	}

	header("Location: index.php");
	exit;
}

# ---------------------------------------
# ---------------------------------------
# ---------------------------------------

function db_delete_form($arr) {
	global $arrSETTINGS;
	
	// ---------------------------------------	
	// determinar os campos colocar na regra de DELETE, todos os campos chave
	// ---------------------------------------
	$arr_campos_chave = array();
	$arr_campos_linguas = array();
	
	foreach($arr as $k=>$v) {
		if( (isset($v['chave']) && $v['chave'] == 1) && (isset($v['campo']) && $v['campo'] == 1) ) {
			$arr_campos_chave[] = $k;
		}
	}

	// ---------------------------------------	
	// criar os filtros para a instrução de DELETE
	// ---------------------------------------
	$filtro = '';
	foreach($arr_campos_chave as $k=>$v) {
		$filtro .= "$v = '".mysqli_real_escape_string($arrSETTINGS['db_link'], $_GET[$v])."' AND ";
	}
	$filtro = substr($filtro, 0, strlen($filtro)-5);
	
	// ---------------------------------------	
	// no DELETE vamos eliminar os registos com a informação do(s) campo(s) chave
	// ---------------------------------------
	$query = "DELETE FROM ".$arr['tabela']['tabela_nome']." WHERE ".$filtro;
	$res = db_query($query);
	
	header("Location: index.php");
	exit;
}
?>