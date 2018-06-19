<?php
include 'conexion.php';
/*
Se le pide el ID del  usuario, se checa el ID del libro
-checar que en la tablas de prestamos haya un prestamo correspondiente a ese libro y ese usuario
-Checar en la tabla de multas si no esta multado ese prestamo
-si no esta multado pues, se pone solo el libro en D y se actualiza disponible
Si el libro esta multado, se actualiza disponible se elimina de multa se cambia a D
-Actualizar la D y eliminar en multa

-Si hay varias tuplas con el mismo libro prestado se regresa el de la fecha mas antigua

*/
$id_usr=$_POST["usuario"];
$id_libro=$_POST["libro"];


$verificar_prestamo = mysqli_query($conexion,"SELECT * FROM prestamo WHERE Id_usuario ='$id_usr' and Id_libro='$id_libro' and Estado='P'");
	//Si hubo algun resultado registrado con ese prestamo
	if(mysqli_num_rows($verificar_prestamo)>0){
		//hay una sola tupla con ese prestamo
		if(mysqli_num_rows($verificar_prestamo)==1){
			echo("Solo hay un registro<br>");
			//Obtenemos el ID del prestamo
			$row=mysqli_fetch_array($verificar_prestamo);
			$id_prestamo=$row["Id_prestamo"];
			echo("El ID del prestamo es: ".$id_prestamo);

			//Mandar a llamar el procedimiento que agrega si hay alguna multa
			$checar_multas_proc = mysqli_query($conexion,"call actualizar_multas()");
			if(!$checar_multas_proc){
				echo("Error al realizar procedimiento");
			}

			//Checamos si el libro prestado no esta en multas 						
			$verificar_multa = mysqli_query($conexion,"SELECT * FROM multa WHERE Id_prestamo ='$id_prestamo'");
			if(mysqli_num_rows($verificar_multa)>0){//hubo multa
				echo("<br>Hay multa<br>");
				//dIRECCIONAR A OTRA PAG
			}else{
				echo("<br>No Hay multa<br>");
				//Cambia el estado a P->D 
				$actualizar_edo = mysqli_query($conexion," UPDATE prestamo SET Estado='D' WHERE Id_prestamo=$id_prestamo");
				if(!$actualizar_edo){
					echo("Error al actualizar estado");
				}				
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

			}

		}else{
			echo("Hay mas de un registro<br>");
			$array=array();
			while($fila=mysqli_fetch_assoc($verificar_prestamo)){
				$array[$fila['Id_prestamo']]=$fila["Fecha_devolucion"];

			}
			$i=0;
			
			foreach ($array as $id_prestamo =>$fecha) {
				echo("<br>prestamo:  ".$id_prestamo." = ".$fecha);

				$i++;
			}
		}


	}else{
		echo '<script>
				  	alert("NO HAY PRESTAMOS");
				  	</script>';	
	}



/*


$array=array();
$verificar_prestamo = mysqli_query($conexion,"SELECT Id_libro, Fecha_prestamo FROM prestamo WHERE Id_usuario ='$id_usr' and Id_libro='$id_libro' ");
if($verificar_prestamo){
	if(mysqli_num_rows($verificar_prestamo)>0){
		while($fila=mysqli_fetch_assoc($verificar_prestamo)){
			$array[$fila['Id_libro']]=$fila["Fecha_prestamo"];

		}
		$i=0;
		
		foreach ($array as $id_libro =>$fecha) {
			echo("<br> ".$id_libro." =".$fecha);

			$i++;
		}
		$datetime1 = date_create('2009-10-11 19:10');
		$datetime2 = date_create('2009-10-13 18:23');
		$interval = date_diff($datetime1, $datetime2);
		echo "<br> Dias: ".$interval->format('%R%a días');;

		$fecha_actual = strtotime(date("d-m-Y H:i:00"));
		$fecha_entrada = strtotime("19-11-2028");
		echo "<br>Actual:".$fecha_actual;
		echo "<br>Otra:".$fecha_entrada;
		if($fecha_actual > $fecha_entrada){

			echo "<br>La fecha actual es mayor a la comparada.";
		}else{
			echo "<br>La fecha comparada es igual o menor";
		}

	}else{
		echo '<script>
			  alert("Usuario no encontrado");
			  </script>';
	}
}
*/
?>