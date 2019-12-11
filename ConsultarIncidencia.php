<?PHP
include 'Conexion.php';
$codigo=$_POST["codigo"];

if(isset($_GET["codigo"]))
{
    $codigo = $_GET["codigo"];

    $conn = mysqli_connect($Hostname, $user, $password, $database);

    $consulta = "SELECT codigo, descripcion FROM articulo WHERE codigo='{$codigo}'";
    $resultado = mysqli_query($conn, $consulta);

    if($consulta)
    {

        if($reg = mysqli_fetch_array($resultado))
        {
            $json['datos'] [] = $reg;
        }
        mysqli_close($conn);
        echo json_encode($json);

    }else //caso de que la consulta no venga estructurada
    {
        $result["codigo"] = '002';
        $result["descripcion"] = 'Martillo';
        $json['datos'][] = $result;
        echo json_encode($json);
    }
}else //en caso de que Android nos envie la informacion vacia
{
    $result["codigo"] = 'NULL';
    $result["descripcion"] = 'Vacio';
    $json['datos'][] = $result;
    echo json_encode($json);
}

?>