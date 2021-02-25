<!DOCTYPE html>
<html>
<head>

	<meta charset="UTF-8">
	<title>UTI</title>
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="js/jquery-easyui-1.8.8/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="css/proyecto.css">
	<script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/jquery.easyui.min.js"></script>
    <script type="text/javascript" src="js/jquery-easyui-1.8.8/locale/easyui-lang-es.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="imagenes/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

</head>
<body >

 
     <div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form"id="ff" method="post"
          onsubmit="return submitForm();">
					<span class="login100-form-logo">
						<i ><img src="imagenes/uti-logo.jpg"   height="60px"  > </img></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
                    Ingreso al Sistema
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Ingrese el usuario">
						<input class="input100" type="text" name="txtusuario" placeholder="Usuario">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="txtpassword" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Recuerda mis datos
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" form="ff" color=purple value="Continue" style="width:80px" >
							Acceder
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	
    <?php 
     session_start();
     unset(  $_SESSION['usuario'] );
     require('controlador/coneccion.php');

     $mensaje=" ";

       if( isset($_POST["txtusuario"]) &&  isset($_POST["txtpassword"])   )
        {
            $txtusuario = pg_escape_string( $_POST['txtusuario']);
            $txtpassword = pg_escape_string( $_POST['txtpassword']); 
            $sql = "SELECT * FROM  usuario where
             login='$txtusuario' and password='$txtpassword' ";
            $result = pg_query($dbconn, $sql);
            if ($result == false) {
                echo  "Ocurrió un error en la consulta" ;
               exit;
            }  
            $row = pg_fetch_assoc($result) ;
            if( isset($row['nombre']) == false){
                $mensaje ="Usuario y Clave Incorrecto";
            } 
            else{                 
               
                  $_SESSION['usuario'] = $row['nombre'];                 
                  header("location: main.php") ;
                }
                   
        }
    ?>
    <div> <?php  echo  $mensaje;?>   </div>
  
    <script>
        function submitForm(){            
            var isvalid = $( "#ff" ).form('validate'); 
            return isvalid;
        }
     
    </script>
	<div id="dropDownSelect1"></div>
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>
</body>

</html>