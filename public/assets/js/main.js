

// Données initiales (Simulant ton fichier JSON)
let data = {
    likes: 760,
    comments: [
        { title: "Project Manager", text: "Amazing portfolio, love the clean design!", date: "2024-03-20" },
        { title: "Developer", text: "The tech stack is very impressive.", date: "2024-03-21" }
    ]
};

function renderApp() {
    // Update Like Count
    document.getElementById('like-count').innerText = data.likes;
    
    // Update Comments
    const container = document.getElementById('comments-container');
    document.getElementById('feedback-count').innerText = data.comments.length;
    
    container.innerHTML = data.comments.map(c => `
        <div class="comment-row">
            <div class="comment-content">
                <h4 class="text-blue-400 font-bold text-sm mb-1">${c.title}</h4>
                <p class="text-white/70 text-sm leading-relaxed">${c.text}</p>
            </div>
            <div class="comment-meta">
                ${c.date}
            </div>
        </div>
    `).reverse().join(''); // Reverse pour avoir le plus récent en haut
}

function handleLike() {
    data.likes++;
    // Ici, tu ferais normalement un fetch('update_likes.php')
    renderApp();
}

function submitComment() {
    const title = document.getElementById('comment-title').value;
    const text = document.getElementById('comment-text').value;
    
    if(title && text) {
        const newComment = {
            title: title,
            text: text,
            date: new Date().toISOString().split('T')[0]
        };
        
        data.comments.push(newComment);
        
        // Reset form
        document.getElementById('comment-title').value = '';
        document.getElementById('comment-text').value = '';
        
        renderApp();
        // Ici, tu ferais normalement un fetch('save_comment.php', { method: 'POST', body: JSON.stringify(newComment) })
    } else {
        alert("Please fill both title and comment.");
    }
}

