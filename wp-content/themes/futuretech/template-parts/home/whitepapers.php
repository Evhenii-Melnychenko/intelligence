<?php
$whitepapers_readers = array( 'sarah.png', 'raj.png', 'emily.png', 'jessica.png' );
$resource_url        = futuretech_page_url( 'resources' );
?>
<section class="resource-feature resource-feature--whitepapers" aria-labelledby="whitepapers-title">
	<div class="resource-feature__intro">
		<img
			class="resource-feature__icon"
			src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/whitepapers.svg' ) ); ?>"
			alt=""
			width="50"
			height="50"
			loading="lazy"
		>
		<h3><?php esc_html_e( 'Whitepapers', 'ai-futuretech' ); ?></h3>
		<p>
			<?php esc_html_e( 'Dive into comprehensive reports and analyses with our collection of whitepapers.', 'ai-futuretech' ); ?>
		</p>
		<a class="resource-feature__download" href="<?php echo esc_url( $resource_url ); ?>">
			<?php esc_html_e( 'Download Whitepapers Now', 'ai-futuretech' ); ?>
			<span aria-hidden="true">↗</span>
		</a>

		<div class="resource-feature__downloads">
			<div class="resource-feature__downloads-copy">
				<span><?php esc_html_e( 'Downloaded By', 'ai-futuretech' ); ?></span>
				<strong><?php esc_html_e( '10k+ Users', 'ai-futuretech' ); ?></strong>
			</div>
			<div class="resource-feature__avatars" aria-hidden="true">
				<?php foreach ( $whitepapers_readers as $reader_avatar ) : ?>
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
			<h4><?php esc_html_e( 'Topics Coverage', 'ai-futuretech' ); ?></h4>
			<p><?php esc_html_e( 'Whitepapers cover quantum computing (20%), AI ethics (15%), space mining prospects (20%), AI in healthcare (15%), and renewable energy strategies (30%).', 'ai-futuretech' ); ?></p>
		</div>

		<img
			class="resource-feature__image"
			src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/whitepapers/coverage.png' ) ); ?>"
			alt="<?php esc_attr_e( 'A hand exploring a glowing digital network', 'ai-futuretech' ); ?>"
			width="920"
			height="460"
			loading="lazy"
		>

		<div class="resource-feature__stats">
			<div class="resource-feature__stat">
				<span class="resource-feature__stat-label"><?php esc_html_e( 'Total Whitepapers', 'ai-futuretech' ); ?></span>
				<strong><?php esc_html_e( 'Over 50 whitepapers', 'ai-futuretech' ); ?></strong>
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
			<p><?php esc_html_e( 'Whitepapers are authored by subject matter experts with an average of 20 years of experience.', 'ai-futuretech' ); ?></p>
		</div>
	</div>
</section>
