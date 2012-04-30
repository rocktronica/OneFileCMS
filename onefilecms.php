<?php
// OneFileCMS - http://onefilecms.com/
// For license & copyright info, see OneFileCMS.License.BSD.txt

$version = "1.2.0";


if( phpversion() < '5.0.0' ) { exit("OneFileCMS requires PHP5 to operate. Please contact your host to upgrade your PHP installation."); };


// CONFIGURABLE INFO
$VIEW_MODE        = "LIST"; // or BLOCK   (Actually, anything =/= BLOCK == LIST)
$config_username  = "username";
$config_password  = "password";
$config_title     = "OneFileCMS";

$config_LOCAL     = "/onefilecms/";      //local directory for icons, .css, .js, etc...
$config_csslocal  = "onefilecms.css";    //Relative to this file.
//$config_csslocal  ="/onefilecms.css";  //Relative to site URL root.
$config_csshosted = "http://self-evident.github.com/OneFileCMS/onefilecms.css";

$config_editable  = "html,htm,php,css,txt,text,cfg,conf,ini,csv,svg";
$config_excluded  = ""; //files to exclude from directory listings
$config_itypes    = "jpg,gif,png,bmp,ico";  // Can be displayed on edit page.
$config_ftypes    = "jpg,gif,png,bmp,ico,svg,txt,cvs,css,php,htm,html,cfg,conf"; //used to select file icon
$config_fclass    = "img,img,img,img,img,svg,txt,txt,css,php,htm,htm,cfg,cfg";   //used to select file icon
// END CONFIGURABLE INFO

//Make arrays out of a couple $config_variables.  They are used in // Index .
//Above, however, it's easier to config/change a simple string.
$ftypes   = (explode(",", strtolower($config_ftypes)));
$fclasses = (explode(",", strtolower($config_fclass)));
$itypes   = (explode(",", strtolower($config_itypes)));


$ONESCRIPT = $_SERVER["SCRIPT_NAME"];
$DOC_ROOT  = $_SERVER["DOCUMENT_ROOT"];
$CWD       = str_replace("\\","/",getcwd());


//Allows OneFileCMS.php to be started from any dir on the site.
chdir($DOC_ROOT);



//******************************************************************************
// Functions

function Close_Button($classes) {
	echo '<input type="button" class="button '.$classes.'" name="close" value="Close" onclick="parent.location=\'';
	echo $ONESCRIPT.'?i='.substr($_GET["f"],0,strrpos($_GET["f"],"/")).'\'">';
	?><script>document.edit_form.elements[0].focus();</script><?php // focus on [Close]
}// End Close_Button()


function Cancel_Submit_Buttons($button_label) { 
	global $ONESCRIPT, $varvar;

	// [Cancel] returns to either the current/path, or current/path/file
	if (isset($_GET["i"])){ $ipath = '?i='.rtrim($_GET["i"],"/"); }
		else if ( isset($_GET["c"]) ) { $ipath = '?f='.$_GET["c"]; }
		else if ( isset($_GET["d"]) ) { $ipath = '?f='.$_GET["d"]; }
		else if ( isset($_GET["r"]) ) { $ipath = '?f='.$_GET["r"]; }
		else{                           $ipath = rtrim($varvar,"/");
	}//end if/else if

	?>
	<p>
		<input type="button" class="button" id="cancel" name="cancel" value="Cancel" onclick="parent.location='<?php echo $ONESCRIPT.$ipath; ?>'">
		<input type="submit" class="button" value="<?php echo $button_label;?>" style="margin-left: 1.3em;">
	</p>
	<script>document.getElementById('cancel').focus();</script>
	<?php
}// End Cancel_Submit_Buttons()

// End of funtions *************************************************************



//******************************************************************************
session_start();
global $page; $page = "index";

if (isset($_POST["onefilecms_username"])) { $_SESSION['onefilecms_username'] = $_POST["onefilecms_username"]; }
if (isset($_POST["onefilecms_password"])) { $_SESSION['onefilecms_password'] = $_POST["onefilecms_password"]; }
if (($_SESSION['onefilecms_username'] == $config_username) and ($_SESSION['onefilecms_password'] == $config_password || md5($_SESSION['onefilecms_password']) == $config_password)) {
	$_SESSION['onefilecms_valid'] = "1";
} else {
	$_SESSION['onefilecms_valid'] = "0";
	$page = "login";
}

