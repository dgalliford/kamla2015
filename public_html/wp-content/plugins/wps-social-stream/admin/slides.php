<script type="text/javascript">

jQuery(function($){



	//start media button

	var file_frame; 

	$('#upload_image_button').live('click', function( event ){

		event.preventDefault();

		if ( file_frame ) {

			file_frame.open();

			return;

		}



		file_frame = wp.media.frames.file_frame = wp.media({

			title: 'Select Product Image',

			button: {text: 'Select Product',},

			multiple: false

		});



		file_frame.on( 'select', function() {

			attachment = file_frame.state().get('selection').first().toJSON();

			console.log(attachment['url']);

			$('.product_imag_path').val(attachment['url']);

		});



		file_frame.open();

	});

	

	var file_framee;

	$('#upload_image_button1').live('click', function( event ){

		event.preventDefault();

		if ( file_framee ) {

			file_framee.open();

			return;

		}



		file_framee = wp.media.frames.file_framee = wp.media({

			title: 'Select Product Image',

			button: {text: 'Select Product',},

			multiple: false

		});



		file_framee.on( 'select', function() {

			attachment = file_framee.state().get('selection').first().toJSON();

			$('.product_imag_path1').val(attachment['url']);

		});



		file_framee.open();

	});

	//end media button

	

	//start mask image media button

	var file_framem; 

	$('#aslider_mask_image').live('click', function( event ){

		event.preventDefault();

		if ( file_framem ) {

			file_framem.open();

			return;

		}



		file_framem = wp.media.frames.file_framem = wp.media({

			title: 'Select Mask Background Image',

			button: {text: 'Select Image',},

			multiple: false

		});



		file_framem.on( 'select', function() {

			attachment = file_framem.state().get('selection').first().toJSON();

			console.log(attachment['url']);

			$('.aslider_mask_image').val(attachment['url']);

		});



		file_framem.open();

	});

	

	var file_frames; 

	$('#upload_sale_image_button').live('click', function( event ){

		event.preventDefault();

		if ( file_frames ) {

			file_frames.open();

			return;

		}



		file_frames = wp.media.frames.file_frames = wp.media({

			title: 'Select Sale Icon Image',

			button: {text: 'Select Image',},

			multiple: false

		});



		file_frames.on( 'select', function() {

			attachment = file_frames.state().get('selection').first().toJSON();

			console.log(attachment['url']);

			$('.sale_imag_path').val(attachment['url']);

		});



		file_frames.open();

	});

	//end mask image media button

	

	//drag layer order start

	$("#new_fields").sortable({

		cursor:'move',

		axis:'y',

		update:function(){

		var urll = [];

		var i = 0;

		$("#new_fields li").each(function() {

				urll[i] = $(this).attr('data');

				i++;

		});

		urll = urll.join("::");

		$.ajax({

			type: "POST",

			url: "<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

			data : {
				'action' : 'animate_layer_update_field_order',
				'layers' : urll,
				'lid' : <?php echo $_GET['lid'];?>
			},

			beforeSend: function(){

				$('.order_save').show();

			},

			success: function(m){

				urll = [];

				$('.order_save').hide();

			}

		});

	}});

	$("#new_fields").disableSelection();

	//drag layer order end

	

	//delete layer start

	$(".delete_layer").click(function(){

		var r = confirm("Confirm Delete this image!");

		if (r == true) {

			var fid = $(this).attr('fid');

			var img_id = $(this).attr('data');

			$.ajax({

				type: "POST",

				url: "<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

				data: "action=animate_layer_delete&img_id="+img_id+"&lid="+<?php echo $_GET['lid'];?>,

				beforeSend: function(){

					$('.layer_delete').show();

				},

				success: function(m){

					$('.layer_delete').hide();

					$('#field_id_'+fid).slideUp().remove();

				}

			});

		}

	});

	//remove layer end

	

	//start duplicate layer

	$('.duplicate_layer').click(function(){

		var r = confirm("Confirm Dublicate this image!");

		if (r == true) {

			var img_id = $(this).attr('data');

			$.ajax({

				type: "POST",

				url: "<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

				data: "action=animate_layer_duplicate&img_id="+img_id+"&lid="+<?php echo $_GET['lid'];?>,

				beforeSend: function(){

					$('.layer_delete').show();

				},

				success: function(m){

					$('.layer_delete').hide();

					//window.location.reload();

					window.location = '<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin.php?page=animate-slider&view=slide&lid=<?php echo $_GET['lid'];?>';

				}

			});

		}

	});

	//end duplicate layer

	

	//start edit layer popup

	function update_product_function(){

		var img_id = $('#img_id').val(),

		img = $('.product_imag_path1').val(),

		title = $('#product_imag_title').val(),

		descr = $('#product_imag_descri').val(),

		sale = $("input[name=aslider_sale_set_popup]:checked").val(),

		rating = $('#product_imag_rating').val(),

		btn_text = $('#product_imag_btn_text').val(),

		btn_link = $('#product_imag_link').val();

		$.ajax({

			type: "POST",

			url: "<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

			data : {
				'action' : 'update_product_popup_data_save',
				'img_id' : img_id,
				'img' : img,
				'title' : title,
				'descr' : descr,
				'sale' : sale,
				'rating' : rating,
				'btn_text' : btn_text,
				'btn_link' : btn_link,
				'lid' : <?php echo $_GET['lid'];?>
			},
			beforeSend: function(){

				//$info.dialog('open');

			},

			success: function(){

				

			},

			complete: function(){

				//window.location.reload();

				window.location = '<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin.php?page=animate-slider&view=slide&lid=<?php echo $_GET['lid'];?>';

			}

		});

	}

	

	var $info = $("#dialog");  



    $info.dialog({

		'height': 550,

		'width' : 510,

		'resizable': false,

		'draggable' : false,

        'dialogClass'   : 'wp-dialog animate_slider_popup_loader',

        'modal'         : true,

        'autoOpen'      : false,

        'closeOnEscape' : true,

		'close'			: function(){

			$('#dialog').html('');

		},

        'buttons'       : {

			'Save' : update_product_function,

			'Close': function() {

				$( this ).dialog( "close" );

				$('#dialog').html('');

			}

        },

    });



    $(".open-modal1").click(function() {

		var fid = $(this).attr('fid');

		var img_id = $(this).attr('data');

		$.ajax({

			type: "POST",

			url: "<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

			data: "action=update_product_popup_data&img_id="+img_id+"&lid="+<?php echo $_GET['lid'];?>,

			beforeSend: function(){

				$info.dialog('open');

				$('#dialog').parent('.wp-dialog').addClass('animate_slider_popup_loader');

			},

			success: function(m){

				$('#dialog').html(m);

				$('#dialog').parent('.wp-dialog').removeClass('animate_slider_popup_loader');

			}

		});

    });

	//end edit layer popup

	

	//on-off start

	$(".on_off label").click(function(){

		var id = $(this).attr('id');

		var data = $(this).attr('data');

		if(data == 'y'){

			$('.'+id).show();

		}

		if(data == 'n'){

			$('.'+id).hide();

		}

		if(id == 'yesh'){

			$('.hover_yes').show();

			$('.nhover_yes').hide();

		}

		if(id == 'noh'){

			$('.hover_yes').hide();

			$('.nhover_yes').show();

		}

        $(this).parent('div').children('label').removeClass("on");

        $(this).addClass("on"); 

    });

	//on-off end

	

	//select product start

	$('.product_label').click(function(){

		var type = $(this).attr('data');

		if(type == 'none'){

			$('#product_tr').hide();

		}else if(type == 'woocommerce'){

			$('#product_tr').show();

			$('#append_products').html('<img src="<?php echo self::animate_plugin_url( '../assets/image/712.GIF' );?>">');

			$.ajax({

				type:'POST',

				url:"<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

				data:'action=slider_woocommerce_products',

				success:function(m){

					$('#append_products').html(m);

					$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 

					woocom_product();

				},

			});

		}else if(type == 'wpcommerce'){

			$('#product_tr').show();

			$('#append_products').html('<img src="<?php echo self::animate_plugin_url( '../assets/image/712.GIF' );?>">');

			$.ajax({

				type:'POST',

				url:"<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

				data:'action=slider_wpecommerce_products',

				success:function(m){

					$('#append_products').html(m);

					$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 

					wpecom_product();

				},

			});

		}else if(type == 'post'){

			$('#product_tr').show();

			$('#append_products').html('<img src="<?php echo self::animate_plugin_url( '../assets/image/712.GIF' );?>">');

			$.ajax({

				type:'POST',

				url:"<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

				data:'action=slider_posts',

				success:function(m){

					$('#append_products').html(m);

					$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 

					slider_post();

				},

			});

		}

	});

	//select product end

	

	function woocom_product(){

	$('.chosen-select').change(function(){

		$.ajax({

			type:'POST',

			url:"<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

			data:'action=slider_woocommerce_product_select&pid='+$(this).val(),

			dataType: 'json',

			success:function(m){

				$('.product_imag_path').val(m.img);

				$('.product_imag_title').val(m.title);

				$('.product_imag_descri').val(m.price);

				$('.product_imag_rating').val(m.rating);

				$('.product_imag_btn_text').val('Detail');

				$('.product_imag_link').val(m.url);

			},

		});

	});

	}

	

	function wpecom_product(){

	$('.chosen-select').change(function(){

		$.ajax({

			type:'POST',

			url:"<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

			data:'action=slider_wpecommerce_product_select&pid='+$(this).val(),

			dataType: 'json',

			success:function(m){

				$('.product_imag_path').val(m.img);

				$('.product_imag_title').val(m.title);

				$('.product_imag_descri').val(m.price);

				$('.product_imag_rating').val(m.rating);

				$('.product_imag_btn_text').val('Detail');

				$('.product_imag_link').val(m.url);

			},

		});

	});

	}
	
	function slider_post(){

	$('.chosen-select').change(function(){

		$.ajax({

			type:'POST',

			url:"<?php bloginfo( 'wpurl' ); ?>/wp-admin/admin-ajax.php",

			data:'action=slider_post_select&pid='+$(this).val(),

			dataType: 'json',

			success:function(m){

				$('.product_imag_path').val(m.img);

				$('.product_imag_title').val(m.title);

				$('.product_imag_descri').val(m.price);

				$('.product_imag_rating').val(m.rating);

				$('.product_imag_btn_text').val('Detail');

				$('.product_imag_link').val(m.url);

			},

		});

	});

	}

	

});

