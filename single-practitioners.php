<?php
/**
* 
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Lydian_Center
 */

	get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php 
			while ( have_posts() ) : the_post(); ?>

			<!-- Create variables for practitioners -->
			<?php 
				$first_name			= get_field('first_name');
				$last_name			= get_field('last_name'); 								
				$practice				= get_field('practice'); 
			 	$certifications	= get_field('certifications'); 
			 	$about					= get_field('about');
			 	$phone					= get_field('phone_number');
			 	$booking 				= get_field('booking_button');
			 	$email					= get_field('email');
			 	$p_photo				= get_field('practitioner_photo');
			 	$links					= get_field('external_links');
			 	$publications 	= get_field('publications');
			 	$forms  				= get_field('health_history_forms');
			?>

			<!-- Retrieve testimonials object from database -->
			<?php 
					$testimonials = get_posts(array(
						'post_type'			=> 'testimonials',
						'posts_per_page'	=> -1
					));
				?>
				<!-- Create accessible array of testimonials -->
				<?php 
					$posts = $testimonials;
					$testimonials_array = array();

					foreach( $posts as $post ): 			
					setup_postdata( $post )
				?>

				<!-- Create variables for testimonials -->
				<?php 
					$t_first_name	= get_field('practitioner_first_name');
					$t_last_name    = get_field('practitioner_last_name'); 	
					if($t_last_name == $last_name):							
						while(the_repeater_field('testimonials')): 								
							$t_text       		= get_sub_field('testimonial_text'); 
			 				$t_client_name 		= get_sub_field('client_name');

				 		// Create array of testimonial information		
						$testimonials_array[] = array(
						'first_name'		=> $t_first_name,
						'last_name' 		=> $t_last_name, 
						't_text'  			=> $t_text, 
						't_client_name' => $t_client_name
					);
			  				endwhile;
			  			endif; 
			  		endforeach; 
			  	wp_reset_postdata(); ?>

			<div class="container">
				<div class="page-title-box d-flex justify-content-center">
					<div class="cb-bar">
					</div>
					<?php the_title('<h1 class="service-title">', '</h1>');?>
				</div>				
				<div class="row">
					<div class="col-md-5 col-lg-4">
						<div class="sidebar-text sidebar-content">
							<div class="row">	
								<div class="col-md-12">	
									<div class="practitioner-image">
										<?php echo wp_get_attachment_image($p_photo, "full");?>
									</div>
								</div>
							</div>
							<div class="col-md-12 sidebar-content-wrapper">
								<div>
									<h3 class="sidebar-practitioner-name"><?php echo($first_name);?> <?php echo($last_name) ?><small>,</small></h3>  
									<h5 class="sidebar-practitioner-name"> <?php echo($certifications);?></h5>
									<h4><?php echo($practice);?></h4>
								</div>
								<?php if($last_name != "Kodiak" && $last_name != "Lennihan" && $last_name !="Sutton"){ ?>

								<div class="booking-button">
									<?php echo($booking); ?>
								</div>

								<!-- Scheduling button phone screen -->
								<div class="schedule-appt-wrapper"><a href="tel:<?php echo($phone);?>">	
									<div class="schedule-appt-button d-block d-sm-none ">
										<div class="text-center">BOOK APPOINTMENT</div>
										<div class="text-center schedule-appt-text">
											Call <?php echo($phone);?>
										</div>
									</div>
									</a></div>

								<!-- Scheduling button iPad, laptop screen -->
								<div class="schedule-appt-button d-none d-sm-block">
									<div class="text-center">BOOK APPOINTMENT</div>
									<div class="text-center schedule-appt-text">
										Call 
										<?php echo($phone); ?>
									</div>
								</div>

								<div class="<?php echo($forms);?>">
									<a href="/lydian-center-health-history-forms">Review Intake Forms</a>
								</div>

								<?php } elseif($last_name == "Kodiak") { ?>
								<div>
									<!-- Scheduling button phone screen -->
									<div class="schedule-appt-wrapper">
										<a href="tel:<?php echo($phone);?>">	
											<div class="schedule-appt-button d-block d-sm-none ">
												<div class="text-center">Phone Appointments Only</div>
												<div class="text-center schedule-appt-text">
													Call <?php echo($phone);?>
												</div>
											</div>
										</a>
									</div>

									<!-- Scheduling button iPad, laptop screen -->
									<div class="schedule-appt-button d-none d-sm-block">
										<div class="text-center">Phone Appointments Only</div>
										<div class="text-center schedule-appt-text">
											Call 
											<?php echo($phone); ?>
										</div>
									</div>
									<!-- Book Appointment Button to SquareUp -->
									<div class="booking-button">
										<?php //echo($booking); ?>
									</div>
								</div>
								<?php } elseif($last_name == "Lennihan" || $last_name == "Sutton") { ?>
								<div class="practitioner-image">
									<div class="booking-button">
										<?php echo($booking); ?>
									</div>
								</div>
								<?php } ?>
							</div> <!-- end col-md-12 -->
						</div> <!-- end sidebar-text-->
						
						<!-- Creative Line Break -->
						<div class="creative-break">
							<div class="left-diamond diamond"></div>
							<div class="right-diamond diamond"></div>
						</div>
						
						<?php if($links){ ?>
							<div class="sidebar-text sidebar-content">
								<div class="col-md-12 sidebar-content-wrapper">	
									<h4>More Information</h4>
									<div>
										<?php echo($links); ?>
									</div>
								</div>
							</div>
						<?php } ?>
						
						<?php if($publications){ ?>
							<div class="sidebar-text sidebar-content">
								<div class="col-md-12 sidebar-content-wrapper">
									<h4>Publications</h4>
									<div>
										<?php echo($publications); ?>
									</div>
								</div>
							</div>
						<?php } ?>
						
					</div> <!-- end col-md-4 (sidebar) -->

					<div class="col-md-7 col-lg-8">
						<div>
							<?php echo($about); ?>
						</div>
						<?php if ($testimonials_array): ?>
							<div class="page-title-box text-center">
								<!-- <div class="cb-bar">
								</div> -->
								<h2 class="page-title">Testimonials</h2>
							</div>
						<?php if(count($testimonials_array) >= 2): ?>
						<div class="row"> 
							<div class="mb-5">
								<p><?php echo $testimonials_array[0]['t_text'] ?></p>
								<p>- <?php echo $testimonials_array[0]['t_client_name'] ?></p>
							</div>
							<div>
								<p><?php echo $testimonials_array[1]['t_text'] ?></p>
								<p>- <?php echo $testimonials_array[1]['t_client_name'] ?></p>
							</div>
						</div>
						<?php else: ?>
						<div class="row">
							<div class="single-testimonial">
								<p><?php echo $testimonials_array[0]['t_text'] ?></p>
								<p>- <?php echo $testimonials_array[0]['t_client_name'] ?></p>
							</div>
							<?php endif; ?>
							<div class="testimonials-cta">
								<a href="<?php echo esc_url( home_url( '/' )); ?>/testimonials/#<?php echo(strtolower($last_name)); ?>">
									<div class="cb-slide-button">Read More Testimonials</div>
								</a>
							</div>
						</div>
					</div> <!-- end col-md-8 (body) -->
				</div> <!-- end row -->
			<?php endif; ?> <!-- end testimonials if statement -->
			</div> <!-- end container -->



			<?php endwhile; // End of the loop.?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();

