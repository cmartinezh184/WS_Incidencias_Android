<?PHP

include 'Conexion.php';
$codigo = $_POST["codigo"];
$descripcion = $_POST["descripcion"];

if(isset($_GET["codigo"], $_GET["descripcion"]) ){

    $codigo = $_GET["codigo"];
    $descripcion = $_GET["descripcion"];

    $consulta = "INSERT INTO articulo VALUES ('{$codigo}','{$descripcion}')";
    $resultado = mysqli_query($conexion, $consulta);
    if(!$resultado){
        echo json_encode("Ha ocurrido un error");
    } else {
        echo json_encode("Operacion exitosa");
        mysqli_close($conexion);
    }

} else {
    echo json_encode("Debe llenar todos los campos");
}

?>