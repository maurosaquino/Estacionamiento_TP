function MostrarLogin(){

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"mLogin"}}).then(function(exito){

		$("#contenedor").html(exito);
		cload();
		
	},function(error){

		$("#contenedor").html(error);

	});
}

function MostrarIngreso(){

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"mIngreso"}}).then(function(exito){

		$("#contenedor").html(exito);

	},function(error){

		$("#contenedor").html(error);

	});
}

function MostrarPlanilla($p){

	var parametro = $p;
	
	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"mPlanilla",para:parametro}}).then(function(exito){

		$("#contenedor").html(exito);

	},function(error){

		$("#contenedor").html(error);

	});
}

function Ingresar(){

	var pat = $("#patente").val();

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"fIngresar", patente:pat}}).then(function(exito){

	    $("#contenedor").html(exito);
	  
	    window.setTimeout(function(){
        MostrarIngreso();
    	}, 800);


	},function(error){

		$("#contenedor").html(error);

	});
}

function Login(){

	var varUsuario=$("#mail").val();
	var varClave=$("#pass").val();
	var recordar=$("#recordar").is(':checked');
	
	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"fLogin",user:varUsuario,pass:varClave,recor:recordar}}).then(function(exito){

		$("#usuario").html(exito);
		MostrarLogin();

	},function(error){

		$("#contenedor").html(error);

	});
}

function EgresarVehiculo($pat){

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"fEgreso",patente:$pat}}).then(function(exito){

		var ret = JSON.parse(exito);
		console.log(ret);

		$( "#contenedor" ).load( "html/ticket.html",function(){
														        $( "#pt" ).html(ret.p);
														        $( "#in" ).html(ret.i);
														        $( "#eg" ).html(ret.e);
														        $( "#im" ).html(ret.im);
														    	});
		
		
		
	},function(error){

		$("#contenedor").html(error);

	});
}

function desloguear(){

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"fDlogin"}}).then(function(exito){

		$("#contenedor").html(exito);
		$("#usuario").html("");
	  
	    window.setTimeout(function(){
        MostrarLogin();
    	}, 500);

	},function(error){

		$("#contenedor").html(error);

	});
}

function cload(){

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"cLoad"}}).then(function(exito){

		$("#usuario").html(exito);

	},function(error){

		$("#usuario").html(exito);

	});
}

function LoginTest($t){

	if($t==2){
	var varUsuario="admin@test.com";	
	var varClave=123;
	var recordar=$("#recordar").is(':checked');
	}else if($t==1){
	var varUsuario="usuario@test.com";	
	var varClave=123;
	var recordar=$("#recordar").is(':checked');
	}

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"fLogin",user:varUsuario,pass:varClave,recor:recordar}}).then(function(exito){

		$("#usuario").html(exito);
		MostrarLogin();

	},function(error){

		$("#contenedor").html(error);

	});
}

function ModificarUsuario($id){

	var usuario = $id;

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"fTraerMod",parametro:usuario}}).then(function(exito){

		$("#contenedor").html(exito);

	},function(error){

		$("#contenedor").html(exito);

	});
}

function GuardarUsuario($id){

	var nombre = $("#nom").val();
	var apellido = $("#ape").val();
	var email  = $("#mail").val();
	var perfil = $("#perf").val();
	var clave =  $("#clav").val();
	var usuario = $id;

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"fGuarMod",
											 id:usuario,
											 nom:nombre,
											 ape:apellido,
											 mai:email,
											 per:perfil,
											 cla:clave}}).then(function(exito){

		$("#contenedor").html(exito);
		
		window.setTimeout(function(){
        MostrarPlanilla(3);
    	}, 800);
		
	},function(error){

		$("#contenedor").html(exito);

	});
}

function MostrarFormC(){

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"mformC"}}).then(function(exito){

		$("#contenedor").html(exito);

	},function(error){

		$("#contenedor").html(exito);

	});


}

function CrearUsuario(){

	var nombre = $("#nom").val();
	var apellido = $("#ape").val();
	var email  = $("#mail").val();
	var perfil = $("#perf").val();

	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"gUNuev",
											 nom:nombre,
											 ape:apellido,
											 mai:email,
											 per:perfil,
											}}).then(function(exito){

		var t = JSON.parse(exito);
		console.log(t);

		if(t.resul=='ok'){

		$("#contenedor" ).load( "html/confaltau.html",function(){
														        $( "#psw" ).html(t.pass);
														        });
		}else{

		$("#contenedor").load("html/errormodusuariovacio.html");	

		}

	},function(error){

		$("#contenedor").html(exito);

	});

}

function ElUs($id){

	var usuario = $id;

	var c = confirm("Se va a eliminar el usuario de manera permanete. Confirmar?");
	if(c){
	$.ajax({url:"nexo.php",type:"post",data:{queHacer:"fElim",parametro:usuario}}).then(function(exito){

		$("#contenedor").html(exito);

	},function(error){

		$("#contenedor").html(exito);

	});}
}



