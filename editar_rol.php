<?php
	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
		//COMPRUEBA QUE NINGUNO DE LOS CAMPOS ESTEN VACIOS
		if(empty($_POST['rol']) || empty($_POST['modulo']))
		{
			$alert ='<p class="msg_error">Todos los campos son obligatorios</p>';
		}else{
            //RECOLECTA LOS DATOS DEL FORMULARIO
            $codrol = $_GET['id'];
            $codmodulo=$_GET['idm'];
			$newcodmodulo = $_POST['modulo'];
			$newcodrol = $_POST['rol'];

			$query_insert = mysqli_query($connection, "UPDATE rol_modulo SET COD_MODULO='$newcodmodulo', COD_ROL='$newcodrol' WHERE COD_ROL='$codrol' AND COD_MODULO='$codmodulo'");

			if($query_insert)
				{
					$alert = '<p class="msg_save">Usuario actualizado correctamente</p>';
			}else{
					$alert = '<p class="msg_error">Error al actualizar el usuario</p>';
				}
			
		}
    }
    //RECUPERACION DE DATOS DEL USUARIO
    if(empty($_GET['id'] || $_GET['idm']))
    {
        //EL ID NO DEBE ESTAR VACIO, SI LO ESTA REGRESA A LISTA DE USUARIOS
        header('Location: lista_rol.php');
   }

    $codrol=$_GET['id'];
    $codmodulo=$_GET['idm'];   
    $sql= mysqli_query($connection,"SELECT rol_modulo.COD_ROL, rol_modulo.COD_MODULO, (seg_modulo.NOMBRE) as nombre_modulo, (seg_rol.NOMBRE) as nombre_rol 
    FROM rol_modulo INNER JOIN seg_modulo on seg_modulo.COD_MODULO=rol_modulo.COD_MODULO 
    INNER JOIN seg_rol on seg_rol.COD_ROL=rol_modulo.COD_ROL 
    WHERE rol_modulo.COD_ROL='$codrol' AND rol_modulo.COD_MODULO='$codmodulo'");

    $result_sql = mysqli_num_rows($sql);
    if($result_sql==0)
    {
        header('Location: lista_rol.php');
    }else{
        $option = '';
        $option2 = '';
        while($data = mysqli_fetch_array($sql)){
            $codrol = $data['COD_ROL'];
            $nombre_rol = $data['nombre_rol'];
            $codmodulo = $data['COD_MODULO'];
            $nombre_modulo = $data['nombre_modulo'];

            if($codrol == 'ADMIN'){
                $option = '<option value="'.$codrol.'"select>'.$nombre_rol.'</options>';
            }else if($codrol == 'ALUM'){
                $option = '<option value="'.$codrol.'"select>'.$nombre_rol.'</options>';
            }else if($codrol == 'DOCE'){
                $option = '<option value="'.$codrol.'"select>'.$nombre_rol.'</options>';
            }
            $option2 = '<option value="'.$codmodulo.'"select>'.$nombre_modulo.'</options>';


        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Actualizacion Modulo</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">
		<div class="form_register">
			<h1>Actualizacion de Modulo</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert:''; ?></div>

			<form action="" method="post">
            <label for="rol">Rol</label>
				<?php
				//OBTIENE LOS MODULOS DESDE LA DB
					$query_mod=mysqli_query($connection, "SELECT * FROM seg_rol");
					$result_mod=mysqli_num_rows($query_mod);
				?>
				<select name="rol" id="rol" class="notItemOne">
					<?php
                    echo $option;
						//LISTA LOS modulos DESDE LA DB
						if($result_mod>0){

							while($mod= mysqli_fetch_array($query_mod)){
					?>
								<option value="<?php echo $mod["COD_ROL"]; ?>"><?php echo $mod["NOMBRE"] ?></option>
					<?php
							}
						}
					?>
				</select>
				<label for="modulo">Modulo</label>
				<?php
				//OBTIENE LOS MODULOS DESDE LA DB
					$query_mod=mysqli_query($connection, "SELECT * FROM seg_modulo WHERE ESTADO='ACT'");
					$result_mod=mysqli_num_rows($query_mod);
				?>
				<select name="modulo" id="modulo" class="notItemOne">
					<?php
                    echo $option2;
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
				<input type="submit" value="Actualizar Rol-Modulo" class="btn_save">
			</form>
		</div>
	</section>
	<?php include "includes/footer.php"?>
</body>
</html>