<?php 
// OneFileCMS - github.com/Self-Evident/OneFileCMS
// v3.4.19
// Sample external config file.
//
// Basically, what follows is just a copy & paste of the OneFileCMS config section,
// except $config_file is not included.

// CONFIGURABLE INFO ***********************************************************
$config_title = "OneFileCMS";

$USERNAME = "username";
$HASHWORD = "cff29a3b595b427ef8d01c089d368c7706a8c68ecc75d566642e313ee97ff659"; //"password"
//$HASHWORD = "cff29a3b595b427ef8d01c089d368c7706a8c68ecc75d566642e313ee97ff659"; //"password"
$SALT     = 'somerandomsalt';

//Name of optional external language file.  If file is not found, the built-in defaults will be used.
//Path can be absolute to the filesystem, or relative to root of website - if chdir($DOC_ROOT). (current method)
//$LANGUAGE_FILE = "OneFileCMS.LANG.EN.php";

$MAX_ATTEMPTS  = 3;   //Max failed login attempts before LOGIN_DELAY starts.
$LOGIN_DELAY   = 10;  //In seconds.
$MAX_IDLE_TIME = 600; //In seconds. 600 = 10 minutes.  Other PHP settings (like gc) may limit its max effective value.

$MAIN_WIDTH    = '810px'; //Width of main <div> defining page layout.          Can be px, pt, em, or %.  Assumes px otherwise.
$WIDE_VIEW_WIDTH = '97%'; //Width to set Edit page if [Wide View] is clicked.  Can be px, pt, em, or %.  Assumes px otherwise.

$MAX_IMG_W   = 810;  //Max width to display images. (main width is 810)
$MAX_IMG_H   = 1000; //Max height.  I don't know, it just looks reasonable.

$MAX_EDIT_SIZE = 150000;  // Edit gets flaky with large files in some browsers.  Trial and error your's.
$MAX_VIEW_SIZE = 1000000; // If file > $MAX_EDIT_SIZE, don't even view in OneFileCMS.
                          // The default max view size is completely arbitrary. Basically, it was 2am and seemed like a good idea at the time.

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

//Init file for optional external wysiwyg editor.
//Sample init files are availble in the OneFileCMS repo, but the actual editors are not.
//Path can be absolute to the filesystem, or relative to root of website - if chdir($DOC_ROOT). (current method)
//$WYSIWYG_PLUGIN = 'plugins/tinymce_init.php';
//$WYSIWYG_PLUGIN = 'plugins/ckeditor_init.php';

//end CONFIGURABLE INFO ********************************************************
