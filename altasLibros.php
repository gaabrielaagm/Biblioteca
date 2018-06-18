<?php
	session_start();
	$array_editoriales = $_SESSION["editoriales"];
	$array_autores = $_SESSION["autores"];
	/*
	foreach($array_editoriales as $id => $nombre){
		echo '<br>';
		echo $id . " => " . $nombre;
	}
	*/
?>
<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
  	<title>Altas de Libros</title>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="js/functions.js"></script>  
	<style type="text/css">
		.form-control{
			height:35px;  /*alto */
			width: 300px;  /*ancho*/
		}
	</style>
</head>
<body ng-app ng-controller="cargar">
	<center>
		<div class="container">
		<center><h1>Registrar un libro</h1></center>

		<form name="responder" action="registrar_libro_nuevo.php" method="post"> 
			
			<div class="form-group">
				Tema:  <br>
				<select class="form-control" name="temas" id="tema">
					<option value="0">Generalidades</option>
					<option value="1">Filosofía y Psicología</option>
					<option value="2">Religión</option>
					<option value="3">Ciencias Sociales</option>
					<option value="4">Lenguas</option>
					<option value="5">Matemáticas y Ciencias Naturales</option>
					<option value="6">Tecnología y Ciencias Aplicadas</option>
					<option value="7">Artes</option> 
					<option value="8">Literatura</option>
					<option value="9">Historia y Geografía</option>
				</select>
			</div>	

			<div class="form-group">
				<select class="form-control" name="id_asignatura">
					<option ng-repeat="asignatura in asignaturas" value="{{asignatura.value}}">{{asignatura.name}}</option>
				</select>
			</div>

			<div class="form-group">
					<?php
						echo '<select class="form-control">';
						foreach($array_autores as $id => $nombre){
							echo "<option value='$id'>".$nombre."</option>";
						}
						echo '</select>';
					?>			
			</div>

			<div class="form-group">
					<?php
						echo '<select class="form-control">';
						foreach($array_editoriales as $id => $nombre){
							echo "<option value='$id'>".$nombre."</option>";
						}
						echo '</select>';
					?>			
			</div>

			<div class="form-group">
				<label>Ubicación:</label>
				<input type="text" name="ubicacion" required size="15px" id="id_ubicacion" class="form-control" placeholder="Ubicacion"> 
			</div>

			<div class="form-group">
			Nombre: <input type="text" name="nombre" required size="15px" id="nombre" class="form-control" placeholder="Nombre"> 
			</div>

			<div class="form-group">
			Volumen: <input type="text" name="volumen" required size="15px" id="volumen" class="form-control">
			</div>

			<div class="form-group">
			Edición: <input type="text" name="edicion" required size="15px" id="edicion" class="form-control"> 
			</div>

			<div class="form-group">
			ISSN: <input type="text" name="issn" required size="15px" id="issn" class="form-control"> 
			</div>

			<div class="form-group">
			ISBN: <input type="text" name="isbn" required size="15px" id="isbn" class="form-control"> 
			</div>

			<div class="form-group">
			Numero de Ejemplares: <input type="text" name="ejemplares" required size="15px" id="isbn" class="form-control"> 
			</div>

			<input type="submit" id="enviar" name="enviar" value="Registrar"  class="btn btn-primary"/>  
		</form> 
		</div>
	</center>	
	<br>	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular.min.js"></script>
</body>
</html>
