<?php
class EmploiDuTemps {
    private $db;
    private $table = 'seances';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (enseignement_id, jour_semaine, heure_debut, heure_fin, salle, date_debut, date_fin, recurrence) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['enseignement_id'],
            $data['jour_semaine'],
            $data['heure_debut'],
            $data['heure_fin'],
            $data['salle'] ?? null,
            $data['date_debut'] ?? null,
            $data['date_fin'] ?? null,
            $data['recurrence'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT s.*, m.nom as matiere_nom, c.nom as classe_nom,
                   p.prenom, p.nom as enseignant_nom
            FROM {$this->table} s
            JOIN enseignements ens ON s.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN classes c ON ens.classe_id = c.id
            LEFT JOIN enseignants e ON ens.enseignant_id = e.id
            LEFT JOIN personnes p ON e.id = p.id
            WHERE s.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT s.*, m.nom as matiere_nom, c.nom as classe_nom,
                   p.prenom, p.nom as enseignant_nom
            FROM {$this->table} s
            JOIN enseignements ens ON s.enseignement_id = ens.id
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
        
        if (!empty($filters['jour_semaine'])) {
            $sql .= " AND s.jour_semaine = ?";
            $params[] = $filters['jour_semaine'];
        }
        
        $sql .= " ORDER BY s.jour_semaine, s.heure_debut";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET enseignement_id = ?, jour_semaine = ?, heure_debut = ?, heure_fin = ?, 
                salle = ?, date_debut = ?, date_fin = ?, recurrence = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['enseignement_id'],
            $data['jour_semaine'],
            $data['heure_debut'],
            $data['heure_fin'],
            $data['salle'] ?? null,
            $data['date_debut'] ?? null,
            $data['date_fin'] ?? null,
            $data['recurrence'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getEmploiClasse($classeId, $dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT s.*, m.nom as matiere_nom, m.couleur,
                   p.prenom, p.nom as enseignant_nom, s.salle
            FROM {$this->table} s
            JOIN enseignements ens ON s.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            LEFT JOIN enseignants e ON ens.enseignant_id = e.id
            LEFT JOIN personnes p ON e.id = p.id
            WHERE ens.classe_id = ?
        ";
        
        $params = [$classeId];
        
        if ($dateDebut) {
            $sql .= " AND (s.date_fin IS NULL OR s.date_fin >= ?)";
            $params[] = $dateDebut;
        }
        
        if ($dateFin) {
            $sql .= " AND s.date_debut <= ?";
            $params[] = $dateFin;
        }
        
        $sql .= " ORDER BY s.jour_semaine, s.heure_debut";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmploiEnseignant($enseignantId, $dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT s.*, m.nom as matiere_nom, c.nom as classe_nom, s.salle
            FROM {$this->table} s
            JOIN enseignements ens ON s.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN classes c ON ens.classe_id = c.id
            WHERE ens.enseignant_id = ?
        ";
        
        $params = [$enseignantId];
        
        if ($dateDebut) {
            $sql .= " AND (s.date_fin IS NULL OR s.date_fin >= ?)";
            $params[] = $dateDebut;
        }
        
        if ($dateFin) {
            $sql .= " AND s.date_debut <= ?";
            $params[] = $dateFin;
        }
        
        $sql .= " ORDER BY s.jour_semaine, s.heure_debut";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSeancesDate($date) {
        $jourSemaine = date('w', strtotime($date)); // 0 (dimanche) à 6 (samedi)
        
        $stmt = $this->db->prepare("
            SELECT s.*, m.nom as matiere_nom, c.nom as classe_nom,
                   p.prenom, p.nom as enseignant_nom
            FROM {$this->table} s
            JOIN enseignements ens ON s.enseignement_id = ens.id
            JOIN matieres m ON ens.matiere_id = m.id
            JOIN classes c ON ens.classe_id = c.id
            LEFT JOIN enseignants e ON ens.enseignant_id = e.id
            LEFT JOIN personnes p ON e.id = p.id
            WHERE s.jour_semaine = ?
            AND (s.date_debut IS NULL OR s.date_debut <= ?)
            AND (s.date_fin IS NULL OR s.date_fin >= ?)
            ORDER BY s.heure_debut
        ");
        
        $stmt->execute([$jourSemaine, $date, $date]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>