jQuery(function($) {
	
	
	//  $(".your_order br").remove();
   $('.product-quantity')
  .on('change', 'input.qty', function(){
   var $parent = $(this).parent('.quantity');
   if($parent.length == 0){
    var $parent = $(this).parent('.quantity2');
   }
   if($parent.length == 0 || $(this).val() == 0){
    return false
   }
   var $main_parent = $parent.parents('.product-quantity');
   
   var $form = $('.form-cart-items');
/*   $form.block({
    message: null,
    overlayCSS: {
     background: '#fff url(' + jigoshop_params.assets_url + '/assets/images/ajax-loader.gif) no-repeat center',
     opacity: 0.6
    }
   });
*/   $.ajax(jigoshop_params.ajax_url, {
    type: 'post',
    dataType: 'json',
    data: {
     action: 'jigoshop_update_item_quantity',
     qty: $(this).val(),
     item: $parent.data('item')
    }
   }).done(function(result){
//     $form.unblock();
     if(result.success){
      $form.trigger('jigoshop.cart.update', [$parent, result]);
      
      if(result.item_price === -1){
       $parent.remove();
      } else {
       $main_parent.find('.product-subtotal').html(result.item_price);
//       $('.product-subtotal', $parent).html(result.item_price);
      }
      var $totals = $('div.cart_totals_table');
      $('.cart-row-subtotal', $totals).html(result.subtotal);
      $('.cart-row-total', $totals).html(result.total);
      
      var $shipping = $('.cart-row-shipping', $totals);
      if($shipping.length){
       var ship = result.shipping.replace("<small>", "<br> "); 
       ship = ship.replace("</small>", " "); 
       $shipping.html(ship);
      }
      var $discount = $('.cart-row-discount', $totals);
      if($discount.length){
       $discount.html(result.discount);
      }
      for(var tax in result.tax){
       $('div[data-tax="' + tax + '"] .cart-row-tax', $totals).html(result.tax[tax]);
      }
     }
    });
  })
  .on('click', '.plus, .minus', function(){
   $('input.qty', $(this).closest('.product-quantity')).trigger('change');
  });
  
  $( ".qty2" ).keyup(function(event) {
  // var qty = event.key;
  // if(qty != '' && $.isNumeric(qty)){
    $('input.qty2', $(this).closest('.product-quantity')).trigger('change');    
  // }
  });
	
	
		//-------------------------------------------------------------------START--------------------------------
		
		function find_matching_variations(attributes){
		var matching = [];
		for(var i = 0; i < product_variations.length; i++){
			var variation = product_variations[i];
			if(variations_match(variation.attributes, attributes)){
				matching.push(variation);
			}
		}
		return matching;
	}
	function variations_match(attrs1, attrs2){
		var match = true;
		for(var name in attrs1){
			var val1 = attrs1[name].toLowerCase();
			if(typeof( attrs2[name] ) == 'undefined'){
				var val2 = 'undefined';
			} else {
				var val2 = attrs2[name].toLowerCase();
			}
			if(val1.length != 0 && val2.length != 0 && val1 != val2){
				match = false;
			}
		}
		return match;
	}

 //for default value select		
  //check_variations_radio();
 
 //Variations in Radio buttons
 $('.variations input:radio').click(function(){
  check_variations_radio();
 });
 check_variations_radio();
 
 
 
 //when one of attributes is clicked - check everything to show only valid options
 function check_variations_radio(){ 
  $('form input[name=variation_id]').val('');
  $('.single_variation').text('');
  $('.variations_button, .single_variation').slideUp();
  $('.product_meta .sku').remove();
  $('.shop_attributes').find('.weight').remove();
  $('.shop_attributes').find('.length').remove();
  $('.shop_attributes').find('.width').remove();
  $('.shop_attributes').find('.height').remove();
  var all_set = false;
  var current_attributes = {};
  $('.variations input:radio').each(function(){
   if($(this).is(':checked')) { 
    all_set = true;
    current_attributes[$(this).attr('name')] = $(this).val();
   } 
  });
  var matching_variations = find_matching_variations(current_attributes);
  if(all_set){
   var variation = matching_variations.pop();
   $('form input[name=variation_id]').val(variation.variation_id);
   show_variation(variation);
  } else {
$('input:radio:nth(0)').attr('checked',true);
check_variations_radio();
	  
   update_variation_values(matching_variations);
  }
 }
 
 
 //show single variation details (price, stock, image)
	function show_variation(variation){
		var img = $('div.images img:eq(0)');
		var link = $('div.images a.zoom:eq(0)');
		var o_src = $(img).attr('original-src');
		var o_link = $(link).attr('original-href');
		var variation_image = variation.image_src;
		var variation_link = variation.image_link;
		var var_display;
		if(variation.same_prices) var_display = variation.availability_html;
		else var_display = variation.price_html + variation.availability_html;
		$('.single_variation').html(var_display);
		if(!o_src){
			$(img).attr('original-src', $(img).attr('src'));
		}
		if(!o_link){
			$(link).attr('original-href', $(link).attr('href'));
		}
		if(variation_image && variation_image.length > 1){
			$(img).attr('src', variation_image);
			$(link).attr('href', variation_link);
		} else {
			$(img).attr('src', o_src);
			$(link).attr('href', o_link);
		}
		$('.product_meta .sku').remove();
		$('.product_meta').append(variation.sku);
		$('.shop_attributes').find('.weight').remove();
		if(variation.a_weight){ //alert(variation.a_weight);
			$('.shop_attributes').append(variation.a_weight);
			$('.changing_weight').html(variation.a_weight);
		}
		
		if(variation.a_weight ==''){$('.changing_weight').html('Nill');}
		if(variation.a_length ==''){$('.changing_length').html('Nill');}
		if(variation.a_width ==''){$('.changing_width').html('Nill');}
		if(variation.a_height ==''){$('.changing_height').html('Nill');}
		
		$('.shop_attributes').find('.length').remove();
		if(variation.a_length){
			$('.shop_attributes').append(variation.a_length);
			$('.changing_length').html(variation.a_length);
		}
		$('.shop_attributes').find('.width').remove();
		if(variation.a_width){
			$('.shop_attributes').append(variation.a_width);
			$('.changing_width').html(variation.a_width);
		}
		$('.shop_attributes').find('.height').remove();
		if(variation.a_height){
			$('.shop_attributes').append(variation.a_height);
			$('.changing_height').html(variation.a_height);
		}
		if(!variation.in_stock){
			$('.single_variation').slideDown();
		} else {
			$('.variations_button, .single_variation').slideDown();
		}
	}
 
 //-------------------------------------------------------------------END--------------------------------
 

	
});
