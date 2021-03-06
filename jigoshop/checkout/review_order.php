<?php
/**
 * Review order form template
 * DISCLAIMER
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

$options = Jigoshop_Base::get_options();?>

        <div id="yourOrderHeader" class="row">
        	<div id="" class="col-md-6"><?php _e('Product Name', 'jigoshop'); ?></div><!-- / -->
            <div id="" class="col-md-3"><?php _e('Qty', 'jigoshop'); ?></div><!-- / -->
            <div id="" class="col-md-3"><?php _e('Price', 'jigoshop'); ?></div><!-- / -->
        </div><!-- /#yourOrderHeader -->
        
        <?php
		foreach (jigoshop_cart::$cart_contents as $item_id => $values) :
			/** @var jigoshop_product $product */
			$product = $values['data'];
			if ($product->exists() && $values['quantity'] > 0) :
				$variation = jigoshop_cart::get_item_data($values);
				$customization = '';
				$custom_products = (array)jigoshop_session::instance()->customized_products;
				$product_id = !empty($values['variation_id']) ? $values['variation_id'] : $values['product_id'];
				$custom = isset($custom_products[$product_id]) ? $custom_products[$product_id] : ''; ?>
                <div id="yourOrderItems" class="row your_order">
                    <div id="" class="col-md-6">
                    <a title="" id="" href="<?php echo esc_url(apply_filters('jigoshop_product_url_display_in_cart', get_permalink($values['product_id']), $item_id)); ?>"><?php echo $product->get_title().$variation; ?></a>
                    <?php //echo $product->get_title().$variation;
						if (!empty($custom)) :
							$label = apply_filters('jigoshop_customized_product_label', __(' Personal: ', 'jigoshop')); ?>
							<dl class="customization">
								<dt class="customized_product_label">
									<?php echo $label; ?>
								</dt>
								<dd class="customized_product">
									<?php echo $custom; ?>
								</dd>
							</dl>
						<?php endif; ?>
                        
                        </div><!-- / -->
                    <div id="" class="col-md-3"><?php echo $values['quantity']; ?></div><!-- / -->
                    <div id="" class="col-md-3"><?php echo jigoshop_price($product->get_price_excluding_tax() * $values['quantity']/*, array('ex_tax_label' => 1)*/);?>
                    </div><!-- / -->
                </div>
			<?php endif;
		endforeach;
		?>
        
        <div class="row yourOrderTotals">
          <div class="col-md-5">
          <?php $price_label = jigoshop_cart::show_retail_price() ? __('Retail Price', 'jigoshop') : __('Subtotal', 'jigoshop'); ?>
          <strong><?php echo $price_label; ?></strong>
          </div>
          <div class="col-md-7"><?php echo jigoshop_cart::get_cart_subtotal(true, false, true); ?></div>
        </div>
        
        <div class="row yourOrderTotals">
			<?php jigoshop_checkout::render_shipping_dropdown(); ?>
        </div>

		<?php if (jigoshop_cart::show_retail_price() && Jigoshop_Base::get_options()->get('jigoshop_prices_include_tax') == 'no') : ?>
            <div class="row yourOrderTotals">
              <div class="col-md-5"><strong><?php _e('Subtotal', 'jigoshop'); ?></strong></div>
              <div class="col-md-7"><?php echo jigoshop_cart::get_cart_subtotal(true, true); ?></div>
            </div>
		<?php elseif (jigoshop_cart::show_retail_price()): ?>
            <div class="row yourOrderTotals">
              <div class="col-md-5"><strong><?php _e('Subtotal', 'jigoshop'); ?></strong></div>
              <?php
				$price = jigoshop_cart::$cart_contents_total_ex_tax + jigoshop_cart::$shipping_total;
				$price = jigoshop_price($price, array('ex_tax_label' => 1));
				?>
              <div class="col-md-7"><?php echo $price; ?></div>
            </div>
		<?php endif; ?>
        
        <?php if (jigoshop_cart::tax_after_coupon()): ?>
            <div class="row yourOrderTotals">
              <div class="col-md-5"><?php _e('Discount', 'jigoshop'); ?></div><!-- / -->
              <div class="col-md-7">-<?php echo jigoshop_cart::get_total_discount(); ?></div><!-- / -->
            </div><!-- / -->
		<?php endif; ?>
        
		<?php if ($options->get('jigoshop_calc_taxes') == 'yes'):
			foreach (jigoshop_cart::get_applied_tax_classes() as $tax_class):
				if (jigoshop_cart::get_tax_for_display($tax_class)) : ?>
                    <div class="row yourOrderTotals">
                      <div class="col-md-5"><?php echo jigoshop_cart::get_tax_for_display($tax_class); ?></div><!-- / -->
                      <div class="col-md-7"><?php echo jigoshop_cart::get_tax_amount($tax_class) ?></div><!-- / -->
                    </div><!-- / -->
				<?php endif;
			endforeach;
		endif; ?>
        
        <?php do_action('jigoshop_after_review_order_items'); ?>
        
        <?php if (!jigoshop_cart::tax_after_coupon() && jigoshop_cart::get_total_discount()) : ?>
        	 <div class="row yourOrderTotals discount">
                  <div class="col-md-5"><?php _e('Discount', 'jigoshop'); ?></div><!-- / -->
                  <div class="col-md-7">-<?php echo jigoshop_cart::get_total_discount(); ?></div><!-- / -->
                </div>
		<?php endif; ?>

         <div class="row yourOrderTotals discount">
              <div class="col-md-5"><?php _e('Discount', 'jigoshop'); ?></div><!-- / -->
              <div class="col-md-7">-<?php echo jigoshop_cart::get_total_discount(); ?></div><!-- / -->
            </div>

        
        <div class="row yourOrderTotals">
          <div class="col-md-5"><strong><?php _e('Grand Total', 'jigoshop'); ?></strong></div><!-- / -->
          <div class="col-md-7"><?php echo jigoshop_cart::get_total(); ?></div><!-- / -->
        </div><!-- / -->


