<?php
$ebook_readers = array( 'emily.png', 'diego.png', 'alan.png', 'jessica.png' );
$resource_url  = futuretech_page_url( 'resources' );
?>
<section class="resource-feature resource-feature--ebooks" aria-labelledby="ebooks-title">
	<div class="resource-feature__intro">
		<img
			class="resource-feature__icon"
			src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/ebooks.svg' ) ); ?>"
			alt=""
			width="50"
			height="50"
			loading="lazy"
		>
		<h3><?php esc_html_e( 'Ebooks', 'ai-futuretech' ); ?></h3>
		<p>
			<?php esc_html_e( 'Explore our collection of ebooks covering a wide spectrum of future technology topics.', 'ai-futuretech' ); ?>
		</p>
		<a class="resource-feature__download" href="<?php echo esc_url( $resource_url ); ?>">
			<?php esc_html_e( 'Download Ebooks Now', 'ai-futuretech' ); ?>
			<span aria-hidden="true">↗</span>
		</a>

		<div class="resource-feature__downloads">
			<div class="resource-feature__downloads-copy">
				<span><?php esc_html_e( 'Downloaded By', 'ai-futuretech' ); ?></span>
				<strong><?php esc_html_e( '10k+ Users', 'ai-futuretech' ); ?></strong>
			</div>
			<div class="resource-feature__avatars" aria-hidden="true">
				<?php foreach ( $ebook_readers as $reader_avatar ) : ?>
					<img
						src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/readers/' . $reader_avatar ) ); ?>"
						alt=""
						width="32"
						height="32"
						loading="lazy"
					>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

	<div class="resource-feature__details">
		<div class="resource-feature__coverage">
			<h4><?php esc_html_e( 'Variety of Topics', 'ai-futuretech' ); ?></h4>
			<p><?php esc_html_e( 'Topics include AI in education (25%), renewable energy (20%), healthcare (15%), space exploration (25%), and biotechnology (15%).', 'ai-futuretech' ); ?></p>
		</div>

		<img
			class="resource-feature__image"
			src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/ebooks/topics.png' ) ); ?>"
			alt="<?php esc_attr_e( 'A student exploring an ebook with a virtual reality headset', 'ai-futuretech' ); ?>"
			width="920"
			height="460"
			loading="lazy"
		>

		<div class="resource-feature__stats">
			<div class="resource-feature__stat">
				<span class="resource-feature__stat-label"><?php esc_html_e( 'Total Ebooks', 'ai-futuretech' ); ?></span>
				<strong><?php esc_html_e( 'Over 100 ebooks', 'ai-futuretech' ); ?></strong>
			</div>
			<div class="resource-feature__stat resource-feature__stat--formats">
				<div>
					<span class="resource-feature__stat-label"><?php esc_html_e( 'Download Formats', 'ai-futuretech' ); ?></span>
					<strong><?php esc_html_e( 'PDF format for access.', 'ai-futuretech' ); ?></strong>
				</div>
				<a class="resource-feature__preview" href="<?php echo esc_url( $resource_url ); ?>">
					<?php esc_html_e( 'Preview', 'ai-futuretech' ); ?>
					<svg aria-hidden="true" viewBox="0 0 16 16" focusable="false">
						<path d="M1.5 8s2.3-4 6.5-4 6.5 4 6.5 4-2.3 4-6.5 4S1.5 8 1.5 8Z" fill="none" stroke="currentColor" stroke-width="1.2"/>
						<circle cx="8" cy="8" r="1.8" fill="none" stroke="currentColor" stroke-width="1.2"/>
					</svg>
				</a>
			</div>
		</div>

		<div class="resource-feature__expertise">
			<span class="resource-feature__stat-label"><?php esc_html_e( 'Average Author Expertise', 'ai-futuretech' ); ?></span>
			<p><?php esc_html_e( 'Ebooks are authored by renowned experts with an average of 15 years of experience.', 'ai-futuretech' ); ?></p>
		</div>
	</div>
</section>
