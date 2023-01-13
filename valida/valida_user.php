<?php include("./../data/conexion.php"); 



if (isset($_POST['dni'])) {
	
	$dni = $_POST['dni'];


$query="SELECT * FROM usuarios WHERE user_dni= '$dni' ";
	$result=mysqli_query($conexion, $query);
	$numfilas = mysqli_num_rows($result);
	$filas=mysqli_fetch_assoc($result);

if ($numfilas>0) {

$dni=$filas ['user_dni']; 

$perfil = $filas ['user_perfil']; 
switch ($perfil) {
    case 0:
        ?> <meta http-equiv="refresh" content="0;url=./../index11.php" /><?php
        break;
    case 1:
        ?> <meta http-equiv="refresh" content="0;url=./../programar/index.php?dni=<?php echo $dni ?>"/><?php
        break;
    case 2:
        ?> <meta http-equiv="refresh" content="0;url=./../enruta/index.php?dni=<?php echo $dni ?>"/><?php
        break;
    case 3:
        ?> <meta http-equiv="refresh" content="0;url=./../index11.php"/><?php
        break;
}


} else {
	mysqli_close($conexion);
	echo'<script type="text/javascript">
    window.location.href="./../index.php";
    </script>';

}


} else {
	mysqli_close($conexion);
	echo'<script type="text/javascript">
    window.location.href="./../index.php";
    </script>';


die();
}

?>