<!DOCTYPE html>
<html>
<head>

   <title>MULTAS</title>
   <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
   
</head>
<body>

<?php

   include 'conexion.php';
   //recuperar su ID
   session_start();
   $id_usr=$_SESSION["ID_USUARIO"];


   $result = mysqli_query($conexion,"SELECT Id_prestamo, Nom_Lib as LIBRO, Id_usuario as ALUMNO, Fecha_prestamo, Fecha_devolucion, Dias_mult, Costo FROM multas_detalles WHERE Id_usuario ='$id_usr' ");
   //generamos la consulta
   if(!$result){
      echo "Error";
   }else{
      //if(!$result = mysqli_query($conexion, $sql)) die();

      $rawdata = array();
      //guardamos en un array multidimensional todos los datos de la consulta
      $i=0;

      while($row = mysqli_fetch_array($result))
      {
          $rawdata[$i] = $row;
          $i++;
      }

      $close = mysqli_close($conexion);

      //DIBUJAMOS LA TABLA
      ?> 
      <div class="col-md-offset-2 col-md-7">
         <center> <H1>DETALLES DE MULTA</H1><br><br></center>
      <?php
      //echo '<table  width="100%" border="1" style="text-align:center;                    border-collapse: separate; border-spacing: 5px;                                  background: pink ; color: blue; " >';
        echo '<table width="100%" class="table table-hover" >';
      $columnas = count($rawdata[0])/2;
      //echo $columnas;
      $filas = count($rawdata);
      //echo "<br>".$filas."<br>";

      //Añadimos los titulos

      for($i=1;$i<count($rawdata[0]);$i=$i+2){
         next($rawdata[0]);
         echo "<th  > <b>".key($rawdata[0])."</b></th>";
         next($rawdata[0]);
      }

      for($i=0;$i<$filas;$i++){

         echo "<tr>";
         for($j=0;$j<$columnas;$j++){
            echo "<td>".$rawdata[$i][$j]."</td>";

         }
         echo "</tr>";
      }

      echo '</table>';

   }
   ?> 
   <CENTER>
      <button type="button" class="btn btn-info" onclick = "location='pagar_multa.php'">PAGAR</button>
   </CENTER>
   
</div>



   <?php


?>


<script src="js/jquery.js"></script>
   <script src="js/bootstrap.min.js"></script>
</body>
</html>

<!--

<style type="text/css">

      table {
   width: 100%;
   border: 1px solid #000;
}
th, td {
   width: 25%;
   text-align: left;
   vertical-align: top;
   border: 1px solid #000;
   border-collapse: collapse;
   padding: 0.3em;
   caption-side: bottom;
}
caption {
   padding: 0.3em;
   color: #fff;
    background: #000;
}
th {
   background: #eee;
}
   </style>
 -->
