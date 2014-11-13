<?php
/**
 * Loop shop template
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

<?php
global $columns, $per_page;

do_action('jigoshop_before_shop_loop');

$loop = 0;

if ( ! isset( $columns ) || ! $columns ) $columns = apply_filters( 'loop_shop_columns', 3 );

//only start output buffering if there are products to list
if ( have_posts() ) {
	ob_start();
}
$count = $wp_query->post_count;

if ( have_posts()) : while ( have_posts() ) : the_post(); $_product = new jigoshop_product( $post->ID ); $loop++;

	?>
	<li class="product <?php if ($loop == $count) echo 'last'; if ($loop==1) echo 'first'; ?>">

		<?php do_action('jigoshop_before_shop_loop_item'); ?>
		<a id="productAnchor" href="<?php the_permalink(); ?>">
			<?php do_action('jigoshop_before_shop_loop_item_title', $post, $_product); ?>
			<strong><?php the_title(); ?></strong>
		</a>
                <div class="short_desc">36 x 54 Single Canvas Print</div>
                <?php do_action('jigoshop_after_shop_loop_item_title', $post, $_product); ?>

		<?php do_action('jigoshop_after_shop_loop_item', $post, $_product); ?>
                
                <div class="clear"></div>
	</li><?php

	if ( $loop == $per_page ) break;

endwhile; endif;

if ( $loop == 0 ) :

	$content = '<p class="info">'.__('No products found which match your selection.', 'jigoshop').'</p>';

else :

	$found_posts = ob_get_clean();

	$content = '<ul id="crateCanvasProducts" class="products">' . $found_posts . '</ul>';

endif;

echo apply_filters( 'jigoshop_loop_shop_content', $content );

do_action( 'jigoshop_after_shop_loop' );
?>

<!--      <li class="product first">
      
      	<a id="productAnchor" href="http://livedemo00.template-help.com/jigoshop_47695/product/product-15/">
        <span class="onsale">Sale!</span>
        <img width="230" height="230" src="http://cratecanvas.com/wp-content/uploads/2014/01/550x550_36x54-portrait-bishops-prayer-003-300x300.jpg" class="attachment-shop_small wp-post-image" alt="sign_indoor_outdoor_all_weather_seating_by_piergiorgio_cazzaniga_1"> 
        <strong>Bisopâ€™s Prayer</strong> 
        </a>
        
        <div class="short_desc">36 x 54 Single Canvas Print</div>
        
        <span class="price">
        <del>$95.00</del>
        <ins>$80.00</ins>
        </span>
        
        <a id="detailsButton" href="http://livedemo00.template-help.com/jigoshop_47695/product/product-15/" class="btn"><b>Details</b></a>
        
        <a id="addToCartButton" href="#" class="button" rel="nofollow">
        <span class="glyphicon glyphicon-shopping-cart"></span>
        <b>Add to cart</b>
        </a>
        
        <div class="clear"></div>
        
      </li>-->