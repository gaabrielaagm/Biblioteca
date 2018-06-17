<?php
include 'conexion.php';

//$idLibro=$_POST["id_libro"]; // id_libro

$idEditorial=$_POST["id_editorial"]; // id_editorial

$idAsignatura=$_POST["id_asignatura"]; // id_asignatura

$ubicacion=$_POST["ubicacion"]; // id_ubicacion

$nombre=$_POST["nombre"]; //nombre

$volumen=$_POST["volumen"];  //volumen

$edicion=$_POST["edicion"]; //edicion

$issn=$_POST["issn"]; //issn

$isbn=$_POST["isbn"];// isbn

$idTema=$_POST["temas"];  //temas

$ejemplares=$_POST["ejemplares"]; //numero de ejemplares

//echo ($idLibro);


//hacemos la consulta

$verificar_libro = mysqli_query($conexion, "SELECT * FROM libro WHERE nombre = '$nombre'");

if(mysqli_num_rows($verificar_libro)>0){
	echo '<script>
		  alert("El libro ya existe");
		  window.history.go(-1);
		  </script>'; 
}else{

	//si no insertamos los datos; los numeros van sin comillas

	$libro_insert="INSERT INTO libro(Id_editorial,Id_tema,Id_asignatura,Nombre,Ubicacion,Volumen,Edicion,ISSN,ISBN) VALUES ($idEditorial,$idTema, $idAsignatura, '$nombre', '$ubicacion','$volumen', '$edicion', '$issn', '$isbn')";
	echo $libro_insert;
	$resultado=mysqli_query($conexion,$libro_insert); 
	if (!$resultado) {
		echo '<script>
		  alert("Error al registrar en la BD");
		 
		  </script>';
	}else{
		$obtener_id_libro = "SELECT * FROM libro WHERE Id_tema='$idTema' AND Id_asignatura='$idAsignatura' AND Nombre='$nombre';";
		$Obtener_usr = mysqli_query($conexion,$obtener_id_libro);
		$row=mysqli_fetch_array($Obtener_usr);
		$id=$row["Id"];

		$id_alfanumerico=$idTema.$idAsignatura.'0'.$id;

		if($idTema == '0'){
			$id_alfanumerico=$id_alfanumerico.'G';
		}
		if($idTema == '1'){
			$id_alfanumerico=$id_alfanumerico.'F';
		}
		if($idTema == '2'){
			$id_alfanumerico=$id_alfanumerico.'R';
		}
		if($idTema == '3'){
			$id_alfanumerico=$id_alfanumerico.'C';
		}
		if($idTema == '4'){
			$id_alfanumerico=$id_alfanumerico.'LE';
		}
		if($idTema == '5'){
			$id_alfanumerico=$id_alfanumerico.'M';
		}
		if($idTema == '6'){
			$id_alfanumerico=$id_alfanumerico.'T';
		}
		if($idTema == '7'){
			$id_alfanumerico=$id_alfanumerico.'A';
		}
		if($idTema == '8'){
			$id_alfanumerico=$id_alfanumerico.'LI';
		}
		if($idTema == '9'){
			$id_alfanumerico=$id_alfanumerico.'H';
		}

		$insert_ejemplar = "INSERT INTO ejemplar (Id_libro,Prestados,Disponibles) VALUES ('$id_alfanumerico',0,$ejemplares);";
		$resultado = mysqli_query($conexion,$insert_ejemplar); 
		echo $insert_ejemplar;

		$actualizar_libro = "UPDATE libro SET Id_libro='$id_alfanumerico' WHERE Id=$id;";
		$resultado2 = mysqli_query($conexion,$actualizar_libro); 

		if($resultado && $actualizar_libro){
			echo '<script>
			alert("El libro ha sido registrado"); 		   
			</script>';
		}
	}

}
mysqli_close($conexion); 

?>