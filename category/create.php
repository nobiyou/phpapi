<?php

//Req headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset:UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 3600');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

//Req includes
include_once '../config/database.php';
include_once '../objects/Category.php';

//Db conn and instances
$database = new Database();
$db = $database->getConnection();

$Category = new Category($db);

//Get post data
date_default_timezone_set('Asia/Shanghai');
$data = json_decode(file_get_contents('php://input'));



//set Category values
$Category->name = $data->name;
$Category->description = $data->description;
$Category->pid = $data->pid;
$Category->created = date('Y-m-d H:i:s');

//Create Category
//var_dump($Category->name);
//var_dump($Category->create());
if ($Category->create()) {
    echo json_encode(array('message' => 'Category was Created'));
} else {
    echo json_encode(array('message' => 'Unable to create Category'));
}
