=== WP Statistics ===
Contributors: mostafa.s1990, GregRoss
Donate link: http://mostafa-soufi.ir/donate/
Tags: statistics, stats, visit, visitors, chart, browser, blog, today, yesterday, week, month, yearl, total, post, page, sidebar, summary, feedburner, hits, pagerank, google, alexa, live visit
Requires at least: 3.0
Tested up to: 4.0
Stable tag: 7.2
License: GPL2

Complete statistics for your WordPress site.

== Description ==
A perfect plugin for your WordPress visitor statistics.

Track Visitor and visit statistics to your blog for today and keep up to a year of history!

Now includes tracking of individual page hits!

On screen statistics report a graphs are easily viewed through the admin interface.

This product includes GeoLite2 data created by MaxMind, available from http://www.maxmind.com.

= Features =

* User Online, see how many people are currently viewing your site
* Visits, see how many hits your site gets each day
* Visitors, see who's visiting your site
* Page tracking, see which pages are viewed most often
* Search Engines, see search queries and redirects from popular search engines like Google, Bing, DuckDuckGo, Yahoo, Yandex and Baidu
* GeoIP location by Country
* Interactive map of visitors location
* E-mail reports of statistics
* Set access level for view and manage roles based on WordPress roles
* Exclude user roles from statistics collection
* Exclude robots from statistics collection
* Exclude IP subnets from statistics collection
* Exclude login/admin pages from statistics collection
* Record statistics on exclusions
* Automatic updates to the GeoIP database
* Automatically prune the databases of old data
* Export the data to Excel, XML, CSV or TSV files
* Overview and detail pages for all kinds of data, including; browser versions, country stats, hits, exclusions, referrers, searches, search words and visitors
* Widget to provide information to your users
* Shortcodes for many different types of data in both widgets and posts/pages
* Comprehensive Admin Manual

= Translators =

