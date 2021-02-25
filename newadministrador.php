<div id="p" class="easyui-panel" title="Ingreso de Administrador" style="width:100%;height:100%; ">
<form id="frmadministrador" method="post"     style="margin:0;padding:20px 50px">
       
       
            <div style="margin-bottom:5px">
                <input name="login" labelPosition="top" class="easyui-textbox" required="true" label="Login:" style="width:50%">
            </div>
            <div style="margin-bottom:5px">
                <input name="nombre" labelPosition="top" class="easyui-textbox" required="true" label="Nombre Completo:" style="width:50%" >
            </div>              
            <div style="margin-bottom:5px">
                <input id="password" name="password" labelPosition="top" class="easyui-passwordbox" required="true" label="Password:" style="width:50%" >
            </div> 
            <div style="margin-bottom:5px">
                 <input  id="repassword" name="repassword"  validType="confirmPass['#password']" class="easyui-passwordbox" labelPosition="top"   iconWidth="28" required="true" label="Repetir Password:" style="width:50%" >
            </div> 
            
            
           
    
            
         

        </form>
   
        <div style="text-align:center;padding:5px 0">
        <a href="javascript:void(0)" id='btnSave' class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveUser()" style="width:90px">Guardar</a>
        <a  href="main.php?pag=listaadministrador" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancelar</a>
    </div>   
    </div>
    
 
    <script type="text/javascript">
       
      
        function saveUser(){              
           $('#frmadministrador').form('submit',{
                url: 'controlador/administrador.php?op=insert',
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
                    window.location.href= 'main.php?pag=listaadministrador';
                }
            }); 
        }
        
    </script>    
    
 