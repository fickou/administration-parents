<?php

// Inclure les dépendances
require_once ROOT_PATH . '/config/Database.php';
require_once ROOT_PATH . '/models/Commun/Personne.php';
require_once ROOT_PATH . '/models/Commun/Token.php';
require_once ROOT_PATH . '/models/Administration/Utilisateur.php';
require_once ROOT_PATH . '/models/Scolarite/Eleve.php';
require_once ROOT_PATH . '/models/Scolarite/Ecole.php';
require_once ROOT_PATH . '/models/Scolarite/TuteurEleve.php';


// Handlers des routes
function authRegister() {
   
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        http_response_code(400);
        echo json_encode(["message" => "Données JSON invalides"]);
        return;
    }
    if (empty($data['parent']) || empty($data['eleve'])) {
        http_response_code(400);
        echo json_encode(["message" => "Les données du parent et de l'élève sont requises"]);
        return;
    }

    $parentData = $data['parent'];
    $password = $data['mot_de_passe'] ?? null; // Récupérer le mot de passe
    $eleveData = $data['eleve'];
    $professeurData = $data['professeur'] ?? null;
    $administratifData = $data['administratif'] ?? null;
    $requiredFields = ['prenom', 'nom', 'telephone', 'type_personne'];

    foreach ($requiredFields as $field) {
        if (empty($parentData[$field]) || empty($eleveData[$field])) {
            http_response_code(400);
            echo json_encode(["message" => "Le champ $field est requis pour le parent et l'élève"]);
            return;
        }
    }

    if (!empty($parentData['email'])) {
            if (!filter_var($parentData['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(["message" => "Format d'email invalide pour le parent "]);
            return;
        }
    }

    $database = new Database();
    $db = $database->getConnexion();
    $personneModel = new Personne($db);
    $utilisateurModel = new Utilisateur($db);
    $eleveModel = new Eleve($db);
    $tuteurEleveModel = new TuteurEleve($db);


    try {
        if ($personneModel->getIdParent($parentData['email'], 'parent')) {
           $parentId = $personneModel->getIdParent($parentData['email'], 'parent');
        }
        else {
            // Créer la personne parent
             $parentId = $personneModel->create($parentData);

             if (!$parentId) {
                throw new Exception("Erreur lors de la création de la personne parent");
            }
        
            if (empty($password)) {
                //empêcher la création si le mot de passe n'est pas fourni
                throw new Exception("Le mot de passe du parent est requis");
            }
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $utilisateurData = [
                'personne_id' => $parentId,
                'mot_de_passe' => $hashedPassword,
                'role' => 'parent',
                'est_actif' => 1
            ];
            $userId = $utilisateurModel->create($utilisateurData);
            if (!$userId) {
                throw new Exception("Erreur lors de la création de l'utilisateur parent");
            }
        }
        
        // Créer la personne élève
        $personneEleveData = [
            'prenom' => $eleveData['prenom'],
            'nom' => $eleveData['nom'],
            'telephone' => $eleveData['telephone'] ?? null,
            'sexe' => $eleveData['sexe'] ?? null,
            'date_naissance' => $eleveData['date_naissance'] ?? null,
            'type_personne' => 'eleve',
            'actif' => 1
        ];
        $eleveId = $personneModel->create($personneEleveData);
        if (!$eleveId) {
            throw new Exception("Erreur lors de la création de la personne élève");
        }
        // Créer l'élève
        $eleveExtraData = [
            'personne_id' => $eleveId,
            'code_eleve' => $eleveData['code_eleve'] ?? null,
            'numero_matricule' => $eleveData['numero_matricule'] ?? null,
            'date_inscription' => $eleveData['date_inscription'] ?? date('Y-m-d'),
            'nationalite' => $eleveData['nationalite'] ?? null
        ];

        if ($eleveModel->verifyCode($eleveExtraData['code_eleve'])) {
            throw new Exception("Le code élève fourni est déjà utilisé");
        }

        $eleve_Id = $eleveModel->create($eleveExtraData);
        if (!$eleve_Id) {
            throw new Exception("Erreur lors de la création de l'élève");
        }
        // Lier le parent et l'élève
        $lienData = [
            'eleve_id' => $eleve_Id,
            'responsable_id' => $parentId,
            'lien_parental' => 'parent',
            'est_principal' => 1
        ];
        $tuteurEleveModel->create($lienData);

        http_response_code(201);
        echo json_encode([
            "message" => "Inscription réussie",
            "parent" => [
                "id" => $parentId,
                "email" => $parentData['email'],
                "password" => $password 
            ],
            "eleve" => [
                "id" => $eleve_Id,
                "prenom" => $eleveData['prenom'],
                "nom" => $eleveData['nom'],
                "date_inscription" => $eleveExtraData['date_inscription'],
                "numero_matricule" => $eleveExtraData['numero_matricule'] ?? null,
                "code_eleve" => $eleveExtraData['code_eleve'] ?? null,
                "nationalite" => $eleveExtraData['nationalite'] ?? null
            ]
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            "message" => "Erreur serveur (BDD): " . $e->getMessage()
        ]);
        return;
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            "message" => "Erreur serveur: " . $e->getMessage()
        ]);
        return;
    }
}