</script>

<div class="metabox-holder" id="dashboard-widgets">

<form method="post">

<?php

$lid = intval($_GET['lid']);

$layer = $wpdb->get_row("select * from ".self::$table_prefix.self::TABLE_SLIDES_NAME." where id=".$lid);

$array_un = unserialize($layer->params);

if($layer->layers == '' || empty($layer->layers)){

	$layer_count = 0;

}else{

	$layer_count = count(unserialize( $layer->layers ));

}

$layers_img = unserialize($layer->layers);

if($layer_count > 0){



$level = $wpdb->get_row("select * from ".self::$table_prefix.self::TABLE_SLIDERS_NAMES." where id=".$layer->slider_id);

?>

<a href="<?php echo self::plugin_root_url();?>&amp;view=level&sid=<?php echo $level->id;?>" class="button-primary afl" style="margin-bottom:10px;"><?php echo asdisplay(ucwords($level->slider_title));?> Slider Levels</a>

<a href="<?php echo self::plugin_root_url();?>&amp;view=slider" class="button-primary afr" style="margin-bottom:10px;">Create New Slider</a>



<div style="width:60%; float:left; clear:left;">

<div class="postbox-container afl" style="width:100%; clear:left">

		<div class="meta-box-sortables ui-sortable" style="margin:0">

			<div class="postbox">

			<h3 class="hndle"><span><?php echo asdisplay($layer->level_name);?> Layers</span><div class="order_save">Saving Order...</div><div class="layer_delete">Processing...</div></h3>

			<div class="inside">

				<ul id="new_fields" class="new_fields">

					<?php $i = 1;

					foreach($layers_img as $layers_detail){?>

					   <li id="field_id_<?php echo $i;?>" data="<?php echo $layers_detail['img'].'|'.asdisplay($layers_detail['title']).'|'.asdisplay($layers_detail['descri']).'|'.$layers_detail['sale'].'|'.$layers_detail['rating'].'|'.asdisplay($layers_detail['btn_text']).'|'.$layers_detail['link'].'|'.$layers_detail['img_id'];?>" class="ui-state-default">

					   		<span class="layer_counter"><?php echo $i;?>.</span>

							<span class="layer_title"><?php echo asdisplay($layers_detail['title']);?></span>

					   		<span class="layer_img"><img src="<?php echo $layers_detail['img'];?>" width="125" height="125" style="border:1px solid #f1f1f1; padding:2px;"/></span>

							<span class="layer_action">

								<input type="button" value="Edit Product" class="edit_layers open-modal1" data="<?php echo $layers_detail['img_id'];?>" fid="<?php echo $i;?>"/>

								<input type="button" value="Delete" class="delete_layer layer_action_btn" data="<?php echo $layers_detail['img_id'];?>" fid="<?php echo $i;?>"/>

								<input type="button" value="Duplicate" class="duplicate_layer layer_duplicate" data="<?php echo $layers_detail['img_id'];?>"/>	

							</span>

					   </li>

					<?php $i++;}?>

				</ul>

			</div>

			</div>

		</div>

	</div>

<?php }else{?>

<div style="width:60%; float:left;">

	<div align="center">

		<p>No <?php echo asdisplay($layer->level_name);?> Layers Found</p>

	</div>

<?php }?>

