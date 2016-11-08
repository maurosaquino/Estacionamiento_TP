<?php 
	include_once('lib/nusoap.php');
	require_once('../class/traerdata.php');
	
	$server = new nusoap_server(); 

	$server->configureWSDL('WebService Con PDO', 'urn:wsPdo'); 

///**********************************************************************************************************///								
//REGISTRO METODO SIN PARAMETRO DE ENTRADA Y PARAMETRO DE SALIDA 'ARRAY de ARRAYS'

	$server->register('obtenerVehiculos',                	
						array(),  
						array('return' => 'xsd:Array'),   
						'urn:wsPdo',                		
						'urn:wsPdo#obtenerVehiculos',             
						'rpc',                        		
						'encoded',                    		
						'Obtiene todos los vehiculos'    			
					);

	$server->register('obtenerFacturacion',                	
						array(),  
						array('return' => 'xsd:Array'),   
						'urn:wsPdo',                		
						'urn:wsPdo#obtenerFacturacion',             
						'rpc',                        		
						'encoded',                    		
						'Obtiene la facturacion acumulada'    			
					);

	$server->register('obtenerUsuarios',                	
						array(),  
						array('return' => 'xsd:Array'),   
						'urn:wsPdo',                		
						'urn:wsPdo#obtenerVehiculos',             
						'rpc',                        		
						'encoded',                    		
						'Obtiene todos los usuarios'    			
					);

	$server->register('test',                	
						array(),  
						array('return' => 'xsd:string'),   
						'urn:wsPdo',                		
						'urn:wsPdo#test',             
						'rpc',                        		
						'encoded',                    		
						'Obtiene todos los usuarios'    			
					);

	function test(){

		return "Test";
	}

	function obtenerUsuarios() {
		
		return traerdata::TraerUsuarios();
	}

	function obtenerVehiculos() {
		
		return traerdata::TraerVehiculos();
	}

	function obtenerFacturacion() {
		
		return traerdata::TraerFacturacion();
	}



///**********************************************************************************************************///								

	$HTTP_RAW_POST_DATA = file_get_contents("php://input");	
	$server->service($HTTP_RAW_POST_DATA);
