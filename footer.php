			</div><!-- .container -->
		</div><!-- #content -->

		<?php truereview_footer_ads() ?>

		<footer id="colophon" class="site-footer" <?php hybrid_attr( 'footer' ); ?>>
			<?php get_template_part( 'sidebar', 'footer' ); // Loads the sidebar-footer.php template. ?>

			<div class="site-info">
				<div class="container">

					<?php
						// Get data set in customizer
						$social = truereview_mod( PREFIX . 'social-footer' );
						if ( $social ) :
					?>
						<?php truereview_social_icons( 'footer' ); ?>
					<?php endif; ?>

					<?php truereview_footer_text(); ?>

				</div>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->

	</div><!-- .wide-container -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
