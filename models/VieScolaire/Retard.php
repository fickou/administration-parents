<?php
class Retard {
    private $db;
    private $table = 'retards';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (eleve_id, seance_id, date_jour, minutes_retard, motif, cree_par) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['eleve_id'],
            $data['seance_id'] ?? null,
            $data['date_jour'],
            $data['minutes_retard'],
            $data['motif'] ?? null,
            $data['cree_par'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT r.*, p.prenom, p.nom as eleve_nom, e.numero_matricule,
                   s.heure_debut as seance_heure_debut, s.heure_fin as seance_heure_fin,
                   m.nom as matiere_nom, c.nom as classe_nom
            FROM {$this->table} r
            JOIN eleves el ON r.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            LEFT JOIN seances s ON r.seance_id = s.id
            LEFT JOIN enseignements ens ON s.enseignement_id = ens.id
            LEFT JOIN matieres m ON ens.matiere_id = m.id
            LEFT JOIN classes c ON ens.classe_id = c.id
            WHERE r.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT r.*, p.prenom, p.nom as eleve_nom, e.numero_matricule,
                   m.nom as matiere_nom, c.nom as classe_nom
            FROM {$this->table} r
            JOIN eleves el ON r.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            LEFT JOIN seances s ON r.seance_id = s.id
            LEFT JOIN enseignements ens ON s.enseignement_id = ens.id
            LEFT JOIN matieres m ON ens.matiere_id = m.id
            LEFT JOIN classes c ON ens.classe_id = c.id
            WHERE 1=1
        ";
        
        $params = [];
        
        if (!empty($filters['eleve_id'])) {
            $sql .= " AND r.eleve_id = ?";
            $params[] = $filters['eleve_id'];
        }
        
        if (!empty($filters['classe_id'])) {
            $sql .= " AND c.id = ?";
            $params[] = $filters['classe_id'];
        }
        
        if (!empty($filters['date_debut'])) {
            $sql .= " AND r.date_jour >= ?";
            $params[] = $filters['date_debut'];
        }
        
        if (!empty($filters['date_fin'])) {
            $sql .= " AND r.date_jour <= ?";
            $params[] = $filters['date_fin'];
        }
        
        $sql .= " ORDER BY r.date_jour DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET eleve_id = ?, seance_id = ?, date_jour = ?, 
                minutes_retard = ?, motif = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['eleve_id'],
            $data['seance_id'] ?? null,
            $data['date_jour'],
            $data['minutes_retard'],
            $data['motif'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getRetardsEleve($eleveId, $dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT r.*, m.nom as matiere_nom, 
                   p_ens.prenom as enseignant_prenom, p_ens.nom as enseignant_nom
            FROM {$this->table} r
            LEFT JOIN seances s ON r.seance_id = s.id
            LEFT JOIN enseignements ens ON s.enseignement_id = ens.id
            LEFT JOIN matieres m ON ens.matiere_id = m.id
            LEFT JOIN enseignants ens2 ON ens.enseignant_id = ens2.id
            LEFT JOIN personnes p_ens ON ens2.id = p_ens.id
            WHERE r.eleve_id = ?
        ";
        
        $params = [$eleveId];
        
        if ($dateDebut) {
            $sql .= " AND r.date_jour >= ?";
            $params[] = $dateDebut;
        }
        
        if ($dateFin) {
            $sql .= " AND r.date_jour <= ?";
            $params[] = $dateFin;
        }
        
        $sql .= " ORDER BY r.date_jour DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatistiquesClasse($classeId, $dateDebut, $dateFin) {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(r.id) as total_retards,
                AVG(r.minutes_retard) as moyenne_retard,
                e.id as eleve_id, p.prenom, p.nom,
                c.nom as classe_nom
            FROM {$this->table} r
            JOIN eleves el ON r.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            JOIN eleves_classes ec ON el.id = ec.eleve_id
            JOIN classes c ON ec.classe_id = c.id
            WHERE c.id = ? 
            AND ec.date_fin IS NULL
            AND r.date_jour BETWEEN ? AND ?
            GROUP BY e.id, p.prenom, p.nom, c.nom
            ORDER BY total_retards DESC, moyenne_retard DESC
        ");
        
        $stmt->execute([$classeId, $dateDebut, $dateFin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalMinutesRetard($eleveId, $dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT SUM(minutes_retard) as total_minutes
            FROM {$this->table} 
            WHERE eleve_id = ?
        ";
        
        $params = [$eleveId];
        
        if ($dateDebut) {
            $sql .= " AND date_jour >= ?";
            $params[] = $dateDebut;
        }
        
        if ($dateFin) {
            $sql .= " AND date_jour <= ?";
            $params[] = $dateFin;
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_minutes'] ?? 0;
    }
}
?>