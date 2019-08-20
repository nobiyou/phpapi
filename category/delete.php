<?php
//Req headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset:UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//Req includes
include_once '../config/database.php';
include_once '../objects/Category.php';

//Db conn and instances
$database = new Database();
$db=$database->getConnection();

$Category = new Category($db);

//Get post data
$data = json_decode(file_get_contents("php://input"));

//set Id of Category to be deleted
$Category->id = $data->id;

//delete Category
if ($Category->delete()) {
  echo json_encode(array('message' => 'Category was deleted'));
} else {
  echo json_encode(array('message' => 'Unable to delete Category'));
}