<?php
# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Especificação dos campos da tabela
# ---------------------------------------

$arrForm = array(	'tabela' 	=> array('tabela' => 1, 
										 'tabela_nome' => 'stats', 
										 'listagem_campos' => '*',
										 'ordenacao' => 'id DESC',
										 'paginacao' => 25,
										 'label' => 'Estatísticas',
										 'folder' => 'stats'
										 ),
					
					'inserir' 	=> array('listagem' => 0, 
										 'label' => 'INSERIR', 
										 'icon' => 'insert.png', 
										 'icon_hover' => 'insert_2.png'
										 ),
					
					'editar' 	=> array('listagem' => 0,
										 'listagem_width' => '100',
										 'label' => 'EDITAR', 
										 'icon' => 'edit.png', 
										 'icon_hover' => 'edit_2.png'
										 ),

					'eliminar' 	=> array('listagem' => 0, 
										 'listagem_width' => '100',
										 'label' => 'ELIMINAR', 
										 'icon' => 'delete.png', 
										 'icon_hover' => 'delete_2.png'
										 ),
										 
					'id' 		=> array('campo' => 1, 
										 'chave' => 1, 
										 'label' => 'ID', 
										 'listagem' => 1, 
										 'listagem_ordem' => 1,
										 'listagem_width' => '20',
										 'inserir' => 0, 
										 'inserir_ordem' => 1,
										 'editar' => 0, 
										 'editar_ordem' => 1
										 ),
										 
					'url' 		=> array('campo' => 1,
										 'tipo' => 'text', 
										 'tamanho' => 100, 
										 'label' => 'URL', 
										 'listagem' => 1, 
										 'listagem_ordem' => 3,
										 'listagem_width' => '200',
										 'inserir' => 1, 
										 'inserir_ordem' => 2,
										 'editar' => 1, 
										 'editar_ordem' => 2,
										 'lingua' => 1
										 ),
										 
					'ip' 		=> array('campo' => 1, 
										 'tipo' => 'text', 
										 'tamanho' => 20, 
										 'label' => 'IP', 
										 'listagem' => 1, 
										 'listagem_ordem' => 2,
										 'listagem_width' => '100',
										 'inserir' => 1, 
										 'inserir_ordem' => 3,
										 'editar' => 1, 
										 'editar_ordem' => 3,
										 'ip_tracer' => 1
										 ),
										 
					'sessao' 	=> array('campo' => 1, 
										 'tipo' => 'text', 
										 'tamanho' => 50, 
										 'label' => 'SESSÃO', 
										 'listagem' => 0, 
										 'listagem_ordem' => 4,
										 'inserir' => 1, 
										 'inserir_ordem' => 4,
										 'editar' => 1, 
										 'editar_ordem' => 4
										 ),
										 
					'data' 		=> array('campo' => 1, 
										 'tipo' => 'text', 
										 'label' => 'DATA', 
										 'listagem' => 1, 
										 'listagem_ordem' => 5,
										 'listagem_width' => '50',
										 'inserir' => 1, 
										 'inserir_ordem' => 5,
										 'editar' => 1, 
										 'editar_ordem' => 5
										 ),
				 
					'id_user' 		=> array('campo' => 1, 
										 'tipo' => 'text', 
										 'label' => 'ID Utilizador', 
										 'listagem' => 1, 
										 'listagem_ordem' => 6,
										 'listagem_width' => '50',
										 'inserir' => 1, 
										 'inserir_ordem' => 6,
										 'editar' => 1, 
										 'editar_ordem' => 6
										 ),
				);
?>