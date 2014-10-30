<?php
/**
 * @var $order jigoshop_order Order to display.
 * @var $options Jigoshop_Options Options container.
 */
do_action('jigoshop_before_order_summary_details', $order->id);
?>

<div class="main-container">
  <section class="article-single" id="cartTmpl">
    <div class="container">
      <h1 class="cartTitle">
        <?php the_title(); ?>
      </h1>
      <h2><?php echo sprintf(__('Order %s made on %s.', 'jigoshop'), $order->get_order_number(), date_i18n(get_option('date_format').' '.get_option('time_format'), strtotime($order->order_date))); ?>.</h2>
      <h2><?php echo sprintf(__('Order status: %s', 'jigoshop'), sanitize_title($order->status), __($order->status, 'jigoshop')); ?>
        </h3>
        <?php do_action('jigoshop_tracking_details_info', $order); ?>
      </h2>
      <h2>
        <?php _e('Order Details', 'jigoshop'); ?>
      </h2>
      <div class="row">
        <?php /* LEFT COLUMN */ ?>
        <div class="col-md-8 col-sm-9">
          <?php /* GRID HEADER */ ?>
          <div class="row" id="gridHeader">
            <div class="col-md-6" id="gridHeaderLeft">
              <div class="row">
                <div class="col-md-4">
                  <?php _e('ID/SKU', 'jigoshop'); ?>
                </div>
                <!-- / -->
                <div class="col-md-8" id="">
                  <?php _e('Product Name', 'jigoshop'); ?>
                </div>
                <!-- / --> 
              </div>
              <!-- / --> 
              
            </div>
            <!-- /gridHeaderLeft -->
            
            <div class="col-md-6" id="gridHeaderRight">
              <div class="row">
                <div class="col-md-4">
                  <?php _e('Unit Price', 'jigoshop'); ?>
                </div>
                <!-- / -->
                <div class="col-md-4" id="">
                  <?php _e('Quantity', 'jigoshop'); ?>
                </div>
                <!-- / -->
                <div class="col-md-4" id="">
                  <?php _e('Price', 'jigoshop'); ?>
                </div>
                <!-- / --> 
              </div>
              <!-- / --> 
              
            </div>
            <!-- /gridHeaderRight --> 
          </div>
          <!-- /gridHeader -->
          
          <?php if (sizeof($order->items) > 0): ?>
          <?php foreach ($order->items as $item): ?>
          <?php
				if (isset($item['variation_id']) && $item['variation_id'] > 0){
					$product = new jigoshop_product_variation($item['variation_id']);

					if (is_array($item['variation'])) {
						$product->set_variation_attributes($item['variation']);
					}
				} else {
					$product = new jigoshop_product($item['id']);
				}
			?>
          <div class="row" id="cartItem">
            <div class="col-md-6" id="cartItemLeft">
              <div class="row">
                <div class="col-md-4"><?php echo $product->get_sku(); ?></div>
                <!-- / -->
                <div class="col-md-8" id=""><?php echo $item['name']; ?>
                  <?php if ($product instanceof jigoshop_product_variation): ?>
                  <?php echo jigoshop_get_formatted_variation($product, $item['variation']); ?>
                  <?php endif; ?>
                  <?php do_action('jigoshop_display_item_meta_data', $item); ?>
                </div>
                <!-- / --> 
              </div>
              <!-- / --> 
              
            </div>
            <!-- /cartItemLeft -->
            <div class="col-md-6" id="cartItemRight">
              <div class="row">
                <div class="col-md-4"><?php echo jigoshop_price($item['cost']); ?></div>
                <!-- / -->
                <div class="col-md-4" id=""><?php echo $item['qty']; ?></div>
                <!-- / -->
            <?php 
			$price_product = jigoshop_price($item['cost']);
            $remove=array(',','$');
            $price_product = str_replace($remove, '', $price_product);
			$quantity_product = $item['qty'];
			$total_cost = $price_product  * $quantity_product; 
			?>
                <div class="col-md-4" id=""><?php echo '$'.$total_cost; ?></div>
                <!-- / --> 
              </div>
              <!-- / --> 
              
            </div>
            <!-- /cartItemRight --> 
          </div>
          <!-- /#cartItem -->
          <?php endforeach; ?>
          <?php endif; ?>
          <div class="row" id="cartTotal">
            <div class="col-md-6" id="cartTotalLeft"></div>
            <!-- /cartTotalLeft -->
            
            <div class="col-md-6" id="cartTotalRight">
              <h2>Cart Totals</h2>
              <div class="row">
                <div class="col-md-5"><strong>
                  <?php _e('Sub Total', 'jigoshop'); ?>
                  </strong></div>
                <!-- / -->
                <div class="col-md-7"><?php echo $order->get_subtotal_to_display(); ?> <br/>
                </div>
                <!-- / --> 
              </div>
              <!-- / -->
              
              <div class="row">
                <div class="col-md-5"><strong>Shipping</strong> <br/>
                  To: <?php echo get_user_meta(get_current_user_id(), 'billing_first_name', true).' '.get_user_meta(get_current_user_id(), 'billing_last_name', true); ?></div>
                <!-- / -->
                <div class="col-md-7"><?php echo $order->get_shipping_to_display(); ?> <br/>
                  via Flat Rate</div>
                <!-- / --> 
                <!-- / --> 
              </div>
              <!-- / -->
              
              <div class="row">
                <?php if ($options->get('jigoshop_calc_taxes') == 'yes'): ?>
                <?php foreach ($order->get_tax_classes() as $tax_class): ?>
                <?php if ($order->show_tax_entry($tax_class)): ?>
                <div class="col-md-5"><strong><?php echo $order->get_tax_class_for_display($tax_class).' ('.(float)$order->get_tax_rate($tax_class).'%):'; ?><br/>
                  Estimated For: <br/>
                  <?php echo get_user_meta(get_current_user_id(), 'billing_country', true); ?></div>
                <!-- / -->
                <div class="col-md-7"><?php echo $order->get_tax_amount($tax_class) ?></div>
                <!-- / -->
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
              </div>
              <!-- / -->
              
              <div class="row">
                <div class="col-md-5"><strong>
                  <?php _e('Total', 'jigoshop'); ?>
                  </strong></div>
                <!-- / -->
                <div class="col-md-7"><?php echo jigoshop_price($order->order_discount_subtotal); ?></div>
                <!-- / --> 
              </div>
              <!-- / --> 
              
            </div>
            <!-- /cartTotalRight --> 
          </div>
          
          <!--<table class="shop_table">
	
	<tfoot>
	<tr>
		<?php if (($options->get('jigoshop_calc_taxes') == 'yes' && $order->has_compound_tax()) || ($options->get('jigoshop_tax_after_coupon') == 'yes' && $order->order_discount > 0)): ?>
			<td colspan="3"><strong><?php _e('Retail Price', 'jigoshop'); ?></strong></td>
		<?php else: ?>
			<td colspan="3"><strong><?php //_e('Subtotal', 'jigoshop'); ?></strong></td>
		<?php endif; ?>
		<td><strong><?php echo $order->get_subtotal_to_display(); ?></strong></td>
	</tr>
	<?php if ($order->order_shipping > 0): ?>
		<tr>
			<td colspan="3"><?php _e('Shipping', 'jigoshop'); ?></td>
			<td><?php echo $order->get_shipping_to_display(); ?></small></td>
		</tr>
	<?php endif; ?>
	<?php do_action('jigoshop_processing_fee_after_shipping'); ?>
	<?php if ($options->get('jigoshop_tax_after_coupon') == 'yes' && $order->order_discount > 0): ?>
		<tr class="discount">
		<td colspan="3"><?php _e('Discount', 'jigoshop'); ?></td>
		<td>-<?php echo jigoshop_price($order->order_discount); ?></td>
		</tr>
	<?php endif; ?>
	<?php if (($options->get('jigoshop_calc_taxes') == 'yes' && $order->has_compound_tax())
		|| ($options->get('jigoshop_tax_after_coupon') == 'yes' && $order->order_discount > 0)): ?>
		<tr>
			<td colspan="3"><strong><?php _e('Subtotal', 'jigoshop'); ?></strong></td>
			<td><strong><?php echo jigoshop_price($order->order_discount_subtotal); ?></strong></td>
		</tr>
	<?php endif; ?>
	<?php if ($options->get('jigoshop_calc_taxes') == 'yes'): ?>
		<?php foreach ($order->get_tax_classes() as $tax_class): ?>
			<?php if ($order->show_tax_entry($tax_class)): ?>
				<tr>
					<td colspan="3"><?php echo $order->get_tax_class_for_display($tax_class).' ('.(float)$order->get_tax_rate($tax_class).'%):'; ?></td>
					<td><?php //echo $order->get_tax_amount($tax_class) ?></td>
				</tr>
			<?php endif; ?>
		<?php endforeach; ?>
	<?php endif; ?>
	<?php if ($options->get('jigoshop_tax_after_coupon') == 'no' && $order->order_discount > 0): ?>
		<tr class="discount">
			<td colspan="3"><?php _e('Discount', 'jigoshop'); ?></td>
			<td>-<?php echo jigoshop_price($order->order_discount); ?></td>
		</tr>
	<?php endif; ?>
	<tr>
		<td colspan="3"><strong><?php _e('Grand Total', 'jigoshop'); ?></strong></td>
		<td><strong><?php echo jigoshop_price($order->order_total); ?></strong></td>
	</tr>
	<?php if ($order->customer_note): ?>
		<tr>
			<td><strong><?php _e('Note:', 'jigoshop'); ?></strong></td>
			<td colspan="3" style="text-align: left;"><?php echo wpautop(wptexturize($order->customer_note)); ?></td>
		</tr>
	<?php endif; ?>
	</tfoot>
	<tbody>
	<?php if (sizeof($order->items) > 0): ?>
		<?php foreach ($order->items as $item): ?>
			<?php
				if (isset($item['variation_id']) && $item['variation_id'] > 0){
					$product = new jigoshop_product_variation($item['variation_id']);

					if (is_array($item['variation'])) {
						$product->set_variation_attributes($item['variation']);
					}
				} else {
					$product = new jigoshop_product($item['id']);
				}
			?>
			
            
            
		<?php endforeach; ?>
	<?php endif; ?>
	</tbody>
