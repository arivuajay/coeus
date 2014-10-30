<?php
/**
 * @var $url string URL for the form.
 * @var $load_address string Address being edited.
 * @var $address array List of address fields.
 * @var $account_url string URL to My Account page.
 */
?>

<section class="article-single" id="checkOutTmpl">
  <div class="container">
  
  <h1 class="cartTitle">Edit My Address</h1>
  
	<form id="address" method="post" action="<?php echo esc_url($url); ?>">    
    <div class="row">
      <?php /* LEFT COLUMN */ ?>
      <div class="col-md-8 col-sm-9">
      
      
      <div class="row">
        <div class="col-md-6"><h2><?php if ($load_address == 'billing'): { ?>
			<?php _e('Billing Information', 'jigoshop'); ?>
		<?php } else: { ?>
			<?php _e('Shipping Information', 'jigoshop'); ?>
		<?php } endif; ?></h2></div><!-- / -->
        <div class="col-md-6"></div><!-- / -->
      </div><!-- / -->
      
      
      <div class="row" class="billingInfo">
        <div class="col-md-6" id="billingInfoLeft">
		  <?php jigoshop_customer::address_form_field($address[0]); ?>
        </div><!-- /#billingInfoLeft -->
        <div class="col-md-6" id="billingInfoRight">
        
		  <?php jigoshop_customer::address_form_field($address[1]); ?>


        </div><!-- /#billingInfoRight -->
      </div><!-- /.billingInfo -->
        
      <div class="row" class="billingInfo">
        <div class="col-md-6" id="billingInfoLeft">
        
        <?php jigoshop_customer::address_form_field($address[3]); ?>

        </div><!-- /#billingInfoLeft -->
        <div class="col-md-6" id="billingInfoRight">
        <label for="exampleInputEmail1">Address 2</label>

          <?php jigoshop_customer::address_form_field($address[4]); ?>
          

        </div><!-- /#billingInfoRight -->
      </div><!-- /#billingInfo -->
      
      <div class="row" class="billingInfo">
        <div class="col-md-6" id="billingInfoLeft">

          <?php jigoshop_customer::address_form_field($address[2]); ?>

        </div><!-- /#billingInfoLeft -->
        <div class="col-md-6" id="billingInfoRight">
        <?php jigoshop_customer::address_form_field($address[5]); ?>
        
        </div><!-- /#billingInfoRight -->
      </div><!-- /#billingInfo -->
      
      <div class="row" class="billingInfo">
        <div class="col-md-6" id="billingInfoLeft">

          <?php jigoshop_customer::address_form_field($address[6]); ?>

        </div><!-- /#billingInfoLeft -->
        <div class="col-md-6" id="billingInfoRight">
            <?php jigoshop_customer::address_form_field($address[7]); ?>
        
        </div><!-- /#billingInfoRight -->
      </div><!-- /#billingInfo -->
      
      <div class="row" class="billingInfo">
        <div class="col-md-6" id="billingInfoLeft">

          <?php jigoshop_customer::address_form_field($address[8]); ?>

        </div><!-- /#billingInfoLeft -->
        <div class="col-md-6" id="billingInfoRight">
           <?php jigoshop_customer::address_form_field($address[9]); ?>
        
        </div><!-- /#billingInfoRight -->
      </div><!-- /#billingInfo -->
      
      <div class="row" class="billingInfo">
        <div class="col-md-6" id="billingInfoLeft">
		  <?php jigoshop_customer::address_form_field($address[10]); ?>
        </div><!-- /#billingInfoLeft -->
        <div class="col-md-6" id="billingInfoRight">
        </div><!-- /#billingInfoRight -->
      </div><!-- /.billingInfo -->

	  <?php /* SAVE BUTTON */ ?>
      <?php jigoshop::nonce_field('edit_address'); ?>
      <!--<input type="submit" class="button" name="save_address" value="<?php _e('Save Address', 'jigoshop'); ?>" />-->
      <div class="row" id="cartButtons">
        <div class="col-md-6" id="cartButtonsLeft">
        

        
        </div><!-- /#cartButtonsLeft -->
        <div class="col-md-6" id="cartButtonsRight">

          <div class="form-group" id="proceedToCheckout">
            <button type="submit" class="btn btn-primary btn-lg" name="save_address">Save</button>
          </div>
      
        </div><!-- /#cartButtonsRight -->
      </div><!-- /#cartButtons -->
 
      </div><!-- /.col-md-8 .col-sm-9 -->
      
      <?php /* RIGHT COLUMN */ ?>
      <div class="col-sm-3 col-md-offset-1"></div><!-- /.col-sm-3 col-md-offset-1 -->
    </div><!-- /row -->
    
    </form>
  </div>
</section>


<?php /*?><form id="address" method="post"
      action="<?php echo esc_url($url); ?>">
	<h3>
		<?php if ($load_address == 'billing'): { ?>
			<?php _e('Billing Information', 'jigoshop'); ?>
		<?php } else: { ?>
			<?php _e('Shipping Information', 'jigoshop'); ?>
		<?php } endif; ?>
	</h3>
	<?php foreach ($address as $field): { ?>
		<?php jigoshop_customer::address_form_field($field); ?>
	<?php } endforeach; ?>
	<?php jigoshop::nonce_field('edit_address'); ?>
	<input type="submit" class="button" name="save_address" value="<?php _e('Save Address', 'jigoshop'); ?>" />
	<a class="button-alt" href="<?php echo $account_url; ?>"><?php _e('Go back to My Account', 'jigoshop'); ?></a>
</form>
<?php */?>

