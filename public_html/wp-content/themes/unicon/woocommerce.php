<?php get_header(); ?>

<?php 
// Get WooCommerce Layout from Theme Options
if($minti_data['select_woocommercesidebar'] == 'sidebar-left' && !is_product())  {
	$wooclass = 'sidebar-left twelve alt columns';
}
elseif($minti_data['select_woocommercesidebar'] == 'sidebar-right' && !is_product())  {
	$wooclass = 'sidebar-right twelve alt columns';
}
else{
	$wooclass = 'no-sidebar sixteen columns';
}
?>

<div id="page-wrap" class="container">

	<div id="content" class="<?php echo esc_attr($wooclass); ?> <?php if(!is_product()){ echo esc_attr($minti_data['select_woocommercecolumns']); } ?>">
		<?php woocommerce_content(); ?>
	</div> <!-- end content -->

	<?php if($minti_data['select_woocommercesidebar'] != 'no-sidebar' && !is_product())  { ?>
	<div id="sidebar" class="<?php echo esc_attr($minti_data['select_woocommercesidebar']); ?> alt">
		<div id="sidebar-widgets" class="four columns">
		<?php if(is_woocommerce()){
			/* WooCommerce Sidebar */
			if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Shop Widgets') );
		} ?>
		</div>
	</div>
	<?php } ?>
	
</div> <!-- end page-wrap -->
	
<?php get_footer(); ?>