<?php
/**
 * Template Name: Testimonials Index
 *
 * Description: The template for displaying testimonial index page
 *
 * @package Lydian_Center
 */

get_header();
?>
		
		<?php 
			while ( have_posts() ) : the_post();

			// get post objects for testimonials and practitioners ordered by last name
			$testimonials = get_posts(array(
				'post_type'			=> 'testimonials',
				'posts_per_page'	=> -1,
				'meta_key'			=> 'practitioner_last_name',
				'orderby'			=> 'meta_value',
				'order'				=> 'ASC'
			));
		?>

		<?php 
			$practitioners = get_posts(array(
				'post_type'			=> 'practitioners',
				'posts_per_page'	=> -1,
				'meta_key'			=> 'last_name',
				'orderby'			=> 'meta_value',
				'order'				=> 'ASC'
			));
		?>

		<?php
			// Practitioners
			// Create array of Practitioners to use in template
			$posts 					= $practitioners;
			$practitioners_array 	= array();
			$p_last_names 			= array();
			
			foreach( $posts as $post ): 			
			setup_postdata( $post )
		?>

			<?php 
				// Create variables for practitioners 
				$first_name		= get_field('first_name');
				$last_name		= get_field('last_name'); 								
				$practice		= get_field('practice'); 
			 	$certifications	= get_field('certifications'); 
			 	$p_photo		= get_field('practitioner_photo');
			 	$display_name	= get_the_title();

			 	// Create array of practitioner information
				$practitioners_array[] = array(
					'first_name'			=> $first_name,
					'last_name' 			=> $last_name, 
					'practice'  			=> $practice, 
					'certifications' 		=> $certifications,
					'practitioner_photo'	=> $p_photo,
					'display_name'			=> $display_name
				);
			  	$p_last_names[] = $last_name;
		  	?>

		<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>

		<?php 
		// Testimonials Data
			$posts = $testimonials;
			$testimonials_array = array();
			$t_last_names = array(); 

			foreach( $posts as $post ): 			
			setup_postdata( $post )
		?>

		<?php 
			// Create variables for testimonials 
				$t_first_name		= get_field('practitioner_first_name');
				$t_last_name		= get_field('practitioner_last_name');
				while(the_repeater_field('testimonials')): 								
					$t_text       		= get_sub_field('testimonial_text'); 
			 		$t_client_name 		= get_sub_field('client_name');
				 	// Create array of testimonial information
					$testimonials_array[] = array(
						'first_name'	=> $t_first_name,
						'last_name' 	=> $t_last_name, 
						't_text'  		=> $t_text, 
						't_client_name' => $t_client_name
					);
			 	endwhile;

		  	$t_last_names[] = $t_last_name;
		?>


		<?php endforeach; ?>
		<?php wp_reset_postdata(); ?>

		<?php 
			// Make unique testimonial last names array
			$unique_t_names = array_unique($t_last_names); 
		?> 

		<!-- Begin page HTML  -->
		<?php print_r($testimonials['post_date']); ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="container">
					<div class="page-title-box d-flex justify-content-center">
						<div class="cb-bar">
						</div>
						<h1 class="page-title">Testimonials</h1>
					</div>
					<div class="row">
						<!-- left sidebar -->
						<div class="col-12 col-md-3 testimonial-menu-container">
							<div class="testimonial-menu-tile">
								<h4 class="text-center">Search by Practitioner</h4>
								<ul id="testimonial-menu">
									<li class="search-by-practitioner align-items-center">
										<a href="#chiropractors">ASM Chiropractors</a>
										<!-- add bar and diamond behind each name -->
										<div class="cb-bar"></div>
									</li>

									<?php // loop through each practitioner in the array and print a link for their section 
										foreach($unique_t_names as $name):
											$article_id = strtolower($name);
										
										// print practitioner information if there is a testimonial for them
										foreach($practitioners_array as $p): 
											if($name == $p['last_name']): 
										?>
											<li class="search-by-practitioner align-items-center">
												<a href="#<?php echo $article_id; ?>"><?php echo $p['display_name'] ?></a>
												<!-- add bar and diamond behind each name -->
												<div class="cb-bar"></div>
											</li>
										<?php 
											endif;  
										endforeach; //$practitioners_array as $p loop 
									endforeach; //$unique_t_names as $name loop ?> 
								</ul><!-- .testimonial-menu -->
							</div>
						</div><!-- #testimonial-menu -->

						<!-- main content -->
						<div class="col-md-9">
							<!-- ASM Chiropractor info -->
							<div id="chiropractors" class="nav-to"></div>
								<article class="asm-testimonial-section">	
									<div class="row practitioner-info">	
										<div class="col-6 practitioner-image-frame">
												<?php echo wp_get_attachment_image(472, 'full'); ?>
										</div>
										<div class="col-6">
											<h3>ASM<sup>&reg;</sup> Chiropractors</h3>
										</div>
									</div>
								</article>
							<?php 
								$num = 0;
								foreach($unique_t_names as $name):
							?>
								<?php 
									$article_id = strtolower($name); 
								?>
								<div id="<?php echo $article_id ?>" class="nav-to"></div>
								<article class="testimonial-section">
									<?php
										// print practitioner information if there is a testimonial for them
										foreach($practitioners_array as $p): 
											if($name == $p['last_name']): 
									?>
									<div class="row practitioner-info">	
										<div class="col-6">
											<div class="col">
												<?php echo wp_get_attachment_image($p['practitioner_photo'], 'full'); ?>
											</div>
										</div>
									<div class="col-6">
										<h3>
											<?php echo $p['first_name'] ?> <?php echo $p['last_name'] ?><small>, <?php echo $p['certifications'] ?></small>
										</h3>
										<h4><?php echo $p['practice'] ?></h4>
									</div>
								</div>
								<?php 
										endif; 
									endforeach; // end practitioners arr for each
								?>
								<!-- All the testimonials for the current practitioner -->
								<div class="row testimonial-blocks"> 
									<?php
										// Print testimonials
										// $count = 0;			&& $count < 3						
											foreach($testimonials_array as $t): 
												if($name == $t['last_name'] ): 
											?>
											<div class="col-12 single-testimonial">
												<div class="row no-gutters quote-box">	
													<div class="col-1 quote-column text-center">
														<i class="fa fa-quote-left"></i>
													</div>
													<div class="col-11">
														<div class="testimonial-box <?php echo strtolower($t['last_name']); ?>-testimonial">
															<p><?php echo $t['t_text'] ?></p>
															<p class="text-right">- <?php echo $t['t_client_name'] ?></p>
														</div> <!-- end testimonial-box -->
													</div> <!-- end col-11 -->
												</div> <!-- end row no-gutters -->
											</div> <!-- end col-12 -->
										<?php 
												//$count++;
											  endif;  

											endforeach;
										
											// end testimonials arr for each ?>
								</div> <!-- end .testimonial-blocks -->

								<!-- Show/Hide other testimonials -->
									<div class="read-more-button read-more-<?php echo $article_id; ?> text-center" data-testimonial="<?php echo $num; ?>">
										<div class="cb-slide-button">See More Testimonials</div>
									</div> 

								</article> <!-- end .testimonial-section -->

							<?php $num++; endforeach; // end unique name foreach ?>


							<?php endwhile; // End of the loop. ?>
						</div> <!-- end main content column -->
					</div> <!-- .row -->
				</div> <!-- .container -->
			</main><!-- #main -->
		</div><!-- #primary -->
	<a href="#page">
	<div id="back-to-top">
		<div class="back-top-arrow"></div>
	</div>
	</a>
<?php

get_footer();
