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
        <div class="form_register">
        <h1>Lista de Roles</h1>
        <a href="registro_rol.php" class="btn_new">Crear rol</a>
       
        

        <form action="" method="post">
        <?php
				//OBTIENE LOS roles DESDE LA DB
					$query_rol=mysqli_query($connection, "SELECT DISTINCT rm.COD_ROL, NOMBRE FROM rol_modulo rm INNER JOIN seg_rol sr ON sr.COD_ROL=rm.COD_ROL");
					$result_rol=mysqli_num_rows($query_rol);
				?>
				<select name="rol" id="rol" class="notItemOne">
					<?php
                        if(isset($codrol))
                        {
                            $querynomrol = mysqli_query($connection, "SELECT NOMBRE
                            FROM seg_rol 
                            WHERE COD_ROL='$codrol'");
                            $data1 = mysqli_fetch_array($querynomrol);
                            $nombre_rol = $data1["NOMBRE"]; 
                            $option2 = '<option value="'.$codrol.'"select>'.$nombre_rol.'</options>';
                            echo $option2;
                        }
						//LISTA LOS roles DESDE LA DB
						if($result_rol>0){

							while($rol= mysqli_fetch_array($query_rol)){
					?>
								<option value="<?php echo $rol["COD_ROL"]; ?>"><?php echo $rol["NOMBRE"] ?></option>
					<?php
							}
						}
					?>
				</select>
				<input type="submit" value="Aceptar" class="btn_save">
        </form>
        </div>
        
        <?php
            	if(!empty($_POST))
                {
                    $alert='';
                        //RECOLECTA LOS DATOS DEL FORMULARIO
                    $codrol = $_POST['rol'];
                    if($codrol == 'ADMIN'){
                        echo ' <br><h2 style="text-align:center">Módulos del Rol Administrador</h2>';
                    }else if($codrol == 'ALUM'){
                        echo ' <br><h2 style="text-align:center">Módulos del Rol Alumno</h2>';
                    }else if($codrol == 'DOCE'){
                        echo ' <br><h2 style="text-align:center">Módulos del Rol Docente</h2>';
                    }
        ?>
        <br>
                 <table style="text-align:center">
            <tr>
                <th style="text-align:center">Modulo</th>
            </tr>
            <?php
                //QUERY PARA LISTAR MODULOS
                $query = mysqli_query($connection, "SELECT NOMBRE, rol_modulo.COD_ROL, seg_modulo.COD_MODULO FROM rol_modulo 
                INNER join seg_modulo on seg_modulo.COD_MODULO=rol_modulo.COD_MODULO 
                WHERE COD_ROL='$codrol'");

                $result=mysqli_num_rows($query);

                if($result>0)
                {
                    //CREA FILAS Y LISTA CON LOS DATOS QUE SACA CON EL QUERY
                    while($data = mysqli_fetch_array($query)){
                        //$data es un array que tiene datos del query
            ?>
                        <tr>
                            <td><?php echo $data["NOMBRE"] ?></td>
                            <td>
                                <a class="link_edit" href="editar_rol.php?id=<?php echo $data["COD_ROL"]?>&idm=<?php echo $data["COD_MODULO"]?>">Editar</a>
                                |
                                <a class="link_delete" href="eliminar_rol.php?id=<?php echo $data["COD_ROL"]?>&idm=<?php echo $data["COD_MODULO"]?>">Eliminar</a>
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