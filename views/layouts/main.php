<?php
use App\Core\Translator as T;
// Helper function pour simplifier les appels
if (!function_exists('__')) {
    function __(string $key) {
        return T::get($key);
    }
}
$base_url = APP_URL;
?>
<!DOCTYPE html>
<html lang="<?= T::getLang() ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Folioblox - Creative Director</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= $base_url ?>/assets/css/style.css">
</head>
<body class="text-white">

    <div class="tech-gradient px-8 py-6 md:px-16 md:py-10">
        
        <nav class="flex justify-between items-center">
            <div class="text-2xl font-bold tracking-tight">
                <div class="flex">
                    <div class="flex bg-surface hover:bg-surface-hover rounded-lg transition p-1">
                        <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                        <a href="<?= $base_url ?>/en" class="<?= T::getLang() === 'en' ? 'bg-blue-900 text-muted-foreground-1' : 'bg-transparent text-muted-foreground-1' ?> py-3 px-4 inline-flex items-center gap-x-2 text-sm focus:outline-hidden font-medium rounded-lg hover:text-primary-hover">
                            English <img src="<?= $base_url ?>/img/united-kingdom.png" class="w-5 h-5" alt="EN">
                        </a>
                        <a href="<?= $base_url ?>/fr" class="<?= T::getLang() === 'fr' ? 'bg-blue-900 text-muted-foreground-1' : 'bg-transparent text-muted-foreground-1' ?> py-3 px-4 inline-flex items-center gap-x-2 text-sm focus:outline-hidden font-medium rounded-lg hover:text-primary-hover">
                            French <img src="<?= $base_url ?>/img/france.png" class="w-5 h-5" alt="FR">
                        </a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-10">
                <ul class="hidden md:flex space-x-8 text-sm font-medium opacity-80">
                    <li><a href="<?= $base_url ?>/<?= T::getLang() ?>#" class="hover:opacity-100 transition"><?= __('nav.home') ?></a></li>
                    <li><a href="<?= $base_url ?>/<?= T::getLang() ?>#about" class="hover:opacity-100 transition"><?= __('nav.about') ?></a></li>
                    <li><a href="<?= $base_url ?>/<?= T::getLang() ?>#mystack" class="hover:opacity-100 transition"><?= __('nav.mystack') ?></a></li>
                    <li><a href="<?= $base_url ?>/<?= T::getLang() ?>#projects" class="hover:opacity-100 transition"><?= __('nav.projects') ?></a></li>
                </ul>
                <a href="<?= $base_url ?>/<?= T::getLang() ?>/contact" class="bg-white text-black px-6 py-3 rounded-full text-sm font-bold flex items-center group">
                    <?= __('nav.contact') ?>
                    <span class="ml-3 bg-orange-600 text-white rounded-full w-6 h-6 flex items-center justify-center group-hover:scale-110 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-3 h-3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                    </span>
                </a>
            </div>
        </nav>

        <!-- Le contenu spécifique de la vue (home, contact...) sera inséré ici -->
        <?= $content ?>

    <footer class="bg-[#020617] pt-20 pb-10 px-8 md:px-16 border-t border-white/5">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
                
                <div class="md:col-span-5">
                    <div class="text-2xl font-bold tracking-tight mb-6">Philippe Mirindi<span class="text-blue-500">.</span></div>
                    <p class="text-sm text-white/50 leading-relaxed max-w-sm">
                        <?= __('footer.description') ?>
                    </p>
                    <div class="flex space-x-5 mt-8">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-white/10 hover:-translate-y-1 transition-all border border-white/10">
                            <img src="https://cdn.simpleicons.org/github/white" class="w-5 h-5" alt="GitHub">
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#0077b5]/20 hover:border-[#0077b5]/50 hover:-translate-y-1 transition-all border border-white/10">
                            <img src="https://cdn.simpleicons.org/linkedin/white" class="w-4 h-4" alt="LinkedIn">
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-white/10 hover:-translate-y-1 transition-all border border-white/10">
                            <img src="https://cdn.simpleicons.org/x/white" class="w-4 h-4" alt="X">
                        </a>
                    </div>
                </div>

                <div class="md:col-span-3">
                    <h4 class="text-xs uppercase tracking-[0.2em] font-bold text-white mb-6"><?= __('footer.nav_title') ?></h4>
                    <ul class="space-y-4 text-sm text-white/50">
                        <li><a href="#" class="hover:text-blue-400 transition"><?= __('nav.home') ?></a></li>
                        <li><a href="#about" class="hover:text-blue-400 transition"><?= __('nav.about') ?></a></li>
                        <li><a href="#mystack" class="hover:text-blue-400 transition"><?= __('nav.mystack') ?></a></li>
                        <li><a href="#projects" class="hover:text-blue-400 transition"><?= __('nav.projects') ?></a></li>
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h4 class="text-xs uppercase tracking-[0.2em] font-bold text-white mb-6"><?= __('footer.contact_title') ?></h4>
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                        <p class="text-sm text-white/70 mb-4"><?= __('footer.contact_text') ?></p>
                        <a href="<?= $base_url ?>/<?= T::getLang() ?>/contact" class="text-blue-400 font-bold hover:underline"><?= __('footer.click_here') ?></a>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-[11px] text-white/30 uppercase tracking-widest">
                    &copy; 2026 Philippe Mirindi. <?= __('footer.rights') ?>
                </p>
                <div class="flex items-center space-x-2 text-[11px] text-white/30 uppercase tracking-widest">
                    <span><?= __('footer.made_with') ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-[#ff2d55]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    <span>in Congo</span>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Scripts -->
    <script src="<?= $base_url ?>/assets/js/main.js" defer></script>
</body>
</html>
