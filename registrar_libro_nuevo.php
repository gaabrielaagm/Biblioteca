<?php
include 'conexion.php';

$idLibro=$_POST["id_libro"]; // id_libro

$idEditorial=$_POST["id_editorial"]; // id_editorial

$idAsignatura=$_POST["id_asignatura"]; // id_asignatura

$idUbicacion=$_POST["id_ubicacion"]; // id_ubicacion

$nombre=$_POST["nombre"]; //nombre

$volumen=$_POST["volumen"];  //volumen

$edicion=$_POST["edicion"]; //edicion

$issn=$_POST["issn"]; //issn

$isbn=$_POST["isbn"];// isbn


//hacemos la consulta

$verificar_libro = mysqli_query($conexion, "SELECT * FROM libro WHERE id_libro = '$idLibro'");

if(mysqli_num_rows($verificar_libro)>0){
	echo '<script>
		  alert("El libro ya existe");
		  window.history.go(-1);
		  </script>'; 
}else{
	
	//si no insertamos los datos

	$libro_insert="INSERT INTO libro(Id_libro,Id_editorial,Id_tema,Id_asignatura,Id_ubicacion,Nombre,Volumen,Edicion,ISSN,ISBN) VALUES ('$idLibro', '$idEditorial', '$idAsignatura', '$idUbicacion', '$nombre', '$volumen', '$edicion', '$issn', '$isbn')";

	$resultado=mysqli_query($conexion,$libro_insert); 
	if (!$reultado) {
		echo '<script>
		  alert("Error al registrar en la BD");
		 window.history.go(-1);
		  </script>';
	}else{
		echo '<script>
		  alert("El libro ha sido registrado"); 		   
		  </script>';
		header('Location: login.html');
	}

}
mysqli_close($conexion); 

?>