<?php

    // Inclure les dépendances avec chemins relatifs corrigés
    require_once ROOT_PATH . '/config/Database.php';
    require_once ROOT_PATH . '/models/Scolarite/Eleve.php';
    require_once ROOT_PATH . '/models/Scolarite/Ecole.php';
    

    function getNbreEleves() {
            $database = new Database();
            $db = $database->getConnexion();
            
            $eleveModel = new Eleve($db);
            $eleves = $eleveModel->countAll(['actif' => 1]);
            
            http_response_code(200);
            echo json_encode([
                "message" => "Nombre d'élèves récupéré avec succès",
                "nombre_eleves" => $eleves
            ]);
        }

    function getNbreEcoles() {
            $database = new Database();
            $db = $database->getConnexion();
            
            $ecoleModel = new Ecole($db);
            $ecoles = $ecoleModel->countEcoles(['actif' => 1]);
            
            http_response_code(200);
            echo json_encode([
                "message" => "Nombre d'écoles récupéré avec succès",
                "nombre_ecoles" => $ecoles
            ]);
        }
    
    // Nombre de familles connectées en utilisant la table 'personnes' et un champ 'type_personne' = 'parent'
    function getNbreFamillesConnectees() {
            $database = new Database();
            $db = $database->getConnexion();
            
            $stmt = $db->query("SELECT COUNT(DISTINCT id) as total FROM personnes WHERE type_personne = 'parent' AND actif = 1");
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $familles = $result['total'] ?? 0;
            
            http_response_code(200);
            echo json_encode([
                "message" => "Nombre de familles connectées récupéré avec succès",
                "nombre_familles" => $familles
            ]);
        }
    
    // Pourcentage de disponibilité du service (exemple statique ici)
    function getServiceAvailability() {
            $availability = 99.9; // Valeur statique pour l'exemple
            
            http_response_code(200);
            echo json_encode([
                "message" => "Disponibilité du service récupérée avec succès",
                "disponibilite_service" => $availability
            ]);
        }
?>