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

        $condicion=$condicion." where cod_pre || cod_equipo like '%".$filtro."%' ";
        
        }
            $resultqry = pg_query($dbconn,"SELECT * FROM equipo_prestamo".$condicion );
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
                $cod_equipo = $_POST['cod_equipo']; 
                $descripcion = $_POST['descripcion'];   
                $cantidad= $_POST['cantidad'];  
                $sql = "INSERT INTO equipo_prestamo (cod_pre,cod_equipo,cantidad,descripcion)
                 VALUES ('$cod_pre','$cod_equipo','$cantidad','$descripcion');"; 
                $insert = pg_query($dbconn,$sql); 
                 
                if($insert){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos del usuario se han agregado con éxito!'; 
                } 
    }
    
    catch (Exception $e){ //usar logs
        $response = array( 
            'status' => 0, 
            'msg' =>  'Los datos  ya existe'  
        );           
    }
    echo json_encode($response); 
 break; 

 case 'update':
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          
            if( !empty($_POST['cod_pre'])&&!empty($_POST['cod_equipo'])   && !empty($_POST['cantidad'])  && !empty($_POST['descripcion']) ){ 
                $cod_pre = $_POST['cod_pre']; 
                $cod_equipo = $_POST['cod_equipo']; 
                $descripcion = $_POST['descripcion'];   
                $cantidad= $_POST['cantidad']; 
                $sql = "UPDATE equipo_prestamo SET   cod_equipo='$cod_equipo',cantidad='$cantidad',descripcion='$descripcion' WHERE cod_pre='$cod_pre'";
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
           
              
                $sql = " delete from equipo_prestamo where cod_pre ='$cod_pre' "; 
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