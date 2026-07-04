<?php
/**
 * Template Name: Catálogo de Productos
 *
 * @package Astra-Child
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header(); ?>

<div id="primary" <?php astra_primary_class(); ?>>
	<?php astra_primary_content_top(); ?>

	<main id="main" class="site-main" role="main">
		<div class="catalog-page">
			<div class="catalog-container">

				<!-- Encabezado del Catálogo -->
				<header class="catalog-header">
					<div class="catalog-badge">COLECCIÓN EDITORIAL</div>
					<h1 class="catalog-title">Sastrería Monocromática</h1>
					<p class="catalog-subtitle">
						Piezas arquitectónicas diseñadas bajo principios de minimalismo estructural,
						pureza de líneas y proporciones sin concesiones.
					</p>
				</header>

				<!-- Cuadrícula de Productos -->
				<div class="catalog-grid">
					<?php
					$args = [
						'post_type' => 'product',
						'posts_per_page' => -1,
						'orderby' => 'ID',
						'order' => 'ASC'
					];
					$query = new WP_Query($args);

					if ($query->have_posts()):
						while ($query->have_posts()):
							$query->the_post();

							// Obtención de imagen con respaldo múltiple
							$native_thumbnail_id = get_post_thumbnail_id();
							$custom_image = get_field('imagen_destacada') ? get_field('imagen_destacada') : get_field('Imagen Destacada');
							if (empty($custom_image)) {
								$custom_image = get_field('imagen-destacada');
							}

							$custom_image_url = '';
							if (!empty($custom_image)) {
								if (is_array($custom_image)) {
									$custom_image_url = $custom_image['url'];
								} elseif (is_numeric($custom_image)) {
									$custom_image_url = wp_get_attachment_url($custom_image);
								} else {
									$custom_image_url = $custom_image;
								}
							}

							$image_url = '';
							$image_alt = get_the_title();
							if ($native_thumbnail_id) {
								$image_url = wp_get_attachment_image_url($native_thumbnail_id, 'large');
								$image_alt = get_post_meta($native_thumbnail_id, '_wp_attachment_image_alt', true);
							} elseif (!empty($custom_image_url)) {
								$image_url = $custom_image_url;
							} else {
								$image_url = wc_placeholder_img_src();
							}

							// Precio
							$price_field = get_field('precio') ? get_field('precio') : get_field('Precio');
							$formatted_price = '';
							if (!empty($price_field)) {
								$clean_price = trim($price_field);
								$formatted_price = is_numeric($clean_price) ? '$' . number_format((float) $clean_price, 0, ',', '.') : (strpos($clean_price, '$') === false ? '$' . $clean_price : $clean_price);
							}

							// Valoración / Rating
							$rating_field = get_field('valoracion') ? get_field('valoracion') : get_field('Valoracion');
							$rating_score = !empty($rating_field) && is_numeric($rating_field) ? floatval($rating_field) : 5.0;
							$rating_score = max(1.0, min(5.0, $rating_score));
							?>

							<a href="<?php the_permalink(); ?>" class="product-card">
								<div class="product-card__image">
									<img src="<?php echo esc_url($image_url); ?>"
										alt="<?php echo esc_attr($image_alt ? $image_alt : get_the_title()); ?>" loading="lazy">
								</div>

								<div class="product-card__info">
									<h2 class="product-card__title"><?php the_title(); ?></h2>

									<div class="product-card__rating">
										<div class="product-card__stars">
											<?php for ($i = 1; $i <= 5; $i++):
												$star_class = ($i <= round($rating_score)) ? 'star-filled' : 'star-empty';
												?>
												<svg class="<?php echo esc_attr($star_class); ?>" viewBox="0 0 20 20">
													<path
														d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
												</svg>
											<?php endfor; ?>
										</div>
										<span
											class="product-card__rating-num"><?php echo esc_html(number_format($rating_score, 1)); ?></span>
									</div>

									<?php if (!empty($formatted_price)): ?>
										<span class="product-card__price"><?php echo esc_html($formatted_price); ?></span>
									<?php endif; ?>
								</div>
							</a>

						<?php endwhile;
						wp_reset_postdata();
					else: ?>
						<div class="catalog-empty-state">
							<p>No se encontraron piezas en el catálogo actualmente.</p>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</main>

	<?php astra_primary_content_bottom(); ?>
</div><!-- #primary -->

<?php get_footer(); ?>