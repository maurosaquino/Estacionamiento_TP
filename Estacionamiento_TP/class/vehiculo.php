<?php

class vehiculo{
	
		private $patente;
		private $horaingreso;
		private $horaegreso;
		private $importe;

		//CONSTRUCTOR 

		function __construct($pat,$hing){

			$this->patente = $pat;
			$this->horaingreso = $hing;
		}

		//METODOS GET Y SET

		function GetPatente(){
			return $this->patente;
		}

		function GetIngreso(){
			return $this->horaingreso;
		}

		function GetEgreso(){
			return $this->horaegreso;
		}

		function SetEgreso($egreso){
		 	 $this->horaegreso=$egreso;
		}

		function SetImporte($importe){
			$this->importe=$importe;
		}

		function GetImporte(){
			return $this->importe;
		}


		//METODO PARA INGRESAR UN VEHICULO 
		static function IngresarUnVehiculo($ve){

			require_once('AccesoDatos.php');
			$validacion = false;
			$validacion = vehiculo::ValidarIngresoEgreso($ve->GetPatente());

			if($validacion==true){

				
 				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

				$consulta =$objetoAccesoDato->RetornarConsulta('INSERT INTO vehiculo (patente, ingreso) VALUES (:patente,:ingreso)');
				$consulta->bindValue(':patente',  $ve->GetPatente(), PDO::PARAM_INT);
				$consulta->bindValue(':ingreso',  $ve->GetIngreso(), PDO::PARAM_INT);
				$consulta->execute();
		
				return  include('html/confingreso.html');

			}else{

				return  include('html/erroringres.html');
			}
		}

		//METODO QUE VALIDA SI EL VEHICULO YA ESTA EN EL ESTACIONAMIENTO
		
		static function ValidarIngresoEgreso($pat){
			require_once('traerdata.php');
			
			$arrayVehiculos = array();
			$arrayVehiculos = traerdata::TraerVehiculos();

			foreach($arrayVehiculos as $vehiculo){

				if($vehiculo[0]==$pat){

					return false;

				}

			}

			return true;
		}
		
		//METODO PARA EGRESAR UN VEHICULO DEL ESTACIONAMIENTO
		static function EgresarVehiculo($pat){

			require_once('AccesoDatos.php');
			require_once('traerdata.php');
     
				$vehiculoegreso = traerdata::BuscarVehiculo($pat);
				$ahora = date('Y-M-d H:i:s');
				$diferencia = strtotime($ahora) - strtotime($vehiculoegreso->GetIngreso());

				$vehiculoegreso->SetEgreso($ahora);
				$importe = round((($diferencia/3600) * 80),2);
				$vehiculoegreso->SetImporte($importe);

				
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

					$consulta =$objetoAccesoDato->RetornarConsulta('UPDATE vehiculo SET egreso=:egr, importe_abonado=:imp WHERE patente=:pat AND egreso is null');
					$consulta->bindValue(':pat',  $vehiculoegreso->GetPatente(), PDO::PARAM_INT);
					$consulta->bindValue(':egr',  $ahora, PDO::PARAM_INT);
					$consulta->bindValue(':imp',  $importe, PDO::PARAM_INT);
					$consulta->execute();	
						
			return $vehiculoegreso;
		}

		//METODO QUE GENERA LA PLANILLA DE AUTOS ACTUALES
		static function GenerarPlanillaV($array){

			$arrayVehiculos = $array;
			
			$planilla = '<div class="table-title">
						 <table class="table-fill">
						 <thead>	
						 <tr><th class="text-left">PATENTE</th><th class="text-left">HORA INGRESO</th><th class="text-left">ACCIONES</th></tr>
						 </thead>
						 <tbody class="table-hover">';

			foreach($arrayVehiculos as $vehiculo){

				$planilla=$planilla.'<tr><td class="text-left">'.$vehiculo[0].'</td><td class="text-left">'.$vehiculo[1].'</td><td class="text-left"><button type="button" id="boton_tabla" onclick="EgresarVehiculo('."'".$vehiculo[0]."'".')">SACAR</td></tr>';
		
			}

			$planilla = $planilla.' </tbody>
									</table>
									</div>';

			return $planilla;
		}

		//METODO QUE GENERA LA PLANILLA DE IMPORTE POR AUTO
		static function GenerarPlanillaF($array){

			$arrayFacturacion = $array;

			$planilla = '<div class="table-title">
						 <table class="table-fill">
                         <thead>	
						 <tr><th class="text-left">PATENTE</th><th class="text-left">TOTAL ACUMULADO</th>
						 </thead>
						 <tbody class="table-hover">';

			foreach($arrayFacturacion as $vehiculo){

				$planilla=$planilla.'<tr><td class="text-left">'.$vehiculo[0].'</td><td class="text-left">'.$vehiculo[1].'</td></tr>';
		
			}

			$planilla = $planilla.' </tbody>
					      			</table>
					      			</div>';

			return $planilla;
		}

		
}


?>