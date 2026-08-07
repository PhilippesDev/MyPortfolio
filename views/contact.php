<?php
$base_url = APP_URL;
?>
<main class="flex-grow flex items-center content-layer mt-[100px] mb-[100px]">
    <div class="max-w-3xl mx-auto w-full text-center px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-6"><?= __('nav.contact') ?></h1>
        <div class="bg-white/5 border border-white/10 rounded-2xl p-8 text-left">
            <p class="text-white/70 mb-8"><?= __('footer.contact_text') ?></p>
            
            <form action="#" method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm text-white/50 mb-2">Name</label>
                    <input type="text" class="w-full bg-black/20 border border-white/10 rounded-lg p-3 text-sm focus:border-orange-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm text-white/50 mb-2">Email</label>
                    <input type="email" class="w-full bg-black/20 border border-white/10 rounded-lg p-3 text-sm focus:border-orange-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm text-white/50 mb-2">Message</label>
                    <textarea class="w-full bg-black/20 border border-white/10 rounded-lg p-3 text-sm h-32 focus:border-orange-500 outline-none transition resize-none"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-orange-500 text-white font-bold py-3 px-8 rounded-xl transition text-sm">
                    <?= __('feedback.send') ?>
                </button>
            </form>
        </div>
        
        <div class="mt-8">
            <a href="<?= $base_url ?>/<?= \App\Core\Translator::getLang() ?>" class="text-blue-400 hover:underline">← <?= __('nav.home') ?></a>
        </div>
    </div>
</main>