<div id="dialog" title="Edit Product" style="display:none">

	

</div>

<?php wp_nonce_field('animate_new_layer_action','animate_new_layer_nonce_field');

if($layer_count == 0){?>

	<div class="postbox-container aslider_rightbar_full">

<?php }else{?>

	<div class="postbox-container aslider_rightbar_half" style="width:100% !important;">

	<?php }?>

		<div class="meta-box-sortables ui-sortable" style="margin:0">

			<div class="postbox">

			<h3 class="hndle"><span>Edit Layers : <?php echo asdisplay($layer->level_name);?></span></h3>

			<div class="inside">

			<table class="anew_slider">

				<tr>

					<th style="width:130px"><strong class="afl">Product Option :</strong></th>

					<td>

					<div class="on_off on_off1">

						<label class="on product_label" data="none"><input type="radio" name="product_option" value="none" checked="checked"/>None</label>

						<label class="product_label" data="woocommerce"><input type="radio" name="product_option" value="woocommerce"/>Woocommerce</label>

						<label class="product_label" data="wpcommerce"><input type="radio" name="product_option" value="wpcommerce"/>wp-ecommerce</label>
						<label class="product_label" data="post"><input type="radio" name="product_option" value="post"/>Post</label>

					</div>

					<p class="description">Select Product Option.</p></td>

				</tr>

				<tr id="product_tr" style="display:none">

					<th style="width:130px"><strong class="afl">Product Select :</strong></th>

					<td id="append_products"></td>

				</tr>

				<tr>

					<th style="width:130px"><strong class="afl">Product Image :</strong></th>

					<td><input type="text" class="product_imag_path" name="product_imag_path" value="<?php echo (isset($_POST['create_layer'])) ? $product_imag_path : '';?>"/><input id="upload_image_button" type="button" value="Select Image" class="button"/><span class="aslider_required">*</span><p class="description">The product image of the <?php echo asdisplay($layer->level_name);?> Level.</p></td>

				</tr>

				<tr>

					<th style="width:145px"><strong class="afl">Product Title :</strong></th>

					<td><input type="text" class="product_imag_title" name="product_imag_title" value="<?php echo (isset($_POST['create_layer'])) ? asdisplay($product_imag_title) : '';?>"/><p class="description">The product title of the <?php echo asdisplay($layer->level_name);?> Level.</p></td>

				</tr>

				<tr>

					<th style="width:130px"><strong class="afl">Product Price with Symbol / Sort description for Post :</strong></th>

					<td><input type="text" class="product_imag_descri" name="product_imag_descri" value="<?php echo (isset($_POST['create_layer'])) ? asdisplay($product_imag_descri) : '';?>"/><p class="description">The product Price with Symbol of the <?php echo asdisplay($layer->level_name);?> Level.</p></td>

				</tr>

				<tr>

					<th style="width:130px"><strong class="afl">Icon :</strong></th>

					<td>

						<div class="on_off">

							<label>Yes<input type="radio" name="aslider_sale_set" value="1"/></label>

							<label class="on">No<input type="radio" name="aslider_sale_set" value="0" checked="checked"/></label>

						</div>

				<p class="description">Product Sale Icon Display.</p></td>

				</tr>

				<tr>

					<th style="width:130px"><strong class="afl">Product Rating :</strong></th>

					<td><input type="text" class="product_imag_rating" name="product_imag_rating" value="<?php echo (isset($_POST['create_layer'])) ? $product_imag_rating : '';?>"/><p class="description">The product Star Rating of the <?php echo asdisplay($layer->level_name);?> Level. Allow 1 to 5.</p></td>

				</tr>

				<tr>

					<th style="width:130px"><strong class="afl">Button Text :</strong></th>

					<td><input type="text" class="product_imag_btn_text" name="product_imag_btn_text" value="<?php echo (isset($_POST['create_layer'])) ? asdisplay($product_imag_btn_text) : '';?>"/><p class="description">The product Button text of the <?php echo asdisplay($layer->level_name);?> Level. Default : View Details</p></td>

				</tr>

				<tr>

					<th style="width:130px"><strong class="afl">Button or image Link :</strong></th>

					<td><input type="text" class="product_imag_link" name="product_imag_link" value="<?php echo (isset($_POST['create_layer'])) ? $product_imag_link : '';?>"/><p class="description">The product Button Link of the <?php echo asdisplay($layer->level_name);?> Level.</p></td>

				</tr>

			</table>

			<input type="submit" class="button-primary" value="Create Layer" name="create_layer">

			</div>

			</div>

		</div>

	</div>

</div>



<div style="width:38%;float:right;">

