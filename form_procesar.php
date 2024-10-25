<?php

include "conections.php";

$nombre=$_POST['nombre'];
$contraseña=$_POST['contra'];

$sql="select * from Usuarios where Nombre='$nombre' and Contraseña='$contraseña'";
$sql2="select * from usuarios inner join admin on usuarios.id=admin.id where usuarios.Nombre='$nombre' and usuarios.Contraseña='$contraseña' and admin.admin=1";

$result=$conn->query($sql);
$result2=$conn->query($sql2);

    if ($result->num_rows > 0) {
		echo "Inicio correcto";?>
		
		<br>

		<?php
			if($result2->num_rows>0) echo "Eres admin";
			else echo "No eres admin";
    	?>

    <hr>

    <?php 
    } else{
        echo "No se encontro el usuario";
    }

    $conn->close();

?>

