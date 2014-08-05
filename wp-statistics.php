<?php
/*
Plugin Name: WP Statistics
Plugin URI: http://wp-statistics.com/
Description: Complete statistics for your WordPress site.
Version: 7.0.1
Author: Mostafa Soufi & Greg Ross
Author URI: http://wp-statistics.com/
Text Domain: wp_statistics
Domain Path: /languages/
License: GPL2
*/

	// Set the default timezone.
	if( get_option('timezone_string') ) {
		date_default_timezone_set( get_option('timezone_string') );
	}
	
	// These defines are used later for various reasons.
	define('WP_STATISTICS_VERSION', '7.0.1');
	define('WP_STATISTICS_MANUAL', 'manual/WP Statistics Admin Manual.');
	define('WP_STATISTICS_REQUIRED_GEOIP_PHP_VERSION', '5.3.0');
	define('WPS_EXPORT_FILE_NAME', 'wp-statistics');
	
	// Load the internationalization code.
	load_plugin_textdomain('wp_statistics', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/');
	__('WP Statistics', 'wp_statistics');
	__('Complete statistics for your WordPress site.', 'wp_statistics');

	// Load the user agent parsing code first, the WP_Statistics class depends on it.  Then load the WP_Statistics class.
	include_once dirname( __FILE__ ) . '/includes/functions/parse-user-agent.php';
	include_once dirname( __FILE__ ) . '/includes/classes/statistics.class.php';

	// This is our global WP_Statitsics class that is used throughout the plugin.
	$WP_Statistics = new WP_Statistics();

	// Check to see if we're installed and are the current version.
	$WPS_Installed = get_option('wp_statistics_plugin_version');
	if( $WPS_Installed != WP_STATISTICS_VERSION ) {	
		include_once( dirname( __FILE__ ) . '/wps-install.php' );
	}
	
	// Load the rest of the required files for our global functions, online user tracking and hit tracking.
	include_once dirname( __FILE__ ) . '/includes/functions/functions.php';
	include_once dirname( __FILE__ ) . '/includes/classes/useronline.class.php';
	include_once dirname( __FILE__ ) . '/includes/classes/hits.class.php';

	// If GeoIP is enabled and supported, extend the hits class to record the GeoIP information.
	if( $WP_Statistics->get_option('geoip') && wp_statistics_geoip_supported() ) {
		include_once dirname( __FILE__ ) . '/includes/classes/hits.geoip.class.php';
	}
	
	// Finally load the widget, shortcode and scheduled events.
	include_once dirname( __FILE__ ) . '/widget.php';
	include_once dirname( __FILE__ ) . '/shortcode.php';
	include_once dirname( __FILE__ ) . '/schedule.php';
	
	// This function outputs error messages in the admin interface if the primary components of WP Statistics are enabled.
	function wp_statistics_not_enable() {
		GLOBAL $WP_Statistics;
		
		// If the user had told us to be quite, do so.
		if( !$WP_Statistics->get_option('hide_notices') ) {
			$get_bloginfo_url = get_admin_url() . "admin.php?page=wp-statistics/settings";
			
			if( !$WP_Statistics->get_option('useronline') )
				echo '<div class="update-nag"><p>'.sprintf(__('Online user tracking in WP Statistics is not enabled, please go to <a href="%s">setting page</a> and enable it.', 'wp_statistics'), $get_bloginfo_url).'</p></div>';

			if( !$WP_Statistics->get_option('visits') )
				echo '<div class="update-nag"><p>'.sprintf(__('Hit tracking in WP Statistics is not enabled, please go to <a href="%s">setting page</a> and enable it.', 'wp_statistics'), $get_bloginfo_url).'</p></div>';

			if( !$WP_Statistics->get_option('visitors') )
				echo '<div class="update-nag"><p>'.sprintf(__('Visitor tracking in WP Statistics is not enabled, please go to <a href="%s">setting page</a> and enable it.', 'wp_statistics'), $get_bloginfo_url).'</p></div>';
			
			if(!$WP_Statistics->get_option('geoip') && wp_statistics_geoip_supported())
				echo '<div class="update-nag"><p>'.sprintf(__('GeoIP collection is not active, please go to <a href="%s">Setting page > GeoIP</a> and enable this feature (GeoIP can detect the visitors country)', 'wp_statistics'), $get_bloginfo_url . '&tab=geoip').'</p></div>';
		}
	}

	if( !$WP_Statistics->get_option('useronline') || !$WP_Statistics->get_option('visits') || !$WP_Statistics->get_option('visitors') || !$WP_Statistics->get_option('geoip') ) {
		if( $pagenow == "admin.php" && substr( $_GET['page'], 0, 14) == 'wp-statistics/') {
			add_action('admin_notices', 'wp_statistics_not_enable');
		}
	}

	// We can wait until the very end of the page to process the statistics, that way the page loads and displays
	// quickly.
	add_action('shutdown', 'wp_statistics_shutdown_action');
	
	function wp_statistics_shutdown_action() {
		GLOBAL $WP_Statistics;
		
		// Create a new useronline class
		$o = new Useronline();
		
		// Create a new hit class, if we're GeoIP enabled, use GeoIPHits().
		if( class_exists( 'GeoIPHits' ) ) { 
			$h = new GeoIPHits();
		} else {
			$h = new Hits();
		}
	
		// Call the online users tracking code.
		if( $WP_Statistics->get_option('useronline') )
			$o->Check_online();

		// Call the visit tracking code.
		if( $WP_Statistics->get_option('visits') )
			$h->Visits();

		// Call the visitor tracking code.
		if( $WP_Statistics->get_option('visitors') )
			$h->Visitors();

		// Call the page tracking code.
		if( $WP_Statistics->get_option('pages') )
			$h->Pages();

		if( $WP_Statistics->get_option('check_online') )
			$o->second = $WP_Statistics->get_option('check_online');
		
		// Check to see if the GeoIP database needs to be downloaded and do so if required.
		if( $WP_Statistics->get_option('update_geoip') )
			wp_statistics_download_geoip();
	}

	// Add a settings link to the plugin list.
	function wp_statistics_settings_links( $links, $file ) {
		GLOBAL $WP_Statistics;

		$manage_cap = wp_statistics_validate_capability( $WP_Statistics->get_option('manage_capability', 'manage_options') );
		
		if( current_user_can( $manage_cap ) ) {
			array_unshift( $links, '<a href="' . admin_url( 'admin.php?page=wp-statistics/settings' ) . '">' . __( 'Settings', 'wp_statistics' ) . '</a>' );
		}
		
		return $links;
	}
	add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'wp_statistics_settings_links', 10, 2 );

	// Add a WordPress plugin page and rating links to the meta information to the plugin list.
	function wp_statistics_add_meta_links($links, $file) {
		if( $file == plugin_basename(__FILE__) ) {
			$plugin_url = 'http://wordpress.org/plugins/wp-statistics/';
			
			$links[] = '<a href="'. $plugin_url .'" target="_blank" title="'. __('Click here to visit the plugin on WordPress.org', 'wp_statistics') .'">'. __('Visit WordPress.org page', 'wp_statistics') .'</a>';
			
			$rate_url = 'http://wordpress.org/support/view/plugin-reviews/wp-statistics?rate=5#postform';
			$links[] = '<a href="'. $rate_url .'" target="_blank" title="'. __('Click here to rate and review this plugin on WordPress.org', 'wp_statistics') .'">'. __('Rate this plugin', 'wp_statistics') .'</a>';
		}
		
		return $links;
	}
	add_filter('plugin_row_meta', 'wp_statistics_add_meta_links', 10, 2);
	
	// Add a custom column to post/pages for hit statistics.
	function wp_statistics_add_column( $columns ) {
		$columns['wp-statistics'] = __('Hits', 'wp_statistics');
		
		return $columns;
	}

	// Render the custom column on the post/pages lists.
	function wp_statistics_render_column( $column_name, $post_id ) {
		if( $column_name == 'wp-statistics' ) {
			echo "<a href='" . get_admin_url() . "admin.php?page=wps_pages_menu&page-id={$post_id}'>" . wp_statistics_pages( 'total', "", $post_id ) . "</a>";
		}
	}
	
	// Call the add/render functions at the appropriate times.
	function wp_statistics_load_edit_init() {
		GLOBAL $WP_Statistics;
		
		$manage_cap = wp_statistics_validate_capability( $WP_Statistics->get_option('manage_capability', 'manage_options') );
		
		if( current_user_can( $manage_cap ) && $WP_Statistics->get_option('pages') && !$WP_Statistics->get_option('disable_column') ) {
			$post_types = (array)get_post_types( array( 'show_ui' => true ), 'object' );
			
			foreach( $post_types as $type ) {
				add_action( 'manage_' . $type->name . '_posts_columns', 'wp_statistics_add_column', 10, 2 );
				add_action( 'manage_' . $type->name . '_posts_custom_column', 'wp_statistics_render_column', 10, 2 );
			}
		}
	}
	add_action( 'load-edit.php', 'wp_statistics_load_edit_init' );

	// Add the hit count to the publish widget in the post/pages editor.
	function wp_statistics_post_init() {
		global $post;
		
		$id = $post->ID;
	
		echo "<div class='misc-pub-section'>" . __( 'WP Statistics - Hits', 'wp_statistics') . ': <b>' . wp_statistics_pages( 'total', '', $id ) . '</b></div>';
	}
	if( $WP_Statistics->get_option('pages') && !$WP_Statistics->get_option('disable_column') ) {
		add_action( 'post_submitbox_misc_actions', 'wp_statistics_post_init' );
	}
	
	// This function will validate that a capability exists, if not it will default to returning the 'manage_options' capability.
	function wp_statistics_validate_capability( $capability ) {
	
		global $wp_roles;

		$role_list = $wp_roles->get_names();

		foreach( $wp_roles->roles as $role ) {
		
			$cap_list = $role['capabilities'];
			
			foreach( $cap_list as $key => $cap ) {
				if( $capability == $key ) { return $capability; }
			}
		}

		return 'manage_options';
	}
	
	// This function adds the primary menu to WordPress.
	function wp_statistics_menu() {
		GLOBAL $WP_Statistics;
		
		// Get the read/write capabilities required to view/manage the plugin as set by the user.
		$read_cap = wp_statistics_validate_capability( $WP_Statistics->get_option('read_capability', 'manage_options') );
		$manage_cap = wp_statistics_validate_capability( $WP_Statistics->get_option('manage_capability', 'manage_options') );
		
		// Add the top level menu.
		add_menu_page(__('Statistics', 'wp_statistics'), __('Statistics', 'wp_statistics'), $read_cap, __FILE__, 'wp_statistics_log_overview');
		
		// Add the sub items.
		add_submenu_page(__FILE__, __('Overview', 'wp_statistics'), __('Overview', 'wp_statistics'), $read_cap, __FILE__, 'wp_statistics_log_overview');
		add_submenu_page(__FILE__, __('Browsers', 'wp_statistics'), __('Browsers', 'wp_statistics'), $read_cap, 'wps_browsers_menu', 'wp_statistics_log_browsers');
		if( $WP_Statistics->get_option('geoip') ) {
			add_submenu_page(__FILE__, __('Countries', 'wp_statistics'), __('Countries', 'wp_statistics'), $read_cap, 'wps_countries_menu', 'wp_statistics_log_countries');
		}
		add_submenu_page(__FILE__, __('Hits', 'wp_statistics'), __('Hits', 'wp_statistics'), $read_cap, 'wps_hits_menu', 'wp_statistics_log_hits');
		add_submenu_page(__FILE__, __('Exclusions', 'wp_statistics'), __('Exclusions', 'wp_statistics'), $read_cap, 'wps_exclusions_menu', 'wp_statistics_log_exclusions');
		add_submenu_page(__FILE__, __('Referers', 'wp_statistics'), __('Referers', 'wp_statistics'), $read_cap, 'wps_referers_menu', 'wp_statistics_log_referers');
		add_submenu_page(__FILE__, __('Searches', 'wp_statistics'), __('Searches', 'wp_statistics'), $read_cap, 'wps_searches_menu', 'wp_statistics_log_searches');
		add_submenu_page(__FILE__, __('Search Words', 'wp_statistics'), __('Search Words', 'wp_statistics'), $read_cap, 'wps_words_menu', 'wp_statistics_log_words');
		add_submenu_page(__FILE__, __('Visitors', 'wp_statistics'), __('Visitors', 'wp_statistics'), $read_cap, 'wps_visitors_menu', 'wp_statistics_log_visitors');
		add_submenu_page(__FILE__, __('Pages', 'wp_statistics'), __('Pages', 'wp_statistics'), $read_cap, 'wps_pages_menu', 'wp_statistics_log_pages');
		add_submenu_page(__FILE__, '', '', $read_cap, 'wps_break_menu', 'wp_statistics_log_overview');
		add_submenu_page(__FILE__, __('Optimization', 'wp_statistics'), __('Optimization', 'wp_statistics'), $manage_cap, 'wp-statistics/optimization', 'wp_statistics_optimization');
		add_submenu_page(__FILE__, __('Settings', 'wp_statistics'), __('Settings', 'wp_statistics'), $read_cap, 'wp-statistics/settings', 'wp_statistics_settings');
		add_submenu_page(__FILE__, __('Manual', 'wp_statistics'), __('Manual', 'wp_statistics'), $manage_cap, 'wps_manual_menu', 'wp_statistics_manual');
	}
	add_action('admin_menu', 'wp_statistics_menu');
	
	// This function adds the menu icon to the top level menu.  WordPress 3.8 changed the style of the menu a bit and so a different css file is loaded.
	function wp_statistics_menu_icon() {
	
		global $wp_version;
		
		if( version_compare( $wp_version, '3.8-RC', '>=' ) || version_compare( $wp_version, '3.8', '>=' ) ) {
			wp_enqueue_style('wpstatistics-admin-css', plugin_dir_url(__FILE__) . 'assets/css/admin.css', true, '1.0');
		} else {
			wp_enqueue_style('wpstatistics-admin-css', plugin_dir_url(__FILE__) . 'assets/css/admin-old.css', true, '1.0');
		}
	}
	add_action('admin_head', 'wp_statistics_menu_icon');
	
	// This function adds the admin bar menu if the user has selected it.
	function wp_statistics_menubar() {
	
		global $wp_admin_bar, $wp_version;
		
		if ( is_super_admin() || is_admin_bar_showing() ) {
		
			if( version_compare( $wp_version, '3.8-RC', '>=' ) || version_compare( $wp_version, '3.8', '>=' ) ) {
				$wp_admin_bar->add_menu( array(
					'id'		=>	'wp-statistic-menu',
					'title'		=>	'<span class="ab-icon"></span>',
					'href'		=>	get_bloginfo('url') . '/wp-admin/admin.php?page=wp-statistics/wp-statistics.php'
				));
			} else {
				$wp_admin_bar->add_menu( array(
					'id'		=>	'wp-statistic-menu',
					'title'		=>	'<img src="'.plugin_dir_url(__FILE__).'/assets/images/icon.png"/>',
					'href'		=>	get_bloginfo('url') . '/wp-admin/admin.php?page=wp-statistics/wp-statistics.php'
				));
			}
			
			$wp_admin_bar->add_menu( array(
				'parent'	=>	'wp-statistic-menu',
				'title'		=>	__('User Online', 'wp_statistics') . ": " . wp_statistics_useronline()
			));
			
			$wp_admin_bar->add_menu( array(
				'parent'	=>	'wp-statistic-menu',
				'title'		=>	__('Today visitor', 'wp_statistics') . ": " . wp_statistics_visitor('today')
			));
			
			$wp_admin_bar->add_menu( array(
				'parent'	=>	'wp-statistic-menu',
				'title'		=>	__('Today visit', 'wp_statistics') . ": " . wp_statistics_visit('today')
			));
			
			$wp_admin_bar->add_menu( array(
				'parent'	=>	'wp-statistic-menu',
				'title'		=>	__('Yesterday visitor', 'wp_statistics') . ": " . wp_statistics_visitor('yesterday')
			));
			
			$wp_admin_bar->add_menu( array(
				'parent'	=>	'wp-statistic-menu',
				'title'		=>	__('Yesterday visit', 'wp_statistics') . ": " . wp_statistics_visit('yesterday')
			));
			
			$wp_admin_bar->add_menu( array(
				'parent'	=>	'wp-statistic-menu',
				'title'		=>	__('View Stats', 'wp_statistics'),
				'href'		=>	get_bloginfo('url') . '/wp-admin/admin.php?page=wp-statistics/wp-statistics.php'
			));
		}
	}
	
	if( $WP_Statistics->get_option('menu_bar') ) {
		add_action('admin_bar_menu', 'wp_statistics_menubar', 20);
	}
	
	// This function creates the HTML for the manual page.  The manual is a seperate HTML file that is contained inside of an iframe.
	// There is a bit of JavaScript included to resize the iframe so that the scroll bars can be hidden and it looks like everything
	// is in the same page.
	function wp_statistics_manual() {
		if( file_exists(plugin_dir_path(__FILE__) . WP_STATISTICS_MANUAL . 'html') ) { 
			echo '<script type="text/javascript">' . "\n";
			echo '    function AdjustiFrameHeight(id,fudge)' . "\n";
			echo '    {' . "\n";
			echo '        var frame = document.getElementById(id);' . "\n";
			echo '        frame.height = frame.contentDocument.body.offsetHeight + fudge;' . "\n";
			echo '    }' . "\n";
			echo '</script>' . "\n";

			echo '<br>';
			echo '<a href="' .  plugin_dir_url(__FILE__) . 'manual/manual.php?type=odt' . '" target="_blank"><img src="' . plugin_dir_url(__FILE__) . 'assets/images/ODT.png' . '" height="32" width="32" alt="' . __('Download ODF file', 'wp_statistics') . '"></a>&nbsp;';
			echo '<a href="' .  plugin_dir_url(__FILE__) . 'manual/manual.php?type=html' . '" target="_blank"><img src="' . plugin_dir_url(__FILE__) . 'assets/images/HTML.png' . '" height="32" width="32" alt="' . __('Download HTML file', 'wp_statistics') . '"></a><br>';
			
			echo '<iframe src="' .  plugin_dir_url(__FILE__) . WP_STATISTICS_MANUAL . 'html' . '" width="100%" frameborder="0" scrolling="no" id="wps_inline_docs" onload="AdjustiFrameHeight(\'wps_inline_docs\', 50);"></iframe>';
		} else {
			echo __("Manual file not found.", 'wp_statistics');
		}
	}
	
	// WordPress cannot pass varaibles to functions called from menu items, so the next several functions
	// are shims to wrap the log function.
	function wp_statistics_log_overview() {
	
		wp_statistics_log();
	}
	
	function wp_statistics_log_browsers() {
	
		wp_statistics_log('all-browsers');
	}
	
	function wp_statistics_log_hits() {
	
		wp_statistics_log('hit-statistics');
	}
	
	function wp_statistics_log_searches() {
	
		wp_statistics_log('search-statistics');
	}
	
	function wp_statistics_log_visitors() {
	
		wp_statistics_log('last-all-visitor');
	}

	function wp_statistics_log_pages() {
	
		wp_statistics_log('top-pages');
	}
	
	function wp_statistics_log_page() {
		
		wp_statistics_log('page-statistics');
	}
	
	function wp_statistics_log_countries() {
	
		wp_statistics_log('top-countries');
	}
	
	function wp_statistics_log_referers() {
	
		wp_statistics_log('top-referring-site');
	}
	
	function wp_statistics_log_words() {
	
		wp_statistics_log('last-all-search');
	}
	
	function wp_statistics_log_exclusions() {
	
		wp_statistics_log('exclusions');
	}
	
	// This is the main statistics display function/
	function wp_statistics_log( $log_type = "" ) {
		GLOBAL $wpdb, $table_prefix, $WP_Statistics;
		
		// When we create $WP_Statistics the user has not been authenticated yet so we cannot load the user preferences
		// during the creation of the class.  Instead load them now that the user exists.
		$WP_Statistics->load_user_options();

		// We allow for a get style variable to be passed to define which function to use.
		if( $log_type == "" && array_key_exists('type', $_GET)) 
			$log_type = $_GET['type'];
			
		// Verify the user has the rights to see the statistics.
		if (!current_user_can(wp_statistics_validate_capability($WP_Statistics->get_option('read_capability', 'manage_option')))) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		// We want to make sure the tables actually exist before we blindly start access them.
		$result['useronline'] = $wpdb->query("CHECK TABLE `{$table_prefix}statistics_useronline`");
		$result['visit'] = $wpdb->query("CHECK TABLE `{$table_prefix}statistics_visit`");
		$result['visitor'] = $wpdb->query("CHECK TABLE `{$table_prefix}statistics_visitor`");
		$result['exclusions'] = $wpdb->query("CHECK TABLE `{$table_prefix}statistics_exclusions`");
		$result['pages'] = $wpdb->query("CHECK TABLE `{$table_prefix}statistics_pages`");
		
		if( ($result['useronline']) && ($result['visit']) && ($result['visitor']) != '1' && ($result['exclusions']) != '1' && ($result['pages']) != '1' )
			wp_die('<div class="error"><p>'.__('Table plugin does not exist! Please disable and re-enable the plugin.', 'wp_statistics').'</p></div>');
		
		// Load the postbox script that provides the widget style boxes.
		wp_enqueue_script('postbox');
		
		// Load the css we use for the statistics pages.
		wp_enqueue_style('log-css', plugin_dir_url(__FILE__) . 'assets/css/log.css', true, '1.1');
		wp_enqueue_style('pagination-css', plugin_dir_url(__FILE__) . 'assets/css/pagination.css', true, '1.0');
		wp_enqueue_style('jqplot-css', plugin_dir_url(__FILE__) . 'assets/css/jquery.jqplot.min.css', true, '1.0.8');
		
		// Don't forget the right to left support.
		if( is_rtl() )
			wp_enqueue_style('rtl-css', plugin_dir_url(__FILE__) . 'assets/css/rtl.css', true, '1.1');

		// Load the charts code.
		wp_enqueue_script('jqplot', plugin_dir_url(__FILE__) . 'assets/js/jquery.jqplot.min.js', true, '0.8.3');
		wp_enqueue_script('jqplot-daterenderer', plugin_dir_url(__FILE__) . 'assets/js/jqplot.dateAxisRenderer.min.js', true, '0.8.3');
		wp_enqueue_script('jqplot-tickrenderer', plugin_dir_url(__FILE__) . 'assets/js/jqplot.canvasAxisTickRenderer.min.js', true, '0.8.3');
		wp_enqueue_script('jqplot-axisrenderer', plugin_dir_url(__FILE__) . 'assets/js/jqplot.canvasAxisLabelRenderer.min.js', true, '0.8.3');
		wp_enqueue_script('jqplot-textrenderer', plugin_dir_url(__FILE__) . 'assets/js/jqplot.canvasTextRenderer.min.js', true, '0.8.3');
		wp_enqueue_script('jqplot-tooltip', plugin_dir_url(__FILE__) . 'assets/js/jqplot.highlighter.min.js', true, '0.8.3');
		wp_enqueue_script('jqplot-pierenderer', plugin_dir_url(__FILE__) . 'assets/js/jqplot.pieRenderer.min.js', true, '0.8.3');
		wp_enqueue_script('jqplot-enhancedlengend', plugin_dir_url(__FILE__) . 'assets/js/jqplot.enhancedLegendRenderer.min.js', true, '0.8.3');
			
		// Load the pagination code.
		include_once dirname( __FILE__ ) . '/includes/classes/pagination.class.php';

		// The different pages have different files to load.
		if( $log_type == 'last-all-search' ) {
		
			include_once dirname( __FILE__ ) . '/includes/log/last-search.php';
			
		} else if( $log_type == 'last-all-visitor' ) {
		
			include_once dirname( __FILE__ ) . '/includes/log/last-visitor.php';
			
		} else if( $log_type == 'top-referring-site' ) {
		
			include_once dirname( __FILE__ ) . '/includes/log/top-referring.php';
			
		} else if( $log_type == 'all-browsers' ) {

			include_once dirname( __FILE__ ) . '/includes/log/all-browsers.php';
			
		} else if( $log_type == 'top-countries' ) {

			include_once dirname( __FILE__ ) . '/includes/log/top-countries.php';
			
		} else if( $log_type == 'hit-statistics' ) {

			include_once dirname( __FILE__ ) . '/includes/log/hit-statistics.php';
			
		} else if( $log_type == 'search-statistics' ) {

			include_once dirname( __FILE__ ) . '/includes/log/search-statistics.php';
			
		} else if( $log_type == 'exclusions' ) {

			include_once dirname( __FILE__ ) . '/includes/log/exclusions.php';
			
		} else if( $log_type == 'top-pages' ) {

			// If we've been given a page id or uri to get statistics for, load the page stats, otherwise load the page stats overview page.
			if( $_GET['page-id'] || $_GET['page-uri'] ) {
				include_once dirname( __FILE__ ) . '/includes/log/page-statistics.php';
			} else {
				include_once dirname( __FILE__ ) . '/includes/log/top-pages.php';
			}
			
		} else {
		
			include_once dirname( __FILE__ ) . '/includes/log/log.php';
		}
	}
	
	// This function loads the optimization page code.
	function wp_statistics_optimization() {

		GLOBAL $wpdb, $table_prefix, $WP_Statistics;
		
		// Check the current user has the rights to be here.
		if (!current_user_can(wp_statistics_validate_capability($WP_Statistics->get_option('manage_capability', 'manage_options')))) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

		// When we create $WP_Statistics the user has not been authenticated yet so we cannot load the user preferences
		// during the creation of the class.  Instead load them now that the user exists.
		$WP_Statistics->load_user_options();

		// Load the jQuery UI code to create the tabs.
		wp_register_style("jquery-ui-css", plugin_dir_url(__FILE__) . "assets/css/jquery-ui-1.10.4.custom.css");
		wp_enqueue_style("jquery-ui-css");

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		
		if( is_rtl() )
			wp_enqueue_style('rtl-css', plugin_dir_url(__FILE__) . 'assets/css/rtl.css', true, '1.1');

		// Get the row count for each of the tables, we'll use this later on in the wps_optimization.php file.
		$result['useronline'] = $wpdb->get_var("SELECT COUNT(ID) FROM `{$table_prefix}statistics_useronline`");
		$result['visit'] = $wpdb->get_var("SELECT COUNT(ID) FROM `{$table_prefix}statistics_visit`");
		$result['visitor'] = $wpdb->get_var("SELECT COUNT(ID) FROM `{$table_prefix}statistics_visitor`");
		$result['exclusions'] = $wpdb->get_var("SELECT COUNT(ID) FROM `{$table_prefix}statistics_exclusions`");
		$result['pages'] = $wpdb->get_var("SELECT COUNT(uri) FROM `{$table_prefix}statistics_pages`");
		
		include_once dirname( __FILE__ ) . "/includes/optimization/wps-optimization.php";
	}

	// This function downloads the GeoIP database from MaxMind.
	function wp_statistics_download_geoip() {

		GLOBAL $WP_Statistics;
	
		// We need the download_url() function, it should exists on virtually all installs of PHP, but if it doesn't for some reason, bail out.
		if( !function_exists( 'download_url' ) ) { return ''; }
	
		// This is the location of the file to download.
		$download_url = 'http://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.mmdb.gz';

		// Get the upload directory from WordPRess.
		$upload_dir = wp_upload_dir();
		 
		// Create a variable with the name of the database file to download.
		$DBFile = $upload_dir['basedir'] . '/wp-statistics/GeoLite2-Country.mmdb';

		// Check to see if the subdirectory we're going to upload to exists, if not create it.
		if( !file_exists($upload_dir['basedir'] . '/wp-statistics') ) { mkdir($upload_dir['basedir'] . '/wp-statistics'); }
		
		// Download the file from MaxMind, this places it in a temporary location.
		$TempFile = download_url( $download_url );
		
		// If we failed, through a message, otherwise proceed.
		if (is_wp_error( $TempFile ) ) {
			$result = "<div class='updated settings-error'><p><strong>" . sprintf(__('Error downloading GeoIP database from: %s - %s', 'wp_statistics'), $download_url, $TempFile->get_error_message() ) . "</strong></p></div>";
		}
		else {
			// Open the downloaded file to unzip it.
			$ZipHandle = gzopen( $TempFile, 'rb' );
			
			// Create th new file to unzip to.
			$DBfh = fopen( $DBFile, 'wb' );

			// If we failed to open the downloaded file, through an error and remove the temporary file.  Otherwise do the actual unzip.
			if( ! $ZipHandle ) {
				$result = "<div class='updated settings-error'><p><strong>" . sprintf(__('Error could not open downloaded GeoIP database for reading: %s', 'wp_statistics'), $TempFile) . "</strong></p></div>";
				
				unlink( $TempFile );
			}
			else {
				// If we failed to open the new file, through and error and remove the temporary file.  Otherwise actually do the unzip.
				if( !$DBfh ) {
					$result = "<div class='updated settings-error'><p><strong>" . sprintf(__('Error could not open destination GeoIP database for writing %s', 'wp_statistics'), $DBFile) . "</strong></p></div>";
					unlink( $TempFile );
				}
				else {
					while( ( $data = gzread( $ZipHandle, 4096 ) ) != false ) {
						fwrite( $DBfh, $data );
					}

					// Close the files.
					gzclose( $ZipHandle );
					fclose( $DBfh );

					// Delete the temporary file.
					unlink( $TempFile );
					
					// Display the success message.
					$result = "<div class='updated settings-error'><p><strong>" . __('GeoIP Database updated successfully!', 'wp_statistics') . "</strong></p></div>";
					
					// Update the options to reflect the new download.
					$WP_Statistics->update_option('last_geoip_dl', time());
					$WP_Statistics->update_option('update_geoip', false);

					// Populate any missing GeoIP information if the user has selected the option.
					if( $WP_Statistics->get_option('geoip') && wp_statistics_geoip_supported() && $WP_Statistics->get_option('auto_pop')) {
						include_once dirname( __FILE__ ) . '/includes/functions/geoip-populate.php';
						$result .= wp_statistics_populate_geoip_info();
					}
				}
			}
		}
		
		// All of the messages displayed above are stored in a stirng, now it's time to actually output the messages.
		return $result;
	}
	
	// This function displays the HTML for the settings page.
	function wp_statistics_settings() {
		GLOBAL $WP_Statistics;
		
		// Check the current user has the rights to be here.
		if (!current_user_can(wp_statistics_validate_capability($WP_Statistics->get_option('read_capability', 'manage_options')))) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}
		
		// When we create $WP_Statistics the user has not been authenticated yet so we cannot load the user preferences
		// during the creation of the class.  Instead load them now that the user exists.
		$WP_Statistics->load_user_options();

		// Load our CSS to be used.
		wp_enqueue_style('log-css', plugin_dir_url(__FILE__) . 'assets/css/style.css', true, '1.0');

		// Load the jQuery UI code to create the tabs.
		wp_register_style("jquery-ui-css", plugin_dir_url(__FILE__) . "assets/css/jquery-ui-1.10.4.custom.css");
		wp_enqueue_style("jquery-ui-css");

		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-tabs');
		
		if( is_rtl() )
			wp_enqueue_style('rtl-css', plugin_dir_url(__FILE__) . 'assets/css/rtl.css', true, '1.1');
		
		// We could let the download happen at the end of the page, but this way we get to give some
		// feedback to the users about the result.
		if( $WP_Statistics->get_option('update_geoip') == true ) {
			echo wp_statistics_download_geoip();
		}
		
		include_once dirname( __FILE__ ) . "/includes/settings/wps-settings.php";
	}