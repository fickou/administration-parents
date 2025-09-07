<?php
class Note {
    private $db;
    private $table = 'notes';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (evaluation_id, eleve_id, note, appreciation) 
            VALUES (?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['evaluation_id'],
            $data['eleve_id'],
            $data['note'],
            $data['appreciation'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readByEvaluation($evaluationId) {
        $stmt = $this->db->prepare("
            SELECT n.*, p.prenom, p.nom, e.numero_matricule
            FROM {$this->table} n
            JOIN eleves el ON n.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            WHERE n.evaluation_id = ?
            ORDER BY p.nom, p.prenom
        ");
        $stmt->execute([$evaluationId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readByEleve($eleveId, $filters = []) {
        $sql = "
            SELECT n.*, e.titre, e.date_evaluation, e.coefficient, e.bareme,
                   m.nom as matiere_nom, ens.enseignant_id,
                   p.prenom as enseignant_prenom, p.nom as enseignant_nom
            FROM {$this->table} n
            JOIN evaluations e ON n.evaluation_id = e.id
            JOIN enseignements ens ON e.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            LEFT JOIN enseignants ens2 ON ens.enseignant_id = ens2.id
            LEFT JOIN personnes p ON ens2.id = p.id
            WHERE n.eleve_id = ?
        ";
        
        $params = [$eleveId];
        
        if (!empty($filters['matiere_id'])) {
            $sql .= " AND ens.matiere_id = ?";
            $params[] = $filters['matiere_id'];
        }
        
        if (!empty($filters['date_debut'])) {
            $sql .= " AND e.date_evaluation >= ?";
            $params[] = $filters['date_debut'];
        }
        
        if (!empty($filters['date_fin'])) {
            $sql .= " AND e.date_evaluation <= ?";
            $params[] = $filters['date_fin'];
        }
        
        $sql .= " ORDER BY e.date_evaluation DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET note = ?, appreciation = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['note'],
            $data['appreciation'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getMoyenneEleve($eleveId, $matiereId = null) {
        $sql = "
            SELECT AVG(n.note) as moyenne, COUNT(n.id) as nombre_notes,
                   m.nom as matiere_nom
            FROM {$this->table} n
            JOIN evaluations e ON n.evaluation_id = e.id
            JOIN enseignements ens ON e.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            WHERE n.eleve_id = ?
        ";
        
        $params = [$eleveId];
        
        if ($matiereId) {
            $sql .= " AND ens.matiere_id = ?";
            $params[] = $matiereId;
        }
        
        $sql .= " GROUP BY ens.matiere_id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMoyenneClasse($classeId, $evaluationId = null) {
        $sql = "
            SELECT AVG(n.note) as moyenne, COUNT(n.id) as nombre_notes,
                   m.nom as matiere_nom
            FROM {$this->table} n
            JOIN evaluations e ON n.evaluation_id = e.id
            JOIN enseignements ens ON e.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN eleves_classes ec ON n.eleve_id = ec.eleve_id
            WHERE ec.classe_id = ? AND ec.date_fin IS NULL
        ";
        
        $params = [$classeId];
        
        if ($evaluationId) {
            $sql .= " AND n.evaluation_id = ?";
            $params[] = $evaluationId;
        }
        
        $sql .= " GROUP BY ens.matiere_id";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function upsert($evaluationId, $eleveId, $note, $appreciation = null) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (evaluation_id, eleve_id, note, appreciation) 
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            note = VALUES(note), 
            appreciation = VALUES(appreciation)
        ");
        
        return $stmt->execute([$evaluationId, $eleveId, $note, $appreciation]);
    }
}
?>