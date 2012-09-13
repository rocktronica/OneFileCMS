<?php
// OneFileCMS - github.com/Self-Evident/OneFileCMS

$OFCMS_version = '3.4.03';

/*******************************************************************************
Copyright © 2009-2012 https://github.com/rocktronica
Copyright © 2012-     https://github.com/Self-Evident  David W. Gay

This software is copyright under terms of the "MIT" license:

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies
of the Software, and to permit persons to whom the Software is furnished to do
so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*******************************************************************************/




//Some basic security & error log settings**************************************
ob_start(); //Catch any early output. Closed prior to page output.
ini_set('session.use_trans_sid', 0);    //make sure URL supplied SESSID's are not used
ini_set('session.use_only_cookies', 1); //make sure URL supplied SESSID's are not used
error_reporting(0); //0 for none, or (E_ALL &~ E_STRICT) for trouble-shooting.
ini_set('display_errors', 'off');         //Only turn on for trouble-shooting.
ini_set('log_errors'    , 'off');         //Only turn on for trouble-shooting.
ini_set('error_log'     , $_SERVER['SCRIPT_FILENAME'].'.ERROR.log');
//Determine good folder for session file? Default is tmp/, which is not secure, but it may not be a serious concern.
//session_save_path($safepath)  or  ini_set('session.save_path', $safepath)
//******************************************************************************




// CONFIGURABLE INFO ***********************************************************
$config_title = "OneFileCMS";

$USERNAME = "username";
$HASHWORD = "a6ca7f88bd5efc706d38047cc5844d2b11f86242c01e0c89a1c656dbe2dd1866"; //"password"
$SALT     = 'somerandomsalt';

//$LANGUAGE_FILE = "OneFileCMS.LANG.EN.php"; //Filename of language settings.
				//Path is relative to OneFileCMS. If file is not found, the built-in default will be used.

$MAX_ATTEMPTS  = 3;   //Max failed login attempts before LOGIN_DELAY starts.
$LOGIN_DELAY   = 10;  //In seconds.
$MAX_IDLE_TIME = 600; //In seconds. 600 = 10 minutes.  Other PHP settings may limit its max effective value.
					  //  For instance, 24 minutes is the PHP default for garbage collection.

$MAIN_WIDTH    = '810px'; //Width of main <div> defining page layout.
$WIDE_VIEW_WIDTH = '97%'; //Width to set Edit page if [Wide View] is clicked

$MAX_IMG_W   = 810;  //Max width to display images. (page container = 810)
$MAX_IMG_H   = 1000; //Max height.  I don't know, it just looks reasonable.

$MAX_EDIT_SIZE = 150000;  // Edit gets flaky with large files in some browsers.  Trial and error your's.
$MAX_VIEW_SIZE = 1000000; // If file > $MAX_EDIT_SIZE, don't even view in OneFileCMS.
                          // The default max view size is completely arbitrary. Basically, it was 2am and seemed like a good idea at the time.
$config_favicon   = "favicon.ico"; //Path is relative to root of website.
$config_excluded  = ""; //files to exclude from directory listings- CaSe sEnsaTive!

$config_etypes = "html,htm,xhtml,php,css,js,txt,text,cfg,conf,ini,csv,svg,log,htaccess"; //Editable file types.
$config_stypes = "*"; // Shown types; only files of the given types should show up in the file-listing
	// Use $config_stypes exactly like $config_etypes (list of extensions separated by semicolons).
	// If $config_stypes is set to null - by intention or by error - OFCMS will only display folders.
	// If $config_stypes is set to the *-wildcard (as per default), all files will show up.
	// If $config_stypes is set to "html,htm" for example, only file with the extension "html" or "htm" will get listed.

$config_itypes = "jpg,gif,png,bmp,ico"; //image types to display on edit page.
$config_ftypes = "bin,jpg,gif,png,bmp,ico,svg,txt,cvs,css,php,ini,cfg,conf,asp,js ,htm,html,htaccess"; // _ftype & _fclass must have same
$config_fclass = "bin,img,img,img,img,img,svg,txt,txt,css,php,txt,cfg,cfg ,txt,txt,htm,htm ,txt";      // number of values. bin is default.

$EX = '<b>( ! )</b> '; //EXclaimation point "icon" Used in $message's

$SESSION_NAME = 'OFCMS-'; //Name of session cookie. Change if using multiple copies of OneFileCMS.

//External config file, if there is one.  Any settings in the $config_file will supersede those above.
//$config_file = 'OFCMS_config.SAMPLE.php';  // Path is relative to OneFileCMS.
	//Format for external config file is basic php:
	// < ? php                    //(without the spaces around the ?, of course)
	// $option1 = "value";
	// etc...
// End CONFIGURABLE INFO *******************************************************




//******************************************************************************
//System values & setup

//If there is one, include external config file.
if ( isset($config_file) && is_file($config_file) ) { include($config_file); }
else { $config_file = '';} //needs set further down.


//Requires PHP 5.1, due to changes in some functions.
//Earliest version the author has for testing is 5.2.8 (50208)
define('PHP_VERSION_ID_REQUIRED',50100);   //Ex: 5.1.23 is 50123
define('PHP_VERSION_REQUIRED'  ,'5.1 + '); //Used in exit() message.

//The predefined constant PHP_VERSION_ID has only been available since 5.2.7.
//So, if needed, convert PHP_VERSION (a string) to PHP_VERSION_ID (a number).
//Ex: 5.1.23 converts to 50123.
if (!defined('PHP_VERSION_ID')) {
	$phpversion = explode('.', PHP_VERSION);
	define('PHP_VERSION_ID', ($phpversion[0] * 10000 + $phpversion[1] * 100 + $phpversion[2]));
}

$TO_WARNING = 120; //When idle time remaining is less than this value, $timeout_warning is displayed

ini_set('session.gc_maxlifetime', $MAX_IDLE_TIME + 100); //in case the default is less.

$ONESCRIPT = URLencode_path($_SERVER["SCRIPT_NAME"]); //Used for ULR's
$DOC_ROOT  = $_SERVER["DOCUMENT_ROOT"].'/';
$WEB_ROOT  = URLencode_path(basename($DOC_ROOT)).'/';
$WEBSITE   = $_SERVER["HTTP_HOST"].'/';

$ONESCRIPT_file   = $_SERVER["SCRIPT_FILENAME"];  //Non-url use
$ONESCRIPT_path   = dirname($ONESCRIPT_file).'/'; //Non-url use //Do not use dir_name().
$LOGIN_ATTEMPTS   = $ONESCRIPT_file.'.invalid_login_attempts';

$ONESCRIPT_url_backup  = $ONESCRIPT.'.BACKUP.php';                   //used for p/w & u/n updates.
$ONESCRIPT_file_backup = $ONESCRIPT_file.'.BACKUP.php';              //used for p/w & u/n updates.
$CONFIG_file           = $ONESCRIPT_path.$config_file;               //used for p/w & u/n updates.
$CONFIG_file_backup    = $ONESCRIPT_path.$config_file.'.BACKUP.php'; //used for p/w & u/n updates.
$CONFIG_url_backup     =  URLencode_path($CONFIG_file_backup);       //used for p/w & u/n updates.

$valid_pages = array("login","logout","admin","hash","changepw","changeun","index","edit","upload","uploaded","newfile","copy","rename","delete","newfolder","renamefolder","deletefolder","mcdaction");

$INVALID_CHARS = '< > ? * : " | / \\'; //Illegal characters for file/folder names.
$INVALID_CHARS_array = explode(' ', $INVALID_CHARS); // (Space deliminated)

//Make arrays out of a few $config_variables for actual use later.
//First, remove spaces and make lowercase.
$SHOWALLFILES = $stypes = false;
  if ($config_stypes == '*') { $SHOWALLFILES = true; }
  else { $stypes   = explode(',', strtolower(str_replace(' ', '', $config_stypes))); }//shown file types
$etypes   = explode(',', strtolower(str_replace(' ', '', $config_etypes))); //editable file types
$itypes   = explode(',', strtolower(str_replace(' ', '', $config_itypes))); //images types to display
$ftypes   = explode(',', strtolower(str_replace(' ', '', $config_ftypes))); //file types with icons
$fclasses = explode(',', strtolower(str_replace(' ', '', $config_fclass))); //for file types with icons
$excluded_list = (explode(",", $config_excluded));

//*The parameter for the Select_All() and Confirm_ready() javascript functions
// is the number of form elements before the first file select checkbox.
// As of Version 3.3.18, that number is 7.
$CHECKBOX_OFFSET = 7;
//******************************************************************************




function hsc($input) { return htmlspecialchars($input, ENT_QUOTES, 'UTF-8'); }// end hsc() *********
function hte($input) { return htmlentities($input, ENT_QUOTES, 'UTF-8'); }//end hte()***************




function Default_Language() { // ***********************************************
	global $_;
// OneFileCMS Language Settings v3.4.03

$_['LANGUAGE'] = 'English'; //EN
$_['LANG'] = 'EN';

// If no translation or value is desired for a particular setting, do not delete
// the actual setting variable, just set it to an empty string.
// For example:  $_['some_unused_setting'] = '';
//
// Remember to slash-escape any single quotes that may be within the text:  \'
// The back-slash itself may or may not also need to be escaped:  \\
//
// If present as a trailing comment, "## NT ##" means 'Need Translation'.
//
// In some instances, some langauges may use significantly longer words or phrases than others.
// So, a smaller font or less spacing may be desirable in those places to preserve page layout.
//
$_['front_links_font_size'] = '1em';    //Buttons on Index page.
$_['front_links_margin_R']  = '1em';
$_['button_font_size']      = '.9em';   //Buttons on Edit page.
$_['button_margin_L']       = '.7em';
$_['button_padding']        = '4px 10px';
$_['image_info_font_size']  = '1em';    //show_img_msg_01  &  _02
$_['image_info_pos']        = '';       //If 1 or true, moves the info down a line for more space.
$_['select_all_label_size'] = '.84em';  //Font size of $_['Select_All']
$_['select_all_div_width']  = '73px';   //Width of space for $_['Select_All']
$_['R'] = 'R'; //R ename
$_['C'] = 'C'; //C opy
$_['D'] = 'D'; //D elete
$_['Admin']   = 'Admin';
$_['Cancel']  = 'Cancel';
$_['Close']   = 'Close';
$_['Copy']    = 'Copy';
$_['Copied']  = 'Copied';
$_['Create']  = 'Create';
$_['Delete']  = 'Delete';
$_['DELETE']  = 'DELETE';
$_['Deleted'] = 'Deleted';
$_['Edit']    = 'Edit';
$_['Enter']   = 'Enter';
$_['Error']   = 'Error';   //#####
$_['errors']  = 'errors';
$_['File']    = 'File';
$_['Folder']  = 'Folder';
$_['From']    = 'From';
$_['Hash']    = 'Hash';
$_['Move']    = 'Move';
$_['Moved']   = 'Moved';
$_['on']      = 'on';
$_['bytes']   = 'bytes';   //#####
$_['Password']   = 'Password';
$_['Rename']     = 'Rename';
$_['successful'] = 'successful';
$_['To']         = 'To';
$_['Upload']     = 'Upload';
$_['Username']   = 'Username';
$_['Log_In']     = 'Log In';
$_['Log_Out']    = 'Log Out';
$_['Admin_Options']  = 'Administration Options';
$_['Edit_View']      = 'Edit / View File';
$_['Upload_File']    = 'Upload File';
$_['New_File']       = 'New File';
$_['Ren_Move']       = 'Rename / Move';
$_['Ren_Moved']      = 'Renamed / Moved';
$_['New_Folder']     = 'New Folder';
$_['Ren_Folder']     = 'Rename / Move Folder';
$_['Del_Folder']     = 'Delete Folder';
$_['Submit']         = 'Submit Request';
$_['Move_Files']     = 'Move File(s)';
$_['Copy_Files']     = 'Copy File(s)';
$_['Del_Files']      = 'Delete File(s)';
$_['Selected_Files'] = 'Selected Files';
$_['Select_All']     = 'Select All';
$_['Clear_All']      = 'Clear All';
$_['New_Location']   = 'New Location';
$_['No_files']       = 'No files selected.';
$_['No_action']      = 'No action selected.';
$_['Not_found']      = 'Not found';
$_['pass_to_hash']   = 'Password to hash:';
$_['Generate_Hash']  = 'Generate Hash';
$_['save_1']      = 'Save';
$_['save_2']      = 'SAVE CHANGES!';
$_['reset']       = 'Reset - loose changes';
$_['Wide_View']   = 'Wide View';
$_['Normal_View'] = 'Normal View';
$_['Open_View']   = 'Open/View in browser window'; //#####
$_['verify_msg_01']  = 'Session expired.';
$_['verify_msg_02']  = 'INVALID POST';
$_['get_get_msg_01']    = 'File does not exist:';
$_['get_get_msg_02']    = 'Invalid page request:';
$_['check_path_msg_02'] = 'dot" or "dot dot" path segments are not permitted.'; //#####
$_['check_path_msg_03'] = 'Path or filename contains an invalid character:'; //#####
$_['ord_msg_01']        = 'A file with that name already exists in the target directory.';
$_['ord_msg_02']        = 'Saving as';
$_['show_img_msg_01']   = 'Image shown at ~';
$_['show_img_msg_02']   = '% of full size (W x H =';
$_['hash_txt_01'] = 'The hashes generated by this page may be used to manually update $HASHWORD in OneFileCMS, or in an external config file.  In either case, make sure you remember the password used to generate the hash!';
$_['hash_txt_06'] = 'Type your desired password in the input field above and hit Enter.';
$_['hash_txt_07'] = 'The hash will be displayed in a yellow message box above that.';
$_['hash_txt_08'] = 'Copy and paste the new hash to the $HASHWORD variable in the config section.';
$_['hash_txt_09'] = 'Make sure to copy ALL of, and ONLY, the hash (no leading or trailing spaces etc).';
$_['hash_txt_10'] = 'A double-click should select it...';
$_['hash_txt_12'] = 'When ready, logout and login.';
$_['login_txt_01']  = 'Username:';
$_['login_txt_02']  = 'Password:';
$_['login_msg_01a'] = 'There have been';
$_['login_msg_01b'] = 'invalid login attempts.';
$_['login_msg_02a'] = 'Please wait';
$_['login_msg_02b'] = 'seconds to try again.';
$_['login_msg_03']  = 'INVALID LOGIN ATTEMPT #';
$_['edit_note_00']  = 'NOTES:';
$_['edit_note_01a'] = 'Remember- your';
$_['edit_note_01b'] = 'is';
$_['edit_note_02']  = 'So save changes before the clock runs out, or the changes will be lost!';
$_['edit_note_03']  = 'With some browsers, such as Chrome, if you click the browser [Back] then browser [Forward], the file state may not be accurate. To correct, click the browser\'s [Reload].';
$_['edit_note_04']  = 'Chrome may disable some javascript in a page if the page even appears to contain inline javascript in certain contexts. This can affect some features of the OneFileCMS edit page when editing files that legitimately contain such code, such as OneFileCMS itself. However, such files can still be edited and saved with OneFileCMS. The primary function lost is the incidental change of background colors (red/green) indicating whether or not the file has unsaved changes. The issue will be noticed after the first save of such a file.';
$_['edit_h2_1']   = 'Viewing:';
$_['edit_h2_2']   = 'Editing:';
$_['edit_txt_01'] = 'Non-text or unkown file type. Edit disabled.';
$_['edit_txt_02'] = 'File possibly contains an invalid character. Edit and view disabled.';
$_['edit_txt_03'] = 'htmlspecialchars() returned an empty string from what may be an otherwise valid file.';
$_['edit_txt_04'] = 'This behavior can be inconsistant from version to version of php.';
$_['too_large_to_edit_01a'] = 'Edit disabled. Filesize >';
$_['too_large_to_edit_02']  = 'Some browsers (ie: IE) bog down or become unstable while editing a large file in an HTML <textarea>.';
$_['too_large_to_edit_03']  = 'Adjust $MAX_EDIT_SIZE in the configuration section of OneFileCMS as needed.';
$_['too_large_to_edit_04']  = 'A simple trial and error test can determine a practical limit for a given browser/computer.';
$_['too_large_to_view_01a'] = 'View disabled. Filesize >';
$_['too_large_to_view_02']  = 'Click the file name above to view as normally rendered in a browser window.';
$_['too_large_to_view_03']  = 'Adjust $MAX_VIEW_SIZE in the configuration section of OneFileCMS as needed.';
$_['too_large_to_view_04']  = '(The default value for $MAX_VIEW_SIZE is completely arbitrary, and may be adjusted as desired.)';
$_['meta_txt_01'] = 'Filesize:';
$_['meta_txt_03'] = 'Updated:';
$_['edit_msg_01'] = 'File saved:';
$_['edit_msg_02'] = 'bytes written.';
$_['edit_msg_03'] = 'There was an error saving file.';
$_['upload_txt_01']  = 'per upload_max_filesize in php.ini.';
$_['upload_txt_02']  = 'per post_max_size in php.ini';
$_['upload_txt_03']  = 'Note: Maximum upload file size is:';
$_['upload_err_01a'] = 'Error 1: File too large.';
$_['upload_err_01b'] = '(From php.ini)';
$_['upload_err_02a'] = 'Error 2: File too large.';
$_['upload_err_02b'] = '(From OneFileCMS)';
$_['upload_err_03']  = 'Error 3: The uploaded file was only partially uploaded.';
$_['upload_err_04']  = 'Error 4: No file was uploaded.';
$_['upload_err_05']  = 'Error 5:';
$_['upload_err_06']  = 'Error 6: Missing a temporary folder.';
$_['upload_err_07']  = 'Error 7: Failed to write file to disk.';
$_['upload_err_08']  = 'Error 8: A PHP extension stopped the file upload.';
$_['upload_msg_01'] = 'No file selected for upload.';
$_['upload_msg_02'] = 'Destination folder invalid:'; //#####
$_['upload_msg_03'] = 'Upload cancelled.';
$_['upload_msg_04'] = 'Uploading:';
$_['upload_msg_05'] = 'Upload successful!';
$_['upload_msg_06'] = 'Upload failed:';
$_['new_file_txt_01'] = 'File or Folder will be created in the current folder.'; //#####
$_['new_file_txt_02'] = 'Some invalid characters are:';
$_['new_file_msg_01'] = 'File or folder not created:'; //#####
$_['new_file_msg_02'] = 'Name contains an invalid character:'; //#####
$_['new_file_msg_03'] = 'Not created - no name given'; //#####
$_['new_file_msg_04'] = 'File or folder already exists:'; //#####
$_['new_file_msg_05'] = 'Created file:';
$_['new_file_msg_07'] = 'Created folder:'; //#####
$_['CRM_txt_02']  = 'The new location must already exist.';
$_['CRM_txt_03']  = 'Old Name and Location'; //#####
$_['CRM_txt_04']  = 'New Name';
$_['CRM_msg_01']  = 'Error - new parent location does not exist:';
$_['CRM_msg_02']  = 'Error - source file does not exist:';
$_['CRM_msg_03']  = 'Error - new file or folder already exists:'; //#####
$_['CRM_msg_05a'] = 'Error during';
$_['delete_txt_01'] = 'Are you sure?';
$_['delete_msg_01'] = 'Deleted file:';
$_['delete_msg_02'] = 'Error deleting';
$_['delete_folder_txt_01'] = 'Are you sure?';
$_['delete_folder_msg_01'] = 'Folder not empty. Folders must be empty before they can be deleted.';
$_['delete_folder_msg_02'] = 'Deleted folder:';
$_['delete_folder_msg_03'] = 'an error occurred during delete.';
$_['session_warning'] = 'Warning: Session timeout soon!';
$_['session_expired'] = 'SESSION EXPIRED';
$_['unload_unsaved']  = ' Unsaved changes will be lost!';
$_['confirm_reset']   = 'Reset file and loose unsaved changes?';
$_['OFCMS_requires']   = 'OneFileCMS requires PHP';
$_['logout_msg']       = 'You have successfully logged out.';
$_['folder_del_msg']   = 'Folder not empty. Folders must be empty before they can be deleted.';
$_['upload_error_01a'] = 'Upload Error. Total POST data (mostly filesize) exceeded post_max_size =';
$_['upload_error_01b'] = '(from php.ini)';
$_['edit_caution_01']  = 'CAUTION';
$_['edit_caution_02']  = 'You are editing the active copy of OneFileCMS - BACK IT UP & BE CAREFUL !!';
$_['time_out_txt']     = 'Session time out in:';
$_['error_reporting_01'] = 'Display errors is';
$_['error_reporting_02'] = 'Log errors is';
$_['error_reporting_03'] = 'Error reporting is set to';
$_['error_reporting_04'] = 'Showing error types';
$_['error_reporting_05'] = 'Unexpected early output';
$_['error_reporting_06'] = '(nothing, not even white-space, should have been output yet)';
$_['admin_txt_00'] = 'Old Backup Found';
$_['admin_txt_01'] = 'A backup file was created in case of an error during a username or password change. Therefore, it may contain old information and should be deleted if not needed. In any case, it will automatically be overwritten on the next password or username change.';
$_['admin_txt_02'] = 'General Information';
$_['admin_txt_04'] = 'As of version 3.3.13, OneFileCMS no longer maintains a plain text password option, and only stores a password hash, as most login systems do.';
$_['admin_txt_12'] = 'However, due to a number of considerations, this change was largely an academic exersize. That is, in this application, take the idea that it adds much of an improvement to security with a grain of cryptographic salt. Never-the-less, it does eliminate the storage of your password in plain text (if that option was used), which is generally considered to be a good thing.';
$_['admin_txt_14'] = 'For another small improvement to security, change the default salt and/or method used by OneFileCMS to hash the password (and keep them secret, of course). Every little bit helps...';
$_['admin_txt_16'] = 'Also, you can still use OneFileCMS to edit itself. However, be sure to have a backup ready for the inevitable ytpo...';
$_['pw_change']  = 'Change Password';
$_['pw_current'] = 'Current Password';
$_['pw_new']     = 'New Password';
$_['pw_confirm'] = 'Confirm New Password';
$_['pw_txt_02'] = 'Password / Username rules:';
$_['pw_txt_04'] = 'They are case-sensitive!';
$_['pw_txt_06'] = 'They must contain at least one non-space character.';
$_['pw_txt_08'] = 'They may contain spaces in the middle. Ex: "This is a password or username!"';
$_['pw_txt_10'] = 'Leading and trailing spaces are removed.';
$_['pw_txt_12'] = 'To record the change, only one file is updated: either the active copy of OneFileCMS, or, if specified, an external configuration file.';
$_['pw_txt_14'] = 'If an incorrect current password is entered, you will be logged out, but you may log back in.';
$_['change_pw_01'] = 'Password changed!';
$_['change_pw_02'] = 'Password NOT changed:';
$_['change_pw_03'] = 'Incorrect current password. Login to try again.';
$_['change_pw_04'] = 'New and "Confirm New" values do not match.';
$_['change_pw_05'] = 'Updating';
$_['change_pw_06'] = 'external config file';
$_['un_change']     = 'Change Username';
$_['un_new']        = 'New Username';
$_['un_confirm']    = 'Confirm New Username';
$_['change_un_01']  = 'Username changed!';
$_['change_un_02']  = 'Username NOT changed:';
$_['update_failed'] = 'Update failed - could not save file.';
$_['mcd_msg_01']    = 'files moved successfully.';
$_['mcd_msg_02']    = 'files copied successfully.';
$_['mcd_msg_03']    = 'files deleted successfully.';
}//end Default_Language() ******************************************************




