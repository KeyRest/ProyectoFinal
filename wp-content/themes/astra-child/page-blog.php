<?php
/**
 * Template Name: Catálogo de Blog
 * Plantilla editorial Clean Code para mostrar los artículos del blog.
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
		<div class="blog-page">
			<div class="blog-container">

				<!-- Encabezado Editorial -->
				<header class="blog-header">
					<div class="blog-badge">Editorial & Wellness</div>
					<h1 class="blog-title"><?php echo esc_html(get_the_title() ? get_the_title() : 'El Journal'); ?>
					</h1>
					<p class="blog-subtitle">Explora nuestras reflexiones sobre diseño funcional, longevidad
						arquitectónica y pureza material.</p>
				</header>

				<!-- Cuadrícula de Artículos -->
				<div class="blog-grid">
					<?php
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = [
						'post_type' => 'post',
						'posts_per_page' => 9,
						'paged' => $paged
					];
					$blog_query = new WP_Query($args);

					if ($blog_query->have_posts()):
						while ($blog_query->have_posts()):
							$blog_query->the_post();

							$thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
							if (!$thumbnail_url) {
								$thumbnail_url = get_post_meta(get_the_ID(), 'imagen_destacada', true);
							}
							if (!$thumbnail_url) {
								$thumbnail_url = get_post_meta(get_the_ID(), '_external_thumbnail_url', true);
							}
							if (!$thumbnail_url && function_exists('get_field')) {
								$thumbnail_url = get_field('imagen_destacada');
							}


							?>

							<a href="<?php the_permalink(); ?>" class="article-card">
								<div class="article-card__image">
									<img src="<?php echo esc_url($thumbnail_url); ?>"
										alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
								</div>

								<div class="article-card__info">
									<h2 class="article-card__title"><?php the_title(); ?></h2>
									<div class="article-card__excerpt">
										<?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
									</div>
									<div class="article-card__footer">
										<span>Leer artículo →</span>
										<span class="article-card__date"><?php echo get_the_date('M d, Y'); ?></span>
									</div>
								</div>
							</a>

						<?php endwhile;
						wp_reset_postdata();
					else: ?>
						<div style="grid-column: 1 / -1; text-align: center; padding: 80px 0; color: #888;">
							<p>Aún no hay artículos publicados en el Journal.</p>
						</div>
					<?php endif; ?>
				</div>

			</div>
		</div>
	</main>

	<?php astra_primary_content_bottom(); ?>
</div><!-- #primary -->

<?php get_footer(); ?>