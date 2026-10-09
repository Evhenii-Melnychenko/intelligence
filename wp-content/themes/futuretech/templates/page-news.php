<?php
/**
 * Template Name: News
 */

get_header();

$news_podcast_category = get_category_by_slug( 'podcasts' );
if ( ! $news_podcast_category ) {
	$news_podcast_category = get_category_by_slug( 'podcast' );
}
$news_podcast_children = $news_podcast_category
	? get_term_children( (int) $news_podcast_category->term_id, 'category' )
	: array();
if ( is_wp_error( $news_podcast_children ) ) {
	$news_podcast_children = array();
}
$news_excluded_categories = $news_podcast_category
	? array_merge( array( (int) $news_podcast_category->term_id ), $news_podcast_children )
	: array();
$news_posts = get_posts(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 8,
		'ignore_sticky_posts' => true,
		'category__not_in'    => $news_excluded_categories,
	)
);
$news_categories = get_categories(
	array(
		'hide_empty' => true,
		'exclude'    => $news_excluded_categories,
		'number'     => 8,
		'orderby'    => 'count',
		'order'      => 'DESC',
	)
);
$news_page_number = max( 1, (int) get_query_var( 'paged' ) );
$news_feed = new WP_Query(
	array(
		'post_type'           => 'post',
		'post_status'         => 'publish',
		'posts_per_page'      => 6,
		'paged'               => $news_page_number,
		'ignore_sticky_posts' => true,
		'category__not_in'    => $news_excluded_categories,
	)
);
?>
<main id="main-content" class="site-main news-page">
	<section class="site-container news-page__top" aria-labelledby="news-page-title">
		<header class="news-page__intro">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Newsroom', 'ai-futuretech' ); ?></span>
				<h1 id="news-page-title"><?php esc_html_e( 'Today’s Headlines: Stay Informed', 'ai-futuretech' ); ?></h1>
			</div>
			<p><?php esc_html_e( 'The latest stories, perspectives and visual insights from across the world of technology.', 'ai-futuretech' ); ?></p>
		</header>

		<?php if ( ! empty( $news_posts ) ) : ?>
			<?php
			$news_featured_post = $news_posts[0];
			$news_featured_image = get_the_post_thumbnail_url( $news_featured_post->ID, 'futuretech-card' );
			if ( ! $news_featured_image ) {
				$news_featured_image = futuretech_post_fallback_image( $news_featured_post->ID );
			}
			$news_featured_categories = get_the_category( $news_featured_post->ID );
			?>
			<article class="news-page__lead">
				<a class="news-page__lead-media" href="<?php echo esc_url( get_permalink( $news_featured_post ) ); ?>" tabindex="-1" aria-hidden="true">
					<img src="<?php echo esc_url( $news_featured_image ); ?>" alt="" width="720" height="430" fetchpriority="high">
				</a>
				<div class="news-page__lead-content">
					<h2><a href="<?php echo esc_url( get_permalink( $news_featured_post ) ); ?>"><?php echo esc_html( get_the_title( $news_featured_post ) ); ?></a></h2>
					<p><?php echo esc_html( wp_trim_words( get_the_excerpt( $news_featured_post ), 34, '…' ) ); ?></p>
					<div class="news-page__meta">
						<span><?php echo ! empty( $news_featured_categories ) ? esc_html( $news_featured_categories[0]->name ) : esc_html__( 'Technology', 'ai-futuretech' ); ?></span>
						<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C, $news_featured_post ) ); ?>"><?php echo esc_html( get_the_date( 'F j, Y', $news_featured_post ) ); ?></time>
						<span><?php echo esc_html( get_the_author_meta( 'display_name', (int) $news_featured_post->post_author ) ); ?></span>
					</div>
					<a class="news-page__read-link" href="<?php echo esc_url( get_permalink( $news_featured_post ) ); ?>"><?php esc_html_e( 'Read More', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></a>
				</div>
			</article>

			<?php if ( count( $news_posts ) > 1 ) : ?>
				<div class="news-page__top-stories" aria-label="<?php esc_attr_e( 'More top stories', 'ai-futuretech' ); ?>">
					<?php foreach ( array_slice( $news_posts, 1, 3 ) as $news_post ) : ?>
						<?php
						$story_image = get_the_post_thumbnail_url( $news_post->ID, 'futuretech-card' );
						if ( ! $story_image ) {
							$story_image = futuretech_post_fallback_image( $news_post->ID );
						}
						$story_categories = get_the_category( $news_post->ID );
						?>
						<article class="news-page__story-card">
							<a class="news-page__story-media" href="<?php echo esc_url( get_permalink( $news_post ) ); ?>" tabindex="-1" aria-hidden="true">
								<img src="<?php echo esc_url( $story_image ); ?>" alt="" width="720" height="430" loading="lazy">
							</a>
							<h3><a href="<?php echo esc_url( get_permalink( $news_post ) ); ?>"><?php echo esc_html( get_the_title( $news_post ) ); ?></a></h3>
							<div class="news-page__meta">
								<span><?php echo ! empty( $story_categories ) ? esc_html( $story_categories[0]->name ) : esc_html__( 'Technology', 'ai-futuretech' ); ?></span>
								<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C, $news_post ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y', $news_post ) ); ?></time>
							</div>
							<a class="news-page__read-link" href="<?php echo esc_url( get_permalink( $news_post ) ); ?>"><?php esc_html_e( 'Read story', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></a>
						</article>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		<?php else : ?>
			<p class="archive-empty"><?php esc_html_e( 'New headlines are on the way. Check back soon.', 'ai-futuretech' ); ?></p>
		<?php endif; ?>
	</section>

	<section class="news-page__feed-section" aria-labelledby="news-feed-title">
		<div class="site-container">
			<header class="news-page__section-heading">
				<div>
					<span class="eyebrow"><?php esc_html_e( 'Latest updates', 'ai-futuretech' ); ?></span>
					<h2 id="news-feed-title"><?php esc_html_e( 'Discover the World of Headlines', 'ai-futuretech' ); ?></h2>
				</div>
				<a href="<?php echo esc_url( futuretech_get_posts_page_url() ); ?>"><?php esc_html_e( 'Explore the blog', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></a>
			</header>

			<div class="news-page__filters" role="tablist" aria-label="<?php esc_attr_e( 'Filter headlines by category', 'ai-futuretech' ); ?>" data-post-filters>
				<button id="news-tab-all" type="button" role="tab" aria-selected="true" aria-controls="news-feed" tabindex="0" data-post-filter="all"><?php esc_html_e( 'All headlines', 'ai-futuretech' ); ?></button>
				<?php foreach ( $news_categories as $news_category ) : ?>
					<button id="<?php echo esc_attr( 'news-tab-' . $news_category->slug ); ?>" type="button" role="tab" aria-selected="false" aria-controls="news-feed" tabindex="-1" data-post-filter="<?php echo esc_attr( $news_category->slug ); ?>"><?php echo esc_html( $news_category->name ); ?></button>
				<?php endforeach; ?>
			</div>

			<?php if ( $news_feed->have_posts() ) : ?>
				<div class="news-page__feed" id="news-feed" role="tabpanel" aria-labelledby="news-tab-all" data-post-grid aria-live="polite">
					<?php
					while ( $news_feed->have_posts() ) :
						$news_feed->the_post();
						$feed_categories = get_the_category();
						$feed_slugs = futuretech_post_category_slugs( get_the_ID() );
						$author_id = (int) get_post_field( 'post_author', get_the_ID() );
						$author_images = array( 'alex.png', 'john.png', 'sarah.png' );
						$author_image = get_theme_file_uri( '/assets/images/news/authors/' . $author_images[ $author_id % count( $author_images ) ] );
						?>
						<article class="news-page__feed-item" data-post-card data-categories="<?php echo esc_attr( implode( ' ', $feed_slugs ) ); ?>">
							<img class="news-page__avatar" src="<?php echo esc_url( $author_image ); ?>" alt="" width="40" height="40" loading="lazy">
							<div class="news-page__feed-copy">
								<div class="news-page__meta">
									<span><?php echo ! empty( $feed_categories ) ? esc_html( $feed_categories[0]->name ) : esc_html__( 'Technology', 'ai-futuretech' ); ?></span>
									<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></time>
								</div>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 28, '…' ) ); ?></p>
							</div>
							<a class="news-page__feed-link" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read %s', 'ai-futuretech' ), get_the_title() ) ); ?>">↗</a>
						</article>
					<?php endwhile; ?>
				</div>
				<nav class="site-pagination" aria-label="<?php esc_attr_e( 'Headline pages', 'ai-futuretech' ); ?>">
					<?php
					echo wp_kses_post(
						paginate_links(
							array(
								'total'     => $news_feed->max_num_pages,
								'current'   => $news_page_number,
								'prev_text' => __( '← Previous', 'ai-futuretech' ),
								'next_text' => __( 'Next →', 'ai-futuretech' ),
								'type'      => 'plain',
							)
						)
					);
					?>
				</nav>
			<?php else : ?>
				<p class="archive-empty"><?php esc_html_e( 'No headlines are available yet.', 'ai-futuretech' ); ?></p>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		</div>
	</section>

	<?php if ( ! empty( $news_posts ) ) : ?>
		<section class="site-container news-page__visual-section" aria-labelledby="news-visual-title">
			<header class="news-page__section-heading">
				<div>
					<span class="eyebrow"><?php esc_html_e( 'Stories in pictures', 'ai-futuretech' ); ?></span>
					<h2 id="news-visual-title"><?php esc_html_e( 'Visual Insights for the Modern Viewer', 'ai-futuretech' ); ?></h2>
				</div>
				<a href="<?php echo esc_url( futuretech_get_posts_page_url() ); ?>"><?php esc_html_e( 'View all stories', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></a>
			</header>
			<div class="news-page__visual-grid">
				<?php foreach ( array_slice( $news_posts, 0, 4 ) as $visual_post ) : ?>
					<?php
					$visual_image = get_the_post_thumbnail_url( $visual_post->ID, 'futuretech-card' );
					if ( ! $visual_image ) {
						$visual_image = futuretech_post_fallback_image( $visual_post->ID );
					}
					$visual_categories = get_the_category( $visual_post->ID );
					?>
					<article class="news-page__visual-card">
						<a class="news-page__visual-media" href="<?php echo esc_url( get_permalink( $visual_post ) ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'Read visual story: %s', 'ai-futuretech' ), get_the_title( $visual_post ) ) ); ?>">
							<img src="<?php echo esc_url( $visual_image ); ?>" alt="" width="720" height="430" loading="lazy">
							<span aria-hidden="true">↗</span>
						</a>
						<div class="news-page__meta">
							<span><?php echo ! empty( $visual_categories ) ? esc_html( $visual_categories[0]->name ) : esc_html__( 'Technology', 'ai-futuretech' ); ?></span>
							<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C, $visual_post ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y', $visual_post ) ); ?></time>
						</div>
						<h3><a href="<?php echo esc_url( get_permalink( $visual_post ) ); ?>"><?php echo esc_html( get_the_title( $visual_post ) ); ?></a></h3>
					</article>
				<?php endforeach; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php
get_footer();
