<?php

class Usuario{
	
	static function GenerarPlanillaU(){

			require_once('AccesoDatos.php');
			$arrayUsuarios = array();
			
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$sql = "SELECT nombre,apellido,email,tipo_acceso,id FROM usuarios";
		
			$consulta = $objetoAccesoDato->RetornarConsulta($sql);
			$consulta->execute();
	
			$arrayUsuarios = $consulta->fetchall();

			$planilla = '<div class="table-title">
						 <table class="table-fill">
						 <thead>	
						 <tr><th class="text-left">NOMBRE</th>
						 	 <th class="text-left">APELLIDO</th>
						 	 <th class="text-left">EMAIL</th>
						 	 <th class="text-left">PERFIL</th>
						 	 <th class="text-left">ACCIONES</th>
						 </thead>
						 <tbody class="table-hover">';

			foreach($arrayUsuarios as $usuario){

				$planilla=$planilla.'<tr><td class="text-left">'.$usuario[0].'</td>
										 <td class="text-left">'.$usuario[1].'</td>
										 <td class="text-left">'.$usuario[2].'</td>
										 <td class="text-left">'.$usuario[3].'</td>
										 <td class="text-left"><button type="button" id="boton_tabla" onclick="ModificarUsuario('.$usuario[4].')">Modificar</button></td>	
									 </tr>';
		
			}

			$planilla = $planilla.' </tbody>
									</table>
									</div>';

			return $planilla;
		}

	static function ModificarUsuario($id){

		 	require_once('AccesoDatos.php');
			$arrayUsuarios = array();
			
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		
			$sql = "SELECT nombre,apellido,email,tipo_acceso,id FROM usuarios";
			
			$consulta = $objetoAccesoDato->RetornarConsulta($sql);
			$consulta->bindValue(':parametro',  $id, PDO::PARAM_INT);
			$consulta->execute();
	
			$arrayUsuarios = $consulta->fetchall();

			$planilla = '<div class="table-title">
						 <table class="table-fill">
						 <thead>	
						 <tr><th class="text-left">NOMBRE</th>
						 	 <th class="text-left">APELLIDO</th>
						 	 <th class="text-left">EMAIL</th>
						 	 <th class="text-left">PERFIL</th>
						 	 <th class="text-left">ACCIONES</th>
						 </thead>
						 <tbody class="table-hover">';

			foreach($arrayUsuarios as $usuario){

				if($usuario[4]!=$id){
				$planilla=$planilla.'<tr><td class="text-left">'.$usuario[0].'</td>
										 <td class="text-left">'.$usuario[1].'</td>
										 <td class="text-left">'.$usuario[2].'</td>
										 <td class="text-left">'.$usuario[3].'</td>
										 <td class="text-left"><button type="button" id="boton_tabla" onclick="ModificarUsuario('.$usuario[4].')">Modificar</button></td>	
									 </tr>';
				}else{

				$planilla=$planilla.'<tr><td class="text-left"><input type="text" value="'.$usuario[0].'" id="nom"></ td>
										 <td class="text-left"><input type="text" value="'.$usuario[1].'" id="ape"></td>
										 <td class="text-left"><input type="text" value="'.$usuario[2].'" id="mail"></td>';
				if($usuario[3]=="ADMIN"){						 
				$planilla=$planilla.'<td class="text-left"> 
													 	<select id="perf">
  														<option value="ADMIN" selected="selected">ADMIN</option>
  														<option value="USER">USER</option>
  														</select>
  										  </td>';
  				}else{	$planilla=$planilla.'<td class="text-left"> 
													 	<select id="perf">
  														<option value="ADMIN">ADMIN</option>
  														<option value="USER" selected="selected">USER</option>
  														</select>
  										  </td>';}

				$planilla=$planilla.'<td class="text-left"><button type="button" id="boton_tabla" onclick="GuardarUsuario('.$usuario[4].')">Guardar</button><br><br>
										 <button type="button" id="boton_tabla" onclick="MostrarPlanilla(3)">Cancelar</button></td>	
									 </tr>';

				}
			}

			$planilla = $planilla.' </tbody>
									</table>
									</div>';

			return $planilla;
		}	

	static function GuardarUsuario($user){

				require_once('AccesoDatos.php');
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();

				$consulta =$objetoAccesoDato->RetornarConsulta('UPDATE usuarios 
																	SET nombre=:nom,
																	    apellido=:ape,
																	    email=:mai,
																	    tipo_acceso=:per
																WHERE id=:id');
				$consulta->bindValue(':id',   $user[0], PDO::PARAM_INT);
				$consulta->bindValue(':nom',  $user[1], PDO::PARAM_INT);
				$consulta->bindValue(':ape',  $user[2], PDO::PARAM_INT);
				$consulta->bindValue(':mai',  $user[3], PDO::PARAM_INT);
				$consulta->bindValue(':per',  $user[4], PDO::PARAM_INT);

				$consulta->execute();

				return include('html/confmodifu.html');
		}	
}


?>