// Lancer au chargement (remplace ou complète ton window.onload)
window.addEventListener('load', () => {
    loadProjects(); // Ta fonction existante
    renderApp();    // La nouvelle fonction
});

    // Chargement et Affichage
   async function loadProjects() {
    const grid = document.getElementById('grid-projects');
    
    // 1. Affichage immédiat des Skeletons
    const skeletonHTML = `
        <div class="skeleton-card">
            <div class="px-4 space-y-3">
                <div class="skeleton h-6 w-3/4"></div>
                <div class="skeleton h-4 w-1/2"></div>
            </div>
            <div class="skeleton flex-grow mt-4 rounded-2xl w-full"></div>
        </div>
    `;
    grid.innerHTML = skeletonHTML.repeat(3);

    try {
        // 2. On lance le fetch ET un timer de 2s en parallèle
        // Promise.all attend que les deux promesses soient résolues
        const [response] = await Promise.all([
            fetch('/portfolio/api/projects.json'),
            new Promise(resolve => setTimeout(resolve, 2000)) // Force les 2 secondes
        ]);

        let projects = await response.json();

        // Tri par date
        projects.sort((a, b) => new Date(b.date) - new Date(a.date));

        // 3. Affichage des vrais projets après le délai
        grid.innerHTML = projects.map((p) => `
            <div class="project-card group">
                <div class="project-header">
                    <h3 class="font-bold text-xl text-white">${p.title}</h3>
                    <p class="text-xs text-orange-500 mt-1">${p.technologies.join(' • ')}</p>
                </div>
                <div class="project-img-wrapper">
                    <img src="${p.mainImage}" alt="${p.title}" class="transition-transform duration-500 group-hover:scale-110">
                    <button onclick='openProject(${JSON.stringify(p).replace(/'/g, "&apos;")})' class="btn-orange --shadow-lg --shadow-orange-600/40">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                            <path d="M7 17L17 7M17 7H7M17 7V17"/>
                        </svg>
                    </button>
                </div>
            </div>
        `).join('');

    } catch (error) {
        grid.innerHTML = `<p class="text-white opacity-50">Erreur lors du chargement des projets...</p>`;
        console.error("Erreur:", error);
    }
}

    function openProject(p) {
        const popup = document.getElementById('project-popup');
        document.getElementById('popup-title').innerText = p.title;
        document.getElementById('popup-desc').innerText = p.description;
        
        // Tech badges
        document.getElementById('popup-techs').innerHTML = p.technologies.map(t => 
            `<span class="bg-orange-600/10 text-orange-500 px-3 py-1 rounded-full text-xs font-bold">${t}</span>`
        ).join('');

        // Images slider
        document.getElementById('popup-images').innerHTML = p.images.map(img => 
            `<img src="${img}" class="snap-center w-full flex-shrink-0 rounded-2xl object-cover h-[300px] border border-white/5">`
        ).join('');

        popup.classList.remove('hidden');
        popup.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeProject() {
        const popup = document.getElementById('project-popup');
        popup.classList.add('hidden');
        popup.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    // Fullscreen Gallery
    let currentFullscreenIndex = 0;
    let fullscreenImages = [];

    function toggleImageFullscreen() {
        const imagesContainer = document.getElementById('popup-images');
        const images = imagesContainer.querySelectorAll('img');
        
        if (images.length === 0) return;

        // Récupère les sources des images
        fullscreenImages = Array.from(images).map(img => img.src);
        currentFullscreenIndex = 0;

        // Crée le modal fullscreen
        const fullscreenModal = document.createElement('div');
        fullscreenModal.id = 'fullscreen-gallery';
        fullscreenModal.className = 'fixed inset-0 z-[200] bg-black flex items-center justify-center';
        
        fullscreenModal.innerHTML = `
            <button onclick="closeFullscreen()" class="absolute top-6 right-6 z-50 bg-white/10 hover:bg-orange-600 text-white p-3 rounded-full transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <div class="relative w-full h-full flex items-center justify-center px-4">
                <img id="fullscreen-image" src="${fullscreenImages[0]}" alt="Fullscreen" class="max-w-full max-h-full object-contain rounded-lg">
                
                <!-- Navigation -->
                <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex gap-4 items-center bg-black/50 px-6 py-3 rounded-full backdrop-blur">
                    <button onclick="previousFullscreenImage()" class="p-2 bg-white/10 hover:bg-white/20 rounded-lg transition">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </button>
                    <span id="fullscreen-counter" class="text-white font-bold text-sm">1 / ${fullscreenImages.length}</span>
                    <button onclick="nextFullscreenImage()" class="p-2 bg-white/10 hover:bg-white/20 rounded-lg transition">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                    </button>
                </div>

                <!-- Thumbnails scroll -->
                <div class="absolute bottom-24 left-0 right-0 flex justify-center gap-2 overflow-x-auto px-4 pb-4">
                    ${fullscreenImages.map((img, idx) => `
                        <img src="${img}" onclick="goToFullscreenImage(${idx})" class="w-12 h-12 object-cover rounded cursor-pointer border-2 ${idx === 0 ? 'border-orange-500' : 'border-white/20'} hover:border-orange-500 transition">
                    `).join('')}
                </div>
            </div>
        `;

        document.body.appendChild(fullscreenModal);
        document.body.style.overflow = 'hidden';

        // Clavier
        document.addEventListener('keydown', handleFullscreenKeyboard);
    }

    function closeFullscreen() {
        const modal = document.getElementById('fullscreen-gallery');
        if (modal) {
            modal.remove();
            document.body.style.overflow = 'auto';
            document.removeEventListener('keydown', handleFullscreenKeyboard);
        }
    }

    function nextFullscreenImage() {
        currentFullscreenIndex = (currentFullscreenIndex + 1) % fullscreenImages.length;
        updateFullscreenImage();
    }

    function previousFullscreenImage() {
        currentFullscreenIndex = (currentFullscreenIndex - 1 + fullscreenImages.length) % fullscreenImages.length;
        updateFullscreenImage();
    }

    function goToFullscreenImage(idx) {
        currentFullscreenIndex = idx;
        updateFullscreenImage();
    }

    function updateFullscreenImage() {
        const img = document.getElementById('fullscreen-image');
        const counter = document.getElementById('fullscreen-counter');
        
        if (img) {
            img.src = fullscreenImages[currentFullscreenIndex];
            counter.innerText = `${currentFullscreenIndex + 1} / ${fullscreenImages.length}`;

            // Mettre à jour les thumbnails
            const thumbnails = document.querySelectorAll('#fullscreen-gallery img[onclick]');
            thumbnails.forEach((thumb, idx) => {
                if (idx === currentFullscreenIndex) {
                    thumb.classList.remove('border-white/20');
                    thumb.classList.add('border-orange-500');
                } else {
                    thumb.classList.add('border-white/20');
                    thumb.classList.remove('border-orange-500');
                }
            });
        }
    }

    function handleFullscreenKeyboard(e) {
        if (e.key === 'ArrowRight') nextFullscreenImage();
        if (e.key === 'ArrowLeft') previousFullscreenImage();
        if (e.key === 'Escape') closeFullscreen();
    }

    // Lancer au démarrage
    window.onload = loadProjects;
/*<style>
     Masquer la scrollbar pour le slider 
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style> */

const ENDPOINT = "/portfolio/api/api.php";

// Système de Toast
function showToast(message, isError = false) {
    const container = document.getElementById('toast-container');
    const toast = document.createElement('div');
    toast.className = `${isError ? 'bg-red-600' : 'bg-green-600'} text-white px-6 py-3 rounded-xl shadow-2xl font-bold text-sm transform transition-all duration-300 translate-y-10 opacity-0`;
    toast.innerText = message;
    
    container.appendChild(toast);
    
    // Animation entrée
    setTimeout(() => {
        toast.classList.remove('translate-y-10', 'opacity-0');
    }, 100);

    // Suppression automatique
    setTimeout(() => {
        toast.classList.add('opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 4000);
}

async function refreshData() {
    try {
        const res = await fetch(ENDPOINT);
        const data = await res.json();
        
        // Correction de l'erreur TypeError : on vérifie si data et data.comments existent
        const comments = (data && data.comments) ? data.comments : [];
        const likes = (data && data.likes) ? data.likes : 0;

        document.getElementById('like-count').innerText = likes;
        
        if (getCookie('has_liked')) {
            document.getElementById('like-btn').classList.add('liked-btn');
            document.getElementById('like-thanks').classList.remove('opacity-0');
        }

        const list = document.getElementById('comments-list');
        list.innerHTML = comments.length > 0 ? comments.map(c => `
    <div class="feedback-row group">
        <div class="flex flex-col w-full md:w-1/4 mb-2 md:mb-0">
            <span class="text-blue-400 font-bold text-sm tracking-tight">${c.name}</span>
            <span class="text-[10px] uppercase tracking-[0.1em] opacity-30 mt-1">${c.date}</span>
        </div>

        <div class="flex-grow relative">
            <div class="absolute -left-4 top-0 bottom-0 w-px bg-gradient-to-b from-transparent via-orange-500/20 to-transparent hidden md:block"></div>
            <p class="text-white text-sm leading-relaxed pl-0 md:pl-6 group-hover:text-white transition-colors">
                ${c.text}
            </p>
        </div>

        <div class="hidden md:flex items-center ml-4 opacity-0 group-hover:opacity-100 transition-opacity">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-orange-500/40" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
    </div>
`).join('') : `
    <div class="py-12 text-center opacity-20 border-2 border-dashed border-white/5 rounded-2xl">
        <p class="text-sm italic">No feedbacks yet. Your word matters!</p>
    </div>
`;
    } catch (e) {
        console.error("Fetch error:", e);
    }
}

async function handleLike() {
    if (getCookie('has_liked')) return;

    try {
        await fetch(ENDPOINT, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'like' })
        });
        document.cookie = "has_liked=true; path=/; max-age=86400"; // 24h
        refreshData();
    } catch (e) {
        showToast("Error updating likes", true);
    }
}

async function submitComment() {
    const nameInput = document.getElementById('fb-name');
    const textInput = document.getElementById('fb-text');

    if (!nameInput.value || !textInput.value) {
        showToast("Please fill all fields", true);
        return;
    }

    try {
        const response = await fetch(ENDPOINT, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ 
                action: 'comment', 
                name: nameInput.value, 
                text: textInput.value 
            })
        });

        if (response.ok) {
            showToast("Awesome! Thanks a lot for your feedback");
            nameInput.value = '';
            textInput.value = '';
            refreshData();
        } else {
            throw new Error();
        }
    } catch (e) {
        showToast("Erreur lors de l'envoi du message", true);
    }
}

