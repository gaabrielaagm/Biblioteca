<?php
include 'conexion.php';
//obtener datos
//obtener datos 
$id_usuario=$_POST["id_usuario"];
//echo "Usuario es:  "; echo $usuario; echo "<br>";

$clave=$_POST["clave"];
//echo "Contraseña es: "; echo $pass; echo "<br>";

@session_start();

$verificar_usuario = mysqli_query($conexion,"SELECT * FROM usuarios WHERE Id_usuario = '$id_usuario'" );

if (mysqli_num_rows($verificar_usuario)>0) {
	$row=mysqli_fetch_array($verificar_usuario);
	if($row["clave"]==$clave){
		$_SESSION["usuario"] = $id_usuario;
		$_SESSION["pass"] = $clave;
		echo '<script>
		  alert("Bienvenido");
		  </script>';
		 header('Location: altasLibros.html');
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