</table>-->
          <?php do_action('jigoshop_before_order_customer_details', $order->id); ?>
          <div class="row" id="cartTotal">
            <div class="col-md-6" id="cartTotalLeft">
              <h2>
                <?php _e('Customer details', 'jigoshop'); ?>
              </h2>
              <div class="row">
                <div class="col-md-5">
                  <?php if ($order->billing_email): ?>
                  <strong><?php echo __('Email:', 'jigoshop'); ?></strong>
                  <div><?php echo $order->billing_email; ?></div>
                  <?php endif; ?>
                </div>
                <!-- /.col-md-5 -->
                
                <div class="col-md-7"></div>
                <!-- / --> 
              </div>
              <div class="row">
                <div class="col-md-5">
                  <?php if ($order->billing_phone): ?>
                  <strong><?php echo __('Telephone:', 'jigoshop'); ?></strong>
                  <div><?php echo $order->billing_phone; ?></div>
                  <?php endif; ?>
                </div>
                <!-- /.col-md-5 -->
                
                <div class="col-md-7"></div>
                <!-- / --> 
              </div>
            </div>
            <!-- /cartTotalLeft -->
            
            <div class="col-md-6" id="cartTotalRight"></div>
            <!-- /cartTotalRight --> 
          </div>
          <!-- /#cartTotal -->
          
          <div class="row" id="cartTotal">
            <div class="col-md-6" id="cartTotalLeft">
              <?php do_action('jigoshop_before_order_shipping_address', $order->id); ?>
              <h2>
                <?php _e('Shipping Address', 'jigoshop'); ?>
              </h2>
              <div class="row">
                <div class="col-md-5">
                  <p>
                    <?php if (!$order->formatted_shipping_address): ?>
                    <?php _e('N/A', 'jigoshop'); ?>
                    <?php else: ?>
                    <?php echo $order->formatted_shipping_address; ?>
                    <?php endif; ?>
                  </p>
                  <?php do_action('jigoshop_after_order_shipping_address', $order->id); ?>
                </div>
                <!-- /.col-md-5 -->
                
                <div class="col-md-7"></div>
                <!-- / --> 
              </div>
            </div>
            <!-- /cartTotalLeft -->
            
            <div class="col-md-6" id="cartTotalRight">
              <?php do_action('jigoshop_before_order_billing_address', $order->id); ?>
              <h2>
                <?php _e('Billing Address', 'jigoshop'); ?>
              </h2>
              <div class="row">
                <div class="col-md-5">
                  <p>
                    <?php if (!$order->formatted_billing_address): ?>
                    <?php _e('N/A', 'jigoshop'); ?>
                    <?php else: ?>
                    <?php echo $order->formatted_billing_address; ?>
                    <?php endif; ?>
                  </p>
                  <?php do_action('jigoshop_after_order_billing_address', $order->id); ?>
                </div>
                <!-- /.col-md-5 -->
                
                <div class="col-md-7"></div>
                <!-- / --> 
              </div>
              <!-- / --> 
              
            </div>
            <!-- /cartTotalRight --> 
          </div>
          <!-- /#cartTotal --> 
          
        </div>
        <!-- /.col-md-8 .col-sm-9 -->
        <?php /* RIGHT COLUMN */ ?>
        <div class="col-sm-3 col-md-offset-1"> </div>
        <!-- /.col-sm-3 col-md-offset-1 --> 
      </div>
      <!-- /row --> 
    </div>
  </section>
</div>
<!-- /main-container --> 

