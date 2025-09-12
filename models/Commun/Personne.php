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
            // Champs obligatoires prenom, nom, telephone, type_personne'
            // Si le type_personne est 'eleve' ou parent, le champ 'email' n'est pas obligatoire, sinon il l'est
            $required = ['prenom', 'nom', 'telephone', 'type_personne'];
            if (!in_array($data['type_personne'], ['eleve', 'parent'])) {
                $required[] = 'email';
            }
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    throw new \Exception("Le champ $field est requis");
                }
            }
            // Valeurs par défaut
            $defaultData = [
                'cree_le' => date('Y-m-d H:i:s'),
                'modifie_le' => date('Y-m-d H:i:s'),
                'actif' => 1
            ];
            // Fusionner les données
            $personneData = array_merge($defaultData, $data);
            $fields = implode(', ', array_keys($personneData));
            $placeholders = implode(', ', array_fill(0, count($personneData), '?'));
            $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);
            if ($stmt->execute(array_values($personneData))) {
                return $this->db->lastInsertId();
            }
            return false;
            
            
        } catch (\Exception $e) {
            error_log("Erreur création personne: " . $e->getMessage());
            return false;
        }
    }

    // READ
    public function read($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    //DELETE
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$id]);
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

    //idenfiant du tuteur si email existe et type_personne=parent
    public function getIdParent($email, $type){
        $sql = "SELECT id FROM {$this->table} WHERE email = ? AND type_personne = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email, $type]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;
    }
}
?>