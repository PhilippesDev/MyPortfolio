<?php
$base_url = APP_URL;
?>
<main class="flex-grow flex items-center content-layer mt-[50px]">
    <div class="grid grid-cols-12 w-full items-center">
        <div class="col-span-12 md:col-span-8">
            <p class="text-xl font-medium mb-4"><?= __('hero.greeting') ?></p>
            <h1 class="flex flex-col text-5xl md:text-7xl font-extrabold leading-[0.9] tracking-tighter">
                <span><?= __('hero.name') ?><span class="text-blue-500">.</span></span> 
                <span class="text-blue-400 text-4xl md:text-5xl mt-2"><?= __('hero.role') ?> </span>
            </h1>
            <p class="text-sm md:text-base opacity-80 mt-6 max-w-sm leading-relaxed">
                <?= __('hero.description') ?>
            </p>
        </div>

        <div class="col-span-12 md:col-span-4 flex justify-center mt-12 md:mt-0 relative">
            <div class="relative inline-block">
                
                <img src="<?= $base_url ?>/img/folioimg.png" alt="Philippe" class="max-w-full h-auto">

                <div class="absolute top-4 -left-350 floating-bubble flex items-center space-x-2" style="animation-delay: 0s;">
                    <div class="bg-white text-black px-4 py-1.5 rounded-full font-bold text-sm --shadow-xl">
                        <?= __('hero.bubble1') ?>
                    </div>
                    <div class="w-4 h-4 bg-orange-500 border-2 border-white rounded-full"></div>
                </div>

                <div class="absolute top-1/3 -right-8 floating-bubble flex items-center space-x-2" style="animation-delay: 1s;">
                    <div class="w-4 h-4 bg-orange-500 border-2 border-white rounded-full"></div>
                    <div class="bg-white text-black px-4 py-1.5 rounded-full font-bold text-sm --shadow-xl">
                        <?= __('hero.bubble2') ?>
                    </div>
                </div>

                <div class="absolute bottom-1/4 -left-16 floating-bubble flex items-center space-x-2" style="animation-delay: 2s;">
                    <div class="bg-white text-black px-4 py-1.5 rounded-full font-bold text-sm --shadow-xl">
                        <?= __('hero.bubble3') ?>
                    </div>
                    <div class="w-4 h-4 bg-orange-500 border-2 border-white rounded-full"></div>
                </div>

            </div>
        </div>
    </div>
</main>

</div> <!-- End of tech-gradient div started in layout -->

<section id="about" class="bg-[#020617] py-24 px-8 md:px-16">
    <div class="max-w-5xl mx-auto flex flex-col items-center text-center">
        
      <span class="text-xs uppercase tracking-[0.3em] opacity-50 mb-8 font-medium">
            <?= __('about.title') ?>
        </span>

        <h2 class="text-xl md:text-2xl font-bold leading-tight md:leading-[1.1] text-white tracking-tight mb-12">
            <?= __('about.description') ?>
        </h2>

        <a href="<?= $base_url ?>/files/Philippe_Mirindi__Resume.pdf" download class="group flex items-center bg-white/5 border border-white/10 hover:border-orange-500/50 transition-all duration-300 pl-2 pr-6 py-2 rounded-full">
            <div class="bg-orange-600 w-10 h-10 rounded-full flex items-center justify-center mr-4 --shadow-[0_0_15px_rgba(234,88,12,0.4)] group-hover:scale-110 transition-transform">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    viewBox="0 0 24 24" 
                    fill="currentColor" 
                    class="w-6 h-6">
                    
                <path d="M12 16l4-5h-3V4h-2v7H8l4 5zm-7 2v2h14v-2H5z"/>
                </svg>
            </div>
        <span class="text-sm font-bold tracking-wide text-white"><?= __('about.download_cv') ?></span>
        </a>

    </div>
</section>

<section id="mystack" class="bg-[#020617] py-20 px-8 md:px-16 border-t border-white/5">
    <div class="max-w-7xl mx-auto">
        
        <div class="mb-16">
            <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-white">
                <?= __('stack.title') ?> <span class="font-light opacity-30"><?= __('stack.subtitle') ?></span>
            </h2>
            <div class="h-1 w-12 bg-blue-500 mt-4"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-10 gap-y-8">
            <!-- Payer attention aux chemins d'images et simplifier -->
            <!-- Note: Here you can loop over a stack array, but to keep your original HTML, I'll put a few and let JS handle if it was dynamic -->
            <div class="stack-pill group">
                <div class="logo-box">
                    <img src="https://cdn.simpleicons.org/php/white" class="w-7 h-7" alt="PHP">
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">PHP</h3>
                    <p class="text-xs text-white/50">Backend development and server logic.</p>
                </div>
            </div>
            
            <div class="stack-pill group">
                <div class="logo-box">
                    <img src="https://cdn.simpleicons.org/laravel/white" class="w-7 h-7" alt="Laravel">
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Laravel</h3>
                    <p class="text-xs text-white/50">Robust framework for web applications.</p>
                </div>
            </div>

            <!-- J'ai gardé deux éléments pour la démo, mais on peut les remettre tous -->
            <div class="stack-pill group">
                <div class="logo-box">
                    <img src="https://cdn.simpleicons.org/python/white" class="w-7 h-7" alt="Python">
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Python</h3>
                    <p class="text-xs text-white/50">Scripting, automation and AI.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="projects" class="bg-[#020617] py-20 px-8 md:px-16 border-t border-white/5">
    <h2 class="text-3xl md:text-4xl font-bold">
        <?= __('projects.title') ?> <span class="opacity-30 font-light"><?= __('projects.subtitle') ?></span>
      </h2>
    <div class="max-w-7xl mx-auto">
        <div class="mb-12 flex justify-between items-end">
        </div>

        <div id="grid-projects" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Projects injected by JS -->
        </div>
    </div>
