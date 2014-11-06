<?php
/**
 * @var $cart array Cart items.
 * @var $coupons array List of applied coupons.
 */
$options = Jigoshop_Base::get_options();
?>



<section class="article-single" id="cartTmpl">
  <div class="container">
  
  <h1 class="cartTitle">Cart</h1>
  
    <div class="row">
    <?php jigoshop::show_messages(); ?>
      <?php /* LEFT COLUMN */ ?>
    <?php if (count($cart) == 0): ?>
	<p><?php _e('Your cart is empty.', 'jigoshop'); ?></p>
	<p><a href="<?php echo esc_url(jigoshop_cart::get_shop_url()); ?>" class="button"><?php _e('&larr; Return to Shop', 'jigoshop'); ?></a></p>
	<?php else: ?>

      <div class="col-md-8 col-sm-9">
      
      <form class="form-cart-items" action="<?php echo esc_url(jigoshop_cart::get_cart_url()); ?>" method="post">
      <?php /* GRID HEADER */ ?>
      <div class="row" id="gridHeader">
        <div class="col-md-6" id="gridHeaderLeft">
        
          <div class="row">
            <div class="col-md-4">
            <?php _e('IMG', 'jigoshop'); ?>
            </div><!-- / -->
            <div class="col-md-8" id="">
            <?php _e('Product Name', 'jigoshop'); ?>
            </div><!-- / -->
          </div><!-- / -->
        
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
            <?php /*?><div class="col-md-3">
            <?php _e('Remove', 'jigoshop'); ?>
            </div><?php */?><!-- / -->
          </div><!-- / -->
        
        </div><!-- /gridHeaderRight -->
      </div><!-- /gridHeader -->
      
      <?php do_action('jigoshop_shop_table_cart_head'); ?>
      
      <?php foreach ($cart as $cart_item_key => $values): ?>
      <?php
			$product = $values['data'];
			if ($product->exists() && $values['quantity'] > 0) :
				$additional_description = jigoshop_cart::get_item_data($values);
				?>
		  <div class="row" id="cartItem">
			<div class="col-md-6" id="cartItemLeft">
			
			  <div class="row">
				<div class="col-md-4">
				<a href="<?php echo esc_url(apply_filters('jigoshop_product_url_display_in_cart', get_permalink($values['product_id']), $cart_item_key)); ?>">
								<?php
								if ($values['variation_id'] && jigoshop_cart_has_post_thumbnail($cart_item_key, $values['variation_id'])) {
									echo jigoshop_cart_get_post_thumbnail($cart_item_key, $values['variation_id'], 'shop_tiny');
								} else if (jigoshop_cart_has_post_thumbnail($cart_item_key, $values['product_id'])) {
									echo jigoshop_cart_get_post_thumbnail($cart_item_key, $values['product_id'], 'shop_tiny');
								} else {
									echo '<img src="'.JIGOSHOP_URL.'/assets/images/placeholder.png" alt="Placeholder" width="'.jigoshop::get_var('shop_tiny_w').'" height="'.jigoshop::get_var('shop_tiny_h').'" />';
								}
								?></a>
				</div><!-- / -->
				<div class="col-md-8" id="">
				<a href="<?php echo esc_url(apply_filters('jigoshop_product_url_display_in_cart', get_permalink($values['product_id']), $cart_item_key)); ?>">
								<?php echo apply_filters('jigoshop_cart_product_title', $product->get_title(), $product); ?>
							</a>
							<?php echo $additional_description; ?>
							<?php
							if (!empty($values['variation_id'])) {
								$product_id = $values['variation_id'];
							} else {
								$product_id = $values['product_id'];
							}
							$custom_products = (array)jigoshop_session::instance()->customized_products;
							$custom = isset($custom_products[$product_id]) ? $custom_products[$product_id] : '';
							if (!empty($custom_products[$product_id])):
								?>
								<dl class="customization">
									<dt class="customized_product_label"><?php echo apply_filters('jigoshop_customized_product_label', __('Personal: ', 'jigoshop')); ?></dt>
									<dd class="customized_product"><?php echo esc_textarea($custom); ?></dd>
								</dl>
							<?php
							endif;
							?>
				</div><!-- / -->
			  </div><!-- / -->
			
			</div><!-- /cartItemLeft -->
			<div class="col-md-6" id="cartItemRight">
			
			  <div class="row">
				<div class="col-md-4">
				<?php echo apply_filters('jigoshop_product_price_display_in_cart', jigoshop_price($product->get_price_excluding_tax()), $values['product_id'], $values); ?>
				</div><!-- / -->
                <div class="product-quantity">
				<div class="col-md-4 product-quantity-subparent" id="">
                	<div class="quantity2" data-item="<?php echo $cart_item_key; ?>" data-product="<?php echo $product->id; ?>">
                	<input type="text" value="<?php echo esc_attr($values['quantity']); ?>" id="" class="form-control qty qty2" maxlength="12" name="cart[<?php echo $cart_item_key ?>][qty]">
                    </div>
                    
					<?php /*?><?php ob_start(); // It is important to keep quantity in single line ?>
					<div class="quantity" data-item="<?php echo $cart_item_key; ?>" data-product="<?php echo $product->id; ?>"><input name="cart[<?php echo $cart_item_key ?>][qty]" value="<?php echo esc_attr($values['quantity']); ?>" size="4" title="Qty" class="input-text qty text" maxlength="12" /></div>
					<?php
						$quantity_display = ob_get_clean();
						echo apply_filters('jigoshop_product_quantity_display_in_cart', $quantity_display, $values['product_id'], $values);
                    ?><?php */?>
				</div>
                <!-- / -->
				<div class="col-md-4 product-subtotal" id="">
				<?php echo apply_filters('jigoshop_product_subtotal_display_in_cart', jigoshop_price($product->get_price_excluding_tax() * $values['quantity']), $values['product_id'], $values); ?>
				</div><!-- / -->
                </div>
                
                <!--Remove icon -->
                <?php /*?><div class="col-md-3">
                <a href="<?php echo esc_url(jigoshop_cart::get_remove_url($cart_item_key)); ?>" class="remove" title="<?php echo esc_attr(__('Remove this item.', 'jigoshop')); ?>">&times;</a>
	            </div><?php */?><!-- / -->

			  </div><!-- / -->
			
			</div><!-- /cartItemRight -->
		  </div><!-- /#cartItem -->
      <?php
			endif;
		endforeach;
		do_action('jigoshop_shop_table_cart_body');
		?>
      </form>

      <?php /* CART TOTAL */ ?>
      <div class="row" id="cartTotal">
      
        <div class="col-md-6" id="cartTotalLeft">
        <?php if (JS_Coupons::has_coupons()): ?>
                <div class="coupon">
                    <label for="coupon_code"><?php _e('Coupon', 'jigoshop'); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" />
                    <input type="submit" class="button" name="apply_coupon" value="<?php _e('Apply Coupon', 'jigoshop'); ?>" />
                </div>
            <?php endif; ?>

            <?php jigoshop::nonce_field('cart') ?>

            <?php if ($options->get('jigoshop_cart_shows_shop_button') == 'no'): ?>
                <noscript>
                    <input type="submit" class="button" name="update_cart" value="<?php _e('Update Shopping Cart', 'jigoshop'); ?>" />
                </noscript>
                <a href="<?php echo esc_url(jigoshop_cart::get_checkout_url()); ?>" class="checkout-button button-alt"><?php _e('Proceed to Checkout &rarr;', 'jigoshop'); ?></a>
            <?php else: ?>
                <noscript>
                    <input type="submit" class="button" name="update_cart" value="<?php _e('Update Shopping Cart', 'jigoshop'); ?>" />
                </noscript>
            <?php endif; ?>
            
            <?php if (count($coupons)): ?>
                <div>
                    <span class="applied-coupons-label"><?php _e('Applied Coupons: ', 'jigoshop'); ?></span>
                    <?php foreach ($coupons as $code): ?>
                        <a href="?unset_coupon=<?php echo $code; ?>" id="<?php echo $code; ?>" class="applied-coupons-values"><?php echo $code; ?>
                            <span class="close">&times;</span>
                        </a>
                    <?php endforeach; ?>
                </div>
        <?php endif; ?>
        
        </div><!-- /cartTotalLeft -->
        
        
        <div class="col-md-6 cart_totals_table" id="cartTotalRight">
        <?php do_action('cart-collaterals'); ?>
        <?php
		// Hide totals if customer has set location and there are no methods going there
		$available_methods = jigoshop_shipping::get_available_shipping_methods();

		if ($available_methods || !jigoshop_customer::get_shipping_country() || !jigoshop_shipping::is_enabled()):
			do_action('jigoshop_before_cart_totals');
			?>
		<h2><?php _e('Cart Totals', 'jigoshop'); ?></h2>
        
        
        <div class="row">
          <?php $price_label = jigoshop_cart::show_retail_price() ? __('Retail Price', 'jigoshop') : __('Subtotal', 'jigoshop'); ?>
          <div class="col-md-5 cart-row-subtotal-title"><strong><?php echo $price_label; ?></strong></div><!-- / -->
          <div class="col-md-7 cart-row-subtotal"><?php echo jigoshop_cart::get_cart_subtotal(true, false, true); ?></div><!-- / -->
        </div><!-- / -->
        
        <?php if (jigoshop_cart::get_cart_shipping_total()): ?>
        <div class="row">
          <div class="col-md-5 cart-row-shipping-title"><strong><?php _e('Shipping', 'jigoshop'); ?></strong> <br/> <?php echo _x('To: ', 'shipping destination', 'jigoshop').__(jigoshop_customer::get_shipping_country_or_state(), 'jigoshop'); ?></div><!-- / -->
          <div class="col-md-7 cart-row-shipping"><?php echo jigoshop_cart::get_cart_shipping_total(true, true); ?> <br/> <?php echo jigoshop_cart::get_cart_shipping_title(); ?></div><!-- / -->
        </div><!-- / -->
		<?php endif; ?>
        
        <?php if (jigoshop_cart::show_retail_price() && $options->get('jigoshop_prices_include_tax') == 'no'): ?>
						<div class="row">
							<div class="col-md-5 cart-row-subtotal-title"><strong><?php _e('Subtotal', 'jigoshop'); ?></strong></div>
							<div class="col-md-7 cart-row-subtotal"><?php echo jigoshop_cart::get_cart_subtotal(true, true); ?></div>
						</div>
					<?php elseif (jigoshop_cart::show_retail_price()): ?>
						<div class="row">
							<div class="col-md-5 cart-row-subtotal-title"><strong><?php _e('Subtotal', 'jigoshop'); ?></strong></div>
							<?php
							$price = jigoshop_cart::$cart_contents_total_ex_tax + jigoshop_cart::$shipping_total;
							$price = jigoshop_price($price, array('ex_tax_label' => 1));
							?>
							<div class="col-md-7 cart-row-subtotal"><?php echo $price; ?></div>
						</div>
		<?php endif; ?>

		<?php if (jigoshop_cart::tax_after_coupon()): ?>
            <div class="row discount">
                <div class="col-md-5 cart-row-discount-title"><strong><?php _e('Discount', 'jigoshop'); ?></strong></div>
                <div class="col-md-7 cart-row-discount">-<?php echo jigoshop_cart::get_total_discount(); ?></div>
            </div>
		<?php endif; ?>
        
        <?php if ($options->get('jigoshop_calc_taxes') == 'yes'):
			foreach (jigoshop_cart::get_applied_tax_classes() as $tax_class):
				if (jigoshop_cart::get_tax_for_display($tax_class)) : ?>
					<div class="row" data-tax="<?php echo $tax_class; ?>">
						<div class="col-md-5 cart-row-tax-title"><strong><?php echo jigoshop_cart::get_tax_for_display($tax_class) ?></strong></div>
						<div class="col-md-7 cart-row-tax"><?php echo jigoshop_cart::get_tax_amount($tax_class) ?></div>
					</div>
				<?php
				endif;
			endforeach;
		endif; ?>
        
        <?php if (!jigoshop_cart::tax_after_coupon() && jigoshop_cart::get_total_discount()): ?>
            <div class="row">
                <div class="col-md-5 cart-row-discount-title"><strong><?php _e('Discount', 'jigoshop'); ?></strong></div>
                <div class="col-md-7 cart-row-discount">-<?php echo jigoshop_cart::get_total_discount(); ?></div>
            </div>
        <?php endif; ?>
                                        
        <div class="row">
          <div class="col-md-5 cart-row-total-title"><strong><?php _e('Total', 'jigoshop'); ?></strong></div><!-- / -->
          <div class="col-md-7 cart-row-total"><?php echo jigoshop_cart::get_total(); ?></div><!-- / -->
        </div><!-- / -->
        
        </div><!-- /cartTotalRight -->
      </div><!-- /#cartTotal -->
      <?php 
	  endif; ?>
      
      <?php /* CART BUTTONS */ ?>
      <?php if ($options->get('jigoshop_cart_shows_shop_button') == 'yes') : ?>
      <div class="row" id="cartButtons">
        <div class="col-md-6" id="cartButtonsLeft">

          <div class="form-group" id="continueShopping">
            <button type="button" class="btn btn-primary btn-lg" onclick="location.href ='<?php echo esc_url(jigoshop_cart::get_shop_url()); ?>'"><?php _e('&larr; Continue Shopping', 'jigoshop'); ?></button>
          </div>

        </div><!-- /#cartButtonsLeft -->
        
        <div class="col-md-6" id="cartButtonsRight">

          <div class="form-group" id="proceedToCheckout">
            <button type="button" class="btn btn-primary btn-lg" onclick="location.href ='<?php echo esc_url(jigoshop_cart::get_checkout_url()); ?>'"><?php _e('Proceed to Checkout &rarr;', 'jigoshop'); ?></button>
          </div>

        </div><!-- /#cartButtonsRight -->
      </div><!-- /#cartButtons -->
      <?php endif ?>


      
      
      </div><!-- /.col-md-8 .col-sm-9 -->
      <?php endif; ?>
      <?php /* RIGHT COLUMN */ ?>
      <div class="col-sm-3 col-md-offset-1">
      
      </div><!-- /.col-sm-3 col-md-offset-1 -->
    </div><!-- /row -->
  </div>
