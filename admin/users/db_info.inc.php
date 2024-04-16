<?php
# ---------------------------------------
# Desenvolvido por Hélder Couto
# Data: 2016/02/01
#
# Especificação dos campos da tabela
# ---------------------------------------

$arrForm = array(	'tabela' 	=> array('tabela' => 1, 
										 'tabela_nome' => 'users', 
										 'listagem_campos' => '*',
										 'ordenacao' => 'id DESC',
										 'paginacao' => 25,
										 'label' => 'Utilizadores',
										 'folder' => 'users'
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
										 
					'nome' 		=> array('campo' => 1,
										 'tipo' => 'text', 
										 'tamanho' => 100, 
										 'label' => 'Nome', 
										 'listagem' => 1, 
										 'listagem_ordem' => 3,
										 'listagem_width' => '200',
										 'inserir' => 1, 
										 'inserir_ordem' => 2,
										 'editar' => 1, 
										 'editar_ordem' => 2
										 ),
										 
					'username' 	=> array('campo' => 1, 
										 'tipo' => 'text', 
										 'tamanho' => 20, 
										 'label' => 'Username', 
										 'listagem' => 1, 
										 'listagem_ordem' => 2,
										 'listagem_width' => '100',
										 'inserir' => 1, 
										 'inserir_unico' => 1, 
										 'inserir_ordem' => 3,
										 'editar' => 1, 
										 'editar_ordem' => 3,
										 'editar_proibido' => 1
										 ),
										 
					'password' 	=> array('campo' => 1, 
										 'tipo' => 'password', 
										 'tamanho' => 50, 
										 'label' => 'Password', 
										 'listagem' => 0, 
										 'listagem_ordem' => 4,
										 'inserir' => 1, 
										 'inserir_ordem' => 4,
										 'editar' => 1, 
										 'editar_ordem' => 4,
										 'editar_obrigatorio' => 0,
										 'inserir_funcao' => array('funcao_nome' => 'generate_password', 
																   'funcao_parametros' => array('username','password')
																   )
										 ),
										 
					'nivel' 	=> array('campo' => 1, 
										 'tipo' => 'select', 
										 'default' => 1, 
										 'opcoes' => array(1 => 'Utilizador', 5 => 'Administrador'), 
										 'label' => 'Nível', 
										 'listagem' => 1, 
										 'listagem_ordem' => 5,
										 'listagem_width' => '50',
										 'inserir' => 1, 
										 'inserir_ordem' => 5,
										 'editar' => 1, 
										 'editar_ordem' => 5
										 ),
				 
					'foto' 		=> array('campo' => 1, 
										 'tipo' => 'file', 
										 'label' => 'Foto', 
										 'listagem' => 1, 
										 'listagem_ordem' => 6,
										 'listagem_width' => '50',
										 'inserir' => 1, 
										 'inserir_ordem' => 6,
										 'editar' => 1, 
										 'editar_ordem' => 6,
										 'editar_obrigatorio' => 0
										 ),
					
					'activo' 	=> array('campo' => 1, 
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