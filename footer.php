<?php 
/* -------------------------------------------- +/
"FOOTER.PHP"
The footer file used in the core WP theme "Gallery Collection".

BOXBALLOON, llc.
www.boxballoon.com
/+ -------------------------------------------- */
?>

<div class="footer-container">
  <footer class="details">
    <div class="container">
      <div class="row">
      
      <?php /* column one */?>
      
        <div class="col-sm-4">
        	<img alt="logo" class="logo" src="<?php bloginfo('stylesheet_directory') ?>/img/logo-dark.png">
            <p>If you have questions, concerns, comments or suggestions we are always one click away and will get back with you as soon as possible to address your enquiry.</p>
          
          <h1>Social Profiles</h1>
          <ul class="social-icons">
            <li><a href="https://twitter.com/CrateCanvas" title="Crate Canvas (@CrateCanvas) | Twitter" target="_blank"><i class="icon social_twitter"></i></a></li>
            <li><a href="https://www.facebook.com/" title="Crate Canvas | Facebook" target="_blank"><i class="icon social_facebook"></i></a></li>
            <li><a href="http://instagram.com/cratecanvasart" title="Crate Canvas (@cratecanvasart) | Instagram" target="_blank"><i class="icon social_instagram"></i></a></li>
            <li> <a href="https://dribbble.com/" title="Crate Canvas (@cratecanvasart) | Dribble" target="_blank"><i class="icon social_dribbble"></i></a></li>
            <li><a href="http://cratecanvas.tumblr.com/" title="Crate Canvas (CrateCanvas.com) | Tumblr" target="_blank"><i class="icon social_tumblr"></i></a></li>
            <li><a href="http://www.pinterest.com/cratec/" title="Crate Canvas ('cratec') | Pinterest" target="_blank"><i class="icon social_pinterest"></i></a></li>
          </ul>
            
        </div>
        
        <?php /* column two */?>
        
        <div class="col-sm-4">
          <h1>Contact</h1>
          <p>support@cratecanvas.com<br>
            <br>
            Plano, TX<br>
            United States Of America</p>
        </div>
        
        <?php /* column three */?>
        
        <div class="col-sm-4">

            <h5>Leave A Message</h5>
            
            <div class="form-wrapper clearfix">
            <?php echo do_shortcode( '[contact-form-7 id="91" title="Footer Contact Form"]' ); ?>
            </div><!-- /form-wrapper clearfix -->
            
        </div>
        
      </div>
      
      <?php /* copyrights */?>
      
      <div class="row">
        <div class="col-sm-12">
        	<span class="sub">
            	<!-- &copy; Copright 2014 Notorious Warhol. All rights reserved. <a href="#">Library of Congress</a> -->
                &copy; 2014 Crate Canvas, Inc. Crate Canvas, the brand and all artwork are copyrights of Crate Canvas, Inc. All rights reserved.

            </span>
        </div>
      </div>
      
      
    </div><!-- /container -->
  </footer>
</div><!-- /footer-container -->

	<script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.plugin.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/bootstrap.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.flexslider-min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/smooth-scroll.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/skrollr.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/spectragram.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/scrollReveal.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/isotope.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/twitterFetcher_v10_min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/lightbox.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/jquery.countdown.min.js"></script> 
    <script src="<?php bloginfo('stylesheet_directory') ?>/js/scripts.js"></script>
  
  
  <?php wp_footer(); ?>
  </body>
</html>