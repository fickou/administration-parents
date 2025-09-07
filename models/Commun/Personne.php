<?php

class Personne
{
    private $db;
    private $table = 'personnes';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($data)
    {
        try {
            // Champs obligatoires
            $required = ['prenom', 'nom', 'email', 'type_personne'];
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    throw new \Exception("Le champ $field est requis");
                }
            }

            // Valeurs par défaut
            $defaultData = [
                'id' => $this->generateUuid(),
                'actif' => 1,
                'cree_le' => date('Y-m-d H:i:s'),
                'modifie_le' => date('Y-m-d H:i:s')
            ];

            // Fusionner les données
            $personneData = array_merge($defaultData, $data);

            $fields = implode(', ', array_keys($personneData));
            $placeholders = implode(', ', array_fill(0, count($personneData), '?'));
            
            $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);
            
            if ($stmt->execute(array_values($personneData))) {
                return $personneData['id'];
            }
            
            return false;
            
        } catch (\Exception $e) {
            error_log("Erreur création personne: " . $e->getMessage());
            return false;
        }
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getByEmail($email)
    {
        $sql = "SELECT * FROM {$this->table} WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        try {
            // Ajouter la date de modification
            $data['modifie_le'] = date('Y-m-d H:i:s');
            
            $setClause = implode(' = ?, ', array_keys($data)) . ' = ?';
            $sql = "UPDATE {$this->table} SET $setClause WHERE id = ?";
            
            $params = array_values($data);
            $params[] = $id;
            
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
            
        } catch (\Exception $e) {
            error_log("Erreur mise à jour personne: " . $e->getMessage());
            return false;
        }
    }

    public function markEmailVerified($id)
    {
        $sql = "UPDATE {$this->table} SET email_verifie = 1, modifie_le = NOW() WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
    }

    private function generateUuid()
    {
        // Générer un UUID v4 compatible avec MySQL
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