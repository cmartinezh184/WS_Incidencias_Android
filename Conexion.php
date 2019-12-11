<?PHP

$hostname = "localhost";
$database = "db_incidencias";
$user = "root";
$password = ""; 

$conexion= new mysqli($hostname, $user, $password, $database);
if($conexion->connect_errno){
    echo "Conexion fallida";
}

?>