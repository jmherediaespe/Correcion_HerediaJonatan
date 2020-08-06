<?php
include "conexion.php";
if(!empty($_POST))
{
    $codrol = $_POST['codrol'];
    $codmodulo = $_POST['codmodulo'];
    $query_delete = mysqli_query($connection,"DELETE FROM rol_modulo WHERE COD_ROL='$codrol' AND COD_MODULO='$codmodulo'");

    if($query_delete){
        header("location: lista_rol.php");
    }else{
        echo "Error al eliminar";
    }

}

if(empty($_REQUEST['id']) || empty($_REQUEST['idm'])){
    header("location: lista_rol.php");
}else{

    $codrol=$_GET['id'];
    $codmodulo = $_GET['idm'];   
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
        while($data = mysqli_fetch_array($sql)){
            $codrol = $data['COD_ROL'];
            $nombre_rol = $data['nombre_rol'];
            $codmodulo = $data['COD_MODULO'];
            $nombre_modulo = $data['nombre_modulo'];
        }
}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php" ?>
	<title>Eliminar Rol_Módulo</title>
</head>
<body>
	<?php include "includes/header.php"?>
	<section id="container">
        <div class="data_delete">
            <h2>¿Está seguro de que quiere borrar el siguiente rol <?php echo $nombre_rol; ?> del módulo <?php echo $nombre_modulo; ?>?</h2>
            <p>Código de Rol:<span><?php echo $codrol; ?></span></p>
            <p>Nombre de Rol:<span><?php echo $nombre_rol; ?></span></p>
            <p>Código de Modulo:<span><?php echo $codmodulo; ?></span></p>
            <p>Nombre de Módulo:<span><?php echo $nombre_modulo; ?></span></p>

            <form method="post" action="">
                <input type="hidden" name="codrol" value="<?php echo $codrol ?>">
                <input type="hidden" name="codmodulo" value="<?php echo $codmodulo ?>">
                <a href="lista_rol.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
	</section>
	<?php include "includes/footer.php"?>

</body>
</html>