<?php
/**
 * Clase Boton_Flotante_Ajustes
 * Gestiona la página de ajustes simplificada del botón flotante.
 *
 * @package BotonFlotanteContacto
 */

if (!defined('ABSPATH')) {
	exit;
}

class Boton_Flotante_Ajustes
{

	/**
	 * Registrar los hooks de WordPress para el panel de administración.
	 *
	 * @since 1.0.0
	 */
	public function init()
	{
		// Registrar la página de ajustes en el menú de Ajustes.
		add_action('admin_menu', array($this, 'crear_menu_ajustes'));
		// Registrar las opciones de configuración del plugin.
		add_action('admin_init', array($this, 'registrar_ajustes'));
	}

	/**
	 * Agrega una página al menú de Ajustes generales de WordPress.
	 *
	 * @since 1.0.0
	 */
	public function crear_menu_ajustes()
	{
		add_options_page(
			'Ajustes del Botón de Contacto', // Título de la página
			'Botón de Contacto',             // Título del menú
			'manage_options',                // Capacidad requerida
			'boton-flotante-contacto',       // Slug del menú
			array($this, 'render_pagina_ajustes') // Función callback
		);
	}

	/**
	 * Registra los ajustes del plugin con la API de Ajustes de WordPress.
	 *
	 * @since 1.0.0
	 */
	public function registrar_ajustes()
	{
		register_setting(
			'boton_flotante_opciones_grupo',
			'boton_flotante_destino',
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'default' => '',
			)
		);

		register_setting(
			'boton_flotante_opciones_grupo',
			'boton_flotante_tipo_icono',
			array(
				'type' => 'string',
				'sanitize_callback' => 'sanitize_text_field',
				'default' => 'whatsapp',
			)
		);
	}

	/**
	 * Renderiza la interfaz del panel de ajustes.
	 *
	 * @since 1.0.0
	 */
	public function render_pagina_ajustes()
	{
		if (!current_user_can('manage_options')) {
			return;
		}

		// Obtener los valores actuales de las opciones.
		$destino = get_option('boton_flotante_destino', '');
		$tipo_icono = get_option('boton_flotante_tipo_icono', 'whatsapp');
		?>
		<div class="wrap">
			<h1>Ajustes del Botón Flotante de Contacto</h1>
			<p>Configure los datos de contacto y el icono para el botón flotante.</p>

			<form method="post" action="options.php">
				<?php
				// Generar campos de nonce, grupo y cabeceras ocultas.
				settings_fields('boton_flotante_opciones_grupo');
				do_settings_sections('boton_flotante_opciones_grupo');
				?>

				<table class="form-table" role="presentation">
					<tbody>
						<!-- Fila de Destino -->
						<tr>
							<th scope="row">
								<label for="boton_flotante_destino">Dato de Contacto</label>
							</th>
							<td>
								<input name="boton_flotante_destino" type="text" id="boton_flotante_destino"
									value="<?php echo esc_attr($destino); ?>" class="regular-text"
									placeholder="Ej: 34600000000 o info@correo.com" required>
								<p class="description">Introduzca el número de teléfono (con código de país, sin espacios) para
									WhatsApp y Teléfono, o el correo electrónico para Email.</p>
							</td>
						</tr>

						<!-- Fila de Tipo de Icono -->
						<tr>
							<th scope="row">Selección de Icono</th>
							<td>
								<fieldset>
									<legend class="screen-reader-text"><span>Selección de Icono</span></legend>
									<label>
										<input type="radio" name="boton_flotante_tipo_icono" value="whatsapp" <?php checked($tipo_icono, 'whatsapp'); ?>> WhatsApp
									</label><br>
									<label>
										<input type="radio" name="boton_flotante_tipo_icono" value="telefono" <?php checked($tipo_icono, 'telefono'); ?>> Teléfono
									</label><br>
									<label>
										<input type="radio" name="boton_flotante_tipo_icono" value="email" <?php checked($tipo_icono, 'email'); ?>> Correo Electrónico
									</label>
								</fieldset>
							</td>
						</tr>
					</tbody>
				</table>

				<?php submit_button('Guardar Ajustes'); ?>
			</form>
		</div>
		<?php
	}
}
