<?php
class Enseignant {
    private $db;
    private $table = 'enseignants';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($personneId, $data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (id, matricule_enseignant, date_embauche, statut) 
            VALUES (?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $personneId,
            $data['matricule_enseignant'] ?? null,
            $data['date_embauche'] ?? null,
            $data['statut'] ?? 'titulaire'
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
            WHERE p.type_personne = 'enseignant'
        ";
        
        $params = [];
        
        if (isset($filters['actif'])) {
            $sql .= " AND p.actif = ?";
            $params[] = $filters['actif'];
        }
        
        if (!empty($filters['statut'])) {
            $sql .= " AND e.statut = ?";
            $params[] = $filters['statut'];
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
            SET matricule_enseignant = ?, date_embauche = ?, statut = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['matricule_enseignant'] ?? null,
            $data['date_embauche'] ?? null,
            $data['statut'] ?? 'titulaire',
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getClasses($enseignantId) {
        $stmt = $this->db->prepare("
            SELECT DISTINCT c.*, n.nom as niveau_nom
            FROM enseignements ens
            JOIN classes c ON ens.classe_id = c.id
            JOIN niveaux n ON c.niveau_id = n.id
            WHERE ens.enseignant_id = ?
            ORDER BY n.ordre, c.nom
        ");
        $stmt->execute([$enseignantId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMatieres($enseignantId) {
        $stmt = $this->db->prepare("
            SELECT DISTINCT m.*
            FROM enseignements ens
            JOIN matieres m ON ens.matiere_id = m.id
            WHERE ens.enseignant_id = ?
            ORDER BY m.nom
        ");
        $stmt->execute([$enseignantId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmploiDuTemps($enseignantId, $dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT s.*, m.nom as matiere_nom, c.nom as classe_nom
            FROM seances s
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
}
?>