<div id="p" class="easyui-panel" title="Ingreso de datos Prestamo" style="width:100%;height:100%; ">
<form id="frmprestamo" method="post"     style="margin:0;padding:20px 50px">
           
<table id="dg" title="Lista de EquipoPrestamo" class="easyui-datagrid" style="width:50%;height:auto; margin:10px;"
            url="controlador/equipo_prestamo.php?op=select"
            toolbar="#toolbar" pagination="false" 
            rownumbers="true" fitColumns="true" singleSelect="true">
        <thead>
            <tr>               
                <th field="cod_pre" width="25%">Codigo Prestamo</th>
                <th field="cod_equipo" width="25%">Codigo Equipo</th>
                <th field="cantidad" width="25%">Cantidad</th>
                <th field="descripcion" width="25%">Descripcion</th>
                
                
            </tr>
        </thead>
    </table> 
   
    <div id="toolbar">      
        <input class="easyui-searchbox" data-options="prompt:'Buscar',searcher:buscar  " style="width:250px">
        <a  href="main.php?pag=newequipo_prestamo" class="easyui-linkbutton" iconCls="icon-add" plain="true"  >Nuevo</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editUser()">Editar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyUser()">Eliminar</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" plain="true" onclick="refrescar()">Refrescar</a>
    </div>
    
  

    <script type="text/javascript">
        var url;
        
        function editUser(){
            var row = $('#dg').datagrid('getSelected');
            if (row){
                window.location.href= 'main.php?pag=editequipo_prestamo&id='+row.cod_pre;
            }
        }
       


        function destroyUser(){
            var row = $('#dg').datagrid('getSelected');     

            if (row){
                $.messager.confirm('Confirmar','¿Estás seguro de Eliminar el item seleccionado?',function(r){
                                 
                    if (r){
                        $.messager.progress({title:'Por favor espere',msg:'Cargando datos...' });

                        $.post('controlador/equipo_prestamo.php?op=delete',{cod_pre:row.cod_pre},function(result){
                            $.messager.progress('close');     
                            
                            if (result.success){
                                $('#dg').datagrid('reload');    
                            } else {
                                 
                                $('#dg').datagrid('reload');
                            }
                        },'json');
                    }
                });
            }
        }

        function refrescar(){
            $('#dg').datagrid('reload');   
        }
        function buscar(value){
            $('#dg').datagrid('reload',{filtro:value});   
        }
    </script>













           
            <div style="margin-bottom:5px">
                <input name="cod_pre" labelPosition="top"value="randon" class="easyui-numberbox" data-options="required:true,validType:'number'" label="Codigo Prestamo:"onkeypress="return controltag(event)"  style="width:50%">
            </div>
            <div style="margin-bottom:5px">
            <input name="fecha" class="easyui-datebox" label="Fecha:" readonly=»readonly» labelPosition="top"required="true"value="<?php echo date("m/d/Y"); ?>" required  data-options="formatter:myformatter,parser:myparser" style="width:50%;">
        </div>         
            <div style="margin-bottom:5px">
                <input id="nombre_p" name="nombre_p" labelPosition="top" class="easyui-textbox" required="true" label="Nombre Prestamo:" style="width:50%" >
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
        <a  href="main.php?pag=listaprestamo" class="easyui-linkbutton" iconCls="icon-cancel" style="width:90px">Cancelar</a>
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
                url: 'controlador/prestamo.php?op=insert',
                
                onSubmit: function(){
                    var esvalido =  $(this).form('validate');
                    if( esvalido){

                        var rows = $('#dg').datagrid('getRows');
                      var text =  JSON.stringify(rows);
  $('#detalles').val(text);
 
 
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
                    window.location.href= 'main.php?pag=listaprestamo';
                }
            }); 
        }
        
    </script>    
    
 