function Session_Startup() { //*************************************************
	global $SESSION_NAME, $page, $VALID_POST, $message;

	$limit    = 0; //0 = session.
	$path     = '';
	$domain   = ''; // '' = hostname
	$https    = false;
	$httponly = true; //true = unaccessable via javascript. Some XSS protection.
	session_set_cookie_params($limit, $path, $domain, $https, $httponly);

	session_name($SESSION_NAME);
	session_start();

	//Set initial defaults...
	$page = 'login';
	$VALID_POST = 0;
	if ( !isset($_SESSION['valid']) ) { $_SESSION['valid'] = 0; }

	//Logging in?
	if ( isset($_POST["username"]) && isset($_POST["password"]) ) { Login_response(); }

	session_regenerate_id(true); //Helps prevent session fixation & hijacking.

	if ( $_SESSION['valid'] ) { Verify_IDLE_POST_etc(); }

	$_SESSION['nuonce'] = sha1(mt_rand().microtime()); //provided in <forms> to verify POST
		
	chdir($_SERVER["DOCUMENT_ROOT"]); //Allow OneFileCMS.php to be started from any dir on the site.
}//end Session_Startup() *******************************************************




function Verify_IDLE_POST_etc() { //********************************************
	global $_, $page, $ONESCRIPT, $param1, $EX, $message, $VALID_POST, $MAX_IDLE_TIME;

	//Verify consistant user agent... (every little bit helps every little bit)
	if ( !isset($_SESSION['user_agent']) || ($_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT']) ) { Logout(); }

	//Check idle time
 	if ( isset($_SESSION['last_active_time']) ) {
		$idle_time = ( time() - $_SESSION['last_active_time'] );
		if ( $idle_time > $MAX_IDLE_TIME ) {
			Logout();
			$message .= hsc($_['verify_msg_01']).'<br>';
		}
	}

	$_SESSION['last_active_time'] = time();

	//If POSTing, verify...
	if ( isset($_POST['nuonce']) ) {
		if ( $_POST['nuonce'] == $_SESSION['nuonce'] ) {
			$VALID_POST = 1;
		}else{ //If it exists but doesn't match - something's wrong. Probably a page reload.
			$page  = "index";
			$_POST = "";
			$message .= $EX.'<b>'.hsc($_['verify_msg_02']).'</b><br>';
		}
	}
}//end Verify_IDLE_POST_etc() //************************************************




function hashit($key){ //*******************************************************
	//This is the super-secret stuff - Keep it secret, keep it safe!
	//If you change anything here, or the $SALT, redo the hash for your password.
	global $SALT;
	$hash = hash('sha256', trim($key).$SALT); // trim off leading & trailing whitespace.
	for ( $x=0; $x < 10000; $x++ ) { $hash = hash('sha256', $hash.$SALT); }
	return $hash;
}//end hashit() ****************************************************************




function Error_reporting_and_early_output($show_status = 0, $show_types = 0) {//
//Display the status of error_reporting(), and ini_get() of display_errors & log_errors.
//Also displays any early output caught by ob_start().
	global $_, $early_output;

	$E_level = error_reporting();
	$E_types = '';
	$spc = ' &nbsp; '; // or '<br>' or PHP_EOL or whatever...
	if ( $E_level &     1 ) { $E_types  = 'E_ERROR'            .$spc; }
	if ( $E_level &     2 ) { $E_types .= 'E_WARNING'          .$spc; }
	if ( $E_level &     4 ) { $E_types .= 'E_PARSE'            .$spc; }
	if ( $E_level &     8 ) { $E_types .= 'E_NOTICE'           .$spc; }
	if ( $E_level &    16 ) { $E_types .= 'E_CORE_ERROR'       .$spc; }
	if ( $E_level &    32 ) { $E_types .= 'E_CORE_WARNING'     .$spc; }
	if ( $E_level &    64 ) { $E_types .= 'E_COMPILE_ERROR'    .$spc; }
	if ( $E_level &   128 ) { $E_types .= 'E_COMPILE_WARNING'  .$spc; }
	if ( $E_level &   256 ) { $E_types .= 'E_USER_ERROR'       .$spc; }
	if ( $E_level &   512 ) { $E_types .= 'E_USER_WARNING'     .$spc; }
	if ( $E_level &  1024 ) { $E_types .= 'E_USER_NOTICE'      .$spc; }
	if ( $E_level &  2048 ) { $E_types .= 'E_STRICT'           .$spc; }
	if ( $E_level &  4096 ) { $E_types .= 'E_RECOVERABLE_ERROR'.$spc; }
	if ( $E_level &  8192 ) { $E_types .= 'E_DEPRECATED'       .$spc; }
	if ( $E_level & 16384 ) { $E_types .= 'E_USER_DEPRECATED'  .$spc; }

	if ( $show_status && ( (error_reporting() !=  0) ||
						   (ini_get('display_errors') == 'on') ||
						   (ini_get('log_errors') == 'on') ) )
	{
?>		<style>
		.E_box {margin: 0;	 background-color: #F33; font-size: 1em; color: white;
				padding: 4px 5px 5px 5px; border: 0 solid white; }
		</style>
<?php
		echo '<p class="E_box"><b>PHP '.PHP_VERSION.$spc;
		echo hsc($_['error_reporting_01']).': '.ini_get('display_errors').'.'.$spc;
		echo hsc($_['error_reporting_02']).': '.ini_get('log_errors')    .'.'.$spc;
		echo hsc($_['error_reporting_03']).': '.error_reporting()        .'.'.$spc;
		echo 'E_ALL = '.E_ALL.$spc.'</b>';
		
		if ($show_types) {
			echo '<br><b>'.hsc($_['error_reporting_04']).': </b>';
			echo '<span style="font: 400 .8em arial">'.$E_types.'</span>';
		}
		echo '</p>';
	}//end if (error reporting on)

	//$early_output is contents of ob_get_clean(), just before page output.
	if (strlen($early_output) > 0 ) {
		echo '<pre style="background-color: #Fdd; border: 1px solid #Faa;"><b>';
		echo hsc($_['error_reporting_05']).'</b> ';
		echo hsc($_['error_reporting_06']).'<b>:</b> ';
		echo '<span style="background-color: white; border: 1px solid white">';
		echo hte($early_output).'</span></pre>';
	}
}//end Error_reporting_and_early_output() //************************************




function Update_Recent_Pages() { //*********************************************
	global $page;

	$recent_pages = array("");
	$pages = 0; //Index to recent_page
	
	if (!isset($_SESSION['recent_pages'])) { $_SESSION['recent_pages'] = array(""); }
	$pages = count($_SESSION['recent_pages']) - 1;

	//Re-reverse so index [0] is oldest page (reversed at end of function)
	$_SESSION['recent_pages'] = array_reverse($_SESSION['recent_pages']);

	//Only update if actually a new page
	if ( $page != $_SESSION['recent_pages'][$pages] ) {
		$_SESSION['recent_pages'][$pages+1] = $page;
		$pages = count($_SESSION['recent_pages']);
	}

	//Only need 3 most recent pages (increase if needed)
	if ($pages > 3) { array_shift($_SESSION['recent_pages']); }

	//Reverse order so index [0] is the current page
	$_SESSION['recent_pages'] = array_reverse($_SESSION['recent_pages']);

}//end Update_Recent_Pages() ***************************************************




function undo_magic_quotes(){ //************************************************

	function strip_array($var) {
		if (is_array($var)) {return array_map("strip_array", $var); }
		else                {return stripslashes($var); }
	} //Note: stripslashes also handles cases when magic_quotes_sybase is on.

	if (get_magic_quotes_gpc()) {
		if (isset($_GET))    { $_GET     = strip_array($_GET);    }
		if (isset($_POST))   { $_POST    = strip_array($_POST);   }
		if (isset($_COOKIE)) { $_COOKIE  = strip_array($_COOKIE); }
	}
}//end undo_magic_quotes() *****************************************************




function Get_GET() { //*** Get main parameters *********************************
	// i=some/path/,  f=somefile.xyz,  p=somepage
	// $ipath      ,  $filename     ,  $page
	// Get_GET() should not be called unless $_SESSION['valid'] == 1
	global $_, $ipath, $filename, $page, $valid_pages, $param1, $param2, $param3, $EX, $message;

	//Initialize & validate $ipath
	if (isset($_GET["i"])) {
		$ipath = Check_path($_GET["i"],1);
		if ( $ipath === false || !is_dir($ipath)) { $ipath = ""; }
	}else {
		$ipath = "";
	}

	//Initialize & validate $filename
	if (isset($_GET["f"])) { $filename = $ipath.$_GET["f"]; } else { $filename = ""; }
	if ( ($filename != "") && !is_file($filename)  ) {
		$message .= $EX.'<b>'.hsc($_['get_get_msg_01']).'</b> ';
		$message .= hte(dir_name($filename)).'<b>'.hte(basename($filename)).'</b><br>';
		$filename = "";
	}

	//Initialize & validate $page
	if (isset($_GET["p"])) { $page = $_GET["p"]; } else { $page = "index"; }
	if (!in_array($page, $valid_pages)) {
		$message .= $EX.hsc($_['get_get_msg_02']).' <b>'.hte($page).'</b><br>';
		$page = "index";  //If invalid $_GET["p"]
	}

	//Pages that require a valid $filename
	$file_pages = array("edit", "rename", "copy", "delete");

	//Make sure $filename & $page go together
	if ( ($filename != "") && !in_array($page, $file_pages) ) { $filename = "";  }
	if ( ($filename == "") &&  in_array($page, $file_pages) ) { $page = "index"; }

	//Init $param's used in <a> href's & <form> actions
	$param1 = '?i='.URLencode_path($ipath); //$param1 must not be blank.
	if ($filename == "") { $param2 = ""; } else { $param2 = '&amp;f='.rawurlencode(basename($filename)); }
	if ($page == ""    ) { $param3 = ""; } else { $param3 = '&amp;p='.$page; }
}//end Get_GET()****************************************************************




function Verify_page_conditions() { //******************************************
	global $_, $ONESCRIPT, $ipath, $filename, $page, $EX, $message, $VALID_POST;
	
	//If exited admin pages, restore $ipath
	if    ( ($page == "index") && $_SESSION['admin_page'] ) {
		//Unless clicked www/some/path/ from edit or copy page.
		if ( ($_SESSION['recent_pages'][1] != 'edit') && ($_SESSION['recent_pages'][1] != 'copy') ){
			$ipath = $_SESSION['admin_ipath'];
			$param1 = '?i='.URLencode_path($ipath);
		}
		$_SESSION['admin_page']  = false;
		$_SESSION['admin_ipath'] = '';
	}
	//Don't load login screen when already in a valid session.
	//$_SESSION['valid'] may be false after Respond_to_POST()
	elseif ( ($page == "login") && $_SESSION['valid'] ) { $page = "index"; }
		
	elseif ( $page == "logout" ) {
		Logout();
		$message .= hsc($_['logout_msg']);
	}
	//Don't load delete or rename folder pages at webroot.
	elseif ( ($page == "deletefolder" || $page == "renamefolder") && ($ipath == "") ) {
		$page = "index";
	}
	//Don't load delete folder page if folder not empty.
	elseif ( ($page == "deletefolder") && !is_empty($ipath) ) {
		$message .= $EX.'<b>'.hsc($_['folder_del_msg']).'</b><br>';
		$page = "index";
	}
	//If page reloaded, or malicious page load...
	elseif ($page == "mcdaction" && !$VALID_POST ){
		$_POST = "";
		$page = "index";
	}
	elseif ($page == "mcdaction") {
		//There must be at least one 'file', and 'action' must = "move", "copy", or "delete"
		if     (!isset($_POST['mcdselect'] )) { $page = "index"; }
		elseif (!isset($_POST['files']) )     { $page = "index"; }
		elseif (!isset($_POST['action']))     { $page = "index"; }
		elseif ( ($_POST['action'] != "move") && ($_POST['action'] != "copy") && ($_POST['action'] != "delete") ) {
			$page = "index";
		}
	}
	//if size of $_POST > post_max_size, PHP only returns empty $_POST & $_FILE arrays.
	elseif ( ($page == "uploaded") && !$VALID_POST ) {
		$message .= $EX.'<b> '.hsc($_['upload_error_01a']).' '.ini_get('post_max_size').'</b> '.hsc($_['upload_error_01b']).'<br>';
		$page = "index";
	}
	//If editing OneFileCMS itself, show caution message.
	elseif ($filename == trim(rawurldecode($ONESCRIPT), '/')) {
		$message .= '<style>#message_box_contents {background: red;}</style>';
		$message .= '<style>#message_box          {color: white;}   </style>';
		$message .= $EX.'<b>'.hsc($_['edit_caution_01']).' '.$EX.hsc($_['edit_caution_02']).'</b><br>';
	}
}//end Verify_page_conditions() //**********************************************




function URLencode_path($path){ // don't encode the forward slashes ************
	$TS = '';  // Trailing Slash/
	if (substr($path, -1) == '/' ) { $TS = '/'; } //start with a $TS?
	$path_array = explode('/',$path);
	$path = "";
	foreach ($path_array as $level) { $path .= rawurlencode($level).'/'; }
	$path = rtrim($path,'/').$TS;  //end with $TS only if started with one
	return $path;
}//end URLencode_path($path) ***************************************************




function dir_name($path){ //****************************************************
	//Modified dirname().
	$parent = dirname($path);
	if ($parent == "." || $parent == "/" || $parent == '\\') { return ""; }
	return $parent.'/';
}//end dir_name() //************************************************************




function has_invalid_char($string) { //*****************************************
	global $INVALID_CHARS, $INVALID_CHARS_array;
	foreach ($INVALID_CHARS_array as $bad_char) {
		if (strpos($string, $bad_char) !== false) { return $bad_char; }
	}
	return false;
}//end has_invalid_char() //****************************************************




function Check_path($path, $show_msg = false) { //******************************
	// check for invalid characters & "dot dot" segments.
	global  $_, $WEB_ROOT, $message, $EX, $INVALID_CHARS;

	$path = str_replace('\\','/',$path);   //Make sure all forward slashes.
	$path = trim($path,"\x00..\x20/");     // trim whitespace & slashes

	if (strlen($path) < 1) { return ""; } // At root.

	$err_msg = "";
	$errors  = 0;

	$pathparts = explode( '/', $path);

	foreach ($pathparts as $part) {
		
		//Check for any '.' and '..' parts of the path to protect directories outside webroot.
		//They also cause issues in <h2>www / current / path /</h2>
		if ( ($part == '.') || ($part == '..') ) {
			$err_msg .= $EX.' <b>'.$_['check_path_msg_02'].'</b><br>';
			$errors++;
			break;
		}
		
		//Check for invalid characters
		$invalid_chars = str_replace(' /','',$INVALID_CHARS); //The forward slash is not present in this context.
		if ( has_invalid_char($part) ) {
			$err_msg .= $EX.' <b>'.$_['check_path_msg_03'].' <span class="mono">'.$invalid_chars.'</span></b><br>';
			$errors++;
			break;
		}
	}

	if ($errors > 0) {
		if ($show_msg) { $message .= $err_msg; }
		return false;
	}

	return $path.'/';
}//end Check_path() ************************************************************




function is_empty($path){ //****************************************************
	if ($path == "") {$path = '.';}
	$empty = false;
	$dh = opendir($path);
	for($i = 3; $i; $i--) { $empty = (readdir($dh) === FALSE); }
	closedir($dh);
	return $empty;
}//end is_empty() //************************************************************




function ordinalize($destination,$filename, &$msg) { //*************************
//if file_exists(file.txt), ordinalize filename until it doesn't
//ie: file.txt.001,  file.txt.002, file.txt.003  etc...
	global $_, $EX;

	$ordinal   = 0;
	$savefile = $destination.$filename;

	if (file_exists($savefile)) {

		$msg .= $EX.hsc($_['ord_msg_01']).'<br>';

		while (file_exists($savefile)) {
			$ordinal = sprintf("%03d", ++$ordinal); //  001, 002, 003, etc...
			$savefile = $destination.$filename.'.'.$ordinal;
		}
		$msg .= '<b>'.hsc($_['ord_msg_02']).':</b> <span class="filename">'.hte(basename($savefile)).'</span>';
	}
	return $savefile;
}//end ordinalize() filename ***************************************************




function supports_svg() { //****************************************************
	//IE < 9 is the only browser checked for currently.
	//EX: Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0)
	$USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
	$pos_MSIE   = strpos($USER_AGENT, 'MSIE ');
	$old_ie     = false;
	if ($pos_MSIE !== false) {
		$ie_ver = substr($USER_AGENT, ($pos_MSIE+5), 1);
		$old_ie = ( $ie_ver < 9 );
	}
	return !$old_ie;
}//end supports_svg ************************************************************




function Current_Path_Header(){ //**********************************************
 	// Current path. ie: webroot/current/path/
	// Each level is a link to that level.

	global $ONESCRIPT, $ipath, $WEB_ROOT;

	echo '<h2>';
		//Root folder of web site.
		echo '<a id="path_0" href="'.$ONESCRIPT.'" class="path"> '.hte(trim($WEB_ROOT, '/')).'</a>/';
		$x=0; //need here for focus() in case at webroot.
		
		if ($ipath != "" ) { //if not at root, show the rest
			$path_levels  = explode("/",trim($ipath,'/') );
			$levels = count($path_levels); //If levels=3, indexes = 0, 1, 2  etc...
			$current_path = "";
			
			for ($x=0; $x < $levels; $x++) {
				$current_path .= $path_levels[$x].'/';
				echo '<a id="path_'.($x+1).'" href="'.$ONESCRIPT.'?i='.URLencode_path($current_path).'" class="path">';
				echo hte($path_levels[$x]).'</a>/';
			}
		}//end if (not at root)
	echo '</h2>';
	echo '<script>document.getElementById("path_'.$x.'").focus();</script>';
}//end Current_Path_Header() //*************************************************




function Page_Header(){ //******************************************************
	global  $_, $DOC_ROOT, $ONESCRIPT, $page, $WEBSITE, $config_title, $OFCMS_version, $config_favicon, $message;

	$favicon = '';
	if (file_exists($DOC_ROOT.trim($config_favicon,'/'))) {
		$favicon =  '<img src="/'.URLencode_path($config_favicon).'" alt="">';
	}
?>
	<div class="header">
		<a href="<?php echo $ONESCRIPT?>" id="logo"><?php echo $config_title; ?></a>
		<?php echo $OFCMS_version.' ('.hsc($_['on']).'&nbsp;php&nbsp;'.phpversion().')'; ?>

		<div class="nav">
			<a href="/" target="_blank"><?php echo $favicon ?>&nbsp;
			<b><?php echo hte($WEBSITE) ?></b></a>
			<?php if ($page != "login") { ?>
			| <a href="<?php echo $ONESCRIPT ?>?p=logout"><?php echo hsc($_['Log_Out']) ?></a>
			<?php } ?>
		</div><div class=clear></div>
	</div><!-- end header -->
<?php
}//end Page_Header(){ **********************************************************




function message_box() { //*****************************************************
	global $ONESCRIPT, $param1, $param2, $param3, $message, $page;

	$href    = $ONESCRIPT.$param1.$param2.$param3;
	$onclick = 'document.getElementById("message_box").innerHTML = " ";return false;';
	$X_box   =  '<a id="X_box" href="'.$href.'" onclick=\''.$onclick.'\'>x</a>';
	
	if (isset($message) && (strlen($message) > 0)) {
?>
		<div id="message_box"><!--===============================-->
			<?php echo $X_box ?>
			<div id="message_box_contents"><?php echo $message ?></div>
		</div><!--End message_box-===============================-->

		<script>document.getElementById("X_box").focus();</script>
<?php
	}else { // Needed on some pages to keep js feedback from failing
		echo '<div id="message_box"></div>';
	} //end isset($message)

}//end message_box()  **********************************************************




function Upload_New_Rename_Delete_Links() { //**********************************
	global $_, $ONESCRIPT, $ipath, $param1;
	echo '<p class="front_links">';
	echo '<a href="'.$ONESCRIPT.$param1.'&amp;p=upload">'   .svg_icon_upload()    .hsc($_['Upload_File']).'</a>';
	echo '<a href="'.$ONESCRIPT.$param1.'&amp;p=newfile">'  .svg_icon_file_new()  .hsc($_['New_File'])   .'</a>';
	echo '<a href="'.$ONESCRIPT.$param1.'&amp;p=newfolder">'.svg_icon_folder_new().hsc($_['New_Folder']) .'</a>';
	if ($ipath !== "") { //if at root, don't show Rename & Delete links
		echo '<a href="'.$ONESCRIPT.$param1.'&amp;p=renamefolder">'.svg_icon_folder_ren().hsc($_['Ren_Folder']).'</a>';
		echo '<a href="'.$ONESCRIPT.$param1.'&amp;p=deletefolder">'.svg_icon_folder_del().hsc($_['Del_Folder']).'</a>';
	}
	echo '</p>';
}//end Upload_New_Rename_Delete_Links()  ***************************************




function Cancel_Submit_Buttons($submit_label, $focus) { //**********************
	//$submit_label = Rename, Copy, Delete, etc...
	//$focus is ID of element to receive focus(). (element may be outside this function)
	global $_, $ONESCRIPT, $ONESCRIPT_url_backup, $ipath, $param1, $param2, $filename, $page;

	$params = $param1.$param2.'&amp;p='. $_SESSION['recent_pages'][1];
?>
	<p>
	<input type="button" class="button" id="cancel" value="<?php echo hsc($_['Cancel']) ?>"
		onclick="parent.location = '<?php echo $ONESCRIPT.$params ?>'">
	<input type="submit" class="button" value="<?php echo $submit_label;?>" style="margin-left: 1em;">
<?php
	if ($focus != ""){ echo '<script>document.getElementById("'.$focus.'").focus();</script>'; }

	//Do not close the <p> tag yet/here. Leave it open for potential content on individual pages.
}// End Cancel_Submit_Buttons() //**********************************************




function show_image(){ //*******************************************************
	global $_, $filename, $MAX_IMG_W, $MAX_IMG_H;
	
	$IMG = $filename;
	$img_info = getimagesize($IMG);

	$W=0; $H=1; //indexes for $img_info[]
	$SCALE = 1; $SCALE_W = 1; $SCALE_H = 1;
	if ($img_info[$W] > $MAX_IMG_W) { $SCALE_W = ( $MAX_IMG_W/$img_info[$W] );}
	if ($img_info[$H] > $MAX_IMG_H) { $SCALE_H = ( $MAX_IMG_H/$img_info[$H] );}
	
	//Set $SCALE to the more restrictive scale.
	if   ( $SCALE_W > $SCALE_H ) { $SCALE = $SCALE_H; } //ex: if (.90 > .50)
	else                         { $SCALE = $SCALE_W; } //If _H >= _W, or both are 1

	//For languages with longer words that don't fit next to [Wide] & [Close] buttons.
	if ($_['image_info_pos']){ echo '<div class=clear></div>'.PHP_EOL; }

	echo '<p class="image_info">';
	echo hsc($_['show_img_msg_01']).round($SCALE*100).
		 hsc($_['show_img_msg_02']).' '.$img_info[0].' x '.$img_info[1].').</p>';
	echo '<div class=clear></div>'.PHP_EOL;
	echo '<a href="/' .URLencode_path($IMG). '" target="_blank">'.PHP_EOL;
	echo '<img src="/'.URLencode_path($IMG).'"  height="'.($img_info[$H] * $SCALE).'"></a>'.PHP_EOL;
}// end show_image() ***********************************************************




function Timeout_Timer($COUNT, $ID, $CLASS="", $ACTION="") { //*****************

	return 	'<script>'.
			'Start_Countdown('.$COUNT.', "'.$ID.'", "'.$CLASS.'", "'.$ACTION.'");'.
			'</script>';

} //end Timeout_Timer() ********************************************************




function Init_Macros(){ //*** ($varibale="some reusable chunk of code")*********

global 	$_, $ONESCRIPT, $param1, $param2, $INPUT_NUONCE, $FORM_COMMON, $PWUN_RULES,
		$SVG_icon_circle_plus, $SVG_icon_circle_x, $SVG_icon_pencil, $SVG_icon_img_0,
		$SVG_icon_circle_plus_rev;

$INPUT_NUONCE = '<input type="hidden" name="nuonce" value="'.$_SESSION['nuonce'].'">'.PHP_EOL;
$FORM_COMMON = '<form method="post" action="'.$ONESCRIPT.$param1.$param2.'">'.$INPUT_NUONCE;

$PWUN_RULES  = '<p>'.hsc($_['pw_txt_02']).'<ol><li>'.hsc($_['pw_txt_04']).'<li>'.hsc($_['pw_txt_06']);
$PWUN_RULES .= '<li>'.hsc($_['pw_txt_08']).'<li>'.hsc($_['pw_txt_10']).'</ol>';

$SVG_icon_circle_plus = '<circle cx="5" cy="5" r="5" stroke="black" stroke-width="0" fill="#080"/>
	  <line x1="2" y1="5" x2="8" y2="5" stroke="white" stroke-width="1.5" />
	  <line x1="5" y1="2" x2="5" y2="8" stroke="white" stroke-width="1.5" />';

$SVG_icon_circle_plus_rev = '<circle cx="5" cy="5" r="5" stroke="#080" stroke-width="1.3" fill="white"/>
	  <line x1="2" y1="5" x2="8" y2="5" stroke="#080" stroke-width="1.5" />
	  <line x1="5" y1="2" x2="5" y2="8" stroke="#080" stroke-width="1.5" />';

$SVG_icon_circle_x = '<circle cx="5" cy="5" r="5" stroke="black" stroke-width="0" fill="#D00"/>
	<line x1="2.5" y1="2.5" x2="7.5" y2="7.5" stroke="white" stroke-width="1.5"/>
	<line x1="7.5" y1="2.5" x2="2.5" y2="7.5" stroke="white" stroke-width="1.5"/>';

$SVG_icon_pencil = '<polygon points="2,0 9,7 7,9 0,2" stroke-width="1" stroke="darkgoldenrod" fill="rgb(246,222,100)"/>
	  <path  d="M0,2   L0,0  L2,0"      stroke="tan" fill="tan" stroke-width="1" />
	  <path  d="M0,1.5   L0,0  L1.5,0"      stroke="black" fill="transparent" stroke-width="1.5" />
	  <line x1="7.3" y1="10"  x2="10" y2="7.3"  stroke="silver" stroke-width="1"/>
	  <line x1="8.1" y1="10.8"  x2="10.8" y2="8.1"  stroke="red" stroke-width="1"/>';

$SVG_icon_img_0 = '<rect x="0"    y="0"   width="14" height="16" fill="#FF8" stroke="#44F" stroke-width="2" />
	<rect x="2"    y="2"   width="5"  height="5"  fill="#F66" stroke-width="0" />
	<rect x="7.5"  y="6"   width="5"  height="5"  fill="#6F6" stroke-width="0" />
	<rect x="2"    y="10"  width="5"  height="5"  fill="#66F" stroke-width="0" />';
}//end Init_Macros() ***********************************************************




function svg_icon_ren(){ //*****************************************************
	global $SVG_icon_pencil;
	
	$pencil = '<g transform="translate( 5, 3.5)">'.$SVG_icon_pencil.'</g>';
	$sheet  = svg_icon_txt_0('#333', '#000', '#FFF', $pencil);
	
	return '<svg class="icon2" xmlns="http://www.w3.org/2000/svg" version="1.1" width="16" height="16">'.$sheet.$pencil.'</svg>';
} //end svg_icon_ren() *********************************************************




function svg_icon_copy(){ //****************************************************
	global $SVG_icon_circle_plus_rev;

	return '<svg class="icon2" xmlns="http://www.w3.org/2000/svg" version="1.1" width="12" height="12">'.
		'<g transform="translate( 1, 1)">'.$SVG_icon_circle_plus_rev.'</g></svg>';

} //end svg_icon_copy() ********************************************************




function svg_icon_del(){ //*****************************************************
	global $SVG_icon_circle_x;

	return '<svg class="icon2" xmlns="http://www.w3.org/2000/svg" version="1.1" width="11" height="11">'.
		'<g transform="translate( .5, .5)">'.$SVG_icon_circle_x.'</g></svg>';

} //end svg_icon_del() *********************************************************




function svg_icon_bin(){ //*****************************************************
$zero = '<rect x="0"  y="0"  width="3" height="6" fill="transparent" stroke="#555" stroke-width="1" />';
$one  = '<line x1="0" y1="-.5"   x2="0" y2="6.5"  stroke="#555" stroke-width="1"/>';

return '<svg class="icon" xmlns="http://www.w3.org/2000/svg" version="1.1" width="14" height="16">
		<g transform="translate( 0.5,0.5)">'.$one .'</g>
		<g transform="translate( 3.5,0.5)">'.$zero.'</g>
		<g transform="translate( 9.5,0.5)">'.$one .'</g>
		<g transform="translate(12.5,0.5)">'.$one .'</g>
		<g transform="translate( 0.5,9.5)">'.$zero.'</g>
		<g transform="translate( 6.5,9.5)">'.$one .'</g>
		<g transform="translate( 9.5,9.5)">'.$zero.'</g>
		</svg>';
} //end svg_icon_bin() *********************************************************



function svg_icon_img(){ //*****************************************************
	global $SVG_icon_img_0;
	return '<svg class="icon icon_file" xmlns="http://www.w3.org/2000/svg" version="1.1" width="14" height="16">'.
		$SVG_icon_img_0.'</svg>';
} //end svg_icon_img() *********************************************************



function svg_icon_svg(){ //*****************************************************
	global $SVG_icon_img_0;
	return '<svg class="icon icon_file" xmlns="http://www.w3.org/2000/svg" version="1.1" width="14" height="16">'.
	$SVG_icon_img_0.
	'<line x1="3" y1="3.5"  x2="11" y2="3.5"  stroke="#444" stroke-width=".6"/>
	<line x1="3" y1="6.5"  x2="11" y2="6.5"  stroke="#444" stroke-width=".6"/>
	<line x1="3" y1="9.5"  x2="11" y2="9.5"  stroke="#444" stroke-width=".6"/>
	<line x1="3" y1="12.5" x2="11" y2="12.5" stroke="#444" stroke-width=".6"/>
	</svg>';
} //end svg_icon_img() *********************************************************



function svg_icon_txt_0($border, $lines, $fill, $extra = ""){ //****************
return '<svg class="icon icon_file" xmlns="http://www.w3.org/2000/svg" version="1.1" width="14" height="16">
	<rect x = "0" y = "0" width = "14" height = "16" fill="'.$fill.'" stroke="'.$border.'" stroke-width="2" />
	<line x1="3" y1="3.5"  x2="11" y2="3.5"  stroke="'.$lines.'" stroke-width=".6"/>
	<line x1="3" y1="6.5"  x2="11" y2="6.5"  stroke="'.$lines.'" stroke-width=".6"/>
	<line x1="3" y1="9.5"  x2="11" y2="9.5"  stroke="'.$lines.'" stroke-width=".6"/>
	<line x1="3" y1="12.5" x2="11" y2="12.5" stroke="'.$lines.'" stroke-width=".6"/>'.$extra.'</svg>';
} //end svg_icon_txt_0() *******************************************************



function svg_icon_txt(){ return svg_icon_txt_0('#333', '#000', '#FFF'); } //****

function svg_icon_htm(){ return svg_icon_txt_0('#444', '#222', '#FABEAA'); } //* rgb(250,190,170)

function svg_icon_php(){ return svg_icon_txt_0('#333', '#111', '#C3C3FF'); } //* rgb(195,195,225)

function svg_icon_css(){ return svg_icon_txt_0('#333', '#111', '#FFE1A5'); } //* rgb(255,225,165)

function svg_icon_cfg(){ return svg_icon_txt_0('#444', '#111', '#DDD'); } //****



function svg_icon_upload(){ //**************************************************
	$extra = '<g transform="scale(1.1) translate(1.75,4)">
		<polygon points="6,0  12,6  8,6  8,11  4,11  4,6  0,6"
		stroke-width="1" stroke="white" fill="green" /></g>'; //up arrow

	return svg_icon_txt_0('#333', 'black', 'white', $extra);
} //end svg_icon_upload() ******************************************************



function svg_icon_file_new(){ //************************************************
	global $SVG_icon_circle_plus;
	$extra = '<g transform="translate(4,6)">'.$SVG_icon_circle_plus.'</g>';

	return svg_icon_txt_0('#444', 'black', 'white', $extra);
} //end svg_icon_file_new() ****************************************************



function svg_icon_file_del(){ //************************************************
	global $SVG_icon_circle_x;
	$extra = '<g transform="translate(4,6)">'.$SVG_icon_circle_x.'</g>';

	return svg_icon_txt_0('#444', 'black', 'white', $extra);
} //end svg_icon_file_del() ****************************************************



function svg_icon_folder_0($extra = ""){ //*************************************

 return '<svg class="icon icon_fldr" xmlns="http://www.w3.org/2000/svg" version="1.1" width="18" height="14">
	<path  d="M0.5, 1  L8,1  L9,2  L9,3  L16.5,3  L17,3.5  L17,13.5  L.5,13.5  L.5,.5"
			fill="#FBE47b" stroke="#F0CD28" stroke-width="1" />
	<path  d="M1.5, 8  L7, 8  L8.5,6.3  L16,6.3  L7.5, 6.3   L6.5,7.5  L1.5,7.5"
			fill="transparent" stroke="white" stroke-width="1" />
	<path  d="M1.5,13  L1.5,2  L7.5,2  L8.5,3  L8.5,4  L15.5,4 L16,4.5  L16,13"
			fill="transparent" stroke="white" stroke-width="1" />'.
	$extra.'
	</svg>';

} //end svg_icon_folder_0() ****************************************************



function svg_icon_folder(){ return svg_icon_folder_0(''); } //******************



function svg_icon_folder_new(){ //**********************************************
	global $SVG_icon_circle_plus;
	$extra = '<g transform="translate(7.5,4)">'.$SVG_icon_circle_plus.'</g>';
	return svg_icon_folder_0($extra);
} //end svg_icon_folder_new() **************************************************



function svg_icon_folder_ren(){ //**********************************************
	global $SVG_icon_pencil;
	$extra = '<g transform="translate(6,3)">'.$SVG_icon_pencil.'</g>';
	return svg_icon_folder_0($extra);
} //end svg_icon_folder_ren() **************************************************



function svg_icon_folder_del(){ //**********************************************
	global $SVG_icon_circle_x;
	$extra = '<g transform="translate(7.5,4)">'.$SVG_icon_circle_x.'</g>';
	return svg_icon_folder_0($extra);
} //end svg_icon_folder_del() **************************************************




function show_icon($type){ //***************************************************
	if     ($type == 'bin') { return svg_icon_bin(); }
	elseif ($type == 'img') { return svg_icon_img(); }
	elseif ($type == 'svg') { return svg_icon_svg(); }
	elseif ($type == 'txt') { return svg_icon_txt(); }
	elseif ($type == 'htm') { return svg_icon_htm(); }
	elseif ($type == 'php') { return svg_icon_php(); }
	elseif ($type == 'css') { return svg_icon_css(); }
	elseif ($type == 'cfg') { return svg_icon_cfg(); }
	else                    { return svg_icon_bin(); } //default
}//end show_icon() *************************************************************




function List_Backup($file, $file_url){ //**************************************
	global $_, $ONESCRIPT;

		clearstatcache ();
		$href = $ONESCRIPT.'?i='.dir_name($file_url).'&amp;f='.basename($file_url);
?>
		<table class="index_T old_backup_T"><tr>
		<td class="file_name">
			<?php echo '<a href="'.$href.'&amp;p=edit'.'" id="old_backup">'.basename($file_url); ?></a>
		</td>
		<td class="meta_T file_size">&nbsp;
			<?php echo number_format(filesize($file)); ?> B
		</td>
		<td class="meta_T file_time"> &nbsp;
			<script>FileTimeStamp(<?php echo filemtime($file); ?>, 1, 0);</script>
		</td>
		</tr></table>

		<script>document.getElementById("old_backup").focus();</script>
		<a href="<?php echo $href.'&amp;p=delete' ?>" class="button" id="del_backup"><?php echo hsc($_['Delete']) ?></a>
		<div style="clear: both"></div>
<?php
}//end List_Backup() ***********************************************************




function Admin_Page() { //******************************************************
	global $_, $WEB_ROOT, $ONESCRIPT, $ONESCRIPT_url_backup, $ONESCRIPT_file_backup, $CONFIG_url_backup,
		   $ipath, $filename, $param1, $param2, $EX, $config_title,  $CONFIG_file_backup;

	// Restore/Preserve $ipath prior to admin page in case OneFileCMS is edited (which would change $ipath).
	if   ( $_SESSION['admin_page'] ) { $ipath  = $_SESSION['admin_ipath'];
									   $param1 = '?i='.URLencode_path($ipath); }
	else { $_SESSION['admin_page']  = true;
		   $_SESSION['admin_ipath'] = $ipath; }
	
	// [Close] returns to either the index or edit page.
	$params = "";
	if ($filename != "") { $params = $param2.'&amp;p=edit'; }

	$edit_params = '?i='.dir_name($ONESCRIPT).'&amp;f='.(basename($ONESCRIPT)).'&amp;p=edit';
?>
	<h2><?php echo hsc($_['Admin_Options']) ?></h2>

	<span class="admin_buttons">
	<input type="button" class="button" id="cancel"    value="<?php echo hsc($_['Close']) ?>"
		onclick="parent.location = '<?php echo $ONESCRIPT.$param1.$params ?>'">

	<input type="button" class="button" id="changepw" value="<?php echo hsc($_['pw_change']) ?>"
		onclick="parent.location = '<?php echo $ONESCRIPT.$param1.'&amp;p=changepw' ?>'">

	<input type="button" class="button" id="changeun" value="<?php echo hsc($_['un_change']) ?>"
		onclick="parent.location = '<?php echo $ONESCRIPT.$param1.'&amp;p=changeun' ?>'">

	<input type="button" class="button" id="hash"      value="<?php echo hsc($_['Generate_Hash']) ?>"
		onclick="parent.location = '<?php echo $ONESCRIPT.$param1.'&amp;p=hash' ?>'">

	<input type="button" class="button" id="editOFCMS" value="<?php echo hsc($_['Edit'].' '.$config_title) ?>"
		onclick="parent.location = '<?php echo $ONESCRIPT.$edit_params ?>'">
	</span>

	<div class="info">

	<?php //Check for & indicate if backups exists from a prior p/w or u/n change.
	if (is_file($ONESCRIPT_file_backup) || is_file($CONFIG_file_backup) ) {
		clearstatcache ();
		
		echo '<p><b>'.hsc($_['admin_txt_00']).'</b></p>';
		
		if (is_file($ONESCRIPT_file_backup)) { List_Backup($ONESCRIPT_file_backup, $ONESCRIPT_url_backup); }

		if (is_file($CONFIG_file_backup))    { List_Backup($CONFIG_file_backup, $CONFIG_url_backup); }
		
		echo '<p>'.hsc($_['admin_txt_01']);
		
		echo '<hr>';
		
	}else {
		echo '<script>document.getElementById("cancel").focus();</script>';
	}//end of check for backup
	?>
		
	<p><b><?php echo hsc($_['admin_txt_02']) ?></b>
	<p><?php echo hsc($_['admin_txt_04']) ?>
	<p><?php echo hsc($_['admin_txt_12']) ?>
	<p><?php echo hsc($_['admin_txt_14']) ?>
	<p><?php echo hsc($_['admin_txt_16']) ?>
	</div>
<?php
}//end Admin_Page() ************************************************************




function Hash_Page() { //*******************************************************
	global $_, $ONESCRIPT, $param1, $param3, $INPUT_NUONCE, $PWUN_RULES;

	if (!isset($_POST['whattohash'])) { $_POST['whattohash'] = ''; }
?>
	<style>#message_box {font-family: courier; min-height: 3.1em;}</style>

	<h2><?php echo hsc($_['Generate_Hash']) ?></h2>
	
	<form id="hash" name="hash" method="post" action="<?php echo $ONESCRIPT.$param1.$param3; ?>">
		<?php echo $INPUT_NUONCE; ?>
		<?php echo hsc($_['pass_to_hash']) ?>
		<input type="text" name="whattohash" id="whattohash" value="<?php echo hsc($_POST["whattohash"]) ?>">
		<?php Cancel_Submit_Buttons(hsc($_['Generate_Hash']), 'whattohash') ?>
	</form>

	<div class="info">
 	<p><?php echo hsc($_['hash_txt_01']) ?><br>
	<ol><li><?php echo hsc($_['hash_txt_06']) ?><br>
			<?php echo hsc($_['hash_txt_07']) ?>
		<li><?php echo hsc($_['hash_txt_08']) ?><br>
			<?php echo hsc($_['hash_txt_09']) ?><br>
			<?php echo hsc($_['hash_txt_10']) ?><br>
		<li><?php echo hsc($_['hash_txt_12']) ?>
	</ol>
	
	<?php echo $PWUN_RULES ?>
	</div>
<?php
} //end Hash_Page() ************************************************************




function Hash_response() { //***************************************************
	global $_, $message;
	$_POST['whattohash'] = trim($_POST['whattohash']); // trim whitespace.

	//Ignore/don't hash empty string - passwords can't be blank.
	if ($_POST['whattohash'] == "") { return; }

	$message .= hsc($_['Password']).': '.hsc($_POST['whattohash']).'<br>';
	$message .= hsc($_['Hash']).': '.hashit($_POST["whattohash"]).'<br>';
} //end Hash_response() ********************************************************




function Change_PWUN_Page($config_key) { //*************************************
	// $config_key must= "pw" or "un"
	global $_, $EX, $ONESCRIPT, $param1, $param3, $INPUT_NUONCE, $config_title, $PWUN_RULES;
	
	if ($config_key == "pw") {
		$type = "password";
		$page_title    = $_['pw_change'];
		$label_new     = $_['pw_new'];
		$label_confirm = $_['pw_confirm'];
	}elseif ($config_key == "un"){
		$type = "text";
		$page_title    = $_['un_change'];
		$label_new     = $_['un_new'];
		$label_confirm = $_['un_confirm'];
	}
?>
	<style></style>

	<h2><?php echo hsc($page_title) ?></h2>
	
	<form id="change" name="<?php echo $config_key ?>" method="post" action="<?php echo $ONESCRIPT.$param1.$param3; ?>">
		<input type="hidden" name="<?php echo $config_key ?>" value="">
		
		<?php echo $INPUT_NUONCE; ?>
		
		<?php echo hsc($_['pw_current']) ?><br>
		<input type="password" name="current_pw" id="current_pw" value="">
		
		<?php echo hsc($label_new) ?><br>
		<input type="<?php echo $type ?>" name="new1" id="new1" value="">
		
		<?php echo hsc($label_confirm) ?><br>
		<input type="<?php echo $type ?>" name="new2" id="new2" value="">
		
		<?php Cancel_Submit_Buttons(hsc($_['Submit']), 'current_pw') ?>
	</form>

	<div class="info">
	<?php echo $PWUN_RULES ?>
	<p><?php echo hsc($_['pw_txt_12']) ?>
	<p><?php echo hsc($_['pw_txt_14']) ?>
	</div>
<?php
} //end Change_PWUN_Page() *****************************************************




//******************************************************************************
function Update_config($search_for, $replace_with, $search_file, $backup_file) {
	global  $_, $HASHWORD, $ONESCRIPT_file, $ONESCRIPT_file_backup, $EX, $message;

	if ( !is_file($search_file) ) {
		$message .= $EX.' <b>'.$_['Not_found'].': </b>'.$search_file.'<br>';
		return false;
	}

	$search_contents = file_get_contents($search_file);
	//Convert any CR+NL to only newline.
	$search_contents = str_replace("\r\n", "\n", $search_contents);
	$search_contents = str_replace("\r"  , "\n", $search_contents);
	$search_lines = explode("\n", "".$search_contents);

	//Search start of each $line in (array)$search_lines for (string)$search_for.
	//If match found, replace $line with $replace_with, end search.
	$search_len = strlen($search_for);
	$found = false;
	foreach ($search_lines as $key => $line) {
		if ( substr($line,0,$search_len) == $search_for ) {
			$found = true;
			$search_lines[$key] = $replace_with;
			break 1; //only replace first occurrance of $search_for
		}
	}

	//As of 3.3.18, this should never happen- you'd be logged out first.
	if (!$found){ $message .= $EX.' <b>'.$_['Not_found'].': '.$search_for.'<br>'; return false; }
	
	copy($search_file, $backup_file); // Just in case...

	$updated_contents = implode("\n", $search_lines);

	return file_put_contents($search_file, $updated_contents);
}//end Update_config() *********************************************************




function Change_PWUN_response($PWUN, $msg){ //**********************************
	//Update $USERNAME or $HASHWORD. Default $page = changepw or changeun
	global $_, $ONESCRIPT, $USERNAME, $HASHWORD, $EX, $message, $page, $config_file,
		   $ONESCRIPT_file, $ONESCRIPT_file_backup, $CONFIG_file, $CONFIG_file_backup;

	// trim white-space from input values
	$current_pass = trim($_POST['current_pw']);
	$new_pwun     = trim($_POST['new1']);
	$confirm_pwun = trim($_POST['new2']);

	$error_msg   = $EX.'<b>'.hsc($msg).'</b> ';

	//If nothing entered...
	if ( ($current_pass == "") && ($new_pwun == "") && ($confirm_pwun == "") ) {
		;//do nothing.
		
	//If no new & confirm values entered, display $message to that effect.
	}elseif ( ($new_pwun == "") && ($confirm_pwun == "") ) {
		$message .= $error_msg.hsc($_['pw_txt_06']).'<br>';
		
	//If new & Confirm values don't match, display $message to that effect.
	}elseif ($new_pwun != $confirm_pwun) {
		$message .= $error_msg.hsc($_['change_pw_04']).'<br>';
		
	//If incorrect current p/w, logout.  (new == confirm at this point)
	}elseif (hashit($current_pass) != $HASHWORD) {
		$message .= $error_msg.'<br>'.hsc($_['change_pw_03']).'<br>';
		Logout();
		
	//Else change username or password
	}else {
		if ($PWUN == "pw") {
			$search_for  = '$HASHWORD '; //include space after $HASHWORD
			$success_msg = '<b>'.hsc($_['change_pw_01']).'</b>';
			$HASHWORD = hashit($new_pwun);
			$replace_with = '$HASHWORD = "'.$HASHWORD.'";';
		}else { //$PWUN = "un"
			$USERNAME = $new_pwun;
			$search_for  = '$USERNAME '; //include space after $USERNAME
			$success_msg = '<b>'.hsc($_['change_un_01']).'</b>';
			$replace_with = '$USERNAME = "'.$USERNAME.'";';
		}
		
		//If specified & it exists, update external config file.
		//$config_file, lowercase name, is the user supplied config value, relative to $ONESCRIPT.
		//$CONFIG_file, uppercase name, includes full filesystem path.
		if ( isset($config_file) && is_file($CONFIG_file) ) {
			$message .= $_['change_pw_05'].' '.$_['change_pw_06'].'. . . ';
			$updated = Update_config($search_for, $replace_with, $CONFIG_file, $CONFIG_file_backup);
		}else{ //Update OneFileCMS
			$message .= $_['change_pw_05'].' OneFileCMS . . . ';
			$updated = Update_config($search_for, $replace_with, $ONESCRIPT_file, $ONESCRIPT_file_backup);
		}
		
		if ($updated === false) { $message .= $error_msg.hsc($_['update_failed']).'<br>'; }
		else                    { $message .= $success_msg.'<br>'; }
		
		$page = "admin"; //Return to Admin page.
	}
}//end Change_PWUN_response() //************************************************




function Logout() { //**********************************************************
	global $page;
	session_regenerate_id(true);
	session_unset();
	session_destroy();
	session_write_close();
	unset($_GET);
	unset($_POST);
	$_SESSION['valid'] = 0;
	$page = 'login';
}//end Logout() ****************************************************************




function Login_Page() { //******************************************************
	global $_, $ONESCRIPT;
?>
	<h2><?php echo hsc($_['Log_In']) ?></h2>
	<form method="post" action="<?php echo $ONESCRIPT; ?>">
		<label for="username"><?php echo hsc($_['login_txt_01']) ?></label>
		<input type="text" name="username" id="username" class="login_input" >
		<label for="password"><?php echo hsc($_['login_txt_02']) ?></label>
		<input type="password" name="password" id="password" class="login_input">
		<input type="submit" class="button" value="<?php echo hsc($_['Enter']) ?>">
	</form>
	<script>document.getElementById('username').focus();</script>
<?php
} //end Login_Page() ***********************************************************




function Login_response() { //**************************************************
	global $_, $EX, $message, $page, $LOGIN_ATTEMPTS, $MAX_ATTEMPTS, $LOGIN_DELAY, $USERNAME, $HASHWORD;

	$_SESSION = array();    //make sure it's empty
	$_SESSION['valid'] = 0; //Default to failed login.
	$attempts = 0;
	$elapsed  = 0;

	//Check for prior failed attempts
	if (is_file($LOGIN_ATTEMPTS)) {
		$attempts = (int)file_get_contents($LOGIN_ATTEMPTS); //Don't increment yet...
		$elapsed  = time() - filemtime($LOGIN_ATTEMPTS);
	}
	if ($attempts > 0) { $message .= '<b>'.hsc($_['login_msg_01a']).' '.$attempts.' '.hsc($_['login_msg_01b']).'</b><br>'; }

	if ( ($attempts >= $MAX_ATTEMPTS) && ($elapsed < $LOGIN_DELAY) ){
		$message .= hsc($_['login_msg_02a']).' ';
		$message .= Timeout_Timer(($LOGIN_DELAY - $elapsed), 'timer0');
		$message .= ' '.hsc($_['login_msg_02b']);
		return;
	}

	//Trim any incidental whitespace before validating.
	$_POST['password'] = trim($_POST['password']);
	$_POST['username'] = trim($_POST['username']);

	//Validate password
	$VALID_PASSWORD = (hashit($_POST['password']) == $HASHWORD);

	//validate login.
	if ( ($_POST['password'] == "") || ($_POST['username'] == "") )  {
		; //Ignore attempt if either username OR password is blank.
	}elseif ( $VALID_PASSWORD && ($_POST['username'] == $USERNAME) ) {
		session_regenerate_id(true);
		$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT']; //for user consistancy check.
		$_SESSION['valid'] = 1;
		$page = "index";
		if ( is_file($LOGIN_ATTEMPTS) ) { unlink($LOGIN_ATTEMPTS); } //delete invalid attempts count file
	}else{
		file_put_contents($LOGIN_ATTEMPTS, ++$attempts); //increment & save attempt
		$message  = $EX.'<b>'.hsc($_['login_msg_03']).$attempts.'</b><br>';
		if ($attempts >= $MAX_ATTEMPTS) {
			$message .= hsc($_['login_msg_02a']).' ';
			$message .= Timeout_Timer($LOGIN_DELAY, 'timer0', '', '');
			$message .= ' '.hsc($_['login_msg_02b']);
		}
	}
}//end Login_response() //******************************************************




function Table_of_Files($files, $R, $C, $D) { //********************************
	global $_, $ONESCRIPT, $ipath, $param1, $ftypes, $fclasses, $excluded_list, $stypes, $SHOWALLFILES;

	echo '<table class="index_T">';

	$X = 1; //index for list of checkboxes;
	foreach ($files as $file) {
		
		$excluded = FALSE;
		if (in_array(basename($file), $excluded_list)) { $excluded = TRUE; };
		
		//Get file type & check against $stypes (files types to show)
		$filename_parts = explode(".", strtolower($file));
		$ext = end($filename_parts);
		if ($SHOWALLFILES || in_array($ext, $stypes)) { $SHOWTYPE = TRUE; } else { $SHOWTYPE = FALSE; }
		
		//Used to not show rename & delete options for active copy of OneFileCMS.
		$IS_OFCMS = false;
		if ( $ipath.$file == trim(rawurldecode($ONESCRIPT), '/') ) { $IS_OFCMS = true;  }
		
		if ( $SHOWTYPE && !is_dir($ipath.$file) && !$excluded ) {
			
			//Set icon type based on file type ($ext).
			$type = $fclasses[array_search($ext, $ftypes)];
			
			$HREF_params = $ONESCRIPT.$param1.'&amp;f='.rawurlencode($file);
?>
			<tr>
				<td class="rcd">
				<?php if (!$IS_OFCMS){
					  echo '<a href="'.$HREF_params.'&amp;p=rename" title="'.hsc($_['Ren_Move']).'" class="rcd1">'.$R.'</a>';
				} ?>
				</td>
				<td class="rcd">
				<?php echo '<a href="'.$HREF_params.'&amp;p=copy"   title="'.hsc($_['Copy']).'"     class="rcd1">'.$C.'</a>' ?>
				</td>
				<td class="rcd">
				<?php if (!$IS_OFCMS){
					  echo '<a href="'.$HREF_params.'&amp;p=delete" title="'.hsc($_['Delete']).'"   class="rcd1">'.$D.'</a>';
				} ?>
				</td>
				<td class="ckbox">
				<?php if (!$IS_OFCMS){
					echo '<INPUT TYPE=checkbox NAME="files['.($X++).']" VALUE="'.hsc($file).'">';
				} ?>
				</td>
				<td class="file_name">
					<?php echo '<a href="'.$HREF_params.'&amp;p=edit"  title="'.hsc($_['Edit_View']).'">'; ?>
					<?php echo show_icon($type).hte($file), '</a>'; ?>
				</td>
				<td class="meta_T file_size">&nbsp;
					<?php echo number_format(filesize($ipath.$file)); ?> B
				</td>
				<td class="meta_T file_time"> &nbsp;
					<script>FileTimeStamp(<?php echo filemtime($ipath.$file); ?>, 1, 0);</script>
				</td>
			</tr>
<?php
		}//end if !is_dir...
	}//end foreach file
	echo '</table>';
}//end Table_of_Files() //******************************************************



function List_Files() { //******************************************************
//called from Index Page
	global $_, $ONESCRIPT, $ipath, $param1, $ftypes, $fclasses, $excluded_list, $INPUT_NUONCE, $CHECKBOX_OFFSET;

	$files = scandir('./'.$ipath);
	natcasesort($files);

	$no_files = true;
	foreach ($files as $file) { if ( is_file($ipath.$file) ) { $no_files = false; break; } }
	if ($no_files) {return 0;}

	if (supports_svg()) {
		$R = svg_icon_ren();
		$C = svg_icon_copy();
		$D = svg_icon_del();
	}else{ //Text "icons" for Rename, Copy, and Delete. Mostly for old IE < 9
		$R = '<span class="RCD R">'.hsc($_['R']).'</span>';
		$C = '<span class="RCD C">'.hsc($_['C']).'</span>';
		$D = '<span class="RCD D">'.hsc($_['D']).'</span>';
	}

	echo '<form method="post" name="mcdselect" action="'.$ONESCRIPT.$param1.'&amp;p=mcdaction">';
	echo $INPUT_NUONCE;
	echo '<input type="hidden" name="mcdselect" value="mcdselect">';

	echo '<div class="action">';

	if (supports_svg()) { //Checks if IE < 9.
		$select_all_attribs = 'TYPE=checkbox NAME=select_all id=select_all VALUE=select_all';
		$select_all_input = '<INPUT '.$select_all_attribs.' onclick="Select_All('.$CHECKBOX_OFFSET.');">';
		echo '<div id=select_all_div><LABEL for=select_all id=select_all_label>'.$_['Select_All'].'</LABEL></div>'.$select_all_input;
	}
	
	function input_mcd($mcd) {
		return '<INPUT TYPE=radio NAME=action VALUE='.$mcd.' id='.$mcd.' onclick="Submit_btn_style(\''.$mcd.'\');">';
	}
	
	echo '<LABEL id=move_label>'  .hsc($_['Move'])  .' '.input_mcd('move').'</LABEL> ';
	echo '<LABEL id=copy_label>'  .hsc($_['Copy'])  .' '.input_mcd('copy').'</LABEL> ';
	echo '<LABEL id=delete_label>'.hsc($_['Delete']).' '.input_mcd('delete').'</LABEL> ';
	
	echo '<input type=submit id=mcd_submit class=button value="'.hsc($_['Selected_Files']).
		'" onclick="return Confirm_ready('.$CHECKBOX_OFFSET.');">';
	echo '</div>'; //end class=action
	echo '<div class=clear></div>'; //clear select_all

	Table_of_Files($files, $R, $C, $D);

	echo '</form>';
}//end List_Files() ************************************************************




function Index_Page(){ //*******************************************************
	global $ONESCRIPT, $ipath;

	//<!--==== List folders/sub-directores ====-->
	echo '<p class="index_folders">';
		$folders = glob($ipath."*",GLOB_ONLYDIR);
		natcasesort($folders);
		foreach ($folders as $folder) {
			echo '<a href="'.$ONESCRIPT.'?i='.URLencode_path($folder).'/">'.PHP_EOL;
			echo svg_icon_folder();
			echo hte(basename($folder)).' /</a>';
		}
	echo '</p>';

	Upload_New_Rename_Delete_Links();

	List_Files();

	Upload_New_Rename_Delete_Links();

}//end Index_Page()*************************************************************




function Edit_Page_buttons_top($text_editable,$file_ENC){ //********************
	global $_, $ONESCRIPT, $param1, $filename;

	//For [Close] button: if came from admin page, return there.
	$params = $param1;
	if ( $_SESSION['admin_page'] ) { $params .= '&amp;p=admin'; }
?>
	<div class="edit_btns_top">
		<div class="file_meta">
			<span class="file_size">
				<?php echo hsc($_['meta_txt_01']).' '.number_format(filesize($filename)).' '.hsc($_['bytes']); ?>
			</span>	&nbsp;
			<span class="file_time">
				<?php echo hsc($_['meta_txt_03']).' <script>FileTimeStamp('.filemtime($filename).', 1, 1);</script>'; ?>
				<?php echo '&nbsp; '.$file_ENC; ?>
			</span><br>
		</div>

		<div class="buttons_right">
			<?php if ( $text_editable ) { ?>
				<input type="button" id="wide_view" class="button" value="<?php echo hsc($_['Wide_View']) ?>" onclick="Wide_View();">
			<?php } ?>
			<input type="button" id="close1" class="button" value="<?php echo hsc($_['Close']) ?>"
				onclick="parent.location = '<?php echo $ONESCRIPT.$params ?>'">
			<script>document.getElementById('close1').focus();</script>
		</div>
		<div class=clear></div>
	</div>
<?php
}//end Edit_Page_buttons_top(){ //**********************************************




function Edit_Page_buttons($text_editable, $too_large_to_edit) { //*************
	global $_, $ONESCRIPT, $param1, $param2, $MAX_IDLE_TIME, $Editing_OFCMS;
	$Button = '<input type="button" class="button" value="';
	$ACTION = '" onclick="parent.location = \''.$ONESCRIPT.$param1.$param2.'&amp;p=';

	//For [Close] button: if came from admin page, return there.
	$params = $param1;
	if ( $_SESSION['admin_page'] ) { $params .= '&amp;p=admin'; }
?>
	<div class="edit_btns_bottom">
	<?php if ($text_editable && !$too_large_to_edit) { //Show save & reset only if editable file ?>
		<?php echo Timeout_Timer($MAX_IDLE_TIME, 'timer1','timer', 'LOGOUT');
	  ?><input type="submit" class="button" value="Save"                           onclick="submitted = true;" id="save_file"><?php
	  ?><input type="button" class="button" value="<?php echo hsc($_['reset']) ?>" onclick="Reset_File()"      id="reset">
		<script>
			//Set disabled with js instead of via input attribute in case js is disabled.
			//Otherwise, if js is disabled, user would be unable to save changes.
			document.getElementById('save_file').disabled = "disabled";
			document.getElementById('reset').disabled     = "disabled";
		</script>
<?php }
	//Don't show [Rename] or [Delete] if editing OneFileCMS itself.

	if (!$Editing_OFCMS) { echo $Button.hsc($_['Ren_Move']).$ACTION.'rename\'">'; }
	echo $Button.hsc($_['Copy'])    .$ACTION.'copy\'">';
	if (!$Editing_OFCMS) { echo $Button.hsc($_['Delete'])  .$ACTION.'delete\'" id="delete">'; }
	echo $Button.hsc($_['Close']).'" onclick="parent.location = \''.$ONESCRIPT.$params.'\'">'
?>
	</div>
<?php
}//end Edit_Page_buttons()******************************************************




//******************************************************************************
function Edit_Page_form($ext, $text_editable, $too_large_to_edit, $too_large_to_edit_message){
	global $_, $ONESCRIPT, $param1, $param2, $param3, $filename, $itypes, $INPUT_NUONCE, $EX,  $raw_contents;
?>
	<form id="edit_form" name="edit_form" method="post" action="<?php echo $ONESCRIPT.$param1.$param2.$param3 ?>">
		<?php echo $INPUT_NUONCE; ?>
<?php
		if ( !in_array( strtolower($ext), $itypes) ) { //If non-image...
				
			if (!$text_editable) { // If non-text file...
				echo '<p class="edit_disabled">'.hsc($_['edit_txt_01']).'<br><br></p>';
				
			}elseif ( $too_large_to_edit ) {
 				echo '<p class="edit_disabled">'.$too_large_to_edit_message.'</p>';
				
			}else{
				if (PHP_VERSION_ID  < 50400) {  // 5.4.0
					$filecontents = hsc($raw_contents);
				}else{
					$filecontents = htmlspecialchars($raw_contents,ENT_SUBSTITUTE | ENT_QUOTES, 'UTF-8');
				}
				
				//Did htmlspecialchars return an empty string from a non-empty file?
				$bad_chars = ( ($filecontents == "") && (filesize($filename) > 0) );
				
				if ($bad_chars){
					echo '<pre class="edit_disabled">'.$EX.hsc($_['edit_txt_02']).'<br>';
					echo hsc($_['edit_txt_03']).'<br>';
					echo hsc($_['edit_txt_04']).'<br></pre>';
				}else{
					echo '<input type="hidden" name="filename" value="'.hsc($filename).'">';
					echo '<textarea id="file_contents" name="contents" cols="70" rows="25"';
					echo 'onkeyup="Check_for_changes(event);">'.$filecontents.'</textarea>'.PHP_EOL;
				}
			} //end if non-text file...
		} //end if non-image
		
		Edit_Page_buttons($text_editable, $too_large_to_edit);
		
		Edit_Page_scripts();
?>	</form>
<?php
	if ($text_editable && !$too_large_to_edit && !$bad_chars) { Edit_Page_Notes(); }
}//end Edit_Page_form() ********************************************************




function Edit_Page_Notes() { //*************************************************
	global $_, $MAX_IDLE_TIME;
			$SEC = $MAX_IDLE_TIME;
			$HRS = floor($SEC/3600);
			$SEC = fmod($SEC,3600);
			$MIN = floor($SEC/60);   if ($MIN < 10) { $MIN = "0".$MIN; };
			$SEC = fmod($SEC,60);    if ($SEC < 10) { $SEC = "0".$SEC; };
			$HRS_MIN_SEC = $HRS.':'.$MIN.':'.$SEC;
?>
			<div id="edit_notes">
				<div class="notes"><?php echo hsc($_['edit_note_00']) ?></div>
				<div class="notes"><b>1)
					<?php echo hsc($_['edit_note_01a']).' $MAX_IDLE_TIME '.hsc($_['edit_note_01b']) ?>
					<?php echo ' '.$HRS_MIN_SEC.'. '.hsc($_['edit_note_02']) ?></b>
				</div>
				<div class="notes"><b>2) </b> <?php echo hsc($_['edit_note_03']) ?></div>
				<div class="notes"><b>3) </b> <?php echo hsc($_['edit_note_04']) ?></div>
			</div>
