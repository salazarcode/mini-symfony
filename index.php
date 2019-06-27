<?PHP

require_once './vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

$request = Request::createFromGlobals();
$pista = utf8_encode($request->query->get('pista'));
$conn = new mysqli("localhost", "venbano_admin", "dmZDSLNhsw7N", "venbano_db");
$resultado = mysqli_query($conn, "select id,codigo,nombre from producto where codigo like '%" . $pista . "%' or nombre like '%" . $pista . "%'");

$res = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
    $res[] = array(
        "id" => $fila["id"],
        "codigo" => $fila["codigo"],
        "nombre" => utf8_encode($fila["nombre"]),
    );
}

$response = new JsonResponse(array(
    "success" => 1,
    "data" => $res
));

$response->send(); 