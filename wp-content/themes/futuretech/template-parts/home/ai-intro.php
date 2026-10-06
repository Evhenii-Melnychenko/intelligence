<section class="site-container ai-intro" aria-label="<?php esc_attr_e( 'About FutureTech AI News', 'ai-futuretech' ); ?>">
	<div class="ai-intro__main">
		<div class="ai-intro__lead">
			<header class="ai-intro__header">
				<span class="ai-intro__eyebrow">
					<?php esc_html_e( 'Your Journey to Tomorrow Begins Here', 'ai-futuretech' ); ?>
				</span>
				<h1><?php esc_html_e( 'Explore the Frontiers of Artificial Intelligence', 'ai-futuretech' ); ?></h1>
				<p class="ai-intro__description">
					<?php esc_html_e( 'Welcome to the epicenter of AI innovation. FutureTech AI News is your passport to a world where machines think, learn, and reshape the future. Join us on this visionary expedition into the heart of AI.', 'ai-futuretech' ); ?>
				</p>
			</header>

			<dl class="ai-intro__stats">
				<div class="ai-intro__stat">
					<dt class="ai-intro__stat-value">300<span>+</span></dt>
					<dd class="ai-intro__stat-label"><?php esc_html_e( 'Resources available', 'ai-futuretech' ); ?></dd>
				</div>
				<div class="ai-intro__stat">
					<dt class="ai-intro__stat-value">12k<span>+</span></dt>
					<dd class="ai-intro__stat-label"><?php esc_html_e( 'Total downloads', 'ai-futuretech' ); ?></dd>
				</div>
				<div class="ai-intro__stat">
					<dt class="ai-intro__stat-value">10k<span>+</span></dt>
					<dd class="ai-intro__stat-label"><?php esc_html_e( 'Active users', 'ai-futuretech' ); ?></dd>
				</div>
			</dl>
		</div>

		<aside class="ai-intro__resources" aria-labelledby="ai-intro-resources-title">
			<div class="ai-intro__avatars" aria-hidden="true">
				<?php foreach ( array( 'alan', 'emily', 'raj', 'sarah' ) as $reader ) : ?>
					<img class="ai-intro__avatar" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/readers/' . $reader . '.png' ) ); ?>" alt="" width="40" height="40">
				<?php endforeach; ?>
			</div>
			<h3><?php esc_html_e( 'Explore 1000+ resources', 'ai-futuretech' ); ?></h3>
			<p class="ai-intro__resources-description"><?php esc_html_e( 'Over 1,000 articles on emerging tech trends and breakthroughs.', 'ai-futuretech' ); ?></p>
			<a class="ai-intro__resources-link" href="<?php echo esc_url( futuretech_page_url( 'resources' ) ); ?>">
				<?php esc_html_e( 'Explore Resources', 'ai-futuretech' ); ?>
				<span aria-hidden="true">↗</span>
			</a>
		</aside>
	</div>

	<div class="ai-intro__highlights">
		<article class="ai-intro__highlight">
			<img class="ai-intro__icon" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/icons/icon-1.svg' ) ); ?>" alt="" width="32" height="32">
			<div class="ai-intro__highlight-content">
				<h4><?php esc_html_e( 'Latest News Updates', 'ai-futuretech' ); ?></h4>
				<p><?php esc_html_e( 'Stay Current', 'ai-futuretech' ); ?></p>
				<p class="ai-intro__highlight-description"><?php esc_html_e( 'Over 1,000 articles published monthly', 'ai-futuretech' ); ?></p>
			</div>
			<a class="ai-intro__highlight-link" href="<?php echo esc_url( futuretech_get_posts_page_url() ); ?>" aria-label="<?php esc_attr_e( 'Explore latest news updates', 'ai-futuretech' ); ?>"><span aria-hidden="true">↗</span></a>
		</article>

		<article class="ai-intro__highlight">
			<img class="ai-intro__icon" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/icons/icon-3.svg' ) ); ?>" alt="" width="32" height="32">
			<div class="ai-intro__highlight-content">
				<h4><?php esc_html_e( 'Expert Contributors', 'ai-futuretech' ); ?></h4>
				<p><?php esc_html_e( 'Trusted Insights', 'ai-futuretech' ); ?></p>
				<p class="ai-intro__highlight-description"><?php esc_html_e( '50+ renowned AI experts on our team', 'ai-futuretech' ); ?></p>
			</div>
			<a class="ai-intro__highlight-link" href="<?php echo esc_url( futuretech_get_posts_page_url() ); ?>" aria-label="<?php esc_attr_e( 'Meet our expert contributors', 'ai-futuretech' ); ?>"><span aria-hidden="true">↗</span></a>
		</article>

		<article class="ai-intro__highlight">
			<img class="ai-intro__icon" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/icons/icon-2.svg' ) ); ?>" alt="" width="32" height="32">
			<div class="ai-intro__highlight-content">
				<h4><?php esc_html_e( 'Global Readership', 'ai-futuretech' ); ?></h4>
				<p><?php esc_html_e( 'Worldwide Impact', 'ai-futuretech' ); ?></p>
				<p class="ai-intro__highlight-description"><?php esc_html_e( '2 million monthly readers', 'ai-futuretech' ); ?></p>
			</div>
			<a class="ai-intro__highlight-link" href="<?php echo esc_url( futuretech_get_posts_page_url() ); ?>" aria-label="<?php esc_attr_e( 'Read stories for our global community', 'ai-futuretech' ); ?>"><span aria-hidden="true">↗</span></a>
		</article>
	</div>
</section>