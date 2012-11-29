<?php 
// OneFileCMS sample external config file.  v3.4.17
// For versions 3.3.15 and later.  (Updated $HASHWORD, removed $PASSWORD & $USE_HASH)
// (Versions prior to 3.3.06 used an .ini format)
//
// Basically, what follows is just a copy & paste of the OneFileCMS config section.


// CONFIGURABLE INFO ***********************************************************
$config_title = "OneFileCMS";

$USERNAME = "username";
$HASHWORD = "cff29a3b595b427ef8d01c089d368c7706a8c68ecc75d566642e313ee97ff659"; //"password"
//$HASHWORD = "cff29a3b595b427ef8d01c089d368c7706a8c68ecc75d566642e313ee97ff659"; //"password"
$SALT     = 'somerandomsalt';

//Name of optional external language file.  If file is not found, the built-in defaults will be used.
//$LANGUAGE_FILE = "OneFileCMS.LANG.EN.php";  //Path is relative to OneFileCMS.

$MAX_ATTEMPTS  = 3;   //Max failed login attempts before LOGIN_DELAY starts.
$LOGIN_DELAY   = 10;  //In seconds.
$MAX_IDLE_TIME = 600; //In seconds. 600 = 10 minutes.  Other PHP settings (like gc) may limit its max effective value.

$MAIN_WIDTH    = '800px'; //Width of main <div> defining page layout.          Can be px, pt, em, or %.  Assumes px otherwise.
$WIDE_VIEW_WIDTH = '97%'; //Width to set Edit page if [Wide View] is clicked.  Can be px, pt, em, or %.  Assumes px otherwise.
				
$MAX_IMG_W   = 800;  //Max width to display images. (main width is 800)
$MAX_IMG_H   = 1000; //Max height.  I don't know, it just looks reasonable.

$MAX_EDIT_SIZE = 150000;  // Edit gets flaky with large files in some browsers.  Trial and error your's.
$MAX_VIEW_SIZE = 1000000; // If file > $MAX_EDIT_SIZE, don't even view in OneFileCMS.
                          // The default max view size is completely arbitrary. Basically, it was 2am and seemed like a good idea at the time.

$UPLOAD_FIELDS = 6; //Number of upload fields on Upload File(s) page. Max value is ini_get('max_file_uploads').

$config_favicon   = "favicon.ico"; //Path is relative to root of website.
$config_excluded  = ""; //files to exclude from directory listings- CaSe sEnsiTive!

$config_etypes = "html,htm,xhtml,php,pl,css,js,txt,text,cfg,conf,ini,csv,svg,log,dtd,htaccess"; //Editable file types.
$config_stypes = "*"; // Shown types; only files of the given types should show up in the file-listing
	// Use $config_stypes exactly like $config_etypes (list of extensions separated by commas).
	// If $config_stypes is set to null - by intention or by error - only folders will be shown.
	// If $config_stypes is set to the *-wildcard (the default), all files will show up.
	// If $config_stypes is set to "html,htm" for example, only file with the extension "html" or "htm" will get listed.

$config_itypes = "jpg,gif,png,bmp,ico"; //image types to display on edit page.
// _ftypes & _fclass must have the same number of values. bin is default.
$config_ftypes = "bin,z,gz,7z,zip,jpg,gif,png,bmp,ico,svg,txt,cvs,css,php,pl ,ini,cfg,conf,log,asp,js ,htm,html,dtd,htaccess";
$config_fclass = "bin,z,z ,z ,z  ,img,img,img,img,img,svg,txt,txt,css,php,txt,txt,cfg,cfg ,txt,txt,txt,htm,htm ,txt,txt";

$EX = '<b>( ! )</b> '; //EXclaimation point "icon" Used in $message's

$SESSION_NAME = 'OFCMS'; //Name of session cookie. Change if using multiple copies of OneFileCMS.

$ACCESS_ROOT = ''; //Restrict access to a particular folder.  Leave empty for $WEB_ROOT (entire website).

//External config file, if there is one.  Any settings in the $config_file will supersede those above.
//$config_file = 'OFCMS_config.SAMPLE.php';  // Path is relative to OneFileCMS.
	//Format for external config file is basic php:
	// < ? php                    //(without the spaces around the ?, of course)
	// $option1 = "value";
	// etc...

//Name of optional external wysiwyg editor (js file). Path is relative to OneFileCMS.
//$WYSIWYG_INIT   = 'plugins/tinymce-onefilecms_init.ALPHA.3.php';   //Init settings for TinyMCE.
//$WYSIWYG_SOURCE = 'plugins/tinymce/jscripts/tiny_mce/tiny_mce.js'; //used in $WYSIWYG_INIT
//end CONFIGURABLE INFO ********************************************************
