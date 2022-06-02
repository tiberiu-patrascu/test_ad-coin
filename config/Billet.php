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
            $sql = "SELECT * FROM billet;";
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
}
