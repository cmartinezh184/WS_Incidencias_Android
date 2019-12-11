<?PHP

include 'Conexion.php';
$upload_path='fotos/';

$upload_url = 'http://localhost/Incidencias/'.$upload_path;

$respuesta = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['nombre']) and isset($_FILES['foto']['name'])) {
        $nombre = $_POST['nombre'];
        $info_foto = pathinfo($_FILES['foto']['name']);
        $extension = $info_foto['extension'];
        $url_foto = $upload_url.getFileName(). '.' .$extension;
        $path_foto = $upload_path.getFileName(). '.' .$extension;

        try{

            move_uploaded_file($_FILES['foto']['tmp_name'], $path_foto);
            $query = "INSERT INTO foto(url, nombre) VALUES('{$url_foto}', '{$nombre}')";

            if(mysqli_query($conexion, $query)){
                $respuesta = "Imagen cargada";
            }
            mysqli_close($conexion);

        } catch (Exception $e) {
            $respuesta['ERROR'] = false;
            $respuesta['MENSAJE'] = $e->getMessage();
        }
    }else {
        $respuesta['ERROR'] = true;
        $respuesta['MENSAJE'] = 'Debe elegir un archivo';
    }

            echo json_encode($respuesta);
}

function getFileName(){
    $hostname = "localhost";
    $database = "db_inventario";
    $user = "root";
    $password = ""; 
    $conexion = mysqli_connect($hostname, $user, $password, $database);
    $sql = "SELECT max(id) as id FROM foto";
    $resultado = mysqli_fetch_array(mysqli_query($conexion, $sql));
    mysqli_close($conexion);
    if($resultado['id']==null){
        return 1;
    }else{
        return ++$resultado['id'];
    }
}

?>