<?php
//Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/Database.php';
include_once '../model/Song.php';
$database = new Database();
$pdo = $database->getConnection();
$song = new Song($pdo);
$stmt = $song->getOne($_GET['id']);


$row = $stmt->fetch(PDO::FETCH_ASSOC);
extract($row);
$song_item = array(
  "name" => $name,
  "artist" => $artist,
  "gener" => $gener,
  "youtubeLink" => $youtubeLink
);
print_r( json_encode($song_item));
