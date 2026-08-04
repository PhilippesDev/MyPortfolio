        function updateCount() {
            document.getElementById('char-count').innerText = `${document.getElementById('message').value.length}/1500`;
        }

        function showToast(msg, isError = false) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `px-6 py-3 text-[11px] font-bold tracking-widest uppercase border ${isError ? 'border-red-500 text-red-500' : 'border-white text-white'} bg-black transition-all duration-500 transform translate-x-10 opacity-0`;
            toast.innerText = msg;
            container.appendChild(toast);
            setTimeout(() => { toast.classList.remove('translate-x-10', 'opacity-0'); }, 100);
            setTimeout(() => {
                toast.classList.add('opacity-0');
                setTimeout(() => toast.remove(), 500);
            }, 4000);
        }

        async function sendContact(e) {
            e.preventDefault();
            const btn = document.getElementById('btn-submit');
            btn.innerText = "Processing...";
            btn.disabled = true;

            const data = {
                nom: document.getElementById('nom').value,
                prenom: document.getElementById('prenom').value,
                object: document.getElementById('object').value,
                message: document.getElementById('message').value
            };

            try {
                const res = await fetch('/portfolio/api/contact_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                const result = await res.json();
                if (result.status === 'success') {
                    showToast("Message Envoyé");
                    document.getElementById('contact-form').reset();
                    updateCount();
                } else { showToast(result.message, true); }
            } catch (error) { showToast("Server Error", true); }
            finally { 
                btn.innerText = "Send Message";
                btn.disabled = false;
            }
        }