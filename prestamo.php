<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Max-Age: 178000'); 
header('Content-Type: application/json');
require ('coneccion.php'); 
$op=  $_GET['op'] ;
 
if( !isset($op) )
{
  echo  json_encode( "No se definió  la variable op");
  exit;
} 
switch ($op) { 
    case 'select':
         
            $resultqry = pg_query($dbconn,"SELECT * FROM prestamo" );
         
            if (!$resultqry) {
            echo json_encode("Ocurrió un error en la consulta");
            exit;
            }
            $result = array();
            $items = array();  
         
            while($row = pg_fetch_object($resultqry)) {
               array_push($items, $row);
            }
            $result["rows"] = $items;
            echo json_encode($result);
            break;
 case 'insert':
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          
            if(!empty($_POST['Cod_Prestamo']) && !empty($_POST['Fecha']) && !empty($_POST['NombrePrestamista']) && !empty($_POST['Cod_Prestamista']) ){ 
                $Cod_Prestamo = $_POST['Cod_Prestamo']; 
                $Fecha = $_POST['Fecha'];   
                $NombrePrestamista= $_POST['NombrePrestamista']; 
                $Detalle= $_POST['Cod_Prestamista']; 
                $sql = "INSERT INTO prestamo (Cod_Prestamo, Fecha, NombrePrestamista,Cod_Prestamista) VALUES ('$Cod_Prestamo','$Fecha ', ' $NombrePrestamista',  ' $Cod_Prestamista');"; 
                $insert = pg_query($sql); 
                 
                if($insert){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos del usuario se han agregado con éxito!'; 
                } 
            }else{ 
                $response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
            } 
             
            echo json_encode($response); 
 break; 

 case 'update':
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          
            if(!empty($_POST['Cod_Prestamo']) && !empty($_POST['Fecha'])  && !empty($_POST['NombrePrestamista']) && !empty($_POST['Cod_Prestamista']) ){ 
                $Cod_Prestamo = $_POST['Cod_Prestamo']; 
                $Fecha = $_POST['Fecha'];   
                $NombrePrestamista= $_POST['NombrePrestamista']; 
                $Cod_Prestamista= $_POST['Cod_Prestamista']; 
                $sql = "UPDATE prestamo SET  Fecha='$Fecha', NombrePrestamista='$NombrePrestamista',  Cod_Prestamista='$Cod_Prestamista' WHERE Cod_Prestamo='$Cod_Prestamo'";
                $update = pg_query($sql); 
                 
                if($update){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos del usuario se han actualizado con éxito!'; 
                } 
            }else{ 
                $response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
            } 
             
            echo json_encode($response); 

 break; 
 case 'delete':
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          
            if(!empty($_POST['Cod_Prestamo'] )  ){ 
                $Cod_Equipo = $_POST['Cod_Prestamo']; 
           
              
                $sql = " delete from equipo where Cod_Prestamo ='$Cod_Prestamo' "; 
                $delete = pg_query($sql); 
                 
                if($delete){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos del usuario se han eliminado con éxito!'; 
                } 
            }else{ 
                $response['msg'] = 'Por favor complete todos los campos obligatorios.'; 
            }             
            echo json_encode($response); 
 break; 
    default:
            echo json_encode( "Error no existe la opcion ".$op);
            }
?>