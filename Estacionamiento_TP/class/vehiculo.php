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
		
				return  '  <div class="login-page">
                           <div class="form">
                           <h3> VEHICULO INGRESADO</h3>
 	                       </div>
     	                   </div>';

			}else{

				return  '  <div class="login-page">
                      	   <div class="form">
                           <h3> ERROR: El vehiculo ya esta en el estacionamiento</h3>
                           </div>
                           </div>';
			}
		}

		//METODO QUE VALIDA SI EL VEHICULO YA ESTA EN EL ESTACIONAMIENTO
		
		static function ValidarIngresoEgreso($pat){

			$arrayVehiculos = array();
			$arrayVehiculos = vehiculo::TraerVehiculos();

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
     
				$vehiculoegreso = vehiculo::BuscarVehiculo($pat);
				$ahora = date('d-m-y H:i:s');
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
						
			return vehiculo::GenerarTicket($vehiculoegreso);
			
		}

		//METODO QUE TRAE TODOS LOS VEHICULOS DE LA BASE DE DATOS
		static function TraerVehiculos(){

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$sql = "SELECT patente, ingreso
					FROM vehiculo
					WHERE egreso is null";
		
			$consulta = $objetoAccesoDato->RetornarConsulta($sql);
			$consulta->execute();
	
			return $consulta->fetchall();
		}

		//METODO PARA BUSCAR UN VEHICULO ESPECIFICO
		static function BuscarVehiculo($pat){

			$arrayvehiculo = array();

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$consulta =$objetoAccesoDato->RetornarConsulta('SELECT patente, ingreso
					FROM vehiculo
					WHERE patente =:pat
					AND  egreso is null');
				$consulta->bindValue(':pat',$pat, PDO::PARAM_INT);
				$consulta->execute();	
				
			$arrayvehiculo = $consulta->fetchall();
			
			$vehiculoencontrado = new vehiculo($arrayvehiculo[0][0],$arrayvehiculo[0][1]);
			
			return $vehiculoencontrado;
		}

		//METODO QUE GENERA LA PLANILLA DE AUTOS ACTUALES
		static function GenerarPlanillaV(){

			require_once('AccesoDatos.php');
			$arrayVehiculos = array();
			$arrayVehiculos = vehiculo::TraerVehiculos();

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

		//METODO QUE GENERA EL TICKET AL EGRESO
		static function GenerarTicket($ve){

			return  '<table>
					 <tr><th><h3>ESTACIONAMIENTO UTN</h3></th></tr>
					 <tr><th>Patente: </th><td>'.$ve->GetPatente().'</td></tr>
					 <tr><th>Ingreso: </th><td>'.$ve->GetIngreso().'</td></tr>
					 <tr><th>Egreso: </th><td>'.$ve->GetEgreso().'</td></tr>
					 <tr><th>Importe:</th><td>'.'$'.$ve->GetImporte().'</td></tr>
					 </table>';
		}

		//METODO QUE GENERA LA PLANILLA DE IMPORTE POR AUTO
		static function GenerarPlanillaF(){

			require_once('AccesoDatos.php');
			$arrayVehiculos = array();
			
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$sql = "SELECT patente, round(sum(importe_abonado),2) FROM vehiculo 
					WHERE egreso is not null
					group by patente";
		
			$consulta = $objetoAccesoDato->RetornarConsulta($sql);
			$consulta->execute();
	
			$arrayVehiculos = $consulta->fetchall();

			$planilla = '<div class="table-title">
						 <table class="table-fill">
                         <thead>	
						 <tr><th class="text-left">PATENTE</th><th class="text-left">TOTAL ACUMULADO</th>
						 </thead>
						 <tbody class="table-hover">';

			foreach($arrayVehiculos as $vehiculo){

				$planilla=$planilla.'<tr><td class="text-left">'.$vehiculo[0].'</td><td class="text-left">'.$vehiculo[1].'</td></tr>';
		
			}

			$planilla = $planilla.' </tbody>
					      			</table>
					      			</div>';

			return $planilla;
		}

		
	}


?>	