<?php
class Discipline {
    private $db;
    private $table = 'incidents_discipline';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (eleve_id, date_incident, type_incident, description, gravite, 
             mesures_prises, cree_par, temoins) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['eleve_id'],
            $data['date_incident'],
            $data['type_incident'],
            $data['description'],
            $data['gravite'] ?? 'moyenne',
            $data['mesures_prises'] ?? null,
            $data['cree_par'],
            $data['temoins'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT i.*, p.prenom, p.nom as eleve_nom, e.numero_matricule,
                   c.nom as classe_nom, p_cre.prenom as createur_prenom,
                   p_cre.nom as createur_nom
            FROM {$this->table} i
            JOIN eleves el ON i.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            LEFT JOIN eleves_classes ec ON el.id = ec.eleve_id AND ec.date_fin IS NULL
            LEFT JOIN classes c ON ec.classe_id = c.id
            LEFT JOIN personnes p_cre ON i.cree_par = p_cre.id
            WHERE i.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT i.*, p.prenom, p.nom as eleve_nom, e.numero_matricule,
                   c.nom as classe_nom
            FROM {$this->table} i
            JOIN eleves el ON i.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            LEFT JOIN eleves_classes ec ON el.id = ec.eleve_id AND ec.date_fin IS NULL
            LEFT JOIN classes c ON ec.classe_id = c.id
            WHERE 1=1
        ";
        
        $params = [];
        
        if (!empty($filters['eleve_id'])) {
            $sql .= " AND i.eleve_id = ?";
            $params[] = $filters['eleve_id'];
        }
        
        if (!empty($filters['classe_id'])) {
            $sql .= " AND c.id = ?";
            $params[] = $filters['classe_id'];
        }
        
        if (!empty($filters['type_incident'])) {
            $sql .= " AND i.type_incident = ?";
            $params[] = $filters['type_incident'];
        }
        
        if (!empty($filters['gravite'])) {
            $sql .= " AND i.gravite = ?";
            $params[] = $filters['gravite'];
        }
        
        if (!empty($filters['date_debut'])) {
            $sql .= " AND i.date_incident >= ?";
            $params[] = $filters['date_debut'];
        }
        
        if (!empty($filters['date_fin'])) {
            $sql .= " AND i.date_incident <= ?";
            $params[] = $filters['date_fin'];
        }
        
        $sql .= " ORDER BY i.date_incident DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET eleve_id = ?, date_incident = ?, type_incident = ?, 
                description = ?, gravite = ?, mesures_prises = ?, temoins = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['eleve_id'],
            $data['date_incident'],
            $data['type_incident'],
            $data['description'],
            $data['gravite'] ?? 'moyenne',
            $data['mesures_prises'] ?? null,
            $data['temoins'] ?? null,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getIncidentsEleve($eleveId, $dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT i.*, p_cre.prenom as createur_prenom, p_cre.nom as createur_nom
            FROM {$this->table} i
            LEFT JOIN personnes p_cre ON i.cree_par = p_cre.id
            WHERE i.eleve_id = ?
        ";
        
        $params = [$eleveId];
        
        if ($dateDebut) {
            $sql .= " AND i.date_incident >= ?";
            $params[] = $dateDebut;
        }
        
        if ($dateFin) {
            $sql .= " AND i.date_incident <= ?";
            $params[] = $dateFin;
        }
        
        $sql .= " ORDER BY i.date_incident DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStatistiquesClasse($classeId, $dateDebut, $dateFin) {
        $stmt = $this->db->prepare("
            SELECT 
                COUNT(i.id) as total_incidents,
                i.type_incident,
                i.gravite,
                e.id as eleve_id, p.prenom, p.nom,
                c.nom as classe_nom
            FROM {$this->table} i
            JOIN eleves el ON i.eleve_id = el.id
            JOIN personnes p ON el.id = p.id
            JOIN eleves_classes ec ON el.id = ec.eleve_id
            JOIN classes c ON ec.classe_id = c.id
            WHERE c.id = ? 
            AND ec.date_fin IS NULL
            AND i.date_incident BETWEEN ? AND ?
            GROUP BY i.type_incident, i.gravite, e.id, p.prenom, p.nom, c.nom
            ORDER BY total_incidents DESC
        ");
        
        $stmt->execute([$classeId, $dateDebut, $dateFin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTypesIncidents() {
        $stmt = $this->db->prepare("
            SELECT DISTINCT type_incident 
            FROM {$this->table} 
            ORDER BY type_incident
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>