<?PHP

include 'Conexion.php';
$usuario_id = $_POST["usuario_id"];
$descripcion = $_POST["descripcion"];
$latitud = $_POST["latitud"];
$longitud = $_POST["longitud"];
$upload_path='Fotos/';

$upload_url = "http://localhost/Incidencias/".$upload_path;
$public_upload_url = "http://54.227.173.39/Incidencias/".$upload_path;

$respuesta = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $info_foto = pathinfo($_FILES["foto"]["name"]);
    $extension = $info_foto["extension"];
    $url_foto = $public_upload_url.getFileName(). '.' .$extension;
    $path_foto = $upload_path.getFileName(). '.' .$extension;

    try{
        move_uploaded_file($_FILES["foto"]["tmp_name"], $path_foto);
        $query = "UPDATE TABLE incidencia (usuario_id, descripcion, latitud, longitud, url_foto) VALUES('{$usuario_id}', '{$descripcion}', '{$latitud}', '{$longitud}', '{$url_foto}')";

        if(mysqli_query($conexion, $query)){
            echo json_encode("Incidencia registrada");
        } else {
            echo json_encode("No se ha registrado la incidencia");
        }
        mysqli_close($conexion);

    } catch (Exception $e) {
        echo json_encode($e->getMessage());
    }
    
} else {
    $respuesta = "Ha ocurrido un error";
    echo json_encode($respuesta);
}

function getFileName(){
    $hostname = "127.0.0.1:3306";
    $database = "incidencias";
    $user = "root";
    $password = "f6VZGufQ4Mfs"; 
    $conexion = mysqli_connect($hostname, $user, $password, $database);
    $sql = "SELECT max(incidencia_id) as id FROM incidencia";
    $resultado = mysqli_fetch_array(mysqli_query($conexion, $sql));
    mysqli_close($conexion);
    if($resultado["id"]==null){
        return 1;
    }else{
        return ++$resultado["id"];
    }
}

?>