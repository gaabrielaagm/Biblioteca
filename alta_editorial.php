<?php
include 'conexion.php';

//obtener lo datos para tabla editorial
$nom_edit=$_POST["nom_editorial"];
$anio=$_POST["anio_ed"];
//datos de direccion
$pais=$_POST["pais"];
$estado=$_POST["estado"];
$ciudad=$_POST["ciudad"];
$colonia=$_POST["colonia"];
$calle=$_POST["calle"];
$cp=$_POST["cp"];

//Checar si existe una direccion igual
$cons = "SELECT * FROM direccion WHERE pais = '$pais' AND Estado='$estado' AND Ciudad= '$ciudad' AND Colonia='$colonia' AND Calle='$calle' AND CP='$cp'" ;
$dir_dif=mysqli_query($conexion,$cons);
if (mysqli_num_rows($dir_dif)>0) {
	//Obtenemos el ID de la direccion que se acaba de crear
	$row=mysqli_fetch_array($dir_dif);
	$id_direccion=$row["Id_direccion"];
	echo '<script>
	  alert("La direccion ya existe");
	  </script>';

}else{
	//INSERTAR LA DIRECCION A LA BASE DE DATOS
	$insertar_dir="INSERT INTO direccion(Pais,Estado,Ciudad,Colonia,Calle, CP) VALUES  ('$pais','$estado','$ciudad','$colonia','$calle','$cp');";

	$res=mysqli_query($conexion,$insertar_dir);
	if (!$res) {
			echo '<script>
			  alert("Error al registrar Direccion");
			  </script>';
	}else{
		echo '<script>
		  alert("Registrada la direccion "); 		   
		  </script>';
			
	}
	//Obtenemos el ID de la direccion que se acaba de crear

	$row=mysqli_fetch_array($dir_dif);
	$id_direccion=$row["Id_direccion"];


}

//Checar que la editorial exista en la BD 
$ver_editorial = mysqli_query($conexion,"SELECT * FROM editorial WHERE nombre = '$nom_edit'" );
if (mysqli_num_rows($ver_editorial )>0) { //La editorial ya existe
	
	echo '<script>
	  alert("Editorial Registrada");
	  </script>';	

}else{
	$insert_edit="INSERT INTO editorial(Id_direccion,Nombre,Anio) VALUES($id_direccion,'$nom_edit','$anio');";
	$res=mysqli_query($conexion,$insert_edit);
	if (!$res) {
		echo '<script>
		  alert("Error al registrar editorial");
		  </script>';
	}else{
		echo '<script>
		  alert("Editorial Registrada"); 		   
		  </script>';			
	}

}
mysqli_close($conexion);


?>