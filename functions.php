<?php

add_theme_support( 'post-thumbnails' ); 

function jigoshop_show_product_sale_flash( $post, $_product ) {
		//if ($_product->is_on_sale()) echo '<span class="onsale">'.__('Sale!', 'jigoshop').'</span>';
	}
function jigoshop_template_single_price( $post, $_product ) {
		?><!--<p class="price"><?php //echo apply_filters( 'jigoshop_single_product_price', $_product->get_price_html() ); ?></p>--><?php
	}
 function custom_address_field_types($field){
  $field = str_replace('input-text','input-text form-control',$field);
  $field = str_replace('<p','<div',$field);
  $field = str_replace('</p','</div',$field);
  $field = str_replace('form-row','form-group',$field);
  $field = str_replace('class=" input-required"','class="form-control input-required"',$field);
  $field = str_replace('country_to_state','country_to_state form-control',$field);
  
  return $field;
 }
 add_filter('jigoshop_address_field_types', 'custom_address_field_types');
function jigoshop_template_single_meta( $post, $_product ) {

        $jigoshop_options = Jigoshop_Base::get_options();
		//echo '<div class="product_meta">';
		if ($jigoshop_options->get('jigoshop_enable_sku')=='yes' && !empty($_product->sku)) :
		//	echo '<div class="sku">'.__('SKU','jigoshop').': ' . $_product->sku . '</div>';
		endif;

		//echo $_product->get_categories( ', ', ' <div class="posted_in">' . __( 'Posted in ', 'jigoshop' ) . '', '.</div>');
		//echo $_product->get_tags( ', ', ' <div class="tagged_as">' . __( 'Tagged as ', 'jigoshop' ) . '', '.</div>');
		//echo '</div>';

	}
function jigoshop_template_single_title( $post, $_product ) {
		?><!--<h1 class="product_title page-title"><?php echo apply_filters( 'jigoshop_single_product_title', the_title( '', '', false ) ); ?></h1>--><?php
	}


