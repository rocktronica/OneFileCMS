<?php
// OneFileCMS - http://onefilecms.com/
// For license & copyright info, see OneFileCMS.License.BSD.txt

$version = '1.5';


if( phpversion() < '5.0.0' ) { exit("OneFileCMS requires PHP5 to operate (v5.4 recommended). Please contact your host to upgrade your PHP installation."); };


// CONFIGURABLE INFO ***********************************************************
$config_username  = "username";
$config_password  = "password";
$config_title     = "OneFileCMS";

$MAX_IMG_W   = 810;   // Max width to display images. (page container = 810)
$MAX_IMG_H   = 1000;  // Max height.  I don't know, it just looks reasonable.

$config_favicon   = "/favicon.ico";
$config_excluded  = ""; //files to exclude from directory listings- CaSe sensaTive!

$config_etypes = "html,htm,xhtml,php,css,js,txt,text,cfg,conf,ini,csv,svg"; //lowercase, no spaces!
$config_itypes = "jpg,gif,png,bmp,ico"; //lowercase, no spaces!
$config_ftypes = "jpg,gif,png,bmp,ico,svg,txt,cvs,css,php,ini,cfg,conf,js,htm,html"; //lowercase, no spaces!
$config_fclass = "img,img,img,img,img,svg,txt,txt,css,php,txt,cfg,cfg,txt,htm,htm";  //lowercase, no spaces!
// END CONFIGURABLE INFO *******************************************************



//Make arrays out of a few $config_variables for actual use later.
//Above, however, it's easier to config/change a simple string.
$etypes   = (explode(",", strtolower($config_etypes))); //editable file types
$itypes   = (explode(",", strtolower($config_itypes))); //images types to display
$ftypes   = (explode(",", strtolower($config_ftypes))); //file types with icons
$fclasses = (explode(",", strtolower($config_fclass))); //for file types with icons
$excluded_list = (explode(",", $config_excluded));


$ONESCRIPT = $_SERVER["SCRIPT_NAME"];
$DOC_ROOT  = $_SERVER["DOCUMENT_ROOT"].'/';
$WEB_ROOT  = basename($DOC_ROOT).'/';
$WEBSITE   = $_SERVER["HTTP_HOST"];
$pagetitle = $_SERVER['SERVER_NAME']; //Default value. May be changed per page.

$valid_pages = array("login","logout","index","edit","upload","new","copy","rename","delete","newfolder","renamefolder","deletefolder" );


//Allows OneFileCMS.php to be started from any dir on the site.
chdir($DOC_ROOT);





//******************************************************************************
session_start();

//*** Verify session *******************
if (isset($_POST["username"])) { $_SESSION['username'] = $_POST["username"]; }
if (isset($_POST["password"])) { $_SESSION['password'] = $_POST["password"]; }

if (($_SESSION['username'] == $config_username) and
   ( $_SESSION['password'] == $config_password || md5($_SESSION['password']) == $config_password))
     { $_SESSION['valid'] = "1"; $page = "index"; }
else { $_SESSION['valid'] = "0"; $page = "login"; unset($_GET["p"]); }



//*** entitize $_GET params ************
foreach ($_GET as $name => $value) { $_GET[$name] = htmlentities($value); }



//*** Clean up & check a path **********
function Check_path($path) { // returns first valid path in some/supplied/path/
	global $message; 
	$nopath = $path; //used for message if supplied $path doesn't exist.
	$path = str_replace('\\','/',$path);   //Make sure all forward slashes.
	$path = trim($path,"/ ."); // trim leading & trailing slashes, dots, and spaces

	//Remove any '.' and '..' parts of the path. (More reliable than str_replace.)
	$pathparts = explode( '/', $path);
	$len       = count($pathparts);
	$path      = "";  //Cleaned path.
	for ($x=0 ; $x < $len; $x++  ) {
		if ( !(($pathparts[$x] == '..') && (!$pathparts[$x] == '.')) ) {
			$path .= $pathparts[$x].'/';
		}
	}
	$path = trim($path,"/"); // Remove -for now- final trailing slash.

	if (strlen($path) < 1) { $path = ""; }
	else {
		if (!is_dir($path) && (strlen($message) < 1))
			{ $message .= "<b>(!)</b> Directory does not exist: ".$nopath.'<br>'; }

		while ( (strlen($path) > 0) && (!is_dir($path)) ) {
			$path = dirname($path);
		}
		$path = $path.'/';
		if ($path == './') { $path = ""; }
	}
	return $path; 
}//end Check_path() ********************



//*** Get main parameters **************
if (isset($_GET["i"])) { $ipath    = Check_path($_GET["i"]); }else{ $ipath    = ""; }
if (isset($_GET["f"])) { $filename = $ipath.$_GET["f"]; }else{ $filename = ""; }
if (isset($_GET["p"])) { $page     = $_GET["p"]; } // default $page set above

$varvar = "?i=".$ipath;



//*** Verify valid $page ***************
if ($page != "") {
	if (!in_array(strtolower($page), $valid_pages)) {
		header("Location: ".$ONESCRIPT); // redirect on invalid page attempts
		$page = "index";
	}
}
//
//End session startup***********************************************************





//******************************************************************************
// Misc Functions


