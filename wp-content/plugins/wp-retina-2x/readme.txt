=== Perfect Images (Replace Media • Generate Thumbnails • Image Sizes • Optimize • HighDPI) ===
Contributors: TigrouMeow
Tags: retina, images, replace, size, thumbnail, regenerate, sizes, high-dpi
Donate link: https://meowapps.com/donation/
Requires at least: 5.0
Tested up to: 6.1
Requires PHP: 7.3
Stable tag: 6.4.1

Optimize and manage your images with Perfect Images. Easily replace or regenerate existing images in bulk, set custom sizes, improve performance, create retina versions, and more. Achieve perfect images for your site with ease.

== Description ==

Take control of your images with Perfect Images! This powerful plugin helps you optimize and manage your images with ease. Easily replace or regenerate existing images in bulk, set custom sizes, improve performance, and create retina versions for high-quality displays. Plus, with features like CDN support and the ability to disable the image threshold, you can fine-tune your image management to suit your specific needs. Perfect Images is fast, does not create any new tables in your database, and is fully compatible with other plugins.

Here's a closer look at the main features of Perfect Images:

* Manage Image Sizes
* Replace Image & Media
* Regenerate Thumbnails
* Retina Images / HighDPI
* CDN (with Image Optimization by EWWW)
* Disable Image Threshold

Originally designed to handle retina images, Perfect Images has evolved to become a must-have tool for any WordPress site.

=== Manage Image Sizes ===
With this feature, you can easily disable any unnecessary sizes and keep track of the sizes created for each of your media entries. This allows you to streamline your image management and get rid of any unnecessary sizes that may be taking up space on your site. For example, you can disable the medium_large, 1536x1536, and 2048x2048 sizes that WordPress automatically creates, which are often unnecessary.

=== Replace Image & Media ===
This convenient tool allows you to quickly swap out an image for a new one, all from within the plugin's dedicated dashboard, or directly from the Media Library or Edit Attachment pages. Say goodbye to the hassle of manually replacing images and streamline your media management.

=== Regenerate Thumbnails ===
This feature allows you to update your thumbnails en masse, with a convenient progress bar to keep you informed of the process. Plus, Perfect Images handles all the details, including regenerating your retina images and updating your media metadata as needed.

=== Retina Images / HighDPI ===
Make your website look stunning on high-DPI devices with Perfect Images. This plugin automatically generates and serves beautiful, crisp retina images to your visitors, ensuring that your site looks great on every device. Plus, with the option to manually generate retina images and the unique feature of creating retina images for full-size images, you'll have everything you need to make your website stand out. Visit the official website for more information and tutorials on how to get the most out of this feature.

=== Disable Image Threshold ===
This plugin gives you the ability to disable WordPress' automatic image scaling feature, which sometimes results in files with "-scaled" at the end of their filenames.

=== Pro Version ===
The Pro version adds support for Retina for full-size, support for lazy-loading for your responsive images and various options. And it supports my work :)

= Quickstart =

