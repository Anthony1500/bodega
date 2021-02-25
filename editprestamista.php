<?php
require ('controlador/coneccion.php');
if( isset($_GET["id"])   )
{
    $id=$_GET["id"];
    $sql = "SELECT * FROM  prestamista where cod_prestamista='$id'";
    $result = pg_query($dbconn, $sql);
    
    $row = pg_fetch_assoc($result) ;
      
    
    
}
?>

<div id="$id" class="easyui-panel" title="Ingreso de datos Prestamista" style="width:100%;height:100%; ">
<form id="frmprestamista" method="post"     style="margin:0;padding:20px 50px">
           
            <div style="margin-bottom:5px">
                <input id="cod_prestamista"name="cod_prestamista"readonly=»readonly» labelPosition="top" value="<?php echo $row ['cod_prestamista']?>" class="easyui-textbox" required="true" label="Codigo Prestamista:" style="width:50%"/>
            </div>
            <div style="margin-bottom:5px">
                <input id="nombre" name="nombre" labelPosition="top" class="easyui-textbox" value="<?php echo $row ['nombre']?>" required="true" label="Nombre:" style="width:50%" >
            </div>              
            <div style="margin-bottom:5px">
                <input id="destino" name="destino" labelPosition="top" class="easyui-textbox" required="true" value="<?php echo $row ['destino']?>" label="Destino:" style="width:50%"/ >
            </div> 
             
            <div style="margin-bottom:5px">
                <input id="dni_p" name="dni_p" labelPosition="top" class="easyui-textbox" required="true" value="<?php echo $row ['dni_p']?>" label="Cedula del Prestamista:" style="width:50%"/ >
            </div> 
            <div style="margin-bottom:5px">
                <input id="carrera" name="carrera" labelPosition="top" class="easyui-textbox" required="true" value="<?php echo $row ['carrera']?>" label="Carrera:" style="width:50%"/ >
            </div> 
            <div style="margin-bottom:5px">
                <input id="departamento" name="departamento" labelPosition="top" class="easyui-textbox" required="true" value="<?php echo $row ['departamento']?>" label="Departamento:" style="width:50%"/ >
            </div> 
            <div style="margin-bottom:5px">
                <input id="tipo" name="tipo" labelPosition="top" class="easyui-textbox" required="true" value="<?php echo $row ['tipo']?>" label="Tipo:" style="width:50%"/ >
            </div> 
            
           
            
         

        </form>
   
        <div style="text-align:center;padding:5px 0">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a  href="main.php?pag=listaprestamista" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancelar</a>
    </div>   
    </div>
    
 
    <script type="text/javascript">
       
      
        function saveUser(){              
           $('#frmprestamista').form('submit',{
                url: 'controlador/prestamista.php?op=update',
                onSubmit: function(){
                    var esvalido =  $(this).form('validate');
                    if( esvalido){
                        $.messager.progress({
                       title:'Por favor espere',
                      msg:'Cargando datos...'
                      });
                    }
                    return esvalido;
                },
                success: function(result){                   
                    $.messager.progress('close');
                   // var result = eval('('+result+')');
                   // console.log(result);                  
                   $.messager.show({
                            title: 'exito',
                            msg: result
                        });
                    window.location.href= 'main.php?pag=listaprestamista';
                }
            }); 
        }
        
    </script>    
    
 