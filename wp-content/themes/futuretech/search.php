<?php
get_header();
?>
<main id="main-content" class="site-main">
	<header class="site-container archive-hero">
		<span class="eyebrow"><?php esc_html_e( 'Search FutureTech', 'ai-futuretech' ); ?></span>
		<h1 class="archive-hero__title"><?php echo esc_html( sprintf( __( 'Results for “%s”', 'ai-futuretech' ), get_search_query() ) ); ?></h1>
		<p class="archive-hero__description"><?php esc_html_e( 'Explore articles and perspectives related to your search.', 'ai-futuretech' ); ?></p>
	</header>
	<section class="site-container archive-content" aria-label="<?php esc_attr_e( 'Search results', 'ai-futuretech' ); ?>">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid archive-content__grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post-card' );
				endwhile;
				?>
			</div>
			<nav class="site-pagination" aria-label="<?php esc_attr_e( 'Search results navigation', 'ai-futuretech' ); ?>">
				<?php the_posts_pagination(); ?>
			</nav>
		<?php else : ?>
			<p class="archive-empty"><?php esc_html_e( 'We could not find stories matching that search. Try another phrase.', 'ai-futuretech' ); ?></p>
		<?php endif; ?>
	</section>
	<div class="site-container archive-content__cta"><?php get_template_part( 'template-parts/cta' ); ?></div>
</main>
<?php
get_footer();
