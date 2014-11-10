<?php
/**
 * Pay for order form template
 *
 * DISCLAIMER
 *
 * Do not edit or add directly to this file if you wish to upgrade Jigoshop to newer
 * versions in the future. If you wish to customise Jigoshop core for your needs,
 * please use our GitHub repository to publish essential changes for consideration.
 *
 * @package             Jigoshop
 * @category            Checkout
 * @author              Jigoshop
 * @copyright           Copyright © 2011-2014 Jigoshop.
 * @license             GNU General Public License v3
 */
?>

<?php global $order;
$options = Jigoshop_Base::get_options();?>
       
      <section class="article-single" id="cartTmpl">
  <div class="container">
  
  <h1 class="cartTitle">Checkout Pay</h1>
  
    <div class="row">
    <?php jigoshop::show_messages(); ?>
            <div class="col-md-8 col-sm-9">
      
            <div class="row" id="gridHeader">
        <div class="col-md-6" id="gridHeaderLeft">
               
          <div class="row">
            <div class="col-md-4">
            <?php _e('IMG', 'jigoshop'); ?>
            </div>
            <div class="col-md-8" id="">
           <?php _e('Product', 'jigoshop'); ?>
            </div>
          </div>
        
        
        
        </div><!-- /gridHeaderLeft -->
        <div class="col-md-6" id="gridHeaderRight">
        
          <div class="row">
            <div class="col-md-4">
             <?php _e('Unit Price', 'jigoshop'); ?>
            </div><!-- / -->
            <div class="col-md-4" id="">
            <?php _e('Quantity', 'jigoshop'); ?>
            </div><!-- / -->
            <div class="col-md-4" id="">
            <?php _e('Price', 'jigoshop'); ?>
            </div><!-- / -->
          </div><!-- / -->
        
        </div><!-- /gridHeaderRight -->
      </div><!-- /gridHeader -->
     
    
      
      <?php //do_shortcode('[product id="'.$item['id'].'"]')
            if (sizeof($order->items) > 0) :
                foreach ($order->items as $item) :
				
				
				//echo do_shortcode('[product id="'.$item['id'].'"]');
				
				$unit_price = $item['cost']/$item['qty'];
                 ?>  
            <div class="row" id="cartItem">
        <div class="col-md-6" id="cartItemLeft">
        
          <div class="row">
            <div class="col-md-4">
           <?php /*?> <?php  echo $item['id'];
            $args_for_image = array('post_type'   => 'attachment','numberposts' => -1,'post_status' => 'any','post_parent' => $item['id'],	'exclude'=> get_post_thumbnail_id(),);
     $attachments = get_posts( $args_for_image );
if ( $attachments ) {
	
		echo //apply_filters( 'the_title', $attachment->post_title );
		//the_attachment_link( $attachment->ID, false );
		'<img src="'.$attachments[0]->guid.'" id="" class="" alt="" />';
	
}?><?php */?>
<?php 
$post->ID =  $item['id'];
   $thumb_id = 0;
   if (has_post_thumbnail()) :
   $thumb_id = get_post_thumbnail_id();
   $large_thumbnail_size = jigoshop_get_image_size( 'shop_large' );
    the_post_thumbnail($large_thumbnail_size);
    endif;
           ?>
			
            </div>
            <div class="col-md-8" id="">
            <a><?php echo $item['name'] ?></a>
            </div>
          </div>
        
        </div>
        <div class="col-md-6" id="cartItemRight">
        
          <div class="row">
            <div class="col-md-4">
            <?php echo jigoshop_price($unit_price)?>
            </div>
            <div class="col-md-4" id="">
				<?php echo $item['qty']?>
            </div> 
            <div class="col-md-4" id="">
           <?php echo jigoshop_price($item['cost'])?>
            </div>
          </div>
        
        </div>
      </div> <?php
                endforeach;
            endif;
            ?>
      
            <div class="row" id="cartTotal">
      
        <div class="col-md-6" id="cartTotalLeft"></div><!-- /cartTotalLeft -->
        
        <div class="col-md-6" id="cartTotalRight">
        
		<h2>Checkout Pay Totals</h2>
        
        <div class="row">
          <div class="col-md-5"><strong>Sub Total</strong></div><!-- / -->
          <div class="col-md-7">
          <?php if (($options->get('jigoshop_calc_taxes') == 'yes' && $order->has_compound_tax())
                        || ($options->get('jigoshop_tax_after_coupon') == 'yes' && $order->order_discount > 0)) : ?>
                   <?php _e('Retail Price', 'jigoshop'); ?>
                <?php else : ?>
                 <?php // _e('Subtotal', 'jigoshop'); ?>
                <?php endif; ?>
               <?php echo $order->get_subtotal_to_display(); ?>
           </div><!-- / -->
        </div><!-- / -->
        <div class="row">
          <div class="col-md-5"><strong><?php _e('Shipping', 'jigoshop'); ?></strong> <br/> <?php echo _x('To: ', 'shipping destination', 'jigoshop').__(jigoshop_customer::get_shipping_country_or_state(), 'jigoshop'); ?></div><!-- / -->
          <div class="col-md-7"><?php echo $order->get_shipping_to_display(); ?></div><!-- / -->
        </div><!-- / -->
        
        <?php 
        if ($options->get('jigoshop_tax_after_coupon') == 'yes' && $order->order_discount > 0) : ?>
             <div class="row">
                <div class="col-md-5">
                 <strong><?php _e('Discount', 'jigoshop'); ?></strong>
                </div><!-- / -->
                  <div class="col-md-7">
                 <?php echo jigoshop_price($order->order_discount); ?>
                  </div>
             </div> 
              
                <?php
            endif;
            if (($options->get('jigoshop_calc_taxes') == 'yes' && $order->has_compound_tax())
              || ($options->get('jigoshop_tax_after_coupon') == 'yes' && $order->order_discount > 0)) :
                ?>
                 <div class="row">
                   <div class="col-md-5">
                    <strong><?php _e('Subtotal', 'jigoshop'); ?></strong>
                    </div>
                      <div class="col-md-7">
                      <?php echo jigoshop_price($order->order_discount_subtotal); ?>
                      </div>
                  </div>
                   
                <?php
            endif;
            if ($options->get('jigoshop_calc_taxes') == 'yes') :
                foreach ($order->get_tax_classes() as $tax_class) :
                    if ($order->show_tax_entry($tax_class)) : ?>
                    
                    <div class="row">
                     <div class="col-md-5">
                      <strong><?php echo $order->get_tax_class_for_display($tax_class) . ' (' . (float) $order->get_tax_rate($tax_class) . '%):'; ?></strong>
                     </div>
                      <div class="col-md-7">
                      <?php echo $order->get_tax_amount($tax_class) ?>
                      </div>
                   </div>
                    
                        <?php
                    endif;
                endforeach;
            endif;
            if ($options->get('jigoshop_tax_after_coupon') == 'no' && $order->order_discount > 0) : ?>
             <div class="row">
                <div class="col-md-5">
                    <strong><?php _e('Discount', 'jigoshop'); ?></strong>
                 </div>
                 <div class="col-md-7">
                 -<?php echo jigoshop_price($order->order_discount); ?>
                 </div>
             </div>
             <?php endif; ?>
           
               <div class="row">
                  <div class="col-md-5">
                    <strong><?php _e('Grand Total', 'jigoshop'); ?></strong>
                  </div>
                  <div class="col-md-7">
		 	      <?php echo jigoshop_price($order->order_total); ?>
         		 </div>
              </div>
            
        
        
        
        
        </div>
      </div>
      
        


      
      
      </div><!-- /.col-md-8 .col-sm-9 -->
            <div class="col-sm-3 col-md-offset-1">
      
      </div><!-- /.col-sm-3 col-md-offset-1 -->
    </div><!-- /row -->
  </div>
