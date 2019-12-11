<?PHP

include 'Conexion.php';
$usuario_id = $_POST["usuario_id"];
$descripcion = $_POST["descripcion"];
$localizacion = $_POST["localizacion"];
$upload_path='fotos/';

$upload_url = 'http://localhost/Incidencias/'.$upload_path;

$respuesta = array();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['usuario_id']) and isset($_FILES['foto']) and isset($_POST["descripcion"]) and isset($_POST["localizacion"])) {
        $info_foto = pathinfo($_FILES['foto']);
        $extension = $info_foto['extension'];
        $url_foto = $upload_url.getFileName(). '.' .$extension;
        $path_foto = $upload_path.getFileName(). '.' .$extension;

        try{

            move_uploaded_file($_FILES['foto'], $path_foto);
            $query = "INSERT INTO incidencia VALUES('{$usuario_id}', '{$descripcion}', '{$localizacion}', '{$url_foto}')";

            if(mysqli_query($conexion, $query)){
                $respuesta = "Incidencia registrada";
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
} else {
    $respuesta = "Debe llenar todos los campos";
    echo json_encode($respuesta);
}

function getFileName(){
    $hostname = "127.0.0.1:3306";
    $database = "incidencias";
    $user = "root";
    $password = "f6VZGufQ4Mfs"; 
    $conexion = mysqli_connect($hostname, $user, $password, $database);
    $sql = "SELECT max(id) as id FROM incidencia";
    $resultado = mysqli_fetch_array(mysqli_query($conexion, $sql));
    mysqli_close($conexion);
    if($resultado['id']==null){
        return 1;
    }else{
        return ++$resultado['id'];
    }
}

?>