// JavaScript Document

$(document).ready(function() {

	// set dos campos de idioma
	$(".form_lingua").css("display","none");
	$(".form_lingua_" + tabactivo).css("display","block");	
	
	// isto vai ser para colocar o display:none, neste momento estamos em testes de ckeditor
	$(".form_lingua_htmlarea").css("display","none");

	// troca de idioma
	$(".set_lingua").click(function(){
		var novo_idioma = $(this).attr("rel");
		$(".form_lingua").css("display","none");
		$(".form_lingua_" + novo_idioma).css("display","block");
		$(".set_lingua").removeClass("active");
		$(this).addClass("active");
		if($(".form_lingua_htmlarea_" + tabactivo).length) {
			$('.form_lingua_htmlarea_' + tabactivo).each(function() {
				var nome_campo = $(this).attr("rel");
				var value_ckeditor = CKEDITOR.instances[nome_campo].getData();
				$(this).val(value_ckeditor);
				CKEDITOR.instances[nome_campo].setData($('#'+nome_campo+'_'+novo_idioma).val());
			});
			tabactivo = novo_idioma;
		}
	});	

	// bloquear a tecla ENTER, impedindo a realização do submit de um form
	$('input[type=text]').on('keydown', function(e) {
		if (e.which == 13) {
			e.preventDefault();
		}
	});
	
	// ao clicar em gravar, actualizar as textareas
	$("#submitform").click(function(){
		if($(".form_lingua_htmlarea_" + tabactivo).length) {
			$('.form_lingua_htmlarea_' + tabactivo).each(function() {
				var nome_campo = $(this).attr("rel");
				var value_ckeditor = CKEDITOR.instances[nome_campo].getData();
				$(this).val(value_ckeditor);
			});
		}
	});	
	
	// --------------------------
	// icons nos links
	// --------------------------
	$("a.rollhover_img").hover(function() {
		$("img", this).attr("src", $("img", this).attr("hover-src"));
	}, function() {
		$("img", this).attr("src", $("img", this).attr("normal-src"));
	});
	// --------------------------

});