<?php
include 'conexion.php';
$id_usr=$_POST["usuario"];
$id_libro=$_POST["libro"];

$verificar_usuario = mysqli_query($conexion,"SELECT * FROM usuario WHERE Id_usuario = '$id_usr'" );

$verificar_libro= mysqli_query($conexion,"SELECT * FROM libro WHERE Id_libro = '$id_libro'" );
//checar que el haya libros disponibles par prestar
$libros_disponibles= mysqli_query($conexion,"SELECT * FROM ejemplar WHERE Id_libro = '$id_libro'" );
$row=mysqli_fetch_array($libros_disponibles);
$libros_disponibles=$row["Disponibles"];
echo("Disponibles: ".$libros_disponibles);

//curdate()
if($libros_disponibles>0){
	if (mysqli_num_rows($verificar_usuario)>0 and mysqli_num_rows($verificar_libro)>0 ) {

	//Id_prestamo,Id_libro,Id_usuario,Fecha_prestamo,Fecha_devolucion,Estado
	//P=prestado  D=Devueltos
		$insert_prestamo="INSERT INTO prestamo(Id_libro,Id_usuario,Fecha_prestamo,Fecha_devolucion,Estado) VALUES('$id_libro',$id_usr,CURDATE(),DATE_ADD(CURDATE(), INTERVAL 3 DAY),'P')";
		$res= mysqli_query($conexion,$insert_prestamo);
		if (!$res) {
			echo '<script>
			  alert("Error al registrar PRESTAMO");
			  </script>';
		}else{
			
			  //$query = "UPDATE usuario SET curp='$curp' WHERE id='$id'";
			

			  $libros_disponibles=($libros_disponibles)-1;
			  $res1=mysqli_query($conexion,"UPDATE ejemplar SET Disponibles= $libros_disponibles WHERE Id_libro='$id_libro'");

			  $libros_prestados= mysqli_query($conexion,"SELECT * FROM ejemplar WHERE Id_libro = '$id_libro'" );
			  $row=mysqli_fetch_array($libros_prestados);
			  $libros_prestados=$row["Prestados"];
			  echo("Prestados".$libros_prestados);
			  $libros_prestados=($libros_prestados)+1;
			  $res2=mysqli_query($conexion,"UPDATE ejemplar SET Prestados= $libros_prestados WHERE Id_libro='$id_libro'");


			  if($res1 and $libros_prestados and $res2){
				  	echo '<script>
				  alert("Atualizados los disponibles etc");
				  </script>';
			  }else{

			  }

			  

			  echo '<script>
			  alert("PRESTAMO registrado"); 		   
			  </script>';
		}



	}else{
		echo '<script>
			  alert("Datos no encontrados");
			  </script>';
	}

}else{
	echo '<script>
		  alert("No hay libros diponibles con ese ID");
		  </script>';
}

?>