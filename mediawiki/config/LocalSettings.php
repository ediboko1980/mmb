<?php
# This file was automatically generated by the MediaWiki 1.27.0
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}

## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "WG_SITENAME";
$wgMetaNamespace = "WG_META_NAMESPACE";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";
$wgArticlePath = "$wgScriptPath/$1";

## The protocol and server name to use in fully-qualified URLs
$wgServer = "WG_PROTOCOL://WG_SERVER";

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgResourceBasePath/resources/assets/wiki.png";

## UPO means: this is also a user preference option

$wgEnableEmail = false;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "WG_EMERGENCY_CONTACT";
$wgPasswordSender = "WG_PASSWORD_SENDER";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype = "mysql";
$wgDBserver = "WG_DB_SERVER";
$wgDBname = "WG_DB_NAME";
$wgDBuser = "WG_DB_USER";
$wgDBpassword = "WG_DB_PASSWORD";

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=utf8";

# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;

## Shared memory settings
$wgMainCacheType = CACHE_ACCEL;
$wgMemCachedServers = [];

# The following line solves the problem in MediaWiki 1.27 related to 'Session Hijacking error'. See https://www.mediawiki.org/w/index.php?title=Topic:Rryvt2t2nz4tgha3&topic_showPostId=tcfquqvab1lubdcd#flow-post-tcfquqvab1lubdcd.
$wgSessionCacheType = CACHE_DB;

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = true;
#$wgUseImageMagick = true;
#$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = false;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "C.UTF-8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "en";

$wgSecretKey = "SECRET_KEY";

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "f70e1a3d6f025df6";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by/4.0/";
$wgRightsText = "Creative Commons Attribution";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['createaccount'] = ALLOW_ACCOUNT_CREATION;
$wgGroupPermissions['*']['edit'] = ALLOW_ACCOUNT_EDITING;

$wgGroupPermissions['*']['read'] = ALLOW_ANONYMOUS_READING;
$wgGroupPermissions['*']['edit'] = ALLOW_ANONYMOUS_EDITING;

# Permissions for the Translate extension
$wgGroupPermissions['user']['translate'] = true;
$wgGroupPermissions['user']['translate-messagereview'] = true;
$wgGroupPermissions['user']['pagetranslation'] = true;

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";
wfLoadSkin( 'vector' );

# End of automatically generated settings.
# Add more configuration options below.

if (getenv('PARSOID_HOST') && getenv('PARSOID_DOMAIN')) {
    wfLoadExtension( 'VisualEditor' );

    // Enable by default for everybody
    $wgDefaultUserOptions['visualeditor-enable'] = 1;

    // Optional: Set VisualEditor as the default for anonymous users
    // otherwise they will have to switch to VE
    // $wgDefaultUserOptions['visualeditor-editor'] = "visualeditor";

    // Don't allow users to disable it
    $wgHiddenPrefs[] = 'visualeditor-enable';

    // OPTIONAL: Enable VisualEditor's experimental code features
    #$wgDefaultUserOptions['visualeditor-enable-experimental'] = 1;

    $wgVirtualRestConfig['modules']['parsoid'] = array(
        // URL to the Parsoid instance
        'url' => getenv('PARSOID_HOST'),
        'domain' => getenv('PARSOID_DOMAIN'),
        #'prefix' => 'localhost'
    );
}

// This feature requires a non-locking session store. The default session store will not work and
// will cause deadlocks (connection timeouts from Parsoid) when trying to use this feature.
$wgSessionsInObjectCache = true;

// Forward users' Cookie: headers to Parsoid. Required for private wikis (login required to read).
// If the wiki is not private (i.e. $wgGroupPermissions['*']['read'] is true) this configuration
// variable will be ignored.
//
// WARNING: ONLY enable this on private wikis and ONLY IF you understand the SECURITY IMPLICATIONS
// of sending Cookie headers to Parsoid over HTTP. For security reasons, it is strongly recommended
// that $wgVirtualRestConfig['modules']['parsoid']['url'] be pointed to localhost if this setting is enabled.
$wgVirtualRestConfig['modules']['parsoid']['forwardCookies'] = true;

$wgMFDefaultSkinClass = 'SkinVector';

// Extensions
// Cannot use wfLoadExtension here since extension.json does not exist.
require "$IP/extensions/Translate/Translate.php";
require "$IP/extensions/Collection/Collection.php";

$wgCollectionFormats = array(
   'rl' => 'PDF',
);

$wgCollectionMWServeURL = "RENDER_SERVER";

$wgCollectionMWServeCredentials = "CREDENTIALS";

wfLoadExtension('Cite');
wfLoadExtension('MobileFrontend');
wfLoadExtension('SyntaxHighlight_GeSHi');
wfLoadExtension('UniversalLanguageSelector');
