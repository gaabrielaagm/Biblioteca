<?php
include 'conexion.php';
<<<<<<< HEAD
session_start();
/*
Se le pide el ID del  usuario, se checa el ID del libro
-checar que en la tablas de prestamos haya un prestamo correspondiente a ese libro y ese usuario
-Checar en la tabla de multas si no esta multado ese prestamo
-si no esta multado pues, se pone solo el libro en D y se actualiza disponible
Si el libro esta multado, se actualiza disponible se elimina de multa se cambia a D
-Actualizar la D y eliminar en multa
=======
>>>>>>> 952b810eeb38f89e2e0ea4d4eb9dd5f3329aad24

$id_usr=$_POST["usuario"];
$id_libro=$_POST["libro"];

<<<<<<< HEAD

$verificar_prestamo = mysqli_query($conexion,"SELECT * FROM prestamo WHERE Id_usuario ='$id_usr' and Id_libro='$id_libro' and Estado='P'");
	//Si hubo algun resultado registrado con ese prestamo
	if(mysqli_num_rows($verificar_prestamo)>0){
		$_SESSION["ID_USUARIO"]=$id_usr;
		$_SESSION["ID_LIBRO"]=$id_libro;
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
				$row=mysqli_fetch_array($verificar_multa);
				$id_multa=$row["Id_multa"];
				$_SESSION["ID_MULTA"]=$id_multa;
				$_SESSION["ID_PRESTAMO"]=$id_prestamo;
				$_SESSION["TUPLAS"]=1;

				echo("El ID del prestamo es: ".$id_prestamo);

				echo("<br>Hay multa en 1<br>");
				header('Location: multa.html');
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
			$fec_vieja="";
			$id_fec_vieja=0;
			foreach ($array as $id_prestamo =>$fecha) {
				if($fec_vieja==""){
					echo("<br>Entre a dejar algo");
					$id_fec_vieja=$id_prestamo;
					$fec_vieja=$fecha;
				}
				echo("<br>prestamo:  ".$id_prestamo." = ".$fecha);
					if($fecha<$fec_vieja){
						$id_fec_vieja=$id_prestamo;
						$fec_vieja=$fecha;
					}
					
				$i++;
			}
			echo ("<br>Fecha vieja es: ".$fec_vieja."<br>Con id: ".$id_fec_vieja);
			//checar si hay multas

			//Mandar a llamar el procedimiento que agrega si hay alguna multa
			$checar_multas_proc = mysqli_query($conexion,"call actualizar_multas()");
			if(!$checar_multas_proc){
				echo("Error al realizar procedimiento");
			}

			//Checamos si el libro prestado no esta en multas 						
			$verificar_multa = mysqli_query($conexion,"SELECT * FROM multa WHERE Id_prestamo ='$id_fec_vieja'");
			if(mysqli_num_rows($verificar_multa)>0){//hubo multa
				$row=mysqli_fetch_array($verificar_multa);
				$id_multa=$row["Id_multa"];
				$_SESSION["ID_MULTA"]=$id_multa;
				$_SESSION["ID_PRESTAMO"]=$id_fec_vieja;
				echo("<br>Hay multa MUCHOS<br>");
				$_SESSION["TUPLAS"]=2;
				//Sacar multa más antigua de ese libro madar id
				//mandar ID prestamo



				header('Location: multa.html');
				//dIRECCIONAR A OTRA PAG
			}else{
				echo("<br>No Hay multa<br>");
				//Cambia el estado a P->D 
				$actualizar_edo = mysqli_query($conexion," UPDATE prestamo SET Estado='D' WHERE Id_prestamo=$id_fec_vieja");
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
		}


	}else{
		echo '<script>
				  	alert("NO HAY PRESTAMOS");
				  	</script>';	
	}



/*


=======
>>>>>>> 952b810eeb38f89e2e0ea4d4eb9dd5f3329aad24
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

?>