<?php
}//end Edit_Page_Notes() { //***************************************************




function Edit_Page() { //*******************************************************
	global $_, $filename, $filecontents, $raw_contents, $etypes, $itypes, $MAX_EDIT_SIZE, $MAX_VIEW_SIZE;
	clearstatcache ();

	//Determine if text editable file type
	$filename_parts = explode(".", strtolower($filename));
	$ext = end($filename_parts);
	if ( in_array($ext, $etypes) ) { $text_editable = TRUE;  }
	else                           { $text_editable = FALSE; }
	
	$too_large_to_edit = (filesize($filename) > $MAX_EDIT_SIZE);
	$too_large_to_view = (filesize($filename) > $MAX_VIEW_SIZE);

	if ($text_editable && !$too_large_to_view) {
		$raw_contents = file_get_contents($filename);
		$file_ENC = mb_detect_encoding($raw_contents); //ASCII, UTF-8, etc...
	}else{
		$file_ENC     = "";
		$raw_contents = "";
	}

	if ( $too_large_to_edit ) { $header2 = hsc($_['edit_h2_1']); }
	else                      { $header2 = hsc($_['edit_h2_2']); }

	$too_large_to_edit_message =
'<b>'.hsc($_['too_large_to_edit_01a']).' '.number_format($MAX_EDIT_SIZE).' '.hsc($_['bytes']).'</b><br>'.
hsc($_['too_large_to_edit_02']).'<br>'.hsc($_['too_large_to_edit_03']).'<br>'.hsc($_['too_large_to_edit_04']);

	$too_large_to_view_message =
'<b>'.hsc($_['too_large_to_view_01a']).' '.number_format($MAX_VIEW_SIZE).' '.hsc($_['bytes']).'</b><br>'.
hsc($_['too_large_to_view_02']).'<br>'.hsc($_['too_large_to_view_03']).'<br>';//.hsc($_['too_large_to_view_04']);

	//Preserves vertical spacing when message is blank, so edit area doesn't jump as much.
	echo '<style>#message_box { min-height: 1.86em; }</style>';

	echo '<h2 id="edit_header">'.$header2.' ';
	echo '<a class="h2_filename" href="/'.URLencode_path($filename).'" target="_blank" title="'.$_['Open_View'].'">';
	echo hte(basename($filename)).'</a>';
	echo '</h2>'.PHP_EOL;

	Edit_Page_buttons_top($text_editable, $file_ENC);

	Edit_Page_form($ext, $text_editable, $too_large_to_edit, $too_large_to_edit_message);
	
	if ( in_array( $ext, $itypes) ) { show_image(); }

	echo '<div class=clear></div>';

	if     ( $text_editable && $too_large_to_view ) {
		echo '<p class="edit_disabled">'.$too_large_to_view_message.'</p>';
	}
	elseif ( $text_editable && $too_large_to_edit ){
		$filecontents = hsc(file_get_contents($filename), ENT_COMPAT,'UTF-8');
		echo '<pre class="edit_disabled view_file">'.$filecontents.'</pre>';
	}
}//end Edit_Page ***************************************************************




