<?php
	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		//COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
		if(empty($_POST['modulo']) || empty($_POST['URL']) || empty($_POST['nombre'])|| empty($_POST['descripcion']))
		{
			$alert ='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
            //RECOLECTA LOS DATOS DEL FORMULARIO
            $codfuncionalidad = $_GET['id'];
			$codmodulo = $_POST['modulo'];
			$url = $_POST['URL'];
			$nombre = $_POST['nombre'];
			$descripcion = $_POST['descripcion'];

			$query_insert = mysqli_query($connection, "UPDATE seg_funcionalidad SET COD_MODULO='$codmodulo', URL_PRINCIPAL='$url', NOMBRE='$nombre', DESCRIPCION='$descripcion'  WHERE COD_FUNCIONALIDAD='$codfuncionalidad'");

			if($query_insert)
				{
					$alert = '<p class="msg_save">Usuario actualizado correctamente</p>';
			}else{
					$alert = '<p class="msg_error">Error al actualizar el usuario</p>';
				}
			
		}
    }
    //RECUPERACION DE DATOS DEL USUARIO
    if(empty($_GET['id']))
    {
        //EL ID NO DEBE ESTAR VACIO, SI LO ESTA REGRESA A LISTA DE USUARIOS
        header('Location: lista_funcionalidad.php');
    }

    $codfuncionalidad=$_GET['id'];   
    $sql= mysqli_query($connection,"SELECT * FROM seg_funcionalidad WHERE COD_FUNCIONALIDAD='$codfuncionalidad'");

    $result_sql = mysqli_num_rows($sql);
    if($result_sql==0)
    {
        header('Location: lista_funcionalidad.php');
    }else{
        $option = '';
        while($data = mysqli_fetch_array($sql)){
			$codfuncionalidad = $data['COD_FUNCIONALIDAD'];
			$codmodulo = $data['COD_MODULO'];
			$url = $data['URL_PRINCIPAL'];
			$nombre = $data['NOMBRE'];
            $descripcion = $data['DESCRIPCION'];

        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Actualizacion Funcionalidad</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">
		<div class="form_register">
			<h1>Actualizacion de Funcionalidad</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post">
				<label for="modulo">Modulo</label>
				<?php
				//OBTIENE LOS MODULOS DESDE LA DB
					$query_mod=mysqli_query($connection, "SELECT * FROM seg_modulo WHERE ESTADO='ACT'");
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
				<input type="text" name="URL" id="URL" placeholder="URL" value="<?php echo $url;?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre;?>">
				<label for="descripcion">Descripción</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripción" value="<?php echo $descripcion;?>">
				<input type="submit" value="Actualizar funcionalidad" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "includes/footer.php"?>

</body>
</html>