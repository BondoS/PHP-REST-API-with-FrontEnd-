<?php
//Required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once '../config/Database.php';
include_once '../model/Song.php';
$database = new Database();
$pdo = $database->getConnection();
$song = new Song($pdo);
$stmt = $song->read();

$songs_arr = array();
$songs_arr["songs"] = array();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $song_item = array(
        "id" => $id,
        "name" => $name,
        "artist" => $artist,
        "gener" => $gener,
        "youtubeLink" => $youtubeLink
    );
    array_push($songs_arr["songs"], $song_item);
}

echo json_encode($songs_arr);

