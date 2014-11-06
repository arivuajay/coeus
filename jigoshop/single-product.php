<?php
/**
 * Product template
 *
 * DISCLAIMER
 *
 * Do not edit or add directly to this file if you wish to upgrade Jigoshop to newer
 * versions in the future. If you wish to customise Jigoshop core for your needs,
 * please use our GitHub repository to publish essential changes for consideration.
 *
 * @package             Jigoshop
 * @category            Catalog
 * @author              Jigoshop
 * @copyright           Copyright © 2011-2014 Jigoshop.
 * @license             GNU General Public License v3
 */
 ?>

<?php get_header('shop'); ?>

<?php do_action('jigoshop_before_main_content'); // <div id="container"><div id="content" role="main"> ?>

	<?php if ( have_posts() ) while ( have_posts() ) : 
	the_post(); 
	global $_product,$author; $jigoshop_options = Jigoshop_Base::get_options();
	 $_product = new jigoshop_product( $post->ID );
	//echo '<pre>'; var_dump($product_meta = new jigoshop_product_meta( $post->ID ));
	 ?>

		<?php do_action('jigoshop_before_single_product', $post, $_product); ?>

		

  <section class="accordion-section" id="singleProductTmpl">
  	<div class="container">
    	<div class="row">     
        
		  <?php /* COLUMN #1 */?>				
          <div class="col-sm-5 col-md-4 align-vertical no-align-mobile">
          <?php jigoshop_show_product_images() ?>
            <!--<img class="largeThumbnail" alt="" src="http://localhost/coeus_ftp/wp-content/uploads/2014/01/550x550_36x54-portrait-bishops-prayer-003-300x300.jpg"/>
            <div class="row">
              <div class="col-md-3"><img class="smallThumbnail" alt="" src="http://localhost/coeus_ftp/wp-content/uploads/2014/01/550x550_36x54-portrait-bishops-prayer-001.jpg"/></div>
              <div class="col-md-3"><img class="smallThumbnail" alt="" src="http://localhost/coeus_ftp/wp-content/uploads/2014/01/550x550_36x54-portrait-bishops-prayer-001.jpg"/></div>
              <div class="col-md-3"><img class="smallThumbnail" alt="" src="http://localhost/coeus_ftp/wp-content/uploads/2014/01/550x550_36x54-portrait-bishops-prayer-001.jpg"/></div>
              <div class="col-md-3"><img class="smallThumbnail" alt="" src="http://localhost/coeus_ftp/wp-content/uploads/2014/01/550x550_36x54-portrait-bishops-prayer-001.jpg"/></div>
            </div>    -->
          </div>
  
		  <?php /* COLUMN #2 */?>
          <div class="col-sm-7 col-md-4">
         <?php //do_action( 'jigoshop_template_single_summary', $post, $_product ); ?>
            <h1><?php echo apply_filters( 'jigoshop_single_product_title', the_title( '', '', false ) ); ?></h1>
            <span><?php echo $_product->get_categories( '| '); ?><br/> 
            <?php
			if ($jigoshop_options->get('jigoshop_enable_sku')=='yes' && !empty($_product->sku)) :
				echo __('Item#','jigoshop').' ' . $_product->sku;
			endif;
			?>
            </span>
            <h2>Size</h2>
            <span class="changing_length"></span><span class="changing_width"></span><span class="changing_height"></span>
           
           <?php //if($_product->get_weight()): ?>
            <h2>Weight</h2>
            <span class="changing_weight">Nill</span>
            <?php //endif; ?>
            <p>
            <?php 
            $content = get_the_content();
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		$content = apply_filters( 'jigoshop_single_product_content', $content );echo $content;?>
        </p>
           
          </div>

<?php /* COLUMN #3 */?>
<div class="col-md-4 hidden-sm align-vertical no-align-mobile">
	<h1>Frame Options</h1>
    <?php //jigoshop_variable_add_to_cart()?>
    <?php do_action( 'jigoshop_template_single_summary', $post, $_product ); ?>









</div><!-- /col-md-4 hidden-sm align-vertical no-align-mobile -->

</div><!-- /row -->
</div><!-- /container -->
</section>


		<?php /*?>	<?php do_action('jigoshop_before_single_product_summary', $post, $_product); ?>

			<div class="summary">

				<?php do_action( 'jigoshop_template_single_summary', $post, $_product ); ?>

			</div>

			<?php do_action('jigoshop_after_single_product_summary', $post, $_product); ?>

		</div>

		<?php do_action('jigoshop_after_single_product', $post, $_product); ?>



<?php do_action('jigoshop_after_main_content'); // </div></div> ?>

<?php do_action('jigoshop_sidebar'); ?>
<?php do_action('jigoshop_after_sidebar'); ?><?php */?>
	<?php endwhile; ?>






<?php get_footer('shop'); ?>
