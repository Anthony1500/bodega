<?php
require ('controlador/coneccion.php');
if( isset($_GET["id"])   )
{
    $id=$_GET["id"];
    $sql = "SELECT * FROM  laboratorista where cod_lab='$id'";
    $result = pg_query($dbconn, $sql);
    
    $row = pg_fetch_assoc($result) ;
      
    
    
}
?>

<div id="$id" class="easyui-panel" title="Ingreso de datos" style="width:100%;height:100%; ">
<form id="frmlaboratorista" method="post"     style="margin:0;padding:20px 50px">
           
            <div style="margin-bottom:5px">
                <input name="cod_lab" labelPosition="top"readonly=»readonly» value="<?php echo $row ['cod_lab']?>" class="easyui-textbox" required="true" label="Codigo laboratorista:" style="width:50%"/>
            </div>
            <div style="margin-bottom:5px">
                <input name="nombre" labelPosition="top" class="easyui-textbox" value="<?php echo $row ['nombre']?>" required="true" label="Nombre:" style="width:50%" >
            </div>              
            <div style="margin-bottom:5px">
                <input id="dni_lab" name="dni_lab" labelPosition="top" class="easyui-textbox" required="true" value="<?php echo $row ['dni_lab']?>" label="Cedula del laboratorista:" style="width:50%"/ >
            </div> 
            
    
            
         

        </form>
   
        <div style="text-align:center;padding:5px 0">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a  href="main.php?pag=listalaboratorista" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancelar</a>
    </div>   
    </div>
    
 
    <script type="text/javascript">
       
      
        function saveUser(){              
           $('#frmlaboratorista').form('submit',{
                url: 'controlador/laboratorista.php?op=update',
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
                    window.location.href= 'main.php?pag=listalaboratorista';
                }
            }); 
        }
        
    </script>    
    
 