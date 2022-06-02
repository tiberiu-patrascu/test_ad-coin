<?php

/**
 * Classe Db permet d'interagir avec une connexion PDO (PHP Data Objects)
 * @author Tiberiu PATRASCU
 * @version 1.0
 * @access public
 */
class Db
{
    /**
     * @var $instance Représente une variable d'instance
     */
    private static $instance = null;
    /**
     * @var PDO $pdo Représente une connexion PDO vers une base de données
     */
    protected $pdo;
    /**
     * Le constructer
     * @param PDO $_pdo La connexion PDO à utiliser
     */
    private function __construct(PDO $_pdo)
    {
        $this->pdo = $_pdo;
    }

    /**
     * Connexion PDO à la basse de données mysql
     * @return PDO 
     */
    public static function getDb()
    {
        if (Db::$instance === null) {
            try {
                //les options spécifiques de connexion
                $options = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ];

                $dbname = getenv('HTTP_DB_NAME', true) ?: getenv('HTTP_DB_NAME');
                $user = getenv('HTTP_USER', true) ?: getenv('HTTP_USER');
                $pass = getenv('HTTP_PASS', true) ?: getenv('HTTP_PASS');

                //les informations pour se connecter à la base de données
                $Dsn = "mysql:host=localhost;port=3306;dbname=" . $dbname . ";charset=UTF8;";
                //initialisation d'une instance
                Db::$instance = new PDO($Dsn, $user, $pass, $options);
            } catch (PDOException $erreur) {
                exit("Error Connecting Database");
            }
        }
        //envoyer une instance
        return self::$instance;
    }
}
