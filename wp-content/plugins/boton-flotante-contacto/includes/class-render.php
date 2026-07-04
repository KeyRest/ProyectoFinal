<?php
/**
 * Clase Boton_Flotante_Render
 * Se encarga de inyectar el HTML y los estilos en la parte pública del sitio con generación automática de enlaces.
 *
 * @package BotonFlotanteContacto
 */

if (!defined('ABSPATH')) {
	exit;
}

class Boton_Flotante_Render
{

	/**
	 * Registrar los hooks para la parte pública de WordPress.
	 *
	 * @since 1.0.0
	 */
	public function init()
	{
		// Encolar los estilos del botón flotante en el frontend.
		add_action('wp_enqueue_scripts', array($this, 'cargar_recursos_publicos'));
		// Imprimir el HTML del botón flotante en el pie de página.
		add_action('wp_footer', array($this, 'renderizar_boton'));
	}

	/**
	 * Encola los archivos CSS para el frontend.
	 *
	 * @since 1.0.0
	 */
	public function cargar_recursos_publicos()
	{
		wp_enqueue_style(
			'boton-flotante-css',
			BOTON_FLOTANTE_URL . 'assets/css/boton-flotante.css',
			array(),
			BOTON_FLOTANTE_VERSION
		);
	}

	/**
	 * Obtiene el código SVG correspondiente al icono seleccionado.
	 *
	 * @param string $tipo Tipo de icono ('whatsapp', 'telefono', 'email').
	 * @return string Estructura HTML/SVG del icono.
	 * @since 1.0.0
	 */
	private function obtener_svg_icono($tipo)
	{
		switch ($tipo) {
			case 'telefono':
				return '<svg viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bfc-svg-icon"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>';

			case 'email':
				return '<svg viewBox="0 0 24 24" width="30" height="30" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="bfc-svg-icon"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>';

			case 'whatsapp':
			default:
				return '<svg viewBox="0 0 24 24" width="30" height="30" fill="currentColor" class="bfc-svg-icon"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.953 3.71 1.458 5.705 1.459h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>';
		}
	}

	/**
	 * Renderiza el botón flotante e inyecta el HTML al final del wp_footer.
	 * Genera automáticamente el prefijo del enlace según la opción seleccionada.
	 *
	 * @since 1.0.0
	 */
	public function renderizar_boton()
	{
		// Obtener las opciones configuradas.
		$destino = get_option('boton_flotante_destino', '');
		$tipo_icono = get_option('boton_flotante_tipo_icono', 'whatsapp');

		// Si no se ha configurado destino de contacto, no renderizar nada.
		if (empty($destino)) {
			return;
		}

		// Construir enlace de forma automática según el canal.
		$url_contacto = '';
		if ('whatsapp' === $tipo_icono) {
			// WhatsApp: Limpiar caracteres no numéricos excepto si hay prefijos raros, wa.me requiere solo números sin "+" ni espacios.
			$numero_limpio = preg_replace('/[^0-9]/', '', $destino);
			$url_contacto = 'https://wa.me/' . $numero_limpio;
		} elseif ('telefono' === $tipo_icono) {
			// Teléfono: Limpiar espacios y dejar el prefijo telefónico.
			$telefono_limpio = preg_replace('/[^0-9+]/', '', $destino);
			$url_contacto = 'tel:' . $telefono_limpio;
		} elseif ('email' === $tipo_icono) {
			// Correo: Sanitizar email y poner prefijo mailto.
			$url_contacto = 'mailto:' . sanitize_email($destino);
		}

		// Obtener el SVG predefinido de WhatsApp, Teléfono o Email.
		$html_icono = $this->obtener_svg_icono($tipo_icono);

		// Generar la clase CSS contenedora en función del tipo de icono.
		$clase_contenedor = 'boton-flotante-contenedor bfc-' . esc_attr($tipo_icono);

		// Imprimir el HTML con sanitización rigurosa.
		?>
		<div class="<?php echo esc_attr($clase_contenedor); ?>">
			<a href="<?php echo esc_url($url_contacto); ?>" target="_blank" rel="noopener noreferrer" aria-label="Contactar"
				class="bfc-enlace">
				<div class="bfc-icono-wrapper">
					<?php echo $html_icono; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			</a>
		</div>
		<?php
	}
}