function Edit_response(){ //***If on Edit page, and [Save] clicked *************
	global $_, $EX, $message, $filename;
	$filename = $_POST["filename"];
	$contents = $_POST["contents"];

	$contents = str_replace("\r\n", "\n", $contents); //Make sure EOL is only newline char.

	$bytes = file_put_contents($filename, $contents);

	if ($bytes !== false) {
		$message .= '<b>'.hsc($_['edit_msg_01']).' '.number_format($bytes).' '.hsc($_['edit_msg_02']).'</b><br>';
	}else{
		$message .= $EX.'<b>'.hsc($_['edit_msg_03']).'</b><br>';
	}
}//end Edit_response() *********************************************************




function Upload_Page() { //*****************************************************
	global $_, $ONESCRIPT, $ipath, $param1, $INPUT_NUONCE;

	//Determine $MAX_FILE_SIZE to upload
	$upload_max_filesize = ini_get('upload_max_filesize'); //This should be < post_max_size,
	$post_max_size       = ini_get('post_max_size');       //but, just in case, check both...

	function shorthand_to_int($SHORTHAND){ //*******************
		$KMG = strtoupper(substr($SHORTHAND, -1));
		if     ($KMG == "K") { return $SHORTHAND * 1024; }
		elseif ($KMG == "M") { return $SHORTHAND * 1048576; }
		elseif ($KMG == "G") { return $SHORTHAND * 1073741824; }
		else                 { return $SHORTHAND; }
	}//end function shorthand_to_int() *************************

	$UMF = shorthand_to_int($upload_max_filesize);
	$PMS = shorthand_to_int($post_max_size);

	if ($UMF <= $PMS){ $MAX_FILE_SIZE = $UMF; $max_msg = $upload_max_filesize.' '.hsc($_['upload_txt_01']); }
	else             { $MAX_FILE_SIZE = $PMS; $max_msg = $post_max_size      .' '.hsc($_['upload_txt_02']); }
?>
	<h2><?php echo hsc($_['Upload_File']) ?></h2>
	<p><?php echo hsc($_['upload_txt_03']).' '.$max_msg; ?></p>
	<form enctype="multipart/form-data" action="<?php echo $ONESCRIPT.$param1; ?>&amp;p=uploaded" method="post">
		<?php echo $INPUT_NUONCE; ?>
		<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $MAX_FILE_SIZE ?>">
		<input type="hidden" name="upload_destination" value="<?php echo hsc($ipath); ?>" >
		<input type="file"   name="upload_file" id="upload_file" size="100">
		<?php Cancel_Submit_Buttons(hsc($_['Upload']),"cancel"); ?>
	</form>
<?php
} //end Upload_Page() **********************************************************




