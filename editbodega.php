<?php
require ('controlador/coneccion.php');
if( isset($_GET["id"])   )
{
    $id=$_GET["id"];
    $sql = "SELECT * FROM  bodega where cod_bodega='$id'";
    $result = pg_query($dbconn, $sql);
    
    $row = pg_fetch_assoc($result) ;
      
    
    
}
?>

<div id="$id" class="easyui-panel" title="Lista de bodega" style="width:100%;height:50%; ">
<form id="frmbodega" method="post"     style="margin:0;padding:20px 50px">
           
            <div style="margin-bottom:5px">
                <input name="cod_bodega" labelPosition="top"readonly=»readonly» value="<?php echo $row ['cod_bodega']?>" class="easyui-textbox" required="true" label="Codigo Bodega:" style="width:50%"/>
            </div>
            <div style="margin-bottom:5px">
                <input name="nombreb" labelPosition="top" class="easyui-textbox" value="<?php echo $row ['nombreb']?>" required="true" label="Nombre:" style="width:50%" >
            </div>              
            
          <!--  <div  style="margin-bottom:5px">
            <select id="cod_bodega"  name ="cod_bodega"labelPosition="top"value="<?php echo $row ['cod_bodega']?>"required="true" class="easyui-combobox" 
            style="width:30%;"  data-options="
                    url:'controlador/bodega.php?op=selectcombo',
                    method:'get',
                    valueField:'cod_bodega',
                    textField:'nombre',
                    panelHeight:'auto',
                    label: 'Administrador:',
                    labelWidth:'160px'
                    ">               
            </select>
        </div>-->

        <div style="margin:2px 0"></div>
    
        <div style="margin-bottom:10px">
            <select class="easyui-combobox"id="direccionb"  name ="direccionb" data-options= "panelHeight:'auto'"value="<?php echo $row ['direccionb']?>" label="Direccion:" labelPosition="top" style="width:30%;">
              <option >quito</option>
                <option >ambato</option>
                 </select>
        </div>
    </div>



       
            
      
        









        </form>
   
        <div style="text-align:center;padding:5px 0">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a  href="main.php?pag=listabodega" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancelar</a>
    </div>   
    </div>
    
 
    <script type="text/javascript">
       
      
        function saveUser(){              
           $('#frmbodega').form('submit',{
                url: 'controlador/bodega.php?op=update',
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
                    window.location.href= 'main.php?pag=listabodega';
                }
            }); 
        }
        
    </script>    
    
 