<?php
# This file was automatically generated by the MediaWiki 1.19.7 installer. If you make manual changes, please keep track in case you need to recreate 
# them later.
#
# See includes/DefaultSettings.php for all configurable settings and their default values, but don't forget to make changes in _this_ file, not 
# there.
#
# Further documentation for configuration settings may be found at: http://www.mediawiki.org/wiki/Manual:Configuration_settings Protect against web 
# entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}
## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;
$wgSitename = "5327A";
## The URL base path to the directory containing the wiki; defaults for all runtime URL paths are based off of this. For more information on 
## customizing the URLs please see: http://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = ""; $wgScriptExtension = ".php"; $wgArticlePath = "/nb/$1";
## The protocol and server name to use in fully-qualified URLs
$wgServer = "http://5327a.dhsrobotics.com";
## The relative URL path to the skins directory
$wgStylePath = "$wgScriptPath/skins";
## The relative URL path to the logo.  Make sure you change this from the default, or else you'll overwrite your logo when you upgrade!
$wgLogo = "/skins/common/GaelForce.png";
## UPO means: this is also a user preference option
$wgEnableEmail = true; $wgEnableUserEmail = true; # UPO $wgEmergencyContact = "rikreddy@gmail.com"; $wgPasswordSender = "rikreddy@gmail.com"; 
$wgEnotifUserTalk = false; # UPO $wgEnotifWatchlist = false; # UPO $wgEmailAuthentication = true;
## Database settings
$wgDBtype = "mysql"; $wgDBserver = "localhost"; $wgDBname = "my_wiki"; $wgDBuser = "root"; $wgDBpassword = "gaelforce";
# MySQL specific settings
$wgDBprefix = "";
# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";
# Experimental charset support for MySQL 5.0.
$wgDBmysql5 = false;
## Shared memory settings
$wgMainCacheType = CACHE_NONE; $wgMemCachedServers = array();
## To enable image uploads, make sure the 'images' directory is writable, then set this to true:
$wgEnableUploads = true;
$wgGenerateThumbnailOnParse = false;
#$wgUseImageMagick = true; $wgImageMagickConvertCommand = "/usr/bin/convert";
# InstantCommons allows wiki to use images from http://commons.wikimedia.org
$wgUseInstantCommons = false;
## If you use ImageMagick (or any other shell command) on a Linux server, this will need to be set to the name of an available UTF-8 locale
$wgShellLocale = "en_US.utf8";
## If you want to use image uploads under safe mode, create the directories images/archive, images/thumb and images/temp, and make them all writable. 
## Then uncomment this, if it's not already uncommented:
#$wgHashedUploadDirectory = false;
## Set $wgCacheDirectory to a writable directory on the web server to make your wiki go slightly faster. The directory should not be publically 
## accessible from the web.
#$wgCacheDirectory = "$IP/cache";
# Site language code, should be one of the list in ./languages/Names.php
$wgLanguageCode = "en"; $wgSecretKey = "f7a34cf50861fc983dae25af8eded70b1ea5dc532c0dd985aeaad7565bbda8cf";
# Site upgrade key. Must be set to a string (default provided) to turn on the web installer while LocalSettings.php is in place
$wgUpgradeKey = "1c8edbba4532319b";
## Default skin: you can change the default skin. Use the internal symbolic names, ie 'standard', 'nostalgia', 'cologneblue', 'monobook', 'vector':
$wgDefaultSkin = "strapping";
## For attaching licensing metadata to pages, and displaying an appropriate copyright notice / icon. GNU Free Documentation License and Creative 
## Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright $wgRightsUrl = ""; $wgRightsText = ""; $wgRightsIcon = 
"";
# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";
# Query string length limit for ResourceLoader. You should only set this if your web server has a query string length limit (then set it to that 
# limit), or if you have suhosin.get.max_value_length set in php.ini (then set it to that value)
$wgResourceLoaderMaxQueryLength = -1;
# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['createaccount'] = false; 
$wgGroupPermissions['*']['edit'] = false; 
$wgGroupPermissions['*']['read'] = false;
$wgGroupPermissions['*']['create'] = false;
$wgRevokePermissions['Limited']['edit'] = true;
$wgRevokePermissions['Limited']['createpage'] = true;
$wgRevokePermissions['Limited']['delete'] = true;
$wgRevokePermissions['Limited']['move'] = true;
$wgRevokePermissions['Limited']['upload'] = true;
$wgRevokePermissions['Limited']['reupload'] = true;
$wgRevokePermissions['Limited']['movefile'] = true;
# Enabled Extensions. Most extensions are enabled by including the base extension file here but check specific extension documentation for more 
# details The following extensions were automatically enabled:
require_once( "$IP/extensions/WikiEditor/WikiEditor.php" );
require_once( "$IP/extensions/Validator/Validator.php" );
include_once( "$IP/extensions/SemanticMediaWiki/SemanticMediaWiki.php" );
include_once("$IP/extensions/SemanticForms/SemanticForms.php");
enableSemantics('ec2-50-18-24-120.us-west-1.compute.amazonaws.com');
# End of automatically generated settings. Add more configuration options below.

$wgAllowExternalImages = true;
$wgAllowImageTag = true;
$wgRawHtml = true;
$wgUseSiteJs = true;
require_once("$IP/extensions/WhitelistedNamespaces/WhitelistedNamespaces.php");
require_once( "$IP/skins/strapping/strapping.php" );
require_once( "$IP/extensions/ParserFunctions/ParserFunctions.php" );
require_once( "$IP/extensions/Arrays/Arrays.php" );
require_once "$IP/extensions/MagicNoCache/MagicNoCache.php";

// PAGES THAT PUBLIC CAN SEE:
 $wgWhitelistRead = array( "Main Page", "5327A:About");
//$wgWhitelistedNamespaces = array(NS_USER);

// optional: default is array( 'sysop' )
$wgUserMergeProtectedGroups = array( 'groupname' );

$wgExternalLinkTarget = '_blank';

$wgExtensionFunctions[] = 'globalMetaTags';

function globalMetaTags() {
	global $wgOut;
	$wgOut->addMeta( 'description','This is VEX Robotics team 5327A\'s amazing online engineering notebook!');
	$wgOut->addMeta('HandHeldFriendly','True');
	$wgOut->addMeta('MobileOptimized','320');
	$wgOut->addMeta('viewport','width=device-width,initial-scale=1.0');
}