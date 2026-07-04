<?php
/**
 * Plantilla de producto individual
 *
 * @package Astra-Child
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header(); ?>

<?php
if (astra_page_layout() === 'left-sidebar') {
	get_sidebar();
}
?>

<div id="primary" <?php astra_primary_class(); ?>>
	<?php astra_primary_content_top(); ?>

	<main id="main" class="site-main" role="main">
		<div class="product-detail">

			<?php if (have_posts()): ?>
				<?php while (have_posts()):
					the_post(); ?>

					<div class="product-detail__grid">

						<!-- Columna Izquierda: Galería Editorial -->
						<div class="product-detail__gallery">
							<?php
							$native_image_id = get_post_thumbnail_id();
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

							$main_image_url = '';
							$main_image_alt = get_the_title();
							if ($native_image_id) {
								$main_image_url = wp_get_attachment_image_url($native_image_id, 'large');
								$main_image_alt = get_post_meta($native_image_id, '_wp_attachment_image_alt', true);
							} elseif (!empty($custom_image_url)) {
								$main_image_url = $custom_image_url;
							}
							?>

							<div class="product-detail__main-image">
								<img id="product-hero-image" src="<?php echo esc_url($main_image_url); ?>"
									alt="<?php echo esc_attr($main_image_alt ? $main_image_alt : get_the_title()); ?>">
							</div>

							<?php if ($native_image_id && !empty($custom_image_url)): ?>
								<div class="product-detail__thumbs">
									<div class="product-detail__thumb active"
										onclick="swapProductImage('<?php echo esc_url(wp_get_attachment_image_url($native_image_id, 'large')); ?>', this)">
										<img src="<?php echo esc_url(wp_get_attachment_image_url($native_image_id, 'thumbnail')); ?>"
											alt="Vista frontal">
									</div>
									<div class="product-detail__thumb"
										onclick="swapProductImage('<?php echo esc_url($custom_image_url); ?>', this)">
										<img src="<?php echo esc_url($custom_image_url); ?>" alt="Vista detalle">
									</div>
								</div>

								<script>
									function swapProductImage(url, element) {
										document.getElementById('product-hero-image').src = url;
										document.querySelectorAll('.product-detail__thumb').forEach(thumb => thumb.classList.remove('active'));
										element.classList.add('active');
									}
								</script>
							<?php endif; ?>
						</div>

						<div class="product-detail__info">

							<?php
							$rating_field = get_field('valoracion') ? get_field('valoracion') : get_field('Valoracion');
							$rating_score = !empty($rating_field) && is_numeric($rating_field) ? floatval($rating_field) : 5.0;
							$rating_score = max(1.0, min(5.0, $rating_score));
							?>
							<div class="product-detail__rating">
								<div class="product-detail__stars">
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
									class="product-detail__rating-number"><?php echo esc_html(number_format($rating_score, 1)); ?>
									/ 5.0</span>
							</div>

							<h1 class="product-detail__title"><?php the_title(); ?></h1>

							<?php
							$subtitle = get_field('titulo') ? get_field('titulo') : get_field('Titulo');
							if (!empty($subtitle) && $subtitle !== get_the_title()):
								?>
								<div class="product-detail__subtitle"><?php echo esc_html($subtitle); ?></div>
							<?php endif; ?>

							<?php
							$price_field = get_field('precio') ? get_field('precio') : get_field('Precio');
							?>
							<div class="product-detail__price-row">
								<?php if (!empty($price_field)):
									$clean_price = trim($price_field);
									$formatted_price = is_numeric($clean_price) ? '$' . number_format((float) $clean_price, 0, ',', '.') : (strpos($clean_price, '$') === false ? '$' . $clean_price : $clean_price);
									?>
									<span class="product-detail__price"><?php echo esc_html($formatted_price); ?></span>
								<?php endif; ?>
								<span class="product-detail__status">In Stock</span>
							</div>

							<?php
							$description = get_field('descripcion') ? get_field('descripcion') : get_field('Descripcion');
							if (empty($description)) {
								$description = get_the_content();
							}
							if (!empty($description)):
								?>
								<div class="product-detail__description">
									<?php echo wp_kses_post($description); ?>
								</div>
							<?php endif; ?>

							<!-- Botón WhatsApp -->
							<div class="product-detail__cta">
								<?php
								$contact_phone = get_option('boton_flotante_destino', '');
								$message_text = 'Hola, me gustaría pedir: ' . get_the_title() . (!empty($formatted_price) ? ' (' . $formatted_price . ')' : '');
								$whatsapp_url = !empty($contact_phone) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $contact_phone) . '?text=' . rawurlencode($message_text) : 'https://wa.me/?text=' . rawurlencode($message_text);
								?>
								<a href="<?php echo esc_url($whatsapp_url); ?>" target="_blank" rel="noopener noreferrer"
									class="btn-whatsapp">
									<svg viewBox="0 0 24 24">
										<path
											d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.746.953 3.71 1.458 5.705 1.459h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
									</svg>
									<span>Pedir por WhatsApp</span>
								</a>
							</div>

							<!-- Lista de Especificaciones -->
							<div class="specs-list">
								<div class="spec-item">
									<span class="spec-label">Disponibilidad</span>
									<span class="spec-value">Inmediata</span>
								</div>
								<div class="spec-item">
									<span class="spec-label">SKU</span>
									<span class="spec-value">REF-<?php the_ID(); ?></span>
								</div>
							</div>

						</div>

					</div>

				<?php endwhile; ?>
			<?php endif; ?>

		</div>
	</main>

	<?php astra_primary_content_bottom(); ?>
</div><!-- #primary -->

<?php
if (astra_page_layout() === 'right-sidebar') {
	get_sidebar();
}
?>

<?php get_footer(); ?>