function Upload_response() { //*************************************************
	global $_, $filename, $message, $EX, $page;
	$filename    = $_FILES['upload_file']['name'];
	$destination = Check_path($_POST["upload_destination"]);
	$page  = "index";
	$MAXUP1 = ini_get('upload_max_filesize');
	$MAXUP2 = number_format($_POST['MAX_FILE_SIZE']).' '.hsc($_['bytes']);
	$ERROR = $_FILES['upload_file']['error'];

	if     ( $ERROR == 1 ){ $ERRMSG = hsc($_['upload_err_01a']).' upload_max_filesize = '.$MAXUP1.' '.hsc($_['upload_err_01b']);}
	elseif ( $ERROR == 2 ){ $ERRMSG = hsc($_['upload_err_02a']).' $MAX_FILE_SIZE = '     .$MAXUP2.' '.hsc($_['upload_err_02b']);}
	elseif ( $ERROR == 3 ){ $ERRMSG = hsc($_['upload_err_03']); }
	elseif ( $ERROR == 4 ){ $ERRMSG = hsc($_['upload_err_04']); }
	elseif ( $ERROR == 5 ){ $ERRMSG = hsc($_['upload_err_05']); }
	elseif ( $ERROR == 6 ){ $ERRMSG = hsc($_['upload_err_06']); }
	elseif ( $ERROR == 7 ){ $ERRMSG = hsc($_['upload_err_07']); }
	elseif ( $ERROR == 8 ){ $ERRMSG = hsc($_['upload_err_08']); }
	else                  { $ERRMSG = ''; }

	if (($filename == "")){
		$message .= $EX.'<b>'.hsc($_['upload_msg_01']).'</b><br>';
	}elseif ( ($destination === false) || (($destination != "") && !is_dir($destination))) {
		$message .= $EX.'<b>'.hsc($_['upload_msg_02']).'</b><br>';
		$message .= '<span class="filename">'.hte($destination).'</span></b><br>';
		$message .= hsc($_['upload_msg_03']).'</b><br>';
	}else{
		$message .= '<b>'.hsc($_['upload_msg_04']).'</b> <span class="filename">'.hte($filename).'</span><br>';
		$savefile = ordinalize($destination, $filename, $savefile_msg);
		
		if(move_uploaded_file($_FILES['upload_file']['tmp_name'], $savefile)) {
			$message .= '<b>'.hsc($_['upload_msg_05']).'</b> '.$savefile_msg.'<br>';
		} else{
			$message .= '<b>'.$EX.'<b>'.hsc($_['upload_msg_06']).' '.$ERRMSG.'</b><br>';
		}
	}
}//end Upload_response() *******************************************************




