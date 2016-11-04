<?php
	session_start();
	date_default_timezone_set('America/Argentina/Buenos_Aires');
    
    if(!isset($_SESSION["registrado"])){
        $_SESSION['registrado'] = "no";
        }
 
	if(isset($_POST)){

		require_once('./class/vehiculo.php');
        require_once('./class/Login.php');
        
		switch ($_POST["queHacer"]) {
           
            case "cLoad":

            if($_SESSION["registrado"]=="si"){
                echo '             Logueado como: '.$_SESSION['perfil']; 
            }

            break;

    		case "mLogin":

            if($_SESSION["registrado"]=="si"){

                echo '  <div class="login-page">
                        <div class="form">
                        <button type="button" onclick=desloguear()>Cerrar Sesion</button>
                        </div>
                        </div>';


               }else{
        		echo '
                <div class="login-page">
                    <div class="form">
                    <form class="login-form">
                      <input type="text" name="mail" id="mail" placeholder="Ingrese su mail...">
                      <input  type="password" name="pass" id="pass" placeholder="Ingrese su contraseña...">
                      <label class="message">Recordarme: <input  type="checkbox" id="recordar"><br></label>
                      <button type="button" onclick="Login()">Loguearse</button><br><br>
                      <button type="button" onclick="LoginTest(1)">Test User</button>
                      <button type="button" onclick="LoginTest(2)">Test Admin</button>

                    </form>
                  </div>
                </div>
        		';}
            
        	break;
  
    		case "mIngreso":

        		if($_SESSION["registrado"]=="si"){
        		echo '
                <div class="login-page">
                <div class="form">
        		<form class="login-form">
        		<label class="message">Patente:</label><br><br>	
        		<input type="text" name="patente" id="patente" placeholder="Ingrese patente..."><br><br>
        		<button type="button" onclick="Ingresar()">Ingresar</button>
        		</form>
                </div>
                </div>
        		';}else{
                  echo  '  <div class="login-page">
                        <div class="form">
                        <h3> ERROR: Se debe estar logueado para cargar vehiculos</h3>
                        <button type="button" onclick= "MostrarLogin()">Loguearse</button>
                        </div>
                        </div>';
                   
                }

        	break;

    		case "mPlanilla":

        		if($_SESSION["registrado"]=="si"){

                switch ($_POST["para"]){    

                case 1:

    			$retorno = vehiculo::GenerarPlanillaV();
                break;

                case 2:

                $retorno = vehiculo::GenerarPlanillaF();
                break;

                case 3:

                $retorno = vehiculo::GenerarPlanillaU();
                break;

                }

                echo $retorno;
            }else{

                echo '  <div class="login-page">
                        <div class="form">
                        <h3> ERROR: Se debe estar logueado para ver la informacion</h3>
                        <button type="button" onclick= "MostrarLogin()">Loguearse</button>
                        </div>
                        </div>';
            }

        	break;

        	case "fLogin":
        		
                $logueo = new login(strtoupper($_POST["user"]),strtoupper($_POST["pass"]),$_POST["recor"]);
        		login::ValidarLogin($logueo);

                echo '             Logueado como: '.$_SESSION['perfil'];        

        	break;

            case "fIngresar":

            if($_POST["patente"] != ""){
        	$hi=date('d-m-y H:i:s');
        	$ve = new vehiculo(strtoupper($_POST["patente"]),$hi);
			$retorno = vehiculo::IngresarUnVehiculo($ve);
            echo $retorno;
            }else{

            echo '  <div class="login-page">
                      <div class="form">
                        <h3> ERROR: La patente no puede estar vacia</h3>
                        <button type="button" onclick="MostrarIngreso()">Volver</button>
                        </div>
                        </div>';
            }   
			
            
      
            break;

            case "fEgreso":

            echo vehiculo::EgresarVehiculo(strtoupper($_POST["patente"]));

            break;

            case "fDlogin":

            echo login::Desloguear();
             echo '  <div class="login-page">
                        <div class="form">
                        <button type="button">Gracias por utilizar el sistema</button>
                        </div>
                        </div>';

            break;

		}
	}



?>