1. Set your option (for instance, you probably don't need retina images for every sizes set-up in your WP).
2. Generate the retina images (required only the first time, then images are generated automatically).
3. Check if it works! - if it doesn't, read the FAQ, the tutorial, and check the forums.

== Changelog ==

= 6.4.1 (2023/04/16) =
* Update: Common libs updated, should be less issues with updates.
* Info: If you enjoy this plugin, please share some love by [writing a little review here](https://wordpress.org/support/plugin/wp-retina-2x/reviews/?rate=5#new-post). And since I read them all, don't hesitate to drop a few remarks and feature requests in those reviews. Thank you :)

= 6.4.0 (2023/02/03) =
* Fix: Replace wasn't working fine.

= 6.3.9 (2023/01/06) =
* Fix: Better handling of the image replacement.

= 6.3.8 (2022/12/09) =
* Update: Still going towards a better UI organization.

= 6.3.2 (2022/11/01) =
* Update: Better organization of the UI. This is just the first step, this plugin is going to improve a lot, with a cleaner UI, and everything will be modular (so you can disable what you don't need completely).

= 6.3.1 (2022/10/19) =
* Fix: There was an issue when the options are re-initialized and the sizes were not refreshed.

= 6.3.0 (2022/10/12) =
* Update: Enhanced way to handle options.

= 6.2.9 (2022/08/11) =
* Fix: Escape more HTML.
* Fix: Ignored entries were reset by the issues calculation.

= 6.2.8 (2022/06/16) =
* Fix: Security fix.
* Update: Remove all the notifications as they probably don't needed anymore.

= 6.2.4 (2022/04/14) =
* Fix: The Refresh Stats button should not reset the list of ignored entries.

= 6.2.3 (2022/03/19) =
* Update: Latest version of the framework and admin.

= 6.2.2 (2022/01/28) =
* Update: Better compatibility with latest version of WP.
* Fix: There was an useless error message about a modal.

= 6.2.1 (2021/12/07) =
* Fix: Avoid displaying the PHP Info logo in the Meow Apps Dashboard.
* Update: Composer version.

= 6.2.0 (2021/11/10) =
* Fix: Hide the Dashboard button in the header if the hide dashboard option is checked.

= 6.1.9 (2021/10/12) =
* Fix: Removed a JS issue which was showing an alert for no reason.

= 6.1.8 (2021/09/23) =
* Update: Common libs 3.6.

= 6.1.7 (2021/09/17) =
* Fix: Was trying to add a Retina image in the srcset even if it was non-existent (when used with a CDN).
* Update: Better sanitization in the common library.

= 6.1.6 (2021/08/31) =
* Update: Enhanced security.

= 6.1.5 (2021/08/31) =
* Update: New common library.
* Update: Better security (but we will add even enhanced it more in the next update).
* Update: Tiny UI enhancements.

= 6.1.4 (2021/07/06) =
* Update: Lot of enhancements in the UI.

= 6.1.3 (2021/04/29) =
* Fix: Little issue with some network sites.
* Fix: Now use the default jpeg_quality set in WP.
* Fix: The "Build Automatically" feature is now available even if no Retina Method is used.

= 6.1.2 =
* Fix: Avoid double slashes in the URLs of the scripts.
* Fix: Updated admin, which works better with PHP Error Logs.
* Add: Better paging.

= 6.1.1 =
* Annoucement: Partnership with Easy IO! Probably the best deal on the market to optimize your images :)
* Fix: Some variables should be initialized as arrays instead of booleans.
* Fix: The CDN domain could not be modifed.

= 6.1.0 =
* Fix: PictureFill was not being ran, the Responsive Images method was instead.

= 6.0.8 =
* Fix: Avoid crashing the Retina Dashboard when there are no Retina images at all.

= 6.0.7 =
* Update: Much better dashboard.
* Fix: Upload New Retina Image.
* Add: Dashboard search.
* Add: Ignore button.
* Update: Upload in directly in the dashboard.

= 6.0.5 =
* Add: Implementation of Easy IO (CDN + Image Optimization).
* Add: Versioning for images, when they are replaced (that helps CDNs to refresh themselves).

= 6.0.4 =
* Fix: The dashboard was crashing when a non-image was being shown.
* Update: Removed the unused code from the plugin.
* Update: Optimized the way data is loaded in the dashboard. 

= 6.0.3 =
* Fix: The API wasn't accessible anymore.
* Fix: Lazysizes was only working with PictureFill.
* Fix: Avoid the JS of common admin to load more than once.

= 6.0.2 =
* Update: A lot of new features: Image Sizes Management, Disable Image Threshold, Regenerate Thumbnails, Replace Images.
* Update: Completely new UI for the Dashboard and the Settings.

= 5.6.1 =
* Update: Lazysize from 5.1.1 to 5.2.2.
* Update: PHP Simple Dom updated to 1.9.1.

= 5.6.0 =
* Add: Option to remove the image size threshold (which is set to 2560 since WordPress 5.3). 

= 5.5.7 =
* Fix: Background CSS wasn't working properly in a few cases.
* Update: Lazysizes updated to 5.1.1 (from 5.0.0).
* Update: Parser optimized.

= 5.5.6 =
* Update: Lazysizes updated to 5.1.0 (from 4.0.4).

= 5.5.5 =
* Fix: Display Full-Size Retina uploader only if the option is active.

= 5.5.4 =
* Add: Filter for cropping plugins.

= 5.5.3 =
* Fix: Usage of Composer.
* Update: If available, will use the Full-Size Retina for generating Retina thumbnails.
* Fix: New version of HtmlDomParser.
* Update: New dashboard.

= 5.5.1 =
* Fix: Uploading a PNG as a Retina was turning its transparency into black.
* Fix: Now LazyLoad used with Keep SRC only loads one image, the right one (instead of two before). Thanks to Shane Bishop, the creator of EWWW (https://wordpress.org/plugins/ewww-image-optimizer/).

= 5.4.3 =
* Add: New hooks: wr2x_before_regenerate, wr2x_before_generate_thumbnails, wr2x_generate_thumbnails, wr2x_regenerate and wr2x_upload_retina.
* Fix: Issues where happening with a few themes (actually the pagebuilder they use) after the last update.
* Update: Lazysizes 4.0.4.

= 5.4.1 =
* Fix: Issues where happening with a few themes (actually the pagebuilder they use) after the last update.
* Update: Lazysizes 4.0.4.

= 5.4.0 =
* Update: Removed annoying message that could appear by mistake in the admin.
* Add: Direct upload of Retina for Full-Size (for Pro).

= 5.2.9 =
* Add: New option to Regenerate Thumbnails.
* Fix: Tiny CSS fix, and update fix.
* Important: A few options will be removed in the near future. Have a look at this: https://wordpress.org/support/topic/simplifying-wp-retina-2x-by-removing-options/.

= 5.2.8 =
* Fix: Security update.
* Update: Lazysizes 4.0.3.

= 5.2.6 =
* Fix: Avoid re-generating non-retina thumbnails when Generate is used.
* Fix: Use ___DIR___ to include plugin's files.
* Fix: Better explanation.

= 5.2.3 =
* Fix: Sanitization to avoid cross-site scripting.
* Fix: Additional security fixes.

= 5.2.0 =
* Fix: When metadata is broken, displays a message.
* Fix: A few icons weren't displayed nicely.
* Fix: When metadata is broken, displays a message.
* Update: From Lazysizes 3.0 to 4.0.1.
* Add: Option for forcing SSL Verify.

= 5.1.4 =
* Add: wr2x_retina_extension, wr2x_delete_attachment, wr2x_get_pathinfo_from_image_src, wr2x_picture_rewrite in the API.

= 5.0.5 =
* Fix: There was a issue with the .htaccess rewriting (Class ‘Meow_Admin’ not found).
* Update: Core was totally re-organized and cleaned. Ready for nice updates.
* Update: LazyLoading from version 2.0 to 3.0.
* Info: There will be an important warning showing up during this update. It is an important annoucement.

= 4.8.0 =
* Add: Retina Image Quality for JPG (between 0 and 100). I know this little setting was really wanted :)
* Fix: Disabled sizes weren't really disabled in the UI.
* Fix: Notices about Ignore appearing in other screens.
* Add: Handles incompatibility with JetPack's Photon.

= 4.7.7 =
* Add: The Generate button (and the bulk Generate) will now also Re-Generate the thumbnails as well (like the Renerate Thumbnails plugin). If you are interested in a option to disable this behavior, please say so in the WP forums.

= 4.7.6 =
* Fix: Issue with Pro being non-Pro outside of WP Admin.
* Fix: Retina debugging file was not being created properly.

= 4.7.5 =
* Fix: Don't delete the full-size Retina if we re-generate.
* Fix: Little issue with Ignore.
* Update: Additional debugging.
* Info: Please write a review for the plugin if you are happy with it. I am trying my best to make this plugin to work with every kind of WP install and system :)

= 4.7.4 =
* Update: Retina was moved into a new Meow Apps menu. The whole Meow Apps menu can be then hidden. For a nicer WP admin. The whole admin UI was updated.
* Add: New PictureFill option: inline CSS background can be now replaced by Retina images (excellent for sliders for example).
* Add: Over HTTP Check option: check for retina image remotely, for example if you are using images from a different website or server, it will check for the Retina version. Works with the PictureFill method.
* Change: Mobile detection was completely turned off as I don't think it should be used, but let's see if some of yours still need it. Ideally I would like to remove it from the code.
* Fix: Check if the CDN is already present before modifying/adding.

= 4.6.0 =
* Fix: Button Details was not working properly.
* Fix: Removed the beta Retina Uploader which is not working yet (was included by mistake).
* Update: Added the info screen available in the Retina Dashboard in the Media Library as well and improved the UI a tiny bit (it was a bit messy if you had a lot of image sizes.)

= 4.5.8 =
* Update: LazyLoad 2.0.3
* Fix: Don't display Retina information for a media that is not an image.
* Update: Retina.js 2.0.0
* Fix: Drag & Drop upload was a bit buggy, it now has been improved a lot!
* Add: Option to hide the ads, flatter and message about the Pro.
* Update: Options styles.

= 4.4.6 =
* Update: LazyLoad 1.5
* Update: Retina.js 1.4
* Update: PictureFill JS 3.0.2
* Fix: LazyLoad was not playing well when WordPress creates the src-set by itself.
* Fix: Get the right max-upload size when using HHVM.
* Fix: Displays an error in the dashboard when the server-side fails to process uploads.
* Update: During bulk, doesn't stop in case of errors anymore but display an errors counter.
* Update: Ignore Responsive Images support if the media ID is not existent (in case of broken HTML).

= 4.4.0 =
* Info: Please read my blog post about WP 4.4 + Retina on https://meowapps.com/wordpress-4-4-retina/.
* Add: New "Responsive Images" method.
* Add: Lot more information is available in the Retina settings, to help the newbies :)
* Update: Headers are compliant to WP 4.4.
* Update: Dashboard has been revamped for Pro users. Standard users can still use Bulk functions.
* Update: Support for WP 4.4.

