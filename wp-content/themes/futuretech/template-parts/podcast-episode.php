<?php
	$is_featured  = ! empty( $args['featured'] );
	$episode_id   = get_the_ID();
	$show_category = isset( $args['show_category'] ) ? $args['show_category'] : null;
	$episode_image = get_the_post_thumbnail_url( $episode_id, 'futuretech-card' );
	$categories   = array_filter(
		get_the_category( $episode_id ),
		function ( $category ) use ( $show_category ) {
			return (
				! in_array( $category->slug, array( 'podcast', 'podcasts', 'uncategorized' ), true ) &&
				( ! $show_category || (int) $category->term_id !== (int) $show_category->term_id )
			);
		}
	);
	$category_name = $show_category ? $show_category->name : ( ! empty( $categories ) ? reset( $categories )->name : __( 'Podcast', 'ai-futuretech' ) );
	$host = $show_category ? get_term_meta( $show_category->term_id, 'futuretech_podcast_host', true ) : '';
	$rating = $show_category ? get_term_meta( $show_category->term_id, 'futuretech_podcast_rating', true ) : '';
	$listen_url = $show_category ? get_term_meta( $show_category->term_id, 'futuretech_podcast_listen_url', true ) : '';
	$episode_total = $show_category ? (int) $show_category->count : 0;
	$average_length = $show_category ? get_term_meta( $show_category->term_id, 'futuretech_podcast_average_length', true ) : '';
	$release_frequency = $show_category ? get_term_meta( $show_category->term_id, 'futuretech_podcast_release_frequency', true ) : '';

	if ( ! $episode_image ) {
		$episode_image = futuretech_post_fallback_image( $episode_id );
	}

	if ( ! $host ) {
		$host = get_the_author();
	}

	if ( '' === $rating ) {
		$rating = 5;
	}

	if ( ! $listen_url ) {
		$listen_url = get_permalink( $episode_id );
}
?>
<article <?php post_class( 'podcast-episode' . ( $is_featured ? ' podcast-episode--featured' : '' ) ); ?>>
	<?php if ( $is_featured ) : ?>
		<div class="podcast-episode__show">
			<div class="podcast-episode__show-mark" aria-hidden="true"><span></span><span></span></div>
			<div class="podcast-episode__show-heading">
				<h3><?php echo esc_html( $category_name ); ?></h3>
				<div class="podcast-episode__rating" role="img" aria-label="<?php echo esc_attr( sprintf( __( '%s out of 5 stars', 'ai-futuretech' ), number_format_i18n( $rating, 1 ) ) ); ?>">
					<?php for ( $star = 1; $star <= 5; $star++ ) : ?>
						<span class="<?php echo $star <= (float) $rating ? 'is-active' : ''; ?>" aria-hidden="true">★</span>
					<?php endfor; ?>
				</div>
			</div>
			<div class="podcast-episode__show-footer">
				<div class="podcast-episode__host">
					<span><?php esc_html_e( 'Host', 'ai-futuretech' ); ?></span>
					<strong><?php echo esc_html( $host ); ?></strong>
				</div>
				<a class="podcast-episode__listen" href="<?php echo esc_url( $listen_url ); ?>" <?php echo $listen_url !== get_permalink( $episode_id ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
					<?php esc_html_e( 'Listen Podcast', 'ai-futuretech' ); ?>
					<span aria-hidden="true">↗</span>
				</a>
			</div>
		</div>
	<?php endif; ?>

	<div class="podcast-episode__content">
		<a class="podcast-episode__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View episode: %s', 'ai-futuretech' ), get_the_title() ) ); ?>">
			<img src="<?php echo esc_url( $episode_image ); ?>" alt="" loading="lazy" width="720" height="430">
			<span class="podcast-episode__play" aria-hidden="true">▶</span>
		</a>
		<div class="podcast-episode__details">
			<?php if ( ! $is_featured ) : ?>
				<div class="podcast-episode__meta">
					<span class="podcast-episode__category"><?php echo esc_html( $category_name ); ?></span>
					<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></time>
				</div>
			<?php endif; ?>
			<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), $is_featured ? 26 : 18, '…' ) ); ?></p>
			<?php if ( $is_featured ) : ?>
				<?php
				$episode_stats = array(
					__( 'Total Episodes', 'ai-futuretech' )       => number_format_i18n( $episode_total ),
					__( 'Average Episode Length', 'ai-futuretech' ) => $average_length,
					__( 'Release Frequency', 'ai-futuretech' )    => $release_frequency,
				);
				$has_episode_stats = (bool) array_filter( $episode_stats );
				?>
				<?php if ( $has_episode_stats ) : ?>
					<dl class="podcast-episode__stats">
						<?php foreach ( $episode_stats as $stat_label => $stat_value ) : ?>
							<?php if ( $stat_value ) : ?>
								<div class="podcast-episode__stat">
									<dt><?php echo esc_html( $stat_label ); ?></dt>
									<dd><?php echo esc_html( $stat_value ); ?></dd>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					</dl>
				<?php endif; ?>
			<?php else : ?>
				<a class="podcast-episode__more" href="<?php the_permalink(); ?>">
					<?php esc_html_e( 'Listen to episode', 'ai-futuretech' ); ?>
					<span aria-hidden="true">↗</span>
				</a>
			<?php endif; ?>
		</div>
	</div>
</article>
