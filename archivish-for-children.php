<?php
/**
 * Template Name: For Children
 * Description: Utilizes boostrap collapsable cards to 
 * Condense large amounts of copy into easily navigatable
 * segments
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * 
 * @package Lydian_Center
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<div class="container">
				<div class="page-title-box d-flex justify-content-center">
					<!-- fancy bar with diamonds -->
					<div class="cb-bar">
					</div>
			<?php
					while ( have_posts() ) : the_post();
					?>
					<h1 class="page-title"><?php the_title(); ?></h1>
				</div> <!-- end page title box -->
				<div>
					<?php the_content(); ?>
				</div>
				<article>
					<?php
					// get post objects from For Children
						$for_children = get_posts(array(
							'post_type'			=> 'forchildren',
							'posts_per_page'	=> -1,
							'orderby'			=> 'display_order',
							'order'				=> 'DSC'
						));
					?>

					<?php
						// For Children
						// Create array of Healing Modalities to use in template
						// These will create the tab segments for each age group
						$posts 					= $for_children;
						$children_array 		= array();
						$card_num				= 0;
						
						foreach( $posts as $post ): 			
						setup_postdata( $post )
						?>
							<?php 
							// Create variables for healing modalities
							$title			= get_the_title();
							$overview		= get_field('overview');
							$brain_gym		= get_field('brain_gym'); 								
							$chiropractic	= get_field('chiropractic'); 
						 	$homeopathy		= get_field('homeopathy');
						 	$neurology		= get_field('integrative_neurology');
						 	
						 	// Fill in array of healing modalities information
							$children_array[] = array(
								'overview'						=> $overview,
								'brain_gym' 					=> $brain_gym, 
								'chiropractic'  			=> $chiropractic, 
								'practitioner_photo'	=> $homeopathy,
								'neurology'						=> $neurology				
							);
							$low_title = strtolower($title);
							$card_class = str_replace(' ', '', $low_title);
							$card_num++;
					  		?>

					  	<!-- Age group card header and container-->
					  	<div id="<?php echo $card_class?>-card" class="nav-to"></div>
						<div class="card <?php echo $card_class ?>">
							<a class="card-header collapsed" id="heading<?php echo $card_num ?>" href="#<?php echo $card_class?>-card" data-toggle="collapse" data-target="#collapse<?php echo $card_num ?>" aria-expanded="true" aria-controls="collapse<?php echo $card_num ?>">
						      	<h2><?php echo $title ?></h2>
						      	<div class="plus-minus-toggle d-flex align-items-center"></div>
							</a> <!-- end .card-header -->

							<!-- age group content -->
							<div class="container outer-<?php echo $card_class ?>-container">
								<div id="collapse<?php echo $card_num ?>" class="collapse inner-age-group-container" aria-labelledby="heading<?php echo $card_num ?>" data-parent="#accordion">
									<div class="card-body">
										<!-- nav menu with tab structure showing modalities-->
										<nav class="modality-menu d-flex d-lg-inline justify-content-center">
										<button class="btn btn-secondary dropdown-toggle mod-menu-button" type="button" id="mobile-modality-button" data-toggle="dropdown" aria-controls="#tab<?php echo $card_num ?>" aria-haspopup="true" aria-expanded="false">
											Select a Modality
										</button>
										<ul class="nav nav-tabs dropdown-menu mod-menu" id="tab<?php echo $card_num ?>" role="tablist" aria-labelledby="mobile-modality-button">
											<?php if ($overview) {?>
											<li class="nav-item">
												<a class="nav-link children-nav-tab active" id="overview<?php echo $card_num ?>-tab" data-toggle="tab" href="#overview<?php echo $card_num ?>" role="tab" aria-controls="overview<?php echo $card_num ?>" aria-selected="true">Overview</a>
											</li>
											<?php } ?>
											<?php if ($brain_gym) {?>
											<li class="nav-item">
												<a class="nav-link children-nav-tab" id="brain-gym<?php echo $card_num ?>-tab" data-toggle="tab" href="#brain_gym<?php echo $card_num ?>" role="tab" aria-controls="brain_gym<?php echo $card_num ?>" aria-selected="true">Brain Gym<sup>&reg;</sup></a>
											</li>
											<?php } ?>
											<?php if ($chiropractic) {?>
											<li class="nav-item">
												<a class="nav-link children-nav-tab" id="chiropractic<?php echo $card_num ?>-tab" data-toggle="tab" href="#chiropractic<?php echo $card_num ?>" role="tab" aria-controls="chiropractic<?php echo $card_num ?>" aria-selected="true">ASM<sup>&reg;</sup> Chiropractic</a>
											</li>
											<?php } ?>
											<?php if ($homeopathy) {?>
											<li class="nav-item">
												<a class="nav-link children-nav-tab" id="homeopathy<?php echo $card_num ?>-tab" data-toggle="tab" href="#homeopathy<?php echo $card_num ?>" role="tab" aria-controls="homeopathy<?php echo $card_num ?>" aria-selected="true">Homeopathy</a>
											</li>
											<?php } ?>
											<?php if ($neurology) {?>
											<li class="nav-item">
												<a class="nav-link children-nav-tab" id="integrative_neurology<?php echo $card_num ?>-tab" data-toggle="tab" href="#integrative_neurology<?php echo $card_num ?>" role="tab" aria-controls="integrative_neurology<?php echo $card_num ?>" aria-selected="true">Integrative Neurology</a>
											</li>
											<?php } ?>
										</ul> <!-- .nav-tabs -->
										</nav>
										<div class="tab-content container">
											<?php if ($overview){?>
											<div class="tab-pane fade show active" id="overview<?php echo $card_num ?>" role="tabpanel" aria-labelledby="overview<?php echo $card_num ?>-tab">
												<?php echo $overview ?>
											</div>
											<?php } ?>
											<?php if ($brain_gym){?>
											<div class="tab-pane fade" id="brain_gym<?php echo $card_num ?>" role="tabpanel" aria-labelledby="brain_gym<?php echo $card_num ?>-tab">
												<?php echo $brain_gym ?>
											</div>
											<?php } ?>
											<?php if ($chiropractic){?>
											<div class="tab-pane fade" id="chiropractic<?php echo $card_num ?>" role="tabpanel" aria-labelledby="chiropractic<?php echo $card_num ?>-tab">
												<?php echo $chiropractic ?>
											</div>
											<?php } ?>
											<?php if ($homeopathy){?>
											<div class="tab-pane fade" id="homeopathy<?php echo $card_num ?>" role="tabpanel" aria-labelledby="homeopathy<?php echo $card_num ?>-tab">
												<?php echo $homeopathy ?>
											</div>
											<?php } ?>
											<?php if ($neurology){?>
											<div class="tab-pane fade" id="integrative_neurology<?php echo $card_num ?>" role="tabpanel" aria-labelledby="integrative_neurology<?php echo $card_num ?>-tab">
												<?php echo $neurology ?>
											</div>
											<?php } ?>
										</div> <!-- .tab-content -->
									</div> <!-- .card-body -->
						    	</div> <!-- #collapse -->
						    </div> <!-- .container -->
						</div> <!-- .card -->
				  		<?php
						endforeach; // age group loop
						?>
						<?php 
						wp_reset_postdata(); 
						?>
			
					<?php
					endwhile; // End of the loop.
					?>
				</article> <!-- #accordian -->
			</div> <!-- .container -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
