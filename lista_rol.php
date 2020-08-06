<?php
	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
            //RECOLECTA LOS DATOS DEL FORMULARIO
            $codrol = $_POST['rol'];
			
		
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Lista de Roles</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">

        <h1>Lista de Roles</h1>
        <a href="registro_rol.php" class="btn_new">Crear rol</a>
        <form action="" method="post">
        <?php
				//OBTIENE LOS roles DESDE LA DB
					$query_rol=mysqli_query($connection, "SELECT * FROM ROL_MODULO");
					$result_rol=mysqli_num_rows($query_rol);
				?>
				<select name="rol" id="rol">
					<?php
						//LISTA LOS roles DESDE LA DB
						if($result_rol>0){

							while($rol= mysqli_fetch_array($query_rol)){
					?>
								<option value="<?php echo $rol["COD_ROL"]; ?>"><?php echo $rol["COD_ROL"] ?></option>
					<?php
							}
						}
					?>
				</select>
				<input type="submit" value="Aceptar" class="btn_save">
        </form>
        <?php
            	if(!empty($_POST))
                {
                    $alert='';
                        //RECOLECTA LOS DATOS DEL FORMULARIO
                        $codrol = $_POST['rol'];
        ?>
                 <table>
            <tr>
                <th>Modulo</th>
            </tr>
            <?php
                //QUERY PARA LISTAR MODULOS
                $query = mysqli_query($connection, "SELECT * FROM ROL_MODULO WHERE COD_ROL='$codrol'");

                $result=mysqli_num_rows($query);

                if($result>0)
                {
                    //CREA FILAS Y LISTA CON LOS DATOS QUE SACA CON EL QUERY
                    while($data = mysqli_fetch_array($query)){
                        //$data es un array que tiene datos del query
            ?>
                        <tr>
                            <td><?php echo $data["COD_MODULO"] ?></td>
                            <td>
                                <a class="link_edit" href="editar_rol.php?id=<?php echo $data["COD_ROL"] ?>">Editar</a>
                                |
                                <a class="link_delete" href="eliminar_rol.php?id=<?php echo $data["COD_ROL"] ?>">Eliminar</a>
                            </td>
                        </tr>
            <?php
                      }
                }
            ?>

        </table>
        <?php           
                }
        ?>

	</section>
	<?php include "includes/footer.php"?>

</body>
</html>