<?php

//Req headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: access");

//Include db and object

include_once '../config/database.php';
include_once '../objects/Category.php';

//New instances

$database = new Database();
$db = $database->getConnection();

$Category = new Category($db);

//Set ID of Category to be edited
$Category->id = isset($_GET['id']) ? $_GET['id']: die;

//Read details of edited Category
$Category->readOne();



//Create array
$Category_arr = array(
    "id" => $Category->id,
    "name" => $Category->name,
    "description" => $Category->description
);

echo json_encode($Category_arr);

//print_r(json_encode($product_arr));
