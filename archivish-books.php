<?php
/**
 * Template Name: Books Archive
 * Description: The template page for displaying books index page
 * Dynamically displays book info for pracitioners
 * @package Lydian_Center
 */

get_header();
?>

<?php while ( have_posts() ) : the_post(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<div class="container"> <!-- outer container -->
			<div class="page-title-box d-flex text-center justify-content-center">
				<div class="cb-bar">
				</div>
				<h1 class="page-title">Books by Lydian Center Practitioners</h1>
			</div>
			<div class="text-center">
				<?php the_content(); ?>
			</div>


		<!-- Create variables for book info -->
		<?php 
			$books = get_posts(array(
				'post_type'			=> 'books',
				'posts_per_page'	=> -1,
				'meta_key'			=> 'last_name',
				'orderby'			=> 'meta_value',
				'order'				=> 'DSC'
			));
			$posts 			= $books;
			$books_arr 		= array();
			$last_names 	= array();
		?>
		<?php
		// loop each post and get info
		foreach( $posts as $post ): setup_postdata( $post );
			if(get_field('last_name') != 'Lennihan' ) {
				// Create variables for practitioners 
				$title 			= get_field('title');
				$first_name = get_field('first_name');
				$last_name	= get_field('last_name');
				$author			= get_field('author');
				$purchase		= get_field('purchase_link');
				$image			= get_field('book_image');
				$permalink	= get_the_permalink();
			
				// Create array of practitioner information
				$books_arr[] = array(
					'title'			 	=> $title,
					'first_name' 	=> $first_name,
					'last_name'	 	=> $last_name,
					'author' 		 	=> $author, 
					'purchase'		=> $practice,
					'image'			 	=> $image,
					'permalink'	 	=> $permalink	
				);

				$names[] = array( 
					'last_name'		=> 	$last_name,
					'first_name'	=>	$first_name
				); 

				$names = array_unique($names, SORT_REGULAR);

			} //end Lennihan if
		endforeach; wp_reset_postdata();
		?>
		<div class="row book-section">
		<?php	
			$nameNum = 0;
			foreach($names as $ln):
				$nameNum++;
				if($nameNum < 2):
		?>
				<h1 class="author"><?php echo $ln['first_name'] ?> <?php echo $ln['last_name'] ?></h1>
		<?php
				endif;
				foreach($books_arr as $b):
			 		if($b['last_name'] == $ln['last_name']):
						if($nameNum < 2):
		?>		
							<div class="book-column col-sm-6 col-md-4">
								<a href="<?php echo $b['permalink']?>">
									<?php echo wp_get_attachment_image($b['image'], 'full') ?>
								</a>
							</div>
		<?php 			elseif($nameNum > 1): ?>
							<div class="book-column col-12 col-sm-6 mb-5">
								<h1 class="author"><?php echo $ln['first_name'] ?> <?php echo $ln['last_name'] ?></h1>
								<a href="<?php echo $b['permalink']?>">
									<?php echo wp_get_attachment_image($b['image'], 'full') ?>
								</a>
							</div>
		<?php 			
						endif; //filter out first two authors
					endif; //matching name list with book list
				endforeach; //recursively go through  books
			endforeach; //recursively go through names
		?>
		</div> <!-- .row.book-section -->	
		</div> <!-- .container -->
	<?php endwhile; // End of page loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
