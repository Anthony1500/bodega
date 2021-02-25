<?php
require ('controlador/coneccion.php');
if( isset($_GET["id"])   )
{
    $id=$_GET["id"];
    $sql = "SELECT * FROM  equipo_prestamo where cod_pre='$id'";
    $result = pg_query($dbconn, $sql);
    
    $row = pg_fetch_assoc($result) ;
      
    
    
}
?>

<div id="$id" class="easyui-panel" title="Ingreso de datos" style="width:100%;height:100%; ">
<form id="frmequipo_prestamo" method="post"     style="margin:0;padding:20px 50px">
           
            <div style="margin-bottom:5px">
                <input name="cod_pre" labelPosition="top" readonly=»readonly» value="<?php echo $row ['cod_pre']?>" class="easyui-numberbox" required="true" label="Codigo Prestamo:" style="width:50%"/>
            </div>
            <div style="margin-bottom:5px">
                <input name="cod_equipo" labelPosition="top" class="easyui-textbox" value="<?php echo $row ['cod_equipo']?>" required="true" label="Codigo Equipo:" style="width:50%" >
            </div> 
            <div style="margin-bottom:5px">
                <input name="cantidad"id="cantidad" labelPosition="top" class="easyui-textbox" value="<?php echo $row ['cantidad']?>" required="true" label="Cantidad:" style="width:50%" >
            </div>              
            <div style="margin-bottom:5px">
                <input id="descripcion" name="descripcion" labelPosition="top" class="easyui-textbox" required="true" value="<?php echo $row ['descripcion']?>" label="Descripcion:" style="width:50%" >
            </div> 
            
    
            
         

        </form>
   
        <div style="text-align:center;padding:5px 0">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Save</a>
        <a  href="main.php?pag=newprestamo" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancel</a>
    </div>   
    </div>
    
 
    <script type="text/javascript">
       
      
        function saveUser(){              
           $('#frmequipo_prestamo').form('submit',{
                url: 'controlador/equipo_prestamo.php?op=update',
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
                    window.location.href= 'main.php?pag=newprestamo';
                }
            }); 
        }
        
    </script>    
    
 