function New_File_or_Folder_Page($title, $id) { //******************************
	global $_, $FORM_COMMON, $INVALID_CHARS;

	echo '<h2>'.hsc($title).'</h2>';
	echo $FORM_COMMON;
		echo '<p>'.hsc($_['new_file_txt_01'].' '.$_['new_file_txt_02']);
		echo '<span class="mono">'.hte($INVALID_CHARS).'</span></p>';
		echo '<input type="text" name="'.$id.'" id="'.$id.'" value="">';
		Cancel_Submit_Buttons(hsc($_['Create']),$id);
	echo '</form>';
}//end New_File_or_Folder_Page() //*********************************************




function New_File_or_Folder_response($post, $is_file){ //***********************
	global $_, $WEB_ROOT, $ipath, $filename, $page, $param1, $param2, $param3, $message, $EX, $INVALID_CHARS;

	$page      = "index"; //Return to index if folder, or on error.

	$new_name  = trim($_POST["$post"],"\x00..\x20/"); //Trim whitespace & slashes.
	
	if ($is_file) { $filename  = $ipath.$new_name;     }
	else          { $new_ipath = $ipath.$new_name.'/'; }

	$msg_new  = '<span class="filename">'.hte($new_name).'</span><br>';

	if (has_invalid_char($new_name)){
		$message .= $EX.'<b>'.hsc($_['new_file_msg_01']).'</b> '.$msg_new;
		$message .= '<b>'.hsc($_['new_file_msg_02']).' <span class="mono">'.hte($INVALID_CHARS).'</span></b>';
		
	}elseif ($new_name == ""){
		$message .= $EX.'<b>'.hsc($_['new_file_msg_03']).'</b>';  //No name given.
		
	}elseif (file_exists($filename)) { //Does file or folder already exist ?
		$message .= $EX.'<b>'.hsc($_['new_file_msg_04']).' '.$msg_new;
		
	}elseif ( $is_file && touch($filename) ) { //Create File
		$message .= '<b>'.hsc($_['new_file_msg_05']).'</b> '.$msg_new; //New File success.
		$page     = "edit";                                      //Return to edit page.
		$param2   = '&amp;f='.rawurlencode(basename($filename)); //for Edit_Page() buttons
		$param3   = '&amp;p=edit';                               //for Edit_Page() buttons
		
	}elseif ( !$is_file && mkdir($new_ipath)) { //Create Folder
		$message .= '<b>'.hsc($_['new_file_msg_07']).'</b> '.$msg_new; //New folder success
		$ipath    = $new_ipath;  //return to new folder
		$param1   = '?i='.URLencode_path($ipath);
		
	}else{
		$message .= $EX.'<b>'.hsc($_['new_file_msg_01']).':</b><br>'.$msg_new; //'Error - new file not created:'
	}
}//end New_File_or_Folder_response *********************************************




function Set_Input_width() { //*************************************************
	global $WEB_ROOT, $MAIN_WIDTH;

	// (width of <input type=text>) = $MAIN_WIDTH - (Width of $WEB_ROOT)
	// $MAIN_WIDTH may be in em, px, or pt.
	// Width of 1 character = .625em = 10px = 7.5pt  (1em = 16px = 12pt)

	$root_enc =  mb_detect_encoding($WEB_ROOT); //ASCII? UTF8? etc...
	$root_len = (mb_strlen($WEB_ROOT, $root_enc) + 1); //+1 for good measure.
	$main_width = $MAIN_WIDTH * 1;   //set in config section. Default is 810px.
	$main_units = substr($MAIN_WIDTH, -2); //should be em, px, or pt

	//convert to em
	if     ( $main_units == "px") {  $main_width = $main_width / 16 ;}
	elseif ( $main_units == "pt") {  $main_width = $main_width / 12 ;}
	else                          {  $main_width = $main_width      ;}

	//convert to em
	$root_len = $root_len *.625;

	$input_type_text_width = ($main_width - $root_len).'em';

	echo '<style>input[type="text"] {width: '.$input_type_text_width.';}</style>';

}//end Set_Input_width() *******************************************************




function CRM_Page($action, $title, $name_id, $isfile) { //**********************
	//$action = 'Copy' or 'Rename'. $isfile = 1 if acting on a file, not a folder
	global $_, $WEB_ROOT, $ipath, $filename, $FORM_COMMON;

	if ($isfile) { $old_name = $filename; }else{ $old_name = $ipath; }
	if ($isfile) { $new_name = $filename; }else{ $new_name = $ipath; }
	//if ($action == "Copy" ) { $new_name = ordinalize($ipath, basename($filename), $msg); }

	Set_Input_width();
?>
	<h2><?php echo hsc($action.' '.$title) ?></h2>

	<?php echo $FORM_COMMON ?>
		<input type="hidden" name="<?php echo $name_id ?>"  value="<?php echo hsc($name_id); ?>">

		<label><?php echo hsc($_['CRM_txt_03']) ?></label><br>
		<span class="web_root"><?php echo hte($WEB_ROOT); ?></span><input type="text"
		name="old_name" value="<?php echo hsc($old_name); ?>" readonly="readonly">

		<label><?php echo hsc($_['CRM_txt_04']) ?></label><br>
		<input type="text" name="new_name" id="new_name" value="<?php echo hsc(basename($new_name)); ?>"><br>

		<label><?php echo hsc($_['New_Location']) ?></label> &nbsp; &nbsp;(<?php echo hsc($_['CRM_txt_02']) ?>)<br>
		<span class="web_root"><?php echo hte($WEB_ROOT); ?></span><input type="text"
		name="new_location" id="new_location" value="<?php echo hsc(dir_name($new_name)); ?>"><br>

		<?php Cancel_Submit_Buttons($action, "new_name"); ?>
	</form>
<?php
} //end CRM_Page() *************************************************************




function CRM_response($action, $msg1, $isfile, $show_message = 3){ //***********
	//Returns 0 if successful, 1 on error.
	//$action = 'copy' or 'rename'. $isfile = 1 if acting on a file, not a folder
	//$show_message: 0 = none; 1 = errors only; 2 = successes only; 3 = all messages (default).
	global $_, $WEB_ROOT, $ipath, $filename, $page, $param1, $param2, $message, $EX, $INVALID_CHARS;

	$old_name      = trim($_POST["old_name"],"\x00..\x20/"); //Trim whitespace & slashes.
	$old_location  = dir_name($old_name); //dir_name() adds a trailing slash.
	$new_location  = trim($_POST['new_location'],"\x00..\x20/").'/';
	$new_name_only = trim($_POST["new_name"],"\x00..\x20/"); //file or folder only - no path yet.
	$new_name      = $new_location.trim($_POST["new_name"],"\x00..\x20/");
	$filename      = $old_name; //default if error.

	//Common message lines

	$com_msg  = '<div id="message_left">'.hte($_['From']).'<br>'.hte($_['To']).'</div>';
	$com_msg .= '<b>: </b><span class="filename">'.hte($old_name).'</span><br>';
	$com_msg .= '<b>: </b><span class="filename">'.hte($new_name).'</span>';

	$err_msg = ''; //Error message.
	$scs_msg = ''; //Success message.

	$error = 1; //0 = no error, 1 = an error. Default to error. Used for return value.

	//Check old name for invalid chars (like .. ) (Unlikely to be false outside a malicious attempt)
	if ( Check_path($old_name,$show_message) === false ) {
		$bad_name = $old_name;
		
	}elseif ( !file_exists($old_name) ) {
		$err_msg .= $EX.'<b>'.hsc($msg1.' '.$_['CRM_msg_02']).'</b><br>'; //file does not exist
		$bad_name = $old_name;
		
	//Check new name & location for invalid chars etc.
	}elseif ( Check_path($new_name,$show_message) === false ) {
		$bad_name = $new_name;
		
	}elseif ( ($new_location != "") && !is_dir($new_location) ) {
		$err_msg .= $EX.'<b>'.hsc($msg1.' '.$_['CRM_msg_01']).'</b><br>'; //parent does not exist
		$bad_name = $new_location;
		
	}elseif ( file_exists($new_name) ) {
		$bad_name = $new_name;
		$err_msg .= $EX.'<b>'.hsc($msg1.' '.$_['CRM_msg_03']).'</b><br>'; //already exists
		
	}elseif ( $action($old_name, $new_name )) {
		$scs_msg .= '<b>'.hsc($msg1.' '.$_['successful']).'</b><br>'.$com_msg;
		if   ($isfile) {
			$ipath    = $new_location;
			$filename = $new_name;
		}else {//folder
			$ipath    = $new_name.'/';
		}
		$error = 0;
		
	}else{
		$bad_name = "";
		$err_msg .= $EX.'<b>'.hsc($_['CRM_msg_05a'].' '.$msg1).'</b><br>'.$com_msg;
	}
	
	if ($error) { $err_msg .= '<span class="filename">'.hte($bad_name).'</span><br>'; }

	if ( ($show_message & 1) && $error ) { $message .= $err_msg; } //Show error message.
	if (  $show_message & 2)             { $message .= $scs_msg; } //Show success message.

	//Prior page should be either index or edit
	$page = $_SESSION["recent_pages"][1];
	$param1 = '?i='.URLencode_path($ipath);
	if ($isfile & $page == "edit") {$param2 = '&amp;f='.rawurlencode(basename($filename));}

	return $error; //
}//end CRM_response() **********************************************************




function Delete_File_Page() { //************************************************
	global $_, $filename, $FORM_COMMON;
?>
	<h2><?php echo hsc($_['Del_Files']) ?></h2>
	<?php echo $FORM_COMMON ?>
		<input type="hidden" name="delete_file" value="<?php echo hsc($filename); ?>" >
		<p><span class="verify_del"><?php echo hte(basename($filename)); ?></span></p>
		<p><b><?php echo hsc($_['delete_txt_01']) ?></b></p>
		<?php Cancel_Submit_Buttons(hsc($_['DELETE']), "cancel"); ?>
	</form>
<?php
} //end Delete_File_Page() *****************************************************




function Delete_File_response($del_file = "", $show_message = 3){ //************
	global $_, $filename, $message, $EX, $page, $ipath, $param1, $param2;

	if ($del_file == "") { $del_file = $_POST["delete_file"]; }
	$page = "index"; //Return to index
	$err_msg = ''; //On error, set this message.
	$scs_msg = ''; //On success, set this message.


	if (unlink($del_file)) {
		$scs_msg .= '<b>'.hsc($_['delete_msg_01']).'</b> <span class="filename">'.hte(basename($del_file)).'</span><br>';
		$filename = "";
		$error = 0; //0= no error, 1 = an error.
	}else{
		$err_msg .= $EX.'<b>'.hsc($_['delete_msg_02']).'</b> <span class="filename">"'.hte($del_file).'"</span>.<br>';
		$page = $_SESSION['recent_pages'][1];
		$error = 1;
	}

	if ($show_message & 1) { $message .= $err_msg; } //Show error message.
	if ($show_message & 2) { $message .= $scs_msg; } //Show success message.
	return $error; //
}//end Delete_File_response() **************************************************




function Delete_Folder_Page(){ //***********************************************
	global $_, $WEB_ROOT, $ipath, $FORM_COMMON;
?>
	<h2><?php echo hsc($_['Del_Folder']) ?></h2>
	<?php echo $FORM_COMMON ?>
		<input type="hidden" name="delete_folder" value="<?php echo hsc($ipath); ?>" >
		<p>
		<span class="web_root"><?php echo hte($WEB_ROOT.dir_name($ipath)); ?></span><span
		class="verify_del"><?php echo hte(basename($ipath)); ?></span> /
		</p>
		<p><b><?php echo hsc($_['delete_folder_txt_01']) ?></b></p>
		<?php Cancel_Submit_Buttons(hsc($_['DELETE']), "cancel"); ?>
	</form>
<?php
} //end Delete_Folder_Page() //*************************************************




