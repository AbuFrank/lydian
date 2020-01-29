<?php
/**
 * This is template for the single books pages
 *
 * @package Lydian_Center
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="container"> <!-- outer container -->

	<?php	while ( have_posts() ) : the_post();		?>

		<!-- Create variables for book info -->
		<?php 
			$title 						= get_field('title');
			$author 					= get_field('author');
			$summary					= get_field('summary');
			$purchase_link		= get_field('purchase_link');
			$book_image				= get_field('book_image');
		?>
		<div class="page-title-box d-flex justify-content-center">
		<div class="cb-bar">
		</div>
			<h1 class="page-title"><?php echo $title ?></h1>
			</div>
		</div>
		<div class="container"> <!-- inner container -->
			<h3 class="text-center">By <?php echo $author ?></h3>
			<div class="row book-section">
				<div>
					<?php the_content(); ?>
				</div>
				<div class=" col-12 text-center">
					<a href="<?php echo $purchase_link?>" target="_blank">
						<div class="cb-slide-button">Purchase Here</div>
					</a>
				</div>
			</div> <!-- end book section -->
			</div> <!-- end inner container -->
		</div> <!-- end outer container -->	
	<?php endwhile; // End of page loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
