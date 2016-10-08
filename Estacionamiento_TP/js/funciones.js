function recargarTabla(){
	
	$.ajax({url:"nexo.php",type:"post",data:{accion:"Refrescar"}}).then(
	function(exito){
		

		$("#tabla").html(exito);

	},function(error){

		$("#tabla").html(error);

	});

}

function estacionar(){

	var parametro =  $("#patente").val();
	var miarchivo = $("#archivoFoto").fileupload();

	$.ajax({url:"nexo.php",type:"post",data:{accion:"Estacionar", patente:parametro, archivo:miarchivo}}).then(
	function(exito){

		recargarTabla();
		//window.open("html/"+exito+".html","mywindow","menubar=0,resizable=1,width=550,height=450");
		window.alert(exito);

	},function(error){

			

	});

}


function sacar(parametro){

	var parametro =  parametro;
      	
	$.ajax({url:"nexo.php",type:"post",data:{accion:"Sacar", patente:parametro}}).then(
	function(exito){

		recargarTabla();
		window.open("html/"+exito+".html","mywindow","menubar=0,resizable=1,width=550,height=450");

	},function(error){

			

	});

}