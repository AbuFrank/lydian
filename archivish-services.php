<?php
/**
 * Template Name: Services Index
 *
 * @package Lydian_Center
 */

get_header();
?>
		<?php
		while ( have_posts() ) : the_post();
			
			?>


			
				
		<!-- Retrieve Services object from database -->
			<?php 
					$services = get_posts(array(
						'post_type'				=> 'services',
						'posts_per_page'	=> -1,
						'meta_key'				=> 'service_type',
						'orderby'					=> 'meta_value',	
						'order'						=> 'ASC'
					));
				?>
				<!-- Create accessible array of practitioners -->
				<?php 
					$posts = $services;
					$services_array = array();

					foreach( $posts as $post ): 			
					setup_postdata( $post )
				?>

		<!-- Create variables for services -->
		<?php 
			$excerpt 			= get_field('index_excerpt');
			$service_type = get_field('service_type');
			$appear 			= get_field('appear_service_index');

			$services_array[] = array(
				'excerpt'				=> $excerpt,
				'service_type'	=> $service_type,	
				'appear'				=> $appear
			);

			endforeach; wp_reset_postdata(); 
			$num_services = count($services_array); 
			$count = 0;
		?>
		
<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="container">
			<div class="page-title-box d-flex justify-content-center">
				<div class="cb-bar">
				</div>
				<h1 class="page-title">Lydian Center Services</h1>
			</div>
		</div>
		<div class="container">
		<?php while($count < $num_services): ?>
			<div class="row service-row">
				<?php if($services_array[$count]['appear'] == 'visible'): ?>
				<div class="col-md-5">
					<h2 class="service-index-title mr-3"><?php echo $services_array[$count]['service_type']?></h2>
				</div>
				<div class="col-md-7">
					<?php echo $services_array[$count]['excerpt'] ?>
					<?php if($services_array[$count]['service_type'] != "Energy Kinesiology") { ?>
						<div class="button-container">
							<a href="<?php echo get_home_url(); ?>/?services=<?php echo $services_array[$count]['service_type'] ?>">
								<div class="cb-slide-button">Learn More about <?php echo $services_array[$count]['service_type']?></div>
							</a>
						</div>
					<?php } else { ?>
						<div class="button-container">
							<a href="<?php echo get_home_url(); ?>/energy-kinesiology">
								<div class="cb-slide-button">Learn More about <?php echo $services_array[$count]['service_type']?></div>
							</a>
						</div>
					<? } ?>
				</div>
			<?php endif; ?>
			</div>
			<?php $count++; ?>

		<?php endwhile; // End of html loop?>
		</div> <!-- end container --> 
	<?php endwhile; // End of page loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
