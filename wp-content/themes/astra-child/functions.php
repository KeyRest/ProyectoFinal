<?php
/**
 * Funciones y definiciones del tema hijo Astra Child.
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Carga de estilos y tipografías necesarias.
 */
function astra_child_enqueue_styles()
{
	$css_file = get_stylesheet_directory() . '/assets/css/styles.css';
	$version = file_exists($css_file) ? filemtime($css_file) : '1.0.0';

	wp_enqueue_style('parent_styles', get_template_directory_uri() . '/style.css');
	wp_enqueue_style('astra_child_styles', get_stylesheet_directory_uri() . '/assets/css/styles.css', ['parent_styles'], $version);

	// Tipografías e iconos de Google
	wp_enqueue_style('google-font-roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap', [], null);
	wp_enqueue_style('material-icons', 'https://fonts.googleapis.com/icon?family=Material+Icons', [], null);
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_styles');

/**
 * Carga de scripts del tema.
 */
function astra_child_enqueue_scripts()
{
	$js_file = get_stylesheet_directory() . '/assets/js/menu-toggle.js';
	if (file_exists($js_file)) {
		$version = filemtime($js_file);
		wp_enqueue_script('menu-toggle', get_stylesheet_directory_uri() . '/assets/js/menu-toggle.js', [], $version, true);
	}
}
add_action('wp_enqueue_scripts', 'astra_child_enqueue_scripts');
