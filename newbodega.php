<div id="p" class="easyui-panel" title="Ingreso de datos Bodega" style="width:100%;height:100%; ">
<form id="frmbodega" method="post"     style="margin:0;padding:20px 50px">
           
<div style="margin-bottom:5px">
                <input name="cod_bodega" id="cod_bodega"labelPosition="top"  class="easyui-textbox" required="true" label="Codigo Bodega:" style="width:50%"/>
            </div>
            <div style="margin-bottom:5px">
                <input name="nombreb"id="nombreb" labelPosition="top" class="easyui-textbox"  required="true" label="Nombre:" style="width:50%" >
            </div>              
         <!--   <div  style="margin-bottom:5px">
            <select id="cod_bodega"  name ="cod_bodega"labelPosition="top"required="true" class="easyui-combobox" 
            style="width:30%;"  data-options="
                    url:'controlador/bodega.php?op=selectcombo',
                    method:'get',
                    valueField:'cod_bodega',
                    textField:'nombreb',
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
    
            
         

        </form>
   
        <div style="text-align:center;padding:5px 0">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a  href="main.php?pag=listabodega" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancelar</a>
    </div>   
    </div>
    
 
    <script type="text/javascript">
       
       
        function saveUser(){              
           $('#frmbodega').form('submit',{
                url: 'controlador/bodega.php?op=insert',
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
    
 