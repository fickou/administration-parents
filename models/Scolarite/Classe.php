<?php
class Classe {
    private $db;
    private $table = 'classes';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (ecole_id, niveau_id, nom, code, annee_scolaire, effectif_max) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['ecole_id'],
            $data['niveau_id'],
            $data['nom'],
            $data['code'] ?? null,
            $data['annee_scolaire'],
            $data['effectif_max'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT c.*, n.nom as niveau_nom, e.nom as ecole_nom
            FROM {$this->table} c
            JOIN niveaux n ON c.niveau_id = n.id
            JOIN ecoles e ON c.ecole_id = e.id
            WHERE c.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT c.*, n.nom as niveau_nom, e.nom as ecole_nom,
                   COUNT(ec.eleve_id) as effectif_actuel
            FROM {$this->table} c
            JOIN niveaux n ON c.niveau_id = n.id
            JOIN ecoles e ON c.ecole_id = e.id
            LEFT JOIN eleves_classes ec ON c.id = ec.classe_id AND ec.date_fin IS NULL
        ";
        
        $params = [];
        
        if (!empty($filters['ecole_id'])) {
            $sql .= " WHERE c.ecole_id = ?";
            $params[] = $filters['ecole_id'];
        }
        
        if (!empty($filters['niveau_id'])) {
            $sql .= (!empty($filters['ecole_id']) ? " AND" : " WHERE") . " c.niveau_id = ?";
            $params[] = $filters['niveau_id'];
        }
        
        if (!empty($filters['annee_scolaire'])) {
            $sql .= (!empty($filters['ecole_id']) || !empty($filters['niveau_id']) ? " AND" : " WHERE") . " c.annee_scolaire = ?";
            $params[] = $filters['annee_scolaire'];
        }
        
        $sql .= " GROUP BY c.id ORDER BY n.ordre, c.nom";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET ecole_id = ?, niveau_id = ?, nom = ?, code = ?, 
                annee_scolaire = ?, effectif_max = ?, modifie_le = CURRENT_TIMESTAMP 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['ecole_id'],
            $data['niveau_id'],
            $data['nom'],
            $data['code'] ?? null,
            $data['annee_scolaire'],
            $data['effectif_max'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getStudents($classeId, $activeOnly = true) {
        $sql = "
            SELECT p.*, e.numero_matricule, ec.date_debut, ec.date_fin
            FROM eleves_classes ec
            JOIN eleves e ON ec.eleve_id = e.id
            JOIN personnes p ON e.id = p.id
            WHERE ec.classe_id = ?
        ";
        
        if ($activeOnly) {
            $sql .= " AND ec.date_fin IS NULL";
        }
        
        $sql .= " ORDER BY p.nom, p.prenom";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$classeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnseignements($classeId) {
        $stmt = $this->db->prepare("
            SELECT ens.*, m.nom as matiere_nom, 
                   p.prenom, p.nom as enseignant_nom
            FROM enseignements ens
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN enseignants e ON ens.enseignant_id = e.id
            JOIN personnes p ON e.id = p.id
            WHERE ens.classe_id = ?
        ");
        $stmt->execute([$classeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCurrentStudentCount($classeId) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM eleves_classes 
            WHERE classe_id = ? AND date_fin IS NULL
        ");
        $stmt->execute([$classeId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    }
}
?>