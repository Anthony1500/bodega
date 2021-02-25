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

        $condicion=$condicion." where login || password like '%".$filtro."%' ";
        
        }
            $resultqry = pg_query($dbconn,"SELECT * FROM usuario".$condicion );
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
                $login = $_POST['login']; 
                $password = $_POST['password'];   
                $nombre= $_POST['nombre']; 
                $sql = "INSERT INTO usuario(login, password, nombre) VALUES ('$login','$password','$nombre');"; 
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
            if( !empty($_POST['login'])&&!empty($_POST['nombre'])   && !empty($_POST['password']) ){ 
                
                $login = $_POST['login']; 
                $password = $_POST['password'];   
                $nombre= $_POST['nombre']; 
            
               
                $sql = "UPDATE usuario SET  password='$password',nombre='$nombre' WHERE login='$login'";
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
 case 'selectcombo':
    $resultqry = pg_query($dbconn, 'SELECT * FROM usuario ' );
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
 case 'delete':
        $response = array( 
                'status' => 0, 
                'msg' =>  '  Se produjeron algunos problemas. Inténtalo de nuevo.' 
            );          
            if(!empty($_POST['login'] )  ){ 
                $login = $_POST['login']; 
           
              
                $sql = " delete from usuario where login ='$login'"; 
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