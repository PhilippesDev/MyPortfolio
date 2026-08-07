<?php

use App\Controllers\HomeController;
use App\Controllers\ContactController;

/** @var \App\Core\Router $router */

// Route par défaut (langue anglaise ou fallback)
$router->get('/', [HomeController::class, 'index']);

// Route pour la page d'accueil avec langue spécifique
$router->get('/{lang}', [HomeController::class, 'index']);

// Routes pour le contact
$router->get('/contact', [ContactController::class, 'index']);
$router->get('/{lang}/contact', [ContactController::class, 'index']);
