<?php
/**
 * Template Name: Contact
 */

get_header();
$contact_email       = futuretech_contact_email();
$contact_phone       = '+1 (123) 456-7890';
$office_address      = '123 AI Tech Avenue, Techville, 54321';
$privacy_policy_url  = get_privacy_policy_url();
?>
<main id="main-content" class="site-main">
	<div class="site-container">
		<section class="contact-page__directory" aria-label="<?php esc_attr_e( 'Contact information', 'ai-futuretech' ); ?>">
			<div class="contact-page__directory-item">
				<h4><?php esc_html_e( 'General Inquiries', 'ai-futuretech' ); ?></h4>
				<a class="contact-page__directory-link" href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?><span aria-hidden="true">↗</span></a>
				<a class="contact-page__directory-link" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>"><?php echo esc_html( $contact_phone ); ?><span aria-hidden="true">↗</span></a>
			</div>
			<div class="contact-page__directory-item">
				<h4><?php esc_html_e( 'Technical Support', 'ai-futuretech' ); ?></h4>
				<a class="contact-page__directory-link" href="mailto:<?php echo esc_attr( $contact_email ); ?>?subject=<?php echo rawurlencode( __( 'Technical support request', 'ai-futuretech' ) ); ?>"><?php echo esc_html( $contact_email ); ?><span aria-hidden="true">↗</span></a>
				<a class="contact-page__directory-link" href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $contact_phone ) ); ?>"><?php echo esc_html( $contact_phone ); ?><span aria-hidden="true">↗</span></a>
			</div>
			<div class="contact-page__directory-item">
				<h4><?php esc_html_e( 'Our Office', 'ai-futuretech' ); ?></h4>
				<address><?php echo esc_html( $office_address ); ?></address>
				<a class="contact-page__directory-link" href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo rawurlencode( $office_address ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get Directions', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></a>
			</div>
			<div class="contact-page__directory-item contact-page__directory-item--social">
				<h4><?php esc_html_e( 'Connect with Us', 'ai-futuretech' ); ?></h4>
				<div class="contact-page__socials">
					<a href="https://twitter.com/" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Follow us on X', 'ai-futuretech' ); ?>">
						<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/footer/twitter.svg' ) ); ?>" alt="" width="18" height="18">
					</a>
					<a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Connect with us on LinkedIn', 'ai-futuretech' ); ?>">
						<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/footer/linkedin.svg' ) ); ?>" alt="" width="18" height="18">
					</a>
				</div>
			</div>
		</section>

		<section class="contact-page__main" aria-labelledby="contact-title">
			<div class="contact-page__intro">
				<span class="contact-page__mark" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
				<h1><?php esc_html_e( 'Get in Touch with AI Podcasts', 'ai-futuretech' ); ?></h1>
				<p><?php esc_html_e( 'Have a question, an idea, or a story to share? We’d love to hear from you.', 'ai-futuretech' ); ?></p>
			</div>

			<form class="contact-form" data-contact-form action="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>" method="post" novalidate>
				<div class="contact-form__fields">
					<div class="contact-form__field">
						<label for="contact-first-name"><?php esc_html_e( 'First Name', 'ai-futuretech' ); ?></label>
						<input id="contact-first-name" name="first_name" type="text" autocomplete="given-name" maxlength="80" placeholder="<?php esc_attr_e( 'First Name', 'ai-futuretech' ); ?>" required>
					</div>
					<div class="contact-form__field">
						<label for="contact-last-name"><?php esc_html_e( 'Last Name', 'ai-futuretech' ); ?></label>
						<input id="contact-last-name" name="last_name" type="text" autocomplete="family-name" maxlength="80" placeholder="<?php esc_attr_e( 'Last Name', 'ai-futuretech' ); ?>" required>
					</div>
					<div class="contact-form__field">
						<label for="contact-email"><?php esc_html_e( 'Email', 'ai-futuretech' ); ?></label>
						<input id="contact-email" name="email" type="email" autocomplete="email" maxlength="254" placeholder="<?php esc_attr_e( 'Email', 'ai-futuretech' ); ?>" required>
					</div>
					<div class="contact-form__field">
						<label for="contact-phone"><?php esc_html_e( 'Phone Number', 'ai-futuretech' ); ?> <span><?php esc_html_e( '(optional)', 'ai-futuretech' ); ?></span></label>
						<input id="contact-phone" name="phone" type="tel" autocomplete="tel" maxlength="40" placeholder="<?php esc_attr_e( 'Phone Number', 'ai-futuretech' ); ?>">
					</div>
					<div class="contact-form__field contact-form__field--full">
						<label for="contact-message"><?php esc_html_e( 'Message', 'ai-futuretech' ); ?></label>
						<textarea id="contact-message" name="message" rows="5" maxlength="5000" placeholder="<?php esc_attr_e( 'Your Message', 'ai-futuretech' ); ?>" required></textarea>
					</div>
				</div>

				<div class="contact-form__trap" aria-hidden="true">
					<label for="contact-website"><?php esc_html_e( 'Leave this field empty', 'ai-futuretech' ); ?></label>
					<input id="contact-website" name="website" type="text" tabindex="-1" autocomplete="off">
				</div>

				<div class="contact-form__footer">
					<label class="contact-form__consent" for="contact-privacy">
						<input id="contact-privacy" name="privacy_consent" type="checkbox" value="1" required>
						<span>
							<?php esc_html_e( 'I agree to the', 'ai-futuretech' ); ?>
							<?php if ( $privacy_policy_url ) : ?>
								<a href="<?php echo esc_url( $privacy_policy_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Privacy Policy', 'ai-futuretech' ); ?></a>
							<?php else : ?>
								<?php esc_html_e( 'Privacy Policy', 'ai-futuretech' ); ?>
							<?php endif; ?>
						</span>
					</label>
					<button class="button contact-form__submit" type="submit"><?php esc_html_e( 'Send Message', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></button>
				</div>
				<p class="contact-form__status" data-contact-status role="status" aria-live="polite"></p>
			</form>
		</section>

		<section class="contact-page__faq" aria-labelledby="contact-faq-title">
			<div class="contact-page__faq-intro">
				<span class="contact-page__mark contact-page__mark--faq" aria-hidden="true"><i></i><i></i><i></i><i></i></span>
				<h2 class="contact-page__faq-title" id="contact-faq-title"><?php esc_html_e( 'Frequently Asked Questions', 'ai-futuretech' ); ?></h2>
				<p><?php esc_html_e( 'Can’t find what you’re looking for? Send us a message and we’ll be happy to help.', 'ai-futuretech' ); ?></p>
				<a class="contact-page__ask-link" href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php esc_html_e( 'Ask a Question', 'ai-futuretech' ); ?><span aria-hidden="true">↗</span></a>
			</div>

			<div class="contact-faq">
				<details class="contact-faq__item" name="contact-faq" open>
					<summary><?php esc_html_e( 'What is AI?', 'ai-futuretech' ); ?><span aria-hidden="true"></span></summary>
					<div class="contact-faq__answer"><p><?php esc_html_e( 'Artificial intelligence is the ability of computer systems to perform tasks that typically require human intelligence, such as learning, reasoning, and understanding language.', 'ai-futuretech' ); ?></p></div>
				</details>
				<details class="contact-faq__item" name="contact-faq">
					<summary><?php esc_html_e( 'How can I listen to your podcasts?', 'ai-futuretech' ); ?><span aria-hidden="true"></span></summary>
					<div class="contact-faq__answer"><p><?php esc_html_e( 'Visit our Podcasts page to explore episodes and find links to listen on your preferred platform.', 'ai-futuretech' ); ?></p><a href="<?php echo esc_url( futuretech_page_url( 'podcasts' ) ); ?>"><?php esc_html_e( 'Explore podcasts', 'ai-futuretech' ); ?> ↗</a></div>
				</details>
				<details class="contact-faq__item" name="contact-faq">
					<summary><?php esc_html_e( 'Are your podcasts free to listen to?', 'ai-futuretech' ); ?><span aria-hidden="true"></span></summary>
					<div class="contact-faq__answer"><p><?php esc_html_e( 'Yes. You can listen to our published episodes for free on the platforms linked from each episode.', 'ai-futuretech' ); ?></p></div>
				</details>
				<details class="contact-faq__item" name="contact-faq">
					<summary><?php esc_html_e( 'Can I download episodes to listen offline?', 'ai-futuretech' ); ?><span aria-hidden="true"></span></summary>
					<div class="contact-faq__answer"><p><?php esc_html_e( 'Download availability depends on the podcast platform you use. Check the episode options in your listening app.', 'ai-futuretech' ); ?></p></div>
				</details>
				<details class="contact-faq__item" name="contact-faq">
					<summary><?php esc_html_e( 'How often do you release new episodes?', 'ai-futuretech' ); ?><span aria-hidden="true"></span></summary>
					<div class="contact-faq__answer"><p><?php esc_html_e( 'Release schedules vary by show. Visit the Podcasts page to see the latest episodes and show details.', 'ai-futuretech' ); ?></p><a href="<?php echo esc_url( futuretech_page_url( 'podcasts' ) ); ?>"><?php esc_html_e( 'View the Podcasts page', 'ai-futuretech' ); ?> ↗</a></div>
				</details>
			</div>
		</section>
	</div>

	<?php get_template_part( 'template-parts/cta' ); ?>
</main>
<?php
get_footer();
