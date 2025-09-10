<?php
class Ecole{
    private $db;
    private $table = 'ecoles';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        try {
            // Champs obligatoires
            $required = ['nom', 'email', 'telephone', 'ville', 'pays'];
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    throw new \Exception("Le champ $field est requis");
                }
            }

            // Valeurs par défaut
            $defaultData = [
                'id' => $this->generateUuid(),
                'cree_le' => date('Y-m-d H:i:s'),
                'modifie_le' => date('Y-m-d H:i:s')
            ];

            // Fusionner les données
            $ecoleData = array_merge($defaultData, $data);

            $fields = implode(', ', array_keys($ecoleData));
            $placeholders = implode(', ', array_fill(0, count($ecoleData), '?'));

            $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);

            if ($stmt->execute(array_values($ecoleData))) {
                return $ecoleData['id'];
            }

            return false;
        } catch (\Throwable $th) {
            error_log("Erreur création école: " . $th->getMessage());
            return false;
        }
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll() {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $data['modifie_le'] = date('Y-m-d H:i:s');
        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }
        $values[] = $id;

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($values);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    private function generateUuid() {
        return bin2hex(random_bytes(16));
    }

    //Nombre ecole dans la base
    public function countEcoles() {
        $stmt = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['total'] : 0;
    }

    //verifier si une ecole existe par email
    public function getByEmail($email) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? ((int)$result['total'] > 0) : false;
    }
}
?>