<?php
class Notification {
    private $db;
    private $table = 'notifications';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (personne_id, titre, contenu, type_notification) 
            VALUES (?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['personne_id'],
            $data['titre'],
            $data['contenu'] ?? null,
            $data['type_notification'] ?? null
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readAll($filters = []) {
        $sql = "SELECT * FROM {$this->table} WHERE 1=1";
        $params = [];
        
        if (!empty($filters['personne_id'])) {
            $sql .= " AND personne_id = ?";
            $params[] = $filters['personne_id'];
        }
        
        if (isset($filters['lu'])) {
            $sql .= " AND lu = ?";
            $params[] = $filters['lu'];
        }
        
        if (!empty($filters['type_notification'])) {
            $sql .= " AND type_notification = ?";
            $params[] = $filters['type_notification'];
        }
        
        $sql .= " ORDER BY cree_le DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET titre = ?, contenu = ?, type_notification = ?, lu = ? 
            WHERE id = ?
        ");
        
        return $stmt->execute([
            $data['titre'],
            $data['contenu'] ?? null,
            $data['type_notification'] ?? null,
            $data['lu'] ?? 0,
            $id
        ]);
    }

    // DELETE
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Méthodes spécifiques
    public function markAsRead($id, $personneId = null) {
        $sql = "UPDATE {$this->table} SET lu = 1 WHERE id = ?";
        $params = [$id];
        
        if ($personneId) {
            $sql .= " AND personne_id = ?";
            $params[] = $personneId;
        }
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }

    public function markAllAsRead($personneId) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET lu = 1 
            WHERE personne_id = ? AND lu = 0
        ");
        return $stmt->execute([$personneId]);
    }

    public function getUnreadCount($personneId) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM {$this->table} 
            WHERE personne_id = ? AND lu = 0
        ");
        $stmt->execute([$personneId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] ?? 0;
    }

    public function createForMultiple($personnesIds, $titre, $contenu, $type = null) {
        $this->db->beginTransaction();
        
        try {
            $stmt = $this->db->prepare("
                INSERT INTO {$this->table} 
                (personne_id, titre, contenu, type_notification) 
                VALUES (?, ?, ?, ?)
            ");
            
            foreach ($personnesIds as $personneId) {
                $stmt->execute([$personneId, $titre, $contenu, $type]);
            }
            
            $this->db->commit();
            return true;
            
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
?>