function Current_Path_Header(){ //**************************
 	// Current path. ie: webroot/current/path/ 
	// Each level is a link to that level.

	global $ONESCRIPT, $ipath, $WEB_ROOT;

	echo '<h2>';
		$path_levels  = explode("/",trim($ipath,'/') );
		$levels = count($path_levels); //If levels=3, indexes = 0, 1, 2  etc... 
		if ($ipath == "" ){ $levels = 0;} //if at root
		$current_path = "";

		//Root folder of web site.
		echo '<a href="'.$ONESCRIPT.'" class="path"> '.trim($WEB_ROOT, '/').' </a>/';

		//Remainder of current/path
		for ($x=0; $x < $levels; $x++) {
			$current_path .= $path_levels[$x].'/';
			echo '<a href="'.$ONESCRIPT.'?i='.$current_path.'" class="path"> ';
			echo ' '.$path_levels[$x]." </a>/";
		}
	echo '</h2>';
}//end Current_Path_Header() //*****************************



function is_empty($path){ //********************************
	$empty = false;
	$dh = opendir($path);
	for($i = 3; $i; $i--) { $empty = (readdir($dh) === FALSE); }
	closedir($dh);
	return $empty;
}//end is_emtpy() //****************************************



function message_box() { //*********************************
	global $ONESCRIPT, $message, $page;

	if (isset($message)) {
?>
		<div id="message"><p>
		<span><!-- [X] to dismiss message box -->	
			<a id="dismiss" href='<?php echo $ONESCRIPT.$varvar; ?>'
			onclick='document.getElementById("message").innerHTML = " ";return false'>
			[X]</a>
		</span>
		<?php echo $message.PHP_EOL ;?>
		</p></div>
		<script>document.getElementById("dismiss").focus();</script>
<?php
	}else {
		echo '<div id="message"></div>'; // Needed on Edit page to keep js feedback from failing
	} //end isset($message)
	
	// Used on Edit Page to preserve vertical spacing.
	if ($page == "edit") {echo '<style>#message { min-height: 1.8em; }</style>';}
}//end message_box()  **************************************



function Upload_New_Rename_Delete_Links() { //**************
	global $ONESCRIPT, $ipath, $varvar;

	echo '<p class="front_links">';
	echo '<a href="'.$ONESCRIPT.$varvar.'&amp;p=upload"    class="upload" >Upload File</a>';
	echo '<a href="'.$ONESCRIPT.$varvar.'&amp;p=new"       class="new" >New File</a>'   ;
	echo '<a href="'.$ONESCRIPT.$varvar.'&amp;p=newfolder" class="newfolder" >New Folder</a>' ;
	if ($ipath !== "") {
		echo '<a href="'.$ONESCRIPT.$varvar.'&amp;p=renamefolder" class="renamefolder" >Rename Folder</a>';
		echo '<a href="'.$ONESCRIPT.$varvar.'&amp;p=deletefolder" class="deletefolder" >Delete Folder</a>';
	}
	echo '</p>';
}//end Upload_New_Rename_Delete_Links()  *******************



function Close_Button($classes) { //************************
	global $ONESCRIPT, $ipath, $varvar;
	echo '<input type="button" class="button '.$classes.'" name="close" value="Close" onclick="parent.location=\'';
	echo $ONESCRIPT.$varvar.'\'">';
	?><script>document.edit_form.elements[1].focus();</script><?php // focus on [Close]
}// End Close_Button() //***********************************



function Cancel_Submit_Buttons($submit_label, $focus) { //**
	//$submit_label = Rename, Copy, Delete, etc...
	//$focus: if==1 or TRUE, set focus() to cancel button.
	global $ONESCRIPT, $ipath, $varvar, $filename, $page;

	// [Cancel] returns to either the current/path, or current/path/file
	if ($filename != "") { $varvar .= '&f='.basename($filename).'&p='.edit; }
?>
	<p>
		<input type="button" class="button" id="cancel" name="cancel" value="Cancel"
			onclick="parent.location='<?php echo $ONESCRIPT.$varvar; ?>'">
		<input type="submit" class="button" value="<?php echo $submit_label;?>" style="margin-left: 1.3em;">
	</p>
<?php
	if ($focus != ""){ echo '<script>document.getElementById("'.$focus.'").focus();</script>'; }

}// End Cancel_Submit_Buttons() //**************************



function show_image(){ //***********************************
	global $filename, $MAX_IMG_W, $MAX_IMG_H;
	
	$IMG = $filename;
	$img_info = getimagesize($IMG);

	$W=0; $H=1;
	$SCALE = 1; $TOOWIDE = 0; $TOOHIGH = 0;
	if ($img_info[$W] > $MAX_IMG_W) { $TOOWIDE = ( $MAX_IMG_W/$img_info[$W] );}
	if ($img_info[$H] > $MAX_IMG_H) { $TOOHIGH = ( $MAX_IMG_H/$img_info[$H] );}
	
	if ($TOOHIGH || $TOOWIDE) {
		if     (!$TOOWIDE)           {$SCALE = $TOOHIGH;}
		elseif (!$TOOHIGH)           {$SCALE = $TOOWIDE;}
		elseif ($TOOHIGH > $TOOWIDE) {$SCALE = $TOOWIDE;} //ex:if (.90 > .50)
		else                         {$SCALE = $TOOHIGH;}
	}

	echo '<p class="file_meta">';
	echo 'Image shown at ~'. round($SCALE*100) .'% of full size ('.$img_info[3].').</p>';
	echo '<div style="clear:both;"></div>';
	echo '<a href="/' . $IMG . '">';
	echo '<img src="/'.$IMG.'"  height="'.$img_info[$H]*$SCALE.'"></a>';
}// end show_image() ***************************************



//if file_exists(), ordinalize filename until it doesn't ***
function ordinalize($destination,$filename, &$message) {

	$ordinal   = 0;
	$savefile = $destination.$filename;

	if (file_exists($savefile)) {

		$message .= '<br><b>(!)</b> A file with that name already exists in the target directory.<br>';
		$savefile_info = pathinfo($savefile);

		while (file_exists($savefile)) {

			$ordinal = sprintf("%03d", ++$ordinal); //  001, 002, 003, etc...
			$newfilename = $savefile_info['filename'].'.'.$ordinal.'.'.$savefile_info['extension'];
			$savefile = $destination.$newfilename;

		}
		$message .= 'Saving as: <b>"</b>'.'<b>'.$newfilename.'"</b>';
	}
	return $savefile;
}//end ordinalize filename *********************************



