<?PHP

include 'Conexion.php';

$codigo = $_POST['codigo'];
$descripcion = $_POST['descripcion'];

if(isset($_GET["codigo"], $_GET["descripcion"]) ){

    $codigo = $_GET["codigo"];
    $descripcion = $_GET["descripcion"];

    $consulta = "UPDATE articulo SET descripcion ='{$descripcion}' WHERE codigo = '{$codigo}'";
    $resultado = mysqli_query($conexion, $consulta);
    if(!$resultado){
        echo json_encode("Ha ocurrido un error");
    } else {
    mysqli_close($conexion);
    }
    
} else {
    echo json_encode("Debe llenar todos los campos");
}

?>