<?php if($layer_count == 0){?>

	<div class="postbox-container aslider_rightbar_full">

<?php }else{?>

	<div class="postbox-container aslider_rightbar_half" style="width:100% !important;">

<?php }?>

		<div class="meta-box-sortables ui-sortable" style="margin:0; min-height:10px;">

			<div class="postbox">

			<div title="Click to toggle" class="handlediv"><br></div>

			<h3 class="hndle"><span>Display View Settings</span></h3>

			<div class="inside">

			<table class="anew_slider1">

				<tr>

					<th><strong class="afl">Text Align :</strong></th>

					<td>

						<div class="on_off on_off1">

						<?php if($array_un['display']['text_align'] == 'left'){?>

							<label class="on">Left<input type="radio" name="aslider_text_align" value="left" checked="checked"/></label>

							<label>Center<input type="radio" name="aslider_text_align" value="center" /></label>

							<label>Right<input type="radio" name="aslider_text_align" value="right" /></label>

						<?php }elseif($array_un['display']['text_align'] == 'center'){?>

							<label>Left<input type="radio" name="aslider_text_align" value="left"/></label>

							<label class="on">Center<input type="radio" name="aslider_text_align" value="center" checked="checked"/></label>

							<label>Right<input type="radio" name="aslider_text_align" value="right" /></label>

						<?php }else{?>

							<label>Left<input type="radio" name="aslider_text_align" value="left"/></label>

							<label>Center<input type="radio" name="aslider_text_align" value="center" /></label>

							<label class="on">Right<input type="radio" name="aslider_text_align" value="right" checked="checked"/></label>

						<?php }?>

						</div>

						<p class="description">Product Title, Rating and Price Position.</p>

					</td>

				</tr>

				<tr>

					<th><strong class="afl">Per Level Products :</strong></th>

					<td>

						<input type="number" name="asilder_per_level" min="1" max="5" value="<?php echo $array_un['display']['per_level'];?>"/>

						<p class="description">Product per level.minimum 1, maximum 5</p>

					</td>

				</tr>

				<tr>

					<th><strong class="afl">Title :</strong></th>

					<td>

						<div class="on_off">

						<?php if($array_un['display']['title'] == '1'){?>

							<label class="on" id="aslider_title" data="y">Yes<input type="radio" name="aslider_title" value="1" checked="checked"/></label>

							<label id="aslider_title" data="n">No<input type="radio" name="aslider_title" value="0" /></label>

						<?php }else{?>

							<label id="aslider_title" data="y">Yes<input type="radio" name="aslider_title" value="1" /></label>

							<label class="on" id="aslider_title" data="n">No<input type="radio" name="aslider_title" value="0" checked="checked"/></label>

						<?php }?>

						</div>

				<p class="description">Product Title Display.</p></td>

				</tr>

				<?php if($array_un['display']['title'] == '1'){?>

				<tr class="aslider_title">

				<?php }else{?>

				<tr class="aslider_title" style="display:none">

				<?php }?>

					<th><strong class="afl">Title Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['display']['title_color'];?>" class="my-color-field" name="aslider_title_color" data-default-color="#222222"/>

				<p class="description">Product Title Color.</p></td>

				</tr>

				<tr>

					<th><strong class="afl">Price :</strong></th>

					<td>

						<div class="on_off">

						<?php if($array_un['display']['price'] == '1'){?>

							<label class="on" id="aslider_price" data="y">Yes<input type="radio" name="aslider_price" value="1" checked="checked"/></label>

							<label id="aslider_price" data="n">No<input type="radio" name="aslider_price" value="0" /></label>

						<?php }else{?>

							<label id="aslider_price" data="y">Yes<input type="radio" name="aslider_price" value="1" /></label>

							<label class="on" id="aslider_price" data="n">No<input type="radio" name="aslider_price" value="0" checked="checked"/></label>

						<?php }?>

						</div>

				<p class="description">Product Price Display.</p></td>

				</tr>

				<?php if($array_un['display']['price'] == '1'){?>

				<tr class="aslider_price">

				<?php }else{?>

				<tr class="aslider_price" style="display:none">

				<?php }?>

					<th><strong class="afl">Price Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['display']['price_color'];?>" class="my-color-field" name="aslider_price_color" data-default-color="#555555"/>

				<p class="description">Product Price Color.</p></td>

				</tr>

				<tr>

					<th><strong class="afl">Rating :</strong></th>

					<td>

						<div class="on_off">

						<?php if($array_un['display']['rating'] == '1'){?>

							<label class="on" id="aslider_rating" data="y">Yes<input type="radio" name="aslider_rating" value="1" checked="checked"/></label>

							<label id="aslider_rating" data="n">No<input type="radio" name="aslider_rating" value="0" /></label>

						<?php }else{?>

							<label id="aslider_rating" data="y">Yes<input type="radio" name="aslider_rating" value="1" /></label>

							<label class="on" id="aslider_rating" data="n">No<input type="radio" name="aslider_rating" value="0" checked="checked"/></label>

						<?php }?>

						</div>

				<p class="description">Product Rating Display.</p></td>

				</tr>

				<?php if($array_un['display']['rating'] == '1'){?>

				<tr class="aslider_rating">

				<?php }else{ ?>

				<tr class="aslider_rating" style="display:none;">

				<?php }?>

					<th><strong class="afl">Rating Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['display']['rating_color'];?>" class="my-color-field" name="aslider_rating_color" data-default-color="#fb8806"/>

				<p class="description">Product Rating Display.</p></td>

				</tr>

			</table>

			<input type="submit" class="button-primary" value="Save Setting" name="display_setting">

			</div>

			</div>

		</div>

	</div>