function Delete_Folder_response() { //******************************************
	global $_, $ipath, $param1, $page, $message, $EX;
	$page = "index"; //Return to index
	$foldername = Check_path($_POST["delete_folder"],1);
	$foldername = trim($foldername,'/');
	if ($foldername == "") { return; }

	if ( !is_empty($ipath) ) {
		$message .= $EX.'<b>'.hsc($_['delete_folder_msg_01']).'</b>';
		$page = "index";
	}elseif (@rmdir($foldername)) {
		$message .= '<b>'.hsc($_['delete_folder_msg_02']).'</b> ';
		$message .= '<span class="filename">'.hte(basename($foldername)).'</span></br>';
		$ipath  = dir_name($foldername); //Return to parent dir.
		$param1 = '?i='.URLencode_path($ipath);
	}else {
		$message .= $EX.'<b><span class="filename">"'.hte($foldername).'/"</span></b> '.hsc($_['delete_folder_msg_03']);
	}
}//end Delete_Folder_response() ************************************************



//******************************************************************************
function MCD_Page($page_title, $action, $classes = 'verify', $focus = 'new_location') {
	global $_, $WEB_ROOT, $ONESCRIPT, $ipath, $param1, $INPUT_NUONCE;
	
	Set_Input_width();

	echo '<h2>'.hsc($page_title).'</h2>';

	echo '<form method="post" action="'.$ONESCRIPT.$param1.'">'.$INPUT_NUONCE;
		echo '<input type="hidden" name="'.$action.'" value="'.$action.'">'.PHP_EOL;
		
		if (($_POST['action'] == 'copy') || ($_POST['action'] == 'move') ) {
			echo '<label for="new_location">'.hsc($_['New_Location']).'</label> &nbsp; ('.hsc($_['CRM_txt_02']).')<br>';
			echo '<span class="web_root">'.hte($WEB_ROOT).'</span>';
			echo '<input type="text" name="new_location" id="new_location" value="'.hsc($ipath).'">';
		}
			
		echo '<p><b>'.hsc($_['delete_txt_01']).'</b></p>'; //"Are you sure?"
		Cancel_Submit_Buttons(hsc($page_title), $focus);
			
		//List selected files
		echo '<table class="'.$classes.'">';
		echo '<tr><th>'.$_['Selected_Files'].':</th></tr>'."\n";
		$X = 1;
		foreach($_POST['files'] as $file) {
			echo '<tr><td>'.hte($file).'</td></tr>';
			echo '<input type=hidden  class="'.$classes.'" name="files['.$X++.']" value="'.hsc($file).'">'."\n";
		}
		echo '</table>';
	echo '</form>';
} //end MCD_Page() *************************************************************




function MCD_response($action, $msg1, $success_msg = '') { //*******************
	global $_, $WEB_ROOT, $ipath, $param1, $param2, $param3, $message, $EX, $filename;

	$files    = $_POST['files']; //List of files to delete (path not included)
	$count    = count($files);
	$errors   = 0; //number of failed moves or copies

	$isfile = 1; //only working with files, not folders.
	$show_message = 1; //1= show error msg only. 2= show success msg only. 3= show all msg's.

	if ($action == 'delete') {
		foreach ($files as $file){
			$errors += Delete_File_response($ipath.$file, $show_message);
		}
		
	}else { //move or copy
		$mcd_ipath = $ipath; //$CRM_response() changes $ipath to $new_location
		
		//Trim whitespace & slashes, leaving only 1 trailing slash.
		$new_location = trim($_POST['new_location'],"\x00..\x20/").'/';
		if ( Check_path($new_location, $show_message) === false ){
			$message .= '<span class="filename">'.hte($new_location).'</span><br>';
			return;
		}
		
		foreach ($files as $file){
			$_POST['old_name'] = $mcd_ipath.$file;
			$_POST['new_name'] = $file;
			$_POST['new_location'] = $new_location;
			$errors  += CRM_response($action, $msg1, $isfile, $show_message);
		}
	}

	$successful = $count - $errors;
	
	if ($errors) { $message .= $EX.' <b>'.$errors.' '.hsc($_['errors']).'.</b> '; }
	
	$message .= '<b>'.$successful.' '.hsc($success_msg).'</b><br>';

	if ($action != 'delete') {
		if ($successful > 0) { //if all errors, don't bother...
			$message .= '<div id="message_left"><b>'.hsc($_['From']).'<br>'.hsc($_['To']).'</b></div>';
			$message .= '<b>:</b><span class="filename"> '.hsc($mcd_ipath).'</span><br>';
			$message .= '<b>:</b><span class="filename"> '.hsc($ipath).'</span><br>';
		}
	}
}//end MCD_response() **********************************************************




function Page_Title(){ //***<title>Page_Title()</title>*************************
	global $_, $page;

	if     ($page == "login")        { return $_['Log_In'];        }
	elseif ($page == "admin")        { return $_['Admin_Options']; }
	elseif ($page == "hash")         { return $_['Generate_Hash']; }
	elseif ($page == "changepw")     { return $_['pw_change'];     }
	elseif ($page == "changeun")     { return $_['un_change'];     }
	elseif ($page == "edit")         { return $_['Edit_View'];     }
	elseif ($page == "upload")       { return $_['Upload_File'];   }
	elseif ($page == "newfile")      { return $_['New_File'];      }
	elseif ($page == "copy" )        { return $_['Copy_Files'];    }
	elseif ($page == "rename")       { return $_['Ren_Move'].' '.$_['File'];}
	elseif ($page == "delete")       { return $_['Del_Files'];     }
	elseif ($page == "newfolder")    { return $_['New_Folder'];    }
	elseif ($page == "renamefolder") { return $_['Ren_Folder'];    }
	elseif ($page == "deletefolder") { return $_['Del_Folder'];    }
	elseif ($page == "mcdaction" && ($_POST['action'] == "copy") )    { return $_['Copy_Files'];}
	elseif ($page == "mcdaction" && ($_POST['action'] == "move") )    { return $_['Move_Files'];}
	elseif ($page == "mcdaction" && ($_POST['action'] == "delete") )  { return $_['Del_Files']; }
	else                             { return $_SERVER['SERVER_NAME']; }
}//end Page_Title() ************************************************************




function Load_Selected_Page(){ //***********************************************
	global $_, $ONESCRIPT, $page;

	if     ($page == "login")        { Login_Page();          }
	elseif ($page == "index")        { Index_Page();          }
	elseif ($page == "admin")        { Admin_Page();          }
	elseif ($page == "hash")         { Hash_Page();           }
	elseif ($page == "changepw")     { Change_PWUN_Page('pw');}
	elseif ($page == "changeun")     { Change_PWUN_Page('un');}
	elseif ($page == "edit")         { Edit_Page();           }
	elseif ($page == "upload")       { Upload_Page();         }
	elseif ($page == "newfile")      { New_File_or_Folder_Page($_['New_File'] ,"new_file");}
	elseif ($page == "copy")         { CRM_Page($_['Copy'],     $_['File'], 'copy_file',   1); }
	elseif ($page == "rename")       { CRM_Page($_['Ren_Move'], $_['File'], 'rename_file', 1); }
	elseif ($page == "delete")       { Delete_File_Page();    }
	elseif ($page == "newfolder")    { New_File_or_Folder_Page($_['New_Folder'] ,"new_folder");}
	elseif ($page == "renamefolder") { CRM_Page($_['Ren_Move'], $_['Folder'], 'rename_folder', 0); }
	elseif ($page == "deletefolder") { Delete_Folder_Page();  }
	elseif ($page == "mcdaction")    {
		if ($_POST['action'] == 'move')  { MCD_Page($_['Move_Files'], 'mcd_mov'); }
		if ($_POST['action'] == 'copy')  { MCD_Page($_['Copy_Files'], 'mcd_cpy'); }
		if ($_POST['action'] == 'delete'){ MCD_Page($_['Del_Files'],  'mcd_del', 'verify verify_del', 'cancel'); }
	}
	else                             { Login_Page();          } //default
}//end Load_Selected_Page() ****************************************************




function Respond_to_POST() {//**************************************************
	global $_, $VALID_POST, $page, $message;

	if (!$VALID_POST) { return; }

	if     (isset($_POST["mcd_mov"]      )) { MCD_response('rename', $_['Ren_Move'], $_['mcd_msg_01']); } //move == rename
	elseif (isset($_POST["mcd_cpy"]      )) { MCD_response('copy'  , $_['Copy']    , $_['mcd_msg_02']); }
	elseif (isset($_POST["mcd_del"]      )) { MCD_response('delete', $_['Delete']  , $_['mcd_msg_03']); }
	elseif (isset($_POST["whattohash"]   )) { Hash_response();           }
	elseif (isset($_POST["pw"]           )) { Change_PWUN_response('pw', $_['change_pw_02']);}
	elseif (isset($_POST["un"]           )) { Change_PWUN_response('un', $_['change_un_02']);}
	elseif (isset($_POST["filename"]     )) { Edit_response();           }
	elseif (isset($_POST["new_file"]     )) { New_File_or_Folder_response("new_file", 1);}   //1=file
	elseif (isset($_POST["copy_file"]    )) { CRM_response('copy'  , $_['Copy']    , 1);}
	elseif (isset($_POST["rename_file"]  )) { CRM_response('rename', $_['Ren_Move'], 1);}
	elseif (isset($_POST["delete_file"]  )) { Delete_File_response();    }
	elseif (isset($_POST["new_folder"]   )) { New_File_or_Folder_response("new_folder", 0);} //0=folder
	elseif (isset($_POST["rename_folder"])) { CRM_response('rename', $_['Ren_Move'], 0);}
	elseif (isset($_POST["delete_folder"])) { Delete_Folder_response();  }
	elseif (isset($_FILES['upload_file']['name']))  { Upload_response(); }

}//end Respond_to_POST() *******************************************************




function common_scripts() { //**************************************************
	global $_, $TO_WARNING;
	
	$timeout_warning = '<div id="message_box_contents"><b>'.hsc($_['session_warning']).'</b>';
?>
<script>
function pad(num){ if ( num < 10 ){ num = "0" + num; }; return num; }



function FormatTime(Seconds) {
	var Hours = Math.floor(Seconds / 3600); Seconds = Seconds % 3600;
	var Minutes = Math.floor(Seconds / 60); Seconds = Seconds % 60;
	if ((Hours == 0) && (Minutes == 0)) { Minutes = "" } else { Minutes = pad(Minutes) }
	if (Hours == 0) { Hours = ""} else { Hours = pad(Hours) + ":"}

	return (Hours + Minutes + ":" + pad(Seconds));
}



function Countdown(count, End_Time, Timer_ID, Timer_CLASS, Action){
	var Timer        = document.getElementById(Timer_ID);
	var Current_Time = Math.round(new Date().getTime()/1000); //js uses milliseconds
	    count        = End_Time - Current_Time;
	var params = count + ', "' + End_Time + '", "' + Timer_ID + '", "' + Timer_CLASS + '", "' + Action + '"';

	Timer.innerHTML = FormatTime(count);

	if ( (count < <?php echo $TO_WARNING ?>) && (Action != "") ) { //Two minute warning...
		document.getElementById('message_box').innerHTML = "<?php echo addslashes($timeout_warning) ?>";
		Timer.style.backgroundColor = "white";
		Timer.style.color = "red";
		Timer.style.fontWeight = "900";
	}

	if ( count < 1 ) {
		if ( Action == 'LOGOUT') {
			Timer.innerHTML = '<?php echo addslashes($_['session_expired']) ?>';
			//Load login screen, but delay first to make sure really expired:
			setTimeout('window.location = window.location.pathname',3000); //1000 = 1 second
		}
		return;
	}
	setTimeout('Countdown(' + params + ')',1000);
}



function Start_Countdown(count, ID, CLASS, Action){
	document.write('<span id="' + ID + '"  class="' + CLASS + '"></span>');

	var Time_Start  = Math.round(new Date().getTime()/1000);
	var Time_End    = Time_Start + count;

	Countdown(count, Time_End, ID, CLASS, Action); //(seconds to count, id of element)
}



function FileTimeStamp(php_filemtime, show_date, show_offset){

	//php's filemtime returns seconds, javascript's date() uses milliseconds.
	var FileMTime = php_filemtime * 1000;

	var TIMESTAMP  = new Date(FileMTime);
	var YEAR  = TIMESTAMP.getFullYear();
	var	MONTH = pad(TIMESTAMP.getMonth() + 1);
	var DATE  = pad(TIMESTAMP.getDate());
	var HOURS = TIMESTAMP.getHours();
	var MINS  = pad(TIMESTAMP.getMinutes());
	var SECS  = pad(TIMESTAMP.getSeconds());

	if ( HOURS < 12) { AMPM = "am"; } else { AMPM = "pm"; }
	if ( HOURS > 12 ) {HOURS = HOURS - 12; }
	HOURS = pad(HOURS);

	var GMT_offset = -(TIMESTAMP.getTimezoneOffset()); //Yes, I know- seems wrong, but its works.

	if (GMT_offset < 0) { NEG = -1; SIGN = "-"; } else { NEG = 1; SIGN = "+"; }

	var offset_HOURS = Math.floor(NEG*GMT_offset/60);
	var offset_MINS  = pad( NEG * (GMT_offset % 60) );
	var offset_FULL  = "UTC " + SIGN + offset_HOURS + ":" + offset_MINS;

	FULLDATE = YEAR + "-" + MONTH + "-" + DATE;
	FULLTIME = HOURS + ":" + MINS + ":" + SECS + " " + AMPM;

	var               DATETIME = FULLTIME;
	if (show_date)  { DATETIME = FULLDATE + " &nbsp;" + FULLTIME;}
	if (show_offset){ DATETIME += " ("+offset_FULL+")"; }
		
	document.write( DATETIME );

}//end FileTimeStamp(php_filemtime)



function Select_All(list_offset) {
	//list_offset = Number of form elements before file select checkboxes.

	select_all_label = document.getElementById('select_all_label');
	var   files = document.mcdselect.elements; //files start at elemements[list_offset].
	var   last  = files.length - 1; //number of files & checkboxes
	var   select_all = document.mcdselect.select_all;
	
	if (select_all.checked) {
		select_all_label.innerHTML = '<?php echo addslashes($_['Clear_All']) ?>';
	}else{
		select_all_label.innerHTML = '<?php echo addslashes($_['Select_All']) ?>';
	}
	
	for (var x = list_offset; x <= last ; x++) { files[x].checked = select_all.checked; }
}



function Submit_btn_style(option) {
	if (option == "move")   {bc = "brown";}
	if (option == "copy")   {bc = "green";}
	if (option == "delete") {bc = "red";}
	
	//Reset current border colors.
	document.getElementById("move_label"  ).style.borderColor = 'transparent';
	document.getElementById("copy_label"  ).style.borderColor = 'transparent';
	document.getElementById("delete_label").style.borderColor = 'transparent';

	//Set Submit button border color
	document.getElementById("mcd_submit").style.borderColor = bc;

	//Set option label border color
	document.getElementById(option + "_label").style.borderColor  = bc;
}



function Confirm_ready(list_offset){
	//list_offset = Number of form elements before file select checkboxes.
	
	is_move    = document.getElementById("move").checked;
	is_copy    = document.getElementById("copy").checked;
	is_delete  = document.getElementById("delete").checked;
	
	var   files = document.mcdselect.elements; //Actual files are only from elemements[list_offset] to last element.
	var   last  = files.length - 1; //number of files (checkboxes) + list_offset

	//Clear f_msg if at least one file is checked
	f_msg = "<?php echo addslashes($_['No_files']) ?>\n";	
	for (var x = list_offset; x <= last ; x++) {
		if (files[x].checked == true) { f_msg = ""; break; }
	}

	//Clear a_msg if an action is selected
	a_msg = '<?php echo addslashes($_['No_action']) ?>';
	if ( is_move || is_copy || is_delete )   { a_msg = ""; }

	//Don't submit form if either message is set.
	if ( (f_msg != "") || (a_msg != "") ) {
		alert(f_msg + a_msg);
		return false;
	}

	return true; //submit form.
}
</script>
<?php
}//end common_scripts() ********************************************************




