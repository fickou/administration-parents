<?php
class Facture {
    private $db;
    private $table = 'factures';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (eleve_id, numero, intitule, date_emission, date_echeance, total, devise) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        $numero = 'FACT-' . date('Ymd-His');
        
        return $stmt->execute([
            $data['eleve_id'],
            $numero,
            $data['intitule'] ?? 'Facture',
            $data['date_emission'] ?? date('Y-m-d'),
            $data['date_echeance'] ?? date('Y-m-d', strtotime('+30 days')),
            $data['total'],
            $data['devise'] ?? 'EUR'
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT f.*, p.prenom, p.nom, p.email, e.numero_matricule
            FROM {$this->table} f
            JOIN eleves e ON f.eleve_id = e.id
            JOIN personnes p ON e.id = p.id
            WHERE f.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT f.*, p.prenom, p.nom, e.numero_matricule
            FROM {$this->table} f
            JOIN eleves e ON f.eleve_id = e.id
            JOIN personnes p ON e.id = p.id
            WHERE 1=1
        ";
        
        $params = [];
        
        if (!empty($filters['eleve_id'])) {
            $sql .= " AND f.eleve_id = ?";
            $params[] = $filters['eleve_id'];
        }
        
        if (!empty($filters['statut'])) {
            $sql .= " AND f.statut = ?";
            $params[] = $filters['statut'];
        }
        
        if (!empty($filters['date_emission_debut'])) {
            $sql .= " AND f.date_emission >= ?";
            $params[] = $filters['date_emission_debut'];
        }
        
        if (!empty($filters['date_emission_fin'])) {
            $sql .= " AND f.date_emission <= ?";
            $params[] = $filters['date_emission_fin'];
        }
        
        if (!empty($filters['date_echeance_debut'])) {
            $sql .= " AND f.date_echeance >= ?";
            $params[] = $filters['date_echeance_debut'];
        }
        
        if (!empty($filters['date_echeance_fin'])) {
            $sql .= " AND f.date_echeance <= ?";
            $params[] = $filters['date_echeance_fin'];
        }
        
        $sql .= " ORDER BY f.date_emission DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET intitule = ?, date_echeance = ?, total = ?, devise = ?, statut = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['intitule'] ?? null,
            $data['date_echeance'] ?? null,
            $data['total'],
            $data['devise'] ?? 'EUR',
            $data['statut'] ?? 'envoyee',
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getWithDetails($id) {
        $facture = $this->read($id);
        
        if ($facture) {
            $ligneModel = new LigneFacture($this->db);
            $paiementModel = new Paiement($this->db);
            
            $facture['lignes'] = $ligneModel->readByFacture($id);
            $facture['paiements'] = $paiementModel->readByFacture($id);
            
            // Calcul des totaux
            $facture['montant_paye'] = 0;
            foreach ($facture['paiements'] as $paiement) {
                $facture['montant_paye'] += $paiement['montant'];
            }
            $facture['reste_a_payer'] = $facture['total'] - $facture['montant_paye'];
        }
        
        return $facture;
    }

    public function updateStatus($id, $statut) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET statut = ? 
            WHERE id = ?
        ");
        return $stmt->execute([$statut, $id]);
    }

    public function getFacturesParent($parentId) {
        $stmt = $this->db->prepare("
            SELECT f.*, p.prenom, p.nom, e.numero_matricule
            FROM {$this->table} f
            JOIN eleves e ON f.eleve_id = e.id
            JOIN personnes p ON e.id = p.id
            JOIN liens_responsable_eleve lre ON e.id = lre.eleve_id
            WHERE lre.responsable_id = ?
            ORDER BY f.date_emission DESC
        ");
        $stmt->execute([$parentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStats($dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT 
                COUNT(*) as nombre_factures,
                SUM(total) as total_facture,
                statut,
                COUNT(DISTINCT eleve_id) as nombre_eleves
            FROM {$this->table}
            WHERE 1=1
        ";
        
        $params = [];
        
        if ($dateDebut) {
            $sql .= " AND date_emission >= ?";
            $params[] = $dateDebut;
        }
        
        if ($dateFin) {
            $sql .= " AND date_emission <= ?";
            $params[] = $dateFin;
        }
        
        $sql .= " GROUP BY statut";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>