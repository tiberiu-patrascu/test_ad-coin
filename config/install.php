<?php
require_once "Loader.php";

try {
    $sql = file_get_contents("data/db.sql");
    $connectionDb = Db::getDb();
    $connectionDb->exec($sql);
    echo "La base des données et les tables sont crées avec succes!";
} catch (PDOException $e) {
    echo "Error création !";
}