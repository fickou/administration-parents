<?php
namespace App\Models\Commun;

class Consentement
{
    private $db;
    private $table = 'consentements_rgpd';

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function create($data)
    {
        try {
            // Champs obligatoires
            $required = ['personne_id', 'type_consentement'];
            foreach ($required as $field) {
                if (empty($data[$field])) {
                    throw new Exception("Le champ $field est requis");
                }
            }

            // Valeurs par défaut
            $defaultData = [
                'id' => $this->generateUuid(),
                'donne' => $data['donne'] ?? 1,
                'version' => '1.0'
            ];

            // Fusionner les données
            $consentementData = array_merge($defaultData, $data);

            $fields = implode(', ', array_keys($consentementData));
            $placeholders = implode(', ', array_fill(0, count($consentementData), '?'));
            
            $sql = "INSERT INTO {$this->table} ($fields) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);
            
            return $stmt->execute(array_values($consentementData));
            
        } catch (Exception $e) {
            error_log("Erreur création consentement: " . $e->getMessage());
            return false;
        }
    }

    public function getByPersonne($personneId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE personne_id = ? ORDER BY date_consentement DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$personneId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateConsentement($personneId, $typeConsentement, $donne)
    {
        $sql = "UPDATE {$this->table} SET donne = ?, date_consentement = NOW() 
                WHERE personne_id = ? AND type_consentement = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$donne, $personneId, $typeConsentement]);
    }

    private function generateUuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }
}
?>