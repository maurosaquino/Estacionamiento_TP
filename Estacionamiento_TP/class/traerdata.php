<?php

class traerdata{


		static function TraerFacturacion(){

			require_once('AccesoDatos.php');
			$arrayVehiculos = array();
			
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$sql = "SELECT patente, round(sum(importe_abonado),2) as importe FROM vehiculo 
					WHERE egreso is not null
					group by patente";
		
			$consulta = $objetoAccesoDato->RetornarConsulta($sql);
			$consulta->execute();
	
			$array = $consulta->fetchall();

			$arrayfinal=array();

			if($array){
			foreach($array as $array2){

				$arrayfinal[] = array($array2["patente"],$array2["importe"]);

			}}

			return $arrayfinal;

		}

		static function TraerVehiculos(){

			require_once('AccesoDatos.php');
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$sql = "SELECT patente, ingreso
					FROM vehiculo
					WHERE egreso is null";
		
			$consulta = $objetoAccesoDato->RetornarConsulta($sql);
			$consulta->execute();

			$array = $consulta->fetchall();
			$arrayfinal=array();

			if($array){
			foreach($array as $array2){

				$arrayfinal[] = array($array2["patente"],$array2["ingreso"]);

			}}

			return $arrayfinal;

		}

		static function TraerUsuarios(){

			require_once('AccesoDatos.php');
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$sql = "SELECT nombre,apellido,email,tipo_acceso,id FROM usuarios";
		
			$consulta = $objetoAccesoDato->RetornarConsulta($sql);
			$consulta->execute();

			$array = $consulta->fetchall();
			$arrayfinal=array();

			if($array){
			foreach($array as $array2){

				$arrayfinal[] = array($array2["nombre"],$array2["apellido"],$array2["email"],$array2["tipo_acceso"],$array2["id"]);

			}}

			return $arrayfinal;

		}

		//BUSCA UN VEHICULO ESPECIFICO - RETORNA UN OBJETO VEHICULO
		static function BuscarVehiculo($pat){

			require_once('AccesoDatos.php');
			require_once('vehiculo.php');
			
			$array = array();

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$consulta =$objetoAccesoDato->RetornarConsulta('SELECT patente, ingreso
					FROM vehiculo
					WHERE patente =:pat
					AND  egreso is null');
				$consulta->bindValue(':pat',$pat, PDO::PARAM_INT);
				$consulta->execute();	
				
			$array = $consulta->fetchall();
			
			$encontrado = new vehiculo($array[0][0],$array[0][1]);
			
			return $encontrado;
		}




}

?>