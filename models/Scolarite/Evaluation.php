<?php
class Evaluation {
    private $db;
    private $table = 'evaluations';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (enseignement_id, titre, description, date_evaluation, coefficient, bareme) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['enseignement_id'],
            $data['titre'],
            $data['description'] ?? null,
            $data['date_evaluation'],
            $data['coefficient'] ?? 1.00,
            $data['bareme'] ?? 20.00
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT e.*, m.nom as matiere_nom, c.nom as classe_nom,
                   ens.enseignant_id, p.prenom, p.nom as enseignant_nom
            FROM {$this->table} e
            JOIN enseignements ens ON e.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN classes c ON ens.classe_id = c.id
            LEFT JOIN enseignants ens2 ON ens.enseignant_id = ens2.id
            LEFT JOIN personnes p ON ens2.id = p.id
            WHERE e.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT e.*, m.nom as matiere_nom, c.nom as classe_nom,
                   p.prenom, p.nom as enseignant_nom
            FROM {$this->table} e
            JOIN enseignements ens ON e.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN classes c ON ens.classe_id = c.id
            LEFT JOIN enseignants ens2 ON ens.enseignant_id = ens2.id
            LEFT JOIN personnes p ON ens2.id = p.id
            WHERE 1=1
        ";
        
        $params = [];
        
        if (!empty($filters['classe_id'])) {
            $sql .= " AND ens.classe_id = ?";
            $params[] = $filters['classe_id'];
        }
        
        if (!empty($filters['matiere_id'])) {
            $sql .= " AND ens.matiere_id = ?";
            $params[] = $filters['matiere_id'];
        }
        
        if (!empty($filters['enseignant_id'])) {
            $sql .= " AND ens.enseignant_id = ?";
            $params[] = $filters['enseignant_id'];
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
            SET titre = ?, description = ?, date_evaluation = ?, 
                coefficient = ?, bareme = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['titre'],
            $data['description'] ?? null,
            $data['date_evaluation'],
            $data['coefficient'] ?? 1.00,
            $data['bareme'] ?? 20.00,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getNotes($evaluationId) {
        $noteModel = new Note($this->db);
        return $noteModel->readByEvaluation($evaluationId);
    }

    public function getMoyenne($evaluationId) {
        $stmt = $this->db->prepare("
            SELECT AVG(note) as moyenne, COUNT(*) as nombre_notes
            FROM notes 
            WHERE evaluation_id = ?
        ");
        $stmt->execute([$evaluationId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEvaluationsClasse($classeId, $dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT e.*, m.nom as matiere_nom, m.couleur
            FROM {$this->table} e
            JOIN enseignements ens ON e.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            WHERE ens.classe_id = ?
        ";
        
        $params = [$classeId];
        
        if ($dateDebut) {
            $sql .= " AND e.date_evaluation >= ?";
            $params[] = $dateDebut;
        }
        
        if ($dateFin) {
            $sql .= " AND e.date_evaluation <= ?";
            $params[] = $dateFin;
        }
        
        $sql .= " ORDER BY e.date_evaluation, m.nom";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>