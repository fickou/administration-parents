<?php
class Database {
    private $host = "localhost";
    private $db_name = "admistration-parents";
    private $username = "root";
    private $password = "";
    public $connexion;

    public function getConnexion() {
        $this->connexion = null;
        try {
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                                    $this->username, $this->password);
            $this->connexion->exec("set names utf8");
            // Activer le mode exception pour la gestion des erreurs PDO
            $this->connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erreur de connexion : " . $exception->getMessage();
        }
        return $this->connexion;
    }

}
?>