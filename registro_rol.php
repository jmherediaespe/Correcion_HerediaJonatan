<?php
	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		//COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
		if(empty($_POST['rol']))
		{
			$alert ='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
            //RECOLECTA LOS DATOS DEL FORMULARIO
            $modulo = $_POST['modulo'];
			$rol = $_POST['rol'];

			$query_insert = mysqli_query($connection, "INSERT INTO ROL_MODULO(COD_ROL,COD_MODULO) 
			values('$rol','$modulo')");

			if($query_insert)
				{
					$alert = '<p class="msg_save">Rol ingresado correctamente</p>';
			}else{
					$alert = '<p class="msg_error">Error al ingresar rol</p>';
				}
			
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Registro Rol</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">
		<div class="form_register">
			<h1>Registro de Roles</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post">
                <label for="rol">Rol</label>
				<input type="text" name="rol" id="rol" placeholder="Rol">
				<label for="modulo">Modulo</label>
				<?php
				//OBTIENE LOS MODULOS DESDE LA DB
					$query_mod=mysqli_query($connection, "SELECT * FROM seg_modulo");
					$result_mod=mysqli_num_rows($query_mod);
				?>
				<select name="modulo" id="modulo">
					<?php
						//LISTA LOS modulos DESDE LA DB
						if($result_mod>0){

							while($mod= mysqli_fetch_array($query_mod)){
					?>
								<option value="<?php echo $mod["COD_MODULO"]; ?>"><?php echo $mod["NOMBRE"] ?></option>
					<?php
							}
						}
					?>
				</select>
				<input type="submit" value="Crear rol" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "includes/footer.php"?>

</body>
</html>