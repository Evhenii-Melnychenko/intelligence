<?php
    include get_theme_file_path( '/template-parts/home/reader_reviews_list.php' );
?>

<section class="reader-reviews" aria-labelledby="reader-reviews-title" data-reader-reviews>
    <div class="site-container reader-reviews__header">
        <div class="reader-reviews__heading">
            <span class="reader-reviews__eyebrow">
                <?php esc_html_e( 'What Our Readers Say', 'ai-futuretech' ); ?>
            </span>
            <h2>
                <?php esc_html_e( 'Real Words from Real Readers', 'ai-futuretech' ); ?>
            </h2>
        </div>
        <a class="reader-reviews__all" href="#reader-reviews-list">
            <?php esc_html_e( 'View All Testimonials', 'ai-futuretech' ); ?>
            <span aria-hidden="true">↗</span>
        </a>
    </div>

    <div class="reader-reviews__viewport">
        <ul class="reader-reviews__list" id="reader-reviews-list" data-reader-reviews-track>
            <?php foreach ( $reader_reviews_list as $review ) : ?>
                <li class="reader-reviews__item" data-reader-review>
                    <article class="reader-review">
                        <div class="reader-review__author">
                            <img
                                class="reader-review__avatar"
                                src="<?php echo esc_url( get_theme_file_uri( '/assets/images/home/readers/' . $review['avatar'] ) ); ?>"
                                alt=""
                                width="60"
                                height="60"
                                loading="lazy"
                            >
                            <div class="reader-review__author-details">
                                <h3 class="reader-review__name"><?php echo esc_html( $review['name'] ); ?></h3>
                                <p class="reader-review__location"><?php echo esc_html( $review['location'] ); ?></p>
                            </div>
                        </div>
                        <div class="reader-review__rating" role="img" aria-label="<?php esc_attr_e( '5 out of 5 stars', 'ai-futuretech' ); ?>">
                            <?php for ( $star = 0; $star < 5; $star++ ) : ?>
                                <svg class="reader-review__star" aria-hidden="true" viewBox="0 0 24 24" focusable="false">
                                    <path d="M12 2.75a1 1 0 0 1 .9.56l2.44 4.94 5.45.79a1 1 0 0 1 .55 1.7l-3.95 3.85.93 5.43a1 1 0 0 1-1.45 1.05L12 18.5l-4.87 2.57a1 1 0 0 1-1.45-1.05l.93-5.43-3.95-3.85a1 1 0 0 1 .55-1.7l5.45-.79 2.44-4.94a1 1 0 0 1 .9-.56Z" fill="currentColor"/>
                                </svg>
                            <?php endfor; ?>
                        </div>
                        <blockquote class="reader-review__quote">
                            <p><?php echo esc_html( $review['review'] ); ?></p>
                        </blockquote>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="reader-reviews__pagination" role="group" aria-label="<?php esc_attr_e( 'Choose a testimonial', 'ai-futuretech' ); ?>" data-reader-reviews-dots>
        <?php foreach ( $reader_reviews_list as $index => $review ) : ?>
            <button
                class="reader-reviews__dot"
                type="button"
                aria-label="<?php echo esc_attr( sprintf( __( 'Show testimonial %d', 'ai-futuretech' ), $index + 1 ) ); ?>"
                aria-current="<?php echo 0 === $index ? 'true' : 'false'; ?>"
                data-reader-review-dot
            ></button>
        <?php endforeach; ?>
    </div>
</section>