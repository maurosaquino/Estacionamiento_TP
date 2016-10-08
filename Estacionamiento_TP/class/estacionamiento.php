<?php

class estacionamiento{


	static function Guardar($patente){

		$_fecha = date('Y-m-d H:i:s');
		$_renglon = $patente . "=>" . $_fecha . "\n";

		//APERTURA DEL ARCHIVO: fopen(nombre_archivo,tipo_atributo_lectura_escritura_y_si_sobreescribe)
		$miarchivo = fopen('.\txt\estacionados.txt',"a");

		//ESCRITURA DEL ARCHIVO: fwrite(puntero_al_archivo,parametro_de_Escritura) 
		fwrite($miarchivo,$_renglon);

		//CIERRE DE ARCHIVO
		fclose($miarchivo);
	}

	static function Leer(){

		$_listadoautos = array();

		$miarchivo = fopen('.\txt\estacionados.txt',"r");

		//file end of file "feof()" dice si finalizò el archivo, retorna true (si el archivo termino) o false si el archivo no se acabo.

		while (!feof($miarchivo)){

			//cada vuelta lee un renglon con "fgets()"
			//explode() separa el string por un caracter especial especificado
			$_renglon=fgets($miarchivo);
			$_auto=explode("=>",$_renglon);
			
			if($_auto[0]!=""){
			
				$_listadoautos[]=$_auto;
			}
		}

			fclose($miarchivo);

		return $_listadoautos;
	}

	static function Sacar($patente){

		$_listadoestacionados=estacionamiento::Leer();
		$_remover = false;

		foreach($_listadoestacionados as $_auto){

			if($_auto[0] == $patente){

				$_inicio = $_auto[1];


				$_inicio = str_replace("\n","",$_inicio);
				$_ahora = date('Y-m-d H:i:s');
				$_diferencia = strtotime($_ahora) - strtotime($_inicio);

				$_importe = round((($_diferencia/3600) * 80),2);
				
				estacionamiento::Facturar($patente,$_inicio,$_importe,$_ahora);

				$_remover = true;

			}
		}

		if ($_remover == true){


			$miarchivo = fopen('.\txt\estacionados.txt',"w");
			
			foreach($_listadoestacionados as $_auto){	
				
				if($_auto[0]!="" && $_auto[0]!=$patente){
				
						$_renglon = $_auto[0]."=>".$_auto[1];		
						fwrite($miarchivo,$_renglon);
				}

			}

			fclose($miarchivo);
			
			estacionamiento::Comprobante($patente,$_inicio,$_importe,$_ahora);
			
		}
	}

	static function Facturar($auto,$ingreso,$importe,$egreso){

		$fexists = file_exists('.\txt\facturacion.csv');

		$miarchivo = fopen('.\txt\facturacion.csv',"a");


		if($fexists==FALSE){

			$_renglon = "Patente; Hora_Ingreso ; Hora_Egreso ; Importe_Cobrado \n";
			fwrite($miarchivo,$_renglon);
		}

		$_renglon = $auto.";".$ingreso.";".$egreso.";".$importe."\n";

		fwrite($miarchivo,$_renglon);

		fclose($miarchivo);
	}

	static function  Comprobante($auto,$ingreso,$importe,$egreso){

		$ticket = '<html>
		<head><link rel="stylesheet" type="text/css" href="../css/estilo.css"></head>
		<body>
		<div>
		<table>
		  <tr><th>ESTACIONAMIENTO UTNFRA</th></tr>
		  <tr><td>COMPROBANTE</td></tr>
		  <tr><td>PATENTE:'. $auto.'<br></td></tr>
		  <tr><td>INGRESO:'. $ingreso.'<br></td>
		  <td>EGRESO :'. $egreso. '<br></td></tr>
		  <tr><td>IMPORTE: $'.$importe.'</td></tr>
		</table>  
		  </div> 
			  				  <script>
							  function vImprimir() {
				    				document.body.style.background = "#fff no-repeat right top";
								}
							  </script>
							  <div class="CajaInicio">
							  <form method="post" action="Index.php">
							  <input id="button" type="submit" value="Imprimir"  name="opcion" onClick= "vImprimir(); window.print();">
							  </div>
							  </form>
		</body>
		</html>';

		$miarchivo = fopen('.\html\comprobante.html',"w");

		fwrite($miarchivo,$ticket);

		fclose($miarchivo);
	}

	static function GenerarTabla($listautos){

		$miarchivo = fopen('.\html\listado.html',"w");
 	
 		$renglon ='<table>
		<tr><th>PATENTE</th><th>INGRESO</th><th>TOTAL</th><th>ACCIONES</th></tr>
		<tr>';

		foreach($listautos as $auto){

		 	 $_inicio = $auto[1];
          	 $_inicio = str_replace("\n","",$_inicio);
			 $_ahora = date('Y-m-d H:i:s');
			 $_diferencia = strtotime($_ahora) - strtotime($_inicio);
			 $_importe = round((($_diferencia/3600) * 80),2);	

			 $patente = "'".$auto[0]."'";		

		  $renglon = $renglon . '<td>'.$auto[0].'</td><td>'.$auto[1].'</td><td>$'.$_importe.'</td><td><a onclick="sacar('.$patente.')" id="button">Sacar</a></td></tr>';
		 } 

		$renglon = $renglon . '</table>';


		fwrite($miarchivo,$renglon);

		fclose($miarchivo);
	}

	static function BuscarPatente($patente){

		$miarchivo = fopen('./txt/estacionados.txt',"r");

		while (!feof($miarchivo)){

			$_renglon=fgets($miarchivo);
			$_auto=explode("=>",$_renglon);
			
			if($_auto[0]==$patente){
				
				fclose($miarchivo);
				return TRUE;
			
			} else {

				
				
			}
		}
		fclose($miarchivo);
		return FALSE;
	}

	static function GenerarError($error){

		$miarchivo = fopen('.\html\error.html',"w");
 		
 		if($error=='errorestacionar'){	

 		$renglon ='<!DOCTYPE html>
			 		<html>
					<head>
						<title>Estacionamiento - Error</title>
						<link rel="stylesheet" type="text/css" href="..\css\estiloerrorguardado.css">
					</head>
					<body>
					<div class="Error">
					<h1>EL AUTO YA SE ENCUENTRA EN EL ESTACIONAMIENTO</h1>
					</div>
					</body>
					</html>';
		}elseif($error=='errorsacar'){
		$renglon ='<!DOCTYPE html>
			 		<html>
					<head>
						<title>Estacionamiento - Error</title>
						<link rel="stylesheet" type="text/css" href="..\css\estiloerrorguardado.css">
					</head>
					<body>
					<div class="Error">
					<h1>EL AUTO NO SE ENCUENTRA EN EL ESTACIONAMIENTO</h1>
					</div>
					</body>
					</html>';
		}

		fwrite($miarchivo,$renglon);

		fclose($miarchivo);
	}



}


?>