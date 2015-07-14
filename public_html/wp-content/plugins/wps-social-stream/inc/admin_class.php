<?php
	class swp_social_class_grid extends Functions_swp_social{
		protected static $table_prefix;
		const TABLE_SLIDERS_NAMES = 'swp_social_stream';
		const ver = '1.0';

		public function __construct(){
			global $wpdb;
			ini_set('error_reporting', E_ALL & ~E_STRICT);
			ini_set('display_errors','Off');
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'plugin_action_links' ) );
			add_action('admin_print_scripts',array( $this, 'animate_load_admin_script'));
			add_action('wp_enqueue_scripts',array($this, 'animate_load_scripts'));
			self::$table_prefix = $wpdb->base_prefix;
			$this->onActivate();
		}

		public function plugin_action_links( $links ) {
			$action_links = array(
				'settings'	=>	'<a href="' . admin_url( 'admin.php?page=swp-social' ) . '" title="' . esc_attr( __( 'View Social Settings', 'spost-grid' ) ) . '">' . __( 'Settings', 'spost-grid' ) . '</a>',
			);
			self::animate_get_options();
			//return array_merge( $links, $action_links );
		}

		function animate_load_admin_script(){

			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'my-script-handle', '/wp-includes/js/colorpicker.min', array( 'jquery','wp-color-picker' ), false, true );
			wp_enqueue_style( 'swp-social-admin-css', $this->animate_plugin_url( '../assets/css/admin.css'), array(), '' );
			wp_enqueue_style( 'wps-font-awesome-css', $this->animate_plugin_url('../assets/css/font-awesome.min.css'));

		}

		

		function animate_load_scripts() {
			
			wp_register_style( 'svc-social-animate-css', $this->animate_plugin_url('../assets/css/animate.css'));	
			wp_enqueue_style( 'wps-font-awesome-css', $this->animate_plugin_url('../assets/css/font-awesome.min.css'));
			wp_register_style( 'vcyt-bootstrap-css', $this->animate_plugin_url('../assets/css/bootstrap.css'));
			wp_register_style( 'svc-megnific-css', $this->animate_plugin_url('../assets/css/magnific-popup.css'));
			
			wp_register_script('svc-megnific-js', $this->animate_plugin_url('../assets/js/megnific.js'), array("jquery"), self::ver, false);	
			wp_enqueue_script('svc-isotop-js', $this->animate_plugin_url('../assets/js/isotope.pkgd.min.js'), array("jquery"), self::ver, false);
			wp_enqueue_script('svc-carousel-js', $this->animate_plugin_url('../assets/js/owl.carousel.min.js'), array("jquery"), self::ver, false);
			wp_enqueue_script('svc-imagesloaded-js', $this->animate_plugin_url('../assets/js/imagesloaded.pkgd.min.js'), array("jquery"), self::ver, false);
			wp_enqueue_script('viewportchecker-js', $this->animate_plugin_url('../assets/js/jquery.viewportchecker.js'), array("jquery"), self::ver, false);
			wp_enqueue_script('doT-js', $this->animate_plugin_url('../assets/js/doT.min.js'), array("jquery"), self::ver, false);
			wp_enqueue_script('moment-locale-js', $this->animate_plugin_url('../assets/js/moment-with-locales.min.js'), array("jquery"), self::ver, false);
			wp_enqueue_script('social-stream-js', $this->animate_plugin_url('../assets/js/social-stream.js'), array("moment-locale-js"), self::ver, false);
			wp_localize_script('social-stream-js', 'svc_ajax_url', array('url' => admin_url( 'admin-ajax.php' ),'laungage' => get_locale()));

		}

		

		/**
		 * a must function. please don't remove it.
		 * process activate event - install the db (with delta).
		 */
		public static function onActivate(){
			self::createTable(self::TABLE_SLIDERS_NAMES);
		}
		/**
		 * 
		 * craete tables
		 */
		private function createTable($tableName){

			//if table exists - don't create it.
			$tableRealName = self::$table_prefix.$tableName;
			if(self::isDBTableExists($tableRealName))
				return(false);
			
			switch($tableName){
				case self::TABLE_SLIDERS_NAMES:					
				$sql = "CREATE TABLE " .self::$table_prefix.$tableName ." (
							  id int(9) NOT NULL AUTO_INCREMENT,
							  slider_title tinytext NOT NULL,
							  slider_params text NOT NULL,
							  PRIMARY KEY (id)
							);";
				break;
				default:
					FunctionsAni::throwError("table: $tableName not found");
				break;
			}

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		

		/**
		 * 
		 * check if some db table exists
		 */
		public static function isDBTableExists($tableName){
			global $wpdb;
			if(empty($tableName))
				UniteFunctionsRev::throwError("Empty table name!!!");

			$sql = "show tables like '$tableName'";
			$table = $wpdb->get_var($sql);

			if($table == $tableName)
				return(true);
				
			return(false);
		}		

		protected function animate_plugin_url( $path = '' ) {
			return plugins_url( ltrim( $path, '/' ), __FILE__ );
		}
		

		protected function check_slider(){
			$tableRealName = self::$table_prefix.TABLE_SLIDERS_NAMES;
		}

		protected function plugin_root_url(){
			return get_site_url().'/wp-admin/admin.php?page=swp-social';
		}
	}
