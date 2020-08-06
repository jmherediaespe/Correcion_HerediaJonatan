<?php
include "conexion.php";
if(!empty($_POST))
{
    $codmodulo = $_POST['codmodulo'];
    $query_delete = mysqli_query($connection,"UPDATE seg_modulo SET ESTADO='INA' WHERE COD_MODULO='$codmodulo'");

    if($query_delete){
        header("location: lista_modulo.php");
    }else{
        echo "Error al eliminar";
    }

}

if(empty($_REQUEST['id'])){
    header("location: lista_modulo.php");
}else{

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
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Eliminar Usuario</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">
        <div class="data_delete">
            <h2>¿Está seguro de que quiere borrar el siguiente modulo?</h2>
            <p>Codigo:<span><?php echo $codmodulo; ?></span></p>
            <p>Nombre:<span><?php echo $nombre; ?></span></p>
            <p>Estado:<span><?php echo $estado; ?></span></p>

            <form method="post" action="">
                <input type="hidden" name="codmodulo" value="<?php echo $codmodulo ?>">
                <a href="lista_modulo.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
	</section>
	<?php include "includes/footer.php"?>

</body>
</html>