<?php

//Req headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset:UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

//Req includes
include_once '../config/database.php';
include_once '../objects/Product.php';

//Db conn and instances
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

//Get post data
date_default_timezone_set('Asia/Shanghai');
$data = json_decode(file_get_contents('php://input'));

//set product values
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->category_id = $data->category_id;
$product->created = date('Y-m-d H:i:s');

//Create product
//var_dump($product->name);
if ($product->create()) {
    echo json_encode(array('message' => 'product was Created'));
} else {
    echo json_encode(array('message' => 'Unable to create product'));
}
