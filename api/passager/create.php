<?php
require_once "../../config/Loader.php";

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//filtrer les inputs
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars(strip_tags($data));
    return $data;
}

//vérifier si les données sont arrives avec la méthode POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //declarer un nouvel utilisateur
    $user = new Passager();

    //récupérer les données saisies
    $data = json_decode(file_get_contents("php://input"));

    //ajouter les données dans un tableau
    $vars = [
        "nom" => test_input($data->nom),
        "prenom" => test_input($data->prenom),
        "age" => test_input($data->age),
        "email" => test_input($data->email),
        "ville" => test_input($data->ville)
    ];

    //vérifier si l'utilisateur est present dans la base des données
    if ($user->check_user($vars)) {
        echo '{';
        echo '"Message": "Utilisateur déjà présent !"';
        echo '}';
    } else {
        //ajouter l'utilisateur dans la base des données
        if ($user->create($vars)) {
            echo '{';
            echo '"Message": "Utilisateur ajouté"';
            echo '}';
        } else {
            echo '{';
            echo '"Message": "Erreur d\'ajoute utilisateur"';
            echo '}';
        }
    }
} else {
    echo '[{ "Message": "Il faut utiliser l\'url suivant : api/passager/create.php?nom=votre_nom_de_famille&prenom=votre_prenom&age=votre_age&email=votre_email&ville=votre_ville"},';
    echo  '{"Message": "Ou passer par le logiciel postman"}]';
}
