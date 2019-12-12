<?PHP

$hostname = "127.0.0.1:3306"; // Necesita indicarse el puerto de MySQL
$database = "incidencias";
$user = "root";
$password = "f6VZGufQ4Mfs"; 

$conexion= new mysqli($hostname, $user, $password, $database);
if($conexion->connect_errno){
    echo "Conexion fallida";
}

?>