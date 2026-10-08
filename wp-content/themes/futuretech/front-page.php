<?php
/**
 * Template Name: Front Page
 */

get_header();

$home_posts = new WP_Query( array(
	'post_type'           => 'post',
	'post_status'         => 'publish',
	'posts_per_page'      => 9,
	'ignore_sticky_posts' => true,
) );

$home_categories = get_categories( array(
	'hide_empty' => true,
	'number'     => 6,
	'orderby'    => 'count',
	'order'      => 'DESC',
) );
?>
<main id="main-content" class="site-main">

	<?php get_template_part( 'template-parts/home/ai-intro' ); ?>

	<?php get_template_part( 'template-parts/home/futuretech-features' ); ?>

	<?php if ( ! empty( $home_categories ) ) : ?>
		<section class="home-section home-section--topics" aria-label="<?php esc_attr_e( 'Explore topics', 'ai-futuretech' ); ?>">
			<div class="site-container home-topics">
				<span class="home-topics__label"><?php esc_html_e( 'Explore topics', 'ai-futuretech' ); ?></span>
				<ul class="category-list">
					<?php foreach ( $home_categories as $category ) : ?>
						<li><a class="category-list__link" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</section>
	<?php endif; ?>

	<section class="site-container home-section home-articles" id="latest-stories" aria-labelledby="latest-stories-title">
		<div class="section-heading">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'The latest', 'ai-futuretech' ); ?></span>
				<h2 class="section-heading__title" id="latest-stories-title"><?php esc_html_e( 'Stories for what comes next', 'ai-futuretech' ); ?></h2>
				<p class="section-heading__description"><?php esc_html_e( 'Fresh perspectives on the breakthroughs and questions defining our future.', 'ai-futuretech' ); ?></p>
			</div>
			<a class="section-heading__link" href="<?php echo esc_url( futuretech_get_posts_page_url() ); ?>"><?php esc_html_e( 'View all stories', 'ai-futuretech' ); ?> <span aria-hidden="true">↗</span></a>
		</div>

		<?php if ( $home_posts->have_posts() ) : ?>
			<div class="home-articles__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Filter stories by category', 'ai-futuretech' ); ?>" data-post-filters>
				<button id="stories-tab-all" class="category-list__button" type="button" role="tab" aria-selected="true" aria-controls="latest-article-grid" tabindex="0" data-post-filter="all"><?php esc_html_e( 'All stories', 'ai-futuretech' ); ?></button>
				<?php foreach ( $home_categories as $category ) : ?>
					<button id="<?php echo esc_attr( 'stories-tab-' . $category->slug ); ?>" class="category-list__button" type="button" role="tab" aria-selected="false" aria-controls="latest-article-grid" tabindex="-1" data-post-filter="<?php echo esc_attr( $category->slug ); ?>"><?php echo esc_html( $category->name ); ?></button>
				<?php endforeach; ?>
			</div>
			<div class="post-grid" id="latest-article-grid" role="tabpanel" aria-labelledby="stories-tab-all" data-post-grid aria-live="polite">
				<?php
				while ( $home_posts->have_posts() ) :
					$home_posts->the_post();
					get_template_part( 'template-parts/post-card' );
				endwhile;
				?>
				<p class="post-grid__empty" data-post-empty hidden><?php esc_html_e( 'No stories in this category yet.', 'ai-futuretech' ); ?></p>
			</div>
		<?php else : ?>
			<p class="post-grid__empty"><?php esc_html_e( 'New stories are on the way. Check back soon.', 'ai-futuretech' ); ?></p>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</section>

	<section class="site-container home-section" aria-labelledby="home-featured-title">
		<div class="home-featured">
			<div class="home-featured__media">
				<img class="home-featured__image" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/whitepapers/coverage.png' ) ); ?>" alt="<?php esc_attr_e( 'Digital network of connected technology', 'ai-futuretech' ); ?>" width="920" height="460" loading="lazy">
			</div>
			<div class="home-featured__body">
				<span class="eyebrow"><?php esc_html_e( 'Beyond the headlines', 'ai-futuretech' ); ?></span>
				<h2 class="home-featured__title" id="home-featured-title"><?php esc_html_e( 'Understand the ideas changing our world.', 'ai-futuretech' ); ?></h2>
				<p class="home-featured__description"><?php esc_html_e( 'From responsible AI to the next wave of computing, explore thoughtful analysis made for curious minds and ambitious teams.', 'ai-futuretech' ); ?></p>
				<a class="button home-featured__link" href="<?php echo esc_url( futuretech_page_url( 'resources' ) ); ?>"><?php esc_html_e( 'Explore our resources', 'ai-futuretech' ); ?> <span aria-hidden="true">↗</span></a>
			</div>
		</div>
	</section>

	<section class="site-container home-section" aria-labelledby="home-resources-title">
		<div class="section-heading">
			<div>
				<span class="eyebrow"><?php esc_html_e( 'Learn and explore', 'ai-futuretech' ); ?></span>
				<h2 class="section-heading__title" id="home-resources-title"><?php esc_html_e( 'Ideas in every format', 'ai-futuretech' ); ?></h2>
			</div>
			<a class="section-heading__link" href="<?php echo esc_url( futuretech_page_url( 'resources' ) ); ?>"><?php esc_html_e( 'All resources', 'ai-futuretech' ); ?> <span aria-hidden="true">↗</span></a>
		</div>
		<div class="home-resources">
			<a class="home-resource" href="<?php echo esc_url( futuretech_page_url( 'resources' ) ); ?>">
				<img class="home-resource__icon" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/ebooks.svg' ) ); ?>" alt="" width="80" height="80" loading="lazy">
				<h3 class="home-resource__title"><?php esc_html_e( 'E-books', 'ai-futuretech' ); ?></h3>
				<p><?php esc_html_e( 'Practical guides to emerging technologies and the teams building them.', 'ai-futuretech' ); ?></p>
				<span class="home-resource__link"><?php esc_html_e( 'Explore e-books', 'ai-futuretech' ); ?> ↗</span>
			</a>
			<a class="home-resource" href="<?php echo esc_url( futuretech_page_url( 'resources' ) ); ?>">
				<img class="home-resource__icon" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/whitepapers.svg' ) ); ?>" alt="" width="80" height="80" loading="lazy">
				<h3 class="home-resource__title"><?php esc_html_e( 'Whitepapers', 'ai-futuretech' ); ?></h3>
				<p><?php esc_html_e( 'Research and clear-eyed perspectives on what is possible next.', 'ai-futuretech' ); ?></p>
				<span class="home-resource__link"><?php esc_html_e( 'Read whitepapers', 'ai-futuretech' ); ?> ↗</span>
			</a>
			<a class="home-resource" href="<?php echo esc_url( futuretech_page_url( 'podcasts' ) ); ?>">
				<img class="home-resource__icon" src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/research_blogs.svg' ) ); ?>" alt="" width="80" height="80" loading="lazy">
				<h3 class="home-resource__title"><?php esc_html_e( 'Podcasts & research', 'ai-futuretech' ); ?></h3>
				<p><?php esc_html_e( 'Listen in and go deeper with experts on the ideas shaping tomorrow.', 'ai-futuretech' ); ?></p>
				<span class="home-resource__link"><?php esc_html_e( 'Listen and learn', 'ai-futuretech' ); ?> ↗</span>
			</a>
		</div>
	</section>


	<section class="resources-showcase site-container" aria-labelledby="resources-showcase-title">
		<header class="resources-showcase__header">
			<div>
				<span class="resources-showcase__eyebrow"><?php esc_html_e( 'Your Gateway to In-Depth Information', 'ai-futuretech' ); ?></span>
				<h2 class="resources-showcase__title" id="resources-showcase-title"><?php esc_html_e( "Unlock Valuable Knowledge with FutureTech's Resources", 'ai-futuretech' ); ?></h2>
			</div>
			<a class="resources-showcase__all" href="<?php echo esc_url( futuretech_page_url( 'resources' ) ); ?>">
				<?php esc_html_e( 'View All Resources', 'ai-futuretech' ); ?>
				<span aria-hidden="true">↗</span>
			</a>
		</header>
		<?php get_template_part( 'template-parts/home/ebooks' ); ?>
		<?php get_template_part( 'template-parts/home/whitepapers' ); ?>
	</section>
	<?php get_template_part( 'template-parts/home/reader-reviews__viewport' ); ?>
	<?php get_template_part( 'template-parts/cta' ); ?>
	
</main>
<?php
get_footer();
