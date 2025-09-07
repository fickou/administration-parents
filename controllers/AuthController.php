<?php
// Activation des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Headers CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

// Gérer les requêtes OPTIONS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Chemins d'accès
define('ROOT_PATH', dirname(__FILE__));

// Inclure les dépendances
require_once ROOT_PATH . '../../config/Database.php';
require_once ROOT_PATH . '../../models/Commun/Personne.php';
require_once ROOT_PATH . '../../models/Commun/Token.php';
require_once ROOT_PATH . '../../models/Administration/Utilisateur.php';

// Router
$request_uri = $_SERVER['REQUEST_URI'];
$base_path = '/administration-parents';
$api_path = str_replace($base_path, '', $request_uri);

// Routes API
$routes = [
    'POST' => [
        '/api/auth/register' => 'authRegister',
        '/api/auth/login' => 'authLogin',
        '/api/auth/logout' => 'authLogout',
        '/api/auth/forgot-password' => 'authForgotPassword',
        '/api/auth/reset-password' => 'authResetPassword',
        '/api/auth/verify-email' => 'authVerifyEmail'
    ],
    'GET' => [
        '/api/auth/session' => 'authSession'
    ]
];

// Trouver la route
$method = $_SERVER['REQUEST_METHOD'];
$handler = null;

if (isset($routes[$method])) {
    foreach ($routes[$method] as $route => $handlerName) {
        if ($api_path === $route) {
            $handler = $handlerName;
            break;
        }
    }
}

if ($handler && function_exists($handler)) {
    call_user_func($handler);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Endpoint non trouvé: $api_path"]);
}

// Handlers des routes
function authRegister() {
    $data = json_decode(file_get_contents("php://input"), true);
    
    if (!$data) {
        http_response_code(400);
        echo json_encode(["message" => "Données JSON invalides"]);
        return;
    }

    $required = ['nom', 'email', 'telephone', 'motDePasse'];
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
    
    $personneModel = new Personne($db);
    
    // Vérifier si l'email existe déjà
    if ($personneModel->getByEmail($data['email'])) {
        http_response_code(409);
        echo json_encode(["message" => "Cet email est déjà utilisé"]);
        return;
    }

    try {
        // Créer la personne
        $personneData = [
            'prenom' => $data['prenom'] ?? '',
            'nom' => $data['nom'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'date_naissance' => $data['date_naissance'] ?? null,
            'sexe' => $data['sexe'] ?? null,
            'type_personne' => 'parent',
            'actif' => 1
        ];

        $personneId = $personneModel->create($personneData);

        if (!$personneId) {
            throw new Exception("Erreur lors de la création de la personne");
        }

        // Créer l'utilisateur
        $utilisateurModel = new Utilisateur($db);
        $hashedPassword = password_hash($data['motDePasse'], PASSWORD_DEFAULT);
        
        $utilisateurData = [
            'personne_id' => $personneId,
            'mot_de_passe' => $hashedPassword,
            'role' => 'parent'
        ];

        $userId = $utilisateurModel->create($utilisateurData);

        http_response_code(201);
        echo json_encode([
            "message" => "Compte créé avec succès",
            "userId" => $userId,
            "personneId" => $personneId
        ]);

    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "Erreur serveur: " . $e->getMessage()]);
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


?>