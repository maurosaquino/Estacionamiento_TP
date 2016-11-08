<?php

class servicios{

	static function generarServicio(){

		require_once('SERVIDOR/lib/nusoap.php');

        $host = 'http://localhost/TPWS/SERVIDOR/ws.php?wsdl';
        
        $client = new nusoap_client($host);
        $err = $client->getError();
        if ($err) {
                        die();
                        return '<h2>ERROR EN LA CONSTRUCCION DEL WS:</h2><pre>' . $err . '</pre>';
                    }
        return $client;

	}	

	static function llamarServicio($parametro,$servicio){

		 $client = $servicio;

		 $resultado = $client->call($parametro, array());

         if ($client->fault) {
                     
         			$mensaje ='<h2>ERROR AL INVOCAR METODO:</h2><pre>'.print_r($resultado).'</pre>';

         			return $mensaje;

                        } else {

		                            $err = $client->getError();
		                            
		                            if ($err) {
		                                $mensaje = '<h2>ERROR EN EL CLIENTE:</h2><pre>' . $err . '</pre>';
		                    			
		                    			return $mensaje;

		                    			}else{ 
		                            	
		                            		return $resultado;

		                         	} 
                     			
		                         	
                     			}


	}


	static function randomPassword() {
			    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
			    $pass = array(); //remember to declare $pass as an array
			    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
			    for ($i = 0; $i < 8; $i++) {
			        $n = rand(0, $alphaLength);
			        $pass[] = $alphabet[$n];
			    }
			    return implode($pass); //turn the array into a string
	}	

}


?>