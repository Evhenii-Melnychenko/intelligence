<?php
/**
 * Theme setup and frontend assets.
 */

function futuretech_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 64,
		'width'       => 64,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );

	register_nav_menus( array(
		'primary' => __( 'Primary navigation', 'ai-futuretech' ),
	) );

	add_image_size( 'futuretech-card', 720, 430, true );
}
add_action( 'after_setup_theme', 'futuretech_setup' );

function futuretech_podcast_category_add_fields() {
	$fields = array(
		'futuretech_podcast_host'              => __( 'Show host', 'ai-futuretech' ),
		'futuretech_podcast_rating'            => __( 'Rating (0–5)', 'ai-futuretech' ),
		'futuretech_podcast_listen_url'        => __( 'Listen URL', 'ai-futuretech' ),
		'futuretech_podcast_average_length'    => __( 'Average episode length', 'ai-futuretech' ),
		'futuretech_podcast_release_frequency' => __( 'Release frequency', 'ai-futuretech' ),
	);

	?>
	<div class="form-field">
		<?php wp_nonce_field( 'futuretech_save_podcast_category', 'futuretech_podcast_category_nonce' ); ?>
		<p><?php esc_html_e( 'Podcast show details. Total episodes is counted from posts assigned to this category.', 'ai-futuretech' ); ?></p>
	</div>
	<?php foreach ( $fields as $meta_key => $label ) : ?>
		<div class="form-field">
			<label for="<?php echo esc_attr( $meta_key ); ?>"><?php echo esc_html( $label ); ?></label>
			<input class="regular-text" type="<?php echo 'futuretech_podcast_listen_url' === $meta_key ? 'url' : ( 'futuretech_podcast_rating' === $meta_key ? 'number' : 'text' ); ?>" <?php echo 'futuretech_podcast_rating' === $meta_key ? 'min="0" max="5" step="0.1"' : ''; ?> id="<?php echo esc_attr( $meta_key ); ?>" name="<?php echo esc_attr( $meta_key ); ?>" value="">
		</div>
	<?php endforeach; ?>
	<?php
}
add_action( 'category_add_form_fields', 'futuretech_podcast_category_add_fields' );

function futuretech_edit_podcast_category_fields( $term ) {
	$fields = array(
		'futuretech_podcast_host'              => __( 'Show host', 'ai-futuretech' ),
		'futuretech_podcast_rating'            => __( 'Rating (0–5)', 'ai-futuretech' ),
		'futuretech_podcast_listen_url'        => __( 'Listen URL', 'ai-futuretech' ),
		'futuretech_podcast_average_length'    => __( 'Average episode length', 'ai-futuretech' ),
		'futuretech_podcast_release_frequency' => __( 'Release frequency', 'ai-futuretech' ),
	);

	wp_nonce_field( 'futuretech_save_podcast_category', 'futuretech_podcast_category_nonce' );
	foreach ( $fields as $meta_key => $label ) :
		$value = get_term_meta( $term->term_id, $meta_key, true );
		?>
		<tr class="form-field">
			<th scope="row"><label for="<?php echo esc_attr( $meta_key ); ?>"><?php echo esc_html( $label ); ?></label></th>
			<td><input class="regular-text" type="<?php echo 'futuretech_podcast_listen_url' === $meta_key ? 'url' : ( 'futuretech_podcast_rating' === $meta_key ? 'number' : 'text' ); ?>" <?php echo 'futuretech_podcast_rating' === $meta_key ? 'min="0" max="5" step="0.1"' : ''; ?> id="<?php echo esc_attr( $meta_key ); ?>" name="<?php echo esc_attr( $meta_key ); ?>" value="<?php echo esc_attr( $value ); ?>"></td>
		</tr>
	<?php endforeach; ?>
	<?php
}
add_action( 'category_edit_form_fields', 'futuretech_edit_podcast_category_fields' );

