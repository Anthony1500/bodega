<?php 
$conn_string = "host=localhost port=5433 dbname=Inventario user=postgres password=sa";
$dbconn = pg_connect($conn_string);  
if ($dbconn == false ) {
   echo "Ocurrió un error en la coneccion";
   exit;
 }
?>
