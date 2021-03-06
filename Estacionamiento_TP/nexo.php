<?php
	session_start();
	date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    if(!isset($_SESSION["registrado"])){
        $_SESSION['registrado'] = "no";
        }


	if(isset($_POST)){

		require_once('./class/vehiculo.php');
        require_once('./class/Login.php');
        require_once('./class/usuario.php');
        require_once('./class/servicios.php');

		switch ($_POST["queHacer"]) {
           
            case "cLoad":

                if($_SESSION["registrado"]=="si"){
                    echo '             Logueado como: '.$_SESSION['perfil']; 
                }
            break;

    		case "mLogin":

                if($_SESSION["registrado"]=="si"){

                echo include('html/botondeslog.html');


               }else{
        		echo include('html/formlogin.html');
               }
            break;
  
    		case "mIngreso":

        		if($_SESSION["registrado"]=="si"){
        		
                    echo include('html/formpatente.html');
                
                }else{
                  
                    echo  include('html/error1.html');
                   
                }
        	break;

    		case "mPlanilla":

        		if($_SESSION["registrado"]=="si"){

                $cliente = servicios::generarServicio();

                switch ($_POST["para"]){    

                case 1:

                    $retorno = servicios::llamarServicio('obtenerVehiculos',$cliente);
                    echo vehiculo::GenerarPlanillaV($retorno);
                    
 			    break;

                case 2:

                    $retorno = servicios::llamarServicio('obtenerFacturacion',$cliente);
                    echo vehiculo::GenerarPlanillaF($retorno);

                break;

                case 3:

                    $retorno = servicios::llamarServicio('obtenerUsuarios',$cliente);
                    echo usuario::GenerarPlanillaU($retorno);

                    if($_SESSION["perfil"]=='ADMIN'){
                    echo include('html/botoncu.html');
                    }   

                break;

                }

                
                }else{

                echo include('html/error2.html');
                }
        	break;

        	case "fLogin":
        		
                $logueo = new login(strtoupper($_POST["user"]),strtoupper($_POST["pass"]),$_POST["recor"]);
        		login::ValidarLogin($logueo);

                echo '             Logueado como: '.$_SESSION['perfil'];        
        	break;

            case "fIngresar":

                if($_POST["patente"] != ""){
            	$hi=date('Y-M-d H:i:s');
            	$ve = new vehiculo(strtoupper($_POST["patente"]),$hi);
    			$retorno = vehiculo::IngresarUnVehiculo($ve);
                echo $retorno;
                }else{

                echo include('html/errorpatente.html');
                }   
            break;

            case "fEgreso":

                $ve = vehiculo::EgresarVehiculo(strtoupper($_POST["patente"]));

                $array = array("p"=>$ve->GetPatente(),"i"=>$ve->GetIngreso(),"e"=>$ve->GetEgreso(),"im"=>$ve->GetImporte());

                echo json_encode($array);
            break;

            case "fDlogin":

                echo login::Desloguear();
                echo include('html/mensajesalida.html');
            break;

            case "fTraerMod":

                if($_SESSION["perfil"]=="ADMIN"){

                echo usuario::ModificarUsuario($_POST["parametro"]); 

                }else{

                 echo include('html/errormodusuario.html');   

                }
            break;

            case "fGuarMod":

                 if($_POST["nom"]=="" || $_POST["ape"]=="" || $_POST["mai"]=="" || $_POST["per"]=="" || $_POST["cla"]==""){

                    echo include('html/errormodusuariovacio.html');  

                 }else{

                 $user = array ($_POST["id"],$_POST["nom"],$_POST["ape"],$_POST["mai"],$_POST["per"],$_POST["cla"]);

                 echo usuario::GuardarUsuario($user); 
                 }
            break;

            case "mformC":

            include('html/formalta.html');

            break;

            case "gUNuev":

                 if($_POST["nom"]=="" || $_POST["ape"]=="" || $_POST["mai"]=="" || $_POST["per"]==""){

                    $resul = 'no';  
                    $npas = '0';

                 }else{

                    $npas = servicios::randomPassword();
                     $user = array ($_POST["nom"],$_POST["ape"],$_POST["mai"],$_POST["per"],$npas);

                     usuario::InsertarUsuario($user);
                     $resul='ok';
                      

                 }

                 $array=array("pass"=>$npas,"resul"=>$resul);

                 echo json_encode($array);

            break;

            case 'fElim':

                 if($_SESSION["perfil"]=='ADMIN'){
                usuario::ElimUser($_POST["parametro"]);

                echo include('html/confelim.html');
            }else{

                echo include('html/errormodusuario.html');  
            }

            break;

		}
	}



?>