<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'ai-futuretech' ); ?></a>
<div class="site-announcement">
	<a class="site-announcement__link" href="<?php echo esc_url( futuretech_page_url( 'resources' ) ); ?>">
		<?php esc_html_e( 'Subscribe to our Newsletter For New & latest Blogs and Resources', 'ai-futuretech' ); ?>
		<span aria-hidden="true">↗</span>
	</a>
</div>
<header class="site-header">
	<div class="site-container site-header__inner">
		<a class="site-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if ( has_custom_logo() ) : ?>
				<?php echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full', false, array( 'class' => 'site-header__logo' ) ); ?>
			<?php else : ?>
				<img class="site-header__logo" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/logo.svg' ) ); ?>" alt="" width="50" height="50">
			<?php endif; ?>
			<span><?php bloginfo( 'name' ); ?></span>
		</a>

		<?php
		wp_nav_menu( array(
			'theme_location'        => 'primary',
			'container'             => 'nav',
			'container_class'       => 'primary-navigation',
			'container_aria_label'  => __( 'Primary navigation', 'ai-futuretech' ),
			'menu_class'            => 'primary-navigation__list',
			'fallback_cb'           => 'futuretech_primary_menu_fallback',
			'link_before'           => '<span class="primary-navigation__link-text">',
			'link_after'            => '</span>',
		) );
		?>

		<div class="site-header__actions">
			<a class="button site-header__contact" href="<?php echo esc_url( futuretech_page_url( 'contact' ) ); ?>"><?php esc_html_e( 'Contact Us', 'ai-futuretech' ); ?></a>
			<button class="mobile-menu-toggle" type="button" aria-label="<?php esc_attr_e( 'Toggle navigation', 'ai-futuretech' ); ?>" aria-expanded="false">
				<span></span><span></span>
			</button>
		</div>
	</div>
</header>
