<?php
	add_filter( 'cron_schedules', 'wp_statistics_addcron' );
	 
	function wp_statistics_addcron( $schedules ) {
		// Adds once weekly to the existing schedules.
		
		if( !array_key_exists( 'weekly', $schedules ) ) {
			$schedules['weekly'] = array(
				'interval' => 604800,
				'display' => __( 'Once Weekly' )
			);
		}
		
		if( !array_key_exists( 'biweekly', $schedules ) ) {
			$schedules['biweekly'] = array(
				'interval' => 1209600,
				'display' => __( 'Once Every 2 Weeks' )
			);
		}

		if( !array_key_exists( '4weeks', $schedules ) ) {
			$schedules['4weeks'] = array(
				'interval' => 2419200,
				'display' => __( 'Once Every 4 Weeks' )
			);
		}

		return $schedules;
	}
	 
	// Add the report schedule if it doesn't exist and is enabled.
	if( !wp_next_scheduled('report_hook') && $WP_Statistics->get_option('stats_report') ) {
	
		wp_schedule_event(time(), $WP_Statistics->get_option('time_report'), 'report_hook');
	}

	// Remove the report schedule if it does exist and is disabled.
	if( wp_next_scheduled('report_hook') && !$WP_Statistics->get_option('stats_report') ) {
	
		wp_unschedule_event(wp_next_scheduled('report_hook'), 'report_hook');
	}

	// Add the GeoIP update schedule if it doesn't exist and it should be.
	if( !wp_next_scheduled('wp_statistics_geoip_hook') && $WP_Statistics->get_option('schedule_geoip') && $WP_Statistics->get_option('geoip') ) {
	
		wp_schedule_event(time(), 'daily', 'wp_statistics_geoip_hook'); 
	}

	// Remove the GeoIP update schedule if it does exist and it should shouldn't.
	if( wp_next_scheduled('wp_statistics_geoip_hook') && (!$WP_Statistics->get_option('schedule_geoip') || !$WP_Statistics->get_option('geoip') ) ) {
	
		wp_unschedule_event(wp_next_scheduled('wp_statistics_geoip_hook'), 'wp_statistics_geoip_hook'); 
	}

	// Add the browscap update schedule if it doesn't exist and it should be.
	if( !wp_next_scheduled('wp_statistics_browscap_hook') && $WP_Statistics->get_option('schedule_browscap') ) {
	
		wp_schedule_event(time(), 'weekly', 'wp_statistics_browscap_hook'); 
	}

	// Remove the browscap update schedule if it does exist and it should shouldn't.
	if( wp_next_scheduled('wp_statistics_browscap_hook') && !$WP_Statistics->get_option('schedule_browscap') ) {
	
		wp_unschedule_event(wp_next_scheduled('wp_statistics_browscap_hook'), 'wp_statistics_browscap_hook'); 
	}

	// Add the database maintenance schedule if it doesn't exist and it should be.
	if( !wp_next_scheduled('wp_statistics_dbmaint_hook') && $WP_Statistics->get_option('schedule_dbmaint') ) {
	
		wp_schedule_event(time(), 'daily', 'wp_statistics_dbmaint_hook'); 
	}

	// Remove the database maintenance schedule if it does exist and it should shouldn't.
	if( wp_next_scheduled('wp_statistics_dbmaint_hook') && (!$WP_Statistics->get_option('schedule_dbmaint') ) ) {
	
		wp_unschedule_event(wp_next_scheduled('wp_statistics_dbmaint_hook'), 'wp_statistics_dbmaint_hook'); 
	}

	// This function updates the GeoIP database from MaxMind.
	function wp_statistics_geoip_event() {
	
		GLOBAL $WP_Statistics;
	
		// Maxmind updates the geoip database on the first Tuesday of the month, to make sure we don't update before they post
		// the update, download it two days later.
		$thisupdate = strtotime('First Tuesday of this month') + (86400 * 2);

		$lastupdate = $WP_Statistics->get_option('last_geoip_dl');
		
		$upload_dir = wp_upload_dir();
		 
		// We're also going to look to see if our filesize is to small, this means the plugin stub still exists and should
		// be replaced with a proper file.
		$dbsize = filesize($upload_dir['basedir'] . '/wp-statistics/GeoLite2-Country.mmdb');
		
		if( $lastupdate < $thisupdate || $dbsize < 1024 ) {
		
			// We can't fire the download function directly here as we rely on some functions that haven't been loaded yet
			// in WordPress, so instead just set the flag in the options table and the shutdown hook will take care of the
			// actual download at the end of the page.
			$WP_Statistics->update_option('update_geoip',TRUE);
		}
	}
	add_action('wp_statistics_geoip_hook', 'wp_statistics_geoip_event');

	// This function updates the browscap database.
	function wp_statistics_browscap_event() {
	
		GLOBAL $WP_Statistics;
	
		// Check for a new browscap once a week
		$WP_Statistics->update_option('update_browscap',TRUE);
	}
	add_action('wp_statistics_browscap_hook', 'wp_statistics_browscap_event');

	// This function will purge old records on a schedule based on age.
	function wp_statistics_dbmaint_event() {

		global $wpdb, $WP_Statistics;
		
		$purge_days = intval( $WP_Statistics->get_option('schedule_dbmaint_days', FALSE) );
		
		// We always keep at least 30 days of stats, if the user has selected a lower interval, don't do anything.
		if(  $purge_days > 30 ) {
		
			$table_name = $wpdb->prefix . 'statistics_visit';
			$date_string = date( 'Y-m-d', strtotime( '-' . $purge_days . ' days')); 
	 
			$result = $wpdb->query('DELETE FROM ' . $table_name . ' WHERE `last_counter` < \'' . $date_string . '\'');
			
			$table_name = $wpdb->prefix . 'statistics_visitor';

			$result = $wpdb->query('DELETE FROM ' . $table_name . ' WHERE `last_counter` < \'' . $date_string . '\'');
		}
	}
	add_action('wp_statistics_dbmaint_hook', 'wp_statistics_dbmaint_event');

	// This function sends the statistics report to the selected users.
	function wp_statistics_send_report() {
	
		GLOBAL $WP_Statistics;
		
		// Retrieve the template from the options.
		$string = $WP_Statistics->get_option('content_report');
		
		// Process shortcodes in the template.  Note that V8.0 upgrade script replaced the old %option% codes with the appropriate short codes.
		$final_text_report = do_shortcode( $final_text_report );
		
		// Send the report through the selected transport agent.
		if( $WP_Statistics->get_option('send_report') == 'mail' ) {
		
			$blogname = get_bloginfo('name');
			$blogemail = get_bloginfo('admin_email');
			
			$headers[] = "From: $blogname <$blogemail>";
			$headers[] = "MIME-Version: 1.0";
			$headers[] = "Content-type: text/html; charset=utf-8";

			if( $WP_Statistics->get_option('email_list') == '' ) { $WP_Statistics->update_option( 'email_list', $blogemail ); }
			
			wp_mail( $WP_Statistics->get_option('email_list'), __('Statistical reporting', 'wp_statistics'), $final_text_report, $headers );
			
		} else if( $WP_Statistics->get_option('send_report') == 'sms' ) {
		
			global $sms;

			if( class_exists(get_option('wp_webservice')) ) {
			
				$sms->to = array(get_option('wp_admin_mobile'));
				$sms->msg = $final_text_report;
				$sms->SendSMS();
			}
			
		}
	}
	add_action('report_hook', 'wp_statistics_send_report');
?>