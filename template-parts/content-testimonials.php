<?php
/**
 * Template part for displaying page content in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lydian_Center
 */

?>

<section id="front-page-testimonials" class="front-page-section">
	<div class="container">
		<div class="page-title-box d-flex justify-content-center">
			<div class="cb-bar"></div>
			<h2 class="text-center page-title">What Our Patients Say</h2>
		</div>
		<div class="row pt-3">
			<?php if( is_active_sidebar( 'front-testimonials' ) ) : ?>
					<?php dynamic_sidebar( 'front-testimonials' ); ?>
			<?php endif; ?>
		</div>
		</div> <!-- end .row -->
		<div class="text-center button-box">
			<a href="<?php echo esc_url(home_url("testimonials")); ?>">
				<div class="cb-slide-button">Read More Testimonials</div>
			</a>
		</div>
	</div>
</section>