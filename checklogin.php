<?php
include 'conexion.php';
//obtener datos
//obtener datos 
$usr=$_POST["usuario"];
//echo "Usuario es:  "; echo $usuario; echo "<br>";

$pass_=$_POST["pass"];
//echo "Contraseña es: "; echo $pass; echo "<br>";

@session_start();

$verificar_usuario = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$usr'" );

if (mysqli_num_rows($verificar_usuario)>0) {
	$row=mysqli_fetch_array($verificar_usuario);
	if($row["contrasena"]==$pass_){
		$_SESSION["usuario"] = $usr;
		$_SESSION["pass"] = $pass_;
		echo '<script>
		  alert("Bienvenido");
		  </script>';
		 header('Location: form_curp.html');
	}else{
		echo '<script>
	  	alert("Contraseña no coincide");
	  	window.history.go(-1);
	  	</script>';
	}
	
//	$_SESSION["usuario"] = usr;
//	$_SESSION["pass"] = pass_;
	
}else{
	echo '<script>
		  alert("No registrado");
		   window.history.go(-1);
		  </script>';
}
mysqli_close($conexion);
?>