function buscarEstudiante(){
  var grado = $("#grado").val();

  if ($grado == "") {
  	$("#estudiante").html('<option></option>');
  }else{
  	$.ajax({
  		dataType: "json",
  		data: {"grado": $grado},
  		url: "../../../Controllers/EstudiantesController.php",
  		type: "post",
  		beforeSend: function(){},
  		success: function(respuesta){
  			$("#estudiante").html(respuesta.htmloption);
  		},
  		error: function(xhr,err){
  			alert("readyState =" + xhr.readyState + " grado =" + xhr.status + "respuesta =" + xhr.responseText);
  		}
  	});
  }
}