function show_favicon(){
	global $config_favicon, $DOC_ROOT;
	if (file_exists($DOC_ROOT.$config_favicon)) { 
		echo '<img src="'.$config_favicon.'" alt="">'; 
	}
}// end show_favicon()

//
// End of misc funtions ********************************************************





//Don't load login screen if already in a valid session *************
if (($page == "login") and ($_SESSION['valid'])) { $page = "index"; }




if ($page == "login")        { $pagetitle = "Log In";         }
if ($page == "edit")         { $pagetitle = "Edit/View File"; }
if ($page == "upload")       { $pagetitle = "Upload File";    }
if ($page == "new")          { $pagetitle = "New File";       }
if ($page == "copy" )        { $pagetitle = "Copy";           }
if ($page == "rename")       { $pagetitle = "Rename File";    }
if ($page == "delete")       { $pagetitle = "Delete";         }
if ($page == "newfolder")    { $pagetitle = "New Folder";     }
if ($page == "renamefolder") { $pagetitle = "Rename Folder";  }
if ($page == "deletefolder") { $pagetitle = "Delete Folder";  }





//Logout ***********************************************************************
if ($page == "logout") {
	$page = "login";  $pagetitle = "Login";
	$_SESSION['valid'] = "0";
	session_destroy();
	$message = 'You have successfully logged out.';
}//*****************************************************************************





function Login_Page() { //******************************************************
	global $ONESCRIPT;
?>
	<h2>Log In</h2>
	<form method="post" action="<?php echo $ONESCRIPT; ?>">
		<p>
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" class="login_input" >
		</p>
		<p>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" class="login_input">
		</p>
			
		<input type="submit" class="button" value="Enter">
	</form>
	<script>document.getElementById('username').focus();</script>
<?php } //end Login_Page() *****************************************************





// Login Page response message**************************************************
if (isset($_POST["username"])) {
	if (($_SESSION['username'] != $config_username) || ($_SESSION['password'] != $config_password))
		{ $message = "<b>(!) INVALID LOGIN ATTEMPT</b>"; }
}//end Login Page response message**********************************************






function list_files() { // ...in a vertical table ******************************
//called from Index Page

	global $ONESCRIPT, $ipath, $varvar, $ftypes, $fclasses, $excluded_list;

	$files = scandir('./'.$ipath);
	natcasesort($files);

	echo '<table class="index_T">';
	foreach ($files as $file) {
		
		$excluded = FALSE;
		if (in_array(basename($file), $excluded_list)) { $excluded = TRUE; };
		
		if (!is_dir($ipath.$file) && !$excluded) {
		
			//Determine file type & set cooresponding class.
			$file_class = "";
			$ext = end( explode(".", strtolower($file)) );
			for ($x=0; $x < count($ftypes); $x++ ){
				if ($ext == $ftypes[$x]){ $file_class = $fclasses[$x]; } 
			}
?>
			<tr>
				<td>
					<?php echo '<a href="'.$ONESCRIPT.$varvar.'&amp;f='.$file.'&amp;p=edit" '; ?>
					<?php echo 'class="',  $file_class, '">', $file, '</a>'; ?>

				</td>
				<td class="meta_T meta_size">&nbsp;
					<?php echo number_format(filesize($ipath.$file)).""; ?> B
				</td>
				<td class="meta_T meta_time"> &nbsp;
					<script>FileTimeStamp(<?php echo filemtime($ipath.$file); ?>);</script>
				</td>
			</tr>
<?php 
		}//end if !is_dir
	}//end foreach file
echo '</table>';
}//end list_files() ************************************************************





function Index_Page(){ //*******************************************************
	global $ONESCRIPT, $ipath;

	//<!--==== List folders/sub-directores ====-->
	echo '<p class="index_folders">';
		$folders = glob($ipath."*",GLOB_ONLYDIR);
		natcasesort($folders);
		foreach ($folders as $folder) {
			echo '<a href="'.$ONESCRIPT.'?i='.$folder.'/" class="index_folder">';

			echo basename($folder).' /</a>';
		}
	echo '</p>';

	Upload_New_Rename_Delete_Links();

	list_files();

	Upload_New_Rename_Delete_Links();

}//end Index_Page()*************************************************************





