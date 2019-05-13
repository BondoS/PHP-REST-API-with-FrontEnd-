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

$song->name = $data['track']['name'];
$song->artist = $data['track']['artist'];
$song->gener = $data['track']['gener'];
$song->youtubeLink = $data['track']['youtubeLink'];

if ($song->create()) {
  echo json_encode((array('message' => 'Track Created')));
} else {
  echo json_encode(
    array('message' => 'Track Not Created', 'ejogf' => $song->create())
  );
}
