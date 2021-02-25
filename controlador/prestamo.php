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
        $condicion=' ';
        if (isset($_POST['filtro'] )){
        $filtro=$_POST['filtro'] ;

        $condicion=$condicion." where cod_pre || fecha like '%".$filtro."%' ";
        
        }
            $resultqry = pg_query($dbconn,"SELECT * FROM prestamo".$condicion );
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
            try{ 
                $cod_pre = $_POST['cod_pre']; 
                $fecha= $_POST['fecha'];   
                $nombre_p= $_POST['nombre_p']; 
                $fecha_entrega= $_POST['fecha_entrega'];
                
                $cod_prestamista= $_POST['cod_prestamista']; 
                $sql = "INSERT INTO prestamo(cod_pre,fecha,nombre_p,cod_prestamista,fecha_entrega) VALUES
                 ('$cod_pre','$fecha','$nombre_p','$cod_prestamista','$fecha_entrega');"; 
                $insert = pg_query($dbconn,$sql); 
                 

     
                $someObject = $_POST['detalles'];
                foreach($someObject as $key => $value) {
                  $cantidad = $value->cantidad;
                  $descripcion= $value->descripcion;
                  $cod_equipo = $value->cod_equipo;
                  $sql = "INSERT INTO equipo_prestamo(cod_equipo,cantidad,descripcion) VALUES
                  ('$cod_equipo','$cantidad','$descripcion');"; 
                 $insert = pg_query($dbconn,$sql); 
                }

                if($insert){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos del usuario se han agregado con éxito!'; 
                } 
    }
    
    catch (Exception $e){ //usar logs
        $response = array( 
            'status' => 0, 
            'msg' =>  'El Usuario ya existe'  
        );           
    }
    echo json_encode($response); 
 break; 
 case 'selectcombo':
    $resultqry = pg_query($dbconn, 'SELECT * FROM prestamo ' );
    if (!$resultqry) {
    echo json_enconde("Ocurrió un error en la consulta");
    exit;
    }
    
    $items=array();
 
    while($row = pg_fetch_object($resultqry)) {
       array_push($items, $row);
    }
  
    echo json_encode($items);
    break;
 
 case 'update':
    $response = array( 
            'status' => 0, 
            'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
        );          
        if(!empty($_POST['cod_pre'])&&!empty($_POST['fecha']) && !empty($_POST['nombre_p'])&& !empty($_POST['cod_prestamista'])&&!empty($_POST['fecha_entrega'])){ 
            $cod_pre = $_POST['cod_pre']; 
            $fecha = $_POST['fecha'];   
            $nombre_p= $_POST['nombre_p']; 
            $fecha_entrega= $_POST['fecha_entrega'];
               
            $cod_prestamista= $_POST['cod_prestamista']; 
            $sql = "UPDATE prestamo SET nombre_p='$nombre_p',fecha='$fecha',cod_prestamista='$cod_prestamista',fecha_entrega='$fecha_entrega'WHERE cod_pre='$cod_pre'";
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
            if(!empty($_POST['cod_pre'] )  ){ 
                $cod_pre = $_POST['cod_pre']; 
           
              
                $sql = " delete from prestamo where cod_pre ='$cod_pre' "; 
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