<?php

// Front Controller - Point d'entrée unique de l'application

// 1. Définition des chemins de base
define('ROOT', __DIR__);
define('APP_URL', '/portfolio/onGithub/MyPortfolio');

// 2. Autoloader PSR-4 très simple
spl_autoload_register(function ($class) {
    // Remplacer les antislashs par des slashs
    $classFile = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    // Le namespace App correspond au dossier src/
    if (strpos($classFile, 'App' . DIRECTORY_SEPARATOR) === 0) {
        $classFile = substr($classFile, 4); // Enlever 'App/'
        $file = ROOT . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $classFile . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});

// Démarrage de la session (utile si on veut stocker la langue choisie ou d'autres données)
session_start();

// 3. Initialisation du Routeur
use App\Core\Router;
use App\Core\Request;

$request = new Request();
$router = new Router($request);

// 4. Chargement des routes
require ROOT . '/routes/web.php';

// 5. Résolution de la requête
$router->resolve();