global $pagetitle; $pagetitle = "/";
if ((isset($_GET["i"])) && ($_GET["i"] !== "")) { $pagetitle = "/".$_GET["i"]."/"; }
if (isset($_GET["p"])) {
	// redirect on invalid page attempts
	$page = $_GET["p"];
	if (!in_array(strtolower($_GET["p"]), array(
		"copy","delete","error","deletefolder","edit","folder","index","login","logout","new","rename","renamefolder","upload"	)))
	{
		header("Location: ".$ONESCRIPT);
		$page = "index";
	}
}
if ( ($page == "login") and ($_SESSION['onefilecms_valid']) ) {$page = "index"; header("Location: ".$ONESCRIPT);};

if ($_GET["p"] == "login") {$pagetitle = "Log In"; }
if ($_GET["p"] == "logout") {$pagetitle = "Log Out"; $_SESSION['onefilecms_valid'] = "0"; session_destroy(); }
if ($_GET["i"] == "") { unset($_GET["i"]); }



// entitize get params *********************************************************
foreach ($_GET as $name => $value) {
	$_GET[$name] = htmlentities($value);
}



// COPY FILE *******************************************************************
if (isset($_GET["c"])) {
	$filename = $_GET["c"]; $pagetitle = "Copy &ldquo;".$filename."&rdquo;";  $page = "copy";
}

if (isset($_POST["copy_filename"]) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$old_filename = $_POST["old_filename"];
	$filename = $_POST["copy_filename"];
	copy($old_filename, $filename);
	$message = '<b>'.$old_filename."</b> copied successfully to <b>".$filename."</b>.";
}



// DELETE FILE *****************************************************************
if (isset($_GET["d"])) {
	$filename = $_GET["d"];
	$pagetitle = "Delete &ldquo;".$filename."&rdquo;";
	$page = "delete";
}
if (isset($_POST["delete_filename"]) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$filename = $_POST["delete_filename"];
	unlink($filename);
	$message = '<b>'.$filename."</b> successfully deleted.";
}



// DELETE FOLDER ***************************************************************
if ($_GET["p"] == "deletefolder") {
	$pagetitle = "Delete Folder &ldquo;".$_GET["i"]."&rdquo;";
}
if (isset($_POST["delete_foldername"]) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$foldername = $_POST["delete_foldername"];
	if (@rmdir($foldername)) {
		$message = '<b>'.$foldername."</b> successfully deleted.";
	} else {
		$message = "That folder is not empty.";
	}
}



// EDIT ************************************************************************

//*** If on Edit page, and [Save] clicked:
if (isset($_POST["filename"]) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$filename = $_POST["filename"];
	$content = stripslashes($_POST["content"]);
	$fp = @fopen($filename, "w");
	if ($fp) {
		fwrite($fp, $content);
		fclose($fp);
	}
	$message = '<b>'.$filename."</b> saved successfully.";
}//***

//*** If in directory list, and a filename is clicked:
if (isset($_GET["f"])) {
	$filename = stripslashes($_GET["f"]);
	if (file_exists($filename)) {
		$page = "edit";
		$pagetitle = "Edit &ldquo;".$filename."&rdquo;";
		$fp = @fopen($filename, "r");
		if (filesize($filename) !== 0) {
			$filecontent = fread($fp, filesize($filename));
			$filecontent = htmlspecialchars($filecontent);
		}
		fclose($fp);
	} else {
		$page = "error";
		unset ($filename);
		$message = "File does not exist.";
	}
}//***



// NEW FILE ********************************************************************
if ($_GET["p"] == "new") {$pagetitle = "New File"; }
if (isset($_POST["new_filename"]) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$filename = $_POST["new_filename"];
	if (file_exists($filename)) {
		$message = '<b>'.$filename."</b> not created. A file with that name already exists.";
	} else {
		$handle = fopen($filename, 'w') or die("can't open file");
		fclose($handle);
		$message = '<b>'.$filename."</b> created successfully.";
	}
}



