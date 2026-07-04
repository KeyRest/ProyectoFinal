<?php
/**
 * Template Name: Acerca de
 *
 * @package Astra-Child
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header(); ?>

<main id="about-main" class="about-page">

	<!-- Hero Editorial Acerca de -->
	<section class="about-hero">
		<div class="about-badge">MANIFIESTO XIMA</div>
		<h1 class="about-title">Redefiniendo el estándar a través del minimalismo funcional.</h1>
		<p class="about-subtitle">
			Creemos en la eliminación del ruido visual. Diseñamos piezas esenciales que trascienden las temporadas,
			centradas en la precisión arquitectónica del corte y la pureza de los materiales.
		</p>
	</section>

	<!-- Imagen Editorial Panorámica -->
	<section class="about-banner">
		<img src="https://images.pexels.com/photos/10622508/pexels-photo-10622508.jpeg" alt="Filosofía XIMA">
	</section>

	<!-- Grid de Tres Pilares -->
	<section class="about-pillars">
		<div class="pillar-card">
			<span class="pillar-card__number">01</span>
			<h3 class="pillar-card__title">Diseño Consciente</h3>
			<p class="pillar-card__desc">
				Cada costura, proporción y caída es estudiada rigurosamente. No creamos ropa efímera; construimos el
				fondo de armario definitivo que se adapta al movimiento natural de tu vida.
			</p>
		</div>

		<div class="pillar-card">
			<span class="pillar-card__number">02</span>
			<h3 class="pillar-card__title">Materiales Nobles</h3>
			<p class="pillar-card__desc">
				Seleccionamos exclusivamente fibras naturales de alta densidad como algodón orgánico de fibra larga y
				lino puro, garantizando tacto excepcional, termorregulación y longevidad absoluta.
			</p>
		</div>

		<div class="pillar-card">
			<span class="pillar-card__number">03</span>
			<h3 class="pillar-card__title">Paleta Monocromática</h3>
			<p class="pillar-card__desc">
				El blanco y el negro son nuestra máxima expresión de sofisticación. El alto contraste elimina
				distracciones y permite que la personalidad de quien porta la prenda sea la verdadera protagonista.
			</p>
		</div>
	</section>

	<!-- Sección Historia / Filosofía -->
	<section class="about-story">
		<div class="about-story__content">
			<h2>Nuestra Filosofía</h2>
			<p>
				XIMA nació como respuesta a la saturación del fast fashion. Nos preguntamos cómo sería crear una marca
				donde cada pieza tuviera un propósito innegable y una calidad tan impecable que pudiera usarse año tras
				año sin perder su vigencia ni su estructura.
			</p>
			<p>
				Hoy, colaboramos directamente con talleres artesanales especializados que comparten nuestra obsesión por
				el detalle inmaculado y el respeto por los procesos sostenibles.
			</p>
			<div class="about-story__cta">
				<a href="<?php echo esc_url(function_exists('astra_child_get_products_url') ? astra_child_get_products_url() : home_url('/product/')); ?>"
					class="btn-primary">
					Explorar la Colección →
				</a>
			</div>
		</div>
	</section>

	<!-- Sección Plugin Random Joke -->
	<section class="about-joke" style="margin-top: 5rem;">
		<header class="catalog-header" style="margin-bottom: 1.5rem;">
			<div class="about-badge">PAUSA CREATIVA</div>
			<h2 style="font-size: 1.8rem; font-weight: 700; margin-top: 0.5rem;">Un instante de humor</h2>
		</header>
		<?php echo do_shortcode('[random_joke]'); ?>
	</section>

</main>

<?php get_footer(); ?>