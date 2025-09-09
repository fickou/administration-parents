<?php

    // Inclure les dépendances avec chemins relatifs corrigés
    require_once ROOT_PATH . '/config/Database.php';
    require_once ROOT_PATH . '/models/Scolarite/Eleve.php';
    

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
?>