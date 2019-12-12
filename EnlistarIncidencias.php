<?PHP

include 'Conexion.php';

$consulta = "SELECT * FROM incidencia";
$resultado = mysqli_query($conexion, $consulta);

$filas = array();
while($f = mysqli_fetch_assoc($resultado)) {
    $filas[] = $f;
}
echo json_encode($filas);
mysqli_close($conexion);

?>