<?php
# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Especificação dos campos da tabela
# ---------------------------------------

$arrForm = array(	'tabela' 	=> array('tabela' => 1, 
										 'tabela_nome' => 'produtos', 
										 'lingua' => 1,
										 'tabela_nome_lingua' => 'produtos_linguas', 
										 'listagem_campos' => 'produtos.*, produtos_linguas.*',
										 'join' => 'produtos.id = produtos_linguas.id',
										 'ordenacao' => 'produtos.id DESC',
										 'paginacao' => 25,
										 'label' => 'Brinquedos',
										 'folder' => 'produtos'
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
										 
					
										 
					'nome' 	=> array('campo' => 1,
										 'tipo' => 'text', 
										 'tamanho' => 100, 
										 'alinhamento' => 'left', 
										 'label' => 'Nome', 
										 'listagem' => 1, 
										 'listagem_ordem' => 3,
										 'inserir' => 1, 
										 'inserir_ordem' => 3,
										 'editar' => 1, 
										 'editar_ordem' => 3,
										 'lingua' => 1
										 ),
										 
					
										 
					'descricao' 	=> array('campo' => 1, 
										 'tipo' => 'ckeditor',  
										 'label' => 'Descrição', 
										 'listagem' => 0, 
										 'listagem_ordem' => 5,
										 'listagem_width' => '200',
										 'inserir' => 1, 
										 'inserir_ordem' => 5,
										 'editar' => 1, 
										 'editar_ordem' => 5,
										 'lingua' => 1
										 ),
										 
					
					
										 
					
					
					'estado' 	=> array('campo' => 1, 
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
?>