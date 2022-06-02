<?php

class Passager
{
    /**
     * @var PDO $pdo Représente une connexion PDO vers une base de données
     */
    protected $pdo;

    /** Constructeur de la classe
     * @param string $_primaryKey Le nom de la clé primaire
     * @param string $_tableName Le nom de la table
     */
    public function __construct()
    {
        $this->pdo = Db::getDb(); // Récupère la connexion PDO
    }

    /**
     * Récupèrer toutes les données (lignes/colonnes) de la table
     * @return array || false $result le résultat de la requête sous forme de tableau 
     * ou false si la requête est fausse
     */
    public function read()
    {
        try {
            //déclarer la requête
            $sql = "SELECT * FROM passager;";
            //executer la requête
            $stmt = Db::getDb()->prepare($sql);
            //return le resultat sous forme de tableau contenant toutes les lignes
            $stmt->execute();
            return $stmt;
            //fermer la connexion
            $stmt->closeCursor();
        } catch (Exception $erreur) {
            exit($erreur->getMessage());
        }
    }

    /**
     * Récupèrer toutes les données (lignes/colonnes) de la table
     * @return array || false $result le résultat de la requête sous forme de tableau 
     * ou false si la requête est fausse
     */
    public function readBy()
    {
        try {
            //déclarer la requête
            $sql = "SELECT * FROM passager INNER JOIN billet on passager.id_passager = billet.id_passager_fk ORDER BY nom ASC;";
            //executer la requête
            $stmt = Db::getDb()->prepare($sql);
            //return le resultat sous forme de tableau contenant toutes les lignes
            $stmt->execute();
            return $stmt;
            //fermer la connexion
            $stmt->closeCursor();
        } catch (Exception $erreur) {
            exit($erreur->getMessage());
        }
    }
    /**
     * Insèrer un nouvel élément
     * @param array $utilisateur Le tableau des valeurs
     * @return int Le nombre des lignes affectées
     */
    public function create(array $utilisateur): int
    {
        try {
            $sql = "INSERT INTO passager (nom, prenom, age, email, ville) 
            VALUES (:nom, :prenom, :age, :email, :ville);";
            $stmt = Db::getDb()->prepare($sql);
            $vars = [
                ":nom" => $utilisateur['nom'],
                ":prenom" => $utilisateur['prenom'],
                ":age" => $utilisateur['age'],
                ":email" => $utilisateur['email'],
                ":ville" => $utilisateur['ville']
            ];
            if ($stmt->execute($vars)) {
                //retourner le contenu si il y a moins une ligne modifié
                return $stmt->rowCount() > 0;
            }
            $stmt->closeCursor();
        } catch (Exception $erreur) {
            exit($erreur->getMessage());
        }
    }


    /**
     * Recuperation de la bdd le nombre des ligne ayant le nom specifié
     * @return int Le nombre des ligne trouvées
     */
    public function check_user(array $utilisateur): int
    {
        try {
            $sql_verifie = "SELECT COUNT(*) as nb 
            FROM passager 
            WHERE nom = :nom AND email = :email";
            $stmt = Db::getDb()->prepare($sql_verifie);
            $var = [
                ":nom" => $utilisateur['nom'],
                ":email" => $utilisateur['email']
            ];
            if ($stmt->execute($var)) {
                $result = $stmt->fetch();
                $stmt->closeCursor();
                return $result['nb'];
            }
        } catch (Exception $erreur) {
            exit($erreur->getMessage());
        }
    }
}
