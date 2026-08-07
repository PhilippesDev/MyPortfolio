<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Translator;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $params = $request->getRouteParams();
        $lang = $params['lang'] ?? 'en';
        
        Translator::setLanguage($lang);

        return $this->render('contact', [
            'currentLang' => $lang
        ]);
    }
}