function authLogin() {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!$data) {
        http_response_code(400);
        echo json_encode(["message" => "Données JSON invalides"]);
        return;
    }

    if (empty($data['email']) || empty($data['motDePasse'])) {
        http_response_code(400);
        echo json_encode(["message" => "Email et mot de passe requis"]);
        return;
    }

    $database = new Database();
    $db = $database->getConnexion();
    
    $personneModel = new Personne($db);
    $utilisateurModel = new Utilisateur($db);

    // Récupérer la personne
    $personne = $personneModel->getByEmail($data['email']);
    if (!$personne) {
        http_response_code(401);
        echo json_encode(["message" => "Identifiants invalides"]);
        return;
    }

    // Récupérer l'utilisateur
    $utilisateur = $utilisateurModel->getByPersonneId($personne['id']);
    if (!$utilisateur || !$utilisateur['est_actif']) {
        http_response_code(401);
        echo json_encode(["message" => "Compte désactivé ou inexistant"]);
        return;
    }

    // Vérifier le mot de passe
    if (!password_verify($data['motDePasse'], $utilisateur['mot_de_passe'])) {
        http_response_code(401);
        echo json_encode(["message" => "Identifiants invalides"]);
        return;
    }

    // Créer un token de session (simplifié)
    $sessionToken = bin2hex(random_bytes(32));

    $tokenModel = new Token($db);
    $tokenModel->create($personne['id'], $sessionToken, '+2 hours');

    http_response_code(200);
    echo json_encode([
        "message" => "Connexion réussie",
        "token" => $sessionToken,
        "user" => [
            "id" => $personne['id'],
            "prenom" => $personne['prenom'],
            "nom" => $personne['nom'],
            "email" => $personne['email'],
            "role" => $utilisateur['role']
        ]
    ]);
}

function authLogout() {
    http_response_code(200);
    echo json_encode(["message" => "Déconnexion réussie"]);
}

function authForgotPassword() {
    http_response_code(200);
    echo json_encode(["message" => "Si l'email existe, un lien de réinitialisation a été envoyé"]);
}

function authResetPassword() {
    http_response_code(200);
    echo json_encode(["message" => "Mot de passe réinitialisé avec succès"]);
}

function authVerifyEmail() {
    http_response_code(200);
    echo json_encode(["message" => "Email vérifié avec succès"]);
}

