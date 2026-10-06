<?php
get_header();
?>
<main id="main-content" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		$categories     = get_the_category();
		$featured_image = get_the_post_thumbnail_url( get_the_ID(), 'full' );
		if ( ! $featured_image ) {
			$featured_image = futuretech_post_fallback_image( get_the_ID() );
		}
		?>
		<article <?php post_class( 'single-article' ); ?>>
			<header class="single-article__header">
				<?php if ( ! empty( $categories ) ) : ?>
					<a class="eyebrow" href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>"><?php echo esc_html( $categories[0]->name ); ?></a>
				<?php else : ?>
					<span class="eyebrow"><?php esc_html_e( 'FutureTech journal', 'ai-futuretech' ); ?></span>
				<?php endif; ?>
				<h1 class="single-article__title"><?php the_title(); ?></h1>
				<?php if ( has_excerpt() ) : ?>
					<p class="single-article__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
				<?php endif; ?>
				<div class="single-article__byline">
					<span class="single-article__author"><?php echo esc_html( get_the_author() ); ?></span>
					<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></time>
				</div>
			</header>
			<img class="single-article__featured-image" src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" width="1200" height="720">
			<div class="single-article__content">
				<?php the_content(); ?>
				<?php
				wp_link_pages( array(
					'before' => '<nav class="single-article__page-links">' . esc_html__( 'Pages:', 'ai-futuretech' ),
					'after'  => '</nav>',
				) );
				?>
			</div>
			<?php
			$tags = get_the_tags();
			if ( $tags ) :
				?>
				<div class="single-article__tags" aria-label="<?php esc_attr_e( 'Article tags', 'ai-futuretech' ); ?>">
					<?php foreach ( $tags as $tag ) : ?>
						<a class="single-article__tag" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</article>
	<?php endwhile; ?>
	<div class="site-container single-article__footer"><?php get_template_part( 'template-parts/cta' ); ?></div>
</main>
<?php
get_footer();
