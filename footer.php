<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Lydian_Center
 */

?>

	</div><!-- #content -->
	<!-- This section contains the map api, mission statement, and action buttons -->
	<section id="sub-footer" class="site-ankler">
		<div class="container-fluid">
			<div class="row">

				<!-- API init -->
				<iframe 
					id="footer-map"
					width="1600"
					height="400" 
					frameborder="0" style="border:0" 
					src= "https://maps.google.com/maps/embed/v1/place?key=AIzaSyBGel9GYEDBv946rwC8gEDSvnwNw6cpaK0&q=777+Concord+Ave,Cambridge+MA"
					allowfullscreen>
				</iframe>

				
				
				<!-- Footer content below map -->
				<div class="container">
					<div class="row">
						<div id="footer-mission" class="col-md-7 col-xl-6 offset-xl-1 d-flex flex-column justify-content-center">
							<h2 class="text-center">Our Mission</h2>
							<p>The Lydian Center for Innovative Healthcare is a community of independent practitioners dedicated to helping children and adults reach their fullest potential. Lydian Center practitioners are committed to providing the highest quality holistic health care and to educating clients about healthy living.</p>
						</div>
						<div id="footer-actions" class="col-md-5 text-center d-md-flex flex-column justify-content-center">
							<div class="footer-buttons d-flex d-sm-none">
								<div class="card button-1 align-center">
									<a href="tel:617-876-6777"><div class="card-header">617-876-6777</div></a>
								</div>
							</div>
							<div class="footer-buttons d-none d-sm-flex">
								<div class="card button-1 align-center">
									<div class="card-header">617-876-6777</div>
								</div>
							</div>
							<!-- <div class="footer-buttons">
								<div class="card button-2">
									<a href="<?php echo esc_url(home_url("contact")); ?>"><div class="card-header">Schedule Appointment</div></a>
								</div>
							</div> -->
							<div class="footer-buttons">
								<div class="card button-2">
									<a href="<?php echo esc_url(home_url("contact#secure-email-form")); ?>"><div class="card-header">Send Secure Email</div></a>
								</div>
							</div>
						</div><!-- #footer-actions -->
					</div><!-- .row -->
				</div><!-- .container -->
			</div><!-- .row -->
		</div><!-- .container-fluid -->
	</section><!-- .site-ankler -->
	<footer id="colophon" class="site-footer">
		<div class="site-info text-center">
			<?php
				/* translators: %s: Site name, i.e. Assistance in Action. */
				printf( esc_html__( 'Copyright &copy; ' . date('Y') . ' %s', 'lydian-center' ), 'The Lydian Center' );
			?>
			<span class="d-none d-sm-inline"> | </span>
			<br class="d-block d-sm-none">
				<?php
				/* translators: %s: Site author, i.e. Creative Blazer. */
				printf( esc_html__( 'Site by %s', 'lydian-center' ), '<a href="http://creativeblazer.com/" target="_blank">Creative Blazer</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