// NEW FOLDER ******************************************************************
if ($_GET["p"] == "folder") {$pagetitle = "New Folder"; }
if (isset($_POST["new_folder"]) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$foldername = $_POST["new_folder"];
	if (!is_dir($foldername)) {
		mkdir($foldername);
		$message = '<b>'.$foldername."</b> created successfully.";
	} else {
		$message = "A folder by that name already exists.";
	}
}



// RENAME FILE *****************************************************************
if (isset($_GET["r"])) {
	$filename = $_GET["r"];
	$pagetitle = "Rename &ldquo;".$filename."&rdquo;";
	$page = "rename";
}
if (isset($_POST["rename_filename"]) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$old_filename = $_POST["old_filename"];
	$filename = $_POST["rename_filename"];
	rename($old_filename, $filename);
	$message = '<b>'.$old_filename."</b> successfully renamed to <b>".$filename."</b>.";
}



// RENAME FOLDER ***************************************************************
if ($_GET["p"] == "renamefolder") {$pagetitle = "Rename Folder &ldquo;".$_GET["i"]."&rdquo;"; }
if (isset($_POST["rename_foldername"]) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$old_foldername = $_POST["old_foldername"];
	$foldername = $_POST["rename_foldername"];
	if (rename($old_foldername, $foldername)) {
		$message = '<b>'.$old_foldername."</b> unsuccessfully renamed to <b>".$foldername."</b>.";
	} else {
		$message = "There was an error. Try again and/or contact your admin.";
	}
}



// UPLOAD FILE *****************************************************************
if ($_GET["p"] == "upload") {$pagetitle = "Upload File"; }
if (isset($_FILES['upload_filename']['name']) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$filename = $_FILES['upload_filename']['name'];
	$destination = $_POST["upload_destination"];
	if(move_uploaded_file($_FILES['upload_filename']['tmp_name'],
	$destination.basename($filename))) {
		$message = '<b>'.basename($filename)."</b> uploaded successfully to <b>".$destination."</b>.";
	} else{
		$message = "There was an error. Try again and/or contact your admin.";
	}
}





//******************************************************************************
//******************************************************************************
?><!DOCTYPE html>
<!-- DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"-->

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex">

<title><?php echo $config_title.' - '.$pagetitle; ?></title>


<?php //*** local or a hosted style sheet? **********************
$STYLE_SHEET = $config_csslocal;
$ROOT = $DOC_ROOT; 

// If csslocal has a leading /, assume it's location relative to $DOC_ROOT
// If it has no leading /, assume it is relative to this file.
if (substr($config_csslocal,0,1) != "/"){ $ROOT = $CWD.'/'; }

//Check for local style sheet. If not found, use hosted copy.
if (!file_exists($ROOT.$config_csslocal)) { $STYLE_SHEET = $config_csshosted; }
//***************************************************************?>

<link href="<?php echo $STYLE_SHEET;?>" type="text/css" rel="stylesheet">





<?php //===================================================================== ?>
<?php if ( ($page == "index") || ($page == "edit") ) { //load script ?>

<script>//Dispaly file's timestamp in user's local time 

function pad(num){ 
	if ( num < 10 ){ num = "0" + num; }
	return num
}


function FileTimeStamp(php_filemtime, show_offset){

	//php's filemtime returns seconds, javascript's date() uses milliseconds.
	var FileMTime = php_filemtime * 1000; 

	var TIMESTAMP  = new Date(FileMTime);
	var YEAR  = TIMESTAMP.getFullYear();
	var	MONTH = pad(TIMESTAMP.getMonth() + 1);
	var DATE  = pad(TIMESTAMP.getDate());
	var HOURS = TIMESTAMP.getHours();
	var MINS  = pad(TIMESTAMP.getMinutes());
	var SECS  = pad(TIMESTAMP.getSeconds());

	if( HOURS < 12){ AMPM = "am"; }
	else           { AMPM = "pm"; HOURS = HOURS - 12; }
	HOURS = pad(HOURS);

	var GMT_offset = -(TIMESTAMP.getTimezoneOffset()); //Yes, I know - seems wrong, but it's works.

	if (GMT_offset < 0) { NEG=-1; SIGN="-"; } else { NEG=1; SIGN="+"; } 

	var offset_HOURS = Math.floor(NEG*GMT_offset/60);
	var offset_MINS  = pad( NEG * GMT_offset % 60 );
	var offset_FULL  = "UTC " + SIGN + offset_HOURS + ":" + offset_MINS;

	if (show_offset){ var DATETIME = YEAR+"-"+MONTH+"-"+DATE+" &nbsp;"+HOURS+":"+MINS+" "+AMPM+" ("+offset_FULL+")"; }
	else            { var DATETIME = YEAR+"-"+MONTH+"-"+DATE+" &nbsp;"+HOURS+":"+MINS+" "+AMPM; }
	
	document.write( DATETIME );

}//end FileTimeStamp(php_filemtime)
</script>
<?php }//end if (index or edit), load script ================================ ?>





