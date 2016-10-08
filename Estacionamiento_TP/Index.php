<html>
<head>
	<title>Programacion III - Clase IV - Mauro Aquino</title>
	<link rel="stylesheet" type="text/css" href="css\estilo.css">
	<link rel="stylesheet" type="text/css" href="css\animacion.css">
	<script type="text/javascript" src="js/funciones.js"></script>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
</head>
<body onload="recargarTabla()">

<script>
setInterval(function() {
    if(document.getElementById("MiBotonUTNMenuInicio").hidden !== true) {
       recargarTabla();
       console.log("ejecutado");
    }
}, 300000);

</script>

	<div class="CajaInicio animated bounceIn">

		<form method="post" enctype="multipart/form-data">
		<h1>SISTEMA DE INGRESO DE ESTACIONAMIENTO</h1>
			<input type="text" placeholder="Ingrese patente..." id="patente" required><BR><BR>
           <div id="MiBotonUTNMenuInicio">
            <input type="file" name="archivoFoto" id="archivoFoto" required><BR><BR>
			<a onclick="estacionar()" id="button">Estacionar</a>
			</div>
		</form>			

		<BR>

	</div>

	<div id="tabla">

	</div>

</body>
</html>