= 3.5.2 =
* Fix: Search string not null but empty induces error.
* Change: User Agent used for Pro authentication.
* Fix: Issues with class containing trailing spaces. Fixed in in SimpleHTMLDOM.
* Fix: Used to show weird numbers when using 9999 as width or height.
* Add: Filter and default filter to avoid certain IMG SRC to be checked/parsed by the plugin while rendering.

= 3.4.2 =
* Fix: Full-Size Retina wasn't removed when the original file was deleted from WP.
* Fix: Images set up with a 0x0 size must be skipped.
* Fix: There was an issue if the class starts with a space (broken HTML), plugin automatically fix it on the fly.
* Fix: Full-Size image had the wrong path in the Details screen.
* Fix: Option Auto Generate was wrongly show unchecked even though it is active by default.
* Update: Moved the filters to allow developers to use files hosted on another server.
* Update: Translation strings. If you want to translate the plugin in your language, please contact me :)

= 3.3.6 =
* Fix: There was an issue with local path for a few installs.
* Add: Introduced $wr2x_extra_debug for extra developer debug (might be handy).
* Fix: Issues with retina images outside the uploads directory.
* Add: Custom CDN Domain support (check the "Custom CDN Domain" option).
* Fix: Removed a console.log that was forgotten ;)
* Change: different way of getting the temporary folder to write files (might help in a few cases).

