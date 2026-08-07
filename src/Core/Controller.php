<?php

namespace App\Core;

abstract class Controller
{
    protected function render(string $view, array $params = [])
    {
        // Rend les variables accessibles dans la vue
        extract($params);

        // Démarre la temporisation de sortie pour capturer la vue
        ob_start();
        require ROOT . "/views/$view.php";
        $content = ob_get_clean();

        // Charge le layout global qui inclut le contenu de la vue
        require ROOT . '/views/layouts/main.php';
    }
}
