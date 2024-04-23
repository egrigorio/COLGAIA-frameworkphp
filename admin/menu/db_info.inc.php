<?php
# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Especificação dos campos da tabela
# ---------------------------------------																														
				
	$arrForm = array(	'tabela' 	=> array('tabela' => 1, 
										 'tabela_nome' => 'menu', 
										 'lingua' => 1,
										 'tabela_nome_lingua' => 'menu_linguas', 
										 'listagem_campos' => 'menu.*, menu_linguas.*',
										 'join' => 'menu.id = menu_linguas.id',
										 'ordenacao' => 'menu.id DESC',
										 'paginacao' => 25,
										 'label' => 'Menu',
										 'folder' => 'menu'
										 ),
					
					'inserir' 	=> array('listagem' => 1, 
										 'label' => 'Inserir', 
										 'icon' => 'insert.png', 
										 'icon_hover' => 'insert_2.png'
										 ),
					
					'editar' 	=> array('listagem' => 1,
										 'listagem_width' => '100',
										 'label' => 'Editar', 
										 'icon' => 'edit.png', 
										 'icon_hover' => 'edit_2.png'
										 ),

					'eliminar' 	=> array('listagem' => 1, 
										 'listagem_width' => '100',
										 'label' => 'Eliminar', 
										 'icon' => 'delete.png', 
										 'icon_hover' => 'delete_2.png'
										 ),
										 
					'id' 		=> array('campo' => 1, 
										 'chave' => 1, 
										 'label' => 'Id', 
										 'listagem' => 1, 
										 'listagem_ordem' => 1,
										 'listagem_width' => '20',
										 'inserir' => 0, 
										 'inserir_ordem' => 1,
										 'editar' => 0, 
										 'editar_ordem' => 1
										 ),
										 
					'ordem' 	=> array('campo' => 1, 
										 'tipo' => 'text', 
										 'label' => 'Ordem', 
										 'listagem' => 1, 
										 'listagem_ordem' => 2,
										 'inserir_ordem' => 10,
										 'listagem_width' => '20',
										 'inserir' => 1, 
										 'editar' => 1,
										 'editar_ordem' => 2
										 ),
										 
					'link' 	=> array('campo' => 1,
										 'tipo' => 'text', 
										 'tamanho' => 100, 
										 'alinhamento' => 'left', 
										 'label' => 'Link', 
										 'listagem' => 1, 
										 'listagem_ordem' => 3,
										 'inserir' => 1, 
										 'inserir_ordem' => 3,
										 'editar' => 1, 
										 'editar_ordem' => 3,
										 'lingua' => 0
										 ),
										 
					'nome' 	=> array('campo' => 1, 
										 'tipo' => 'text', 
										 'tamanho' => 100, 
										 'label' => 'Nome', 
										 'listagem' => 1, 
										 'listagem_ordem' => 4,
										 'listagem_width' => '200',
										 'inserir' => 1, 
										 'inserir_ordem' => 4,
										 'editar' => 1, 
										 'editar_ordem' => 4,
										 'lingua' => 1
										 ),
					/* 'descricao' => array('campo' => 1, 
										 'tipo' => 'ckeditor', 
										 'tamanho' => 255, 
										 'label' => 'Descrição', 
										 'listagem' => 1, 
										 'listagem_ordem' => 4,
										 'listagem_width' => '200',
										 'inserir' => 1, 
										 'inserir_ordem' => 4,
										 'editar' => 1, 
										 'editar_ordem' => 4,
										 'lingua' => 1
										 ), */
										 
					/* 'lingua' 	=> array('campo' => 1, 
										 'tipo' => 'radio',  
										 'label' => 'Língua', 
										 'listagem' => 1, 
										 'listagem_ordem' => 5,
										 'listagem_width' => '200',
										 'inserir' => 0, 
										 'inserir_ordem' => 5,
										 'editar' => 1, 
										 'editar_ordem' => 5,
										 'lingua' => 1
										 ), */
										 
					/* 'data' 	=> array('campo' => 1, 
										 'tipo' => 'data', 
										 'label' => 'Data', 
										 'listagem' => 1, 
										 'listagem_ordem' => 6,
										 'listagem_width' => '90',
										 'inserir' => 1, 
										 'inserir_ordem' => 6,
										 'editar' => 1, 
										 'editar_ordem' => 6
										 ),
				 
					'foto' 		=> array('campo' => 1, 
										 'tipo' => 'file', 
										 'label' => 'Foto', 
										 'listagem' => 0, 
										 'listagem_ordem' => 7,
										 'listagem_width' => '50',
										 'inserir' => 1, 
										 'inserir_ordem' => 7,
										 'editar' => 1, 
										 'editar_ordem' => 7,
										 'editar_obrigatorio' => 0
										 ), */
										 
					/* 'img' 		=> array('campo' => 1, 
										 'tipo' => 'file', 
										 'label' => 'Imagem', 
										 'listagem' => 0, 
										 'listagem_ordem' => 8,
										 'listagem_width' => '50',
										 'inserir' => 1, 
										 'inserir_ordem' => 8,
										 'editar' => 1, 
										 'editar_ordem' => 8,
										 'editar_obrigatorio' => 0,
										 'lingua' => 1
										 ), */
					
					'ativo' 	=> array('campo' => 1, 
										 'tipo' => 'checkbox', 
										 'default' => 1, 
										 'opcoes' => array(1 => 'Sim o utilizador está autorizado a entrar no sistema'), 
										 'label' => 'Activo', 
										 'listagem' => 1, 
										 'listagem_ordem' => 9,
										 'listagem_width' => '50',
										 'inserir' => 1, 
										 'inserir_ordem' => 9,
										 'editar' => 1, 
										 'editar_ordem' => 9
										 )
				);				
