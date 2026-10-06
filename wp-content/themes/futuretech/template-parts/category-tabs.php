<?php
$categories = get_categories( array(
	'hide_empty' => true,
	'number'     => 8,
	'orderby'    => 'count',
	'order'      => 'DESC',
) );
?>
<?php if ( ! empty( $categories ) ) : ?>
	<ul class="category-list" aria-label="<?php esc_attr_e( 'Browse by category', 'ai-futuretech' ); ?>">
		<?php foreach ( $categories as $category ) : ?>
			<li>
				<a class="category-list__link<?php echo is_category( $category->term_id ) ? ' is-active' : ''; ?>" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
					<?php echo esc_html( $category->name ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
