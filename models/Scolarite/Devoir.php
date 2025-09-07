<?php
class Devoir {
    private $db;
    private $table = 'devoirs';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (enseignement_id, titre, consignes, date_echeance, cree_par) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['enseignement_id'],
            $data['titre'],
            $data['consignes'] ?? null,
            $data['date_echeance'] ?? null,
            $data['cree_par'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT d.*, m.nom as matiere_nom, c.nom as classe_nom,
                   p.prenom, p.nom as enseignant_nom
            FROM {$this->table} d
            JOIN enseignements ens ON d.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN classes c ON ens.classe_id = c.id
            LEFT JOIN enseignants e ON ens.enseignant_id = e.id
            LEFT JOIN personnes p ON e.id = p.id
            WHERE d.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT d.*, m.nom as matiere_nom, c.nom as classe_nom,
                   p.prenom, p.nom as enseignant_nom
            FROM {$this->table} d
            JOIN enseignements ens ON d.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN classes c ON ens.classe_id = c.id
            LEFT JOIN enseignants e ON ens.enseignant_id = e.id
            LEFT JOIN personnes p ON e.id = p.id
            WHERE 1=1
        ";
        
        $params = [];
        
        if (!empty($filters['classe_id'])) {
            $sql .= " AND ens.classe_id = ?";
            $params[] = $filters['classe_id'];
        }
        
        if (!empty($filters['enseignant_id'])) {
            $sql .= " AND ens.enseignant_id = ?";
            $params[] = $filters['enseignant_id'];
        }
        
        if (!empty($filters['date_echeance_debut'])) {
            $sql .= " AND d.date_echeance >= ?";
            $params[] = $filters['date_echeance_debut'];
        }
        
        if (!empty($filters['date_echeance_fin'])) {
            $sql .= " AND d.date_echeance <= ?";
            $params[] = $filters['date_echeance_fin'];
        }
        
        $sql .= " ORDER BY d.date_echeance DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET titre = ?, consignes = ?, date_echeance = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['titre'],
            $data['consignes'] ?? null,
            $data['date_echeance'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getDevoirsClasse($classeId, $nonRendusSeulement = false) {
        $sql = "
            SELECT d.*, m.nom as matiere_nom, m.couleur,
                   p.prenom, p.nom as enseignant_nom
            FROM {$this->table} d
            JOIN enseignements ens ON d.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            LEFT JOIN enseignants e ON ens.enseignant_id = e.id
            LEFT JOIN personnes p ON e.id = p.id
            WHERE ens.classe_id = ?
        ";
        
        if ($nonRendusSeulement) {
            $sql .= " AND d.date_echeance >= CURDATE()";
        }
        
        $sql .= " ORDER BY d.date_echeance ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$classeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDevoirsEleve($eleveId, $nonRendusSeulement = false) {
        $sql = "
            SELECT d.*, m.nom as matiere_nom, c.nom as classe_nom,
                   rd.id as remise_id, rd.date_remise, rd.note as note_remise,
                   p.prenom, p.nom as enseignant_nom
            FROM {$this->table} d
            JOIN enseignements ens ON d.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN classes c ON ens.classe_id = c.id
            LEFT JOIN remises_devoirs rd ON d.id = rd.devoir_id AND rd.eleve_id = ?
            LEFT JOIN enseignants e ON ens.enseignant_id = e.id
            LEFT JOIN personnes p ON e.id = p.id
            WHERE ens.classe_id IN (
                SELECT classe_id FROM eleves_classes 
                WHERE eleve_id = ? AND date_fin IS NULL
            )
        ";
        
        $params = [$eleveId, $eleveId];
        
        if ($nonRendusSeulement) {
            $sql .= " AND rd.id IS NULL AND d.date_echeance >= CURDATE()";
        }
        
        $sql .= " ORDER BY d.date_echeance ASC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRemises($devoirId) {
        $stmt = $this->db->prepare("
            SELECT rd.*, p.prenom, p.nom, e.numero_matricule
            FROM remises_devoirs rd
            JOIN eleves el ON rd.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            WHERE rd.devoir_id = ?
            ORDER BY rd.date_remise DESC
        ");
        $stmt->execute([$devoirId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>