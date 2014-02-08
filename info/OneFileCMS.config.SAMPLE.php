<?php 
// OneFileCMS - github.com/Self-Evident/OneFileCMS
// v3.4.21
// Sample external config file - this file is OPTIONAL.
//
// Basically, what follows is just a copy & paste of the OneFileCMS CONFIGURABLE INFO.

// CONFIGURABLE INFO ***********************************************************
$config_title = "OneFileCMS";

$USERNAME = "username";
$HASHWORD = "cff29a3b595b427ef8d01c089d368c7706a8c68ecc75d566642e313ee97ff659"; //"password"
//$HASHWORD = "cff29a3b595b427ef8d01c089d368c7706a8c68ecc75d566642e313ee97ff659"; //"password"
$SALT     = 'somerandomsalt';

$MAX_ATTEMPTS  = 3;   //Max failed login attempts before LOGIN_DELAY starts.
$LOGIN_DELAY   = 10;  //In seconds.
$MAX_IDLE_TIME = 600; //In seconds. 600 = 10 minutes.  Other PHP settings (like gc) may limit its max effective value.

$MAIN_WIDTH    = '810px'; //Width of main <div> defining page layout.          Can be px, pt, em, or %.  Assumes px otherwise.
$WIDE_VIEW_WIDTH = '97%'; //Width to set Edit page if [Wide View] is clicked.  Can be px, pt, em, or %.  Assumes px otherwise.

$MAX_EDIT_SIZE = 150000;  // Edit gets flaky with large files in some browsers.  Trial and error your's.
$MAX_VIEW_SIZE = 1000000; // If file > $MAX_EDIT_SIZE, don't even view in OneFileCMS.
                          // The default max view size is completely arbitrary. Basically, it was 2am and seemed like a good idea at the time.

$MAX_IMG_W   = 810;  //Max width (in px) to display images. (main width is 810)
$MAX_IMG_H   = 1000; //Max height (in px).  I don't know, it just looks reasonable.

$UPLOAD_FIELDS = 6; //Number of upload fields on Upload File(s) page. Max value is ini_get('max_file_uploads').

$config_favicon   = "favicon.ico"; //Path is relative to root of website.
$config_excluded  = ""; //files to exclude from directory listings- CaSe sEnsiTive!

$config_etypes = "svg,asp,cfg,conf,csv,css,dtd,htm,html,xhtml,htaccess,ini,js,log,markdown,md,php,pl,txt,text"; //Editable file types.
$config_stypes = "*"; // Shown types; only files of the given types should show up in the file-listing
	// Use $config_stypes exactly like $config_etypes (list of extensions separated by commas).
	// If $config_stypes is set to null - by intention or by error - only folders will be shown.
	// If $config_stypes is set to the *-wildcard (the default), all files will show up.
	// If $config_stypes is set to "html,htm" for example, only file with the extension "html" or "htm" will get listed.

$config_itypes = "jpg,gif,png,bmp,ico"; //image types to display on edit page.
//File types (extensions).  _ftypes & _fclass must have the same number of values. bin is default.
$config_ftypes = "bin,z,gz,7z,zip,jpg,gif,png,bmp,ico,svg,asp,cfg,conf,csv,css,dtd,htm,html,xhtml,htaccess,ini,js,log,markdown,md,php,pl,txt,text";
//Cooresponding file classes to _ftypes - used to determine icons for directory listing.
$config_fclass = "bin,z,z ,z ,z  ,img,img,img,img,img,svg,txt,txt,cfg ,txt,css,txt,htm,htm ,htm  ,txt     ,txt,txt,txt,txt   ,txt,php,php,txt,txt";

$EX = '<b>( ! )</b> '; //EXclaimation point "icon" Used in $message's

$SESSION_NAME = 'OFCMS'; //Name of session cookie. Change if using multiple copies of OneFileCMS.

//Restrict access to a particular folder.  Leave empty for access to entire website.
// "some/path/" is relative to root of website (with no leading slash).
//$ACCESS_ROOT = 'some/path/';


//URL of optional external style sheet.  Used as href in <link ...>
//If file is not found, or is incomplete, the built-in defaults will be used.
//$CSS_FILE = 'OneFileCMS.css';

//Notes for $LANGUAGE_FILE, $WYSIWYG_PLUGIN, and $CONFIG_FILE:
//
// Filename paths can be:
//  1) Absolute to the filesystem:  "/some/path/from/system/root/somefile.php"  or
//  2) Relative to root of website: "some/path/from/web/root/somefile.php"

//Name of optional external language file.  If file is not found, the built-in defaults will be used.
//$LANGUAGE_FILE = "OneFileCMS.LANG.EN.php";

//Init file for optional external wysiwyg editor.
//Sample init files are availble in the OneFileCMS repo, but the actual editors are not.
//$WYSIWYG_PLUGIN = 'plugins/tinymce_init.php';
//$WYSIWYG_PLUGIN = 'plugins/ckeditor_init.php';

//Name of optional external config file.  Any settings it contains will supersede those above.
//See the sample file in the OneFileCMS github repo for format example.
//$CONFIG_FILE = 'OneFileCMS.config.SAMPLE.php';
//end CONFIGURABLE INFO ********************************************************
