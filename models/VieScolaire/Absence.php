<?php
class Absence {
    private $db;
    private $table = 'absences';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (eleve_id, seance_id, date_jour, heure_debut, heure_fin, motif, justifie, justifie_par, cree_par) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['eleve_id'],
            $data['seance_id'] ?? null,
            $data['date_jour'],
            $data['heure_debut'] ?? null,
            $data['heure_fin'] ?? null,
            $data['motif'] ?? null,
            $data['justifie'] ?? 0,
            $data['justifie_par'] ?? null,
            $data['cree_par'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT a.*, p.prenom, p.nom as eleve_nom, e.numero_matricule,
                   s.heure_debut as seance_heure_debut, s.heure_fin as seance_heure_fin,
                   m.nom as matiere_nom, c.nom as classe_nom
            FROM {$this->table} a
            JOIN eleves el ON a.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            LEFT JOIN seances s ON a.seance_id = s.id
            LEFT JOIN enseignements ens ON s.enseignement_id = ens.id
            LEFT JOIN matieres m ON ens.matiere_id = m.id
            LEFT JOIN classes c ON ens.classe_id = c.id
            WHERE a.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT a.*, p.prenom, p.nom as eleve_nom, e.numero_matricule,
                   m.nom as matiere_nom, c.nom as classe_nom
            FROM {$this->table} a
            JOIN eleves el ON a.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            LEFT JOIN seances s ON a.seance_id = s.id
            LEFT JOIN enseignements ens ON s.enseignement_id = ens.id
            LEFT JOIN matieres m ON ens.matiere_id = m.id
            LEFT JOIN classes c ON ens.classe_id = c.id
            WHERE 1=1
        ";
        
        $params = [];
        
        if (!empty($filters['eleve_id'])) {
            $sql .= " AND a.eleve_id = ?";
            $params[] = $filters['eleve_id'];
        }
        
        if (!empty($filters['classe_id'])) {
            $sql .= " AND c.id = ?";
            $params[] = $filters['classe_id'];
        }
        
        if (!empty($filters['date_debut'])) {
            $sql .= " AND a.date_jour >= ?";
            $params[] = $filters['date_debut'];
        }
        
        if (!empty($filters['date_fin'])) {
            $sql .= " AND a.date_jour <= ?";
            $params[] = $filters['date_fin'];
        }
        
        if (isset($filters['justifie'])) {
            $sql .= " AND a.justifie = ?";
            $params[] = $filters['justifie'];
        }
        
        $sql .= " ORDER BY a.date_jour DESC, a.heure_debut";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET eleve_id = ?, seance_id = ?, date_jour = ?, heure_debut = ?, 
                heure_fin = ?, motif = ?, justifie = ?, justifie_par = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['eleve_id'],
            $data['seance_id'] ?? null,
            $data['date_jour'],
            $data['heure_debut'] ?? null,
            $data['heure_fin'] ?? null,
            $data['motif'] ?? null,
            $data['justifie'] ?? 0,
            $data['justifie_par'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function justifier($id, $justifiePar, $motif = null) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET justifie = 1, justifie_par = ?, motif = COALESCE(?, motif) 
            WHERE id = ?
        ");
        
        return $stmt->execute([$justifiePar, $motif, $id]);
    }

    public function getStatistiquesClasse($classeId, $dateDebut, $dateFin) {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(a.id) as total_absences,
                SUM(a.justifie) as absences_justifiees,
                e.id as eleve_id, p.prenom, p.nom,
                c.nom as classe_nom
            FROM {$this->table} a
            JOIN eleves el ON a.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            JOIN eleves_classes ec ON el.id = ec.eleve_id
            JOIN classes c ON ec.classe_id = c.id
            WHERE c.id = ? 
            AND ec.date_fin IS NULL
            AND a.date_jour BETWEEN ? AND ?
            GROUP BY e.id, p.prenom, p.nom, c.nom
            ORDER BY p.nom, p.prenom
        ");
        
        $stmt->execute([$classeId, $dateDebut, $dateFin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAbsencesEleve($eleveId, $dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT a.*, m.nom as matiere_nom, 
                   p_ens.prenom as enseignant_prenom, p_ens.nom as enseignant_nom
            FROM {$this->table} a
            LEFT JOIN seances s ON a.seance_id = s.id
            LEFT JOIN enseignements ens ON s.enseignement_id = ens.id
            LEFT JOIN matieres m ON ens.matiere_id = m.id
            LEFT JOIN enseignants ens2 ON ens.enseignant_id = ens2.id
            LEFT JOIN personnes p_ens ON ens2.id = p_ens.id
            WHERE a.eleve_id = ?
        ";
        
        $params = [$eleveId];
        
        if ($dateDebut) {
            $sql .= " AND a.date_jour >= ?";
            $params[] = $dateDebut;
        }
        
        if ($dateFin) {
            $sql .= " AND a.date_jour <= ?";
            $params[] = $dateFin;
        }
        
        $sql .= " ORDER BY a.date_jour DESC, s.heure_debut";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>