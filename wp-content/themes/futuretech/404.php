<?php
get_header();
?>
<main id="main-content" class="site-main">
	<section class="contact-page" aria-labelledby="not-found-title">
		<span class="eyebrow"><?php esc_html_e( '404 — Page not found', 'ai-futuretech' ); ?></span>
		<h1 class="contact-page__title" id="not-found-title"><?php esc_html_e( 'This page is out of orbit.', 'ai-futuretech' ); ?></h1>
		<div class="contact-page__content">
			<p><?php esc_html_e( 'The link may be outdated, or the page may have moved. Head back to the latest stories and keep exploring.', 'ai-futuretech' ); ?></p>
			<a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Back to home', 'ai-futuretech' ); ?></a>
		</div>
	</section>
</main>
<?php
get_footer();
