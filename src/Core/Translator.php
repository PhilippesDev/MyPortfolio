<?php

namespace App\Core;

class Translator
{
    private static string $lang = 'en'; // default language
    private static array $translations = [];

    public static function setLanguage(string $lang): void
    {
        // On accepte 'en' ou 'fr'
        if (in_array($lang, ['en', 'fr'])) {
            self::$lang = $lang;
        }

        self::loadTranslations();
    }

    private static function loadTranslations(): void
    {
        $file = ROOT . '/lang/' . self::$lang . '.php';
        if (file_exists($file)) {
            self::$translations = require $file;
        }
    }

    public static function get(string $key): string
    {
        // Support pour clés imbriquées ex: 'home.title'
        $keys = explode('.', $key);
        $value = self::$translations;

        foreach ($keys as $k) {
            if (isset($value[$k])) {
                $value = $value[$k];
            } else {
                return $key; // Retourne la clé si introuvable
            }
        }

        return is_string($value) ? $value : $key;
    }

    public static function getLang(): string
    {
        return self::$lang;
    }
}
