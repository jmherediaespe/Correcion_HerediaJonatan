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
            $codmodulo = $_GET['id'];
			$nombre = $_POST['nombre'];
			$estado = $_POST['estado'];

			$query_insert = mysqli_query($connection, "UPDATE seg_modulo SET NOMBRE='$nombre', ESTADO='$estado' WHERE COD_MODULO='$codmodulo'");

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
        header('Location: lista_modulo.php');
    }

    $codmodulo=$_GET['id'];   
    $sql= mysqli_query($connection,"SELECT * FROM seg_modulo WHERE COD_MODULO='$codmodulo'");

    $result_sql = mysqli_num_rows($sql);
    if($result_sql==0)
    {
        header('Location: lista_modulo.php');
    }else{
        $option = '';
        while($data = mysqli_fetch_array($sql)){
            $codmodulo = $data['COD_MODULO'];
            $nombre = $data['NOMBRE'];
            $estado = $data['ESTADO'];

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
                <label for="codmodulo">Código</label>
			    <input type="codmodulo" name="codmodulo" id="codmodulo" placeholder="Nombre" value="<?php echo $codmodulo;?>" disabled="true">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?php echo $nombre; ?>">
				<label for="estado">Estado</label>
				<input type="text" name="estado" id="estado" placeholder="Estado" value="<?php echo $estado; ?>">
				<input type="submit" value="Actualizar modulo" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "includes/footer.php"?>

</body>
</html>