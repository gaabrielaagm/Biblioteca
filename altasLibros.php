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



	<script type="text/javascript">

	function validar(){
        var numeros = /^[0-9]+$/;
        var letras = /^[A-Za-z]+$/;

       /* x=document.forms["responder"]["id_editorial"].value;
        y=document.forms["responder"]["ejemplares"].value;
        

        a=document.forms["responder"]["ubicacion"].value; 
        b=document.forms["responder"]["nombre"].value;
        c=document.forms["responder"]["volumen"].value;
        d=document.forms["responder"]["edicion"].value;
        e=document.forms["responder"]["issn"].value;
        f=document.forms["responder"]["isbn"].value;
		*/

        if (document.forms["responder"]["id_editorial"].value.match(numeros) && document.forms["responder"]["ejemplares"].value.match(numeros) 
        	&& document.forms["responder"]["ubicacion"].value.match(letras) && document.forms["responder"]["nombre"].value.match(letras) && document.forms["responder"]["volumen"].value.match(letras) && document.forms["responder"]["edicion"].value.match(letras) && document.forms["responder"]["issn"].value.match(letras)){
            return true;

        }else{
            alert("Id de la editorial y Número de Ejemplares son numéricos. Los campos restantes son caracteres.");
        }
    }

//registrar_libro_nuevo.php va en el form
	</script>


</head>
<body ng-app ng-controller="cargar">
	<center>
		<div class="container">
		<center><h1>Registrar un libro</h1></center>

<<<<<<< HEAD:altasLibros.html
		<form name="responder" action="" method="post"> 
=======
		<form name="responder" action="registrar_libro_nuevo.php" method="post"> 
<<<<<<< HEAD:altasLibros.php
			
=======
>>>>>>> 0c702727f2c079c55da0468905c33e37255f5da4:altasLibros.php

			<div class="form-group">
			Id de la editorial : <input type="text" name="id_editorial" required size="15px" id="id_editorial" class="form-control" placeholder="Id de la editorial"> 
			</div>

>>>>>>> 33739c536e7eef8930a12db9f6f1384932f7666c:altasLibros.html
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
<<<<<<< HEAD:altasLibros.php
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
=======
			Ubicación: <input type="text" name="ubicacion" required size="15px" id="id_ubicacion" class="form-control"  placeholder="Ubicación"> 
			</div>

			<div class="form-group">
			Nombre: <input type="text" name="nombre" required size="15px" id="nombre" class="form-control"  placeholder="Nombre"> 
>>>>>>> 33739c536e7eef8930a12db9f6f1384932f7666c:altasLibros.html
			</div>

			<div class="form-group">
			Volumen: <input type="text" name="volumen" required size="15px" id="volumen" class="form-control"  placeholder="Volumen">
			</div>

			<div class="form-group">
			Edición: <input type="text" name="edicion" required size="15px" id="edicion" class="form-control"  placeholder="Edición"> 
			</div>

			<div class="form-group">
			ISSN: <input type="text" name="issn" required size="15px" id="issn" class="form-control"  placeholder="ISSN"> 
			</div>

			<div class="form-group">
			ISBN: <input type="text" name="isbn" required size="15px" id="isbn" class="form-control"  placeholder="ISBN"> 
			</div>

			<div class="form-group">
			Número de Ejemplares: <input type="text" name="ejemplares" required size="15px" id="isbn" class="form-control" placeholder="Número de ejemplares"> 
			</div>

			<input type="submit" id="enviar" name="enviar" value="Registrar"  class="btn btn-primary" onclick="validar();" />  
		</form> 
		</div>
	</center>	
	<br>	
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/angular.min.js"></script>
</body>
</html>
