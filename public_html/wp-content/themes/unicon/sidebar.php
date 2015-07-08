<div id="sidebar-widgets" class="four columns">

    <?php 
	if(is_page()){
		/* Page Sidebar */
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar(get_post_meta( get_the_ID(), 'minti_sidebar', true )) );
	} elseif(is_search()){
		/* Search Results Sidebar */
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Search Results Widgets') );
	} else {
		/* Blog Sidebar */
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Widgets') );
	}
	?>

</div>