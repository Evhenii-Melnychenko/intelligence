<?php
/**
 * Template Name: Podcasts
 */

get_header();
$podcast_category = get_category_by_slug( 'podcasts' );
if ( ! $podcast_category ) {
	$podcast_category = get_category_by_slug( 'podcast' );
}

$podcast_args = array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 6,
	'orderby'             => 'date',
	'order'               => 'DESC',
	'ignore_sticky_posts' => true,
);
if ( $podcast_category ) {
	$podcast_args['cat'] = (int) $podcast_category->term_id;
}

$featured_shows = array();
$featured_ids   = array();
if ( $podcast_category ) {
	$podcast_shows = get_categories( array(
		'taxonomy'   => 'category',
		'parent'     => (int) $podcast_category->term_id,
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	) );

	foreach ( $podcast_shows as $show_category ) {
		$show_episodes = get_posts( array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 1,
			'category__in'        => array( (int) $show_category->term_id ),
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
		) );

		if ( ! empty( $show_episodes ) ) {
			$featured_shows[] = array(
				'category' => $show_category,
				'episode'  => $show_episodes[0],
			);
			$featured_ids[] = (int) $show_episodes[0]->ID;
		}
	}

	if ( empty( $featured_shows ) ) {
		$legacy_episodes = get_posts( array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 2,
			'cat'                 => (int) $podcast_category->term_id,
			'orderby'             => 'date',
			'order'               => 'DESC',
			'ignore_sticky_posts' => true,
		) );
		foreach ( $legacy_episodes as $legacy_episode ) {
			$featured_shows[] = array(
				'category' => $podcast_category,
				'episode'  => $legacy_episode,
			);
			$featured_ids[] = (int) $legacy_episode->ID;
		}
	}

	$podcast_args['post__not_in'] = $featured_ids;
} else {
	$podcast_args['post__in'] = array( 0 );
}
$latest_episodes = get_posts( $podcast_args );
?>
<main id="main-content" class="site-main">
		<header class="podcast-page__hero">
			<div class="site-container podcast-page">
				<div>
					<h1 class="podcast-page__title"><?php the_title(); ?></h1>
					<p class="podcast-page__description"><?php esc_html_e( 'Unlock the world of artificial intelligence through conversations with the thinkers, builders and leaders shaping its future.', 'ai-futuretech' ); ?></p>
				</div>
				<div class="podcast-page__intro"><?php the_content(); ?></div>
			</div>
		</header>
		<div class="site-container podcast-page">
		<?php if ( ! empty( $featured_shows ) ) : ?>
			<?php global $post; ?>
			<section class="podcast-page__featured" aria-label="<?php esc_attr_e( 'Featured podcast episodes', 'ai-futuretech' ); ?>">
				<?php foreach ( $featured_shows as $featured_show ) : ?>
					<?php
						$post = $featured_show['episode'];
						setup_postdata( $post );
						get_template_part( 'template-parts/podcast-episode', null, array(
							'featured'      => true,
							'show_category' => $featured_show['category'],
						) );
					?>
				<?php endforeach; ?>
			</section>
		<?php else : ?>
			<p class="archive-empty"><?php esc_html_e( 'Podcast shows will appear here when you add show categories and publish episodes.', 'ai-futuretech' ); ?></p>
		<?php endif; ?>

		<?php if ( ! empty( $latest_episodes ) ) : ?>
			<section class="podcast-page__episodes" aria-labelledby="podcast-episodes-title">
				<div class="section-heading">
					<div>
						<h2 class="section-heading__title" id="podcast-episodes-title"><?php esc_html_e( 'Latest Podcast Episodes', 'ai-futuretech' ); ?></h2>
					</div>
				</div>
				<div class="podcast-page__grid">
					<?php foreach ( $latest_episodes as $episode_post ) : ?>
						<?php
							$post = $episode_post;
							setup_postdata( $post );
							get_template_part( 'template-parts/podcast-episode', null, array( 'featured' => false ) );
						?>
					<?php endforeach; ?>
				</div>
			</section>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
		</div>
		
		<?php get_template_part( 'template-parts/cta' ); ?>
		
</main>
<?php
get_footer();
