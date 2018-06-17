<?php
include 'conexion.php';

$id_usr=$_POST["usuario"];
$id_libro=$_POST["libro"];

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