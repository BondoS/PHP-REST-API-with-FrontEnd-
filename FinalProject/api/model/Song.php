<?php
include_once '../config/Database.php';

class Song
{
    // database connection and table name
    private $pdo;
    private $table_name = "song";
    // object properties
    public $id;
    public $name;
    public $artist;
    public $album;
    public $gener;
    public $composer;
    public $youtubeLink;

    // constructor with $db as database connection
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function read(): PDOStatement
    {
        // select all query
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->pdo->query($query);
        return $stmt;
    }


    function getOne($id): PDOStatement
    {
        // select one track
        $query = "SELECT * FROM " . $this->table_name . " Where id = " . $id;
        $stmt = $this->pdo->query($query);
        return $stmt;
    }

    function create()
    {
        // $query = "INSERT INTO ". $this->table_name ."( `name`, `artist`, `gener`, `youtubeLink`) 
        // VALUES (".$track->name .",". $track->artist.",". $track->gener.",". $track->youtubeLink.")";
        $query = 'INSERT INTO ' .
            $this->table_name .
            ' SET
                name = :name,
                artist = :artist,
                gener = :gener,
                youtubeLink = :youtubeLink';

        $stmt = $this->pdo->prepare($query);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        // clear data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->artist = htmlspecialchars(strip_tags($this->artist));
        $this->gener = htmlspecialchars(strip_tags($this->gener));
        $this->youtubeLink = htmlspecialchars(strip_tags($this->youtubeLink));

        // bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':artist', $this->artist);
        $stmt->bindParam(':gener', $this->gener);
        $stmt->bindParam(':youtubeLink', $this->youtubeLink);

        // Execute
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
    function update()
    {
        $query = 'UPDATE ' .
            $this->table_name .
            ' SET
                name = :name,
                artist = :artist,
                gener = :gener,
                youtubeLink = :youtubeLink
            WHERE
                id = :id';

        $stmt = $this->pdo->prepare($query);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        // clear data
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->artist = htmlspecialchars(strip_tags($this->artist));
        $this->gener = htmlspecialchars(strip_tags($this->gener));
        $this->youtubeLink = htmlspecialchars(strip_tags($this->youtubeLink));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind data
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':artist', $this->artist);
        $stmt->bindParam(':gener', $this->gener);
        $stmt->bindParam(':youtubeLink', $this->youtubeLink);
        $stmt->bindParam(':id', $this->id);

        // Execute
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function delete()
    {
        // Create query
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = :id';

        // Prepare statement
        $stmt = $this->pdo->prepare($query);

        // Clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind data
        $stmt->bindParam(':id', $this->id);

        // Execute
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);

        return false;
    }
}
