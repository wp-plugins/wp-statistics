=== WP Statistics ===
Contributors: mostafa.s1990, GregRoss
Donate link: http://wp-statistics.com/donate/
Tags: statistics, stats, visit, visitors, chart, browser, blog, today, yesterday, week, month, year, total, post, page, sidebar, summary, feedburner, hits, pagerank, google, alexa, live visit
Requires at least: 3.0
Tested up to: 4.2
Stable tag: 9.4.1
License: GPL3

Complete statistics for your WordPress site.

== Description ==
A comprehensive plugin for your WordPress visitor statistics, come visit us at our [website](http://wp-statistics.com) for all the latest news and information.

Track statistics for your WordPress site without depending on external services and uses arrogate data whenever possible to respect your users privacy.

On screen statistics presented as graphs are easily viewed through the WordPress admin interface.

This product includes GeoLite2 data created by MaxMind, available from http://www.maxmind.com.

= Features =
* Online users, visits, visitors and page statistics
* Search Engines, see search queries and redirects from popular search engines like Google, Bing, DuckDuckGo, Yahoo, Yandex and Baidu
* Overview and detail pages for all kinds of data, including; browser versions, country stats, hits, exclusions, referrers, searches, search words and visitors
* GeoIP location by Country
* Support for hashing IP addresses in the database to protect your users privacy
* Interactive map of visitors location
* E-mail reports of statistics
* Set access level for view and manage roles based on WordPress roles
* Exclude users from statistics collection based on various criteria, including; user roles, common robots, IP subnets, page URL, login page, RSS pages, admin pages, Country, number of visits per day, hostname
* Record statistics on exclusions
* Automatic updates to the GeoIP database
* Automatically prune the databases of old data
* Export the data to Excel, XML, CSV or TSV files
* Widget to provide information to your users
* Shortcodes for many different types of data in both widgets and posts/pages
* Dashboard widgets for the admin area
* Comprehensive Admin Manual

= Support =
We're sorry you're having problem with WP Statistics and we're happy to help out.  Here are a few things to do before contacting us:

* Have you read the [FAQs](http://wordpress.org/plugins/wp-statistics/faq/)?
* Have you read the [manual](http://plugins.svn.wordpress.org/wp-statistics/trunk/manual/WP%20Statistics%20Admin%20Manual.html)?
* Have you search the [support forum](http://wordpress.org/support/plugin/wp-statistics) for a similar issue?
* Have you search the Internet for any error messages you are receiving?
* Make sure you have access to your PHP error logs.

And a few things to double-check:

* How's your memory_limit in php.ini?
* Have you tried disabling any other plugins you may have installed?
* Have you tried using the default WordPress theme?
* Have you double checked the plugin settings?
* Do you have all the required PHP extensions installed?
* Are you getting a blank or incomplete page displayed in your browser?  Did you view the source for the page and check for any fatal errors?
* Have you checked your PHP and web server error logs?

Still not having any luck? Open a new thread on one of the support forums and we'll respond as soon as possible.

* [English Support Forum](http://wordpress.org/support/plugin/wp-statistics)
* [Persian Support Forum](http://forum.wp-parsi.com/forum/17-%D9%85%D8%B4%DA%A9%D9%84%D8%A7%D8%AA-%D8%AF%DB%8C%DA%AF%D8%B1/)

= Translations =
* English
* Persian
* Portuguese [Thanks](http://www.musicalmente.info/)
* Romanian [Thanks Luke Tyler](http://www.nobelcom.com/)
* French Thanks Anice Gnampa. Additional translations by Nicolas Baudet, eldidi and apeedn
* Russian [Thanks Igor Dubilej](http://www.iflexion.com/)
* Spanish Thanks Jose
* Arabic [Thanks Hammad Shammari](http://www.facebook.com/aboHatim)
* Turkish [Thanks aidinMC](http://www.artadl.ir/) & [Manset27.com](http://www.manset27.com/) & [Abdullah Manaz](http://www.manaz.net/)
* Italian [Thanks Tony Bellardi](http://www.tonybellardi.com/) & Andrea Beducci
* German [Thanks Andreas Martin](http://www.andreasmartin.com/) and Mike
* Russian [Thanks Oleg](http://www.bestplugins.ru/)
* Bengali [Thanks Mehdi Akram](http://www.shamokaldarpon.com/)
* Serbian [Thanks Radovan Georgijevic](http://www.georgijevic.info/) & [Thanks Ogi Djuraskovic](http://firstsiteguide.com/)
* Polish Thanks Radosław Rak and Tomasz Stulka.
* Indonesian [Thanks Agit Amrullah](http://www.facebook.com/agitowblinkerz/)
* Hungarian [Thanks ZSIMI](http://www.zsimi.hu/)
* Chinese (Taiwan) [Thanks Toine Cheung](https://twitter.com/ToineCheung)
* Chinese (China) [Thanks Toine Cheung](https://twitter.com/ToineCheung)
* Dutch thanks Friso van Wieringen.

Translations are done by people just like you, help make WP Statistics available to more people around the world and [do a translation](http://wp-statistics.com/translations/) today!

== Installation ==
1. Upload `wp-statistics` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Make sure the Date and Time is set correctly in WordPress.
4. Go to the plugin settings page and configure as required (note this will also download the GeoIP database for the fist time).

== Frequently Asked Questions ==
= Where's the Admin Manual? =
The admin manual is installed as part of the plugin, simply go to Statistics->Manual to view it.  At the top of the page will also be two icons that will allow you to download it in either ODT or HTML formats.

= What do I do if the plug does not work? =
Disable / Enable the plugin.  You may also want to remove and re-install it.

= All visitors are being set to unknown for their location? =
Make sure you've downloaded the GeoIP database and the GeoIP code is enabled.  

Also, if your running an internal test site with non-routable IP addresses (like 192.168.x.x or 172.28.x.x or 10.x.x.x), these addresses will come up as unknown always.

= I was using V3.2 and now that I've upgraded my visitors and visits have gone way down? =
The webcrawler detection code has been fixed and will now exclude them from your stats, don't worry, it now reflects a more accurate view of actual visitors to your site.

= GeoIP is enabled but no hits are being counted? =
The GeoIP code requires several things to function, PHP 5.3 or above, the bcmath extension, the cURL extension and PHP cannot be running in safe mode.  All of these conditions are checked for but there may be additional items required.  Check your PHP log files and see if there are any fatal errors listed.

= How much memory does PHP Statistics require? =
This depends on how many hits your site gets.  The data collection code is very light weight, however the reporting and statistics code can take a lot of memory to process.  The longer you collect data for the more memory you will need to process it.  At a bare minimum, a basic WordPress site with WP Statistics should have at least 32 meg of RAM available for a page load.  Sites with lots of plugins and high traffic should look at significantly increasing that (128 to 256 meg is not unreasonable).

= I've enabled IP subnet exclusions and now no visitors are recorded? =
Be very careful to set the subnet mask correctly on the subnet list, it is very easy to catch too much traffic.  Likewise if you are excluding a single IP address make sure to include a subnet mask of 32 or 255.255.255.255 otherwise the default subnet of 0 will be used, catching all ip addresses.

= I'm not receiving e-mail reports? =
Make sure you have WordPress configured correctly for SMTP and also check your WP Cron is working correctly.  You can use [Cron View](http://wordpress.org/plugins/cron-view) to examine your WP Cron table and see if there are any issues.

= Does WP Statistics support multi-site? =
WP Statistics hasn't been tested with multi-site and there have been some issues reported with getting it enabled correctly on all sites in a network.

= Does WP Statistics report on post hits? =
Yes, version 6.0 has introduced page hit statistics!

= Does WP Statistics track the time of the hits? =
No.

= The GeoIP database isn't downloading and when I force a download through the settings page I get the following error: "Error downloading GeoIP database from: http://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.mmdb.gz - Forbidden" =
This means that MaxMind has block the IP address of your webserver, this is often the case if it has been blacklisted in the past due to abuse.

You have two options:
- Contact MaxMind and have them unblock your IP address
- Manually download the database

To manually download the database and install it take the following steps:

- On another system (any PC will do) download the maxmind database from http://geolite.maxmind.com/download/geoip/database/GeoLite2-Country.mmdb.gz
- Decompress the database
- Connect to your web host and create a "wp-statistics" directory in your wordpress uploads folder (usually it is located in wp-content, so you would create a directory "wp-content/uploads/wp-statistics").
- Upload the GeoLite-Country.mmdb file to the folder you just created.

You can also ask MaxMind to unblock your host.  Note that automatic updates will not function until you can successfully download the database from your web server.

= I've activated the plugin but the menus don't show up and nothing happens? =

WP Statistics requires PHP 5.3, if it has detected an older version of PHP installed it will active cleanly in WordPress but disable all functionality, you will have to upgrade to PHP 5.3 or above for it to function.  WP Statistics will display an error on your plugin list just below the WP Statistics entry to let you know.

If there is no error message there may be something else wrong, your first thing to try is disabling your other plugins as they can sometimes cause conflicts.

If you still don't see the menus, go to the support forums and open a new thread and we'll try to help out.

= I'm using another statistics plugin/service and get different numbers for them, why? =

Pretty much every plugin/service is going to give you different results for visits and vistors, there are several reasons for this:

* Web crawler detection
* Detection method (javascript vs server side PHP)
* Centralized exclusions

Services that use centralized databases, like Google Analytics, for spam and robot detection have better detection than WP Statistics can.  The trade off of course is relaying on an external service.

= When I upgrade or install WP Statistics I get an error message like "Parse error: syntax error, unexpected T_STRING, expecting T_CONSTANT_ENCAPSED_STRING or '('" =

Since WP Statistics 8.0, PHP 5.3 or above has been required.  If you are using an older version of PHP it cannot understand the new syntax included in WP Statistics 8.0 and generates a parse error. 

Your hosting provider should have a newer version of PHP available, sometimes you must activate it through your hosting control panel.

Since the last release of PHP 5.2 is over 3 years ago (Jan 2011) and is no longer supported or receiving security fixes, if your provider does not support a newer version you should probably be moving hosting providers.

If you have done an upgrade and you can no longer access your site due to the parse error you will have to manually delete the wp-statistics directory from your wordpress/wp-content/plugins directory, either through your hosting providers control panel or FTP.

Do not use older versions of WP Statistics as they have know security issues and will leave your site vulnerable to attack.

= I've decided to stay with WP Statistics 7.4 even though its a bad idea but now WordPress continuously reports there are updates available, how can I stop that? =

Don't, upgrade immediately to the latest version of WP Statistics.

= Something has gone horribly wrong and my site no longer loads, how can I disable the plugin without access to the admin area? =

You can manually disable plugins in WordPress by simply renaming the folder they are installed in.  Using FTP or your hosting providers file manager, go to your WordPress directory, from ther go to wp-content/plugins and rename or delete the wp-statistics folder.

= I'm getting an error in my PHP log like: Fatal error: Call to undefined method Composer\Autoload\ClassLoader::set() =

We use several libraries and use a utility called Composer to manage the dependencies between them.  We try and keep our Composer library up to date but not all plugins do and sometimes we find conflicts with other plugins.  Try disabling your other plugins until the error goes away and then contact that plugin developer to update their Composer files.

= The search words and search engine referrals are zero or very low, what's wrong? =

Search Engine Referrals and Words are highly dependent on the search engine providing the information to us and that often is not the case.  Unfortunately there is nothing we can do about this, we report on everything we receive.

= Why did my visits suddenly jump way up today? =

There can be many reasons for this, but the most common reason is a botnet has decided to visit your site and we have been unable to filter it out.  You usually see your visits spike for a few days and then they give up.

= What’s the difference between Visits and Visitors? =

Visits is the number of page hits your site has received.

Visitors is the number of unique users that have visited your site.

Visits should always be greater than Visitors (though there are a few times when this won’t be true on very low usage sites due to how the exclusion code works).

The average number of pages a visitor views on your site is Visits/Visitors.

= My overview screen is blank, what's wrong? =

This is usually caused by a PHP fatal error, check the page source and PHP logs.

The most common fatal error is an out of memory error. Check the Statistics->Optimization page and see how much memory is currently assigned to PHP and how much the overview is using.

If it is a memory issue you have two choices:
 - Increase PHP's memory allocation
 - Delete some of your historical data.

See http://php.net/manual/en/ini.core.php#ini.memory-limit for information about PHP's memory limit.

To remove historical data you can use the Statistics->Optimization->Purging->Purge records older than.

= Not all referrals are showing up in the search words list, why? =

Unfortunate we're completely dependent on the search engine sending use the search parameters as part of the referrer header, which they do not always do.

= Does WP Statistics work with caching plugins? =

Probably not, most caching plugins don't execute the standard WordPress loop for a page it has already cached (by design of course) which means the WP Statistics code never runs for that page.

This means WP Statistics can't record the page hit or visitor information, which defeats the purpose of WP Statistics.

We do not recommend using a caching plugin along with WP Statistics.

= I get an error message like "PHP Fatal error: Function name must be a string in /../parse-user-agent.php" =

Do you have eAccelerator installed?  If so this is a known issue with eAccelerator and PHP's "anonymous" functions, which are used in the user agent parsing library.  As no new versions of eAccelerator have been released for over 3 years, you should look to replace it or disable it.

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
= 9.4.1 = 
This is a security release, please upgrade immediately.
If upgrading from pre-9.0, please make sure to backup your database before installing.  Once installed, please go to Statistics->Optimization->Database and add the visits index.

= 9.4 = 
If upgrading from pre-9.0, please make sure to backup your database before installing.  Once installed, please go to Statistics->Optimization->Database and add the visits index.

= 9.3.1 = 
If upgrading from pre-9.0, please make sure to backup your database before installing.  Once installed, please go to Statistics->Optimization->Database and add the visits index.

= 9.3 = 
If upgrading from pre-9.0, please make sure to backup your database before installing.  Once installed, please go to Statistics->Optimization->Database and add the visits index.

= 9.2 = 
If upgrading from pre-9.0, please make sure to backup your database before installing.  Once installed, please go to Statistics->Optimization->Database and add the visits index.

= 9.1.3 =
If upgrading from pre-9.0, please make sure to backup your database before installing.  Once installed, please go to Statistics->Optimization->Database and add the visits index.

= 9.1.2 =
If upgrading from pre-9.0, please make sure to backup your database before installing.  Once installed, please go to Statistics->Optimization->Database and add the visits index.

= 9.1.1 =
If upgrading from pre-9.0, please make sure to backup your database before installing.  Once installed, please go to Statistics->Optimization->Database and add the visits index.

= 9.1 =
BACKUP YOUR DATABASE BEFORE INSTALLING!  This release alters the table structure of the database.  Once installed, please go to Statistics->Optimization->Database and add the visits index.

= 9.0 =
This release updates some core code to do with timezones, hence the change to version 9.0, if you see any issues with timezones, please let us know.  In addition, you may see an increase in your visits count as a race condition that dropped some visits has been resolved.

== Changelog ==
= 9.4.1 =
* Release Date: July 9, 2015
* Fixed: SQL injection security issue for users with access to the admin pages.
* Fixed: Bug in code to save new "Treat corrupt browser info as a bot" setting.
* Fixed: Bug in scheduled data pruge code that would not append the correct table prefix.
* Updated: Admin manual.

= 9.4 =
* Release Date: July 3, 2015
* Added: Date selector to top visitors page.
* Added: Option to exclude WordPress's "Not Found" page from the statistics.
* Added: Option to treat corrupt http header information as bots (missing IP addresses or user agents).
* Added: New robots to list; 007ac9, 5bot, advbot, alphabot, anyevent, blexbot, bubing, cliqzbot, dl2bot, duckduckgo, EveryoneSocialBot, findxbot, glbot, linkapediabot, ltx71, mediabot, medialbot, monobot, OrangeBot, owler, pageanalyzer, porkbun, pr-cy, pwbot, r4bot, revip, riddler, rogerbot, sistrix, SputnikBot, u2bot, uni5download, unrulymedia, wsowner, wsr-agent, x100bot and xzybot
* Fixed: Make sure the admin bar only appears for users that have read/manage permissions in WP Statistics.
* Updated: Split the access and exclusions tabs in settings.

= 9.3.1 =
* Release Date: May 15, 2015
* Fixed: Typo in options name that caused the visitors map to never be displayed.

= 9.3 =
* Release Date: May 15, 2015
* Added: Shortcode UI (aka ShortCake) support.
* Added: Donation menu and dismissble banner on the overview page.
* Added: Applebot, Superfeedr, jetmon, sfFeedReader and feedzirra to the robots list.
* Added: Summary postbox on hit statistics page.
* Added: Summary postbox on exclusions page.
* Added: Date range selector on top countries page.
* Added: Purge data based on visitor's hit count on the optimization page.
* Added: Option to purge data based on visitor's hit count on a daily basis.
* Added: Option to record the page title for search referrals that do not contain a query value.
* Updated: Moved all ajax and pseudo ajax calls to use the standard WordPress ajax and init routines instead of using wp-load.php.
* Updated: Widgets and pages will only be displayed if the associated statistics is being collected, for example the search engine referrals will only be displayed if the visitor tracking option is enabled.
* Fixed: Typo in variable name for one of the dashboard widgets.
* Fixed: PHP error when the $browser object wasn't an object when we checked the crawler property.
* Fixed: Incorrect parameter for get_option() on two option in the settings page.
* Fixed: Widget's didn't translate correctly.

= 9.2 =
* Release Date: April 26, 2015
* Added: Date range selector for charts now supports arbitrary date ranges with JavaScript date selector.
* Added: If the site is using the blogroll for the homepage, use the blog title as the page name instead of leaving it blank.
* Updated: How country codes are loaded for dashboard, widgets and pages.
* Fixed: Incorrect URL in the admin manual.
* Fixed: WP_DEBUG warning if formatting was not specified in the short code.

= 9.1.3 =
* Release Date: April 14, 2015
* Added: Quick link to summary stats.
* Added: Escaped text fields in the settings page with htmlentities() to protect against rouge administrators hijacking other admin sessions, thanks Kaustubh.
* Fixed: Exclusions page had duplicate quotation marks in some JavaScript fields causing errors.
* Fixed: Display of last_counter that is already set to the correct date and doesn't need to be adjusted for timezone.

= 9.1.2 =
* Release Date: March 20, 2015
* Fixed: Removed spurious comma in SQL creation script for Visits table, thanks kitchin.

= 9.1.1 =
* Release Date: March 19, 2015
* Fixed: Verify the $display settings return an array before using it as an array to avoid warning on overview page.

= 9.1 =
* Release Date: March 18, 2015
* Added: Unique index requirement on visits table to avoid race condition creating duplicate entires.
* Added: Option to the optimization page to remove duplicates and add new  unique index to visits table on existing installs.
* Updated: Translations, thanks to all of our translators!
* Updated: Cleanup of some WP Debug warnings.
* Fixed: JavaScript postboxes call was currupted on some pages causing a javascript error.
* Fixed: Change html encode to jason_ecnode for data to be used in javascript to avoid single quotes as part of the translation breaking the javascript array, this change now fixes extended character display in the JavaScript charts.
* Fixed: Verify $WP_Statistics is an object before using it, which was causing a fatal error on some installs.
* Removed: Redudnent e modifier in preg_replace_callback to avoid php warning message.

= 9.0 =
* Release Date: March 12, 2015
* Added: URL exclusions option.
* Added: Swedish translation, thanks ronneborn.
* Added: Kurdish (Sorani) translation, thanks sardar4it.
* Added: Daily wp cron job to create an entry in the visits table for the next day to avoid a race condition.
* Updated: The visits code now uses a SQL UPDATE instead of WP's update() to avoid a race condition.
* Updated: Performance improvements in the last visitors page.
* Updated: Performance improvements in the referrers page.
* Updated: Added missing dash_icon call in online users page.
* Updated: Make sure the $wp_object global variable is an object before using it, just in case, in the hits code.
* Updated: Make sure the $wp_query global variable is an object before using it, just in case, in the hits code.
* Updated: Removed variables from i18n functions for better translation support.
* Updated: Removed requirement for date_default_timezone_set() which conflicted with some other plugins.
* Updated: Make sure to html encode data to be used in javascript to avoid single quotes as part of the translation breaking the javascript array.
* Updated: Change summary widget to be clearer about time frames.
* Updated: Replace deprecated preg_replace (with /e) with preg_replace_callback.  Thanks gbonvehi.
* Updated: Use full path to ensure the require_once finds the purge file in the scheduled db maintenance script.
* Updated: Persian translation.
* Updated: Renamed pagination class to avoid name collisions with other plugins.
* Updated: Date display in recent visitors and search words now uses the WordPress date format setting.
* Updated: Upgrade email is now send at the end of the page load as wp_mail() hasn't been created during the upgrade script.
* Fixed: Export code to handle large tables.
* Fixed: Exclusion display for some 'reasons' always being 0.
* Removed: Replaced use of global $table_prefix with $wpdb->prefix.
* Removed: Use of deprecated $blog_id.  Thanks gbonvehi.

= 8.8.1 =
* Release Date: March 9, 2015
* Updated license to GPL3.

= 8.8 =
* Release Date: January 31, 2015
* Added: Installation/upgrades/removals on WordPress multi-sites now upgrade all sites in the network if the installing user has the appropriate rights.
* Added: RSS feed URL's can now be excluded.
* Added: Option to set the country code for private IP addresses.
* Fixed: Additional WP_DEBUG warning fixes.
* Fixed: Incorrect parameter list in get_home_url() when checking for self referrals. 
* Fixed: Single quotes can now be used in the report content without being escaped.
* Fixed: Referrers menu item was misspelled.
* Updated: Italian, French, Polish, Arabic, Persian and Chinese translation.
* Updated: Widget now formats numbers with international standards.
* Updated: Short codes now support three number formatting options; i18n, english or none.
* Updated: Removed old throttling code for hits which is no longer required. 
* Updated: IP address exclusions without a subnet mask now assume a single IP address instead of all IP addresses.

= 8.7.2 =
* Release Date: January 6, 2015
* Added: shareaholic-bot to robots list.
* Fixed: Robot threshold setting was not being saved.
* Updated: Italian translation, thanks illatooscuro.
* Updated: Arabic translation, thanks Hammad.
* Updated: Honey pot page title now includes "Pot" in it.

= 8.7.1 =
* Release Date: December 28, 2014
* Fixed: Variable scope for the exclusion match/reason updated to protected from private to allow the GeoIP code to set them.  This could cause various issues including failed uploades depending on the error reporting level set for PHP.

= 8.7 =
* Release Date: December 27, 2014
* Added: Charts with multiple lines now include the data set name in the tooltip.
* Added: Honey pot option to detect crawlers.
* Added: Robot threshold option.
* Added: Hit count for visitors is now recorded and displayed.
* Added: Top Visitors today widget and page.
* Fixed: GeoIP exclusion logic didn't work as the location information was not set before it was applied, moved it to the appropriate location.
* Fixed: Incorrect setting names for country include/excludes as well as hosts.
* Fixed: Page URI length could exceed the database storage limit and cause duplicate entry warnings, URI is now truncated before being stored.
* Updated: Polish and Farsi translations.
* Updated: User agent parser to V0.3.2.
* Updated: GeoIP library to v2.1.1.

= 8.6.3 =
* Release Date: December 11, 2014
* Fixed: Really fix included countries code this time.
* Fixed: Typo in excluded hosts code.

= 8.6.2 =
* Release Date: December 11, 2014
* Fixed: New included countries code incorrectly identified all countries as excluded.

= 8.6.1 =
* Release Date: December 11, 2014
* Added: Code to perform additional clean up of uncommon user agents.
* Fixed: Spurious break statement in GeoIP exclusion code which caused a fatal error in certian cases.

= 8.6 =
* Release Date: December 11, 2014
* Added: Option to remove URI parameters from page tracking.
* Added: GeoIP exclusion options.
* Added: Host name exclusion options.
* Fixed: Map dashboard widget fails when Google is selected as map provider.
* Fixed: Changing the statistical report schedule would not actually change the schedule unless you disabled and then enabled the statistical reports feature.
* Updated: French language.

= 8.5.1 =
* Release Date: December 2, 2014
* Fixed: Typo in last search page causing fatal error in PHP.

= 8.5 =
* Release Date: December 2, 2014
* Added: try/catch condition around browscap call to avoid fatal errors stopping the script.
* Added: Page trend widget to post/page editor.
* Added: Aland Islands Flag icon.
* Added: Option to record all online users regardless if they would otherwise be excluded.
* Added: Option to disable the page editor widget.
* Fixed: Various security fixes, thanks Ryan.
* Fixed: Resolved warnings when natcasesort received a null list, thanks robertalks.
* Fixed: Before updating the browscap.ini cache file, remove stale lock files.
* Fixed: Avoid throwing a fatal error when the shutdown code is called if for some reason the global $WP_Statistics variable has been destroyed during a page load.
* Updated: The online code now uses the same rules to exclude users as the hits code.
* Updated: Minor code cleanups and data return checks.
* Updated: German translations, thanks bios4.
* Updated: Polish and Turkish translations.
* Updated: Use built in WordPress function to translate user roles instead of custom strings in our PO file, thanks bios4.

= 8.4 =
* Release Date: November 26, 2014
* Added: Dashboard widgets for all of the widgets on the overview page.
* Added: Option to disable all dashboard widgets.
* Added: Old dashboard widget upgraded with last 10 days of hits statistics.
* Added: Online users page and time a user has been online.
* Fixed: Fixed missing site_url on top 10 pages in the overview page.
* Fixed: Incorrect url generated for Google map if dashboard was being forced in to https mode.
* Fixed: Properly un-escape quotation marks in report body if magic quotes is enabled.
* Fixed: URL referrer CSS style would 'push' other entires to the next line on small displays.
* Fixed: Various PHP warnings on uninitalized variables, thanks bseddon
* Updated: Polish translations.
* Updated: Default map type now set to JQVMap.

= 8.3.1 =
* Release Date: November 19, 2014
* Updated: Various SQL code clean ups.
* Updated: Varioud data validation clean ups.
* Updated: Various data output encoding updates, thanks Marc.

= 8.3 =
* Release Date: November 14, 2014
* Added: Sanity checks for file size and results to browscap.ini updates, if the new cache file size is wrong or it mis-identifies a common real browser as a crawler the update will be rolled back.
* Added: Option to e-mail a report on browscap.ini, database pruning, upgrades and GeoIP database updates.
* Updated: Polish translations.
* Updated: Added "Notificaitons" tab to the settings page and moved statistical report settings to it.
* Fixed: The historical data table no longer uses reserved keywords as column names which caused issues on older versions of MySQL.
* Fixed: Unable to set visits historical count.
* Fixed: Purging did not record visits/visitors correctly if not already set through the optimization page.
* Fixed: JavaScript bug when a non-administrative user viewed the settings page.
* Removed: Reference to old settings file for the widget.

= 8.2 =
* Release Date: November 6, 2014
* Added: Support for historical data.
* Added: Removal option.
* Updated: Optimized SQL statements to hopefully get rid of duplicate key error/warnings.
* Updated: Persian, Polish, Italian translations.
* Fixed: Duplicate date display on charts due to DST time change.

= 8.1.1 =
* Release Date: October 26, 2014
* Fixed: Bug in browscap.ini update code that could mis-identify all hits as robots.
* Fixed: Bug in the scheduled reports code that failed to process the report content correctly.
* Fixed: Bug in schedule reports that failed to select the current schedule in the drop down.
* Removed: Depricated variables from the report content description.

= 8.1 =
* Release Date: October 18, 2014
* Added: Detected browser information to the optimization page.
* Updated: Re-organized new browscap code to avoid PHP 5.2 or below throwing a parse error.
* Fixed: If the client sent no user agent string a fatal error would be generated, added additional logic to handle this case.
* Removed: Unused code in various log displays.

= 8.0 =
* Release Date: October 16, 2014
* Added: browscap.ini support for robot detection.
* Added: Statistics->Optimization->Database tab now how an option to re-run the install routine in case you have had to delete tables from the database.
* Added: PHP version check, WP Statistics now requires PHP 5.3 and will no longer execute without it.
* Added: Dashboard widget.
* Updated: Top pages now decode the URL for better readability.
* Updated: GeoIP library from version 0.5 to 2.0.
* Updated: User Agent detection code.
* Updated: Serbian, Polish translations.
* Updated: All missing language strings have been machine translated when possible.
* Updated: IP hashing code has moved out of beta.
* Fixed: Incorrect country name being displayed for Georgia.
* Fixed: Bug in detecting the new index in the Statistics->Optimization->Database tab.
* Fixed: Duplicate closing tag in summary page.
* Fixed: Purging the database did not display the results.
* Removed: Support for old format substitution codes in the statistics reports, upgrade now converts them to short codes.

= 7.4 =
* Release Date: September 19, 2014
* Added: Link URL for referred.
* Updated: Widget code now adhears to WordPress standards.
* Updated: Persian, Arabic and German (thanks Mike) translations.
* Updated: Unique index on visitors table now takes in to account the agent/platform/version information.
* Updated: Line charts now redraw when the legend is clicked to add/remove a line.
* Fixed: Dates on charts with large number of data points now no longer overwrite each other.
* Fixed: Admin bar menu item would use the incorrect admin URL in some circumstances.
* Removed: Screenshots are no longer included in the distribution.

= 7.3 =
* Release Date: September 8, 2014
* Added: Option to delete the admin manual.
* Added: Option to force the robots list to be updated during an upgrade.
* Added: Beta code for not storing IP addresses in the database.
* Fixed: Bug with new JQVMap code not displaying flags correctly.
* Updated: French (fr_FR) language, thanks apeedn.
* Updated: Visitors online code now treats different browsers/platforms from the same IP address as different users (this helps with multiple users behind proxy servers).
* Updated: Visitors code now treats different browsers/platforms from the same IP address as different users (this helps with multiple users behind proxy servers).
* Updated: Persian (fa_IR) language.
* Updated: Tested with WordPress 4.0.

= 7.2 =
* Release Date: August 22, 2014
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
* Release Date: August 13, 2014
* Added: clearch.org search provider, disabled by default.
* Added: Database tab to optimization page to manually add unique index on the visitors table removed in 7.0.3.
* Updated: Additional WP_DEBUG message fixes.
* Updated: Overview widgets no longer overflows on smaller displays.
* Updated: Charts now properly resize when the browser window does.

= 7.0.4 =
* Release Date: August 9, 2014
* Fixed: Typo in table definition of visitor table's UAString field.

= 7.0.3 =
* Release Date: August 8, 2014
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
* Release Date: August 7, 2014
* Fixed: Database prefix not being used when creating/updating tables correctly.
* Fixed: New installs caused an error in the new upgrade code as the visitor table did not exist yet.
* Fixed: Replaced use of deprecated $table_prefix global during install/update.

= 7.0.1 =
* Release Date: August 5, 2014
* Fixed: Error during new installations due to $wpdb object not being available.

= 7.0 =
* Release Date: August 5, 2014
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
* Release Date: June 29, 2014
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
* Release Date: June 11, 2014
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
* Release Date: May 31, 2014
* Fixed: GeoIP dependency code to ignore safe mode check in PHP 5.4 or newer.
* Fixed: GeoIP dependency code to properly detect safe mode with PHP 5.3 or older.
* Fixed: Browser information not recorded if GeoIP was not enabled.
* Updated: get_IP code to better handle malformed IP addresses.
* Updated: Persian (fa_IR) language.
* Updated: Arabic (ar) language.
* Updated: Chinese (zh_CN) language.

= 5.3 =
* Release Date: April 17, 2014
* Added: New robot's to the robots list: BOT for JCE, Leikibot, LoadTimeBot, NerdyBot, niki-bot, PagesInventory, sees.co, SurveyBot, trendictionbot, Twitterbot, Wotbox, ZemlyaCrawl
* Added: Check for PHP's Safe Mode as the GeoIP code does not function with it enabled.
* Added: Option to disable administrative notices of inactive features.
* Added: Option to export column names as first line of export files.
* Added: Options to disable search engines from being collected/displayed.
* Updated: French (fr_FR) language translation.
* Fixed: Download of the GeoIP database could cause a fatal error message at the end of a page if it was triggered outside the admin area.

= 5.2 =
* Release Date: March 10, 2014
* Added: Additional checks for BC Math and cURL which are required for the GeoIP code.
* Updated: GeoIP database handling if it is missing or invalid.
* Updated: GeoIP database is now stored in uploads/wp-statistics directory so it does not get overwritten during upgrades. 
* Fixed: Typo's in the shortcode codes (thanks 	g33kg0dd3ss).
* Updated: Polish (pl_PL) language.

= 5.1 =
* Release Date: March 3, 2014
* Fixes: Small bug in referral url.
* Fixes: Problem export table.
* Updated: Arabic (ar) language.

= 5.0 =
* Release Date: March 2, 2014
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
* Release Date: February 4, 2014
* Fixes: Small bug in the `Current_Date`.
* Fixes: Small bug in the `exclusions.php` file.
* Updated: Polish (pl_PL) language.

= 4.8 =
* Release Date: February 4, 2014
* Added: Converting Gregorian date to Persian When enabled [wp-parsidate](http://wordpress.org/plugins/wp-parsidate/) plugin.
* Added: New feature, option to record the number and type of excluded hits to your site.
* Added: New exclusion types for login and admin pages.
* Fixes: GeoIP populate code now REALLY functions again.
* Updated: Arabic (ar) language.
* Updated: Polish (pl_PL) language.

= 4.7 =
* Release Date: February 2, 2014
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
* Release Date: January 24, 2014
* Fixes: a Small bug in to get rid of one of the reported warnings from debug mode.

= 4.6 =
* Release Date: January 20, 2014
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
* Release Date: January 18, 2014
* Added: Support for more search engines: DuckDuckGo, Baidu and Yandex.
* Added: Support for Google local sites like google.ca, google.fr, etc.
* Added: Anchor links in the optimization and settings page to the main sections.
* Added: Icon for Opera Next.
* Updated: Added new bot match strings: 'archive.org_bot', 'meanpathbot', 'moreover', 'spbot'.
* Updated: Replaced bot match string 'ezooms.bot' with 'ezooms'.
* Updated: Overview summary statistics layout.
* Fixes: Bug in widget code that didn't allow you to edit the settings after adding the widget to your site.

= 4.4 =
* Release Date: January 16, 2014
* Added: option to set the required capability level to view statistics in the admin interface.
* Added: option to set the required capability level to manage statistics in the admin interface.
* Fixes: 'See More' links on the overview page now update highlight the current page in the admin menu instead of the overview page. 
* Added: Schedule downloads of the GeoIP database.
* Added: Auto populate missing GeoIP information after a download of the GeoIP database.
* Fixes: Unschedule of report event if reporting is disabled.

= 4.3.1 =
* Release Date: January 13, 2014
* Fixes: Critical bug that caused only a single visitor to be recorded.
* Added: Version information to the optimization page.
[Thanks Greg Ross](http://profiles.wordpress.org/gregross)

= 4.3 =
* Release Date: January 12, 2014
* Added: Definable robots list to exclude based upon the user agent string from the client.
* Added: IP address and subnet exclusion support.
* Added: Client IP and user agent information to the optimization page.
* Added: Support to exclude users from data collection based on their WordPress role.
* Fixes: A bug when the GeoIP code was disabled with optimization page.

= 4.2 =
* Release Date: December 31, 2013
* Added: Statistical menus.
* Fixes: Small bug in the geoip version.
* Language: Serbian (sr_RS) was updated.
* Language: German (de_DE) was updated.
* Language: French (fr_FR) was updated.

= 4.1 =
* Release Date: December 23, 2013
* Language: Arabic (ar) was updated
* Fixes: small bug in moved the GeoIP database.
* Updated: update to the spiders list.

= 4.0 =
* Release Date: December 21, 2013
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
* Release Date: August 7, 2013
* Added: Optimization plugin page.
* Added: Export data to excel, xml, csv and tsv files.
* Added: Delete table data.
* Added: Show memory usage in optimization page.
* Language: Polish (pl_PL) was updated.
* Language: updated.

= 3.1.4 =
* Release Date: July 18, 2013
* Added: Chart Type in the settings plugin.
* Added: Search Engine referrer chart in the view stats page.
* Added: Search Engine stats in Summary Statistics.
* Optimized: 'wp_statistics_searchengine()' and add second parameter in the function.
* Language: Chinese (China) was added.
* Language: Russian was updated.
* Language: updated.

= 3.1.3 =
* Release Date: June 9, 2013
* Optimized: View statistics.
* Added: Chinese (Taiwan) language.

= 3.1.2 =
* Release Date: June 4, 2013
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
* Release Date: April 11, 2013
* Bug Fix: Security problem. (Thanks Mohammad Teimori) for report bug.
* Optimized: Statistics screen in resolution 1024x768.
* Language: Persian was updated.

= 3.1.0 =
* Release Date: April 3, 2013
* Bug Fix: Statistics Menu bar.
* Bug Fix: Referral link of the last visitors.
* Added: Latest all search words with full details.
* Added: Recent all visitors with full details.
* Optimized: View statistics.
* Language: updated.
* Language: Arabic was updated.
* Remove: IP Information in setting page.

= 3.0.2 =
* Release Date: February 5, 2013
* Added: Hungarian language.
* Added: Insert value in useronline table by Primary_Values function.
* Added: Opera browser in get_UserAgent function.
* Added: prefix wps_ in options.
* Added: Notices to enable or disable the plugin.
* Changed: Statistics class to WP_Statistics because Resemblance name.

= 3.0.1 =
* Release Date: February 3, 2013
* Bug Fix: Table plugin problem.

= 3.0 =
* Release Date: February 3, 2013
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
* Release Date: December 18, 2012
* Serbian language was solved.
* Server variables were optimized by m.emami.
* Turkish translation was complete.

= 2.3.2 =
* Release Date: October 24, 2012
* Added Indonesia language.
* Turkish language file corrected by MBOZ.

= 2.3.1 =
* Release Date: October 12, 2012
* Added Polish language.
* Added Support forum link in menu.
* Fix problem error in delete plugin.

= 2.3.0 =
* Release Date: Not released
* Added Serbian language.

= 2.2.9 =
* Release Date: September 20, 2012
* Added Bengali language.

= 2.2.8 =
* Release Date: July 27, 2012
* Added Russian language.
* Fix problem in count views.
* Added more filter for check spider.
* Optimize plugin.

= 2.2.7 =
* Release Date: May 20, 2012
* Fix problem in widget class.
* Redundancy in Arabic translation.
* Fix problem in [countposts] shortcode.
* Optimized Style Reports.

= 2.2.6 =
* Release Date: April 19, 2012
* Fix a small problem.

= 2.2.5 =
* Release Date: April 18, 2012
* The security problem was solved. Please be sure to update!
* Redundancy in French translation.
* Add CSS Class for the containing widget. (Thanks Luai Mohammed).
* Add daily or total search engines in setting page.
* Using wordpress jQuery in setting page.

= 2.2.4 =
* Release Date: March 12, 2012
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
* Release Date: February 3, 2012
* Optimized Counting.
* Added Arabic language.
* Draging problem was solved in Widgets
* css problem was solved in sidebar

= 2.2.2 =
* Release Date: January 11, 2012
* Solving show functions in setting page.
* Solving month visit in widget.
* Added Spanish language.

= 2.2.1 =
* Release Date: December 27, 2011
* Solving drap uploader problem in media-new.php.

= 2.2.0 =
* Release Date: December 26, 2011
* Added statistics to admin bar wordpress 3.3.
* Added Uninstall for remove data and table from database.
* Added all statistics item in widget and Their choice.
* Optimize show function code in setting page.
* Calling jQuery in wordpress admin for plugin.
* Remove the word "disabled" in the statistics When the plugin was disabled.
* Solving scroll problem in statistics page.

= 2.1.6 =
* Release Date: October 21, 2011
* Added Russian language.

= 2.1.5 =
* Release Date: October 29, 2011
* Added French language.
* Rounds a float Averages.

= 2.1.4 =
* Release Date: October 21, 2011
* Added Romanian language.

= 2.1.3 =
* Release Date: October 14, 2011
* Active plugin in setting page was solved.

= 2.1.2 =
* Release Date: October 12, 2011
* Added default language file.
* Added Portuguese language.

= 2.1.1 =
* Release Date: September 27, 2011
* Complete files

= 2.1 =
* Release Date: September 25, 2011
* Edit string

= 2.0 =
* Release Date: September 20, 2011
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
* Release Date: March 20, 2011
* Start plugin