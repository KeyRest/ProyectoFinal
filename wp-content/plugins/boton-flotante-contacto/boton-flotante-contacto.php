<?php
/**
 * Plugin Name: Botón Flotante de Contacto
 * Description: Añade un botón flotante personalizable en la esquina inferior para contactar directamente.
 * Version: 1.0.0
 * Author: Keiron Garro
 * Text Domain: boton-flotante-contacto
 * Domain Path: /languages
 */

// Evitar el acceso directo al archivo si se llama fuera de WordPress.
if (!defined('ABSPATH')) {
	exit;
}

// Definición de constantes del plugin.
define('BOTON_FLOTANTE_VERSION', '1.0.0');
define('BOTON_FLOTANTE_DIR', plugin_dir_path(__FILE__));
define('BOTON_FLOTANTE_URL', plugin_dir_url(__FILE__));

/**
 * Función de inicialización del plugin.
 * Carga las clases y arranca sus componentes.
 *
 * @since 1.0.0
 */
function boton_flotante_contacto_init()
{
	// Requerir la clase de ajustes del panel de administración.
	require_once BOTON_FLOTANTE_DIR . 'includes/class-ajustes.php';
	// Requerir la clase encargada de renderizar el botón en el frontend.
	require_once BOTON_FLOTANTE_DIR . 'includes/class-render.php';

	// Instanciar e inicializar las clases.
	if (is_admin()) {
		$ajustes = new Boton_Flotante_Ajustes();
		$ajustes->init();
	}

	$render = new Boton_Flotante_Render();
	$render->init();
}
add_action('plugins_loaded', 'boton_flotante_contacto_init');