<?php if($layer_count == 0){?>

	<div class="postbox-container aslider_rightbar_full" style="margin-top:8px;">

<?php }else{?>

	<div class="postbox-container aslider_rightbar_half" style="width:100% !important;">

<?php }?>

		<div class="meta-box-sortables ui-sortable" style="margin:0">

			<div class="postbox">

			<div title="Click to toggle" class="handlediv"><br></div>

			<h3 class="hndle"><span>Button Settings</span></h3>

			<div class="inside">

			<table class="anew_slider1">

				<tr>

					<th><strong class="afl">Button :</strong></th>

					<td>

						<div class="on_off">

						<?php if($array_un['display']['btn_text'] == '1'){?>

							<label class="on" id="aslider_btn" data="y">Yes<input type="radio" name="aslider_btn_text" value="1" checked="checked"/></label>

							<label id="aslider_btn" data="n">No<input type="radio" name="aslider_btn_text" value="0" /></label>

						<?php }else{?>

							<label id="aslider_btn" data="y">Yes<input type="radio" name="aslider_btn_text" value="1" /></label>

							<label class="on" id="aslider_btn" data="n">No<input type="radio" name="aslider_btn_text" value="0" checked="checked"/></label>

						<?php }?>

						</div>

				<p class="description">Product Button Display.</p></td>

				</tr>

				<?php if($array_un['display']['btn_text'] == '1'){?>

				<tr class="aslider_btn">

				<?php }else{ ?>

				<tr class="aslider_btn" style="display:none;">

				<?php }?>

					<th><strong class="afl">Button Background Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['display']['btn_bg_color'];?>" class="my-color-field" name="aslider_btn_bg_color" data-default-color=""/>

				<p class="description">Button Background color.</p></td>

				</tr>

				<?php if($array_un['display']['btn_text'] == '1'){?>

				<tr class="aslider_btn">

				<?php }else{ ?>

				<tr class="aslider_btn" style="display:none;">

				<?php }?>

					<th><strong class="afl">Button Border Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['display']['btn_border_color'];?>" class="my-color-field" name="aslider_btn_border_color" data-default-color="#333333"/>

				<p class="description">Button Border color.</p></td>

				</tr>

				<?php if($array_un['display']['btn_text'] == '1'){?>

				<tr class="aslider_btn">

				<?php }else{ ?>

				<tr class="aslider_btn" style="display:none;">

				<?php }?>

					<th><strong class="afl">Button Text Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['display']['btn_text_color'];?>" class="my-color-field" name="aslider_btn_text_color" data-default-color="#333333"/>

				<p class="description">Button Text color.</p></td>

				</tr>

			</table>

			<input type="submit" class="button-primary" value="Save Setting" name="button_setting">

			</div>

			</div>

		</div>

	</div>



<?php if($layer_count == 0){?>

	<div class="postbox-container aslider_rightbar_full" style="margin-top:8px;">

<?php }else{?>

	<div class="postbox-container aslider_rightbar_half" style="width:100% !important;">

<?php }?>

		<div class="meta-box-sortables ui-sortable" style="margin:0">

			<div class="postbox">

			<div title="Click to toggle" class="handlediv"><br></div>

			<h3 class="hndle"><span>Sale icon Settings</span></h3>

			<div class="inside">

			<table class="anew_slider1">

				<tr>

					<th><strong class="afl">Sale Icon :</strong></th>

					<td>

						<div class="on_off">

						<?php if($array_un['display']['sale'] == '1'){?>

							<label class="on" id="aslider_sale_icon" data="y">Yes<input type="radio" name="aslider_sale" value="1" checked="checked"/></label>

							<label id="aslider_sale_icon" data="n">No<input type="radio" name="aslider_sale" value="0" /></label>

						<?php }else{?>

							<label id="aslider_sale_icon" data="y">Yes<input type="radio" name="aslider_sale" value="1" /></label>

							<label class="on" id="aslider_sale_icon" data="n">No<input type="radio" name="aslider_sale" value="0" checked="checked"/></label>

						<?php }?>

						</div>

				<p class="description">Product Sale Icon Display.</p></td>

				</tr>

				<?php if($array_un['display']['sale'] == '1'){?>

				<tr class="aslider_sale_icon">

				<?php }else{ ?>

				<tr class="aslider_sale_icon" style="display:none;">

				<?php }?>

					<th><strong class="afl">Sale Icon Background Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['display']['sale_bg_color'];?>" class="my-color-field" name="aslider_sale_bg_color" data-default-color="#f2f2f2"/>

				<p class="description">set sale Icon Background color.</p></td>

				</tr>

				<?php if($array_un['display']['sale'] == '1'){?>

				<tr class="aslider_sale_icon">

				<?php }else{ ?>

				<tr class="aslider_sale_icon" style="display:none;">

				<?php }?>

					<th><strong class="afl">Sale Icon Border Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['display']['sale_border_color'];?>" class="my-color-field" name="aslider_sale_border_color" data-default-color="#dad9d9"/>

				<p class="description">Set Sale Icon Border color.</p></td>

				</tr>

				<?php if($array_un['display']['sale'] == '1'){?>

				<tr class="aslider_sale_icon">

				<?php }else{ ?>

				<tr class="aslider_sale_icon" style="display:none;">

				<?php }?>

					<th><strong class="afl">Sale Text Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['display']['sale_text_color'];?>" class="my-color-field" name="aslider_sale_text_color" data-default-color="#333333"/>

				<p class="description">Set Sale Text color.</p></td>

				</tr>

				<?php if($array_un['display']['sale'] == '1'){?>

				<tr class="aslider_sale_icon">

				<?php }else{ ?>

				<tr class="aslider_sale_icon" style="display:none;">

				<?php }?>

					<th></th>

					<td>OR</td>

				</tr>

				<?php if($array_un['display']['sale'] == '1'){?>

				<tr class="aslider_sale_icon">

				<?php }else{ ?>

				<tr class="aslider_sale_icon" style="display:none;">

				<?php }?>

					<th style="width:130px"><strong class="afl">Sale Icon Image :</strong></th>

					<td><input type="text" class="sale_imag_path" name="aslider_sale_imag_path" value="<?php echo $array_un['display']['sale_icon_img'];?>"/><input id="upload_sale_image_button" type="button" value="Select Image" class="button"/><p class="description">The product Sale Icon image of the Level.</p></td>

				</tr>

				<?php if($array_un['display']['sale'] == '1'){?>

				<tr class="aslider_sale_icon">

				<?php }else{ ?>

				<tr class="aslider_sale_icon" style="display:none;">

				<?php }?>

					<th><strong class="afl">Sale Icon Position :</strong></th>

					<td>

						<div class="on_off on_off1">

						<?php if($array_un['display']['sale_position'] == 'tl'){?>

							<label class="on">&uarr;&larr;<input type="radio" name="aslider_sale_position" value="tl" checked="checked"/></label>

							<label>&uarr;&rarr;<input type="radio" name="aslider_sale_position" value="tr" /></label>

							<label>&darr;&larr;<input type="radio" name="aslider_sale_position" value="bl" /></label>

							<label>&darr;&rarr;<input type="radio" name="aslider_sale_position" value="br" /></label>

						<?php }elseif($array_un['display']['sale_position'] == 'tr'){?>

							<label>&uarr;&larr;<input type="radio" name="aslider_sale_position" value="tl" /></label>

							<label class="on">&uarr;&rarr;<input type="radio" name="aslider_sale_position" value="tr" checked="checked"/></label>

							<label>&darr;&larr;<input type="radio" name="aslider_sale_position" value="bl" /></label>

							<label>&darr;&rarr;<input type="radio" name="aslider_sale_position" value="br" /></label>

						<?php }elseif($array_un['display']['sale_position'] == 'bl'){?>

							<label>&uarr;&larr;<input type="radio" name="aslider_sale_position" value="tl" /></label>

							<label>&uarr;&rarr;<input type="radio" name="aslider_sale_position" value="tr" /></label>

							<label class="on">&darr;&larr;<input type="radio" name="aslider_sale_position" value="bl" checked="checked"/></label>

							<label>&darr;&rarr;<input type="radio" name="aslider_sale_position" value="br" /></label>

						<?php }else{?>

							<label>&uarr;&larr;<input type="radio" name="aslider_sale_position" value="tl" /></label>

							<label>&uarr;&rarr;<input type="radio" name="aslider_sale_position" value="tr" /></label>

							<label>&darr;&larr;<input type="radio" name="aslider_sale_position" value="bl" /></label>

							<label class="on">&darr;&rarr;<input type="radio" name="aslider_sale_position" value="br" checked="checked"/></label>

						<?php }?>

						</div>

						<p class="description">Product Sale icon Position.</p>

					</td>

				</tr>

			</table>

			<input type="submit" class="button-primary" value="Save Setting" name="sale_setting">

			</div>

			</div>

		</div>

	</div>



