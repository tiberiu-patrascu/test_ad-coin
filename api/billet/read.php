<?php
require_once "../../config/Loader.php";

header("Content-Type: application/json; charset=UTF-8");

//vérifier si les données sont arrives avec la méthode GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    //declarer un nouvel utilisateur
    $user = new Passager();

    //lire les données
    $stmt = $user->read();

    //compter les colonnes
    $counter = $stmt->rowCount();

    //Vérrifier si les il y a au moins une ligne récuperée de la base de données
    if ($counter > 0) {
        //declarer un tableau pour les stockage des données
        $users = [];
        $users["body"] = [];
        $users["count"] = $counter;

        //récupérer les données et les ajouter dans un tableau
        while ($result = $stmt->fetch()) {
            //ajouter les données récupérées dans le tableau
            array_push($users["body"], $result);
        }
        //afficher les données
        echo json_encode($users);
    } else {
        //si il n'y a pas des données dans la table afficher un tableau vide
        echo json_encode(
            array("body" => [], "count" => 0)
        );
    }
}
