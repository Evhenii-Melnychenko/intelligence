<footer class="site-footer">
	<div class="site-container site-footer__main">
		<div class="site-footer__about">
			<a class="site-footer__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img class="site-footer__logo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.svg' ) ); ?>" alt="" width="50" height="50" loading="lazy">
				<span><?php bloginfo( 'name' ); ?></span>
			</a>
			<p class="site-footer__description"><?php esc_html_e( 'Ideas, research and perspectives shaping the future of artificial intelligence.', 'ai-futuretech' ); ?></p>
		</div>
		<div>
			<h2 class="site-footer__title"><?php esc_html_e( 'Explore', 'ai-futuretech' ); ?></h2>
			<ul class="site-footer__links">
				<li><a href="<?php echo esc_url( futuretech_get_posts_page_url() ); ?>"><?php esc_html_e( 'Latest stories', 'ai-futuretech' ); ?></a></li>
				<li><a href="<?php echo esc_url( futuretech_page_url( 'podcasts' ) ); ?>"><?php esc_html_e( 'Podcasts', 'ai-futuretech' ); ?></a></li>
				<li><a href="<?php echo esc_url( futuretech_page_url( 'resources' ) ); ?>"><?php esc_html_e( 'Resources', 'ai-futuretech' ); ?></a></li>
			</ul>
		</div>
		<div>
			<h2 class="site-footer__title"><?php esc_html_e( 'Connect', 'ai-futuretech' ); ?></h2>
			<ul class="site-footer__links">
				<li><a href="<?php echo esc_url( futuretech_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact us', 'ai-futuretech' ); ?></a></li>
				<li><a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer"><img class="site-footer__social-icon" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/footer/linkedin.svg' ) ); ?>" alt="" width="16" height="16" loading="lazy"><?php esc_html_e( 'LinkedIn', 'ai-futuretech' ); ?></a></li>
				<li><a href="https://twitter.com/" target="_blank" rel="noopener noreferrer"><img class="site-footer__social-icon" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/footer/twitter.svg' ) ); ?>" alt="" width="16" height="16" loading="lazy"><?php esc_html_e( 'X / Twitter', 'ai-futuretech' ); ?></a></li>
			</ul>
		</div>
	</div>
	<div class="site-container site-footer__bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></span>
		<span><?php esc_html_e( 'Exploring what comes next.', 'ai-futuretech' ); ?></span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