<?php if($layer_count == 0){?>

	<div class="postbox-container aslider_rightbar_full" style="margin-top:8px;">

<?php }else{?>

	<div class="postbox-container aslider_rightbar_half" style="width:100% !important;">

<?php }?>

		<div class="meta-box-sortables ui-sortable" style="margin:0">

			<div class="postbox">

			<div title="Click to toggle" class="handlediv"><br></div>

			<h3 class="hndle"><span>Hover Settings</span></h3>

			<div class="inside">

			<table class="anew_slider1">

				<tr>

					<th><strong class="afl">Hover :</strong></th>

					<td>

						<div class="on_off">

						<?php if($array_un['hover'] == '1'){?>

							<label class="on" id="yesh">Yes<input type="radio" name="aslider_hover" value="1" checked="checked"/></label>

							<label id="noh">No<input type="radio" name="aslider_hover" value="0" /></label>

						<?php }else{?>

							<label id="yesh">Yes<input type="radio" name="aslider_hover" value="1" /></label>

							<label class="on" id="noh">No<input type="radio" name="aslider_hover" value="0" checked="checked"/></label>

						<?php }?>

						</div>

				<p class="description">Product Information Hover Display.</p></td>

				</tr>

				<?php if($array_un['hover'] == '1'){?>

				<tr class="hover_yes">

				<?php }else{ ?>

				<tr class="hover_yes" style="display:none;">

				<?php }?>

					<th><strong class="afl">Background Mask Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['mask_setting']['color'];?>" class="my-color-field" name="aslider_mask_color" data-default-color="#ffffff"/>

						<p class="description">Product hover Background Color.</p>

					</td>

				</tr>

				<?php if($array_un['hover'] == '1'){?>

				<tr class="hover_yes">

				<?php }else{ ?>

				<tr class="hover_yes" style="display:none;">

				<?php }?>

					<th><strong class="afl">Background Image :</strong></th>

					<td>

						<input type="text" class="aslider_mask_image" name="aslider_mask_image" value="<?php echo $array_un['mask_setting']['image'];?>"/><input id="aslider_mask_image" type="button" value="Select Image" class="button"/>

						<p class="description">Product hover Background Image.</p>

					</td>

				</tr>

				<?php if($array_un['hover'] == '1'){?>

				<tr class="hover_yes">

				<?php }else{ ?>

				<tr class="hover_yes" style="display:none;">

				<?php }?>

					<th><strong class="afl">Opacity :</strong></th>

					<td>

                    <input type="number" min="0" max="1" step="0.1" value="<?php echo $array_un['mask_setting']['opacity'];?>" name="aslider_opacity"/>

						<p class="description">Product hover background opacity. Allow 0.1 to 1</p>

					</td>

				</tr>

				<?php if($array_un['hover'] == '1'){?>

				<tr class="hover_yes">

				<?php }else{ ?>

				<tr class="hover_yes" style="display:none;">

				<?php }?>

					<th><strong class="afl">Background Mask Effect :</strong></th>

					<td>

						<select class="animationsimg" name="aslide_effect">

						<option value="" <?php aslides_effect( $array_un['mask_setting']['effect'], '' );?>>none</option>

					<optgroup label="Attention Seekers">

					  <option value="bounce" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounce' );?>>bounce</option>

					  <option value="flash" <?php aslides_effect( $array_un['mask_setting']['effect'], 'flash' );?>>flash</option>

					  <option value="pulse" <?php aslides_effect( $array_un['mask_setting']['effect'], 'pulse' );?>>pulse</option>

					  <option value="rubberBand" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rubberBand' );?>>rubberBand</option>

					  <option value="shake" <?php aslides_effect( $array_un['mask_setting']['effect'], 'shake' );?>>shake</option>

					  <option value="swing" <?php aslides_effect( $array_un['mask_setting']['effect'], 'swing' );?>>swing</option>

					  <option value="tada" <?php aslides_effect( $array_un['mask_setting']['effect'], 'tada' );?>>tada</option>

					  <option value="wobble" <?php aslides_effect( $array_un['mask_setting']['effect'], 'wobble' );?>>wobble</option>

					</optgroup>			



					<optgroup label="Bouncing Entrances">

					  <option value="bounceIn" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceIn' );?>>bounceIn</option>

					  <option value="bounceInDown" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceInDown' );?>>bounceInDown</option>

					  <option value="bounceInLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceInLeft' );?>>bounceInLeft</option>

					  <option value="bounceInRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceInRight' );?>>bounceInRight</option>

					  <option value="bounceInUp" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceInUp' );?>>bounceInUp</option>

					</optgroup>



					<optgroup label="Bouncing Exits">

					  <option value="bounceOut" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceOut' );?>>bounceOut</option>

					  <option value="bounceOutDown" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceOutDown' );?>>bounceOutDown</option>

					  <option value="bounceOutLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceOutLeft' );?>>bounceOutLeft</option>

					  <option value="bounceOutRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceOutRight' );?>>bounceOutRight</option>

					  <option value="bounceOutUp" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bounceOutUp' );?>>bounceOutUp</option>

					</optgroup>



					<optgroup label="Fading Entrances">

					  <option value="fadeIn" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeIn' );?>>fadeIn</option>

					  <option value="fadeInDown" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeInDown' );?>>fadeInDown</option>

					  <option value="fadeInDownBig" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeInDownBig' );?>>fadeInDownBig</option>

					  <option value="fadeInLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeInLeft' );?>>fadeInLeft</option>

					  <option value="fadeInLeftBig" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeInLeftBig' );?>>fadeInLeftBig</option>

					  <option value="fadeInRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeInRight' );?>>fadeInRight</option>

					  <option value="fadeInRightBig" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeInRightBig' );?>>fadeInRightBig</option>

					  <option value="fadeInUp" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeInUp' );?>>fadeInUp</option>

					  <option value="fadeInUpBig" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeInUpBig' );?>>fadeInUpBig</option>

					</optgroup>



					<optgroup label="Fading Exits">

					  <option value="fadeOut" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeOut' );?>>fadeOut</option>

					  <option value="fadeOutDown" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeOutDown' );?>>fadeOutDown</option>

					  <option value="fadeOutDownBig" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeOutDownBig' );?>>fadeOutDownBig</option>

					  <option value="fadeOutLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeOutLeft' );?>>fadeOutLeft</option>

					  <option value="fadeOutLeftBig" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeOutLeftBig' );?>>fadeOutLeftBig</option>

					  <option value="fadeOutRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeOutRight' );?>>fadeOutRight</option>

					  <option value="fadeOutRightBig" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeOutRightBig' );?>>fadeOutRightBig</option>

					  <option value="fadeOutUp" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeOutUp' );?>>fadeOutUp</option>

					  <option value="fadeOutUpBig" <?php aslides_effect( $array_un['mask_setting']['effect'], 'fadeOutUpBig' );?>>fadeOutUpBig</option>

					</optgroup>



					<optgroup label="Flippers">

					  <option value="flip" <?php aslides_effect( $array_un['mask_setting']['effect'], 'flip' );?>>flip</option>

					  <option value="flipInX" <?php aslides_effect( $array_un['mask_setting']['effect'], 'flipInX' );?>>flipInX</option>

					  <option value="flipInY" <?php aslides_effect( $array_un['mask_setting']['effect'], 'flipInY' );?>>flipInY</option>

					  <option value="flipOutX" <?php aslides_effect( $array_un['mask_setting']['effect'], 'flipOutX' );?>>flipOutX</option>

					  <option value="flipOutY" <?php aslides_effect( $array_un['mask_setting']['effect'], 'flipOutY' );?>>flipOutY</option>

					</optgroup>



					<optgroup label="Lightspeed">

					  <option value="lightSpeedIn" <?php aslides_effect( $array_un['mask_setting']['effect'], 'lightSpeedIn' );?>>lightSpeedIn</option>

					  <option value="lightSpeedOut" <?php aslides_effect( $array_un['mask_setting']['effect'], 'lightSpeedOut' );?>>lightSpeedOut</option>

					</optgroup>



					<optgroup label="Rotating Entrances">

					  <option value="rotateIn" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateIn' );?>>rotateIn</option>

					  <option value="rotateInDownLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateInDownLeft' );?>>rotateInDownLeft</option>

					  <option value="rotateInDownRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateInDownRight' );?>>rotateInDownRight</option>

					  <option value="rotateInUpLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateInUpLeft' );?>>rotateInUpLeft</option>

					  <option value="rotateInUpRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateInUpRight' );?>>rotateInUpRight</option>

					</optgroup>



					<optgroup label="Rotating Exits">

					  <option value="rotateOut" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateOut' );?>>rotateOut</option>

					  <option value="rotateOutDownLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateOutDownLeft' );?>>rotateOutDownLeft</option>

					  <option value="rotateOutDownRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateOutDownRight' );?>>rotateOutDownRight</option

					  ><option value="rotateOutUpLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateOutUpLeft' );?>>rotateOutUpLeft</option>

					  <option value="rotateOutUpRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rotateOutUpRight' );?>>rotateOutUpRight</option>

					</optgroup>



					<optgroup label="Specials">

					  <option value="hinge" <?php aslides_effect( $array_un['mask_setting']['effect'], 'hinge' );?>>hinge</option>

					  <option value="rollIn" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rollIn' );?>>rollIn</option>

					  <option value="rollOut" <?php aslides_effect( $array_un['mask_setting']['effect'], 'rollOut' );?>>rollOut</option>

					</optgroup>



					<optgroup label="Zoom Entrances">

					  <option value="zoomIn" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomIn' );?>>zoomIn</option>

					  <option value="zoomInDown" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomInDown' );?>>zoomInDown</option>

					  <option value="zoomInLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomInLeft' );?>>zoomInLeft</option>

					  <option value="zoomInRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomInRight' );?>>zoomInRight</option>

					  <option value="zoomInUp" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomInUp' );?>>zoomInUp</option>

					</optgroup>



					<optgroup label="Zoom Exits">

					  <option value="zoomOut" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomOut' );?>>zoomOut</option>

					  <option value="zoomOutDown" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomOutDown' );?>>zoomOutDown</option>

					  <option value="zoomOutLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomOutLeft' );?>>zoomOutLeft</option>

					  <option value="zoomOutRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomOutRight' );?>>zoomOutRight</option>

					  <option value="zoomOutUp" <?php aslides_effect( $array_un['mask_setting']['effect'], 'zoomOutUp' );?>>zoomOutUp</option>

					</optgroup>

					

					<optgroup label="Slide">

					  <option value="slideInDown" <?php aslides_effect( $array_un['mask_setting']['effect'], 'slideInDown' );?>>slideInDown</option>

					  <option value="slideInLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'slideInLeft' );?>>slideInLeft</option>

					  <option value="slideInRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'slideInRight' );?>>slideInRight</option>

					  <option value="slideInUp" <?php aslides_effect( $array_un['mask_setting']['effect'], 'slideInUp' );?>>slideInUp</option>

					  <option value="slideOutDown" <?php aslides_effect( $array_un['mask_setting']['effect'], 'slideOutDown' );?>>slideOutDown</option>

					  <option value="slideOutLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'slideOutLeft' );?>>slideOutLeft</option>

					  <option value="slideOutRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'slideOutRight' );?>>slideOutRight</option>

					  <option value="slideOutUp" <?php aslides_effect( $array_un['mask_setting']['effect'], 'slideOutUp' );?>>slideOutUp</option>

					</optgroup>	



					<optgroup label="pull">

					  <option value="pullUp" <?php aslides_effect( $array_un['mask_setting']['effect'], 'pullUp' );?>>pullUp</option>

					  <option value="pullDown" <?php aslides_effect( $array_un['mask_setting']['effect'], 'pullDown' );?>>pullDown</option>

					  <option value="stretchLeft" <?php aslides_effect( $array_un['mask_setting']['effect'], 'stretchLeft' );?>>stretchLeft</option>

					  <option value="stretchRight" <?php aslides_effect( $array_un['mask_setting']['effect'], 'stretchRight' );?>>stretchRight</option>

					  <option value="bigEntrance" <?php aslides_effect( $array_un['mask_setting']['effect'], 'bigEntrance' );?>>bigEntrance</option>

					</optgroup>



				  </select>

						<p class="description">Product hover background mask effect.</p>

					</td>

				</tr>

				<?php if($array_un['hover'] == '1'){?>

				<tr class="hover_yes">

				<?php }else{ ?>

				<tr class="hover_yes" style="display:none;">

				<?php }?>

					<th><strong class="afl">Text Effect :</strong></th>

					<td>

						<select name="aslide_text_effect">

						<option value="" <?php aslides_effect( $array_un['mask_setting']['text_effect'], '' );?>>none</option>

						<?php

						$astyle = array('astyle1','astyle2','astyle3','astyle4','astyle5','astyle6','astyle7','astyle8');

						for($e=0;$e<count($astyle);$e++){?>

					 	<option value="<?php echo $astyle[$e];?>" <?php aslides_effect( $array_un['mask_setting']['text_effect'], $astyle[$e] );?>><?php echo str_replace('astyle','Style',$astyle[$e]);?></option>

						<?php }?>

						</select>

						<p class="description">Product hover text effect.</p>

					</td>

				</tr>

				<?php if($array_un['hover'] == '0'){?>

				<tr class="nhover_yes">

				<?php }else{ ?>

				<tr class="nhover_yes" style="display:none;">

				<?php }?>

					<th><strong class="afl">Background Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['aslider_text_bg_color'];?>" class="my-color-field" name="aslider_text_bg_color" data-default-color=""/>

						<p class="description">Product Detail Background Color. Default : #f2f2f2</p>

					</td>

				</tr>

				<?php if($array_un['hover'] == '0'){?>

				<tr class="nhover_yes">

				<?php }else{ ?>

				<tr class="nhover_yes" style="display:none;">

				<?php }?>

					<th><strong class="afl">Border Color :</strong></th>

					<td>

						<input type="text" value="<?php echo $array_un['aslider_text_bg_border_color'];?>" class="my-color-field" name="aslider_text_bg_border_color" data-default-color=""/>

						<p class="description">Product Detail Text Border Color. Default : #DAD9D9</p>

					</td>

				</tr>

				<?php if($array_un['hover'] == '0'){?>

				<tr class="nhover_yes">

				<?php }else{ ?>

				<tr class="nhover_yes" style="display:none;">

				<?php }?>

					<th><strong class="afl">Arrow Position :</strong></th>

					<td>

						<div class="on_off on_off1">

						<?php if($array_un['arrow_position'] == '15'){?>

							<label class="on">Left<input type="radio" name="aslider_arrow_position" value="15" checked="checked"/></label>

							<label>Center<input type="radio" name="aslider_arrow_position" value="50" /></label>

							<label>Right<input type="radio" name="aslider_arrow_position" value="85" /></label>

						<?php }elseif($array_un['arrow_position'] == '50'){?>

							<label>Left<input type="radio" name="aslider_arrow_position" value="15"/></label>

							<label class="on">Center<input type="radio" name="aslider_arrow_position" value="50" checked="checked"/></label>

							<label>Right<input type="radio" name="aslider_arrow_position" value="85" /></label>

						<?php }else{?>

							<label>Left<input type="radio" name="aslider_arrow_position" value="15"/></label>

							<label>Center<input type="radio" name="aslider_arrow_position" value="50" /></label>

							<label class="on">Right<input type="radio" name="aslider_arrow_position" value="85" checked="checked"/></label>

						<?php }?>

						</div>

						<p class="description">Product Description Arrow Position.</p>

					</td>

				</tr>

			</table>

			<input type="submit" class="button-primary" value="Save Setting" name="hover_setting">

			</div>

			</div>

		</div>

	</div>

</form>

</div>