function Edit_Page() { //*******************************************************
	global $ONESCRIPT, $ipath, $varvar, $filename, $filecontent, $etypes, $itypes, $ftypes;

	$varvar2 = $varvar.'&amp;p=edit';
	$varvar3 = $varvar.'&amp;f='.basename($filename);
	
	//Determine if editable file type
	$ext = end( explode(".", strtolower($filename) ) );
	$editable = FALSE;
	if (in_array(strtolower($ext), $etypes)) { $editable = TRUE; };
?>
	<h2 id="edit_header">Edit/View:
	<a class="filename" href="/<?php echo $filename.'">'.basename($filename) ?></a>
	</h2>

	<form id="edit_form" name="edit_form" method="post" action="<?php echo $ONESCRIPT.$varvar2 ?>">
		<p class="file_meta">
		<span class="meta_size">Size<b>: </b> <?php echo number_format(filesize($filename)); ?> bytes</span> &nbsp; &nbsp; 
		<span class="meta_time">Updated<b>: </b><script>FileTimeStamp(<?php echo filemtime($filename); ?>, 1);</script></span><br>
		</p>
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<?php Close_Button("close"); ?><div style="clear:both;"></div>

		<?php if ( !in_array( strtolower($ext), $itypes) ) { //If non-image, show textarea
			if (!$editable) { // If non-text file, disable textarea
			?>	<p>
				<textarea id="disabled_content" cols="70" rows="3"
				disabled="disabled">Non-text or unkown file type. Edit disabled.</textarea>
				</p>
			<?php } else {
				$fp = @fopen($filename, "r");
				if (filesize($filename) !== 0) {
					$filecontent = fread($fp, filesize($filename));
					$filecontent = htmlspecialchars($filecontent);
				}
				fclose($fp);
			?>	<p>
				<input type="hidden" name="filename" id="filename" class="textinput" value="<?php echo $filename; ?>">
				<textarea id="file_content" name="content" class="textinput" cols="70" rows="25" onkeyup="Check_for_changes(event);"><?php echo $filecontent; ?></textarea>
				</p>
			<?php } //end if editable ?>	
		<?php  } //end if non-image, show textarea ?>
		
		<p class="buttons_right">
		<input type="submit" class="button" value="Save"                  onclick="submitted = true;" id="save_file">
		<input type="button" class="button" value="Reset - loose changes" onclick="Reset_File()"      id="reset">
		<script>
			//Setting disabled here instead of via input attribute in case js is disabled.
			//If js is disabled, user would be unable to save changes.
			document.getElementById('save_file').disabled = "disabled";
			document.getElementById('reset').disabled     = "disabled";
		</script>
		<input type="button" class="button" value="Rename/Move" onclick="parent.location='<?php echo $ONESCRIPT.$varvar3.'&amp;p=rename'; ?>'">
		<input type="button" class="button" value="Copy"        onclick="parent.location='<?php echo $ONESCRIPT.$varvar3.'&amp;p=copy'  ; ?>'">
		<input type="button" class="button" value="Delete"      onclick="parent.location='<?php echo $ONESCRIPT.$varvar3.'&amp;p=delete'; ?>'">
		<?php Close_Button(""); ?>
		</p>
	</form>
	<div style="clear:both;"></div>
<?php
	if ( in_array( strtolower($ext), $itypes) ) { show_image(); }

	if ($editable) {
		Edit_Page_scripts();
		echo '<div id="edit_note">NOTE: On some browsers, such as Chrome, if you click the browser [Back] then browser [Forward] (or vice versa), the file state may not be accurate.  To correct, click the browser\'s [Reload].</div>';
	} //end if editable

}//End Edit_Page ***************************************************************