</head>

<body class="page_<?php echo $page; ?>">

<div class="container">

<div class="header">
	<?php echo '<a href="', $ONESCRIPT, '" id="logo">', $config_title; ?></a>

	<?php if ((isset($_SESSION['onefilecms_valid'])) && ($_SESSION['onefilecms_valid'] == "1")) { ?>
		<div class="nav">
			<a href="/">Visit Site</a> | 
			<a href="<?php echo $ONESCRIPT; ?>?p=logout">Log Out</a>
		</div>
	<?php } ?>
</div>




<?php //********** Notification of action success or failure. **********
if (isset($message)) { ?>
	<div id="message"><p><?php echo $message ;?>
	<!-- [X] to dismiss message box -->	
	<span><a href='<?php echo $ONESCRIPT.'?f='.$_GET["f"]; ?>'
	onclick='document.getElementById("message").innerHTML = " ";return false'>
	[X]</a></span></p></div>
<?php }

// On Edit page only, preserve vertical spacing for message even when empty.
if (!isset($message) && ($page == "edit")) { echo '<div id="message"></div>'; };




// COPY FILE *******************************************************************
if ($page == "copy") { 
	$extension = strrchr($filename, ".");
	$slug = substr($filename, 0, strlen($filename) - strlen($extension));
	$varvar = "?i=".substr($_GET["c"],0,strrpos($_GET["c"],"/")); ?>
	<h2>Copy &ldquo;<a href="/<?php echo $filename; ?> "> <?php echo $filename; ?> </a> &rdquo;</h2>
	<p>Existing files with the same filename are automatically overwritten... Be careful!</p>
	<form method="post" id="new" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<p>
			<label>Old filename:</label>
			<input type="hidden" name="old_filename" value="<?php echo $filename; ?>">
			<input type="text" name="dummy" value="<?php echo $filename; ?>" class="textinput" disabled="disabled">
		</p>
		<p>
			<label for="copy_filename">New filename:</label>
			<input type="text" name="copy_filename" id="copy_filename" class="textinput" value="<?php echo $slug."_".date("mdyHi").$extension; ?>">
		</p>
		<p>	<?php Cancel_Submit_Buttons("Copy"); ?>	</p>
	</form>
<?php };



// DELETE FILE *****************************************************************
if ($page == "delete") {
	$varvar = "?i=".substr($_GET["d"],0,strrpos($_GET["d"],"/")); ?>
	<h2>Delete &ldquo;<a href="/<?php echo $filename; ?> ">
	<?php echo $filename; ?></a>&rdquo;</h2>
	<p>Are you sure?</p>

	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<p>
			<input type="hidden" name="delete_filename" value="<?php echo $filename; ?>">
			<?php Cancel_Submit_Buttons("DELETE"); ?>
		</p>
	</form>
<?php };



// DELETE FOLDER ***************************************************************
if ($page == "deletefolder") {
	$varvar = "?i=".substr($_GET["i"],0,strrpos(substr_replace($_GET["i"],"",-1),"/")); ?>
	<h2>Delete Folder &ldquo;<?php echo $_GET["i"]; ?>&rdquo;</h2>
	<p>Folders have to be empty before they can be deleted.</p>
	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<p>
			<input type="hidden" name="delete_foldername" value="<?php echo $_GET["i"]; ?>">
			<?php Cancel_Submit_Buttons("DELETE"); ?>
		</p>
	</form>
<?php };



