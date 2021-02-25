<div id="p" class="easyui-panel" title="Ingreso de datos Equipo-Prestamo" style="width:100%;height:100%; ">
<form id="frmequipo_prestamo" method="post"     style="margin:0;padding:20px 50px">
           
            <div  style="margin-bottom:5px">
            <select id="cod_pre"  name ="cod_pre"labelPosition="top"required="true" class="easyui-combobox" 
            style="width:30%;"  data-options="
                    url:'controlador/prestamo.php?op=selectcombo',
                    method:'get',
                    valueField:'cod_pre',
                    textField:'nombre_p',
                    panelHeight:'auto',
                    label: 'Prestamo:',
                    labelWidth:'160px'
                    ">               
            </select>
        </div>
           <div  style="margin-bottom:5px">
            <select id="cod_equipo"  name ="cod_equipo"labelPosition="top"required="true" class="easyui-combobox" 
            style="width:30%;"  data-options="
                    url:'controlador/equipo.php?op=selectcombo',
                    method:'get',
                    valueField:'cod_equipo',
                    textField:'nombre',
                    panelHeight:'auto',
                    label: 'Equipo:',
                    labelWidth:'160px'
                    ">               
            </select>
        </div>
            <div style="margin-bottom:5px">
                <input id="cantidad" name="cantidad" labelPosition="top" class="easyui-textbox" required="true" label="Cantidad:" style="width:50%" >
            </div> 
            <div style="margin-bottom:5px">
                <input id="descripcion" name="descripcion" labelPosition="top" class="easyui-textbox" required="true" label="Descripcion:" style="width:50%" >
            </div> 
            
    
            
         

        </form>
   
        <div style="text-align:center;padding:5px 0">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a  href="main.php?pag=newprestamo" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancelar</a>
    </div>   
    </div>
    
 
    <script type="text/javascript">
       
       
        function saveUser(){              
           $('#frmequipo_prestamo').form('submit',{
                url: 'controlador/equipo_prestamo.php?op=insert',
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
    
 