=== Ad Integration ===
Contributors: mucenica.bogdan, thaslayer
Donate link:  https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=lebtamas%40yahoo%2ecom&item_name=ThaSlayer%27s%20plugins&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8
Tags: ads,adsense,monetization,advertisements,post,posts,google
Requires at least: 2.2
Tested up to: 2.6.1
Stable tag: 1.1

The plugin’s purpose is to integrate ads in your posts. You define in what position should the ads show up. You can add multiple ads to your posts.

== Description ==

Plugin Usage

1. Locating the plugin in the Admin Panel
2. Adding a new ad
3. Editing an ad
4. Deleting an ad
5. Plugin options settings


1 Locating the plugin in the Admin Panel
	
The plugin creates "Slayer's Ad Integration" menu item which is visible anywhere in your dashboard
The plugin's options panel is divided to 2 sections "ads" & "options";

1.1 "Add ad" Subpage

* "Ad name" = the name of your ad. It isn't publicly displayed anywhere, it's just so that you can make the difference between the many ads you will ad.
* "Ad HTML Code" = your ad's html code(Google Adsense for example)
* "Use default HTML wrapper" = the plugin can conjure the ad in a custom HTML wrapper which can be defiened in the options section. If you don't know what this is just leave it on default.
* "Max repeat count on same page" = This value defines how many times the ads will appear on the same page. The higher teh value the more times the ads will appear on the page(for example a category page)
* "Ad position" = The position of the ad inside the post.
	
2 Adding a new Ad

In ads section simply locate the "Add Ad" button and define the ad's title and code. Advanced users: You can define your own HTML wrapper.
	
3 Editing an Ad

In the "Ads" Section locate your ad and click the "Edit" button.

"Edit ad" subpage (advanced  ad options)

* "Load type" = The way the ad is insterted in the posts.
* auto: the ad will be automatically inserted in the posts
* manual: the ad will be shown only in the posts in which you add"<!--slayer_Ad_Integration_[AD_ID]-->" .There's no limit on the number of ads  you insert in a post.
* "Public" = you can set an ad to be visible by your readers or not. This feature is great if you don't want to delete an ad for later usage.
	
	
4 Deleting an Ad

In the "Ads" Section locate your ad and click the "Delete" button. Remember that this is undoable.
	
	
5 Plugin options settings

Locate the "options" section at the plugin

* "Default HTML Before Ad" & "Default HTML After Ad" define the wrapper for each ad. You can owerwrite this by selecting "Default html wrapper"
* "Custom CSS" gives you the possibility to add css styling to your ad.
* "Max ad count per page"  This value defines how many times the ads will appear on the same page. The higher the value the more times the ads will appear on the page(for example a category page). This doesn't apply to manual ad inclusion.


== Installation ==

1. upload the slayers-ad-integration directory to wp-content/plugins
2. activate the plugin (dashboard -> plugins -> find "Ad Integration" -> click the activate button
3. eat a cookie
4. drink some milk
5. you are done, now go enjoy the plugin.

== Frequently Asked Questions ==

= Can i use google adsense? =

Yes. Just make sure to set the limit to 3 ads per page for that particular ad.

== Screenshots == 
1. Adding A New Ad
2. Editing an Ad(advanced options)
3. DOnate Section
4. Main Ads Display
5. Options Section