<div id="order_review" style="display:none; visibility:hidden">
	<table class="shop_table">
		<thead>
		<tr>
			<th><?php _e('Product', 'jigoshop'); ?></th>
			<th><?php _e('Qty', 'jigoshop'); ?></th>
			<th><?php _e('Totals', 'jigoshop'); ?></th>
		</tr>
		</thead>
		<tfoot>
		<tr>
			<?php $price_label = jigoshop_cart::show_retail_price() ? __('Retail Price', 'jigoshop') : __('Subtotal', 'jigoshop'); ?>
			<td colspan="2"><?php echo $price_label; ?></td>
			<td class="cart-row-subtotal"><?php echo jigoshop_cart::get_cart_subtotal(true, false, true); ?></td>
		</tr>

		<?php jigoshop_checkout::render_shipping_dropdown(); ?>

		<?php if (jigoshop_cart::show_retail_price() && Jigoshop_Base::get_options()->get('jigoshop_prices_include_tax') == 'no') : ?>
			<tr>
				<td colspan="2"><?php _e('Subtotal', 'jigoshop'); ?></td>
				<td><?php echo jigoshop_cart::get_cart_subtotal(true, true); ?></td>
			</tr>
		<?php elseif (jigoshop_cart::show_retail_price()): ?>
			<tr>
				<td colspan="2"><?php _e('Subtotal', 'jigoshop'); ?></td>
				<?php
				$price = jigoshop_cart::$cart_contents_total_ex_tax + jigoshop_cart::$shipping_total;
				$price = jigoshop_price($price, array('ex_tax_label' => 1));
				?>
				<td><?php echo $price; ?></td>
			</tr>
		<?php endif; ?>

		<?php if (jigoshop_cart::tax_after_coupon()): ?>
			<tr class="discount">
				<td colspan="2"><?php _e('Discount', 'jigoshop'); ?></td>
				<td>-<?php echo jigoshop_cart::get_total_discount(); ?></td>
			</tr>
		<?php endif; ?>

		<?php if ($options->get('jigoshop_calc_taxes') == 'yes'):
			foreach (jigoshop_cart::get_applied_tax_classes() as $tax_class):
				if (jigoshop_cart::get_tax_for_display($tax_class)) : ?>
					<tr>
						<td colspan="2"><?php echo jigoshop_cart::get_tax_for_display($tax_class); ?></td>
						<td><?php echo jigoshop_cart::get_tax_amount($tax_class) ?></td>
					</tr>
				<?php endif;
			endforeach;
		endif; ?>

		<?php do_action('jigoshop_after_review_order_items'); ?>

		<?php if (!jigoshop_cart::tax_after_coupon() && jigoshop_cart::get_total_discount()) : ?>
			<tr class="discount">
				<td colspan="2"><?php _e('Discount', 'jigoshop'); ?></td>
				<td>-<?php echo jigoshop_cart::get_total_discount(); ?></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td colspan="2"><strong><?php _e('Grand Total', 'jigoshop'); ?></strong></td>
			<td><strong><?php echo jigoshop_cart::get_total(); ?></strong></td>
		</tr>
		</tfoot>
		<tbody>
		<?php
		foreach (jigoshop_cart::$cart_contents as $item_id => $values) :
			/** @var jigoshop_product $product */
			$product = $values['data'];
			if ($product->exists() && $values['quantity'] > 0) :
				$variation = jigoshop_cart::get_item_data($values);
				$customization = '';
				$custom_products = (array)jigoshop_session::instance()->customized_products;
				$product_id = !empty($values['variation_id']) ? $values['variation_id'] : $values['product_id'];
				$custom = isset($custom_products[$product_id]) ? $custom_products[$product_id] : ''; ?>
				<tr>
					<td class="product-name">
						<?php echo $product->get_title().$variation;
						if (!empty($custom)) :
							$label = apply_filters('jigoshop_customized_product_label', __(' Personal: ', 'jigoshop')); ?>
							<dl class="customization">
								<dt class="customized_product_label">
									<?php echo $label; ?>
								</dt>
								<dd class="customized_product">
									<?php echo $custom; ?>
								</dd>
							</dl>
						<?php endif; ?>
					</td>
					<td><?php echo $values['quantity']; ?></td>
					<td>
						<?php
						echo jigoshop_price($product->get_price_excluding_tax() * $values['quantity'], array('ex_tax_label' => 1));
						?></td>
				</tr>
			<?php endif;
		endforeach;
		?>
		</tbody>
	</table>

	<?php $coupons = JS_Coupons::get_coupons();
	if (!empty($coupons)): ?>
		<div class="coupon">
			<label for="coupon_code"><?php _e('Coupon', 'jigoshop'); ?>:</label>
			<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" />
		</div><br />
	<?php endif; ?>
</div>