</section>
      
      
      
<form id="pay_for_order" method="post">
    <?php /*?><table class="shop_table">
        <thead>
            <tr>
                <th><?php _e('Product', 'jigoshop'); ?></th>
                <th><?php _e('Qty', 'jigoshop'); ?></th>
                <th><?php _e('Totals', 'jigoshop'); ?></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <?php if (($options->get('jigoshop_calc_taxes') == 'yes' && $order->has_compound_tax())
                        || ($options->get('jigoshop_tax_after_coupon') == 'yes' && $order->order_discount > 0)) : ?>
                    <td colspan="2"><?php _e('Retail Price', 'jigoshop'); ?></td>
                <?php else : ?>
                    <td colspan="2"><?php _e('Subtotal', 'jigoshop'); ?></td>
                <?php endif; ?>
                <td><?php echo $order->get_subtotal_to_display(); ?></td>
            </tr>
            <?php
            if ($order->order_shipping > 0) :
                ?><tr>
                    <td colspan="2"><?php _e('Shipping', 'jigoshop'); ?></td>
                    <td><?php echo $order->get_shipping_to_display(); ?></small></td>
                </tr><?php
            endif;
            if ($options->get('jigoshop_tax_after_coupon') == 'yes' && $order->order_discount > 0) : ?>
                <tr class="discount">
                    <td colspan="2"><?php _e('Discount', 'jigoshop'); ?></td>
                    <td>-<?php echo jigoshop_price($order->order_discount); ?></td>
                </tr>
                <?php
            endif;
            if (($options->get('jigoshop_calc_taxes') == 'yes' && $order->has_compound_tax())
              || ($options->get('jigoshop_tax_after_coupon') == 'yes' && $order->order_discount > 0)) :
                ?><tr>
                    <td colspan="2"><?php _e('Subtotal', 'jigoshop'); ?></td>
                    <td><?php echo jigoshop_price($order->order_discount_subtotal); ?></td>
                </tr>
                <?php
            endif;
            if ($options->get('jigoshop_calc_taxes') == 'yes') :
                foreach ($order->get_tax_classes() as $tax_class) :
                    if ($order->show_tax_entry($tax_class)) : ?>
                        <tr>
                            <td colspan="2"><?php echo $order->get_tax_class_for_display($tax_class) . ' (' . (float) $order->get_tax_rate($tax_class) . '%):'; ?></td>
                            <td><?php echo $order->get_tax_amount($tax_class) ?></td>
                        </tr>
                        <?php
                    endif;
                endforeach;
            endif;
            if ($options->get('jigoshop_tax_after_coupon') == 'no' && $order->order_discount > 0) : ?><tr class="discount">
                    <td colspan="2"><?php _e('Discount', 'jigoshop'); ?></td>
                    <td>-<?php echo jigoshop_price($order->order_discount); ?></td>
                </tr><?php endif; ?>
            <tr>
                <td colspan="2"><strong><?php _e('Grand Total', 'jigoshop'); ?></strong></td>
                <td><strong><?php echo jigoshop_price($order->order_total); ?></strong></td>
            </tr>
        </tfoot>
        <tbody>
            <?php
            if (sizeof($order->items) > 0) :
                foreach ($order->items as $item) :
                    echo '
						<tr>
							<td>' . $item['name'] . '</td>
							<td>' . $item['qty'] . '</td>
							<td>' . jigoshop_price($item['cost']) . '</td>
						</tr>';
                endforeach;
            endif;
            ?>
        </tbody>
    </table><?php */?>

    <div id="payment">
        <?php if ($order->order_total > 0) : ?>
            <ul class="payment_methods methods">
                <?php
                $available_gateways = jigoshop_payment_gateways::get_available_payment_gateways();
                if ($available_gateways) :
                    // Chosen Method
                    if (sizeof($available_gateways))
                        current($available_gateways)->set_current();
                    foreach ($available_gateways as $gateway) :
                        ?>
                        <li>
                            <input type="radio" id="payment_method_<?php echo $gateway->id; ?>" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php if ($gateway->chosen)
                echo 'checked="checked"'; ?> />
                            <label for="payment_method_<?php echo $gateway->id; ?>"><?php echo $gateway->title; ?> <?php echo $gateway->icon(); ?></label>
                            <?php
                            if ($gateway->has_fields || $gateway->description) :
                                echo '<div class="payment_box payment_method_' . esc_attr( $gateway->id  ) . '" style="display:none;">';
                                $gateway->payment_fields();
                                echo '</div>';
                            endif;
                            ?>
                        </li>
                        <?php
                    endforeach;
                else :

                    echo '<p>' . __('Sorry, it seems that there are no available payment methods for your location. Please contact us if you require assistance or wish to make alternate arrangements.', 'jigoshop') . '</p>';

                endif;
                ?>
            </ul>
        <?php endif; ?>

        <div class="form-row">
            <?php jigoshop::nonce_field('pay') ?>
            <input type="submit" class="button-alt" name="pay" id="place_order" value="<?php _e('Pay for order', 'jigoshop'); ?>" />

        </div>

    </div>

</form>