= 3.1.0 =
* Add: Lazy-loading option for PictureFill.
* Fix: For the Pro users having the IXR_client error.
* Fix: Plugin now works even behind a proxy.
* Fix: Little UI bug while uploading a new image.
* Add: In the dashboard, added tooltips showing the sizes of the little squares on hover.
* Fix: The plugin was not compatible with Polylang, now it works.

= 3.0.0 =
* Add: Link to logs from the dashboard (if logs are available), and possibility to clear it directly.
* Add: Replace the Full-Size directly by drag & drop in the box.
* Add: Support for WPML Media.
* Change: Picturefill script to 'v2.2.0 - 2014-02-03'.
* Change: Enhanced logs (in debug mode), much easier to read.
* Change: Dashboard enhanced, more clear, possibility of having many image sizes on the screen.
* Fix: Better handing of non-image media and image detection.
* Fix: Rounding issues always been present, they are now fixed with an 2px error margin.
* Fix: Warnings and issues in case of broken metadata and images.
* Add: (PRO) New pop-up screen with detailed information.
* Add: (PRO) Added Retina for Full-Size with upload feature. Please note that Full-Size Retina also works with the normal version but you will have to manually resize and upload them.
* Add: (PRO) Option to avoid removing img's src when using PictureFill.
* Info: The serial for the Pro version can be bought at https://meowapps.com/wp-retina-2x. Thanks for all your support, the plugin is going to be 3 years old this year! :)

