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

<?php include('inc/hero-slider.php'); ?>

<?php include('inc/projects-gallery.php'); ?>

<?php include('inc/features.php'); ?>

<?php //include('inc/contact.php'); ?>

</div>

<?php get_footer(); ?>