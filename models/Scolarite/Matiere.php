<?php
class Matiere {
    private $db;
    private $table = 'matieres';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (nom, code, description, couleur) 
            VALUES (?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['nom'],
            $data['code'] ?? null,
            $data['description'] ?? null,
            $data['couleur'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY nom");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET nom = ?, code = ?, description = ?, couleur = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['nom'],
            $data['code'] ?? null,
            $data['description'] ?? null,
            $data['couleur'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getEnseignants($matiereId) {
        $stmt = $this->db->prepare("
            SELECT DISTINCT p.*, e.*
            FROM enseignements ens
            JOIN enseignants e ON ens.enseignant_id = e.id
            JOIN personnes p ON e.id = p.id
            WHERE ens.matiere_id = ?
            ORDER BY p.nom, p.prenom
        ");
        $stmt->execute([$matiereId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getClasses($matiereId) {
        $stmt = $this->db->prepare("
            SELECT DISTINCT c.*, n.nom as niveau_nom
            FROM enseignements ens
            JOIN classes c ON ens.classe_id = c.id
            JOIN niveaux n ON c.niveau_id = n.id
            WHERE ens.matiere_id = ?
            ORDER BY n.ordre, c.nom
        ");
        $stmt->execute([$matiereId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEvaluations($matiereId, $classeId = null) {
        $sql = "
            SELECT e.*, c.nom as classe_nom
            FROM evaluations e
            JOIN enseignements ens ON e.enseignement_id = ens.id
            JOIN classes c ON ens.classe_id = c.id
            WHERE ens.matiere_id = ?
        ";
        
        $params = [$matiereId];
        
        if ($classeId) {
            $sql .= " AND ens.classe_id = ?";
            $params[] = $classeId;
        }
        
        $sql .= " ORDER BY e.date_evaluation DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>