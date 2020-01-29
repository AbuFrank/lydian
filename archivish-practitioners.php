<?php
/**
 * Template Name: Practitioner Archive
 *
 * Description: The template page for displaying practitioner index page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Lydian_Center
 */

get_header();
?>

				<?php
				while ( have_posts() ) : the_post();

					// get post objects for practitioners
					$practitioners = get_posts(array(
						'post_type'			=> 'practitioners',
						'posts_per_page'	=> -1,
						'meta_key'			=> 'last_name',
						'orderby'			=> 'meta_value',
						'order'				=> 'ASC'
					));
					$posts = $practitioners;
					$practitioners_array = array();
					$last_names = array();
					?>
					<?
					// loop each post and get info
					foreach( $posts as $post ): setup_postdata( $post );
						// Create variables for practitioners 
						if (get_field('last_name') != 'Lennihan') {
							$name 			= get_the_title();
							$first_name 	= get_field('first_name');
							$last_name		= get_field('last_name');
							$certifications	= get_field('certifications');
							$practice		= get_field('practice');
							$photo			= get_field('practitioner_photo'); 
						
							// Create array of practitioner information
							$practitioners_array[] = array(
								'name'				=> $name,
								'first_name'		=> $first_name,
								'last_name'			=> $last_name,
								'certifications' 	=> $certifications, 
								'practice'  	   	=> $practice, 
								'photo' 			=> $photo
							);
							$last_names[] 	= array( 'name' => $last_name); 
						} //end Lennihan if
					endforeach; wp_reset_postdata();
			
							foreach($practitioners_array as $key => $value) {
								    if ($value['last_name'] == 'Knutson') {
										unset($practitioners_array[$key]);//removes the array at given index
										$reindex = array_values($practitioners_array); //normalize index
										$practitioners_array = $reindex; //update variable
								    }
								}

							$num_ppl 	= count($last_names); 
							$num 		= 0;
					?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="page-title-box d-flex justify-content-center">
					<div class="cb-bar">
					</div>
					<h1 class="page-title">Practitioners</h1>
				</div><!-- .page-title-box -->
			</div><!-- .container -->
			<div class="container">
				<a class="knutson-block" href="<?php echo get_home_url();?>/?practitioners=lydia-h-knutson">	
					<div class="row practitioner-tile">
						<div class="col-sm-6 text-right">
							<div class="practitioner-photo-box">
								<?php echo wp_get_attachment_image(470, 'full') ?>
							</div>
						</div> <!-- end col-md-6 -->
						<div class="col-sm-6 d-flex align-items-center">
							<div class="practitioner-info-box">
								<h3 style="margin-bottom: 0;">Lydia H. Knutson</h3>
								<ul class="practitioner">
									<li>D.C., M.M.</li>
									<li>Founder of the Lydian Center</li>
									<li>Chiropractic</li>
								</ul>
								<div class="cb-bar p-bar-1">
								</div>
								<div class="cb-bar p-bar-2">
								</div>
								<div class="cb-bar p-bar-3">
								</div>
								<div class="cb-bar p-bar-4">
								</div>
							</div>
						</div><!-- .practitioner-info-box -->
					</div><!-- end .row .practitioner-tile  -->
				</a><!-- end .knutson-block -->
				<div class="row">
					<?php while($num < $num_ppl - 1): ?>	
					<?php 
						$lwr_first = strtolower($practitioners_array[$num]['first_name']);
						$lwr_last = strtolower($practitioners_array[$num]['last_name']);
					?>
					<div id="practitioner<?php echo $num?>" class="practitioner-tile col-lg-4 col-sm-6">
						<!-- <div class="practitioner-tile"> -->
							<a href="<?php echo get_home_url();?>/?practitioners=<?php echo $lwr_first ?>-<?php echo $lwr_last ?>">	
								<div class="practitioner-photo-box">
									<?php echo wp_get_attachment_image($practitioners_array[$num]['photo'], 'full') ?>
								</div>
								<div class="practitioner-info-box">
									<h3 style="margin-bottom: 0;"><?php echo $practitioners_array[$num]['name'] ?></h3>
									<ul class="practitioner">
										<li><?php echo $practitioners_array[$num]['certifications'] ?></li>
										<li><?php echo $practitioners_array[$num]['practice'] ?></li>
									</ul>
									<div class="cb-bar p-bar-1">
									</div>
									<div class="cb-bar p-bar-2">
									</div>
									<div class="cb-bar p-bar-3">
									</div>
								</div><!-- .practitioner-info-box -->
							</a>
						<!-- </div> -->
					</div>
					<?php
					$num++; endwhile; //end of the div loop 
					endwhile; // End of the page loop.
					?>
				</div> <!-- end row -->
			</div> <!-- end container fluid -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
