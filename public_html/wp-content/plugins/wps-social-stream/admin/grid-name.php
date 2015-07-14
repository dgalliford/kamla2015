<div class="metabox-holder" id="dashboard-widgets">

<form method="post">

<?php wp_nonce_field('animate_new_slider_action','animate_new_slider_nonce_field'); ?>	

	<div class="postbox-container" style="width:100%">

		<div class="meta-box-sortables ui-sortable" style="margin:0">

			<div class="postbox">

			<h3 class="hndle"><span><?php _e('New Grid and Carousel','spost-grid');?></span></h3>

			<div class="inside">

			<table class="anew_slider">

				<tr>

					<th><strong class="afl"><?php _e('Grid and Carousel Title','spost-grid');?> :</strong></th>

					<td><input type="text" name="anew_slider_title" value="<?php echo (isset($_POST['create_slider'])) ? $anew_slider_title : '';?>"/><span class="aslider_required">*</span>

				<p class="description"><?php _e('The title of the Grid and Carousel. Example: Grid','spost-grid');?></p></td>

				</tr>

			</table>

			<input type="submit" class="button-primary" value="Create Grid and Carousel" name="create_spost_grid_title">

			</div>

			</div>

		</div>

	</div>

</form>

</div>