// EDIT ************************************************************************
if ($page == "edit") {

	$ext = end( explode(".", strtolower($filename)) );
 ?>
	<h2 id="edit_header">Edit &ldquo;<a href="/<?php echo $filename; ?>"> 
	<?php echo $filename; ?> 
	</a>&rdquo;</h2>

	<form id="edit_form" name="edit_form" method="post" action="<?php echo $ONESCRIPT.'?f='.$filename; ?>">

		<p class="file_meta">
		<span class="meta_size">Size<b>: </b> <?php echo number_format(filesize($filename)); ?> bytes</span> &nbsp; &nbsp; 
		<span class="meta_time">Updated<b>: </b><script>FileTimeStamp(<?php echo filemtime($filename); ?>, 1);</script></span><br>
		</p>

		<?php Close_Button("close"); ?>
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">

		<?php
		if (strpos($config_editable,$ext) === false) { ?>
			<p>
				<textarea name="content" class="textinput disabled" cols="70" rows="25" disabled="disabled">Non-text or unkown file type. Edit disabled.
				</textarea>
			</p>
		<?php } else { ?>
			<p>
				<input type="hidden" name="filename" id="filename" class="textinput" value="<?php echo $filename; ?>">
				<textarea id="file_content" onkeyup="Check_for_changes(event);" name="content" class="textinput" cols="70" rows="25"><?php echo $filecontent; ?></textarea>
			</p>
		<?php } ?>	

		<p class="buttons_right">
		<input type="submit" class="button" name="save_file" id="save_file" value="Save"  onclick="submitted = true;"  disabled="disabled">
		<input type="button" class="button" id="reset"  value="Reset - loose changes" onclick="Reset_File()"  disabled="disabled">
		<input type="button" class="button" name="rename_file" value="Rename/Move" onclick="parent.location='<?php echo $ONESCRIPT.'?r='.$filename; ?>'">
		<input type="button" class="button" name="delete_file" value="Delete"      onclick="parent.location='<?php echo $ONESCRIPT.'?d='.$filename; ?>'">
		<input type="button" class="button" name="copy_file"   value="Copy"        onclick="parent.location='<?php echo $ONESCRIPT.'?c='.$filename; ?>'">
		<?php Close_Button(""); ?>
		</p>
	</form>
	<div style="clear:both;"></div>

	<?php if (strpos($config_editable,$ext) !== false) { ?>
		<div id="edit_note">
		NOTE: On some browsers, such as Chrome, if you click the browser [Back] then browser [Forward] (or vice versa), the file state may not be accurate.  To correct, click the browser's [Reload].
		</div>
	<?php } ?>


	<!--======== Provide feedback re: unsaved changes ========-->
	<script>
	    
	var File_textarea    = document.getElementById('file_content');
	var Save_File_button = document.getElementById('save_file');
	var Reset_button     = document.getElementById('reset');

	var start_value = File_textarea.value;
	var submitted   = false
	var changed     = false;



	// The following events only apply when the element is active.
	// [Save] is disabled unless there are changes to the open file.
	Save_File_button.onfocus = function() {Save_File_button.style.backgroundColor = "rgb(255,250,150)";}
	Save_File_button.onblur  = function() {Save_File_button.style.backgroundColor ="#Fee";}
	Save_File_button.onmouseover = function() {Save_File_button.style.backgroundColor = "rgb(255,250,150)";}
	Save_File_button.onmouseout  = function() {Save_File_button.style.backgroundColor = "#Fee";}



	function Reset_file_status_indicators() {
		changed = false;
		File_textarea.style.backgroundColor = "#eFe";  //light green
		Save_File_button.style.backgroundColor = "";
		Save_File_button.style.borderColor = "";
		Save_File_button.style.borderWidth = "1px";
		Save_File_button.disabled = "disabled";
		Save_File_button.value = "Save";
		Reset_button.disabled = "disabled";
		//File_textarea.focus();
	}


	window.onbeforeunload = function() {
		if ( changed && !submitted) { 
			//FF4+ Ingores the supplied msg below & only uses a system msg for the prompt.
			return "               Unsaved changes will be lost!";
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
			document.getElementById('message').innerHTML = " "; // Must have a space, or it won't clear the msg.
			File_textarea.style.backgroundColor = "#Fee";  //light red
			Save_File_button.style.backgroundColor ="#Fee";
			Save_File_button.style.borderColor = "#F44";   //less light red
			Save_File_button.style.borderWidth = "1px";
			Save_File_button.disabled = "";
			Reset_button.disabled = "";
			Save_File_button.value = "SAVE CHANGES!";
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
			if ( !(confirm("Reset file and loose unsaved changes?")) ) { return; }
		}
		File_textarea.value = start_value;
		Reset_file_status_indicators();
		setSelRange(File_textarea, 0, 0) //MOve cursor to start of textarea.
	}
	
	
	Reset_file_status_indicators()
	</script>

<?php }; //End Edit page **************************************************** ?>






