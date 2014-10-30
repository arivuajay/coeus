<?php 
/* -------------------------------------------- +/
"PROJECTS-GALLERY.PHP"
Used in the core WP theme "Gallery Collection".

BOXBALLOON, llc.
www.boxballoon.com
/+ -------------------------------------------- */
?>
<section class="no-pad-bottom projects-gallery">

  <div class="container">
    <div class="row">
    
      <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 text-center">
      
        <h1>Check Out Some Of Our<br> Latest And Greatest Canvas Projects</h1>
        <p class="lead">We are offering iconic hip hop pop culture artwork on single, diptych, triptych and quad canvas prints. Our projects are always exclusive, limited edition and printed in limited quantities for each piece.</p>
        
      </div><!-- /text-center -->
    </div><!-- /row -->
  </div><!-- /container -->
  
  
  <div class="projects-wrapper clearfix">

	<?php
    /* --------------------------------- +/
    DATA FILTERS
    /+ --------------------------------- */
    ?>
    <div class="container">
      <div class="row">
        <ul class="filters">
          <li data-filter="*" class="active"><span>All</span></li>
          <li data-filter=".branding"><span>Diptych</span></li>
          <li data-filter=".development"><span>Triptych</span></li>
          <li data-filter=".print"><span>Quad</span></li>
        </ul>
      </div><!-- /row -->
    </div><!-- /container -->

	<?php
    /* --------------------------------- +/
    LOOP
    /+ --------------------------------- */
    ?>
    <div class="projects-container">
    
      <div class="col-md-6 col-sm-12 no-pad project development image-holder">
        <div class="background-image-holder">
          <img class="background-image" alt="Background Image" src="<?php bloginfo('stylesheet_directory') ?>/img/project1.jpg">
        </div><!-- /background-image-holder -->
        <div class="hover-state">
          <div class="align-vertical">
            <h1 class="text-white"><strong>Notorious</strong> Warhol</h1>
            <p class="text-white">Arguably the best emcee of all time it was <br/>a no-brainer to create for Christopher Wallace.</p>
            <a href="http://cratecanvas.com/product/notorious-warhol-36-by-54-seamless-ultra-thick-canvas-print/" class="btn btn-primary btn-white">See Project</a>
          </div><!-- /align-vertical -->
        </div><!-- /hover-state -->
      </div><!-- /image-holder -->
      
      <div class="col-md-6 col-sm-12 no-pad project development image-holder">
        <div class="background-image-holder">
          <img class="background-image" alt="Background Image" src="<?php bloginfo('stylesheet_directory') ?>/img/project2.jpg">
        </div><!-- /background-image-holder -->
        <div class="hover-state">
          <div class="align-vertical">
            <h1 class="text-white"><strong>Bishop's</strong> Prayer</h1>
            <p class="text-white">There is no one who has ever delivered <br/>the passion and conviction of Tupac Shakur.</p>
            <a href="http://cratecanvas.com/product/bisops-prayer-36-by-54-expresso-wood-frame-canvas-print/" class="btn btn-primary btn-white">See Project</a>
          </div><!-- /align-vertical -->
        </div><!-- /hover-state -->
      </div><!-- /image-holder -->
      
      <div class="col-md-4 col-sm-6 no-pad project print image-holder">
        <div class="background-image-holder">
        	<img class="background-image" alt="Background Image" src="<?php bloginfo('stylesheet_directory') ?>/img/project3.jpg">
        </div><!-- /background-image-holder -->
        <div class="hover-state">
          <div class="align-vertical">
            <h1 class="text-white"><strong>Uncle</strong></h1>
            <p class="text-white">Hands down the coolest dude in the galaxy and one the elders who raised us all.</p>
            <a href="http://cratecanvas.com/product/uncle-60-x-90-seamless-ultra-thick-triptych-canvas-print/" class="btn btn-primary btn-white">See Project</a>
          </div><!-- /align-vertical -->
        </div><!-- /hover-state -->
      </div><!-- /image-holder -->
      
      <div class="col-md-4 col-sm-6 no-pad project branding image-holder">
        <div class="background-image-holder">
        	<img class="background-image" alt="Background Image" src="<?php bloginfo('stylesheet_directory') ?>/img/project4.jpg">
        </div><!-- /background-image-holder -->
        <div class="hover-state">
          <div class="align-vertical">
            <h1 class="text-white"><strong>Onika’s</strong> Crown</h1>
            <p class="text-white">A depiction of the Trinidadian island girl turned hip hop pop culture queen.</p>
            <a href="http://cratecanvas.com/product/onikas-crown-60-x-90-seamless-ultra-thick-triptych-canvas-print/" class="btn btn-primary btn-white">See Project</a>
          </div><!-- /align-vertical -->
        </div><!-- /hover-state -->
      </div><!-- /image-holder -->
      
      <div class="col-md-4 col-sm-6 no-pad project print image-holder">
        <div class="background-image-holder">
          <img class="background-image" alt="Background Image" src="<?php bloginfo('stylesheet_directory') ?>/img/project5.jpg">
        </div><!-- /background-image-holder -->
        <div class="hover-state">
          <div class="align-vertical">
            <h1 class="text-white"><strong>C</strong> Sizzle</h1>
            <p class="text-white">We have watched this young man grow up in Hip Hop and it shows on his face.</p>
            <a href="http://cratecanvas.com/product/c-sizzle-60-x-90-seamless-ultra-thick-quad-canvas-print/" class="btn btn-primary btn-white">See Project</a>
          </div><!-- /align-vertical -->
        </div><!-- /hover-state -->
      </div><!-- /image-holder -->
      
    </div><!-- /projects-container -->
    
  </div><!-- /projects-wrapper -->
  
</section>
