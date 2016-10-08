<?php
	date_default_timezone_set('America/Argentina/Buenos_Aires');


	if (isset($_POST['accion'])){

		$_accion = $_POST['accion'];

		if($_accion=='Estacionar'){

				$_patente 	= trim(strtoupper($_POST['patente']));
				
				require_once('class\estacionamiento.php');
		
				$verificacion = estacionamiento::BuscarPatente($_patente);

				if($verificacion == FALSE){
				
						estacionamiento::Guardar($_patente);
						echo 'guardado'; 						
				

				} else {

						$tipoerror = 'errorestacionar';
						estacionamiento::GenerarError($tipoerror);	

						//echo 'error'; 
						
						var_dump($_POST);

				}
		}elseif($_accion=='Sacar'){

				require_once('class\estacionamiento.php');

				$_patente 	= trim(strtoupper($_POST['patente']));

				$verificacion = estacionamiento::BuscarPatente($_patente);
	
				if($verificacion == TRUE){

						estacionamiento::Sacar($_patente);
						
						echo "comprobante";

						} else {

						$tipoerror = 'errorsacar';
						estacionamiento::GenerarError($tipoerror);
						echo "error";
	
				}
		}elseif($_accion=='Refrescar'){

				require_once('class\estacionamiento.php');
				
				$listautos = array();
				$listautos = estacionamiento::Leer();
				estacionamiento::GenerarTabla($listautos);

				include('html\listado.html');

		}

	}

	
//



?>