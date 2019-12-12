<?PHP

include 'Conexion.php';
$cedula = $_POST["cedula"];
$primer_nombre = $_POST["primer_nombre"];
$segundo_nombre = $_POST["segundo_nombre"];
$primer_apellido = $_POST["primer_apellido"];
$segundo_apellido = $_POST["segundo_apellido"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$contrasenia = $_POST["contrasenia"];
$distrito_id = $_POST["distrito_id"];
$direccion = $_POST["direccion"];

if(isset($_GET["cedula"], $_GET["primer_nombre"],
$_GET["segundo_nombre"], $_GET["primer_apellido"],
$_GET["segundo_apellido"], $_GET["correo"],
$_GET["telefono"], $_GET["contrasenia"], 
$_GET["distrito_id"], $_GET["direccion"]) ){

    $cedula = (int) $_GET["cedula"];
    $primer_nombre = $_GET["primer_nombre"];
    $segundo_nombre = $_GET["segundo_nombre"];
    $primer_apellido = $_GET["primer_apellido"];
    $segundo_apellido = $_GET["segundo_apellido"];
    $correo = $_GET["correo"];
    $telefono = (int) $_GET["telefono"];
    $contrasenia = $_GET["contrasenia"];
    $distrito_id = (int) $_GET["distrito_id"];
    $direccion = $_GET["direccion"];

    // Insercion de direccion nueva a la base de datos para poder agregarla a la persona
    $consulta = "INSERT INTO direccion (anotaciones, distrito_id)  VALUES('{$direccion}', {$distrito_id})";
    $resultado = mysqli_query($conexion, $consulta);
    if(!$resultado){
        echo json_encode("No se ha podido registrar la direccion");
    } else {

    $sql = "SELECT max(direccion_id) as id FROM direccion";
    $resultado = mysqli_fetch_array(mysqli_query($conexion, $sql));
    if($resultado['id']==null){
        echo json_encode("No se encuentran direcciones");
    } else {
        $direccion_id = $resultado['id'];

        // Insercion de persona
        $consulta = "INSERT INTO persona (cedula, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, direccion_id, correo, telefono, contrasenia) VALUES ('{$cedula}','{$primer_nombre}', '{$segundo_nombre}', '{$primer_apellido}','{$segundo_apellido}', '{$direccion_id}', '{$correo}', '{$telefono}', '{$contrasenia}')";
        $resultado = mysqli_query($conexion, $consulta);
        if(!$resultado){
            echo json_encode("No se ha podido registrar el usuario");
        } else {
            echo json_encode("Usuario registrado");
            mysqli_close($conexion);
        }
    }

    }

} else {
    echo json_encode("Debe llenar todos los campos");
}

?>