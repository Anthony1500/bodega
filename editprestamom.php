
      
<?php
require ('controlador/coneccion.php');
if( isset($_GET["id"])   )
{
    $id=$_GET["id"];
    $sql = "SELECT * FROM  prestamo where cod_pre='$id'";
    $result = pg_query($dbconn, $sql);
    
    $row = pg_fetch_assoc($result) ;
      
    
    
}
?>





<div id="$id" class="easyui-panel" title="Ingreso de datos Prestamo" style="width:100%;height:100%; ">
<form id="frmprestamo" method="post"     style="margin:0;padding:20px 50px">
           
            <div style="margin-bottom:5px">
                <input name="cod_pre" labelPosition="top" readonly=»readonly» value="<?php echo $row ['cod_pre']?>" class="easyui-textbox" required="true" label="Codigo Prestamo:" style="width:50%"/>
            </div>
            <div style="margin-bottom:5px">
            <input name="fecha" class="easyui-datebox" label="Fecha:" value="<?php echo $row ['fecha']?>"labelPosition="top"required="true" data-options="formatter:myformatter,parser:myparser" style="width:50%;">
        </div>  
            <div style="margin-bottom:5px">
                <input id="nombre_p" name="nombre_p" labelPosition="top" class="easyui-textbox" required="true" value="<?php echo $row ['nombre_p']?>" label="Nombre Prestamo:" style="width:50%"/ >
            </div> 
            <div  style="margin-bottom:5px">
            <select id="cod_prestamista"  name ="cod_prestamista"labelPosition="top"required="true" class="easyui-combobox" 
            style="width:30%;"  data-options="
                    url:'controlador/prestamista.php?op=selectcombo',
                    method:'get',
                    valueField:'cod_prestamista',
                    textField:'nombre',
                    panelHeight:'auto',
                    label: 'Prestamista:',
                    labelWidth:'160px'
                    ">               
            </select>
        </div>
            <div style="margin-bottom:5px">
                <input id="fecha_entrega"name="fecha_entrega"class="easyui-datebox"  labelPosition="top"  required="true" value="<?php echo $row ['fecha_entrega']?>"data-options="formatter:myformatter,parser:myparser" label="Fecha de Entrega:" style="width:50%"/ >
            </div> 
           
            
            
            
         

        </form>
   
        <div style="text-align:center;padding:5px 0">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a  href="main.php?pag=newprestamo" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancelar</a>
    </div>   
    </div>
    
 
    <script type="text/javascript">
       function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
        }
        
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
        
        function saveUser(){              
           $('#frmprestamo').form('submit',{
                url: 'controlador/prestamo.php?op=update',
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
   

