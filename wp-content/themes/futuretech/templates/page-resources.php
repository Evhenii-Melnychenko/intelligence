<?php
/**
 * Template Name: Resources
 */

get_header();
$resource_query = new WP_Query( array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 12,
	'ignore_sticky_posts' => true,
) );
$resource_types = get_terms( array(
	'taxonomy'   => 'resource_type',
	'hide_empty' => false,
	'orderby'    => 'term_id',
	'order'      => 'ASC',
) );
$resource_topics = get_categories( array( 'hide_empty' => true ) );
if ( is_wp_error( $resource_types ) ) {
	$resource_types = array();
}
?>
<main id="main-content" class="site-main">
	<div class="site-container resources-page">
		<header class="resources-page__hero">
			<span><?php esc_html_e( 'Guides, research and ideas', 'ai-futuretech' ); ?></span>
			<h1><?php esc_html_e( 'Unlock a World of Knowledge', 'ai-futuretech' ); ?></h1>
			<div><?php the_content(); ?></div>
		</header>
		<div class="resources-page__stats" aria-label="<?php esc_attr_e( 'Resources at a glance', 'ai-futuretech' ); ?>">
			<div class="resources-page__stat">
				<strong><?php echo esc_html( number_format_i18n( $resource_query->found_posts ) ); ?></strong>
				<span><?php esc_html_e( 'Resources available', 'ai-futuretech' ); ?></span>
			</div>
			<div class="resources-page__stat">
				<strong><?php echo esc_html( number_format_i18n( count( $resource_topics ) ) ); ?></strong>
				<span><?php esc_html_e( 'Research topics', 'ai-futuretech' ); ?></span>
			</div>
			<div class="resources-page__stat">
				<strong><?php echo esc_html( number_format_i18n( count( $resource_types ) ) ); ?></strong>
				<span><?php esc_html_e( 'Resource formats', 'ai-futuretech' ); ?></span>
			</div>
		</div>

		<section class="resources-page__library" aria-labelledby="resources-heading">
			<header class="resources-page__library-header">
				<div>
					<span class="eyebrow"><?php esc_html_e( 'Dive into the details', 'ai-futuretech' ); ?></span>
					<h2 class="resources-page__section-title" id="resources-heading"><?php esc_html_e( 'In-Depth Reports and Analysis', 'ai-futuretech' ); ?></h2>
				</div>

				<?php if ( ! empty( $resource_types ) ) : ?>
					<div class="resources-page__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Filter resources by type', 'ai-futuretech' ); ?>" aria-controls="resource-grid" data-post-filters>
						<button id="resources-tab-all" class="category-list__button" type="button" role="tab" aria-selected="true" aria-controls="resource-grid" tabindex="0" data-post-filter="all"><?php esc_html_e( 'All', 'ai-futuretech' ); ?></button>
						<?php foreach ( $resource_types as $resource_type ) : ?>
							<button id="<?php echo esc_attr( 'resources-tab-' . $resource_type->slug ); ?>" class="category-list__button" type="button" role="tab" aria-selected="false" aria-controls="resource-grid" tabindex="-1" data-post-filter="<?php echo esc_attr( $resource_type->slug ); ?>"><?php echo esc_html( $resource_type->name ); ?></button>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</header>

			<?php if ( $resource_query->have_posts() ) : ?>
				<div class="resources-page__grid" id="resource-grid" role="tabpanel" aria-labelledby="resources-tab-all" data-post-grid data-post-featured-count="2" aria-live="polite">
					<?php
					$resource_index = 0;
					while ( $resource_query->have_posts() ) :
						$resource_query->the_post();
						$post_id           = get_the_ID();
						$post_types        = get_the_terms( $post_id, 'resource_type' );
						$post_type_slugs   = array();
						$post_categories   = get_the_category( $post_id );
						$featured_image    = get_the_post_thumbnail_url( $post_id, 'futuretech-card' );

						if ( is_array( $post_types ) ) {
							foreach ( $post_types as $post_type ) {
								$post_type_slugs[] = $post_type->slug;
							}
						}
						if ( ! $featured_image ) {
							$featured_image = futuretech_post_fallback_image( $post_id );
						}
						$topic_name = ! empty( $post_categories ) ? $post_categories[0]->name : __( 'Technology', 'ai-futuretech' );
						?>
						<article class="resource-card<?php echo $resource_index < 2 ? ' resource-card--featured' : ''; ?>" data-post-card data-categories="<?php echo esc_attr( implode( ' ', $post_type_slugs ) ); ?>">
							<div class="resource-card__summary">
								<span class="resource-card__mark" aria-hidden="true"></span>
								<span class="resource-card__topic"><?php echo esc_html( $topic_name ); ?></span>
								<h3 class="resource-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p class="resource-card__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24, '…' ) ); ?></p>
							</div>
							<a class="resource-card__media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
								<img src="<?php echo esc_url( $featured_image ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" loading="lazy" width="720" height="430">
							</a>
							<div class="resource-card__details">
								<div class="resource-card__meta">
									<span><?php esc_html_e( 'Publication date', 'ai-futuretech' ); ?><strong><?php echo esc_html( get_the_date( 'F Y' ) ); ?></strong></span>
									<span><?php esc_html_e( 'Category', 'ai-futuretech' ); ?><strong><?php echo esc_html( $topic_name ); ?></strong></span>
									<span><?php esc_html_e( 'Author', 'ai-futuretech' ); ?><strong><?php echo esc_html( get_the_author() ); ?></strong></span>
								</div>
								<a class="resource-card__link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View resource', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></a>
							</div>
						</article>
						<?php
						$resource_index++;
					endwhile;
					?>
					<p class="resources-page__empty" data-post-empty hidden><?php esc_html_e( 'No resources in this type yet.', 'ai-futuretech' ); ?></p>
				</div>
			<?php else : ?>
				<p class="archive-empty"><?php esc_html_e( 'Resources will appear here as soon as they are published.', 'ai-futuretech' ); ?></p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</section>
		</div>

		<?php get_template_part( 'template-parts/cta' ); ?>
	</div>
</main>
<?php
get_footer();
