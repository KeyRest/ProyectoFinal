<?php

/**
 * Plugin Name: Random Joke
 * Description: Muestra un chiste aleatorio. Shortcode: [random_joke]
 * Version:     1.0.0
 * Author:      Keiron Garro M
 */

if (! defined('ABSPATH')) exit;

/* Agregar la clase de CSS */
add_action('wp_enqueue_scripts', function () {
    wp_register_style('random-joke', plugin_dir_url(__FILE__) . 'random-joke.css', [], '1.0.0');
});



/* Declaracion del shortcode */
add_shortcode('random_joke', function () {
    wp_enqueue_style('random-joke');


    ob_start(); ?>


    <div id="joke-widget">
        <p id="joke-setup">Press the button to get a random joke…</p>
        <p id="joke-punchline"></p>
        <button id="joke-btn" type="button">Tell me a joke!</button>
    </div>

    <script>
        (function() {

            /* Obtener elementos del DOM */
            var btn = document.getElementById('joke-btn');
            var setup = document.getElementById('joke-setup');
            var punch = document.getElementById('joke-punchline');

            btn.addEventListener('click', function() {
                if (btn.disabled) return;

                /* Bloquear botón y limpiar chiste anterior */
                btn.disabled = true;
                btn.textContent = 'Loading...';
                punch.style.opacity = '0';

                /* Llamdo a la API */
                fetch('https://official-joke-api.appspot.com/random_joke')
                    .then(function(r) {
                        return r.json();
                    })
                    .then(function(joke) {
                        setup.textContent = joke.setup;

                        /* Pausa antes de mostrar el punchline */
                        setTimeout(function() {
                            punch.textContent = joke.punchline;
                            punch.style.opacity = '1';
                            btn.textContent = 'Tell me a joke!';
                            btn.disabled = false;
                        }, 1200);
                    })
                    .catch(function() {
                        setup.textContent = 'Error. Please try again.';
                        btn.textContent = 'Tell me a joke!';
                        btn.disabled = false;
                    });
            });
        })();
    </script>

<?php return ob_get_clean();
});
