<?php
class Paiement {
    private $db;
    private $table = 'paiements';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (facture_id, montant, moyen_paiement, reference, statut) 
            VALUES (?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['facture_id'],
            $data['montant'],
            $data['moyen_paiement'] ?? null,
            $data['reference'] ?? null,
            $data['statut'] ?? 'recu'
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT p.*, f.numero as facture_numero, f.eleve_id,
                   per.prenom, per.nom as eleve_nom
            FROM {$this->table} p
            JOIN factures f ON p.facture_id = f.id
            JOIN eleves e ON f.eleve_id = e.id
            JOIN personnes per ON e.id = per.id
            WHERE p.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readByFacture($factureId) {
        $stmt = $this->db->prepare("
            SELECT * FROM {$this->table} 
            WHERE facture_id = ? 
            ORDER BY date_paiement
        ");
        $stmt->execute([$factureId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "
            SELECT p.*, f.numero as facture_numero, 
                   per.prenom, per.nom as eleve_nom
            FROM {$this->table} p
            JOIN factures f ON p.facture_id = f.id
            JOIN eleves e ON f.eleve_id = e.id
            JOIN personnes per ON e.id = per.id
            WHERE 1=1
        ";
        
        $params = [];
        
        if (!empty($filters['facture_id'])) {
            $sql .= " AND p.facture_id = ?";
            $params[] = $filters['facture_id'];
        }
        
        if (!empty($filters['eleve_id'])) {
            $sql .= " AND f.eleve_id = ?";
            $params[] = $filters['eleve_id'];
        }
        
        if (!empty($filters['statut'])) {
            $sql .= " AND p.statut = ?";
            $params[] = $filters['statut'];
        }
        
        if (!empty($filters['date_debut'])) {
            $sql .= " AND p.date_paiement >= ?";
            $params[] = $filters['date_debut'];
        }
        
        if (!empty($filters['date_fin'])) {
            $sql .= " AND p.date_paiement <= ?";
            $params[] = $filters['date_fin'];
        }
        
        $sql .= " ORDER BY p.date_paiement DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET montant = ?, moyen_paiement = ?, reference = ?, statut = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['montant'],
            $data['moyen_paiement'] ?? null,
            $data['reference'] ?? null,
            $data['statut'] ?? 'recu',
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function getTotalPaye($factureId) {
        $stmt = $this->db->prepare("
            SELECT SUM(montant) as total_paye
            FROM {$this->table} 
            WHERE facture_id = ? AND statut = 'recu'
        ");
        $stmt->execute([$factureId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total_paye'] ?? 0;
    }

    public function getStats($dateDebut = null, $dateFin = null) {
        $sql = "
            SELECT 
                COUNT(*) as nombre_paiements,
                SUM(montant) as total_percu,
                moyen_paiement,
                statut
            FROM {$this->table}
            WHERE 1=1
        ";
        
        $params = [];
        
        if ($dateDebut) {
            $sql .= " AND date_paiement >= ?";
            $params[] = $dateDebut;
        }
        
        if ($dateFin) {
            $sql .= " AND date_paiement <= ?";
            $params[] = $dateFin;
        }
        
        $sql .= " GROUP BY moyen_paiement, statut";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMoyensPaiement() {
        $stmt = $this->db->prepare("
            SELECT DISTINCT moyen_paiement 
            FROM {$this->table} 
            WHERE moyen_paiement IS NOT NULL
            ORDER BY moyen_paiement
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
?>