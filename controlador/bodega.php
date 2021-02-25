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

        $condicion=$condicion." where cod_bodega || nombreb like '%".$filtro."%' ";
        
        }
            $resultqry = pg_query($dbconn,"SELECT * FROM bodega".$condicion );
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
                $resultqry = pg_query($dbconn, 'SELECT * FROM bodega ' );
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
                $cod_bodega = $_POST['cod_bodega']; 
                $nombreb= $_POST['nombreb']; 
                $direccionb = $_POST['direccionb'];
                $sql = "INSERT INTO bodega (cod_bodega,nombreb,direccionb) VALUES
                 ('$cod_bodega','$nombreb','$direccionb');"; 
                 echo $sql;
                $insert = pg_query($dbconn,$sql); 
                 
                if($insert){ 
                    $response['status'] = 1; 
                    $response['msg'] = '¡Los datos del usuario se han agregado con éxito!'; 
                } 
                else{
                    $response['status'] = 0; 
                    $response['msg'] =  pg_result_error($insert); 

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
    if( !empty($_POST['cod_bodega'])&&!empty($_POST['nombreb'])&&!empty($_POST['direccionb'])){ 
        $cod_bodega = $_POST['cod_bodega']; 
        $nombreb = $_POST['nombreb'];   
        $direccionb = $_POST['direccionb']; 
        $sql = "UPDATE bodega SET  nombreb='$nombreb',direccionb='$direccionb' WHERE cod_bodega='$cod_bodega'";
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
            if(!empty($_POST['cod_bodega'] )  ){ 
                $cod_bodega = $_POST['cod_bodega']; 
           
              
                $sql = " delete from bodega where cod_bodega ='$cod_bodega' "; 
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