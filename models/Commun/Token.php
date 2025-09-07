<?php
class Token {
    private $db;
    private $table = "tokens";

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Créer un nouveau token
     */
    public function create($personneId, $token, $duration = '+2 hours') {
        $sql = "INSERT INTO {$this->table} 
                (personne_id, token, type, est_valide, expiration, date_creation) 
                VALUES (:personne_id, :token, :type, :est_valide, :expiration, :date_creation)";
        
        $stmt = $this->db->prepare($sql);

        $expiration = date('Y-m-d H:i:s', strtotime($duration));
        $now = date('Y-m-d H:i:s');

        $stmt->bindParam(':personne_id', $personneId);
        $stmt->bindParam(':token', $token);
        $stmt->bindValue(':type', 'access', PDO::PARAM_STR);
        $stmt->bindValue(':est_valide', 1, PDO::PARAM_INT);
        $stmt->bindParam(':expiration', $expiration);
        $stmt->bindParam(':date_creation', $now);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    /**
     * Vérifier si un token est valide
     */
    public function verify($token) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE token = :token AND est_valide = 1 AND expiration > NOW() 
                LIMIT 1";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Invalider un token (ex: logout)
     */
    public function invalidate($token) {
        $sql = "UPDATE {$this->table} SET est_valide = 0 WHERE token = :token";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':token', $token);
        return $stmt->execute();
    }

    /**
     * Récupérer un token valide par type
     */
    public function getValidToken($token, $type) {
        $query = "SELECT * FROM tokens 
                WHERE token = :token 
                AND type = :type 
                AND est_valide = 1 
                AND expiration > NOW()
                LIMIT 1";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":token", $token);
        $stmt->bindParam(":type", $type);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