* English
* Persian
* Portuguese [Thanks](http://www.musicalmente.info/)
* Romanian [Thanks Luke Tyler](http://www.nobelcom.com/)
* French Thanks Anice Gnampa. Additional translations by Nicolas Baudet and eldidi
* Russian [Thanks Igor Dubilej](http://www.iflexion.com/)
* Spanish Thanks Jose
* Arabic [Thanks Hammad Shammari](http://www.facebook.com/aboHatim)
* Turkish [Thanks aidinMC](http://www.artadl.ir/) & [Manset27.com](http://www.manset27.com/) & [Abdullah Manaz](http://www.manaz.net/)
* Italian [Thanks Tony Bellardi](http://www.tonybellardi.com/)
* German [Thanks Andreas Martin](http://www.andreasmartin.com/)
* Russian [Thanks Oleg](http://www.bestplugins.ru/)
* Bengali [Thanks Mehdi Akram](http://www.shamokaldarpon.com/)
* Serbian [Thanks Radovan Georgijevic](http://www.georgijevic.info/)
* Polish Thanks Radosław Rak and Tomasz Stulka.
* Indonesian [Thanks Agit Amrullah](http://www.facebook.com/agitowblinkerz/)
* Hungarian [Thanks ZSIMI](http://www.zsimi.hu/)
* Chinese (Taiwan) [Thanks Toine Cheung](https://twitter.com/ToineCheung)
* Chinese (China) [Thanks Toine Cheung](https://twitter.com/ToineCheung)
* Dutch thanks Friso van Wieringen.

[Percentage languages ​​translation](http://teamwork.wp-parsi.com/projects/wp-statistics/)
To complete the language deficits of [this section](http://teamwork.wp-parsi.com/projects/wp-statistics/) apply.

= Support =

* [Website](http://wp-statistics.com)
* [Plugin Support Forum](http://wordpress.org/support/plugin/wp-statistics)
* [Persian Support](http://forum.wp-parsi.com/forum/17-%D9%85%D8%B4%DA%A9%D9%84%D8%A7%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1/)

== Installation ==
1. Upload `wp-statistics` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Make sure the Date and Time is set correctly in Wordpress.
4. Go to the plugin settings page and configure as required (note this will also download the GeoIP database for the fist time).

== Frequently Asked Questions ==
= Where's the Admin Manual? =
The admin manual is installed as part of the plugin, simply go to Statistics->Manual to view it.  At the top of the page will also be two icons that will allow you to download it in either ODT or HTML formats.

= If the plug does not work? =
Disable / Enable the plugin.

= All visitors are being set to unknown for their location? =
Make sure you've downloaded the GeoIP database and the GeoIP code is enabled.  

Also, if your running an internal test site with non-routable IP addresses (like 192.168.x.x or 172.28.x.x or 10.x.x.x), these addresses will come up as unknown always.

= I was using V3.2 and now that I've upgraded my visitors and visits have gone way down? =
The webcrawler detection code has been fixed and will now exclude them from your stats, don't worry, it now reflects a more accurate view of actual visitors to your site.

= GeoIP is enabled but no hits are being counted? =
The GeoIP code requires several things to function, PHP 5.3 or above, the bcmath extension, the cURL extension and PHP cannot be running in safe mode.  All of these conditions are checked for but there may be additional items required.  Check your PHP log files and see if there are any fatal errors listed.

= How much memory does PHP Statistics require? =
This depends on how many hits your site gets.  The data collection code is very light weight, however the reporting and statistics code can take a lot of memory to process.  The longer you collect data for the more memory you will need to process it.  At a bare minimum, a basic WordPress site with WP Statitics should have at least 32g of RAM.  Sites with lots of plugins and high traffic should look at significantly increasing that.

= I've enabled IP subnet exclusions and now no visitors are recorded? =
Be very careful to set the subnet mask correctly on the subnet list, it is very easy to catch too much traffic.  Likewise if you are excluding a single IP address make sure to include a subnet mask of 32 or 255.255.255.255 otherwise the default subnet of 0 will be used, catching all ip addresses.

= I'm not receiving e-mail reports? =
Make sure you have WordPress configured correctly for SMTP and also check your WP Cron is working correctly.  You can use [Cron View](http://wordpress.org/plugins/cron-view) to examine your WP Cron table and see if there are any issues.

= Does WP Statistics support multi-site? =
WP Statistics hasn't been tested with multi-site and there have been some issues reported with getting it enabled correctly on all sites in a network.

= Does WP Statistics report on post hits? =
Yes, version 6.0 has introduced page hit tracking!

= Does WP Statistics track the time of the hits? =
No.

= The GeoIP database isn't downloading and when I force a download through the settings page I get the following error: "Error downloading GeoIP database from: http://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.mmdb.gz - Forbidden" =
This means that MaxMind has block the IP address of your webserver, this is often the case if it has been blacklisted in the past due to abuse.

You have two options:
- Contact MaxMind and have them umblock your IP addres
- Manually download the database

To manually download the database and install it take the following steps:

- On another system (any PC will do) download the maxmind database from http://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.mmdb.gz
- Decompress the database
- Connect to your web host and create a "wp-statistics" directory in your wordpress uploads folder (usually it is located in wp-content, so you would create a directory "wp-content/uploads/wp-statistics").
- Upload the GeoLite-Country.mmdb file to the folder you just created.

You can also ask MaxMind to unblock your host.  Note that automatic updates will not function until you can successfully download the database from your web server.

== Screenshots ==
1. View stats page.
2. View latest search words.
3. View recent visitors page.
4. View top referrer site page.
5. Optimization page.
6. Settings page.
7. Widget page.
8. View Top Browsers page.
9. View latest Hits Statistics page.
10. View latest search engine referrers Statistics page.

== Upgrade Notice ==
= 7.1 = 
* There is now a manual process for adding an index to the visitor's table to protect against duplicate entries, go to Statistics->Optimization->Database.  Newer installs of WP Statistics already have the index and the option to add it will only be present if do not have it already.

= 7.0 =
* BACKUP YOUR DATABASE BEFORE INSTALLING!
* Page track is now enabled on new installs or upgrades from pre 6.0 installs.
* HighCharts has been replaced by jqPlot and the chart type setting is no longer available.
* If you have enabled statistical reporting you can now use any shortcode that is supported in your WordPress installation, the old variables will continue to work for the time being, however in a future version of WP Statistics they will be removed so please update your message text now with the appropriate shortcodes.

== Changelog ==
= 7.2 =
* Added: Total visitors by country to the push pins on the overview map.
* Added: Statistical reports can now be sent to a custom list of e-mail addresses instead of just the administrator.
* Added: JQVMap option for the overview map.
* Fixed: Additional WP_DEBUG warnings cleaned up.
* Fixed: Google map would sometimes only use part of the area to draw the map in the overview page.
* Updated: Statistical report schedules are now listed by occurrence instead of randomly.
* Updated: Vertical alignment of statistical report option label column now correct.
* Updated: Various grammatical updates.
* Updated: Overview map now limits the number of visitors to five per country.
* Updated: Persian (fa_IR) language.

= 7.1 =
* Added: clearch.org search provider, disabled by default.
* Added: Database tab to optmization page to manually add unique index on the visitors table removed in 7.0.3.
* Updated: Additional WP_DEBUG message fixes.
* Updated: Overview widgets no longer overflows on smaller displays.
* Updated: Charts now properly resize when the browser window does.

= 7.0.4 =
* Fixed: Typo in table definition of visitor table's UAString field.

= 7.0.3 =
* Added: Extra check that the co-efficient setting is valid.
* Updated: Format of the dbDetla scripts to match the guidelines from WordPress, thanks kitchin.
* Updated: Handled some WP_DEBUG warning messages, thanks kitchin.
* Updated: Multiple additional WP_DEBUG warning fixes.
* Updated: Arabic (ar) language.
* Updated: Polish (pl_PL) language.
* Fixed: Typo in variable name which causes the robots list to be overwritten with the defaults incorrectly.
* Fixed: Access role exclusions and search engine exclusions options not displaying correctly in the settings page.
* Removed: Database upgrade code to add the unique index on the visitors table due to issues with multiple users.  Will add back in a future release as a user selectable option.

= 7.0.2 =
* Fixed: Database prefix not being used when creating/updating tables correctly.
* Fixed: New installs caused an error in the new upgrade code as the visitor table did not exist yet.
* Fixed: Replaced use of deprecated $table_prefix global during install/update.

= 7.0.1 =
* Fixed: Error during new installations due to $wpdb object not being available.

= 7.0 =
* Added: New robots to the robots list: aiHitBot, AntivirusPro, BeetleBot, Blekkobot, cbot, clumboot, coccoc, crowsnest.tv, dbot, dotbot, downloadbot, EasouSpider, Exabot, facebook.com, FriendFeedBot, gimme60bot, GroupHigh, IstellaBot, Kraken, LinkpadBot, MojeekBot, NetcraftSurveyAgent, p4Bot, PaperLiBot, Pimonster, scrapy.org, SearchmetricsBot, SemanticBot, SemrushBot, SiteExplorer, Socialradarbot, SpiderLing, uMBot-LN, Vagabondo, vBSEO, WASALive-Bot, WebMasterAid, WeSEE, XoviBot, YoudaoBot,
* Added: Overview page can now be customized for what is displayed on a per user basis.
* Added: Overview tab to the settings page to control what is displayed.  This page is available to any user that has read access to WP Statistics.
* Added: Dutch (nl_NL) translation, thanks Friso van Wieringen.
* Added: New index on visitor table for existing installs to avoid duplicate entries being created.
* Added: jqPlot javascript library.
* Added: Three new schedule options for statistical reports; weekly, bi-weekly and every 4 weeks.
* Fixed: Some country codes not displaying in the "Top Countries" overview widget/page.
* Fixed: Export filename contained a colon, which is not a valid character.
* Fixed: In some cases purging data in the optimization page would succeed but the UI would "re-activate".
* Updated: All charts now use jqPlot instead of HighCharts so we are now fully GPL compliant.
* Updated: "Top Referring Sites" on the overview page now only displays if there are entries to be displayed.
* Updated: "Latest Search Words" on the overview page now only displays if there are entries to be displayed.
* Updated: "Top Pages Visited" on the overview page now only displays if there are entries to be displayed.
* Updated: About on the overview page box.
* Updated: Settings page from css tabs to jQuery tabs.
* Updated: Settings system (which used individual WordPress settings for each option) to a new unified system (uses a single WordPress setting and stores it as an array)
* Updated: Optimization page from css tabs to jQuery tabs.
* Updated: Install/Upgrade code to share a single code base.
* Updated: Persian (fa_IR) language.
* Updated: Arabic (ar) language.
* Updated: rtl.css file for new version.
* Updated: Lots of code comments.
* Updated: Statistical report schedule list in settings is now dynamically generated.
* Updated: WP-Statistics screenshots.
* Removed: "Alternate map location" setting as it has been made redundant by the new overview display settings.
* Removed: "Chart type" setting as chart types are now hard coded to the appropriate type for the data.
* Removed: HighCharts javascript library.
* Removed: Unused function objectToArray().

= 6.1 =
* Added: Display of the current memory_limit setting from php.ini in the optimization page.
* Added: New index on visitor table for new installs to avoid duplicate entries being created.  A future update will add this index to existing installs but will need additional testing before it is implemented.
* Added: Seychelles flag.
* Updated: Support international number formats in statistics display.
* Updated: Description of WordPress.org plugin link in plugin list.
* Updated: Widget and shortcode now use the countonly option in wp_statistics_vistor() for better performance.
* Updated: Renamed plugin from "WordPress Statistics" to "WP Statistics".
* Fixed: bug in new IP validation code and support for stripping off port numbers if they are passed through the headers.  Thanks Stephanos Io.
* Updated: Persian (fa_IR) language.

= 6.0 =
* Added: Page tracking support.  Includes new overview widget and detail page.  Also supports page hit count in the pages/post list and in the page/post editor.
* Added: Admin manual, online viewing as well as downloadable version.
* Added: Links for “Settings”, “WordPress Plugin Page” and “Rate” pages to the plugin list for WP Statistics.
* Updated: General settings tab re-organization. 
* Updated: Several typo's and other minor issues.
* Updated: Highcharts JS v3.0.9 to JS v4.0.1.
* Updated: Persian (fa_IR) language.
* Updated: Polish (pl_PL) language.
* Updated: Arabic (ar) language.
* Updated: Turkish (tr_TR) language.
* Removed: shortcode and functions reference from readme.txt, now in admin manual.

= 5.4 =
* Fixed: GeoIP dependency code to ignore safe mode check in PHP 5.4 or newer.
* Fixed: GeoIP dependency code to properly detect safe mode with PHP 5.3 or older.
* Fixed: Browser information not recorded if GeoIP was not enabled.
* Updated: get_IP code to better handle malformed IP addresses.
* Updated: Persian (fa_IR) language.
* Updated: Arabic (ar) language.
* Updated: Chinese (zh_CN) language.

= 5.3 =
* Added: New robot's to the robots list: BOT for JCE, Leikibot, LoadTimeBot, NerdyBot, niki-bot, PagesInventory, sees.co, SurveyBot, trendictionbot, Twitterbot, Wotbox, ZemlyaCrawl
* Added: Check for PHP's Safe Mode as the GeoIP code does not function with it enabled.
* Added: Option to disable administrative notices of inactive features.
* Added: Option to export column names as first line of export files.
* Added: Options to disable search engines from being collected/displayed.
* Updated: French (fr_FR) language translation.
* Fixed: Download of the GeoIP database could cause a fatal error message at the end of a page if it was triggered outside the admin area.

= 5.2 =
* Added: Additional checks for BC Math and cURL which are required for the GeoIP code.
* Updated: GeoIP database handling if it is missing or invalid.
* Updated: GeoIP database is now stored in uploads/wp-statistics directory so it does not get overwritten during upgrades. 
* Fixed: Typo's in the shortcode codes (thanks 	g33kg0dd3ss).
* Updated: Polish (pl_PL) language.

= 5.1 =
* Fixes: Small bug in referral url.
* Fixes: Problem export table.
* Updated: Arabic (ar) language.

= 5.0 =
* Added: Show last visitor in Google Map.
* Added: Search visitor by IP in log pages.
* Added: Total line to charts with multiple values, like the search engine referrals.
* Added: Shortcodes. [By Greg Ross](http://profiles.wordpress.org/gregross)
* Added: Dashicons to log pages.
* Fixes: Small bugs.
* Fixes: More debug warnings.
* Fixes: User access function level code always returned manage_options no matter what it was actaully set to.
* Updated: Hungarian (hu_HU) language.
* Updated: Turkish (tr_TR) language.
* Removed: Parameter from `wp_statistics_lastpostdate()` function and return date type became dynamic.

= 4.8.1 =
* Fixes: Small bug in the `Current_Date`.
* Fixes: Small bug in the `exclusions.php` file.
* Updated: Polish (pl_PL) language.

= 4.8 =
* Added: Converting Gregorian date to Persian When enabled [wp-parsidate](http://wordpress.org/plugins/wp-parsidate/) plugin.
* Added: New feature, option to record the number and type of excluded hits to your site.
* Added: New exclusion types for login and admin pages.
* Fixes: GeoIP populate code now REALLY functions again.
* Updated: Arabic (ar) language.
* Updated: Polish (pl_PL) language.

= 4.7 =
* Added: Responsive Stats page for smaller-screen devices.
* Added: Dashicons icon for plugin page.
* Added: Tabs option in setting page.
* Added: Tabs category in optimization page.
* Fixes: More debug warnings.
* Fixes: GeoIP populate code now functions again.
* Updated: Some optimization of the statistics code.
* Updated: Search Words now reports results only for referrers with actual search queries.
* Updated: Highcharts JS v3.0.7 to JS v3.0.9.
* Updated: Brazil (pt_BR) language.

= 4.6.1 =
* Fixes: a Small bug in to get rid of one of the reported warnings from debug mode.

= 4.6 =
* Added: In the optimization page you can now empty all tables at once.
* Added: In the optimization page you can now purge statistics over a given number of days old.
* Added: Daily scheduled job to purge statistics over a given number of days old.
* Fixes: Bug in the robots code that on new installs failed to populate the defaults in the database.
* Fixes: All known warning messages when running in WordPress debug mode.
* Fixes: Incorrect description of co-efficient value in the setting page.
* Fixes: Top level links on the various stats pages now update highlight the current page in the admin menu instead of the overview page. 
* Fixes: Install code now only executes on a true new installation instead of on each activation.
* Fixes: Bug in hits code when GeoIP was disabled, IP address would not be recorded.

= 4.5 =
* Added: Support for more search engines: DuckDuckGo, Baidu and Yandex.
* Added: Support for Google local sites like google.ca, google.fr, etc.
* Added: Anchor links in the optimization and settings page to the main sections.
* Added: Icon for Opera Next.
* Updated: Added new bot match strings: 'archive.org_bot', 'meanpathbot', 'moreover', 'spbot'.
* Updated: Replaced bot match string 'ezooms.bot' with 'ezooms'.
* Updated: Overview summary statistics layout.
* Fixes: Bug in widget code that didn't allow you to edit the settings after adding the widget to your site.

= 4.4 =
* Added: option to set the required capability level to view statistics in the admin interface.
* Added: option to set the required capability level to manage statistics in the admin interface.
* Fixes: 'See More' links on the overview page now update highlight the current page in the admin menu instead of the overview page. 
* Added: Schedule downloads of the GeoIP database.
* Added: Auto populate missing GeoIP information after a download of the GeoIP database.
* Fixes: Unschedule of report event if reporting is disabled.

= 4.3.1 =
* Fixes: Critical bug that caused only a single visitor to be recorded.
* Added: Version information to the optimization page.
[Thanks Greg Ross](http://profiles.wordpress.org/gregross)

= 4.3 =
* Added: Definable robots list to exclude based upon the user agent string from the client.
* Added: IP address and subnet exclusion support.
* Added: Client IP and user agent information to the optimization page.
* Added: Support to exclude users from data collection based on their WordPress role.
* Fixes: A bug when the GeoIP code was disabled with optimization page.

= 4.2 =
* Added: Statistical menus.
* Fixes: Small bug in the geoip version.
* Language: Serbian (sr_RS) was updated.
* Language: German (de_DE) was updated.
* Language: French (fr_FR) was updated.

= 4.1 =
* Language: Arabic (ar) was updated
* Fixes: small bug in moved the GeoIP database.
* Updated: update to the spiders list.

= 4.0 =
* Added: GeoIP location support for visitors country.
* Added: Download option in settings for GeoIP database.
* Added: Populate location entries with unknown or missing location information to the optimization page.
* Added: Detect self referrals and disregard them like webcrawlers.
* Added: "All Browsers" and "Top Countries" pages.
* Added: "more" page to hit statistics chart, support for charts from 10 days to 1 year.
* Added: "more" page to search engine statistics chart, support for charts from 10 days to 1 year.
* Added: Option to store complete user agent string for debugging purposes.
* Added: Option to delete specific browser or platform types from the database in the optimization page.
* Updated: Browser detection now supports more browsers and includes platform and version information.
* Updated: List of webcrawlers to catch more bots.
* Updated: Statistics reporting options in settings no longer needs a page reload to hide/show the settings.
* Updated: Summary Statistcs now uses the WordPress set format for the time and date.
* Fixes: Webcrawler detection now works and is case insensitive.
* Fixes: Install code now correctly sets defaults.
* Fixes: Upgrade code now works correctly.  If you are running V3.2, your old data will be preserved, older versions will delete the tables and recreate them.
* Fixes: Ajax submissions on the optmiziation page (like the empty table function) should work in IE and other browsers that are sensitive to cross site attacks.
* Fixes: Replaced call to the dashboard code (to support the postbox widgets on the log screen) with the proper call to the postbox code as WordPress 3.8 beta 1 did not work with the old code.
* Updated: Highcharts JS 3.0.1 to JS 3.0.7 version.

= 3.2 =
* Added: Optimization plugin page.
* Added: Export data to excel, xml, csv and tsv files.
* Added: Delete table data.
* Added: Show memory usage in optimization page.
* Language: Polish (pl_PL) was updated.
* Language: updated.

= 3.1.4 =
* Added: Chart Type in the settings plugin.
* Added: Search Engine referrer chart in the view stats page.
* Added: Search Engine stats in Summary Statistics.
* Optimized: 'wp_statistics_searchengine()' and add second parameter in the function.
* Language: Chinese (China) was added.
* Language: Russian was updated.
* Language: updated.

= 3.1.3 =
* Optimized: View statistics.
* Added: Chinese (Taiwan) language.

= 3.1.2 =
* Added: Top referring sites with full details.
* Resolved: Loads the plugin's translated strings problem.
* Resolved: View the main site in top referring sites.
* Resolved: Empty referrer.
* Resolved: Empty search words.
* Update: Highcharts js 2.3.5 to v3.0.1.
* Language: Arabic was updated.
* Language: Hungarian was updated.
* Language: updated.

= 3.1.1 =
* Bug Fix: Security problem. (Thanks Mohammad Teimori) for report bug.
* Optimized: Statistics screen in resolution 1024x768.
* Language: Persian was updated.

= 3.1.0 =
* Bug Fix: Statistics Menu bar.
* Bug Fix: Referral link of the last visitors.
* Added: Latest all search words with full details.
* Added: Recent all visitors with full details.
* Optimized: View statistics.
* Language: updated.
* Language: Arabic was updated.
* Remove: IP Information in setting page.

= 3.0.2 =
* Added: Hungarian language.
* Added: Insert value in useronline table by Primary_Values function.
* Added: Opera browser in get_UserAgent function.
* Added: prefix wps_ in options.
* Added: Notices to enable or disable the plugin.
* Changed: Statistics class to WP_Statistics because Resemblance name.

= 3.0.1 =
* Bug Fix: Table plugin problem.

= 3.0 =
* Bug Fix: problem in calculating Statistics.
* Optimized: and speed up the process.
* Optimized: Overall reconstruction and coding plug with a new structure.
* Optimized: The use of object-oriented programming.
* Added: statistics screen to complete.
* Added: Chart Show.
* Added: Graph of Browsers.
* Added: Latest search words.
* Added: Specification (Country and county) Visitors.
* Added: Top referring sites.
* Added: Send stats to Email/[SMS](http://wordpress.org/extend/plugins/wp-sms/)

= 2.3.3 =
* Serbian language was solved.
* Server variables were optimized by m.emami.
* Turkish translation was complete.

= 2.3.2 =
* Added Indonesia language.
* Turkish language file corrected by MBOZ.

= 2.3.1 =
* Added Polish language.
* Added Support forum link in menu.
* Fix problem error in delete plugin.

= 2.3.0 =
* Added Serbian language.

= 2.2.9 =
* Added Bengali language.

= 2.2.8 =
* Added Russian language.
* Fix problem in count views.
* Added more filter for check spider.
* Optimize plugin.

= 2.2.7 =
* Fix problem in widget class.
* Redundancy in Arabic translation.
* Fix problem in [countposts] shortcode.
* Optimized Style Reports.

= 2.2.6 =
* Fix a small problem.

= 2.2.5 =
* The security problem was solved. Please be sure to update!
* Redundancy in French translation.
* Add CSS Class for the containing widget. (Thanks Luai Mohammed).
* Add daily or total search engines in setting page.
* Using wordpress jQuery in setting page.

= 2.2.4 =
* Added Turkish language.
* Added Italian language.
* Added German language.
* Arabic language was solved.
* Romanian language was solved.
* The words in setting page were complete. (Thanks Will Abbott) default.po file is Updated.
* The change of time from minutes to seconds to check users online.
* Ignoring search engine crawler.
* Added features premium version to free version.
* Added user online live.
* Added total visit live.
* Added Increased to visit.
* Added Reduced to visit.
* Added Coefficient statistics for each user.

= 2.2.3 =
* Optimized Counting.
* Added Arabic language.
* Draging problem was solved in Widgets
* css problem was solved in sidebar

= 2.2.2 =
* Solving show functions in setting page.
* Solving month visit in widget.
* Added Spanish language.

= 2.2.1 =
* Solving drap uploader problem in media-new.php.

= 2.2.0 =
* Added statistics to admin bar wordpress 3.3.
* Added Uninstall for remove data and table from database.
* Added all statistics item in widget and Their choice.
* Optimize show function code in setting page.
* Calling jQuery in wordpress admin for plugin.
* Remove the word "disabled" in the statistics When the plugin was disabled.
* Solving scroll problem in statistics page.

= 2.1.6 =
* Added Russian language.

= 2.1.5 =
* Added French language.
* Rounds a float Averages.

= 2.1.4 =
* Added Romanian language.

= 2.1.3 =
* Active plugin in setting page was solved.

= 2.1.2 =
* Added default language file.
* Added Portuguese language.

= 2.1.1 =
* Complete files

= 2.1 =
* Edit string

= 2.0 =
* Support from Database
* Added Setting Page
* Added decimals number
* Added Online user check time
* Added Database check time
* Added User Online
* Added Today Visit
* Added Yesterday Visit
* Added Week Visit
* Added Month Visit
* Added Years Visit
* Added Search Engine reffered
* Added Average Posts
* Added Average Comments
* Added Average Users
* Added Google Pagerank
* Added Alexa Pagerank
* Added wordpress shortcode

= 1.0 =
* Start plugin