/*
add_filter( 'wpcf7_form_class_attr', 'your_custom_form_class_attr' );

function your_custom_form_class_attr( $class ) {
	$class .= ' form-contact email-form';
	return $class;
}
*/
 function jigoshop_show_product_images() {

  global $_product, $post;

  echo '<div class="images ">';

  do_action( 'jigoshop_before_single_product_summary_thumbnails', $post, $_product );

  $thumb_id = 0;
  if (has_post_thumbnail()) :
   $thumb_id = get_post_thumbnail_id();
   // since there are now user settings for sizes, shouldn't need filters -JAP-
   //$large_thumbnail_size = apply_filters('single_product_large_thumbnail_size', 'shop_large');
   $large_thumbnail_size = jigoshop_get_image_size( 'shop_large' );
   $image_classes = apply_filters( 'jigoshop_product_image_classes', array(), $_product );
   array_unshift( $image_classes, 'zoom' );
   $image_classes = implode( ' ', $image_classes );

   $args = array( 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID, 'orderby' => 'menu_order', 'order' => 'asc', 'fields' => 'ids' );
   $attachments = get_posts($args);
   $attachment_count = count( $attachments );
   if ( $attachment_count > 1 ) {
    $gallery = '[product-gallery]';
   } else {
    $gallery = '';
   }

   echo '<a href="'.wp_get_attachment_url($thumb_id).'" class="'.$image_classes.'" rel="prettyPhoto'.$gallery.'">';
   the_post_thumbnail($large_thumbnail_size);
   echo '</a>';
  else :
   echo jigoshop_get_image_placeholder( 'shop_large' );
  endif;

  do_action('jigoshop_product_thumbnails');

  echo '</div>';

 }
 function jigoshop_show_product_thumbnails() {

  global $_product, $post;

  echo '<div class="thumbnails"><div class="row">';

  $thumb_id = get_post_thumbnail_id();
  $small_thumbnail_size = jigoshop_get_image_size( 'shop_thumbnail' );

  $args = array( 'post_type' => 'attachment', 'post_mime_type' => 'image', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID, 'orderby' => 'menu_order', 'order' => 'asc', 'fields' => 'ids' );

  $attachments = get_posts($args);

  if ($attachments) :

   $loop = 0;
   $attachment_count = count( $attachments );
   if ( $attachment_count > 1 ) {
    $gallery = '[product-gallery]';
   } else {
    $gallery = '';
   }

   $columns = Jigoshop_Base::get_options()->get( 'jigoshop_product_thumbnail_columns', '3' );
   $columns = apply_filters( 'single_thumbnail_columns', $columns );

   foreach ( $attachments as $attachment_id ) :

    if ($thumb_id==$attachment_id) continue; /* ignore the large featured image */

    $loop++;

    $_post = get_post( $attachment_id );
    $url = wp_get_attachment_url($_post->ID);
    $post_title = esc_attr($_post->post_title);
    $image = wp_get_attachment_image($attachment_id, $small_thumbnail_size);

    if ( ! $image || $url == get_post_meta($post->ID, 'file_path', true) )
     continue;

    echo '<div class="col-md-3"><a rel="prettyPhoto'.$gallery.'" href="'.esc_url($url).'" title="'.esc_attr($post_title).'" class="zoom ';
    if ($loop==1 || ($loop-1)%$columns==0) echo 'first';
    if ($loop%$columns==0) echo 'last';
    echo '">'.$image.'</a></div>';

   endforeach;
  endif;
  wp_reset_query();

  echo '</div></div>';

 }
 
 
	function jigoshop_variable_add_to_cart() {

		global $post, $_product;
        $jigoshop_options = Jigoshop_Base::get_options();

		$attributes = $_product->get_available_attributes_variations();

        //get all variations available as an array for easy usage by javascript
        $variationsAvailable = array();
        $children = $_product->get_children();

        foreach($children as $child) {
            /* @var $variation jigoshop_product_variation */
            $variation = $_product->get_child( $child );
            if($variation instanceof jigoshop_product_variation) {
                $vattrs = $variation->get_variation_attributes();
                $availability = $variation->get_availability();

                //@todo needs to be moved to jigoshop_product_variation class
                if (has_post_thumbnail($variation->get_variation_id())) {
                    $attachment_id = get_post_thumbnail_id( $variation->get_variation_id() );
                    $large_thumbnail_size = apply_filters('single_product_large_thumbnail_size', 'shop_large');
                    $image = wp_get_attachment_image_src( $attachment_id, $large_thumbnail_size);
                    if ( ! empty( $image ) ) $image = $image[0];
                    $image_link = wp_get_attachment_image_src( $attachment_id, 'full');
                    if ( ! empty( $image_link ) ) $image_link = $image_link[0];
                } else {
                    $image = '';
                    $image_link = '';
                }

				$a_weight = $a_length = $a_width = $a_height = '';

                if ( $variation->get_weight() ) {
					$a_weight = $variation->get_weight().$jigoshop_options->get('jigoshop_weight_unit');
                	//$a_weight = '
//                    	<tr class="weight">
//                    		<th>Weight</th>
//                    		<td>'.$variation->get_weight().$jigoshop_options->get('jigoshop_weight_unit').'</td>
//                    	</tr>';
            	}

            	if ( $variation->get_length() ) {
					$a_length = $variation->get_length().'" x';
	            	//$a_length = '
//	                	<tr class="length">
//	                		<th>Length</th>
//	                		<td>'.$variation->get_length().$jigoshop_options->get('jigoshop_dimension_unit').'</td>
//	                	</tr>';
                }

                if ( $variation->get_width() ) {
					$a_width = ' '.$variation->get_width().'" x';
	               // $a_width = '
//	                	<tr class="width">
//	                		<th>Width</th>
//	                		<td>'.$variation->get_width().$jigoshop_options->get('jigoshop_dimension_unit').'</td>
//	                	</tr>';
                }

                if ( $variation->get_height() ) {
					$a_height = ' '.$variation->get_height().'"';
	                //$a_height = '
//	                	<tr class="height">
//	                		<th>Height</th>
//	                		<td>'.$variation->get_height().$jigoshop_options->get('jigoshop_dimension_unit').'</td>
//	                	</tr>
//	                ';
            	}
					
					//$vat = $variation->get_price();foreach($vat as $vaaat):
					//$variant_price = $variation->get_weight();
					
					//<div class="form-group" id="finalPrice">
//                    <div class="row">
//                    <div class="col-md-5">Stock</div>
//                    <div class="col-md-7"><p class="stock '.esc_attr( $availability['class'] ). '">'.$availability['availability'].'</p></div>
//                    </div>
//                    </div>
					
                $variationsAvailable[] = array(
					'variation_id'     => $variation->get_variation_id(),
					'sku'              => '<div class="sku">'.__('SKU','jigoshop').': ' . $variation->get_sku() . '</div>',
					'attributes'       => $vattrs,
					'in_stock'         => $variation->is_in_stock(),
					'image_src'        => $image,
					'image_link'       => $image_link,
					'price_html'       => '
					
					 <hr/>

<div class="form-group" id="originalPrice">
  <div class="row">
    <div class="col-md-5">Original Price</div>
    <div class="col-md-7">'.jigoshop_price($variation->get_regular_price()).'</div>
  </div>
</div>
<div class="form-group" id="yourSavings">
  <div class="row">
    <div class="col-md-5">Your Savings</div>
    <div class="col-md-7">'.jigoshop_price($variation->get_regular_price() - $variation->get_price()).'</div>
  </div>
</div>
<div class="form-group" id="finalPrice">
  <div class="row">
    <div class="col-md-5">Final Price</div>
    <div class="col-md-7">'.jigoshop_price($variation->get_price()).'</div>
  </div>
</div>
<hr/>',

					
					//<span class="price">'.$variation->get_price_html().'</span>',
					'availability_html'=> '<p style="display:none" class="stock ' . esc_attr( $availability['class'] ) . '">'. $availability['availability'].'</p>',
					'a_weight'         => $a_weight,
					'a_length'         => $a_length,
					'a_width'          => $a_width,
					'a_height'         => $a_height,
					'same_prices'      => $_product->variations_priced_the_same(),
                );
            }
        }

		?>
        <script type="text/javascript">
            var product_variations = <?php echo json_encode($variationsAvailable) ?>;
        </script>
        <?php $default_attributes = $_product->get_default_attributes() ?>
		<form action="<?php echo esc_url( $_product->add_to_cart_url() ); ?>" class="variations_form" method="post"><!--OLD CLASS variations_form cart-->
			<?php /*?><fieldset class="variations">
				<?php foreach ( $attributes as $name => $options ): ?>
					<?php $sanitized_name = sanitize_title( $name ); ?>
					<div>
						<span class="select_label"><?php echo $_product->attribute_label('pa_'.$name); ?></span>
						<select id="<?php echo esc_attr( $sanitized_name ); ?>" name="tax_<?php echo $sanitized_name; ?>">
							<option value=""><?php echo __('Choose an option ', 'jigoshop') ?>&hellip;</option>

							<?php if ( empty( $_POST ) ): ?>
									<?php $selected_value = ( isset( $default_attributes[ $sanitized_name ] ) ) ? $default_attributes[ $sanitized_name ] : ''; ?>
							<?php else: ?>
									<?php $selected_value = isset( $_POST[ 'tax_' . $sanitized_name ] ) ? $_POST[ 'tax_' . $sanitized_name ] : ''; ?>
							<?php endif; ?>

							<?php foreach ( $options as $value ) : ?>
								<?php if ( taxonomy_exists( 'pa_'.$sanitized_name )) : ?>
									<?php $term = get_term_by( 'slug', $value, 'pa_'.$sanitized_name ); ?>
									<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $selected_value, $term->slug) ?>><?php echo $term->name; ?></option>
								<?php else :
									$display_value = apply_filters('jigoshop_product_attribute_value_custom',esc_attr(sanitize_text_field($value)),$sanitized_name);
								?>
									<option value="<?php echo $value; ?>"<?php selected( $selected_value, $value) ?> ><?php echo $display_value; ?></option>
								<?php endif;?>
							<?php endforeach; ?>
						</select>
                       
                        
					</div>
                <?php endforeach;?>
			</fieldset><?php */?>
            
            <fieldset class="variations">
				<?php foreach ( $attributes as $name => $options )://print_r($options);?>
					<?php $sanitized_name = sanitize_title( $name ); ?>
				
					<!--	<span class="select_label"><?php echo $_product->attribute_label('pa_'.$name); ?></span>-->
                      
						<!--<select id="<?php echo esc_attr( $sanitized_name ); ?>" name="tax_<?php echo $sanitized_name; ?>">
							<option value=""><?php echo __('Choose an option ', 'jigoshop') ?>&hellip;</option>-->
								
							<?php if ( empty( $_POST ) ): ?>
									<?php $selected_value = ( isset( $default_attributes[ $sanitized_name ] ) ) ? $default_attributes[ $sanitized_name ] : ''; ?>
							<?php else: ?>
									<?php $selected_value = isset( $_POST[ 'tax_' . $sanitized_name ] ) ? $_POST[ 'tax_' . $sanitized_name ] : ''; ?>
							<?php endif; ?>

							<?php foreach ( $options as $value ) : ?>
								<?php if ( taxonomy_exists( 'pa_'.$sanitized_name )) : ?>
									<?php $term = get_term_by( 'slug', $value, 'pa_'.$sanitized_name ); ?>
                                  <div class="radio"><label><input id="<?php echo esc_attr( $sanitized_name ); ?>" type="radio" name="tax_<?php echo $sanitized_name; ?>" value="<?php echo esc_attr( $term->slug ); ?>"<?php checked( $selected_value, $term->slug ) ?>>  <?php echo $term->name;  ?></label></div>
									<!--<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $selected_value, $term->slug) ?>><?php  echo $term->name; ?></option>-->
								<?php else :
									$display_value = apply_filters('jigoshop_product_attribute_value_custom',esc_attr(sanitize_text_field($value)),$sanitized_name);
								?>
                               <div class="radio"><label><input id="<?php echo esc_attr( $sanitized_name ); ?>" type="radio" name="tax_<?php echo $sanitized_name; ?>" value="<?php echo $value; ?>"<?php checked( $selected_value, $term->slug, false )?> >  <?php echo $term->name; ?></label></div>
									<!--<option value="<?php echo $value; ?>"<?php selected( $selected_value, $value) ?> ><?php echo $display_value; ?></option>-->
								<?php endif;?>
							<?php endforeach; ?>
						<!--</select>-->
                       
                        
					
                <?php endforeach;?>
			</fieldset>
            
			<div class="single_variation"></div>
			<?php do_action('jigoshop_before_add_to_cart_form_button'); ?>
			<div class="variations_button" style="display:none;">
            
            
           

<div class="form-group" id="addToCart">
	<!--<button type="button" class="btn btn-primary btn-lg">Add To Cart</button>-->
    
     <input type="hidden" name="variation_id" value="" />
                <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
                <div style="display:none;" class="quantity"><input name="quantity" value="1" size="4" title="Qty" class="input-text qty text" maxlength="12" /></div>
				<input type="submit" class="button-alt" value="<?php esc_html_e('Add to cart', 'jigoshop'); ?>" />
</div>
            
            
               
			</div>
			<?php do_action('jigoshop_add_to_cart_form'); ?>
		</form>
		<?php
	}

?>