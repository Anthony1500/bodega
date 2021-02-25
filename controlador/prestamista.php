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

        $condicion=$condicion." where cod_prestamista || nombre like '%".$filtro."%' ";
        
        }
            $resultqry = pg_query($dbconn,"SELECT * FROM prestamista".$condicion );
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
                $cod_prestamista = $_POST['cod_prestamista']; 
                $nombre = $_POST['nombre'];
                $destino= $_POST['destino'];   
                $dni_p= $_POST['dni_p']; 
                $carrera= $_POST['carrera']; 
                $departamento= $_POST['departamento']; 
                $tipo= $_POST['tipo']; 
                $sql = "INSERT INTO prestamista (cod_prestamista,nombre,destino,dni_p,carrera,departamento,tipo) VALUES ('$cod_prestamista','$nombre','$destino','$dni_p','$carrera','$departamento','$tipo');"; 
                $insert = pg_query($dbconn,$sql); 
                 
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
    $resultqry = pg_query($dbconn, 'SELECT * FROM prestamista ' );
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
            if( !empty($_POST['cod_prestamista'])&&!empty($_POST['nombre'])   && !empty($_POST['destino'])&& !empty($_POST['dni_p'])&& !empty($_POST['carrera'])&& !empty($_POST['departamento'])&& !empty($_POST['tipo'])  ){ 
                $cod_prestamista = $_POST['cod_prestamista']; 
                $nombre = $_POST['nombre'];
                $destino= $_POST['destino'];   
                
                $dni_p= $_POST['dni_p']; 
                $carrera= $_POST['carrera']; 
                $departamento= $_POST['departamento']; 
                $tipo= $_POST['tipo']; 
                $sql = "UPDATE prestamista SET  nombre='$nombre',destino='$destino',dni_p='$dni_p',carrera='$carrera',departamento='$departamento',tipo='$tipo' WHERE cod_prestamista='$cod_prestamista'";
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
            if(!empty($_POST['cod_prestamista'] )  ){ 
                $cod_prestamista = $_POST['cod_prestamista']; 
           
              
                $sql = " delete from prestamista where cod_prestamista ='$cod_prestamista' "; 
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