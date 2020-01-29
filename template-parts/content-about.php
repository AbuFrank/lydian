<?php
/**
 * Template part for displaying page content in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lydian_Center
 */

?>
<section id="front-page-about" class="front-page-section">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-6 d-flex flex-column justify-content-center pb-4">
				<h3 class="about-title text-center">Welcome to The Lydian Center for Innovative Healthcare</h3>
				<p>Combining cutting edge alternative healthcare and new educational techniques in a holistic health center setting. Serving all ages, with a special emphasis on children and families, we are a community of independent practitioners offering an alternative approach to healthcare, education and human development. At TLC, you can choose from a wide range of healing modalities, or request an integrated approach – all under one roof!</p>
				<div class="text-center button-box">
					<a href="<?php echo esc_url(home_url("all-services")); ?>">
						<div class="cb-slide-button">Explore Our Services</div>
					</a>
				</div>
			</div>
			<div class="col-lg-6 ">
				<?php echo wp_get_attachment_image(508, "full")?>
			</div>
		</div>
	</div>
</section>