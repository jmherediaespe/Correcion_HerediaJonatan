<?php
include "conexion.php";
if(!empty($_POST))
{
    $codfuncionalidad = $_POST['codfuncionalidad'];
    $query_delete = mysqli_query($connection,"DELETE FROM seg_funcionalidad WHERE COD_FUNCIONALIDAD='$codfuncionalidad'");

    if($query_delete){
        header("location: lista_funcionalidad.php");
    }else{
        echo "Error al eliminar";
    }

}

if(empty($_REQUEST['id'])){
    header("location: lista_funcionalidad.php");
}else{

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
            $url_principal = $data['URL_PRINCIPAL'];
            $nombre = $data['NOMBRE'];
            $descripcion=$data['DESCRIPCION'];

        }
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Eliminar Funcionalidad</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">
        <div class="data_delete">
            <h2>¿Está seguro de que quiere borrar la siguiente funcionalidad?</h2>
            <p>Codigo:<span><?php echo $codfuncionalidad; ?></span></p>
            <p>URL:<span><?php echo $url_principal; ?></span></p>
            <p>Nombre:<span><?php echo $nombre; ?></span></p>
            <p>Descripción:<span><?php echo $descripcion; ?></span></p>

            <form method="post" action="">
                <input type="hidden" name="codfuncionalidad" value="<?php echo $codfuncionalidad ?>">
                <a href="lista_funcionalidad.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
	</section>
	<?php include "includes/footer.php"?>

</body>
</html>