<?php 
/* -------------------------------------------- +/
"HEADER.PHP"
The header file used in the core WP child theme "Gallery Collection".
Parent Theme: 'twentyfourteen'

BOXBALLOON, llc.
www.boxballoon.com
/+ -------------------------------------------- */
?>

<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link href="<?php bloginfo('stylesheet_directory') ?>/style.css" rel="stylesheet" type="text/css" media="all"/>

<style type="text/css"></style>

<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700%7CRaleway:700' rel='stylesheet' type='text/css'>

<script src="<?php bloginfo('stylesheet_directory') ?>/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>

<!-- WP Head -->
<?php wp_head(); ?>
<!--<script src="<?php //echo get_template_directory_uri(); ?>/js/modified.js"></script>-->
<link href="<?php bloginfo('stylesheet_directory') ?>/tmpl-custom-styles.css" rel="stylesheet" type="text/css" media="all"/>
</head>

<body>
<!-- 
<div class="loader">
  <div class="spinner">
    <div class="double-bounce1"></div>
    <div class="double-bounce2"></div>
  </div>
</div>
-->
<div class="nav-container">
  <nav class="top-bar">
    <div class="container">
      <div class="row nav-menu">
        <div class="col-md-2 col-sm-3 columns">
        	<img class="logo logo-light" alt="Logo" src="<?php bloginfo('stylesheet_directory') ?>/img/logo-light.png">
            <img class="logo logo-dark" alt="Logo" src="<?php bloginfo('stylesheet_directory') ?>/img/logo-dark.png">
        </div>
        <div class="col-md-10 col-sm-9 columns">
          <ul class="social-icons text-right">
            <li><a href="https://twitter.com/CrateCanvas" title="Crate Canvas (@CrateCanvas) | Twitter" target="_blank"><i class="icon social_twitter"></i></a></li>
            <li><a href="https://www.facebook.com/" title="Crate Canvas | Facebook" target="_blank"><i class="icon social_facebook"></i></a></li>
            <li><a href="http://instagram.com/cratecanvasart" title="Crate Canvas (@cratecanvasart) | Instagram" target="_blank"><i class="icon social_instagram"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="mobile-toggle">
      	<i class="icon icon_menu"></i>
      </div>
    </div>
  </nav>
</div><!-- /.nav-container -->