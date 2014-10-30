<?php
/**
 * @var $options Jigoshop_Options Options container.
 * @var $recent_orders int Number of recent orders to show.
 */
?>
<?php jigoshop::show_messages(); ?>

<section class="article-single" id="cartTmpl">
  <div class="container">
    <h1 class="cartTitle">
      <?php the_title(); ?>
    </h1>
    <?php if (is_user_logged_in()): ?>
    <div class="row">
      <div class="col-md-8 col-sm-9">
        <p><?php echo sprintf( __('Hello, <strong>%s</strong>. From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">change your password</a>.', 'jigoshop'), $current_user->display_name, apply_filters('jigoshop_get_change_password_page_id', get_permalink(jigoshop_get_page_id('change_password')))); ?></p>
        <?php do_action('jigoshop_before_my_account'); ?>
        <?php if ($downloads = jigoshop_customer::get_downloadable_products()) : ?>
        <h2>
          <?php _e('Available downloads', 'jigoshop'); ?>
        </h2>
        <ul class="digital-downloads">
          <?php foreach ($downloads as $download) : ?>
          <li>
            <?php if (is_numeric($download['downloads_remaining'])) : ?>
            <span class="count"><?php echo $download['downloads_remaining'] . _n(' download Remaining', ' downloads Remaining', 'jigoshop'); ?></span>
            <?php endif; ?>
            <a href="<?php echo esc_url( $download['download_url'] ); ?>"><?php echo $download['download_name']; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <h2>
          <?php _e('Recent Orders', 'jigoshop'); ?>
        </h2>
        <div class="row" id="gridHeader">
          <div class="col-md-6" id="gridHeaderLeft">
            <div class="row">
              <div class="col-md-4">
                <?php _e('#', 'jigoshop'); ?>
              </div>
              <div class="col-md-4" id="">
                <?php _e('Date', 'jigoshop'); ?>
              </div>
              <?php if ( $options->get( 'jigoshop_calc_shipping' ) == 'yes' ) : ?>
              <div class="col-md-4">
                <?php _e('Ship to', 'jigoshop'); ?>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <div class="col-md-6" id="gridHeaderRight">
            <div class="row">
              <div class="col-md-4" id="">
                <?php _e('Total', 'jigoshop'); ?>
              </div>
              <div class="col-md-4" id="">
                <?php _e('Status', 'jigoshop'); ?>
              </div>
              <div class="col-md-4"></div>
              <!-- / --> 
            </div>
            <!-- / --> 
          </div>
          <!-- /gridHeaderRight --> 
        </div>
        <!-- /gridHeader -->
        
        <?php
			$orders = new jigoshop_orders();
			$orders->get_customer_orders(get_current_user_id(), $recent_orders);
			if ($orders->orders) foreach ($orders->orders as $order):
				/** @var $order jigoshop_order */
				if ($order->status=='pending') {
					foreach ($order->items as $item) {
						$_product = $order->get_product_from_item( $item );
						$temp = new jigoshop_product( $_product->ID );
						if ($temp->managing_stock() && (!$temp->is_in_stock() || !$temp->has_enough_stock($item['qty']))) {
							$order->cancel_order( sprintf(__("Product - %s - is now out of stock -- Canceling Order", 'jigoshop'), $_product->get_title() ) );
							ob_get_clean();
							wp_safe_redirect(apply_filters('jigoshop_get_myaccount_page_id', get_permalink(jigoshop_get_page_id('myaccount'))));
							exit;
						}
					}
				}
				?>
        <div class="row" id="cartItem">
          <div class="col-md-6" id="cartItemLeft">
            <div class="row">
              <div class="col-md-4"><?php echo $order->get_order_number(); ?></div>
              <!-- / -->
              <div class="col-md-4" id=""><?php echo esc_attr( date_i18n(get_option('date_format').' '.get_option('time_format'), strtotime($order->order_date)) ); ?>"><?php echo date_i18n(get_option('date_format').' '.get_option('time_format'), strtotime($order->order_date)); ?></div>
              <!-- / -->
              <?php if ( $options->get( 'jigoshop_calc_shipping' ) == 'yes' ) : ?>
              <div class="col-md-4">
                <?php if ($order->formatted_shipping_address) echo $order->formatted_shipping_address; else echo '&ndash;'; ?>
              </div>
              <!-- / -->
              <?php endif; ?>
            </div>
            <!-- / --> 
          </div>
          <div class="col-md-6" id="cartItemRight">
            <div class="row">
              <div class="col-md-4"><?php echo apply_filters( 'jigoshop_display_order_total', jigoshop_price($order->order_total), $order); ?></div>
              <!-- / -->
              <div class="col-md-4" id="">
                <?php _e($order->status, 'jigoshop'); ?>
              </div>
              <!-- / -->
              
              <div class="col-md-4" id="">
                <?php if ($order->status=='pending'): ?>
                <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="btn btn-primary">
                <?php _e('Pay', 'jigoshop'); ?>
                </a> <a href="<?php echo esc_url( $order->get_cancel_order_url() ); ?>" class="btn btn-primary">
                <?php _e('Cancel', 'jigoshop'); ?>
                </a>
                <?php endif; ?>
                <a href="<?php echo esc_url( add_query_arg('order', $order->id, apply_filters('jigoshop_get_view_order_page_id', get_permalink(jigoshop_get_page_id('view_order')))) ); ?>" class="btn btn-primary">
                <?php _e('View', 'jigoshop'); ?>
                </a> </div>
              <!-- / --> 
            </div>
            <!-- / --> 
            
          </div>
          <!-- /cartItemRight --> 
        </div>
        <!-- /#cartItem -->
        <?php
	endforeach;
	?>
        <div class="row" id="cartTotal">
          <div class="col-md-6" id="cartTotalLeft">
            <h2>
              <?php _e('Shipping Address', 'jigoshop'); ?>
            </h2>
            <div class="row">
              <div class="col-md-5">
                <p>
                  <?php
			$country = get_user_meta(get_current_user_id(), 'billing_country', true);
			$country = jigoshop_countries::has_country($country) ? jigoshop_countries::get_country($country) : '';
			$address = array(
				get_user_meta(get_current_user_id(), 'billing_first_name', true).' '.get_user_meta(get_current_user_id(), 'billing_last_name', true),
				get_user_meta(get_current_user_id(), 'billing_company', true),
				get_user_meta(get_current_user_id(), 'billing_address_1', true),
				get_user_meta(get_current_user_id(), 'billing_address_2', true),
				get_user_meta(get_current_user_id(), 'billing_city', true),
				get_user_meta(get_current_user_id(), 'billing_state', true),
				get_user_meta(get_current_user_id(), 'billing_postcode', true),
				$country,
			);

			$address = array_map('trim', $address);
			$formatted_address = implode(', ', array_filter($address));

			if (!$formatted_address) {
				_e('You have not set up a billing address yet.', 'jigoshop');
			} else {
				echo $formatted_address;
			}
			?>
                </p>
              </div>
              <div class="col-md-7"></div>
              <!-- / --> 
            </div>
            <!-- / --> 
            
          </div>
          <!-- /cartTotalLeft -->
          
          <div class="col-md-6" id="cartTotalRight">
            <h2>
              <?php _e('Billing Address', 'jigoshop'); ?>
            </h2>
            <div class="row">
              <div class="col-md-5">
                <p>
                  <?php if ($order->formatted_shipping_address) echo $order->formatted_shipping_address; else echo '&ndash;'; ?>
                </p>
              </div>
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
<?php
do_action('jigoshop_after_my_account');
else :
jigoshop_login_form();
endif; ?>
