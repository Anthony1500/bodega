<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<title>UTI</title>
 
    <link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/bootstrap/easyui.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="css/proyecto.css">
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/locale/easyui-lang-es.js"></script>
</head>

<body class="easyui-layout">
          
 
        <div data-options="region:'north'" style="height:60px"> 
        <img src="imagenes/uti-logo.jpg"   height="50px"  > </img>
         <div class="titulousuario">
		 <a style="color:blue";>Usuario:</a><font style="text-transform: uppercase;"><strong> <?php echo $_SESSION['usuario']; ?> </strong></font> 


			<a class="boton_personalizado" href="index.php"> Salir </a>
         </div> 

        </div>

        
       
        <div data-options="region:'west',split:true" title="Menu" style="width:200px;">
        
        <ul class="easyui-tree">
			<li>
				<span>Menu</span>
				<ul>
					<li>
						<span>Ingreso de datos</span>
						<ul>
						<li>
						<span>Administrador</span>
						<ul>
						
						
							
							<li>
								   <a  href="main.php?pag=listaadministrador"> Ingreso Usuario  </a> 
							</li>
							</ul>
							</li>
							<li>
						<span>Administracion de Bodegas</span>
						<ul>
							<li>
							<a  href="main.php?pag=listabodega"> Ingreso Bodega </a>
							</li>
							<li>
							<a  href="main.php?pag=listaequipo"> Ingreso Equipo  </a>
							</li>
							</ul>
							</li>
							<li>
						<span>Registro de prestamos</span>
						<ul>
							<li>
							<a  href="main.php?pag=listaprestamista"> Ingreso Prestamista </a>
							</li>
							<li>
							<a  href="main.php?pag=listaprestamo"> Ingreso Prestamo </a>
							</li>
							
							</ul>
							</li>
							<li>
						<span>Reportes</span>
						<ul>
							<li>
							<a  href="main.php?pag=reportes"> Reportes </a>
							</li>
							</ul>
							</li>
						</ul>
					</li>
				
					</li>
					 
				</ul>
			</li>
		</ul>

        </div>
        <div data-options="region:'center' ">
		<?php
		if(  isset($_GET["pag"])){
			$page = $_GET["pag"];	
			$page = $page.".php";
			include ($page);
		}	
		
			?>
	
	
        </div>
 
 
</body>
</html>