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

        $condicion=$condicion." where nombre || marca like '%".$filtro."%' ";
        
        }
            $resultqry = pg_query($dbconn,"SELECT * FROM equipo".$condicion );
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
            case 'selectcombo':
                $resultqry = pg_query($dbconn, 'SELECT * FROM equipo ' );
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
 case 'insert':
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          
            try{ 
                $cod_equipo = $_POST['cod_equipo']; 
                $nombre = $_POST['nombre'];   
                $marca= $_POST['marca']; 
                $modelo= $_POST['modelo']; 
                $serie= $_POST['serie']; 
                $detalle= $_POST['detalle']; 
                $codigouti= $_POST['codigouti']; 
                $cod_bodega= $_POST['cod_bodega']; 
                $sql = "INSERT INTO equipo (cod_equipo,nombre,marca,modelo,serie,detalle,codigouti,cod_bodega) VALUES
                 ('$cod_equipo','$nombre', '$marca', '$modelo', '$detalle','$serie','$codigouti','$cod_bodega');"; 
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

 case 'update':
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          
            if( !empty($_POST['cod_equipo'])&&!empty($_POST['nombre'])   && !empty($_POST['marca'])  && !empty($_POST['modelo']) && !empty($_POST['serie'])  && !empty($_POST['detalle']) &&  !empty($_POST['codigouti'])&& !empty($_POST['cod_bodega']) ){ 
                $cod_equipo = $_POST['cod_equipo']; 
                $nombre = $_POST['nombre'];   
                $marca= $_POST['marca']; 
                $modelo= $_POST['modelo'];
                $serie= $_POST['serie'];  
                $detalle= $_POST['detalle']; 
                $codigouti= $_POST['codigouti']; 
                $cod_bodega= $_POST['cod_bodega']; 
                $sql = "UPDATE equipo SET  nombre='$nombre',marca='$marca',modelo='$modelo',serie='$serie',detalle='$detalle',codigouti='$codigouti',cod_bodega='$cod_bodega' WHERE
                 cod_equipo='$cod_equipo'";
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
            if(!empty($_POST['cod_equipo'] )  ){ 
                $cod_equipo = $_POST['cod_equipo']; 
           
              
                $sql = " delete from equipo where cod_equipo ='$cod_equipo' "; 
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