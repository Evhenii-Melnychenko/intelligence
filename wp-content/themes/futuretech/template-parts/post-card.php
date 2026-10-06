<?php
$post_id       = get_the_ID();
$categories    = get_the_category( $post_id );
$category_slugs = futuretech_post_category_slugs( $post_id );
$category_name = ! empty( $categories ) ? $categories[0]->name : __( 'AI Insights', 'ai-futuretech' );
$author_id     = (int) get_post_field( 'post_author', $post_id );
$author_images = array( 'alex.png', 'john.png', 'sarah.png' );
$author_image  = get_theme_file_uri( '/assets/images/news/authors/' . $author_images[ $author_id % count( $author_images ) ] );
$featured_image = get_the_post_thumbnail_url( $post_id, 'futuretech-card' );

if ( ! $featured_image ) {
	$featured_image = futuretech_post_fallback_image( $post_id );
}
?>
<article <?php post_class( 'post-card' ); ?> data-post-card data-categories="<?php echo esc_attr( implode( ' ', $category_slugs ) ); ?>">
	<a class="post-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<img class="post-card__image" src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" width="720" height="430">
	</a>
	<div class="post-card__body">
		<div class="post-card__meta">
			<span class="post-card__category"><?php echo esc_html( $category_name ); ?></span>
			<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
		</div>
		<h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="post-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 23, '…' ) ); ?></p>
		<div class="post-card__footer">
			<span class="post-card__author">
				<img class="post-card__avatar" src="<?php echo esc_url( $author_image ); ?>" alt="" width="30" height="30" loading="lazy">
				<?php echo esc_html( get_the_author() ); ?>
			</span>
			<a class="post-card__read-more" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'ai-futuretech' ), get_the_title() ) ); ?>">↗</a>
		</div>
	</div>
</article>