<?php // INDEX *****************************************************************
if ($page == "index") {
	$varvar = "";
	if (isset($_GET["i"])) { $varvar = $_GET["i"]."/"; }

 	// Current path. ie: docroot/current/path/ 
	// Each level is a link to that level.
	echo '<h2>';
		$full_path = basename(getcwd());
		if (isset($_GET["i"])) { $full_path = basename(getcwd()).'/'.$_GET["i"]; }

		$path_levels = explode("/",$full_path);
		$levels = count($path_levels); //If levels=3, indexes = 0, 1, 2  etc...

		//docroot folder of site
		if ($_GET["i"] == "") { 
			echo $path_levels[0].' /'; // if at root, no need for link.
		} else {
			echo '<a href="'.$ONESCRIPT.'" class="path"> '.$path_levels[0].' </a>/';
		}

		//Remainder of current/path
		for ($x=1; $x < $levels; $x++) {
			if ($x !== 1){ $current_path .= '/'; }
			$current_path = $current_path.$path_levels[$x];
			echo '<a href="'.$ONESCRIPT.'?i='.$current_path.'" class="path"> ';
			echo ' '.$path_levels[$x]." </a>/";
		}
	?></h2>


	<!--===== List folders/sub-directores =====-->
	<p class="index_folders">
		<?php
		$files = glob($varvar."*",GLOB_ONLYDIR);
		natcasesort($files);
		foreach ($files as $file) {
			echo '<a href="'.$ONESCRIPT.'?i='.$file.'" class="folder">'.basename($file).' /</a>';
		} ?>
	</p>
	


	<!--============== List files - BLOCK view ===============-->
	<?php
	function BLOCK_view() {
	global $varvar, $config_excluded, $ftypes, $fclasses ; 
	 ?>
	<div style="clear:both;"></div>
	<ul class="index">
		<?php
		$files = glob($varvar."{,.}*", GLOB_BRACE);
		natcasesort($files); //sort w/o regard to case.

		foreach ($files as $file) {
			$excludeme = 0;
			$config_excludeds = explode(",", $config_excluded);

			foreach ($config_excludeds as $config_exclusion) {
				if (strrpos(basename($file),$config_exclusion) !== False && 
				strrpos(basename($file),$config_exclusion) !== "") { 
					$excludeme = 1;
				}
			}
			
			if (!is_dir($file) && $excludeme == 0) {
				//Determine file type & set cooresponding class.
				$file_class = "";
				$ext = end( explode(".", strtolower($file)) );

				for ($x=0; $x < count($ftypes); $x++ ){
					if ($ext == $ftypes[$x]){ $file_class = $fclasses[$x]; } 
				}
		?>
					<li><?php //****** Actual file name & info ******/ ?>
						<a href="<?php echo $ONESCRIPT.'?f='.$file.'" class=" '.$file_class.'">';
						echo basename($file); ?></a>
						<div class="meta">
							<span><i>File Size:</i> 
							<?php echo number_format(filesize($file)); ?><br></span>
							<span><i>Updated:</i> 
							<script>FileTimeStamp(<?php echo filemtime($file); ?>);</script></span>
						</div>
					</li>
			<?php } ?>
		<?php } ?>
	</ul>
	<?php }//end BLOCK_view() ===========================-->?>



	<?php //<!--======== List files in vertical table ========-->
	function list_view() {
	
	global $varvar, $config_excluded, $ftypes, $fclasses ; 
	
	$files = glob($varvar."{,.}*", GLOB_BRACE);
	natcasesort($files);

	echo '<table class="index_T">';
		foreach ($files as $file) {
			$fc++;
			$excludeme = 0;
			$config_excludeds = explode(",", $config_excluded);
			
			foreach ($config_excludeds as $config_exclusion) {
				if (strrpos(basename($file),$config_exclusion) !== False && 
				strrpos(basename($file),$config_exclusion) !== "") { 
					$excludeme = 1;
				}
			}
			
			if (!is_dir($file) && $excludeme == 0) {
				
				//Determine file type & set cooresponding class.
				$file_class = "";
				$ext = end( explode(".", strtolower($file)) );
				
				for ($x=0; $x < count($ftypes); $x++ ){
					if ($ext == $ftypes[$x]){ $file_class = $fclasses[$x]; } 
				}
	?>
					<tr>
						<td>
							<?php echo "<a href='", $ONESCRIPT,"?f=", $file, "'"; ?>
							<?php echo "class='",  $file_class, "'>", basename($file), "</a>"; ?>
						</td>
						<td class="meta_T meta_size">&nbsp;
							<?php echo number_format(filesize($file)).""; ?> B
						</td>
						<td class="meta_T meta_time"> &nbsp;
							<script>FileTimeStamp(<?php echo filemtime($file); ?>);</script>
						</td>
					</tr>
		<?php 
			}//end if !is_dir
		}//end foreach file
		?>
	</table>
	<?php }//end list_view()
	// <!--===== End of directory listing in vertical table =====-->
	?>



	<?php //<!-- Determine view mode, list files. ====================-->
		if ($VIEW_MODE == "BLOCK"){ BLOCK_view(); }
		else                      { list_view();  }
	?>



	<!--=== Upload/New/Rename/Copy/etc... links ===-->
	<p class="front_links">
		<a href="<?php echo $ONESCRIPT.'?p=upload&amp;i='.$varvar; ?>" class="upload">Upload File</a>
		<a href="<?php echo $ONESCRIPT.'?p=new&amp;i='.$varvar; ?>"    class="new">New File</a>
		<a href="<?php echo $ONESCRIPT.'?p=folder&amp;i='.$varvar; ?>" class="newfolder">
		New Folder</a>
		<?php if ($varvar !== "") { ?>
			<a href="<?php echo $ONESCRIPT.'?p=deletefolder&amp;i='.$varvar; ?>" class="deletefolder">
			Delete Folder</a>
			<a href="<?php echo $ONESCRIPT.'?p=renamefolder&amp;i='.$varvar; ?>" class="renamefolder">
			Rename Folder</a>
		<?php } ?>
	</p>
<?php };
// End of Index (file listing) page ********************************************




