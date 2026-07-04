<?php
/**
 * Plugin Name: Widget Contador Personalizado para Elementor
 * Description: Añade un widget de cuenta regresiva personalizable para el maquetador Elementor.
 * Version: 1.0.0
 * Author: Keiron Garro
 * Text Domain: widget-contador-personalizado
 */

// Evitar el acceso directo al archivo si se llama fuera de WordPress.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Función para registrar los recursos (estilos y scripts) del contador.
 * Registra los assets para que Elementor los encole automáticamente al usar el widget.
 *
 * @since 1.0.0
 */
function widget_contador_registrar_recursos()
{
	wp_register_style(
		'widget-contador-css',
		plugins_url('assets/css/contador.css', __FILE__),
		array(),
		'1.0.0'
	);

	wp_register_script(
		'widget-contador-js',
		plugins_url('assets/js/contador.js', __FILE__),
		array('jquery'),
		'1.0.0',
		true
	);
}
add_action('wp_enqueue_scripts', 'widget_contador_registrar_recursos');

/**
 * Carga e inicializa el widget dentro de Elementor.
 * Verifica si Elementor está instalado y activo antes de registrar el widget.
 *
 * @since 1.0.0
 */
function widget_contador_inicializar()
{
	// Verificar si Elementor está activo.
	if (!did_action('elementor/loaded')) {
		return;
	}

	// Registrar el widget en el gestor de widgets de Elementor.
	add_action('elementor/widgets/register', 'widget_contador_registrar_widget');
}
add_action('init', 'widget_contador_inicializar');

/**
 * Registra la clase del widget de forma oficial en Elementor.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Instancia del gestor de widgets de Elementor.
 * @since 1.0.0
 */
function widget_contador_registrar_widget($widgets_manager)
{
	require_once plugin_dir_path(__FILE__) . 'widgets/class-widget-contador.php';
	$widgets_manager->register(new \Widget_Contador_Personalizado());
}
