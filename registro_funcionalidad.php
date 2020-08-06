<?php
	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		//COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
		if(empty($_POST['nombre']) || empty($_POST['URL'])|| empty($_POST['descripcion']))
		{
			$alert ='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
            //RECOLECTA LOS DATOS DEL FORMULARIO
            $modulo = $_POST['modulo'];
			$nombre = $_POST['nombre'];
			$url = $_POST['URL'];
			$descripcion = $_POST['URL'];

			$query_insert = mysqli_query($connection, "INSERT INTO seg_funcionalidad(COD_MODULO,URL_PRINCIPAL,NOMBRE,DESCRIPCION) 
			values('$modulo','$url','$nombre','$descripcion')");

			if($query_insert)
				{
					$alert = '<p class="msg_save">Funcionalidad ingresado correctamente</p>';
			}else{
					$alert = '<p class="msg_error">Error al ingresar funcionalidad</p>';
				}
			
		}
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Registro Funcionalidad</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">
		<div class="form_register">
			<h1>Registro de Funcionalidad</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post">

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
				<label for="URL">URL</label>
				<input type="text" name="URL" id="URL" placeholder="URL">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre">
				<label for="descripcion">Descripción</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripción">
				<input type="submit" value="Crear funcionalidad" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "includes/footer.php"?>

</body>
</html>