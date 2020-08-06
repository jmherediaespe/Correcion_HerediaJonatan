<?php
    include "conexion.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Lista de Modulos</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">

        <h1>Lista de Modulos</h1>
        <a href="registro_modulo.php" class="btn_new">Crear módulo</a>
        <table>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
            <?php
                //QUERY PARA LISTAR MODULOS
                $query = mysqli_query($connection, "SELECT * FROM seg_modulo WHERE ESTADO='ACT'");

                $result=mysqli_num_rows($query);

                if($result>0)
                {
                    //CREA FILAS Y LISTA CON LOS DATOS QUE SACA CON EL QUERY
                    while($data = mysqli_fetch_array($query)){
                        //$data es un array que tiene datos del query
            ?>
                        <tr>
                            <td><?php echo $data["COD_MODULO"] ?></td>
                            <td><?php echo $data["NOMBRE"] ?></td>
                            <td><?php echo $data["ESTADO"] ?></td>
                            <td>
                                <a class="link_edit" href="editar_modulo.php?id=<?php echo $data["COD_MODULO"] ?>">Editar</a>
                                |
                                <a class="link_delete" href="eliminar_modulo.php?id=<?php echo $data["COD_MODULO"] ?>">Eliminar</a>
                            </td>
                        </tr>
            <?php
                      }
                }
            ?>

        </table>

	</section>
	<?php include "includes/footer.php"?>

</body>
</html>