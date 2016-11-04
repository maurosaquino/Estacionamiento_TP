<?php

class Login{

	private $user;
	private $password;

	function __construct($user,$pass,$recordar){

		$this->user=$user;
		$this->password=$pass;
		$this->recordar=$recordar;
	
	}

	function GetUser(){
		return $this->user;
	}

	function GetPass(){
		return $this->password;
	}

	function GetRecordar(){
		return $this->recordar;
	}


	static function ValidarLogin($login){

		require_once('AccesoDatos.php');
		$arrausuario = array();

			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$consulta =$objetoAccesoDato->RetornarConsulta('SELECT id,tipo_acceso
					FROM usuarios
					WHERE email =:user
					AND   clave =:pass');
				$consulta->bindValue(':user',$login->GetUser(), PDO::PARAM_INT);
				$consulta->bindValue(':pass',$login->GetPass(), PDO::PARAM_INT);
				$consulta->execute();	
		
		$arrayusuario=$consulta->fetchall();		
		if($consulta->rowCount()>=1){

			if($login->GetRecordar()=="true"){
			setcookie("registrado","si",  time()+36000 , '/');
			setcookie("perfil",$arrayusuario[0][1],  time()+36000 , '/');
			}else{
			setcookie("registrado","si",  time()-36000 , '/');
			setcookie("perfil",$arrayusuario[0][1],  time()-36000 , '/');
			}

			$_SESSION['registrado'] = "si";
			$_SESSION['perfil'] = $arrayusuario[0][1];

			return "Logueado con exito";
		}

			return "El usuario no existe";

	}

	static function Desloguear(){

			unset($_SESSION);
			setcookie("registrado",null, -1 , '/');
			setcookie("perfil",null,-1 , '/');	
			session_destroy();
			$_SESSION["registrado"]="no";
	}
	
}

?>