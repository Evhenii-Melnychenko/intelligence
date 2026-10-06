<?php
get_header();
?>
<main id="main-content" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class( 'contact-page' ); ?>>
			<span class="eyebrow"><?php esc_html_e( 'FutureTech', 'ai-futuretech' ); ?></span>
			<h1 class="contact-page__title"><?php the_title(); ?></h1>
			<div class="contact-page__content"><?php the_content(); ?></div>
		</article>
	<?php endwhile; ?>
	<div class="site-container"><?php get_template_part( 'template-parts/cta' ); ?></div>
</main>
<?php
get_footer();
