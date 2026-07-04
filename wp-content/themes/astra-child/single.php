<?php
/**
 * Plantilla para entradas individuales del blog 
 *
 * @package Astra-Child
 */

if (!defined('ABSPATH')) {
	exit;
}

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		while (have_posts()):
			the_post();
			?>
			<article class="article-detail">
				<div class="article-detail__container">

					<a href="<?php echo esc_url(function_exists('astra_child_get_blog_url') ? astra_child_get_blog_url() : home_url('/blog/')); ?>"
						class="article-detail__back">
						← Volver al Journal
					</a>

					<header class="article-detail__header">
						<h1 class="article-detail__title"><?php the_title(); ?></h1>

						<div class="article-detail__meta">
							<span>Por <?php echo get_the_author(); ?></span>
							<span>•</span>
							<span><?php echo get_the_date('F j, Y'); ?></span>
						</div>
					</header>

					<?php
					$hero_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
					if (!$hero_image) {
						$hero_image = get_post_meta(get_the_ID(), 'imagen_destacada', true);
					}
					if (!$hero_image) {
						$hero_image = get_post_meta(get_the_ID(), '_external_thumbnail_url', true);
					}
					if (!$hero_image && function_exists('get_field')) {
						$hero_image = get_field('imagen_destacada');
					}
					if ($hero_image): ?>
						<div class="article-detail__hero">
							<img src="<?php echo esc_url($hero_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"
								style="width: 100%; height: auto; border-radius: 4px; object-fit: cover;">
						</div>
					<?php endif; ?>

					<div class="article-detail__content">
						<?php the_content(); ?>
					</div>

					<?php if (comments_open() || get_comments_number()): ?>
						<section class="article-detail__comments">
							<?php comments_template(); ?>
						</section>
					<?php endif; ?>

				</div>
			</article>
		<?php endwhile; ?>
	</main>
</div>

<?php get_footer(); ?>