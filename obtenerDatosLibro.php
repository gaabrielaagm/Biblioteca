<?php
    session_start();    
    include 'conexion.php';

    //Editorial
    $array_e = array();
    $resultado = mysqli_query($conexion, "SELECT Id_editorial,Nombre FROM editorial;");
    if($resultado){
        while($fila = mysqli_fetch_assoc($resultado)){
            //echo '<br>'.$fila["Id_editorial"];
            //echo '<br>'.$fila["Nombre"];
            $array_e[ $fila["Id_editorial"] ] = $fila["Nombre"];
        }
        /*
        foreach($array as $id => $nombre){
            echo '<br>';
            echo $id . " => " . $nombre;
        }
        */
        
    }
    
    $_SESSION["editoriales"] = $array_e;

    //Autor
    $array_a = array();
    $resultado = mysqli_query($conexion, "SELECT Id_autor,CONCAT(Nombre,Apellido) as Apellido FROM autor;");
    if($resultado){
        while($fila = mysqli_fetch_assoc($resultado)){
            //echo '<br>'.$fila["Id_editorial"];
            //echo '<br>'.$fila["Nombre"];
            $array_a[ $fila["Id_autor"] ] = $fila["Apellido"];
        }
        /*
        foreach($array_a as $id => $nombre){
            echo '<br>';
            echo $id . " => " . $nombre;
        }
        */
    }
    
    $_SESSION["autores"] = $array_a;

    header('Location: altasLibros.php');
?>