<?php
	list( $total, $uris ) = wp_statistics_get_top_pages();

?>
<div class="wrap">
	<?php screen_icon('options-general'); ?>
	<h2><?php _e('Top Pages', 'wp_statistics'); ?></h2>
	<div class="postbox-container" id="last-log">
		<div class="metabox-holder">
			<div class="meta-box-sortables">
				<div class="postbox">
					<div class="handlediv" title="<?php _e('Click to toggle', 'wp_statistics'); ?>"><br /></div>
					<h3 class="hndle"><span><?php _e('Top Pages', 'wp_statistics'); ?></span></h3>
					<div class="inside">
							<?php
								// Instantiate pagination object with appropriate arguments
								$pagesPerSection = 10;
								$options = array(25, "All");
								$stylePageOff = "pageOff";
								$stylePageOn = "pageOn";
								$styleErrors = "paginationErrors";
								$styleSelect = "paginationSelect";

								$Pagination = new Pagination($total, $pagesPerSection, $options, false, $stylePageOff, $stylePageOn, $styleErrors, $styleSelect);
								
								$start = $Pagination->getEntryStart();
								$end = $Pagination->getEntryEnd();
								
								$site_url = site_url();
								
								echo "<div class='log-latest'>";
								
								foreach($uris as $uri) {
							
									echo "<div class='log-item'>";
									echo "<div class='log-referred'><a href='{$site_url}{$uri[0]}'>{$uri[0]}</a></div>";
									echo "<div class='log-ip'>".__('Visits', 'wp_statistics').": {$uri[1]}</div>";
									echo "<div class='clear'></div>";
									echo "<div>{$uri[3]}</div>";
									echo "</div>";
								
								}
								
								echo "</div>";
							?>
					</div>
				</div>
				
				<div class="pagination-log">
					<?php echo $Pagination->display(); ?>
					<p id="result-log"><?php echo ' ' . __('Page', 'wp_statistics') . ' ' . $Pagination->getCurrentPage() . ' ' . __('From', 'wp_statistics') . ' ' . $Pagination->getTotalPages(); ?></p>
				</div>
			</div>
		</div>
	</div>
</div>