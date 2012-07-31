<?php 
// OneFileCMS sample external config file.
// For versions 3.3.06 and later
// (Prior versions used an .ini format)
//
// Basically, below is simply a copy & paste of the OneFileCMS config section.


// CONFIGURABLE INFO ***********************************************************
$config_title = "OneFileCMS";

$USERNAME = 'username';

$PASSWORD = 'password'; //If using $HASHWORD, you may leave this value empty.
$USE_HASH = 0 ; // If = 0, use $PASSWORD. If = 1, use $HASHWORD. 
$HASHWORD = 'c3e70af96ab1bfc5669280e98b438e1a8c08ca5e0bb3354c05ceaa6f339fd3f6'; //hash for "password"
$SALT     = 'somerandomsalt';

$LANGUAGE_FILE = ""; //Filename of language settings. Leave blank for built-in default.
					 //If file is not found, built-in default will be used.

$MAX_ATTEMPTS  = 3;   //Max failed login attempts before LOGIN_DELAY starts.
$LOGIN_DELAY   = 10;  //In seconds.
$MAX_IDLE_TIME = 600; //In seconds. 600 = 10 minutes.  Other PHP settings may limit its max effective value.
					  //  For instance, 24 minutes is the PHP default for garbage collection.

$MAIN_WIDTH    = '810px'; //Width of main <div> defining page layout.
$WIDE_VIEW_WIDTH = '97%'; //Width to set Edit page if [Wide View] is clicked

$MAX_IMG_W   = 810;  // Max width to display images. (page container = 810)
$MAX_IMG_H   = 1000; // Max height.  I don't know, it just looks reasonable.

$MAX_EDIT_SIZE = 150000;  // Edit gets flaky with large files in some browsers.  Trial and error your's.
$MAX_VIEW_SIZE = 1000000; // If file > $MAX_EDIT_SIZE, don't even view in OneFileCMS.
                          // The default max view size is completely arbitrary. It was 2am and seemed like a good idea at the time.
$config_favicon   = "/favicon.ico";
$config_excluded  = ""; //files to exclude from directory listings- CaSe sEnsaTive!

$config_etypes = "html,htm,xhtml,php,css,js,txt,text,cfg,conf,ini,csv,svg,log"; //Editable file types.
$config_stypes = "*"; // Shown types; only files of the given types should show up in the file-listing
	// Use $config_stypes exactly like $config_etypes (list of extensions separated by semicolons).
	// If $config_stypes is set to null - by intention or by error - OFCMS will only display folders.
	// If $config_stypes is set to the *-wildcard (as per default), all files will show up.
	// If $config_stypes is set to "html,htm" for example, only file with the extension "html" or "htm" will get listed.

$config_itypes = "jpg,gif,png,bmp,ico"; //image types to display on edit page.
$config_ftypes = "bin,jpg,gif,png,bmp,ico,svg,txt,cvs,css,php,ini,cfg,conf,asp,js ,htm,html"; // _ftype & _fclass must have same
$config_fclass = "bin,img,img,img,img,img,svg,txt,txt,css,php,txt,cfg,cfg ,txt,txt,htm,htm";  // number of values. bin is default.

$EX = '<b>( ! )</b> '; //EXclaimation point "icon" Used in $message's

$SESSION_NAME = 'OFCMS'; //Also the cookie name. Change if using multiple copies of OneFileCMS.

//$config_file = 'OFCMS_config.SAMPLE.php'; //External config file, if there is one.
	//Format for external config file is basic php:
	// < ? php                    //(without the spaces around the ?, of course)
	// $option1 = "value";
	// etc...
// End CONFIGURABLE INFO *******************************************************

