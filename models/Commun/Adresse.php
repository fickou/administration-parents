<?php
class Adresse {
    private $db;
    private $table = 'adresses';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (ligne1, ligne2, code_postal, ville, pays) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['ligne1'],
            $data['ligne2'] ?? null,
            $data['code_postal'] ?? null,
            $data['ville'] ?? null,
            $data['pays'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY ville, code_postal");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET ligne1 = ?, ligne2 = ?, code_postal = ?, ville = ?, pays = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['ligne1'],
            $data['ligne2'] ?? null,
            $data['code_postal'] ?? null,
            $data['ville'] ?? null,
            $data['pays'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function findByVille($ville) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE ville LIKE ?");
        $stmt->execute(["%$ville%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function linkToPersonne($personneId, $adresseId, $type = 'domicile', $principal = false) {
        $stmt = $this->db->prepare("
            INSERT INTO personnes_adresses 
            (personne_id, adresse_id, type_adresse, principal) 
            VALUES (?, ?, ?, ?)
        ");
        
        return $stmt->execute([$personneId, $adresseId, $type, $principal ? 1 : 0]);
    }

    public function getPersonneAdresses($personneId) {
        $stmt = $this->db->prepare("
            SELECT a.*, pa.type_adresse, pa.principal 
            FROM personnes_adresses pa
            JOIN {$this->table} a ON pa.adresse_id = a.id
            WHERE pa.personne_id = ?
            ORDER BY pa.principal DESC, pa.type_adresse
        ");
        $stmt->execute([$personneId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>