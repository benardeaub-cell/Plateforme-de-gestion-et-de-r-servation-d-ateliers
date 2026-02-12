
// console.log('script.js chargé', window.location.pathname + window.location.search);

document.addEventListener('DOMContentLoaded', function () {
    const forms = Array.from(document.forms).map(f => ({
        id: f.id || null,
        action: f.action || null,
        class: f.className || null,
        inputs: Array.from(f.elements).filter(e => e.tagName === 'INPUT').map(i => ({name: i.name, id: i.id, type: i.type})),
        snippet: f.innerHTML.trim().slice(0, 200)
    }));
    console.log('Forms on page (detailed):', forms);

    const registerForm = document.getElementById('registerForm') || document.querySelector('form[action*="auth&action=store"]') || document.querySelector('form[action*="register"]');
    if (!registerForm) {
        console.warn('registerForm introuvable — vérifie que tu es sur index.php?controller=auth&action=register et que la vue render est un fragment (pas de </body></html> dans la vue).');
        return;
    }

    // Ensure native validation won't block custom handling
    registerForm.setAttribute('novalidate', 'true');

    registerForm.addEventListener('submit', function(e) {
        try {
            // Fallback validators if they don't exist
            if (typeof validName !== 'function') window.validName = v => (v||'').trim().length > 0;
            if (typeof validEmail !== 'function') window.validEmail = v => /^\S+@\S+\.\S+$/.test(v||'');
            if (typeof validPassword !== 'function') window.validPassword = v => (v||'').length >= 6;

            // Fallback createElement to show messages inside form
            if (typeof createElement !== 'function') window.createElement = (tag, classes, text, parent) => {
                const el = document.createElement(tag);
                el.className = classes;
                el.textContent = text;
                parent.prepend(el);
                setTimeout(() => el.remove(), 4000);
                return el;
            };

            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const password = document.getElementById('password');

            if (!name || !email || !password) {
                console.error('Un ou plusieurs champs manquent dans le DOM (ids attendus: name, email, password).');
                e.preventDefault();
                return;
            }

            // Clear previous alerts in the form
            Array.from(registerForm.querySelectorAll('.alert')).forEach(a => a.remove());

            if (!validName(name.value)) {
                createElement('div', 'alert alert-danger', 'Le nom est requis.', registerForm);
                name.focus();
                e.preventDefault();
                return;
            }

            if (!validEmail(email.value)) {
                createElement('div', 'alert alert-danger', 'Veuillez entrer une adresse email valide.', registerForm);    
                email.focus();
                e.preventDefault();
                return;
            }

            if (!validPassword(password.value)) {
                createElement('div', 'alert alert-danger', 'Le mot de passe doit faire au moins 6 caractères.', registerForm);
                password.focus();
                e.preventDefault();
                return;
            }

            createElement('div', 'alert alert-success', 'Inscription prête à être envoyée.', registerForm);
            // allow submission
        } catch (err) {
            console.error('Erreur dans le handler du formulaire:', err);
            // prevent submission on unexpected errors
            e.preventDefault();
        }
    });
});


// Ajout modal de formulaire d'ajout d'atelier
document.addEventListener('DOMContentLoaded', function () {
    const overlay = document.querySelector('.modal-overlay-add');
    const openBtn = document.getElementById('btn-add-atelier');
    const closeBtn = document.getElementById('closeModal');

    function closeModal() {
        if (!overlay) {
            return;
        }
        overlay.classList.remove('is-visible');
        overlay.setAttribute('hidden', '');
        overlay.setAttribute('aria-hidden', 'true');
    }
    

    if (openBtn && overlay) {
        openBtn.addEventListener('click', () => {
            overlay.classList.add('is-visible');
            overlay.removeAttribute('hidden');
            overlay.setAttribute('aria-hidden', 'false');
        });
    }
    if (closeBtn && overlay) {
        closeBtn.addEventListener('click', () => {
            overlay.classList.remove('is-visible');
            overlay.setAttribute('hidden', '');
            overlay.setAttribute('aria-hidden', 'true');
        });
    }

    if (!overlay) {
        return;
    }

    overlay.addEventListener('click', e => { if (e.target === overlay) closeModal(); });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
});

 