function Edit_Page_scripts() { //***********************************************
	global $_, $MAIN_WIDTH, $WIDE_VIEW_WIDTH;
	
	//Determine edit_view width
	$current_view = $MAIN_WIDTH;
	if ( isset($_COOKIE['edit_view']) ) {
		if ( ($_COOKIE['edit_view'] == $MAIN_WIDTH) || ($_COOKIE['edit_view'] == $WIDE_VIEW_WIDTH) ) {
			$current_view = $_COOKIE['edit_view'];
		}
	}
?>
	<!--======== Provide feedback re: unsaved changes ========-->
	<script>
	// a few var's for Wide_View()
	var Main_div		 = document.getElementById('main');
	var Wide_View_button = document.getElementById('wide_view');
	var main_width_default = '<?php echo $MAIN_WIDTH ?>';

	Main_div.style.width = "<?php echo $current_view ?>"; //get current width

	if ( Main_div.style.width == '<?php echo $WIDE_VIEW_WIDTH ?>' ) {
		Wide_View_button.value = '<?php echo addslashes($_['Normal_View']) ?>';
	}

	function Wide_View() {
		if ( File_textarea != null ) { File_textarea.style.width = '99.8%'; }
		
		if (Main_div.style.width == '<?php echo $WIDE_VIEW_WIDTH ?>') {
			Main_div.style.width = main_width_default;
			Wide_View_button.value = "<?php echo addslashes($_['Wide_View'])?>";
			document.cookie = 'edit_view=' + main_width_default;
		}else{
			Main_div.style.width = '<?php echo $WIDE_VIEW_WIDTH ?>';
			Wide_View_button.value = '<?php echo addslashes($_['Normal_View']) ?>';
			document.cookie = 'edit_view=<?php echo $WIDE_VIEW_WIDTH ?>';
		}
	}

	var File_textarea    = document.getElementById('file_contents');
	var Save_File_button = document.getElementById('save_file');
	var Reset_button     = document.getElementById('reset');
	var start_value      = File_textarea.value;


	// The following events only apply when the element is active.
	// [Save] is disabled unless there are changes to the open file.
	Save_File_button.onfocus = function() { Save_File_button.style.backgroundColor = "rgb(255,250,150)";
											Save_File_button.style.borderColor = "#F00"; }
	Save_File_button.onblur  = function() { Save_File_button.style.backgroundColor ="#Fee";
											Save_File_button.style.borderColor = "#Faa"; }
	Save_File_button.onmouseover = function() {Save_File_button.style.backgroundColor = "rgb(255,250,150)";
											   Save_File_button.style.borderColor = "#F00"; }
	Save_File_button.onmouseout  = function() {Save_File_button.style.backgroundColor = "#Fee";
											   Save_File_button.style.borderColor = "#Faa"; }


	var submitted   = false;
	var changed     = false;

	function Reset_file_status_indicators() {
		changed = false;
		File_textarea.style.backgroundColor = "#F6FFF6";  //light green
		Save_File_button.style.backgroundColor = "";
		Save_File_button.style.borderColor = "";
		Save_File_button.style.borderWidth = "1px";
		Save_File_button.disabled = "disabled";
		Save_File_button.value = "<?php echo addslashes($_['save_1'])?>";
		Reset_button.disabled = "disabled";
	}


	window.onbeforeunload = function() {
		if ( changed && !submitted ) {
			//FF4+ Ingores the supplied msg below & only uses a system msg for the prompt.
			return "<?php echo addslashes($_['unload_unsaved']) ?>";
		}
	}


	window.onunload = function() {
		//without this, a browser back then forward would reload file with local/
		// unsaved changes, but with a green b/g as tho that's the file's contents.
		if (!submitted) {
			File_textarea.value = start_value;
			Reset_file_status_indicators();
		}
	}


	//With selStart & selEnd == 0, moves cursor to start of text field.
	function setSelRange(inputEl, selStart, selEnd) {
		if (inputEl.setSelectionRange) {
			inputEl.focus();
			inputEl.setSelectionRange(selStart, selEnd);
		} else if (inputEl.createTextRange) {
			var range = inputEl.createTextRange();
			range.collapse(true);
			range.moveEnd('character', selEnd);
			range.moveStart('character', selStart);
			range.select();
		}
	}


	function Check_for_changes(event){
		var keycode=event.keyCode? event.keyCode : event.charCode;
		changed = (File_textarea.value != start_value);
		if (changed){
			document.getElementById('message_box').innerHTML = " "; // Must have a space, or it won't clear the msg.
			File_textarea.style.backgroundColor    = "#Fee";//light red
			Save_File_button.style.backgroundColor ="#Fee";
			Save_File_button.style.borderColor = "#Faa";  //less light red
			Save_File_button.style.borderWidth = "1px";
			Save_File_button.disabled = "";
			Reset_button.disabled = "";
			Save_File_button.value = "<?php echo addslashes($_['save_2'])?>";
		}else{
			Reset_file_status_indicators()
		}
	}


	//Reset textarea value to when page was loaded.
	//Used by [Reset] button, and when page unloads (browser back, etc).
	//Needed becuase if the page is reloaded (ctl-r, or browser back/forward, etc.),
	//the text stays changed, but "changed" gets set to false, which looses warning.
	function Reset_File() {
		if (changed) {
			if ( !(confirm("<?php echo addslashes($_['confirm_reset']) ?>")) ) { return; }
		}
		File_textarea.value = start_value;
		Reset_file_status_indicators();
		setSelRange(File_textarea, 0, 0) //Move cursor to start of textarea.
	}

	Reset_file_status_indicators();
	</script>
<?php
}//end Edit_Page_scripts() *****************************************************




function style_sheet(){ //******************************************************
?>
<style>
/* --- reset --- */
* { border : 0; outline: 0; margin: 0; padding: 0;
    font-family: inherit; font-weight: inherit; font-style : inherit;
    font-size  : 100%; vertical-align: baseline; }


/* --- general formatting --- */

body { font-size: 1em; background: #DDD; font-family: sans-serif; }

p, table, ol { margin-bottom: .6em;}

/* div { position: relative; } *//*Causes trouble with message_box*/

h1,h2,h3,h4,h5,h6 { font-weight: bold; }
h2, h3 { font-size: 1.2em; margin: .5em 1em .5em 0; } /*TRBL*/

li { margin-left: 2em }

i, em     { font-style : italic; }
b, strong { font-weight: bold;   }

:focus { outline:0; }

table { border-collapse:separate; border-spacing:0; }
th,td { text-align:left; font-weight:400; }

a       { border: 1px solid transparent; color: rgb(100,45,0); text-decoration: none; }
a:hover { border: 1px solid #807568; background-color: rgb(255,250,150); }
a:focus { border: 1px solid #807568; background-color: rgb(255,250,150); }

label { font-size : 1em; font-weight: bold; }

pre {
	background: white;
	border    : 1px solid #807568;
	padding   : .2em;
	margin    : 0;
	}


/* --- layout --- */

.container {
	border : 0px solid #807568;
	width  : 810px;
	margin : 0 auto 2em auto;
	}


.header {
	border-bottom : 1px solid #807568;
	padding: 04px 0px 01px 0px;
	margin : 0 0 .5em 0;
	}


#logo {
	font-family: 'Trebuchet MS', sans-serif;
	font-size:2em;
	font-weight: bold;
	color: black;
	padding: .1em;
	}


.h2_filename {
	border: 1px solid #807568;
	padding: .1em .2em .1em .2em;
	font-weight: 700;
	font-family: courier;
	background-color: #EEE;
	}


#message_box { border: none; margin: 0 0 .5em 0; padding: 0; }

#message_box_contents { border: 1px solid gray; padding: 4px; background: #FFF000; }

#message_box #message_left {
	float  : left;
	margin : 0;
	padding: 0;
	border : none;
	font-weight : 900;
	}

#message_box  #X_box {
	display: block;
	float  : right;
	margin : 0;
	padding: 0 2px 0 3px;
	border : 1px solid gray;
	font   : 16pt courier;
	line-height: 18px;
	background : #EEE;
	}

#message_box  #X_box:hover {background-color: rgb(255,250,150);}
#message_box  #X_box:focus {background-color: rgb(255,250,150);}

.filename { font-family: courier; }

/* --- INDEX directory listing, table format --- */
table.index_T {
	min-width: 30em;
	font-size: .95em;
	border         : 1px outset #807568;
	border-collapse: collapse;
	margin-bottom: .7em;
	background-color: #FdFdFd;
	}

table.index_T tr:hover { border: 1px solid #807568; }

table.index_T td {
	border        : 1px inset silver;
	vertical-align: middle;
	}

.index_T td a {
	display  : block;
	height   : 1em;
	border   : none;
	padding  : .2em .2em .3em .3em;
	overflow : hidden;
	}

.index_T td a.rcd  { padding: .4em .3em .1em .3em; }
.index_T td a.rcd1 { padding: .2em .3em .3em .3em; }

.file_name { min-width: 10em; }
.file_size { min-width:  6em; }
.file_time { min-width: 15em; }

.meta_T {
	padding-right : .5em;
	text-align    : right;
	font-family   : courier;
    font-size     : .9em;
	color         : #333;
	}


.index_folders { min-height: 1.7em;  margin-bottom: .2em; }

.index_folders a {
	Xborder       : 1px solid #807568;
	display      : inline-block;
	line-height  : 1em;
	font-size    : 1em;
	margin-right : .6em;
	margin-bottom: .1em;
	padding      : 3px .4em 3px 5px; /*TRBL*/
	}


/*  front_links:  [Upload File] [New File] [New Folder] etc... */

.front_links a {
	display: inline-block;
	border : 1px solid #807568;
	height      : 1em;
	font-size   : 1em;
	margin-right: 1em;
	padding     : 3px 5px 5px 4px; /*TRBL*/
	background-color: #EEE;
	}

.front_links a .icon_fldr {margin : 1.5px 5px 0 0; }
.front_links a .icon_file {margin : 1.0px 5px 0 0; }

.front_links a:hover  { background-color: rgb(255,250,150); }
.front_links a:focus  { background-color: rgb(255,250,150); }


input[type="text"] {
	width  : 99.5%;
	border : 1px solid #807568;
	padding: 2px;
	margin-bottom: .6em;
	font   : 1em "Courier New", Courier, monospace;
	}


input[type="password"] {
	border  : 1px solid #807568;
	margin-bottom: .6em;
	padding : 2px 0px 2px 2px;
	width   : 100%;
	font    : 1em courier;
}

input:focus { background-color: rgb(255,250,150); }

input:hover { background-color: rgb(255,250,150); }

input[readonly]       { color: #333; background-color: #EEE; }
input[disabled]       { color: #555; background-color: #EEE; }
input[disabled]:hover { background-color: rgb(236,233,216);  }
input[disabled]:hover { background-color: rgb(236,233,216);  }


.buttons_right         { float: right; }
.buttons_right .button { margin-left: .5em; }

.button {
	cursor : pointer;
	border : 1px solid #807568;
	color  : black;
	padding    : 4px 10px;
	font-size  : .9em;
	font-family: sans-serif;
	background-color: #EEE;  /*#d4d4d4*/
	}

.button[disabled]  { color: #777; background-color: #EEE; }


/* --- header --- */

.nav {
	float     : right;
	display   : inline-block;
	margin-top: 1.35em;
	font-size : 1em;
	}

.nav a {
	border: 1px solid transparent;
	font-weight : bold;
	padding     : .0em;
	padding-top   : .2em;
	padding-left  : .6em;
	padding-right : .6em;
	padding-bottom: .1em;
	}

.nav a:hover { border: 1px solid #807568; }
.nav a:focus { border: 1px solid #807568; }


/* --- edit --- */

#edit_header  {margin: 0;}

#edit_form    {margin: 0;}

.edit_disabled {
	border : 1px solid #807568;
	width  : 99%;
	padding: .2em;
	margin : .5em 0 .6em 0;
	background-color: #FFF000; color: #333;
	line-height: 1.4em;
	}

.view_file { font: .9em Courier; background-color: #F8F8F8; }

#file_contents {
	border: 1px solid #999;
	font  : .9em Courier;
	margin: 0 0 .7em 0;
	width : 99.8%;
	height: 32em;
}

#file_contents:focus { border: 1px solid #Fdd; }

.file_meta	{ float: left; margin-top: .6em; font-size: .95em; color: #222; }

#edit_notes { font-size: .8em; color: #333 ;margin-top: 1em; clear:both; }

.notes      { margin-bottom: .4em; }


/* --- log in --- */

.login_page {
	margin  : 5em auto;
	border  : 1px solid #807568;
	padding : .5em 1em .6em 1em;
	width   : 370px;
	}

.login_page .nav { margin-top: .5em; }

.login_input {
	border  : 1px solid #807568;
	margin-bottom: .6em;
	padding : 2px 0px 2px 2px;
	width   : 366px;
	font    : 1em courier;
	}

.login_page input[type="text"]{ width   : 364px; }


hr { /*-- -- -- -- -- -- --*/
	line-height  : 0;
	Xfont-size    : 1px;
	display : block;
	position: relative;
	padding : 0;
	margin  : .6em auto;
	width   : 100%;
	clear   : both;
	border  : none;
	border-top   : 1px solid #807568;
	Xborder-bottom: 1px solid #eee;
	overflow: visible;
	}


table.verify {
	min-width       : 50%; 
	font            : 1em Courier;
	margin-bottom   : .7em;
	border          : 1px outset gray;
	border-collapse : collapse;
	background-color: white;
	}

table.verify th {
	border: 1px solid gray;
	padding: 0 1em 0 1em;
	text-align : center;
	font-weight: 900;
	font-family: arial;
	background-color: #EEE;
	}

table.verify td {
	border        : 1px inset silver;
	padding: .1em 1em .1em .5em;
	vertical-align: middle;
	}


.verify_del {
	border: 1px solid #F44;
	color : #222;
	background-color: #FFE7E7;
	font  : 1em Courier;
	margin-bottom: .5em;
	padding: .2em;
	}


table.verify_del    { border: 1px solid #F44; background-color: #FFE7E7; }

table.verify_del td { border: 1px solid #F44; }


#admin {padding: .3em;}

.clear {clear:both; padding: 0; margin: 0; border: none}

.web_root {font: 1em Courier;}

.icon {float: left; margin: 0 .3em 0 0;}

.mono {font-family: courier;}

.info {margin: .7em 0 .5em 0; background: #f9f9f9; padding: .2em .5em;}

.path {padding: 1px 5px 1px 5px} /*TRBL*/

.timer { border: 1px solid gray; padding: 3px .5em 4px .5em; }

.timeout { float:right; font-size: .95em; color: #333; }

.edit_btns_top    { margin: .2em 0 .5em 0;}

.image_info {color: #222; font-size: 1em ; margin: .7em 0 1em 0; }

.edit_btns_bottom { float: right; }
.edit_btns_bottom .button { margin-left: .5em; }

input[type="text"]#new_name {width  : 60%;}

.admin_buttons .button { margin-right: .5em; }

#upload_file { margin-bottom: .6em; }

.old_backup_T { float: left; margin-bottom: .3em; }

#del_backup   { float: left; margin-left  :  1em; }

/*** For old IE only: text "icons" for Rename, Copy, and Delete ***/
.RCD {font: 900 .6em arial; border: 1px solid; padding: 0px 2px 0px 2px;}
.R   {color: #804000; border-color: #804000}
.C   {color: #006400; border-color: #006400}
.D   {color: #a00;    border-color: #a00}

/**/
.ckbox {padding: 2px 4px 0 4px}
.ckbox:hover { background-color: rgb(255,250,150); }
.ckbox:focus { background-color: rgb(255,250,150); }

.action        { margin-bottom: .1em; }
.action  label {
	font: 400 .9em arial;
	color: #333;
	margin-bottom  : .1em;
	margin-right: .6em;
	padding: 3px;
	border: 1px dotted transparent;
	}

#select_all { margin: 0 2em 0 0; }

#select_all_div {
	float  : left;
	width  : 73px;
	padding: 2px 0 0 0;
	}

#select_all_label { font-size: .84em;}

#mcd_submit { padding: 2px 5px; color: rgb(100,45,0); }
</style>
<?php
}//end style_sheet() ***********************************************************




function Language_and_config_adjusted_styles() {//******************************
	global $_, $MAIN_WIDTH;
?>
<style>
.container { width: <?php echo $MAIN_WIDTH ?>; } /*Default is 810px*/

.button {
	padding  : <?php echo $_['button_padding']   ?>; /*Default 4px 10px */
	font-size: <?php echo $_['button_font_size'] ?>; /*Default .9em     */
	}

.front_links a {
	font-size   : <?php echo $_['front_links_font_size'] ?>; /*Default 1em */
	margin-right: <?php echo $_['front_links_margin_R']  ?>; /*Default 1em */
	}

.image_info {				/*Default is 1em*/
	color: #222; font-size: <?php echo $_['image_info_font_size'] ?>;
	}

.edit_btns_bottom .button {
	margin-left: <?php echo $_['button_margin_L'] ?>; /*Default is .5em*/
	}
	
	#select_all_label { font-size: <?php echo $_['select_all_label_size']?>; }
	#select_all_div   { width: <?php echo $_['select_all_div_width']?>; }
</style>
<?php
}//end Language_and_config_adjusted_styles() //*********************************




//******************************************************************************
//******************************************************************************
//Main logic to determine page action

Default_Language(); // Load Default Language settings

//If specified in config, check for & load external $LANGUAGE_FILE
if ( isset($LANGUAGE_FILE) && is_file($LANGUAGE_FILE) ) { include($LANGUAGE_FILE); }


if( PHP_VERSION_ID < PHP_VERSION_ID_REQUIRED ) {
	exit( 'PHP '.PHP_VERSION.'<br>'.hsc($_['OFCMS_requires']).' '.PHP_VERSION_REQUIRED );
}

Session_Startup();

if (!isset($_SESSION['admin_page'])) {
	$_SESSION['admin_page']  = false;
	$_SESSION['admin_ipath'] = '';
}

if ($_SESSION['valid']) {

	undo_magic_quotes();

	Get_GET();

	Init_Macros();

	Respond_to_POST();

	Verify_page_conditions();

	Update_Recent_Pages();

}//end if $_SESSION[valid] 

//Used to disable some options if editing OneFileCMS itself.
$Editing_OFCMS = false;
if ( isset($filename) && ($filename == trim(rawurldecode($ONESCRIPT), '/')) ) { $Editing_OFCMS = true; }

//Don't show path header on some pages.
$Show_Path = true;
$pages_dont_show_path = array("login","admin","hash","changepw","changeun");
if ( in_array($page, $pages_dont_show_path) ){ $Show_Path = false; } //

//Finish up/prepare to send page contents.
$early_output = ob_get_clean(); // Should be blank unless trouble-shooting.
header('Content-type: text/html; charset=UTF-8');
//end logic to determine page action *******************************************




//******************************************************************************
//******************************************************************************
//Output page contents
echo '<!DOCTYPE html>';
echo '<html><head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">';
echo '<meta name="robots" content="noindex">';

echo '<title>'.hsc($config_title.' - '.Page_Title()).'</title>';

style_sheet();

Language_and_config_adjusted_styles();

common_scripts();

echo '</head><body>';

Error_reporting_and_early_output(1,0);

if ($page == "login"){ echo '<div id="main" class="login_page">'; }
else                 { echo '<div id="main" class="container" >'; }

Page_Header();

if ($Show_Path) { Current_Path_Header(); }

message_box();

Load_Selected_Page();

//Countdown timer...
if ($page != "login") {
	echo '<hr>';
	echo Timeout_Timer($MAX_IDLE_TIME, 'timer0', 'timer timeout', 'LOGOUT');
	echo '<span class="timeout">'.hsc($_['time_out_txt']).'&nbsp; </span>';
}

//Admin link
if ( $page != "login" && ($_SESSION['admin_page'] === false) ) {
	echo '<a id="admin" href="'.$ONESCRIPT.$param1.$param2.'&amp;p=admin">'.hsc($_['Admin']).'</a>';
}elseif ($page != 'login') {
	echo '<br>';
}

echo '</div>'; //<!-- end container/login_page -->
echo '</body></html>';
