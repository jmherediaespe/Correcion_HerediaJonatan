<?php
	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		//COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
		if(empty($_POST['nombre']) || empty($_POST['estado']))
		{
			$alert ='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
            //RECOLECTA LOS DATOS DEL FORMULARIO
            $codmodulo = $_POST['codmodulo'];
			$nombre = $_POST['nombre'];
			$estado = $_POST['estado'];

			$query_insert = mysqli_query($connection, "INSERT INTO seg_modulo(COD_MODULO,NOMBRE,ESTADO) 
			values('$codmodulo','$nombre','$estado')");

			if($query_insert)
				{
					$alert = '<p class="msg_save">Modulo ingresado correctamente</p>';
			}else{
					$alert = '<p class="msg_error">Error al ingresar el modulo</p>';
				}
			
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Registro Modulo</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">
		<div class="form_register">
			<h1>Registro de Modulo</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post">
                <label for="codmodulo">Código</label>
			    <input type="codmodulo" name="codmodulo" id="codmodulo" placeholder="Codigo">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre">
				<label for="estado">Estado</label>
				<input type="text" name="estado" id="estado" placeholder="Estado">
				<input type="submit" value="Crear modulo" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "includes/footer.php"?>

</body>
</html>