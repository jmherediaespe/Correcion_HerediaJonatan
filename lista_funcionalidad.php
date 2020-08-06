<?php
	include "conexion.php";
	if(!empty($_POST))
	{
		$alert='';
            //RECOLECTA LOS DATOS DEL FORMULARIO
            $codmodulo = $_POST['modulo'];
			
		
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Lista de Funcionalidad</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">

        <h1>Lista de Funcionalidades</h1>
        <a href="registro_funcionalidad.php" class="btn_new">Crear funcionalidad</a>
        <form action="" method="post">
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
				<input type="submit" value="Aceptar" class="btn_save">
        </form>
        <?php
            	if(!empty($_POST))
                {
                    $alert='';
                        //RECOLECTA LOS DATOS DEL FORMULARIO
                        $codmodulo = $_POST['modulo'];
        ?>
                 <table>
            <tr>
                <th>Codigo</th>
                <th>Modulo</th>
                <th>URL</th>
                <th>Nombre</th>
                <th>Descripción</th>
            </tr>
            <?php
                //QUERY PARA LISTAR MODULOS
                $query = mysqli_query($connection, "SELECT * FROM seg_funcionalidad WHERE COD_MODULO='$codmodulo'");

                $result=mysqli_num_rows($query);

                if($result>0)
                {
                    //CREA FILAS Y LISTA CON LOS DATOS QUE SACA CON EL QUERY
                    while($data = mysqli_fetch_array($query)){
                        //$data es un array que tiene datos del query
            ?>
                        <tr>
                            <td><?php echo $data["COD_FUNCIONALIDAD"] ?></td>
                            <td><?php echo $data["COD_MODULO"] ?></td>
                            <td><?php echo $data["URL_PRINCIPAL"] ?></td>
                            <td><?php echo $data["NOMBRE"] ?></td>
                            <td><?php echo $data["DESCRIPCION"] ?></td>
                            <td>
                                <a class="link_edit" href="editar_funcionalidad.php?id=<?php echo $data["COD_FUNCIONALIDAD"] ?>">Editar</a>
                                |
                                <a class="link_delete" href="eliminar_funcionalidad.php?id=<?php echo $data["COD_FUNCIONALIDAD"] ?>">Eliminar</a>
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