</section>

<?php /*?><?php jigoshop::show_messages(); ?>

<?php if (count($cart) == 0): ?>
	<p><?php _e('Your cart is empty.', 'jigoshop'); ?></p>
	<p><a href="<?php echo esc_url(jigoshop_cart::get_shop_url()); ?>" class="button"><?php _e('&larr; Return to Shop', 'jigoshop'); ?></a></p>
<?php else: ?>
<form class="form-cart-items" action="<?php echo esc_url(jigoshop_cart::get_cart_url()); ?>" method="post">
	<table class="shop_table cart" cellspacing="0">
		<thead>
		<tr>
			<th class="product-remove"></th>
			<th class="product-thumbnail"></th>
			<th class="product-name"><span class="nobr"><?php _e('Product Name', 'jigoshop'); ?></span></th>
			<th class="product-price"><span class="nobr"><?php _e('Unit Price', 'jigoshop'); ?></span></th>
			<th class="product-quantity"><?php _e('Quantity', 'jigoshop'); ?></th>
			<th class="product-subtotal"><?php _e('Price', 'jigoshop'); ?></th>
		</tr>
		<?php do_action('jigoshop_shop_table_cart_head'); ?>
		</thead>
		<tbody>
		<?php foreach ($cart as $cart_item_key => $values): ?>
		        <!-- @var jigoshop_product $product -->
				<?php
				
				$product = $values['data'];
				if ($product->exists() && $values['quantity'] > 0) :
					$additional_description = jigoshop_cart::get_item_data($values);
					?>
					<tr data-item="<?php echo $cart_item_key; ?>" data-product="<?php echo $product->id; ?>">
						<td class="product-remove">
							<a href="<?php echo esc_url(jigoshop_cart::get_remove_url($cart_item_key)); ?>" class="remove" title="<?php echo esc_attr(__('Remove this item.', 'jigoshop')); ?>">&times;</a>
						</td>
						<td class="product-thumbnail">
							<a href="<?php echo esc_url(apply_filters('jigoshop_product_url_display_in_cart', get_permalink($values['product_id']), $cart_item_key)); ?>">
								<?php
								if ($values['variation_id'] && jigoshop_cart_has_post_thumbnail($cart_item_key, $values['variation_id'])) {
									echo jigoshop_cart_get_post_thumbnail($cart_item_key, $values['variation_id'], 'shop_tiny');
								} else if (jigoshop_cart_has_post_thumbnail($cart_item_key, $values['product_id'])) {
									echo jigoshop_cart_get_post_thumbnail($cart_item_key, $values['product_id'], 'shop_tiny');
								} else {
									echo '<img src="'.JIGOSHOP_URL.'/assets/images/placeholder.png" alt="Placeholder" width="'.jigoshop::get_var('shop_tiny_w').'" height="'.jigoshop::get_var('shop_tiny_h').'" />';
								}
								?></a>
						</td>
						<td class="product-name">
							<a href="<?php echo esc_url(apply_filters('jigoshop_product_url_display_in_cart', get_permalink($values['product_id']), $cart_item_key)); ?>">
								<?php echo apply_filters('jigoshop_cart_product_title', $product->get_title(), $product); ?>
							</a>
							<?php echo $additional_description; ?>
							<?php
							if (!empty($values['variation_id'])) {
								$product_id = $values['variation_id'];
							} else {
								$product_id = $values['product_id'];
							}
							$custom_products = (array)jigoshop_session::instance()->customized_products;
							$custom = isset($custom_products[$product_id]) ? $custom_products[$product_id] : '';
							if (!empty($custom_products[$product_id])):
								?>
								<dl class="customization">
									<dt class="customized_product_label"><?php echo apply_filters('jigoshop_customized_product_label', __('Personal: ', 'jigoshop')); ?></dt>
									<dd class="customized_product"><?php echo esc_textarea($custom); ?></dd>
								</dl>
							<?php
							endif;
							?>
						</td>
						<td class="product-price">
							<?php echo apply_filters('jigoshop_product_price_display_in_cart', jigoshop_price($product->get_price_excluding_tax()), $values['product_id'], $values); ?>
						</td>
						<td class="product-quantity">
							<?php ob_start(); // It is important to keep quantity in single line ?>
							<div class="quantity"><input name="cart[<?php echo $cart_item_key ?>][qty]" value="<?php echo esc_attr($values['quantity']); ?>" size="4" title="Qty" class="input-text qty text" maxlength="12" /></div>
							<?php
							$quantity_display = ob_get_clean();
							echo apply_filters('jigoshop_product_quantity_display_in_cart', $quantity_display, $values['product_id'], $values);
							?>
						</td>
						<td class="product-subtotal">
							<?php echo apply_filters('jigoshop_product_subtotal_display_in_cart', jigoshop_price($product->get_price_excluding_tax() * $values['quantity']), $values['product_id'], $values); ?>
						</td>
					</tr>
				<?php
				endif;
		endforeach;
		do_action('jigoshop_shop_table_cart_body');
		?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="6" class="actions">
				<?php if (JS_Coupons::has_coupons()): ?>
					<div class="coupon">
						<label for="coupon_code"><?php _e('Coupon', 'jigoshop'); ?>:</label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" />
						<input type="submit" class="button" name="apply_coupon" value="<?php _e('Apply Coupon', 'jigoshop'); ?>" />
					</div>
				<?php endif; ?>

				<?php jigoshop::nonce_field('cart') ?>

				<?php if ($options->get('jigoshop_cart_shows_shop_button') == 'no'): ?>
					<noscript>
						<input type="submit" class="button" name="update_cart" value="<?php _e('Update Shopping Cart', 'jigoshop'); ?>" />
					</noscript>
					<a href="<?php echo esc_url(jigoshop_cart::get_checkout_url()); ?>" class="checkout-button button-alt"><?php _e('Proceed to Checkout &rarr;', 'jigoshop'); ?></a>
				<?php else: ?>
					<noscript>
						<input type="submit" class="button" name="update_cart" value="<?php _e('Update Shopping Cart', 'jigoshop'); ?>" />
					</noscript>
				<?php endif; ?>
			</td>
		</tr>
		<?php if (count($coupons)): ?>
			<tr>
				<td colspan="6" class="applied-coupons">
					<div>
						<span class="applied-coupons-label"><?php _e('Applied Coupons: ', 'jigoshop'); ?></span>
						<?php foreach ($coupons as $code): ?>
							<a href="?unset_coupon=<?php echo $code; ?>" id="<?php echo $code; ?>" class="applied-coupons-values"><?php echo $code; ?>
								<span class="close">&times;</span>
							</a>
						<?php endforeach; ?>
					</div>
				</td>
			</tr>
		<?php endif; ?>
		<?php if ($options->get('jigoshop_cart_shows_shop_button') == 'yes') : ?>
			<tr>
				<td colspan="6" class="actions">
					<a href="<?php echo esc_url(jigoshop_cart::get_shop_url()); ?>" class="checkout-button button-alt" style="float:left;"><?php _e('&larr; Return to Shop', 'jigoshop'); ?></a>
					<a href="<?php echo esc_url(jigoshop_cart::get_checkout_url()); ?>" class="checkout-button button-alt"><?php _e('Proceed to Checkout &rarr;', 'jigoshop'); ?></a>
				</td>
			</tr>
		<?php endif;
		do_action('jigoshop_shop_table_cart_foot');
		?>
		</tfoot>
		<?php do_action('jigoshop_shop_table_cart'); ?>
	</table>
</form>
<div class="cart-collaterals">
	<?php do_action('cart-collaterals'); ?>
	<div class="cart_totals">
		<?php
		// Hide totals if customer has set location and there are no methods going there
		$available_methods = jigoshop_shipping::get_available_shipping_methods();

		if ($available_methods || !jigoshop_customer::get_shipping_country() || !jigoshop_shipping::is_enabled()):
			do_action('jigoshop_before_cart_totals');
			?>
			<h2><?php _e('Cart Totals', 'jigoshop'); ?></h2>
			<div class="cart_totals_table">
				<table cellspacing="0" cellpadding="0">
					<tbody>
					<tr>
						<?php $price_label = jigoshop_cart::show_retail_price() ? __('Retail Price', 'jigoshop') : __('Subtotal', 'jigoshop'); ?>
						<th class="cart-row-subtotal-title"><?php echo $price_label; ?></th>
						<td class="cart-row-subtotal"><?php echo jigoshop_cart::get_cart_subtotal(true, false, true); ?></td>
					</tr>
					<?php if (jigoshop_cart::get_cart_shipping_total()): ?>
						<tr>
							<th class="cart-row-shipping-title"><?php _e('Shipping', 'jigoshop'); ?>
								<small><?php echo _x('To: ', 'shipping destination', 'jigoshop').__(jigoshop_customer::get_shipping_country_or_state(), 'jigoshop'); ?></small>
							</th>
							<td class="cart-row-shipping"><?php echo jigoshop_cart::get_cart_shipping_total(true, true); ?>
								<small><?php echo jigoshop_cart::get_cart_shipping_title(); ?></small>
							</td>
						</tr>
					<?php endif; ?>
					<?php if (jigoshop_cart::show_retail_price() && $options->get('jigoshop_prices_include_tax') == 'no'): ?>
						<tr>
							<th class="cart-row-subtotal-title"><?php _e('Subtotal', 'jigoshop'); ?></th>
							<td class="cart-row-subtotal"><?php echo jigoshop_cart::get_cart_subtotal(true, true); ?></td>
						</tr>
					<?php elseif (jigoshop_cart::show_retail_price()): ?>
						<tr>
							<th class="cart-row-subtotal-title"><?php _e('Subtotal', 'jigoshop'); ?></th>
							<?php
							$price = jigoshop_cart::$cart_contents_total_ex_tax + jigoshop_cart::$shipping_total;
							$price = jigoshop_price($price, array('ex_tax_label' => 1));
							?>
							<td class="cart-row-subtotal"><?php echo $price; ?></td>
						</tr>
					<?php endif; ?>
					<?php if (jigoshop_cart::tax_after_coupon()): ?>
						<tr class="discount">
							<th class="cart-row-discount-title"><?php _e('Discount', 'jigoshop'); ?></th>
							<td class="cart-row-discount">-<?php echo jigoshop_cart::get_total_discount(); ?></td>
						</tr>
					<?php endif; ?>
					<?php if ($options->get('jigoshop_calc_taxes') == 'yes'):
						foreach (jigoshop_cart::get_applied_tax_classes() as $tax_class):
							if (jigoshop_cart::get_tax_for_display($tax_class)) : ?>
								<tr data-tax="<?php echo $tax_class; ?>">
									<th class="cart-row-tax-title"><?php echo jigoshop_cart::get_tax_for_display($tax_class) ?></th>
									<td class="cart-row-tax"><?php echo jigoshop_cart::get_tax_amount($tax_class) ?></td>
								</tr>
							<?php
							endif;
						endforeach;
					endif; ?>
					<?php if (!jigoshop_cart::tax_after_coupon() && jigoshop_cart::get_total_discount()): ?>
						<tr class="discount">
							<th class="cart-row-discount-title"><?php _e('Discount', 'jigoshop'); ?></th>
							<td class="cart-row-discount">-<?php echo jigoshop_cart::get_total_discount(); ?></td>
						</tr>
					<?php endif; ?>
					<tr>
						<th class="cart-row-total-title"><strong><?php _e('Total', 'jigoshop'); ?></strong></th>
						<td class="cart-row-total"><strong><?php echo jigoshop_cart::get_total(); ?></strong></td>
					</tr>
					</tbody>
				</table>
			</div>
			<?php
			do_action('jigoshop_after_cart_totals');
		else :
			echo '<p>'.__(jigoshop_shipping::get_shipping_error_message(), 'jigoshop').'</p>';
		endif;
		?>
	</div>
	<?php
	do_action('jigoshop_before_shipping_calculator');
	jigoshop_shipping_calculator();
	do_action('jigoshop_after_shipping_calculator');
	?>
</div>
<?php endif; ?><?php */?>
