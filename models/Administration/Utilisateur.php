<?php

class Utilisateur
{
    private $db;
    private $table = 'utilisateurs';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($data)
    {
        try {
            // Champs obligatoires
            $required = ['personne_id', 'mot_de_passe'];
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    throw new Exception("Le champ $field est requis");
                }
            }

            // Valeurs par défaut
            $defaultData = [
                'id' => $this->generateUuid(),
                'role' => $data['role'] ?? 'parent',
                'est_actif' => 1,
                'email_verifie' => 0
            ];

            // Fusionner les données
            $utilisateurData = array_merge($defaultData, $data);

            $fields = implode(', ', array_keys($utilisateurData));
            $placeholders = implode(', ', array_fill(0, count($utilisateurData), '?'));
            
            $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);
            
            if ($stmt->execute(array_values($utilisateurData))) {
                return $utilisateurData['id'];
            }
            
            return false;
            
        } catch (Exception $e) {
            error_log("Erreur création utilisateur: " . $e->getMessage());
            return false;
        }
    }

    public function getByPersonneId($personneId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE personne_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$personneId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLastLogin($id)
    {
        $sql = "UPDATE {$this->table} SET derniere_connexion = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function updatePassword($personneId, $hashedPassword)
    {
        $sql = "UPDATE {$this->table} SET mot_de_passe = ? WHERE personne_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$hashedPassword, $personneId]);
    }

    public function markEmailVerified($personneId)
    {
        $sql = "UPDATE {$this->table} SET email_verifie = 1 WHERE personne_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$personneId]);
    }

    public function deactivate($id)
    {
        $sql = "UPDATE {$this->table} SET est_actif = 0 WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    private function generateUuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
?>