// Aide pour les cookies
function getCookie(name) {
    let match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    if (match) return match[2];
}

window.addEventListener('load', () => {
    if(typeof loadProjects === "function") loadProjects();
    refreshData();
});

// 1. Configuration de l'observateur
const observerOptions = {
    root: null, // Surveille par rapport au viewport (écran)
    threshold: 0.15 // Se déclenche quand 15% de la section est visible
};

const projectObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            // La section est visible ! On lance ton chargement avec Skeleton
            loadProjects();
            
            // On arrête d'observer une fois que c'est lancé (chargement unique)
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// 2. On attache l'observateur à la section projets
document.addEventListener('DOMContentLoaded', () => {
    const targetSection = document.getElementById('projects');
    if (targetSection) {
        projectObserver.observe(targetSection);
    }
});

// 3. Ta fonction (inchangée, elle contient déjà ton délai de 2s et ton skeleton)
async function loadProjects() {
    const grid = document.getElementById('grid-projects');
    if (!grid) return;

    const skeletonHTML = `
        <div class="skeleton-card">
            <div class="px-4 space-y-3">
                <div class="skeleton h-6 w-3/4"></div>
                <div class="skeleton h-4 w-1/2"></div>
            </div>
            <div class="skeleton flex-grow mt-4 rounded-2xl w-full"></div>
        </div>
    `;
    grid.innerHTML = skeletonHTML.repeat(3);

    try {
        const [response] = await Promise.all([
            fetch('/portfolio/api/projects.json'),
            new Promise(resolve => setTimeout(resolve, 2000))
        ]);

        let projects = await response.json();
        projects.sort((a, b) => new Date(b.date) - new Date(a.date));

        grid.innerHTML = projects.map((p) => `
            <div class="project-card group">
                <div class="project-header">
                    <h3 class="font-bold text-xl text-white">${p.title}</h3>
                    <p class="text-xs text-orange-500 mt-1">${p.technologies.join(' • ')}</p>
                </div>
                <div class="project-img-wrapper">
                    <img src="${p.mainImage}" alt="${p.title}" class="transition-transform duration-500 group-hover:scale-110">
                    <button onclick='openProject(${JSON.stringify(p).replace(/'/g, "&apos;")})' class="btn-orange --shadow-lg --shadow-orange-600/40">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3">
                            <path d="M7 17L17 7M17 7H7M17 7V17"/>
                        </svg>
                    </button>
                </div>
            </div>
        `).join('');

    } catch (error) {
        grid.innerHTML = `<p class="text-white opacity-50">Erreur lors du chargement des projets...</p>`;
        console.error("Erreur:", error);
    }
}

