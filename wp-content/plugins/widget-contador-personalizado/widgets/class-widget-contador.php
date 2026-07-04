<?php
/**
 * Clase Widget_Contador_Personalizado
 * Extiende la clase base de Elementor para crear nuestro widget de cuenta regresiva.
 *
 * @package WidgetContadorPersonalizado
 */

if (!defined('ABSPATH')) {
	exit;
}

class Widget_Contador_Personalizado extends \Elementor\Widget_Base
{

	/**
	 * Retorna el identificador interno del widget.
	 *
	 * @return string Nombre del widget.
	 * @since 1.0.0
	 */
	public function get_name()
	{
		return 'contador_personalizado';
	}

	/**
	 * Retorna el título del widget visible en el panel lateral de Elementor.
	 *
	 * @return string Título del widget.
	 * @since 1.0.0
	 */
	public function get_title()
	{
		return 'Contador Personalizado';
	}

	/**
	 * Retorna el icono representativo del widget.
	 *
	 * @return string Nombre del icono de Elementor.
	 * @since 1.0.0
	 */
	public function get_icon()
	{
		return 'eicon-countdown';
	}

	/**
	 * Retorna la categoría de Elementor a la que pertenecerá el widget.
	 *
	 * @return array Lista de categorías.
	 * @since 1.0.0
	 */
	public function get_categories()
	{
		return array('general');
	}

	/**
	 * Especifica los estilos registrados que requiere este widget.
	 *
	 * @return array Manejadores de estilos (handles).
	 * @since 1.0.0
	 */
	public function get_style_depends()
	{
		return array('widget-contador-css');
	}

	/**
	 * Especifica los scripts registrados que requiere este widget.
	 *
	 * @return array Manejadores de scripts (handles).
	 * @since 1.0.0
	 */
	public function get_script_depends()
	{
		return array('widget-contador-js');
	}

	/**
	 * Registra los controles y secciones de configuración del widget.
	 *
	 * @since 1.0.0
	 */
	protected function register_controls()
	{
		// Sección de Contenido
		$this->start_controls_section(
			'section_contenido',
			array(
				'label' => 'Configuración del Contador',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'fecha_limite',
			array(
				'label' => 'Fecha y Hora Límite',
				'type' => \Elementor\Controls_Manager::DATE_TIME,
				'description' => 'Seleccione cuándo finalizará la cuenta regresiva.',
				'default' => date('Y-m-d H:i', strtotime('+1 day')),
			)
		);

		$this->add_control(
			'texto_adicional',
			array(
				'label' => 'Texto Adicional',
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => 'Ej: ¡Próximamente! o cambia este titulo',
				'default' => 'cambia este titulo',
				'label_block' => true,
			)
		);

		$this->end_controls_section();

		// Sección de Estilo
		$this->start_controls_section(
			'section_estilo',
			array(
				'label' => 'Estilos visuales',
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'color_fondo',
			array(
				'label' => 'Color de Fondo',
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#0f172a', // Slate 900 premium
				'selectors' => array(
					'{{WRAPPER}} .widget-contador-wrapper' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'color_texto',
			array(
				'label' => 'Color de Texto',
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f8fafc', // Slate 50 premium
				'selectors' => array(
					'{{WRAPPER}} .widget-contador-wrapper' => 'color: {{VALUE}};',
					'{{WRAPPER}} .contador-valor' => 'color: {{VALUE}};',
					'{{WRAPPER}} .contador-etiqueta' => 'color: {{VALUE}}; opacity: 0.8;',
					'{{WRAPPER}} .contador-texto' => 'color: {{VALUE}}; opacity: 0.9;',
				),
			)
		);

		// Control de Tipografía del Título (permite cambiar tamaño, familia, peso, etc.)
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			array(
				'name' => 'titulo_typography',
				'label' => 'Tipografía del Título',
				'selector' => '{{WRAPPER}} .contador-texto',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Renderiza el HTML del widget en el frontend.
	 *
	 * @since 1.0.0
	 */
	protected function render()
	{
		// Obtener la configuración actual.
		$settings = $this->get_settings_for_display();
		$fecha_limite = !empty($settings['fecha_limite']) ? $settings['fecha_limite'] : '';
		$texto_adicional = !empty($settings['texto_adicional']) ? $settings['texto_adicional'] : '';
		$color_fondo = !empty($settings['color_fondo']) ? $settings['color_fondo'] : '#0f172a';
		$color_texto = !empty($settings['color_texto']) ? $settings['color_texto'] : '#f8fafc';

		// Formatear la fecha límite al formato estándar ISO para JavaScript (YYYY-MM-DDTHH:mm:ss).
		$fecha_formateada = '';
		if (!empty($fecha_limite)) {
			$fecha_formateada = date('c', strtotime($fecha_limite));
		}
		?>
		<div class="widget-contador-wrapper" data-fecha-limite="<?php echo esc_attr($fecha_formateada); ?>">

			<?php if (!empty($texto_adicional)): ?>
				<div class="contador-texto">
					<?php echo esc_html($texto_adicional); ?>
				</div>
			<?php endif; ?>

			<div class="contador-elementos">
				<div class="contador-item">
					<span class="contador-valor contador-dias">00</span>
					<span class="contador-etiqueta">Días</span>
				</div>
				<div class="contador-separador">:</div>

				<div class="contador-item">
					<span class="contador-valor contador-horas">00</span>
					<span class="contador-etiqueta">Horas</span>
				</div>
				<div class="contador-separador">:</div>

				<div class="contador-item">
					<span class="contador-valor contador-minutos">00</span>
					<span class="contador-etiqueta">Minutos</span>
				</div>
				<div class="contador-separador">:</div>

				<div class="contador-item">
					<span class="contador-valor contador-segundos">00</span>
					<span class="contador-etiqueta">Segundos</span>
				</div>
			</div>

		</div>
		<?php
	}
}
