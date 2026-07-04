/**
 * Lógica del Menú Responsivo (Menú Hamburguesa)
 */
(function () {
    function initMenu() {
        const button = document.querySelector('.menu-toggle-btn');
        const menu = document.getElementById('site-navigation');

        if (!button || !menu) return;

        // Evitar inicialización duplicada
        if (button.dataset.menuInitialized) return;
        button.dataset.menuInitialized = "true";

        button.addEventListener('click', function (e) {
            e.stopPropagation();
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            // Alternar atributos de accesibilidad y clases en botón y menú
            this.setAttribute('aria-expanded', !isExpanded);
            this.classList.toggle('is-active');
            menu.classList.toggle('is-active');
            menu.classList.toggle('is-open');
        });

        // Cerrar menú al hacer click en un enlace
        const links = menu.querySelectorAll('a');
        links.forEach(link => {
            link.addEventListener('click', () => {
                button.setAttribute('aria-expanded', 'false');
                button.classList.remove('is-active');
                menu.classList.remove('is-active');
                menu.classList.remove('is-open');
            });
        });

        // Cerrar menú al hacer click fuera del menú o del botón
        document.addEventListener('click', function (e) {
            if (!menu.contains(e.target) && !button.contains(e.target)) {
                button.setAttribute('aria-expanded', 'false');
                button.classList.remove('is-active');
                menu.classList.remove('is-active');
                menu.classList.remove('is-open');
            }
        });



    }

    // Ejecutar inmediatamente si el DOM ya está listo
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMenu);
    } else {
        initMenu();
    }
})();
