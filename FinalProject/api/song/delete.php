<?php
//Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers,Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin, Athorization, x-Requested-with");

include_once '../config/Database.php';
include_once '../model/Song.php';
$database = new Database();
$pdo = $database->getConnection();
$song = new Song($pdo);

// Get raw data
$data = json_decode(file_get_contents("php://input"), true);

// Set ID to delete
$song->id = $data['id'];

if ($song->delete()) {
  echo json_encode((array('message' => 'Track Delete')));
} else {
  echo json_encode(
    array('message' => 'Track Not Deleted')
  );
}
