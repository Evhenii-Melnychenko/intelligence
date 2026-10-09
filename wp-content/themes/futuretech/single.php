<?php
get_header();
?>
<main id="main-content" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		$post_id       = get_the_ID();
		$categories    = get_the_category( $post_id );
		$featured_image = get_the_post_thumbnail_url( $post_id, 'full' );
		if ( ! $featured_image ) {
			$featured_image = futuretech_post_fallback_image( $post_id );
		}

		$article_content = apply_filters( 'the_content', get_the_content() );
		$table_of_contents = array();
		$heading_ids = array();
		$article_content = preg_replace_callback(
			'/<h([2-3])([^>]*)>(.*?)<\/h\1>/is',
			function ( $matches ) use ( &$table_of_contents, &$heading_ids ) {
				$heading_text = trim( html_entity_decode( wp_strip_all_tags( $matches[3] ), ENT_QUOTES | ENT_HTML5, get_bloginfo( 'charset' ) ) );
				if ( '' === $heading_text ) {
					return $matches[0];
				}

				$existing_id = '';
				if ( preg_match( '/\bid=(["\'])(.*?)\1/i', $matches[2], $id_match ) ) {
					$existing_id = $id_match[2];
				}
				$base_id = $existing_id ? sanitize_title( $existing_id ) : sanitize_title( $heading_text );
				if ( '' === $base_id ) {
					$base_id = 'section';
				}
				$heading_ids[ $base_id ] = isset( $heading_ids[ $base_id ] ) ? $heading_ids[ $base_id ] + 1 : 1;
				$heading_id = 1 === $heading_ids[ $base_id ] ? $base_id : $base_id . '-' . $heading_ids[ $base_id ];
				$attributes = preg_replace( '/\s+id=(["\']).*?\1/i', '', $matches[2] );

				$table_of_contents[] = array(
					'id'    => $heading_id,
					'title' => $heading_text,
					'level' => (int) $matches[1],
				);

				return '<h' . $matches[1] . $attributes . ' id="' . esc_attr( $heading_id ) . '">' . $matches[3] . '</h' . $matches[1] . '>';
			},
			$article_content
		);
		$word_count      = str_word_count( wp_strip_all_tags( $article_content ) );
		$reading_minutes = max( 1, (int) ceil( $word_count / 200 ) );
		$engagement_counts = array(
			'likes'  => futuretech_get_engagement_count( $post_id, 'likes' ),
			'views'  => futuretech_get_engagement_count( $post_id, 'views' ),
			'shares' => futuretech_get_engagement_count( $post_id, 'shares' ),
		);
		$has_liked = ! empty( $_COOKIE[ 'futuretech_like_' . $post_id ] );

		$related_args = array(
			'post_type'           => 'post',
			'post_status'         => 'publish',
			'posts_per_page'      => 3,
			'post__not_in'        => array( $post_id ),
			'ignore_sticky_posts' => true,
		);
		if ( ! empty( $categories ) ) {
			$related_args['category__in'] = wp_list_pluck( $categories, 'term_id' );
		}
		$related_query = new WP_Query( $related_args );
		if ( ! $related_query->have_posts() && ! empty( $categories ) ) {
			unset( $related_args['category__in'] );
			$related_query = new WP_Query( $related_args );
		}
		?>
		<article <?php post_class( 'single-article' ); ?>>
			<header class="single-article__hero">
				<img class="single-article__hero-image" src="<?php echo esc_url( $featured_image ); ?>" alt="" width="1600" height="600" fetchpriority="high">
				<div class="site-container single-article__hero-content">
					<h1 class="single-article__title"><?php the_title(); ?></h1>
				</div>
			</header>

			<div class="site-container single-article__layout">
				<div class="single-article__main">
					<div class="single-article__content">
						<?php if ( has_excerpt() ) : ?>
							<p class="single-article__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
						<?php endif; ?>
						<div class="single-article__read-more" data-article-read-more>
							<div class="single-article__body" id="single-article-body">
								<?php echo $article_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php
								wp_link_pages(
									array(
										'before' => '<nav class="single-article__page-links">' . esc_html__( 'Pages:', 'ai-futuretech' ),
										'after'  => '</nav>',
									)
								);
								?>
							</div>
							<button class="single-article__read-more-button" type="button" data-article-read-more-toggle data-collapsed-label="<?php esc_attr_e( 'Read Full Blog', 'ai-futuretech' ); ?>" data-expanded-label="<?php esc_attr_e( 'Show Less', 'ai-futuretech' ); ?>" aria-controls="single-article-body" aria-expanded="false" hidden>
								<span data-article-read-more-label><?php esc_html_e( 'Read Full Blog', 'ai-futuretech' ); ?></span>
								<span class="single-article__read-more-arrow" aria-hidden="true">↓</span>
							</button>
						</div>
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
				</div>

				<aside class="single-article__sidebar">
					<div class="single-article__engagement" data-post-engagement data-post-id="<?php echo esc_attr( $post_id ); ?>">
						<button class="single-article__engagement-action<?php echo $has_liked ? ' is-active' : ''; ?>" type="button" data-engagement-action="like" aria-label="<?php esc_attr_e( 'Like this article', 'ai-futuretech' ); ?>" aria-pressed="<?php echo $has_liked ? 'true' : 'false'; ?>">
							<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.7l-1.1-1.1a5.5 5.5 0 0 0-7.8 7.8l1.1 1.1L12 21l7.8-7.5 1.1-1.1a5.5 5.5 0 0 0-.1-7.8Z"/></svg>
							<span data-engagement-count="like"><?php echo esc_html( futuretech_format_engagement_count( $engagement_counts['likes'] ) ); ?></span>
						</button>
						<span class="single-article__engagement-stat" aria-label="<?php esc_attr_e( 'Views', 'ai-futuretech' ); ?>">
							<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M2 12s3.6-7 10-7 10 7 10 7-3.6 7-10 7S2 12 2 12Z"/><circle cx="12" cy="12" r="3"/></svg>
							<span data-engagement-count="view"><?php echo esc_html( futuretech_format_engagement_count( $engagement_counts['views'] ) ); ?></span>
						</span>
						<button class="single-article__engagement-action" type="button" data-engagement-action="share" aria-label="<?php esc_attr_e( 'Share this article', 'ai-futuretech' ); ?>">
							<svg viewBox="0 0 24 24" aria-hidden="true"><path d="m22 2-7 20-4-9-9-4 20-7Z"/><path d="M22 2 11 13"/></svg>
							<span data-engagement-count="share"><?php echo esc_html( futuretech_format_engagement_count( $engagement_counts['shares'] ) ); ?></span>
						</button>
						<span class="screen-reader-text" role="status" aria-live="polite" data-engagement-status></span>
					</div>
					<div class="single-article__metadata">
						<div><span><?php esc_html_e( 'Publication date', 'ai-futuretech' ); ?></span><strong><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></strong></div>
						<div><span><?php esc_html_e( 'Category', 'ai-futuretech' ); ?></span><strong><?php echo ! empty( $categories ) ? esc_html( $categories[0]->name ) : esc_html__( 'Technology', 'ai-futuretech' ); ?></strong></div>
						<div><span><?php esc_html_e( 'Reading time', 'ai-futuretech' ); ?></span><strong><?php echo esc_html( sprintf( _n( '%d min', '%d min', $reading_minutes, 'ai-futuretech' ), $reading_minutes ) ); ?></strong></div>
						<div><span><?php esc_html_e( 'Author', 'ai-futuretech' ); ?></span><strong><?php echo esc_html( get_the_author() ); ?></strong></div>
					</div>
					<?php if ( ! empty( $table_of_contents ) ) : ?>
						<nav class="single-article__toc" aria-label="<?php esc_attr_e( 'Table of contents', 'ai-futuretech' ); ?>">
							<h2><?php esc_html_e( 'Table of Contents', 'ai-futuretech' ); ?></h2>
							<ul>
								<?php foreach ( $table_of_contents as $item ) : ?>
									<li class="single-article__toc-item--level-<?php echo esc_attr( $item['level'] ); ?>"><a href="<?php echo esc_url( '#' . $item['id'] ); ?>"><?php echo esc_html( $item['title'] ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</nav>
					<?php endif; ?>
				</aside>
			</div>
		</article>

		<?php if ( $related_query->have_posts() ) : ?>
			<section class="single-article__related" aria-labelledby="single-article-related-title">
				<div class="site-container">
					<header class="single-article__related-header">
						<h2 id="single-article-related-title"><?php esc_html_e( 'Similar News', 'ai-futuretech' ); ?></h2>
						<a href="<?php echo esc_url( futuretech_page_url( 'news' ) ); ?>"><?php esc_html_e( 'View All News', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></a>
					</header>
					<div class="single-article__related-grid">
						<?php
						while ( $related_query->have_posts() ) :
							$related_query->the_post();
							$related_image = get_the_post_thumbnail_url( get_the_ID(), 'futuretech-card' );
							if ( ! $related_image ) {
								$related_image = futuretech_post_fallback_image( get_the_ID() );
							}
							$related_categories = get_the_category();
							?>
							<article class="single-article__related-card">
								<a class="single-article__related-media" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
									<img src="<?php echo esc_url( $related_image ); ?>" alt="" loading="lazy" width="720" height="430">
								</a>
								<div class="single-article__related-meta">
									<span><?php echo ! empty( $related_categories ) ? esc_html( $related_categories[0]->name ) : esc_html__( 'Technology', 'ai-futuretech' ); ?></span>
									<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
								</div>
								<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
								<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 14, '…' ) ); ?></p>
								<a class="single-article__related-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></a>
							</article>
						<?php endwhile; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	<?php endwhile; ?>
	<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php
get_footer();
