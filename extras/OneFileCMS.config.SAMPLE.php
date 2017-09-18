<?php 
// OneFileCMS - github.com/Self-Evident/OneFileCMS
// v3.6.02
// Sample external config file - this file is OPTIONAL.
//
// Basically, what follows is just a copy & paste of the OneFileCMS CONFIGURABLE INFO section.


// CONFIGURABLE OPTIONS ********************************************************
$MAIN_TITLE = "OneFileCMS";

$USERNAME = "username";
$HASHWORD = "5ccc11367dc9fc18822100df2149464a64c8992fc0de9cce2a7a451360491650";
//$HASHWORD = "5ccc11367dc9fc18822100df2149464a64c8992fc0de9cce2a7a451360491650"; //"password" with $PRE_ITERATIONS = 10000
$SALT     = 'somerandomsalt';

$MAX_ATTEMPTS  = 3;    //Max failed login attempts before LOGIN_DELAY starts.
$LOGIN_DELAY   = 10;   //In seconds.
$MAX_IDLE_TIME = 600;  //In seconds. 600 = 10 minutes.  Other PHP settings (like gc) may limit its max effective value.
$TO_WARNING    = 120;  //In seconds. When idle time remaining is less than this value, a TimeOut warning is displayed.
$LOG_LOGINS    = true; //Keep log of login attempts.

$MAIN_WIDTH    = '810px'; //Width of main <div> defining page layout.          Can be px, pt, em, or %.  Assumes px otherwise.
$WIDE_VIEW_WIDTH = '97%'; //Width to set Edit page if [Wide View] is clicked.  Can be px, pt, em, or %.  Assumes px otherwise.

$LINE_WRAP = "on"; //"on",  anything else = "off".  Default for edit page. Once on page, line-wrap can toggle on/off.
$TAB_SIZE  = 8;    //Some browsers recognize a css tab-size. Some don't (IE/Edge, as of mid-2016).

$MAX_EDIT_SIZE = 250000;  // Edit gets flaky with large files in some browsers.  Trial and error your's.
$MAX_VIEW_SIZE = 1000000; // If file > $MAX_EDIT_SIZE, don't even view in OneFileCMS.
                          // The default max view size is completely arbitrary. Basically, it was 2am, and seemed like a good idea at the time.

$MAX_IMG_W   = 810;  //Max width (in px) to display images. (main width is 810)
$MAX_IMG_H   = 1000; //Max height (in px).  I don't know, it just looks reasonable.

$UPLOAD_FIELDS = 10; //Number of upload fields on Upload File(s) page. Max value is ini_get('max_file_uploads').

$FAVICON  = "favicon.ico"; //Path is relative to root of website.

$EXCLUDED_FILES  = ""; //csv list of filenames to exclude from directory listings- CaSe sEnsiTive!

$EDIT_FILES = "svg,asp,cfg,conf,csv,css,dtd,htm,html,xhtml,htaccess,ini,js,log,markdown,md,php,pl,txt,text"; //Editable file types.
$SHOW_FILES = "*"; // Shown types; only files of the given types should show up in the file-listing
	// Use $SHOW_FILES exactly like $EDIT_FILES: a list of extensions separated by commas.
	// If $SHOW_FILES is set to null - by intention or by error - only folders will be shown.
	// If $SHOW_FILES is set to the *-wildcard (the default), all files will show up.
	// If $SHOW_FILES is set to "html,htm" for example, only file with the extension "html" or "htm" will get listed.

$SHOW_IMGS = "jpg,gif,png,bmp,ico"; //image types to display on edit page.
//File types (extensions).  _ftypes & _fclass must have the same number of values. bin is default.
$FILE_TYPES = "bin,z,gz,7z,zip,jpg,gif,png,bmp,ico,svg,asp,cfg,conf,csv,css,dtd,htm,html,xhtml,htaccess,ini,js,log,markdown,md,php,pl,txt,text";
//Cooresponding file classes to _ftypes - used to determine icons for directory listing.
$FILE_CLASSES = "bin,z,z ,z ,z  ,img,img,img,img,img,svg,txt,txt,cfg ,txt,css,txt,htm,htm ,htm  ,txt     ,txt,txt,txt,txt   ,txt,php,php,txt,txt";

$EX = '<b>( ! )</b> '; //EXclaimation point "icon" Used in $MESSAGE's

$PAGEUPDOWN = 10; //Number of rows to jump using Page Up/Page Down keys on directory listing.

$SESSION_NAME = 'OFCMS'; //Name of session cookie. Change if using multiple copies of OneFileCMS concurrently.

//Optional: restrict access to a particular sub folder from root.
//$ACCESS_ROOT = '/some/path';
//If blank or invalid, default is $_SERVER['DOCUMENT_ROOT'].
//$ACCESS_ROOT = '/home/user';


//Optional: specify a default start path on login.
//$DEFAULT_PATH = 'some/path/deeper/'
//Must be a decendant of $ACCESS_ROOT.
//If blank or invalid, defaults to $ACCESS_ROOT.
//$DEFAULT_PATH = '/home/user/public_html';


//URL of optional external style sheet.  Used as an href in <link ...>
//If file is not found, or is incomplete, built-in defaults will be used.
//$CSS_FILE = 'OneFileCMS.css';


//Notes for $LANGUAGE_FILE, $WYSIWYG_PLUGIN, and $CONFIG_FILE:
//
// Filename path examples:
//  1) $SOME_FILE = "/some/path/from/system/root/somefile.php"	//Absolue to filesystem.
//  2) $SOME_FILE = $_SERVER['DOCUMENT_ROOT']."/some/path/from/web/root/somefile.php" //Relative to root of web site.

//Name of optional external language file.  If file is not found, the built-in defaults will be used.
//$LANGUAGE_FILE = "/home/user/public_html/OneFileCMS.LANG.EN.php";

//Init file for optional external wysiwyg editor.
//Sample init files are availble in the "extras\" folder of the OneFileCMS repo, but the actual editors are not.
//$WYSIWYG_PLUGIN = '/home/user/public_html/plugins/plugin-tinymce_init.php';
//$WYSIWYG_PLUGIN = '/home/user/public_html/plugins/plugin-ckeditor_init.php';

//Name of optional external config file.  Any settings it contains will supersede those above.
//See the sample file in the OneFileCMS github repo for format example.
//Basically, it is just a php file with a copy/paste of this configuration section.
//$CONFIG_FILE = '/home/user/public_html/extras/OneFileCMS.config.SAMPLE.php';

//end CONFIGURABLE OPTIoNS *****************************************************