// EDIT Page response code *****************************************************
//*** If on Edit page, and [Save] clicked:
if ( $page == "edit" && isset($_POST["filename"]) && $_SESSION['valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$filename = $_POST["filename"];
	$content = $_POST["content"];
	$fp = @fopen($filename, "w");
	if ($fp) {
		fwrite($fp, $content);
		fclose($fp);
		$message = '<b>"'.$filename.'"</b> saved...';
		$page == "edit";
	}else{
		$message = '<b>(!) There was an error saving file.</b>';
	}
}//end EDIT Page response code**************************************************






function Upload_Page() { //*****************************************************
	global $ONESCRIPT, $ipath, $varvar;
?>
	<h2>Upload File</h2>
	<form enctype="multipart/form-data" action="<?php echo $ONESCRIPT.$varvar; ?>" method="post">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<input type="hidden" name="MAX_FILE_SIZE" value="100000">
		<input type="hidden" name="upload_destination" value="<?php echo $ipath; ?>" >
		<input name="upload_filename" type="file" size="100">
		<p><?php Cancel_Submit_Buttons("Upload","cancel"); ?></p>
	</form>
<?php } //end Upload_Page() ****************************************************





// UPLOAD FILE response code ***************************************************
if (isset($_FILES['upload_filename']['name']) && $_SESSION['valid'] = "1" && $_POST["sessionid"] == session_id()) {

	$filename    = $_FILES['upload_filename']['name'];
	$destination = Check_path($_POST["upload_destination"]);

	if (($filename == "")){ 
		$message = "<b>(!) No file selected for upload... </b>";
	}elseif (($destination != "") && !is_dir($_POST["upload_destination"])) {
		$message .= '<b>(!)</b> Destination folder does not exist: <br><b>';
		$message .= ''.$WEB_ROOT.$destination.'</b><br><b>Upload cancelled.</b>';
	}else{
		$message .= 'Uploading: <b>"'.$filename.'"</b> to <b>"'.$WEB_ROOT.$destination.'"</b>';
		
		$savefile = ordinalize($destination, $filename, $message);

		if(move_uploaded_file($_FILES['upload_filename']['tmp_name'], $savefile)) {
			$message .= '<br>Upload successful.';
		} else{
			$message .= "<br><b>(!) There was an error.</b> Upload or rename may have failed.";
		}
	}
} //end Upload file response code **********************************************






function New_File_Page() { //***************************************************
	global $ONESCRIPT, $WEB_ROOT, $ipath, $varvar;
?>
		<h2 style="float: left;">New File</h2>
		<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
			<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
			<input type="text" name="new_filename" id="new_filename" class="textinput1" value="">
			<p>	<?php Cancel_Submit_Buttons("Create","new_filename"); ?> </p>
		</form>
<?php
}//end New_File_Page()**********************************************************





// NEW FILE response code ******************************************************
if (isset($_POST["new_filename"]) && $_SESSION['valid'] = "1" && $_POST["sessionid"] == session_id()) {

	$filename = $ipath.trim($_POST["new_filename"],'/ '); //trim spaces & slashes
	$savefile = $DOC_ROOT.$filename;

	if (($_POST["new_filename"] == "")){ 
		$message = "<b>(!) New file not created - no filename given... </b>";
	}elseif (file_exists($savefile)) {
		$message = '<b>(!) "'.$filename.'"</b> not created. A file with that name already exists.';
	} else {
		$handle = fopen($savefile, 'w') or die("can't open file");
		fclose($handle);
		$message = '"<b>'.$filename.'</b>"successfully created.';
		$ipath = Check_path(dirname($filename)); //if changed, return to new dir.
		$varvar = "?i=".$ipath;
		$page = "edit";
	}
}//end NEW FILE response code **************************************************






function Copy_File_Page(){ //***************************************************
	global $ONESCRIPT, $WEB_ROOT, $ipath, $varvar, $filename;

	$new_filename = ordinalize($ipath, basename($filename));
?>
	<h2>Copy File</h2>

	<form method="post" id="new" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<p>
			<label>Old filename:</label>
			<span class="web_root"><?php echo $WEB_ROOT; ?></span>
			<input type="hidden" name="old_filename" value="<?php echo $filename; ?>">
			<input type="text"   name="dummy" value="<?php echo $filename; ?>" disabled="disabled">
		</p>
		<p>
			<label for="copy_filename">New filename:</label>
			<span class="web_root"><?php echo $WEB_ROOT; ?></span>
			<input type="text" name="copy_filename" id="copy_filename" 
				  class="textinput" value="<?php echo $new_filename; ?>">
		</p>
		<p><?php Cancel_Submit_Buttons("Copy","copy_filename"); ?></p>
	</form>
<?php }//end Copy_File_Page() **************************************************




	
// COPY FILE response code *****************************************************
if (isset($_POST["copy_filename"]) && $_SESSION['valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$old_filename = $_POST["old_filename"];
	$new_filename = $_POST["copy_filename"];

	if (file_exists($new_filename)) {
		$message .= '<b>(!) Error copying file - target filename already exists:<br>';
		$message .= '(!) '.$new_filename.'</b>';
		$page = "edit";
		$filename = $old_filename;
	}elseif (copy($old_filename, $new_filename)){ 
		$message  = '<b>"'.$old_filename.'"</b><br>';
		$message .= ' --- successfully copied to ---<br>';
		$message .= '<b>"'.$new_filename.'"</b>';
	}else{
		$message .= '<b>(!) Error copying file:<br>"'.$new_filename.'"</b>';
	}
}//end COPY FILE response code *************************************************





function Rename_File_Page() { //************************************************
	global $ONESCRIPT, $WEB_ROOT, $ipath, $varvar, $filename;
?>
	<h2>Rename/Move File</h2>

	<p>To move a file, change the folder's name, as in 
	"newfolder/filename.txt". The new folder must already exist.</p>

	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<p>
			<label>Old filename:</label>
			<span class="web_root"><?php echo $WEB_ROOT; ?></span>
			<input type="text" name="old_filename" value="<?php echo $filename; ?>" class="textinput" readonly="readonly">
		</p>
		<p>
			<label for="rename_filename">New filename:</label>
			<span class="web_root"><?php echo $WEB_ROOT; ?></span>
			<input type="text" name="rename_filename" id="rename_filename" class="textinput" value="<?php echo $filename; ?>">
		</p>
		<p><?php Cancel_Submit_Buttons("Rename", "rename_filename"); ?></p>
	</form>
<?php } //end Rename_File_Page() ***********************************************





// RENAME FILE response code ***************************************************
if (isset($_POST["rename_filename"]) && $_SESSION['valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$old_filename = $_POST["old_filename"];
	$new_filename = trim($_POST["rename_filename"], '/');

	$page = "edit"; //return to edit page
	
	if (file_exists($new_filename)) {
		$message .= '<b>(!) Error renaming or moving file - target filename already exists:<br>';
		$message .= '(!) '.$new_filename.'</b>';
		$page = "edit";
		$filename = $old_filename;
	}elseif (rename($old_filename, $new_filename)) {
		$message .= '<b>"'.$old_filename.'</b>"<br>';
		$message .= ' --- successfully renamed to ---<br>';
		$message .= '<b>"'.$new_filename.'</b>"<br>';
		$filename = $new_filename;
		$ipath = Check_path(dirname($filename)); //if changed, return to new dir.
		$varvar = '?i='.$ipath;
	}else{
		$message .= '<b>(!) Error renaming/moving file from:<br>"'.$old_filename.'"</b>';
		$message .= '<b>(!) To:<br>"'.$new_filename.'"</b>';
	}
}//end RENAME FILE response code ***********************************************





function Delete_File_Page() { //************************************************
	global $ONESCRIPT, $WEB_ROOT, $ipath, $varvar, $filename;
?>
	<h2 style="float: left;">Delete File</h2>

	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<input type="hidden" name="delete_filename" value="<?php echo $filename; ?>" >
		<span class="verify"><?php echo basename($filename); ?></span>
		<p class="sure"><b>Are you sure?</b></p>
		<?php Cancel_Submit_Buttons("DELETE", "cancel"); ?>
	</form>
<?php } //end Delete_File_Page() ***********************************************





// DELETE FILE response code ***************************************************
if (isset($_POST["delete_filename"]) && $_SESSION['valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$filename = $_POST["delete_filename"];

	if (unlink($filename)) {
		$message = '"<b>'.basename($filename).'</b>" successfully deleted.';
	}else{
		$message = '<b>(!) Error deleting "'.$filename.'"</b>.';
		$page = "edit";
	}
}//end DELETE FILE response code ***********************************************





function New_Folder_Page() { //*************************************************
	global $ONESCRIPT, $WEB_ROOT, $ipath, $varvar;
?>
	<h2 style="float: left;">New Folder</h2>
	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<input type="text" name="new_folder" id="new_folder" class="textinput1" value="">
		<p><?php Cancel_Submit_Buttons("Create","new_folder"); ?></p>
		
	</form>
<?php } // end New_Folder_Page() ***********************************************





// NEW FOLDER response code ****************************************************
if (isset($_POST["new_folder"]) && $_SESSION['valid'] = "1" && $_POST["sessionid"] == session_id()) {

	$new_folder = $ipath.trim($_POST["new_folder"],"/").'/'; //make sure only has a single trailing slash.


	if ($_POST["new_folder"] == ""){ 
		$message .= "<b>(!) New folder not created - no name given... </b>";
	}elseif (is_dir($new_folder)) {
		$message .= '<b>(!) Folder already exists: ';
		$message .= ''.$new_folder.'</b>';
	}elseif (mkdir($new_folder)) {
		$message .= 'Folder "<b>'.basename($new_folder).'</b>" successfully created.';
		$ipath   = $new_folder;  //cd to new folder
		$varvar = "?i=".$ipath;
	}else{
		$message .= "<b>(!) Error- new folder not created.</b>";
	}
}//end NEW FOLDER response code ************************************************





function Rename_Folder_Page() { //**********************************************
	global $ONESCRIPT, $WEB_ROOT, $ipath, $varvar;
?>
	<h2>Rename Folder</h2>
	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<p>
			<label>Old name:</label><input type="hidden" name="old_foldername" value="<?php echo $ipath; ?>">
			<span class="web_root"><?php echo $WEB_ROOT.Check_path(dirname($ipath)); ?></span>
			<input type="text" name="dummy" value="<?php echo basename($ipath); ?>" class="textinput1" disabled="disabled">
		</p>
		<p>
			<label for="new_foldername">New name:</label>
			<span class="web_root"><?php echo $WEB_ROOT.Check_path(dirname($ipath)); ?></span>
			<input type="text" name="new_foldername" id="new_foldername" class="textinput1" value="<?php echo basename($ipath); ?>">
		</p>
		<p><?php Cancel_Submit_Buttons("Rename","new_foldername"); ?></p>
	</form>
<?php } //end Rename_Folder_Page() *********************************************





// RENAME FOLDER response code *************************************************
if (isset($_POST["new_foldername"]) && $_SESSION['valid'] = "1" && $_POST["sessionid"] == session_id()) {

	$old_foldername = $_POST["old_foldername"]; // entire old $ipath
	$new_foldername = $_POST["new_foldername"]; // not entire path - only end foldername

	//Removed any trailing slashes
	$new_foldername = Check_path(dirname($old_foldername)).trim($new_foldername, '/');

	if (file_exists($new_foldername)) {
		$message .= '<b>(!) Error renaming folder- target name already exists:</b><br>';
		$message .= '<b>&nbsp; &nbsp; '.$WEB_ROOT.$new_foldername.'</b><br>';
	}elseif (rename($old_foldername, $new_foldername)) {
		$message .= '<b>"'.$old_foldername.'</b>"<br>';
		$message .= ' --- successfully renamed to ---<br>';
		$message .= '<b>"'.$new_foldername.'/</b>"<br>';
		$ipath    = Check_path($new_foldername); //Return to new folder
		$varvar = "?i=".$ipath;
	} else {
		$message = "<b>(!)</b> There was an error during rename. Try again and/or contact your admin.";
	}
}//end RENAME FOLDER response code *********************************************





function Delete_Folder_Page(){ //***********************************************
	global $ONESCRIPT, $WEB_ROOT, $ipath, $varvar;
?>
	<br><h2>Delete Folder</h2>

	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>">
		<input type="hidden" name="delete_foldername" value="<?php echo $ipath; ?>" >
		<span class="web_root"><?php echo $WEB_ROOT.Check_path(dirname($ipath)); ?></span>
		<span class="verify"><?php echo basename($ipath); ?></span> /
		<p class="sure"><b>Are you sure?</b></p>
		<?php Cancel_Submit_Buttons("DELETE", "cancel"); ?>
	</form>
<?php } //end Delete_Folder_Page() //*******************************************





// DELETE FOLDER response code *************************************************
if ( ($page == "deletefolder") && !is_empty($ipath) ) {
	$message = '<b>(!) Folder not empty.</b>  Folders must be empty before they can be deleted.<br>';
	$page = "index";
}

if (isset($_POST["delete_foldername"]) && $_SESSION['valid'] = "1" && $_POST["sessionid"] == session_id()) {

	$page = "index"; //Return to index
	$foldername = trim($_POST["delete_foldername"], '/');

	if (@rmdir($foldername)) {
		$message = 'Folder "<b>'.basename($foldername).'</b>" successfully deleted.';
		$ipath = Check_path($foldername); //Return to parent dir.
		$varvar = "?i=".$ipath;
	} else {
		$message .= '<b>(!) "'.$foldername.'/"</b> an error occurred during delete.';
	}
}//end DELETE FOLDER response code *********************************************





function Load_Selected_Page(){ //***********************************************
	global $page;
	if ($page == "login")        { Login_Page();         }
	if ($page == "index")        { Index_Page();         }
	if ($page == "edit")         { Edit_Page();          }
	if ($page == "upload")       { Upload_Page();        }
	if ($page == "new")          { New_File_Page();      }
	if ($page == "copy")         { Copy_File_Page();     }
	if ($page == "rename")       { Rename_File_Page();   }
	if ($page == "delete")       { Delete_File_Page();   }
	if ($page == "newfolder")    { New_Folder_Page();    }
	if ($page == "renamefolder") { Rename_Folder_Page(); }
	if ($page == "deletefolder") { Delete_Folder_Page(); }
}//end Load_Selected_Page() ****************************************************






//******************************************************************************
function Time_Stamp_scripts() {  ?>

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
<?php }//end Time_Stamp_scripts() ******************************************





function Edit_Page_scripts() { //********************************************
?>
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

<?php }//End Edit_Page_scripts() ********************************************





function style_sheet(){ //****************************************************?>
<style>
/* --- reset --- */
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,
cite,code,del,dfn,em,font,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,dl,dt,dd,ol,ul,li,
fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td
{border : 0;  outline: 0; margin : 0; padding: 0;
font-family: inherit; font-weight: inherit; font-style : inherit;
font-size  : 100%; vertical-align: baseline; }



/* --- general formatting --- */

body { font-size: 1em; background: #DDD; font-family: sans-serif; }

p, table { margin-bottom: .5em; }

div{position: relative;}

h1,h2,h3,h4,h5,h6{font-weight: bold;}
h2 { font-size: 20px; margin: 0 1em .2em 0;} /*TRBL*/
h3 { font-size: 18px; margin-top: 15px; }
h4 { font-size: 1.3em; margin-bottom: .2em; font-weight: normal;}

em, i { font-style: italic; }

strong { font-weight: bold; }

li {line-height: 1.4em; }

:focus{outline:0;}

ol,ul{list-style:none;}

table{border-collapse:separate;border-spacing:0;}

caption,th,td{text-align:left;font-weight:400;}

blockquote:before,blockquote:after,q:before,q:after{content:"";}
blockquote,q{quotes:"" "";}

a { border: 1px solid transparent; color: rgb(100,45,0); text-decoration: none; }
a:hover { border: 1px solid #807568; background-color: rgb(255,250,150); }
a:focus { border: 1px solid #807568; background-color: rgb(255,250,150); }

form p { margin-bottom: 5px; }


label { display: inline-block; width : 7em; font-size : 1em; }



pre {
	background: white;
	border: 1px solid #807568;
	line-height: 1.25em;
	overflow: auto
	overflow-Y: hidden;
	padding: 10px;
	margin: 5px 0 10px 0;
	overflow: hidden;
	}


/* --- layout --- */

.container {
	border : 0px solid #807568;
	width  : 810px;
	margin : 0em auto;
	}


.header {
	border-bottom : 1px solid #807568;
	padding: 04px 0px 04px 0px;
	margin : 0;
	margin-bottom : .5em;
	}


#logo {
	font-family: 'Trebuchet MS', sans-serif;
	font-size:2.2em;
	font-weight: bold;
	color: black;
	padding: .1em;
	}


.footer { color: #777; font-size: .7em; }


.alignleft { margin: 0 10px 10px 0; float: left; }


.dirname { font-weight: 400; }

.filename {
	border: 1px solid #807568;
	padding: .1em .2em .1em .2em;
	font-weight: 700;
	font-family: courier;
	background-color: #EEE;
	}

/* Preserve space when message is dismissed.*/
#message { margin-bottom: .5em;}

#message p {
	margin: 0;
	padding: 4px 0px 4px .5em;
	border: 1px solid #807568;
	Xfont-family: courier;
	font-size: 1em;
	line-height: 1.2em;
	background: #fff000;
	}

#message span { float: right; }

#message #dismiss { padding: 5px 4px 5px 4px; border-right: none; } /*TRBL */ /*font-family: Courier; font-size: 1.2em;*/


/* --- INDEX directory listing, table format --- */
table.index_T {
	min-width: 30em;
	font-size: .95em;
	border-style: outset;
	border-width: 1px;
	border-color: #807568;
	border-collapse: collapse;
	margin-bottom: .7em;
	background-color: #FdFdFd;
	}
	
table.index_T  tr:hover { border: 1px solid #807568; }

table.index_T td { 
	border-width  : 1px;
	border-color  : silver;
	border-style  : inset;
	vertical-align: middle;
	}

.index_T a { 
	height : 1em;
	display: block;
	padding: .2em 1em .3em 1.6em;
	color  : rgb(100,45,0);
	border : none;
	background : url("http://self-evident.github.com/OneFileCMS/images/file-bin.png") 3px no-repeat;
	overflow   : hidden;
	}


.index_T a.txt { background: url("http://self-evident.github.com/OneFileCMS/images/file-txt.png") 3px no-repeat; }
.index_T a.htm { background: url("http://self-evident.github.com/OneFileCMS/images/file-htm.png") 3px no-repeat; }
.index_T a.css { background: url("http://self-evident.github.com/OneFileCMS/images/file-css.png") 3px no-repeat; }
.index_T a.php { background: url("http://self-evident.github.com/OneFileCMS/images/file-php.png") 3px no-repeat; }
.index_T a.cfg { background: url("http://self-evident.github.com/OneFileCMS/images/file-cfg.png") 3px no-repeat; }
.index_T a.img { background: url("http://self-evident.github.com/OneFileCMS/images/file-img.png") 3px no-repeat; }
.index_T a.bin { background: url("http://self-evident.github.com/OneFileCMS/images/file-bin.png") 3px no-repeat; }
.index_T a.svg { background: url("http://self-evident.github.com/OneFileCMS/images/file-svg.png") 3px no-repeat; }

.index_T a:hover { background-color: rgb(255,250,150); }
.index_T a:focus { background-color: rgb(255,250,150); }



/* File size & date */

.meta_size { min-width: 6em; }

.meta_time { width    : 13em;}

.meta {
	height        : 25px;
	line-height   : 1.1em;
	font-size     : .9em;
	margin-top    : 3px;
	padding-right : .5em;
    font-size     : .9em;
	color         : #333;
	}

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
	padding      : 3px .4em 3px 25px; /*TRBL*/
	background : url("http://self-evident.github.com/OneFileCMS/images/folder-2.png") 4px 3px no-repeat;
	}

.index_folders a:hover { background-color: rgb(255,250,150); }
.index_folders a:focus { background-color: rgb(255,250,150); }



/*  [Upload File] [New File] [New Folder] etc... */

.front_links { clear: both; }

.front_links a {
	display: inline-block;
	border : 1px solid #807568;
	height      : 16px;
	font-size   : 16px;
	margin-right: 15px;
	padding     : 3px 5px 5px 21px; /*TRBL*/
	background-color: #EEE;
	}

.front_links a.upload       { background: #EEE url("http://self-evident.github.com/OneFileCMS/images/upload.png") 3px      3px no-repeat; }
.front_links a.new          { background: #EEE url("http://self-evident.github.com/OneFileCMS/images/file-new-2.png")      3px 4px no-repeat; }
.front_links a.newfolder    { background: #EEE url("http://self-evident.github.com/OneFileCMS/images/folder-new-2.png")    2px 5px no-repeat; }
.front_links a.renamefolder { background: #EEE url("http://self-evident.github.com/OneFileCMS/images/folder-rename-1.png") 1px 4px no-repeat; }
.front_links a.deletefolder { background: #EEE url("http://self-evident.github.com/OneFileCMS/images/folder-del-3.png")    1px 5px no-repeat; }

.front_links a:hover  { background-color: rgb(255,250,150); }
.front_links a:focus  { background-color: rgb(255,250,150); }


input[type="text"] {
	border: 1px solid #807568;
	padding: 2px;
	width: 630px;
	font: 1em "Courier New", Courier, monospace;
	}

input.textinput1 { width: 20em; }

input.textinput2 { width: 40em; }

textarea {
	border: 1px solid #999;
	font  : .95em "Courier New", Courier, monospace;
	margin: 0 0 .5em 0; /*T R B L*/
	width : 99.5%;
	height: 30em;
	height: 30em;
	}

textarea[disabled ]{ width : 99.5%; height: 50px; }

textarea:focus { border: 1px solid #Faa; }


input:focus { background-color: rgb(255,250,150); }

input:hover { background-color: rgb(255,250,150); }

input[readonly]       { color: #333; background-color: #EEE; }
input[disabled]       { color: #555; background-color: #EEE; }
input[disabled]:hover { background-color: rgb(236,233,216);  } 
input[disabled]:hover { background-color: rgb(236,233,216);  } 


.buttons_right         { float: right; }
.buttons_right .button { margin-left: 7px; }
.buttons_left          { float: left; }
.buttons_left  .button { margin-right: 7px; }

.button {
	border : 1px solid #807568;
	padding: 4px 10px;
	cursor : pointer;
	color      : black;
	font-size  : .9em;
	font-family: sans-serif;
	background-color: #EEE;  /*#d4d4d4*/
	}

.button[disabled]  { color: #777; background-color: #EEE; }


/* --- header --- */

.nav {
	float     : right;
	display   : inline-block;
	margin-top: 1.6em;
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

#file_content {height: 24em;}

.file_meta	  {float: left;  margin-top: .5em; font-size: .9em; color: #333; font-family: courier;}

.close        {float: right; margin-bottom: .5em;}

#edit_note    {font-size: .8em; color: #444 ;margin-top: 1em;}



/* --- log in --- */

.login_page {
	margin  : 5em auto;
	border  : 1px solid #807568;
	padding : 1em;
	width   : 360px;
	}

.login_input {
	border  : 1px solid #807568;
	padding : 2px 0px 2px 2px;
	width   : 356px;
	font    : 1em "Courier New";
	}

input[type="text"].login_input { width   : 354px; }



/* --- --- --- */
hr { 
	line-height  : 0;
	font-size    : 1px;
	display : block;
	position: relative;
	padding : 0;
	margin  : 8px auto;
	width   : 100%;
	clear   : both;
	border  : none;
	border-top   : 1px solid #807568;
	Xborder-bottom: 1px solid #eee;
	overflow: visible;
	}

.web_root { font:1.2em Courier; }

.sure { margin: .5em 0em .5em 0; }

.verify {
	border: 1px solid #807568;
	color: #333;
	background-color: #FEE;
	padding: 2px .3em;
	font: 1.2em Courier;
	}


</style>
<?php }//end style_sheet() *****************************************************






//******************************************************************************
//******************************************************************************
?><!DOCTYPE html>

<html>
<head>

<title><?php echo $config_title.' - '.$pagetitle ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="robots" content="noindex">

<?php style_sheet(); ?>

<?php if ( ($page == "index") || ($page == "edit") ) { Time_Stamp_scripts(); } ?>

</head>

<body>

<?php
if ($page == "login"){ echo '<div class="login_page">'; }
				 else{ echo '<div class="container">';  }
?>

<div class="header">
	<?php echo '<a href="', $ONESCRIPT, '" id="logo">', $config_title; ?></a>
	<?php echo $version; ?>
	
	<?php if ($_SESSION['valid'] == "1") { ?>
		<div class="nav">
			<a href="/"><?php show_favicon() ?>&nbsp; 
			<b><?php echo $WEBSITE ?>/</b>  &nbsp;- &nbsp;
			Visit Site</a> |
			<a href="<?php echo $ONESCRIPT ?>?p=logout">Log Out</a>
		</div>
	<?php } ?>
</div><!-- end header -->

<?php message_box() ?>

<?php if ( $page != "login" ){ Current_Path_Header(); } ?>

<?php Load_Selected_Page() ?>

<div class="footer">
	<hr><br><br>
</div>

</div><!-- end container -->

</body>
</html>
