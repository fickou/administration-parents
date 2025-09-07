<?php
class Message {
    private $db;
    private $table = 'messages';

    public function __construct($db) {
        $this->db = $db;
    }

    // CREATE
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO {$this->table} 
            (conversation_id, auteur_id, contenu) 
            VALUES (?, ?, ?)
        ");
        
        return $stmt->execute([
            $data['conversation_id'],
            $data['auteur_id'],
            $data['contenu']
        ]);
    }

    // READ
    public function read($id) {
        $stmt = $this->db->prepare("
            SELECT m.*, p.prenom, p.nom as auteur_nom
            FROM {$this->table} m
            JOIN personnes p ON m.auteur_id = p.id
            WHERE m.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function readByConversation($conversationId, $limit = 50, $offset = 0) {
        $stmt = $this->db->prepare("
            SELECT m.*, p.prenom, p.nom as auteur_nom
            FROM {$this->table} m
            JOIN personnes p ON m.auteur_id = p.id
            WHERE m.conversation_id = ?
            ORDER BY m.cree_le ASC
            LIMIT ? OFFSET ?
        ");
        $stmt->execute([$conversationId, $limit, $offset]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET contenu = ? 
            WHERE id = ? AND auteur_id = ?
        ");
        
        return $stmt->execute([
            $data['contenu'],
            $id,
            $data['auteur_id']
        ]);
    }

    // DELETE
    public function delete($id, $auteurId) {
        $stmt = $this->db->prepare("
            DELETE FROM {$this->table} 
            WHERE id = ? AND auteur_id = ?
        ");
        return $stmt->execute([$id, $auteurId]);
    }

    // Méthodes spécifiques
    public function markAsRead($conversationId, $utilisateurId) {
        $stmt = $this->db->prepare("
            UPDATE {$this->table} 
            SET lu = TRUE 
            WHERE conversation_id = ? 
            AND auteur_id != ? 
            AND lu = FALSE
        ");
        return $stmt->execute([$conversationId, $utilisateurId]);
    }

    public function getUnreadCount($utilisateurId) {
        $stmt = $this->db->prepare("
            SELECT COUNT(m.id) as messages_non_lus
            FROM {$this->table} m
            JOIN participants_conversation pc ON m.conversation_id = pc.conversation_id
            WHERE pc.personne_id = ? 
            AND m.auteur_id != ? 
            AND m.lu = FALSE
        ");
        $stmt->execute([$utilisateurId, $utilisateurId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['messages_non_lus'] ?? 0;
    }

    public function getLastMessage($conversationId) {
        $stmt = $this->db->prepare("
            SELECT m.*, p.prenom, p.nom as auteur_nom
            FROM {$this->table} m
            JOIN personnes p ON m.auteur_id = p.id
            WHERE m.conversation_id = ?
            ORDER BY m.cree_le DESC
            LIMIT 1
        ");
        $stmt->execute([$conversationId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>