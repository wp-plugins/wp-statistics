<?php
	include_once dirname( __FILE__ ) . '/includes/classes/Browscap.php';

	use phpbrowscap\Browscap;

	// This function downloads the GeoIP database from MaxMind.
	function wp_statistics_download_geoip() {

		GLOBAL $WP_Statistics;
	
		// We need the download_url() function, it should exists on virtually all installs of PHP, but if it doesn't for some reason, bail out.
		if( !function_exists( 'download_url' ) ) { return ''; }
	
		// If GeoIP is disabled, bail out.
		if( $WP_Statistics->get_option('geoip') == false ) { return '';}
	
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
	
	// This function downloads the browscap database from browscap.org.
	function wp_statistics_download_browscap() {

		GLOBAL $WP_Statistics;
	
		// We need the download_url() function, it should exists on virtually all installs of PHP, but if it doesn't for some reason, bail out.
		if( !function_exists( 'download_url' ) ) { return ''; }
		
		// If browscap is disabled, bail out.
		if( $WP_Statistics->get_option('browscap') == false ) { return '';}
	
		// This is the location of the file to download.
		$download_url = 'http://browscap.org/stream?q=PHP_BrowsCapINI';
		$download_version = 'http://browscap.org/version-number';

		// Get the upload directory from WordPress.
		$upload_dir = wp_upload_dir();
		 
		// Check to see if the subdirectory we're going to upload to exists, if not create it.
		if( !file_exists($upload_dir['basedir'] . '/wp-statistics') ) { mkdir($upload_dir['basedir'] . '/wp-statistics'); }

		$LocalVersion = 0;
		
		// Get the Browscap object, tell it NOT to autoupdate.
		$bc = new Browscap($upload_dir['basedir'] . '/wp-statistics');
		$bc->doAutoUpdate = false; 	// We don't want to auto update.
		
		// If we already have a browscap.ini file (aka we're already done a download in the past) we can get it's version number.
		// We can't execute this code if no browscap.ini exists as then the library will automatically download a full version, even
		// though we've told it not to autoupdate above.
		if( $WP_Statistics->get_option('last_browscap_dl') > 1 ) { 
			// Get the current browser so that the version information is populated.
			$bc->getBrowser();
			
			$LocalVersion = $bc->getSourceVersion();
		}
		
		// Get the remote version info from browscap.org.
		$TempVersionFile = download_url( $download_version );
		
		// Read the version we just downloaded in to a string.
		$RemoteVersion = file_get_contents($TempVersionFile);
		
		// Get rid of the temporary file.
		unlink( $TempVersionFile );
		
		// If there is a new version, let's go get it.
		if( intval($RemoteVersion) >  $LocalVersion ) {
		
			// Download the file from browscap.org, this places it in a temporary location.
			$TempFile = download_url( $download_url );
			
			// If we failed, through a message, otherwise proceed.
			if (is_wp_error( $TempFile ) ) {
				$result = "<div class='updated settings-error'><p><strong>" . sprintf(__('Error downloading browscap database from: %s - %s', 'wp_statistics'), $download_url, $TempFile->get_error_message() ) . "</strong></p></div>";
			}
			else {
				// Setup our file handles.
				$infile = fopen($TempFile, 'r' );
				$outfile = fopen($upload_dir['basedir'] . '/wp-statistics/browscap.ini', 'w');

				// We're going to need some variables to use as we process the new browscap.ini.
				// $crawler has three possible settings:
				// 		0 = no setting found
				//		1 = setting found but not a crawler
				// 		2 = setting found and a crawler
				$parent = '';
				$title = '';
				$crawler = 0;
				$parents = array( '' => false );

				// Now read in the browscap.ini file we downloaded one line at a time.
				while( ( $buffer = fgets($infile) ) !== false) 
					{
					// Let's get rid of the tailing carriage return extra spaces.
					$buffer = trim($buffer);
					
					// We're going to do some things based on the first charater on the line so let's just get it once.
					$firstchar = substr( $buffer, 0, 1 );
					
					// The first character will tell us what kind of line we're dealing with.
					switch( $firstchar )
						{
						// A square bracket means it's a section title.
						case '[':

							// We have three sections we need to copy verbatium so don't do the standard processing for them.
							if( $title != 'GJK_Browscap_Version' && $title != 'DefaultProperties' && $title != '*' && $title != '') 
								{
								// If we found the current section is a crawler or we didn't find a crawler setting but the parent is a crawler...
								if( $crawler == 2 || ( $crawler == 0 && array_key_exists( $parent, $parents ) ) ) 
									{
									// Write out the section with just the parent/crawler setting saved.
									fwrite( $outfile, "[" . $title . "]\n" );
									fwrite( $outfile, 'Parent="' . $parent . '"' . "\n");
									fwrite( $outfile, "Crawler=true\n" );
									}
								}
								
							// Reset our variables.
							$crawler = 0;
							$parent = '';
							$title = substr( $buffer, 1, strlen($buffer) - 2 );
							
							// We have three sections we need to copy verbatium so write out their headings immediatly instead of waiting to see if they are a crawler.
							if( $title == 'GJK_Browscap_Version' || $title == 'DefaultProperties' || $title == "*" ) { fwrite($outfile,"[" . $title . "]\n"); }
							
							break;
						// A space or semi-colan means it's a comment.
						case ' ':
						case ';':
							// Since we're hacking out lots of data the only comments we want to keep are the first few in the file before the first section is processed.
							if( $title == '' ) { fwrite( $outfile, $buffer . "\n" ); }
							
							break;
						// Otherwise its a real setting line.
						default:
							// If the setting is for the crawler let's inidicate we found it and it's true.  We can also set the parents array.
							if( $buffer == 'Crawler=true' ) { $crawler = 2; $parents[$title] = true;}
							
							// If the setting for the parent then set it now.
							if( substr( $buffer, 0, 7 ) == 'Parent=' ) { $parent = substr( $buffer, 8, -1 ); }
							
							// We have three sections we need to copy verbatium so write out their settings.
							if( $title == 'GJK_Browscap_Version' || $title == 'DefaultProperties' || $title == "*" ) { fwrite( $outfile, $buffer . "\n" ); }
						}
					}

				// Close the files.
				fclose( $outfile );
				fclose( $infile );

				// Delete the temporary file.
				unlink( $TempFile );

				// Force the cache to be updated.
				$bc->updateCache();

				// Update the options to reflect the new download.
				$WP_Statistics->update_option('last_browscap_dl', time());
				$WP_Statistics->update_option('update_browscap', false);
				
				$result = "<div class='updated settings-error'><p><strong>" . __('browscap database updated successfully!', 'wp_statistics') . "</strong></p></div>";
			}
		}
		else {
			// Update the options to reflect the new download.
			$WP_Statistics->update_option('last_browscap_dl', time());
			$WP_Statistics->update_option('update_browscap', false);
				
			$result = "<div class='updated settings-error'><p><strong>" . __('browscap already at current version!', 'wp_statistics') . "</strong></p></div>";
		}
			
		// All of the messages displayed above are stored in a stirng, now it's time to actually output the messages.
		return $result;
	}
