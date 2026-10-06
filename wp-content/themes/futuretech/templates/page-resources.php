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
$resource_categories = get_categories( array(
	'hide_empty' => true,
	'number'     => 7,
	'orderby'    => 'count',
	'order'      => 'DESC',
) );
?>
<main id="main-content" class="site-main">
	<div class="site-container resources-page">
		<header class="resources-page__hero">
			<span class="eyebrow"><?php esc_html_e( 'Guides, research and ideas', 'ai-futuretech' ); ?></span>
			<h1 class="resources-page__title"><?php the_title(); ?></h1>
			<div class="resources-page__description"><?php the_content(); ?></div>
		</header>

		<section aria-label="<?php esc_attr_e( 'Browse resources', 'ai-futuretech' ); ?>">
			<?php if ( $resource_query->have_posts() ) : ?>
				<div class="resources-page__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Filter resources by category', 'ai-futuretech' ); ?>" aria-controls="resource-grid" data-post-filters>
					<button id="resources-tab-all" class="category-list__button" type="button" role="tab" aria-selected="true" aria-controls="resource-grid" tabindex="0" data-post-filter="all"><?php esc_html_e( 'All resources', 'ai-futuretech' ); ?></button>
					<?php foreach ( $resource_categories as $category ) : ?>
						<button id="<?php echo esc_attr( 'resources-tab-' . $category->slug ); ?>" class="category-list__button" type="button" role="tab" aria-selected="false" aria-controls="resource-grid" tabindex="-1" data-post-filter="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></button>
					<?php endforeach; ?>
				</div>
				<div class="post-grid resources-page__grid" id="resource-grid" role="tabpanel" aria-labelledby="resources-tab-all" data-post-grid aria-live="polite">
					<?php
					while ( $resource_query->have_posts() ) :
						$resource_query->the_post();
						get_template_part( 'template-parts/post-card' );
					endwhile;
					?>
					<p class="post-grid__empty" data-post-empty hidden><?php esc_html_e( 'No resources in this category yet.', 'ai-futuretech' ); ?></p>
				</div>
			<?php else : ?>
				<p class="archive-empty"><?php esc_html_e( 'Resources will appear here as soon as they are published.', 'ai-futuretech' ); ?></p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</section>

		<div class="resources-page__cta"><?php get_template_part( 'template-parts/cta' ); ?></div>
	</div>
</main>
<?php
get_footer();
