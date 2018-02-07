$(function (){

	$('#btn-modificar-curso').click(function (e){
		e.preventDefault();
		var data = $('#form-modificar-curso').serialize();
		$.post("../../../Controller/CursoModificarController.php", data, function (res, est, jqXHR){
			alert('hola');
		});

	});

});