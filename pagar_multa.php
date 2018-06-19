<?php
include 'conexion.php';
session_start();
/*

Cuando se paga deuda:
-Se elimina de multa
-Se actualiza disponible(ejemplar)
-Se cambia P->D
-Si son muchas tuplas entonces se elimina la que tiene más tiempo
*/

   $id_usr=$_SESSION["ID_USUARIO"];
   $id_libro=$_SESSION["ID_LIBRO"];
   $id_multa=$_SESSION["ID_MULTA"];
   $id_prestamo=$_SESSION["ID_PRESTAMO"];
   $tuplas=$_SESSION["TUPLAS"];
   echo "USUARIO: ".$id_usr. "<br>";
   echo "LIBRO: ".$id_libro. "<br>";
   echo "MULTA: ".$id_multa. "<br>";
   echo "PRESTAMO: ".$id_prestamo. "<br>";
   //checar de donde viene a esta pagina
   
   	//Eliminamos la tupla de multas  DELETE FROM <nombreTabla> WHERE id = '4';
	   	$eliminar_multa = mysqli_query($conexion,"DELETE FROM multa WHERE Id_multa=$id_multa");
	   	if(!$eliminar_multa){
	   		echo "Multa no se elimino -.- ";
	   	}
	   	//En la tabla de pestamos cambiar P->D
	   	$actualizar_edo = mysqli_query($conexion," UPDATE prestamo SET Estado='D' WHERE Id_prestamo=$id_prestamo");
		if(!$actualizar_edo){
			echo("Error al actualizar estado");
		}	
		//Actualizar existencias
	//Actualizar exitencias 
		$libros_disponibles= mysqli_query($conexion,"SELECT * FROM ejemplar WHERE Id_libro = '$id_libro'" );
		$row=mysqli_fetch_array($libros_disponibles);
		$libros_disponibles=$row["Disponibles"];
		echo("<br>Diponibles antes: ".$libros_disponibles."<br>");
		$libros_disponibles=($libros_disponibles)+1;
		echo("<br>Diponibles despues: ".$libros_disponibles."<br>");
		$res1=mysqli_query($conexion,"UPDATE ejemplar SET Disponibles= $libros_disponibles WHERE Id_libro='$id_libro'");
		$libros_prestados= mysqli_query($conexion,"SELECT * FROM ejemplar WHERE Id_libro = '$id_libro'" );
		$row=mysqli_fetch_array($libros_prestados);
		$libros_prestados=$row["Prestados"];
		echo("<br>Prestados antes: ".$libros_prestados."<br>");
		$libros_prestados=($libros_prestados)-1;
		echo("<br>Prestados despues: ".$libros_prestados."<br>");
		$res2=mysqli_query($conexion,"UPDATE ejemplar SET Prestados= $libros_prestados WHERE Id_libro='$id_libro'");


		if($res1 and $libros_prestados and $res2){
		  	echo '<script>
		  	alert("Actualizados los disponibles etc");
		  	</script>';
		}else{
			echo '<script>
		  	alert("Error al actualizar diponibles");
		  	</script>';
		 }

		 header('Location: generar_tabla.php');

  



   //Eliminamo





?>