function futuretech_save_podcast_category_fields( $term_id ) {
	if (
		! isset( $_POST['futuretech_podcast_category_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['futuretech_podcast_category_nonce'] ) ), 'futuretech_save_podcast_category' ) ||
		! current_user_can( 'edit_term', $term_id )
	) {
		return;
	}

	$text_fields = array(
		'futuretech_podcast_host',
		'futuretech_podcast_average_length',
		'futuretech_podcast_release_frequency',
	);

	foreach ( $text_fields as $meta_key ) {
		if ( isset( $_POST[ $meta_key ] ) ) {
			$value = sanitize_text_field( wp_unslash( $_POST[ $meta_key ] ) );
			if ( '' === $value ) {
				delete_term_meta( $term_id, $meta_key );
			} else {
				update_term_meta( $term_id, $meta_key, $value );
			}
		}
	}

	if ( isset( $_POST['futuretech_podcast_rating'] ) ) {
		$rating = (float) wp_unslash( $_POST['futuretech_podcast_rating'] );
		$rating = max( 0, min( 5, $rating ) );
		if ( 0 === $rating ) {
			delete_term_meta( $term_id, 'futuretech_podcast_rating' );
		} else {
			update_term_meta( $term_id, 'futuretech_podcast_rating', $rating );
		}
	}

	if ( isset( $_POST['futuretech_podcast_listen_url'] ) ) {
		$url = esc_url_raw( wp_unslash( $_POST['futuretech_podcast_listen_url'] ) );
		if ( '' === $url ) {
			delete_term_meta( $term_id, 'futuretech_podcast_listen_url' );
		} else {
			update_term_meta( $term_id, 'futuretech_podcast_listen_url', $url );
		}
	}
}
add_action( 'created_category', 'futuretech_save_podcast_category_fields' );
add_action( 'edited_category', 'futuretech_save_podcast_category_fields' );

function futuretech_asset_version( $relative_path ) {
	$file_path = get_theme_file_path( $relative_path );

	return file_exists( $file_path ) ? (string) filemtime( $file_path ) : wp_get_theme()->get( 'Version' );
}

function futuretech_enqueue_assets() {
	futuretech_enqueue_stylesheet( 'futuretech-main', 'main' );

	if ( is_front_page() || is_home() ) {
		futuretech_enqueue_stylesheet( 'futuretech-home', 'home', array( 'futuretech-main' ) );
		futuretech_enqueue_stylesheet( 'futuretech-ai-intro', 'ai-intro', array( 'futuretech-main' ) );
	}

	if ( is_archive() || is_search() || is_single() || ( is_home() && ! is_front_page() ) ) {
		futuretech_enqueue_stylesheet( 'futuretech-news', 'news', array( 'futuretech-main' ) );
	}

	$page_styles = array(
		'templates/page-podcasts.php'  => 'podcasts',
		'templates/page-resources.php' => 'resources',
		'templates/page-contact.php'   => 'contact',
	);

	foreach ( $page_styles as $template => $style ) {
		if ( is_page_template( $template ) ) {
			futuretech_enqueue_stylesheet( 'futuretech-' . $style, $style, array( 'futuretech-main' ) );
		}
	}

	if ( ( is_page() && ! is_page_template( array_keys( $page_styles ) ) ) || is_404() ) {
		futuretech_enqueue_stylesheet( 'futuretech-page', 'contact', array( 'futuretech-main' ) );
	}

	wp_enqueue_script(
		'futuretech-main',
		get_theme_file_uri( '/assets/js/main.js' ),
		array(),
		futuretech_asset_version( '/assets/js/main.js' ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'futuretech_enqueue_assets' );

function futuretech_enqueue_stylesheet( $handle, $name, $dependencies = array() ) {
	$relative_path = '/assets/css/' . $name . '.css';
	$minified_path = '/assets/css/' . $name . '.min.css';

	if ( ( ! defined( 'SCRIPT_DEBUG' ) || ! SCRIPT_DEBUG ) && file_exists( get_theme_file_path( $minified_path ) ) ) {
		$relative_path = $minified_path;
	}

	wp_enqueue_style(
		$handle,
		get_theme_file_uri( $relative_path ),
		$dependencies,
		futuretech_asset_version( $relative_path )
	);
}

function futuretech_primary_link_attributes( $attributes ) {
	$attributes['class'] = isset( $attributes['class'] ) ? $attributes['class'] . ' primary-navigation__link' : 'primary-navigation__link';

	return $attributes;
}
add_filter( 'nav_menu_link_attributes', 'futuretech_primary_link_attributes' );

function futuretech_primary_menu_item_classes( $classes ) {
	$classes[] = 'primary-navigation__item';

	return $classes;
}
add_filter( 'nav_menu_css_class', 'futuretech_primary_menu_item_classes' );

function futuretech_primary_menu_fallback() {
	$items = array(
		array( __( 'Home', 'ai-futuretech' ), home_url( '/' ) ),
		array( __( 'News', 'ai-futuretech' ), home_url( '/#latest-stories' ) ),
		array( __( 'Podcasts', 'ai-futuretech' ), futuretech_page_url( 'podcasts' ) ),
		array( __( 'Resources', 'ai-futuretech' ), futuretech_page_url( 'resources' ) ),
	);

	echo '<nav class="primary-navigation" aria-label="' . esc_attr__( 'Primary navigation', 'ai-futuretech' ) . '"><ul class="primary-navigation__list">';
	foreach ( $items as $item ) {
		echo '<li class="primary-navigation__item"><a class="primary-navigation__link" href="' . esc_url( $item[1] ) . '">' . esc_html( $item[0] ) . '</a></li>';
	}
	echo '</ul></nav>';
}

function futuretech_page_url( $slug ) {
	$page = get_page_by_path( $slug );

	return $page ? get_permalink( $page ) : home_url( '/' . trim( $slug, '/' ) . '/' );
}

function futuretech_post_fallback_image( $post_id = 0 ) {
	$images = array(
		'/assets/images/news/strategics.png',
		'/assets/images/news/blockchain.png',
		'/assets/images/news/summit.png',
		'/assets/images/news/mars.png',
	);
	$index = absint( $post_id ) % count( $images );

	return get_theme_file_uri( $images[ $index ] );
}

function futuretech_post_category_slugs( $post_id = 0 ) {
	$categories = get_the_category( $post_id );
	$slugs      = array();

	foreach ( $categories as $category ) {
		$slugs[] = $category->slug;
	}

	return $slugs;
}

function futuretech_get_posts_page_url() {
	$posts_page_id = (int) get_option( 'page_for_posts' );

	return $posts_page_id ? get_permalink( $posts_page_id ) : home_url( '/#latest-stories' );
}
