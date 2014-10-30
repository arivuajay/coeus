<?php 
 
/* -------------------------------------------- +/
"INDEX.PHP"
The index file used in the core WP theme "Gallery Collection".

BOXBALLOON, llc.
www.boxballoon.com
/+ -------------------------------------------- */

get_header();

?>

<div class="main-container">

<?php //include('inc/hero-slider.php'); ?>

<?php //include('inc/projects-gallery.php'); ?>

<?php include('inc/features.php'); ?>

<?php //include('inc/contact.php'); ?>

<?php if ( have_posts() ) : ?>

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>


</div>

<?php get_footer(); ?>