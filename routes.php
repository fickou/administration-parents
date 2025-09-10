<?php
    // Activation des erreurs
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //Headers CORS
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=UTF-8");
    //Gérer les requêtes OPTIONS
    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    //Chemins d'accès
    define('ROOT_PATH', dirname(__FILE__));

    //Inclure les dépendances
    require('controllers/PublicController.php');
    require('controllers/AuthController.php');


    //Router
    $request_uri = $_SERVER['REQUEST_URI'];
    $base_path = '/administration-parents';
    $api_path = str_replace($base_path, '', $request_uri);

    //Routes API
    $routes = [
            'POST' => [
            '/api/auth/register' => 'authRegister',
            '/api/auth/login' => 'authLogin',
            '/api/auth/logout' => 'authLogout',
            '/api/auth/forgot-password' => 'authForgotPassword',
            '/api/auth/reset-password' => 'authResetPassword',
            '/api/auth/verify-email' => 'authVerifyEmail',
            '/api/auth/registerEcole' => 'authRegisterEcole'
        ],
        'GET' => [
            '/api/auth/session' => 'authSession',
            '/api/public/eleves' => 'getNbreEleves',
            '/api/public/ecoles' => 'getNbreEcoles',
            '/api/public/familles' => 'getNbreFamillesConnectees'
        ]
    ];

    //Trouver la route
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
        echo json_encode(["message" => "Route non trouvée"]);
    }
?>