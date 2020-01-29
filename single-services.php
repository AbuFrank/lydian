<?php
/**
 * The template for individual services pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Lydian_Center
 */

get_header();
?>

		<?php
		while ( have_posts() ) : the_post();
			// Add ACF services variables
			$image 					= get_field('service_image');
			$service_type 	= get_field('service_type');
			$service_links	= get_field('external_links');
			?>
			
			<?php 
					// Retrieve practioners object from database
					$practitioners = get_posts(array(
						'post_type'				=> 'practitioners',
						'posts_per_page'	=> -1,
						'meta_key'				=> 'last_name',
						'orderby'					=> 'meta_value',
						'order'						=> 'ASC'
					));
				?>
				
				<?php 
					// Create accessible array of practitioners
					$posts = $practitioners;
					$practitioners_array = array();

					foreach( $posts as $post ): 			
					setup_postdata( $post )
				?>

				<?php 
					// Create variables for practitioners
					$first_name			= get_field('first_name');
					$last_name      = get_field('last_name'); 								
					$practice       = get_field('practice'); 
				 	$certifications = get_field('certifications'); 
				 	$phone 					= get_field('phone_number');
				 	$service 				= get_field('service_name');
				 	$p_photo 				= get_field('practitioner_photo');
				 	$links					= get_field('external_links');
				 	$scheduling			= get_field('booking_button');

				 	// Split up service name of practitioners into array
				 	$trimmed 		= trim($service);
				 	$p_service 	= explode(',', $service);

				 	// Array of practitioner objects
				 	$practitioners_array[] = array(
						'first_name'					=> $first_name,
						'last_name' 					=> $last_name, 
						'practice'  					=> $practice, 
						'certifications'			=> $certifications,
						'phone'  							=> $phone,
						'photo' 							=> $p_photo,
						'scheduling'					=> $scheduling,
						'p_service_name'			=> $p_service
					);

				  endforeach; wp_reset_postdata();?>
				  <?php 
				  	// Reverse order of homeopathic practitioners so Begabati appears first
				  	foreach($practitioners_array as $key => $value) {
							if ($value['last_name'] == 'Lennihan') {
								$begabati = $practitioners_array[$key];
				        unset($practitioners_array[$key]);//removes the array at given index
	    					$reindex = array_values($practitioners_array); //normalize index
	    					$practitioners_array = $reindex; //update variable
	    					
				        break;
								    }
								}
					?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="page-title-box d-flex text-center justify-content-center">
					<div class="cb-bar">
					</div>
					<?php the_title('<h1 class="service-title">', '</h1>');?>
				</div>
				<div class="row">
					<div class="col-md-7 col-lg-8 main-content">
						<?php the_content();?>
					</div> <!-- end main-content -->

					<div class="col-md-5 col-lg-4 sidebar-content">
						<?php foreach($practitioners_array as $p): 
									foreach($p['p_service_name'] as $p_service):
										if($service_type == $p_service && $p_service != "Energy Kinesiology" && $p_service != "Brain Gym" && $p_service != "ASM Chiropractic" && $p_service != "Homeopathy" && $p_service != "Integrative Family Medicine"){
						?>
						<div class="sidebar-text">		
								<div class="practitioner-image">
									<?php echo wp_get_attachment_image($p['photo'], "full");?>
								</div>
								<div>
									<a href="<?php echo get_home_url();?>/?practitioners=<?php echo $p['first_name']?>-<?php echo $p['last_name']?>">			
										<h3 class="sidebar-practitioner-name"><?php echo($p['first_name']);?> <?php echo($p['last_name']) ?><small>,</small></h3>  
									</a>
									<h5 class="sidebar-practitioner-name"><?php echo($p['certifications']);?></h5>
								</div>

								<!-- Scheduling button phone screen -->
								<div class="schedule-appt-wrapper"><a href="tel:<?php echo($p['phone']);?>">	
									<div class="schedule-appt-button d-block d-sm-none ">
										<div class="text-center">BOOK APPOINTMENT</div>
										<div class="text-center schedule-appt-text">
											Call <?php echo($p['phone']);?>
										</div>
									</div>
								</a></div>

								<!-- Scheduling button iPad, laptop screen -->
								<div class="schedule-appt-button d-none d-sm-block">
									<div class="text-center">BOOK APPOINTMENT</div>
									<div class="text-center schedule-appt-text">
										Call 
										<?php echo($p['phone']); ?>
									</div>
								</div>

								<!-- If practitioner has a button to an external scheduler -->
								<div>
									<?php echo $p['scheduling'] ?>
								</div>
							</div>
						<?php	} ?>

						<?php 
							// Eve specific sidebar
							if($p['practice'] == "Brain Gym" && $service_type == "Brain Gym" ){ ?>
							<div class="sidebar-text">		
								<div class="practitioner-image">
									<?php echo wp_get_attachment_image($p['photo'], "full");?>
								</div>
								<div>
									<a href="<?php echo get_home_url();?>/?practitioners=<?php echo $p['first_name']?>-<?php echo $p['last_name']?>">			
										<h3 class="sidebar-practitioner-name"><?php echo($p['first_name']);?> <?php echo($p['last_name']) ?><small>,</small></h3>   
									</a>
									<h5 class="sidebar-practitioner-name"><?php echo $p['certifications'] ?></h5>
								</div>
								<!-- Scheduling button phone screen -->
									<div class="schedule-appt-wrapper"><a href="tel:<?php echo($p['phone']);?>">	
									<div class="schedule-appt-button d-block d-sm-none ">
										<div class="text-center">
											Phone Appointments Only</div>
										<div class="text-center schedule-appt-text">
											Call <?php echo($p['phone']);?>
										</div>
									</div>
								</a></div>

								<!-- Scheduling button iPad, laptop screen -->
								<div class="schedule-appt-button d-none d-sm-block">
									<div class="text-center">Phone Appointments Only</div>
									<div class="text-center schedule-appt-text">
										Call 
										<?php echo($p['phone']); ?>
									</div>
								</div>

								<!-- Book Appointment Button to SquareUp -->
								<div>
									<?php //echo $p['scheduling'] ?>
								</div>
							</div>
						<?php } elseif($p['practice'] == "Classical Homeopathy" && $service_type == "Homeopathy" ){ ?>
							<div class="sidebar-text">		
								<div class="practitioner-image">
									<?php echo wp_get_attachment_image($p['photo'], "full");?>
								</div>
								<div>
									<a href="<?php echo get_home_url();?>/?practitioners=<?php echo $p['first_name']?>-<?php echo $p['last_name']?>">			
										<h3 class="sidebar-practitioner-name"><?php echo($p['first_name']);?> <?php echo($p['last_name']) ?><small>,</small></h3>   
									</a>
									<h5 class="sidebar-practitioner-name"><?php echo $p['certifications'] ?></h5>
								</div>
								<!-- Scheduling button phone screen -->
								<div class="schedule-appt-wrapper"><a href="tel:<?php echo($p['phone']);?>">	
									<div class="schedule-appt-button d-block d-sm-none ">
										<div class="text-center">BOOK APPOINTMENT</div>
										<div class="text-center schedule-appt-text">
											Call <?php echo($p['phone']);?>
										</div>
									</div>
								</a></div>

								<!-- Scheduling button iPad, laptop screen -->
								<div class="schedule-appt-button d-none d-sm-block">
									<div class="text-center">BOOK APPOINTMENT</div>
									<div class="text-center schedule-appt-text">
										Call 
										<?php echo($p['phone']); ?>
									</div>
								</div>
							</div>

						<?php } elseif($p['practice'] == "Integrative Family Medicine" && $service_type == "Integrative Family Medicine"){ ?>
							<div class="sidebar-text">		
								<div class="practitioner-image">
									<?php echo wp_get_attachment_image($p['photo'], "full");?>
								</div>
								<div>
									<a href="<?php echo get_home_url();?>/?practitioners=<?php echo $p['first_name']?>-<?php echo $p['last_name']?>">			
										<h3 class="sidebar-practitioner-name"><?php echo($p['first_name']);?> <?php echo($p['last_name']) ?><small>,</small></h3>   
									</a>
									<h5 class="sidebar-practitioner-name"><?php echo $p['certifications'] ?></h5>
								</div>
								<?php if($p['last_name'] == 'Sutton'){?>
								<div class="schedule-appt-wrapper">
									<a href="https://ksuttonboston.as.me/" target="_blank">
										<div class="schedule-appt-button">
											<div class="text-center">BOOK APPOINTMENT</div>
										</div>
									</a>
								</div>
								<p></p>
								<h4>Questions? Call <a href="tel:6178766777" class="d-inline d-md-none">617-876-6777</a><span class="d-none d-md-inline">617-876-6777</span></h4>
								<h5>Press #, dial 53559#, then press 2</h5>
								
								<div>If you have any problems, please email <a href="mailto:ksutton@lydiancenter.com" target="_blank" rel="noopener">ksutton@lydiancenter.com</a>. Thank you!</div>
							</div> <!-- .sidebar-text -->
								
								<?php } ?>

						<?php } elseif($p['practice'] == "Chiropractic" && $service_type == "ASM Chiropractic" ){ ?>
							<div class="sidebar-text">		
								<div class="practitioner-image">
									<?php echo wp_get_attachment_image($p['photo'], "full");?>
								</div>
								<div>
									<a href="<?php echo get_home_url();?>/?practitioners=<?php echo $p['first_name']?>-<?php echo $p['last_name']?>">			
										<h3 class="sidebar-practitioner-name"><?php echo($p['first_name']);?> <?php echo($p['last_name']) ?><small>,</small></h3>  
									</a>
									<h5 class="sidebar-practitioner-name"><?php echo($p['certifications']);?></h5>
								</div>
							</div>
						<?php } ?>
					<?php endforeach; endforeach; ?>
							<?php if($service_type != "ASM Chiropractic"): ?>	
								<?php if($service_links): ?>	
									<div class="sidebar-text">	
										<h4>Links</h4>
										<div><?php echo $service_links  ?>
										</div>
									</div>
								<?php endif; endif; ?>
							<?php if ($service_type == "ASM Chiropractic" ): ?>
									<div class="sidebar-text">
										<!-- Scheduling button phone screen -->
										<div class="schedule-appt-wrapper"><a href="tel:617-876-9099">	
											<div class="schedule-appt-button d-block d-sm-none ">
												<div class="text-center">BOOK APPOINTMENT</div>
												<div class="text-center schedule-appt-text">
													Call 617-876-9099
												</div>
											</div>
										</a></div>

										<!-- Scheduling button iPad, laptop screen -->
										<div class="schedule-appt-button d-none d-sm-block">
											<div class="text-center">BOOK APPOINTMENT</div>
											<div class="text-center schedule-appt-text">
												Call 617-876-9099</div>
										</div>
	
								<?php if($service_links): ?>	
										<h4 style="margin-top: 1.5rem;">Links</h4>
										<div><?php echo $service_links  ?>
										</div>
									</div>
								<?php endif; ?>
							<?php endif; ?>
					</div><!-- .sidebar-content -->
				</div><!-- .row -->
		
			</div><!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->
<?php endwhile; // End of the loop. ?>

<?php
get_footer();
