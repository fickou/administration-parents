<?php
class TuteurEleve {
    private $db;
    private $table = 'liens_responsable_eleve';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
       try {
            // Champs obligatoires
            $required = ['eleve_id', 'responsable_id'];
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    throw new \Exception("Le champ $field est requis");
                }
            }

            // Valeurs par défaut
            $defaultData = [
                'cree_le' => date('Y-m-d H:i:s')
            ];

            // Fusionner les données
            $tuteurEleveData = array_merge($defaultData, $data);

            $fields = implode(', ', array_keys($tuteurEleveData));
            $placeholders = implode(', ', array_fill(0, count($tuteurEleveData), '?'));

            $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);

            if ($stmt->execute(array_values($tuteurEleveData))) {
                return $this->db->lastInsertId();
            }
        } catch (\Throwable $th) {
            error_log("Erreur création lien tuteur-élève: " . $th->getMessage());
            return false;
        }
    }

    // READ
    public function read($eleveId, $responsableId) {
        $stmt = $this->db->prepare("
            SELECT * 
            FROM {$this->table} 
            WHERE eleve_id = ? AND responsable_id = ?
        ");
        $stmt->execute([$eleveId, $responsableId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];

        if (!empty($filters['eleve_id'])) {
            $sql .= " AND eleve_id = ?";
            $params[] = $filters['eleve_id'];
        }

        if (!empty($filters['responsable_id'])) {
            $sql .= " AND responsable_id = ?";
            $params[] = $filters['responsable_id'];
        }

        if (isset($filters['est_principal'])) {
            $sql .= " AND est_principal = ?";
            $params[] = $filters['est_principal'];
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($eleveId, $responsableId, $data) {
        $data['modifie_le'] = date('Y-m-d H:i:s');
        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }
        $values[] = $eleveId;
        $values[] = $responsableId;

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE eleve_id = ? AND responsable_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    // DELETE
    public function delete($eleveId, $responsableId) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE eleve_id = ? AND responsable_id = ?");
        return $stmt->execute([$eleveId, $responsableId]);
    }
}
?>