= 2.6.0 =
* Add: Support Manual Image Crop, resize the @2x as the user manually cropped them (that's cool!).
* Change: Name will change little by little to WP Retina X and menus simplified to simply "Retina".
* Change: Simplification of the dashboard (more is coming).
* Change: PictureFill updated to 'v2.2.0 - 2014-12-19'.
* Fix: Issue with the upload directory on some installs.
* Info: Way more is coming soon to the dashboard, thanks for your patience :)
* Info: Manual Image Crop received a Pull Request from me to support the Retina cropping but it is not part of their current version yet (1.07). For a version of Manual Image Crop that includes this change, you can use my forked version: https://github.com/tigroumeow/wp-manual-image-crop.

= 1.6.0 =
* Add: HTML srcset method.

= 1.0.0 =
* Change: enhancement of the Retina Dashboard.
* Change: better management of the 'issues'.
* Change: handle images with technical problems.
* Fix: random little fixes again.
* Change: upload is now HTML5, by drag and drop in the Retina Dashboard!

= 0.9.4 =
* Fix: esthetical issue related to the icons in the Retina dashboard.
* Fix: warnings when uploading/replacing an image file.
* Change: Media Replace is not used anymore, the code has been embedded in the plugin directly.
* Update: to the new version of Retina.js (client-method).
* Fix: updated rewrite-rule (server-method) that works with multi-site.
* Fix: support for Network install (multi-site). Thanks to Jeremy (Retina-Images).

= 0.3.0 =
* Fix: was not generating the images properly on multisite WordPress installs.
* Add: warning message if using the server-side method without the pretty permalinks.
* Add: warning message if using the server-side method on a multisite WordPress install.
* Change: the client-method (retina.js) is now used by default.
* Fix: simplified version of the .htaccess directive.
* Fix: new version of the client-side method (Retina.js), works 100x faster.
* Fix: SQL optimization & memory usage huge improvement.

= 0.2.2 =
* Fix: the recommended resolution shown wasn't the most adequate one.
* Fix: in a few cases, the .htaccess wasn't properly generated.
* Fix: files were renamed to avoid conflicts.
* Add: paging for the Retina Dashboard.
* Add: 'Generate for all files' handles and shows if there are errors.
* Add: the Retina Dashboard.
* Add: can now generate Retina files in bulk.
* Fix: the cropped images were not 'cropped'.
* Add: The Retina Dashboard and the Media Library's column can be disabled via the settings.
* Fix: resolved more PHP warning and notices.

= 0.1 =
* Very first release.

== Installation ==

Quick and easy installation:

1. Upload the folder `wp-retina-2x` to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Check the settings of WP Retina 2x in the WordPress administration screen.
4. Check the Retina Dashboard.
6. Read the tutorial about the plugin: <a href='https://meowapps.com/wp-retina-2x/tutorial/'>WP Retina 2x Tutorial</a>.

== Frequently Asked Questions ==

Users, you will find the FAQ here: https://meowapps.com/wp-retina-2x/faq/.

Developers, WP Retina 2x has a little API. Here are a few filters and actions you might want to use.

= Functions =
* wr2x_get_retina_from_url( $url ): return the URL of the retina image (empty string if not found)
* wr2x_get_retina( $syspath ): return the system path of the retina image (null if not found)

= Actions =
* wr2x_retina_file_added: called when a new retina file is created, 1st argument is $attachment_id (of the media) and second is the $retina_filepath
* wr2x_retina_file_removed: called when a new retina file is removed, 1st argument is $attachment_id (of the media) and second is the $retina_filepath

= Filters =
* wr2x_img_url: you can check and potentially override the $wr2x_img_url (normal/original image from the src) that will be used in the srcset for 1x
* wr2x_img_retina_url: you can check and potentially override the $wr2x_img_retina_url (retina image) that will be used in the srcset for 2x
* wr2x_img_src: you can check and potentially override the $wr2x_img_src that will be used in the img's src (only used in Pro version)
* wr2x_validate_src: the img src is passed; return it if it is valid, return null if it should be skipped

== Upgrade Notice ==

None.

== Screenshots ==

1. Retina Dashboard
2. Basic Settings
3. Advanced Settings
