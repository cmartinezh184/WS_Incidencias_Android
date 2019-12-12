<?PHP

include "Conexion.php";

$correo = $_POST["correo"];
$contrasenia = $_POST["contrasenia"];

if(isset($_GET["correo"], $_GET["contrasenia"])) {
    $correo = $_GET["correo"];
    $contrasenia = $_GET["contrasenia"];

    $consulta = "SELECT correo FROM persona WHERE correo = '{$correo}' AND contrasenia = '{$contrasenia}'";
    $resultado = mysqli_query($conexion, $consulta);

    if(!$resultado){
        mysqli_close($conexion);
        echo json_encode("Bienvenido");
    } else {
        echo json_encode("Credenciales no validos");
    }
} else {
    echo json_encode("Debe llenar todos los campos");
}

?>