<?php
get_header();
?>
<main id="main-content" class="site-main">
	<header class="site-container archive-hero">
		<span class="eyebrow"><?php esc_html_e( 'The FutureTech journal', 'ai-futuretech' ); ?></span>
		<h1 class="archive-hero__title"><?php the_archive_title(); ?></h1>
		<?php if ( get_the_archive_description() ) : ?>
			<div class="archive-hero__description"><?php the_archive_description(); ?></div>
		<?php else : ?>
			<p class="archive-hero__description"><?php esc_html_e( 'Perspectives, research and stories from across the world of emerging technology.', 'ai-futuretech' ); ?></p>
		<?php endif; ?>
		<div class="archive-hero__categories">
			<?php get_template_part( 'template-parts/category-tabs' ); ?>
		</div>
	</header>

	<section class="site-container archive-content" aria-label="<?php esc_attr_e( 'Articles', 'ai-futuretech' ); ?>">
		<?php if ( have_posts() ) : ?>
			<div class="post-grid archive-content__grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/post-card' );
				endwhile;
				?>
			</div>
			<nav class="site-pagination" aria-label="<?php esc_attr_e( 'Posts navigation', 'ai-futuretech' ); ?>">
				<?php
				the_posts_pagination( array(
					'mid_size'           => 1,
					'prev_text'          => __( '← Previous', 'ai-futuretech' ),
					'next_text'          => __( 'Next →', 'ai-futuretech' ),
					'screen_reader_text' => __( 'Posts navigation', 'ai-futuretech' ),
				) );
				?>
			</nav>
		<?php else : ?>
			<p class="archive-empty"><?php esc_html_e( 'No stories found here just yet.', 'ai-futuretech' ); ?></p>
		<?php endif; ?>
	</section>

	<div class="site-container archive-content__cta">
		<?php get_template_part( 'template-parts/cta' ); ?>
	</div>
</main>
<?php
get_footer();
