<?php
/**
 * Template part for displaying page content in front-page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lydian_Center
 */

?>
<section id="hero">
	<div class="owl-carousel cb-slider">
		<!-- Dr. Andrade and Woman -->
		<div style="width: 100%;"> <?php echo wp_get_attachment_image('394', 'full') ?> </div>
		<!--  Joy  -->
		<div style="width: 100%;"> <?php echo wp_get_attachment_image('398', 'full') ?> </div>
		<!-- Dr. Krebs -->
		<div style="width: 100%;"> <?php echo wp_get_attachment_image('397', 'full') ?> </div>
		<!-- Hands -->
		<div style="width: 100%;"> <?php echo wp_get_attachment_image('395', 'full') ?> </div>
		<!-- Dr. Maya and Children -->
		<div style="width: 100%;"> <?php echo wp_get_attachment_image('396', 'full') ?> </div>
	</div>
	<?php //create curved corners ?>
	<div id="cb-curved-corners" class="d-none d-lg-block"></div>
</section>
	