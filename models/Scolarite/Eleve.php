<?php
class Eleve {
    private $db;
    private $table = 'eleves';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($personneId, $data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (id, code_eleve, numero_matricule, date_inscription, nationalite) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $personneId,
            $data['code_eleve'] ?? null,
            $data['numero_matricule'] ?? null,
            $data['date_inscription'] ?? date('Y-m-d'),
            $data['nationalite'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT e.*, p.* 
            FROM {$this->table} e 
            JOIN personnes p ON e.id = p.id 
            WHERE e.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT e.*, p.* 
            FROM {$this->table} e 
            JOIN personnes p ON e.id = p.id 
            WHERE p.type_personne = 'eleve'
        ";
        
        $params = [];
        
        if (isset($filters['actif'])) {
            $sql .= " AND p.actif = ?";
            $params[] = $filters['actif'];
        }
        
        if (!empty($filters['classe_id'])) {
            $sql .= " AND EXISTS (
                SELECT 1 FROM eleves_classes ec 
                WHERE ec.eleve_id = e.id 
                AND ec.classe_id = ? 
                AND ec.date_fin IS NULL
            )";
            $params[] = $filters['classe_id'];
        }
        
        $sql .= " ORDER BY p.nom, p.prenom";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET code_eleve = ?, numero_matricule = ?, date_inscription = ?, nationalite = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['code_eleve'] ?? null,
            $data['numero_matricule'] ?? null,
            $data['date_inscription'] ?? null,
            $data['nationalite'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getCurrentClass($eleveId) {
        $stmt = $this->db->prepare("
            SELECT c.* 
            FROM eleves_classes ec 
            JOIN classes c ON ec.classe_id = c.id 
            WHERE ec.eleve_id = ? AND ec.date_fin IS NULL
        ");
        $stmt->execute([$eleveId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getClassHistory($eleveId) {
        $stmt = $this->db->prepare("
            SELECT ec.*, c.nom as classe_nom, n.nom as niveau_nom
            FROM eleves_classes ec
            JOIN classes c ON ec.classe_id = c.id
            JOIN niveaux n ON c.niveau_id = n.id
            WHERE ec.eleve_id = ?
            ORDER BY ec.date_debut DESC
        ");
        $stmt->execute([$eleveId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function enrollInClass($eleveId, $classeId, $dateDebut = null) {
        $stmt = $this->db->prepare("
            INSERT INTO eleves_classes 
            (eleve_id, classe_id, date_debut) 
            VALUES (?, ?, ?)
        ");
        
        return $stmt->execute([
            $eleveId,
            $classeId,
            $dateDebut ?: date('Y-m-d')
        ]);
    }

    public function unenrollFromClass($eleveId, $classeId, $dateFin = null) {
        $stmt = $this->db->prepare("
            UPDATE eleves_classes 
            SET date_fin = ? 
            WHERE eleve_id = ? AND classe_id = ? AND date_fin IS NULL
        ");
        
        return $stmt->execute([
            $dateFin ?: date('Y-m-d'),
            $eleveId,
            $classeId
        ]);
    }

    public function getResponsables($eleveId) {
        $stmt = $this->db->prepare("
            SELECT p.*, lre.lien_parental, lre.est_principal
            FROM liens_responsable_eleve lre
            JOIN personnes p ON lre.responsable_id = p.id
            WHERE lre.eleve_id = ?
            ORDER BY lre.est_principal DESC, p.nom
        ");
        $stmt->execute([$eleveId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>