<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit;
}

?>
<?php astra_content_bottom(); ?>
</div> <!-- ast-container -->
</div><!-- #content -->
<?php
astra_content_after();

astra_footer_before();


?>
<footer class="custom-footer">
	<div class="footer-content">
		<div class="footer-section">
			<h4>Navegación</h4>
			<ul>
				<li><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a></li>
				<li><a
						href="<?php echo esc_url(function_exists('astra_child_get_products_url') ? astra_child_get_products_url() : home_url('/product/')); ?>">Productos</a>
				</li>
				<li><a
						href="<?php echo esc_url(function_exists('astra_child_get_blog_url') ? astra_child_get_blog_url() : home_url('/blog/')); ?>">Blog</a>
				</li>
				<li><a
						href="<?php echo esc_url(function_exists('astra_child_get_about_url') ? astra_child_get_about_url() : home_url('/acerca-de/')); ?>">Acerca
						de</a></li>
			</ul>
		</div>

		<div class="footer-section">
			<h4>Enlaces Legales</h4>
			<ul>
				<li><a href="#">Política de Privacidad</a></li>
				<li><a href="#">Términos y Condiciones</a></li>
				<li><a href="#">Aviso Legal</a></li>
			</ul>
		</div>

		<div class="footer-section">
			<h4>Síguenos</h4>
			<div class="social-icons">
				<a href="https://facebook.com" target="_blank" aria-label="Facebook">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
						fill="currentColor">
						<path
							d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c4.56-.93 8-4.96 8-9.75z" />
					</svg>
				</a>
				<a href="https://twitter.com" target="_blank" aria-label="Twitter">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
						fill="currentColor">
						<path
							d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
					</svg>
				</a>
				<a href="https://instagram.com" target="_blank" aria-label="Instagram">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
						fill="currentColor">
						<path
							d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
					</svg>
				</a>
				<a href="https://linkedin.com" target="_blank" aria-label="LinkedIn">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
						fill="currentColor">
						<path
							d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
					</svg>
				</a>
			</div>
		</div>
	</div>

</footer>
<?php

astra_footer_after();
?>
</div><!-- #page -->
<?php
astra_body_bottom();
wp_footer();
?>
</body>

</html>