function authSession() {
    $headers = getallheaders();
    if (!isset($headers['Authorization'])) {
        http_response_code(401);
        echo json_encode(["message" => "Token manquant"]);
        return;
    }

    $authHeader = $headers['Authorization'];
    if (strpos($authHeader, 'Bearer ') !== 0) {
        http_response_code(401);
        echo json_encode(["message" => "Format d'autorisation invalide"]);
        return;
    }

    $token = substr($authHeader, 7);

    $database = new Database();
    $db = $database->getConnexion();
    $tokenModel = new Token($db);

    // Utiliser getValidToken() au lieu de invalidateToken()
    $tokenData = $tokenModel->getValidToken($token, 'access');
    
    if (!$tokenData) {
        http_response_code(401);
        echo json_encode(["message" => "Token invalide ou expiré"]);
        return;
    }

    // Récupérer les informations utilisateur
    $personneModel = new Personne($db);
    $utilisateurModel = new Utilisateur($db);

    $personne = $personneModel->getById($tokenData['personne_id']);
    $utilisateur = $utilisateurModel->getByPersonneId($tokenData['personne_id']);

    if (!$personne || !$utilisateur) {
        http_response_code(401);
        echo json_encode(["message" => "Utilisateur non trouvé"]);
        return;
    }

    http_response_code(200);
    echo json_encode([
        "message" => "Session active",
        "user" => [
            "id" => $personne['id'],
            "prenom" => $personne['prenom'],
            "nom" => $personne['nom'],
            "email" => $personne['email'],
            "role" => $utilisateur['role']
        ],
        "session" => [
            "expiration" => $tokenData['expiration'],
            "created_at" => $tokenData['date_creation']
        ]
    ]);
}

function authRegisterEcole() {
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        http_response_code(400);
        echo json_encode(["message" => "Données JSON invalides"]);
        return;
    }

    $required = ['nom', 'code', 'email', 'telephone', 'ville', 'pays'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            http_response_code(400);
            echo json_encode(["message" => "Le champ $field est requis"]);
            return;
        }
    }

    // Validation de l'email
    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["message" => "Format d'email invalide"]);
        return;
    }

    // Connexion à la base de données
    $database = new Database();
    $db = $database->getConnexion();

    $ecoleModel = new Ecole($db);

    // Vérifier si l'email de l'école existe déjà
    if ($ecoleModel->getByEmail($data['email'])) {
        http_response_code(409);
        echo json_encode(["message" => "Cet email d'école est déjà utilisé"]);
        return;
    }

    try {
        // Créer l'école
        $ecoleData = [
            'nom' => $data['nom'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'code' => $data['code'],
            'ville' => $data['ville'] ?? null,
            'pays' => $data['pays'] ?? null
        ];

        $ecoleId = $ecoleModel->create($ecoleData);

        if (!$ecoleId) {
            throw new Exception("Erreur lors de la création de l'école");
        }
        /*
        // Créer la personne administratrice de l'école
        $personneModel = new Personne($db);
        $personneData = [
            'prenom' => $data['adminPrenom'] ?? '',
            'nom' => $data['adminNom'] ?? 'Admin',
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'type_personne' => 'admin_ecole',
            'actif' => 1
        ];

        $personneId = $personneModel->create($personneData);

        if (!$personneId) {
            throw new Exception("Erreur lors de la création de la personne administratrice");
        }
        // Créer l'utilisateur administrateur
        $utilisateurModel = new Utilisateur($db);
        $hashedPassword = password_hash($data['motDePasse'], PASSWORD_DEFAULT);

        $utilisateurData = [
            'personne_id' => $personneId,
            'mot_de_passe' => $hashedPassword,
            'role' => 'admin_ecole',
            'ecole_id' => $ecoleId
        ];
        $userId = $utilisateurModel->create($utilisateurData);
        if (!$userId) {
            throw new Exception("Erreur lors de la création de l'utilisateur administrateur");
        }
        http_response_code(201);
        echo json_encode([
            "message" => "École et compte administrateur créés avec succès",
            "ecoleId" => $ecoleId,
            "userId" => $userId,
            "personneId" => $personneId
        ]);
        */

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Erreur serveur: " . $e->getMessage()]);
        return;
    }
}

?>