// LOG IN **********************************************************************
if ($page == "login") { ?>
	<h2>Log In</h2>
	<form method="post" action="<?php echo $ONESCRIPT; ?>">
		<p>
			<label for="onefilecms_username">Username:</label>
			<input type="text" name="onefilecms_username" id="onefilecms_username" class="login_input">
		</p>
		<p>
			<label for="onefilecms_password">Password:</label>
			<input type="password" name="onefilecms_password" id="onefilecms_password" class="login_input">
		</p>
			
		<input type="submit" class="button" value="Enter">
	</form>
	<script>document.getElementById('onefilecms_username').focus();</script>
<?php };




// LOG OUT *********************************************************************
if ($page == "logout") { ?>
	<h2>Log Out</h2>
	<p>You have successfully been logged out and may close this window.</p>
<?php };




// NEW FILE ********************************************************************
if ($page == "new") {
	$varvar = "";
	if (isset($_GET["i"])) { $varvar = "?i=".$_GET["i"]; }?>
		<h2>New File</h2>
		<p>Existing files with the same name will not be overwritten.</p>
		<form method="post" id="new" action="<?php echo $ONESCRIPT.substr_replace($varvar,"",-1); ?>">
			<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
			<p>
				<label for="new_filename">New filename: </label>
				<input type="text" name="new_filename" id="new_filename" class="textinput" value="<?php echo $_GET["i"]; ?>">
			</p>
			<p>	<?php Cancel_Submit_Buttons("Create"); ?> </p>
		</form>
<?php };




