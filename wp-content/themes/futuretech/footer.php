<?php
$footer_podcast_category = get_category_by_slug( 'podcasts' );
if ( ! $footer_podcast_category ) {
	$footer_podcast_category = get_category_by_slug( 'podcast' );
}
$footer_podcast_children = $footer_podcast_category
	? get_term_children( (int) $footer_podcast_category->term_id, 'category' )
	: array();
if ( is_wp_error( $footer_podcast_children ) ) {
	$footer_podcast_children = array();
}
$footer_excluded_category_ids = $footer_podcast_category
	? array_merge( array( (int) $footer_podcast_category->term_id ), $footer_podcast_children )
	: array();
$footer_podcast_shows = $footer_podcast_category
	? get_categories(
		array(
			'hide_empty' => true,
			'parent'     => (int) $footer_podcast_category->term_id,
			'orderby'    => 'name',
			'order'      => 'ASC',
		)
	)
	: array();
$footer_categories = get_categories(
	array(
		'hide_empty' => true,
		'number'     => 5,
		'orderby'    => 'count',
		'order'      => 'DESC',
		'exclude'    => $footer_excluded_category_ids,
	)
);
$footer_posts = get_posts(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 4,
		'ignore_sticky_posts' => true,
		'category__not_in'    => $footer_excluded_category_ids,
	)
);
$footer_resource_types = get_terms(
	array(
		'taxonomy'   => 'resource_type',
		'hide_empty' => false,
		'orderby'    => 'term_id',
		'order'      => 'ASC',
	)
);
if ( is_wp_error( $footer_resource_types ) ) {
	$footer_resource_types = array();
}
$footer_privacy_url = get_privacy_policy_url();
$footer_terms_page  = get_page_by_path( 'terms-and-conditions' );
?>
<footer class="site-footer">
	<div class="site-container site-footer__main">
		<nav class="site-footer__column" aria-label="<?php esc_attr_e( 'Home links', 'ai-futuretech' ); ?>">
			<h2 class="site-footer__heading"><?php esc_html_e( 'Home', 'ai-futuretech' ); ?></h2>
			<ul class="site-footer__list">
				<li><a href="<?php echo esc_url( home_url( '/#futuretech-features-title' ) ); ?>"><?php esc_html_e( 'Features', 'ai-futuretech' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/#latest-stories' ) ); ?>"><?php esc_html_e( 'Blogs', 'ai-futuretech' ); ?></a></li>
				<li><a href="<?php echo esc_url( futuretech_page_url( 'resources' ) ); ?>"><?php esc_html_e( 'Resources', 'ai-futuretech' ); ?></a></li>
				<li><a href="<?php echo esc_url( home_url( '/#reader-reviews-list' ) ); ?>"><?php esc_html_e( 'Testimonials', 'ai-futuretech' ); ?></a></li>
				<li><a href="<?php echo esc_url( futuretech_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact Us', 'ai-futuretech' ); ?></a></li>
			</ul>
		</nav>

		<nav class="site-footer__column" aria-label="<?php esc_attr_e( 'News links', 'ai-futuretech' ); ?>">
			<h2 class="site-footer__heading"><?php esc_html_e( 'News', 'ai-futuretech' ); ?></h2>
			<ul class="site-footer__list">
				<li><a href="<?php echo esc_url( futuretech_get_posts_page_url() ); ?>"><?php esc_html_e( 'Trending Stories', 'ai-futuretech' ); ?></a></li>
				<?php foreach ( $footer_categories as $footer_category ) : ?>
					<li><a href="<?php echo esc_url( get_category_link( $footer_category->term_id ) ); ?>"><?php echo esc_html( $footer_category->name ); ?></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<nav class="site-footer__column" aria-label="<?php esc_attr_e( 'Blog links', 'ai-futuretech' ); ?>">
			<h2 class="site-footer__heading"><?php esc_html_e( 'Blogs', 'ai-futuretech' ); ?></h2>
			<ul class="site-footer__list">
				<?php foreach ( $footer_posts as $index => $footer_post ) : ?>
					<li>
						<a href="<?php echo esc_url( get_permalink( $footer_post ) ); ?>">
							<?php echo esc_html( get_the_title( $footer_post ) ); ?>
							<?php if ( 0 === $index ) : ?>
								<span class="site-footer__badge"><?php esc_html_e( 'New', 'ai-futuretech' ); ?></span>
							<?php endif; ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</nav>

		<nav class="site-footer__column" aria-label="<?php esc_attr_e( 'Podcast links', 'ai-futuretech' ); ?>">
			<h2 class="site-footer__heading"><?php esc_html_e( 'Podcasts', 'ai-futuretech' ); ?></h2>
			<ul class="site-footer__list">
				<?php if ( ! empty( $footer_podcast_shows ) ) : ?>
					<?php foreach ( $footer_podcast_shows as $footer_show ) : ?>
						<li>
							<a href="<?php echo esc_url( get_category_link( $footer_show->term_id ) ); ?>"><?php echo esc_html( $footer_show->name ); ?></a>
						</li>
					<?php endforeach; ?>
				<?php else : ?>
					<li><a href="<?php echo esc_url( futuretech_page_url( 'podcasts' ) ); ?>"><?php esc_html_e( 'Explore all podcasts', 'ai-futuretech' ); ?></a></li>
				<?php endif; ?>
			</ul>
		</nav>

		<nav class="site-footer__column" aria-label="<?php esc_attr_e( 'Resource links', 'ai-futuretech' ); ?>">
			<h2 class="site-footer__heading"><?php esc_html_e( 'Resources', 'ai-futuretech' ); ?></h2>
			<ul class="site-footer__list site-footer__list--resource">
				<?php foreach ( $footer_resource_types as $footer_resource_type ) : ?>
					<?php $resource_url = add_query_arg( 'resource_type', $footer_resource_type->slug, futuretech_page_url( 'resources' ) ) . '#resource-grid'; ?>
					<li><a href="<?php echo esc_url( $resource_url ); ?>"><?php echo esc_html( $footer_resource_type->name ); ?><span aria-hidden="true">↗</span></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>
	</div>

	<div class="site-container site-footer__bottom">
		<div class="site-footer__legal">
			<?php if ( $footer_terms_page ) : ?>
				<a href="<?php echo esc_url( get_permalink( $footer_terms_page ) ); ?>"><?php esc_html_e( 'Terms & Conditions', 'ai-futuretech' ); ?></a>
			<?php endif; ?>
			<?php if ( $footer_privacy_url ) : ?>
				<a href="<?php echo esc_url( $footer_privacy_url ); ?>"><?php esc_html_e( 'Privacy Policy', 'ai-futuretech' ); ?></a>
			<?php endif; ?>
		</div>

		<div class="site-footer__socials" aria-label="<?php esc_attr_e( 'Social media', 'ai-futuretech' ); ?>">
			<a href="https://twitter.com/" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Follow us on X', 'ai-futuretech' ); ?>">
				<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/footer/twitter.svg' ) ); ?>" alt="" width="18" height="18" loading="lazy">
			</a>
			<a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Connect with us on LinkedIn', 'ai-futuretech' ); ?>">
				<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/footer/linkedin.svg' ) ); ?>" alt="" width="18" height="18" loading="lazy">
			</a>
		</div>

		<p class="site-footer__copyright">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'ai-futuretech' ); ?></p>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