</section>

<!-- Popups for projects -->
<div id="project-popup" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 md:p-8">
    <div class="absolute inset-0 bg-black/95 backdrop-blur-md" onclick="closeProject()"></div>
    <div class="relative bg-[#0b1120] w-full max-w-5xl max-h-[90vh] overflow-y-auto rounded-[32px] --shadow-2xl">
        <button onclick="closeProject()" class="absolute top-6 right-6 z-50 bg-white/10 hover:bg-orange-600 text-white p-2 rounded-full transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8 md:p-12">
            <!-- Project content handled by JS -->
            <div class="space-y-4">
                <div class="relative">
                    <div id="popup-images" class="flex overflow-x-auto snap-x snap-mandatory gap-4 pb-4 scrollbar-hide"></div>
                    <button id="fullscreen-btn" onclick="toggleImageFullscreen()" class="absolute top-2 right-2 z-50 bg-white/80 hover:bg-blue-600 text-white p-2 rounded-lg transition" title="View in fullscreen">
                       [FS]
                    </button>
                </div>
                <p class="text-xs text-white italic">← Swipe to see more images →</p>
            </div>
            <div class="flex flex-col justify-center">
                <h2 id="popup-title" class="text-3xl md:text-4xl font-bold text-white mb-4"></h2>
                <div id="popup-techs" class="flex flex-wrap gap-2 mb-6"></div>
                <div class="h-px w-full bg-white/40 mb-6"></div>
                <p id="popup-desc" class="text-gray-400 leading-relaxed text-xs"></p>
            </div>
        </div>
    </div>
</div>

<section class="bg-[#020617] py-20 px-8 md:px-16 border-t border-white/5">
    <div class="max-w-7xl mx-auto">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-white">
                <?= __('feedback.title') ?> <span class="font-light opacity-30"><?= __('feedback.subtitle') ?></span>
            </h2>
            <div class="h-1 w-12 bg-blue-500 mt-4"></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-[#0b1120] p-6 rounded-2xl border border-white/5 flex items-center justify-between relative overflow-hidden">
                    <div>
                        <p class="text-[12px] opacity-80"><?= __('feedback.appreciations') ?></p>
                        <p id="like-count" class="text-3xl text-[#ff2d55]">...</p>
                    </div>
                    <div class="flex flex-col items-end">
                        <button id="like-btn" onclick="handleLike()" class="bg-white/5 hover:bg-[#ff2d55]/20 p-4 rounded-full transition-all border border-white/10 group">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-[#ff2d55]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </button>
                        <span id="like-thanks" class="text-[10px] text-green-400 font-bold mt-2 opacity-0 transition-opacity"><?= __('feedback.thanks') ?></span>
                    </div>
                </div>

                <div class="bg-white/5 p-6 rounded-2xl border border-white/5">
                    <p class="text-[12px] opacity-80"><?= __('feedback.form_title') ?></p>
                    <br>
                    <input type="text" id="fb-name" placeholder="<?= __('feedback.placeholder_name') ?>" class="w-full bg-black/20 border border-white/10 rounded-lg p-3 text-sm mb-3 focus:border-orange-500 outline-none transition">
                    <textarea id="fb-text" maxlength="300" placeholder="<?= __('feedback.placeholder_comment') ?>" class="w-full bg-black/20 border border-white/10 rounded-lg p-3 text-sm h-24 mb-3 focus:border-orange-500 outline-none resize-none transition"></textarea>
                    <button onclick="submitComment()" class="w-full bg-blue-500 hover:bg-orange-500 text-white font-bold py-3 rounded-xl transition text-sm"><?= __('feedback.send') ?></button>
                </div>
            </div>

            <div class="lg:col-span-8 bg-white/[0.02] rounded-2xl p-6 border border-white/5">
                <div id="comments-list" class="divide-y divide-white/5">
                </div>
            </div>
        </div>
    </div>
</section>

<div id="toast-container" class="fixed bottom-10 right-10 z-[200] space-y-4"></div>
