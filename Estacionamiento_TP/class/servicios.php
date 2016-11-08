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

}


?>