// NEW FOLDER ******************************************************************
if ($page == "folder") {
	$varvar = "";
	if (isset($_GET["i"])) { $varvar = "?i=".$_GET["i"]; }?>
	<h2>New Folder</h2>
	<p>Existing folders with the same name will not be overwritten.</p>
	<form method="post" action="<?php echo $ONESCRIPT.substr_replace($varvar,"",-1); ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<p>
			<label for="new_folder">Folder name: </label>
			<input type="text" name="new_folder" id="new_folder" class="textinput" value="<?php echo $_GET["i"]; ?>">
		</p>
		<p>	<?php Cancel_Submit_Buttons("Create"); ?> </p>
	</form>
<?php };




// RENAME FILE *****************************************************************
if ($page == "rename") {
	$varvar = "?i=".substr($_GET["r"],0,strrpos($_GET["r"],"/")); ?>
	<h2>Rename &ldquo;<a href="/<?php echo $filename; ?>">	<?php echo $filename; ?> </a>&rdquo;</h2>
	<p>Existing files with the same filename are automatically overwritten... Be 
	careful!</p>
	<p>To move a file, preface its name with the folder's name, as in 
	"<i>foldername/filename.txt</i>." The folder must already exist.</p>
	<form method="post" action="<?php echo $ONESCRIPT.$varvar;	?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<p>
			<label>Old filename:</label>
			<input type="hidden" name="old_filename" value="<?php echo $filename; ?>">
			<input type="text" name="dummy" value="<?php echo $filename; ?>" class="textinput" disabled="disabled">
		</p>
		<p>
			<label for="rename_filename">New filename:</label>
			<input type="text" name="rename_filename" id="rename_filename" class="textinput" value="<?php echo $filename; ?>">
		</p>
		<p><?php Cancel_Submit_Buttons("Rename"); ?></p>
	</form>
<?php };




// RENAME FOLDER ***************************************************************
if ($page == "renamefolder") {
	$varvar = "?i=".substr($_GET["i"],0,strrpos(substr_replace($_GET["i"],"",-1),"/")); ?>
	<h2>Rename Folder &ldquo;<?php echo $_GET["i"]; ?>&rdquo;</h2>
	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<p>
			<label>Old name:</label><input type="hidden" name="old_foldername" value="<?php echo $_GET["i"]; ?>">
			<input type="text" name="dummy" value="<?php echo $_GET["i"]; ?>" class="textinput" disabled="disabled">
		</p>
		<p>
			<label for="rename_foldername">New name:</label>
			<input type="text" name="rename_foldername" id="rename_foldername" class="textinput" value="<?php echo $_GET["i"]; ?>">
		</p>
		<p><?php Cancel_Submit_Buttons("Rename"); ?></p>
	</form>
<?php };




// UPLOAD FILE *****************************************************************
if ($page == "upload") {
	$varvar = ""; if (isset($_GET["i"])) { $varvar = "?i=".$_GET["i"]; } ?>
	<h2>Upload</h2>
	<form enctype="multipart/form-data" action="<?php echo $ONESCRIPT.substr_replace($varvar,"",-1); ?>" method="post">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000">
		<p>
			<label for="upload_destination">Destination:</label>
			<input type="text" name="upload_destination" value="<?php echo $_GET["i"]; ?>" class="textinput">
		</p>
		<p>
			<label for="upload_filename">File:</label>
			<input name="upload_filename" type="file" size="93">
		</p>
		<p><?php Cancel_Submit_Buttons("Upload"); ?></p>
	</form>
<?php } ?>




<div class="footer">
	<hr>
</div>


</div>


</body>
</html>

