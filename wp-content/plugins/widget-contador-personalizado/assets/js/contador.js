/**
 * JavaScript para el funcionamiento de la Cuenta Regresiva.
 * Lee los data-attributes del widget y actualiza el DOM cada segundo.
 * Compatible con múltiples instancias y el editor interactivo de Elementor.
 */
(function ($) {
	'use strict';

	/**
	 * Inicializa el contador regresivo para una instancia específica del widget.
	 *
	 * @param {jQuery} $wrapper El contenedor jQuery del widget del contador.
	 */
	function inicializarContador( $wrapper ) {
		// Obtener la fecha límite definida en el atributo data-fecha-limite.
		var fechaLimiteStr = $wrapper.data('fecha-limite');

		if ( ! fechaLimiteStr ) {
			return;
		}

		// Convertir la fecha límite a objeto Date.
		var fechaLimite = new Date( fechaLimiteStr ).getTime();

		// Si la fecha no es válida, abortar.
		if ( isNaN( fechaLimite ) ) {
			return;
		}

		// Buscar los elementos contenedores de los valores.
		var $dias     = $wrapper.find('.contador-dias');
		var $horas    = $wrapper.find('.contador-horas');
		var $minutos  = $wrapper.find('.contador-minutos');
		var $segundos = $wrapper.find('.contador-segundos');

		// Limpiar cualquier intervalo previo registrado en este elemento para evitar duplicados.
		var intervaloPrevio = $wrapper.data('contador-intervalo-id');
		if ( intervaloPrevio ) {
			clearInterval( intervaloPrevio );
		}

		/**
		 * Función que calcula el tiempo restante y actualiza el DOM.
		 */
		function actualizarTiempo() {
			var ahora = new Date().getTime();
			var distancia = fechaLimite - ahora;

			// Si la cuenta regresiva ha terminado, mostrar ceros y detener el intervalo.
			if ( distancia < 0 ) {
				$dias.text('00');
				$horas.text('00');
				$minutos.text('00');
				$segundos.text('00');
				clearInterval( intervaloId );
				return;
			}

			// Cálculos de tiempo para días, horas, minutos y segundos.
			var dias = Math.floor( distancia / ( 1000 * 60 * 60 * 24 ) );
			var horas = Math.floor( ( distancia % ( 1000 * 60 * 60 * 24 ) ) / ( 1000 * 60 * 60 ) );
			var minutos = Math.floor( ( distancia % ( 1000 * 60 * 60 ) ) / ( 1000 * 60 ) );
			var segundos = Math.floor( ( distancia % ( 1000 * 60 ) ) / 1000 );

			// Rellenar con ceros a la izquierda si el valor es menor a 10.
			var pad = function ( num ) {
				return ( num < 10 ? '0' : '' ) + num;
			};

			// Actualizar el contenido en el DOM.
			$dias.text( pad( dias ) );
			$horas.text( pad( horas ) );
			$minutos.text( pad( minutos ) );
			$segundos.text( pad( segundos ) );
		}

		// Ejecutar la actualización una primera vez para evitar saltos visuales de "00".
		actualizarTiempo();

		// Configurar el intervalo para que se ejecute cada segundo (1000 ms).
		var intervaloId = setInterval( actualizarTiempo, 1000 );

		// Guardar el identificador del intervalo en los datos del elemento.
		$wrapper.data( 'contador-intervalo-id', intervaloId );
	}

	// Inicializar los contadores que ya estén presentes al cargar la página (Frontend estándar).
	$(document).ready(function () {
		$('.widget-contador-wrapper').each(function () {
			inicializarContador( $(this) );
		});
	});

	// Enganchar en el evento de Elementor para que funcione en el editor en tiempo real.
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction(
			'frontend/element_ready/contador_personalizado.default',
			function ( $scope ) {
				var $wrapper = $scope.find('.widget-contador-wrapper');
				if ( $wrapper.length ) {
					inicializarContador( $wrapper );
				}
			}
		);
	});

})(jQuery);
