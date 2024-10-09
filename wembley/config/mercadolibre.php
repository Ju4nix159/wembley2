<?php
// Method: POST, PUT, GET etc
// Data: array("param" => "value") ==> index.php?param=value


require 'database.php';
$db = new Database();
$con = $db->conectar(); 


$n_producto = $_GET['n_producto'];

$sql_informacion_producto = $con->prepare("SELECT * FROM productos WHERE n_producto = :n_producto");
$sql_informacion_producto->bindParam(':n_producto',$n_producto);
$sql_informacion_producto->execute();
$informacion_productos = $sql_informacion_producto->fetch(PDO::FETCH_ASSOC);


$producto = array(
    "title" => $informacion_productos["nombre"],
    "category_id" => "MLA3530",
    "price" => $informacion_productos["precio"],
    "currency_id" => "ARS",
    "available_quantity" => $informacion_productos["stock"],
    "buying_mode" => "buy_it_now",
    "condition" => "new",
    "listing_type_id" => "gold_special",
    "pictures" => array(
        array("source" => "wembley\imagen\botines\2.png"),
    ),
    "shipping" => array(
        "mode" => "me1"
    )
);




$url = "https://api.mercadolibre.com/items";
$method = "POST";
$curl = curl_init();

$data = json_encode($producto);

curl_setopt_array($curl, [
	CURLOPT_URL => $url ,
    CURLOPT_POSTFIELDS => $data,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => $method,
	CURLOPT_HTTPHEADER => [
        "Content-Type:application/json",
		"api key"
	],
]);
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

/* if ($err) {
    echo " <br> error <br>";
	echo "cURL Error #:" . $err;
} else {

    echo " <br> respuesta <br>";
	echo $response;
} */
    echo '<script>';
    echo 'alert("Producto enviado a mercado libre");';
    echo 'window.location.href = "../html/admin/productos.php";';
    echo '</script>';
?>
