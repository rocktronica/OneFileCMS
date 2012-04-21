<?php
// OneFileCMS - http://onefilecms.com/
// Version 1.1.7 
// For license & copyright info, see OneFileCMS.License.BSD.txt


if( phpversion() < '5.0.0' ) { exit("OneFileCMS requires PHP5 to operate. Please contact your host to upgrade your PHP installation."); };

// CONFIGURATION INFO
$version          = "1.1.7"; // ONEFILECMS_BEGIN
$ONESCRIPT        = $_SERVER["SCRIPT_NAME"];
$config_username  = "username";
$config_password  = "password";
//$config_hint     = ""; //Not currently used
$config_title     = "OneFileCMS";
$config_footer    = date("Y")." <a href='http://onefilecms.com/'>OneFileCMS</a>.";

$config_disabled  = "bmp,ico,gif,jpg,png,psd,zip,exe,swf";
$config_excluded  = ""; //files to exclude from directory listings
$config_LOCAL     = "_onefilecms/";  //local directory for icons, .css, .js, etc...
$config_csslocal  = $config_LOCAL."onefilecms.css"; //Relative to site URL root. Don't use leading '/'.
$config_csshosted = "http://self-evident.github.com/OneFileCMS/onefilecms.css";
$config_JQlocal   = $config_LOCAL."jquery.min.js";
$config_JQhosted  = "http://code.jquery.com/jquery-1.7.2.min.js";
//$config_JQhosted  = "http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js";

//Allows OneFileCMS.php to be started from any dir on the site.
chdir($_SERVER["DOCUMENT_ROOT"]);



//******************************************************************************
// Functions

function Close_Button($classes) {
	echo '<input type="button" class="button '.$classes.'" name="close" value="Close" onclick="parent.location=\'';
	echo $ONESCRIPT.'?i='.substr($_GET["f"],0,strrpos($_GET["f"],"/")).'\'" />';
}


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
		<input type="button" class="button" name="cancel" value="Cancel" onclick="parent.location='<?php echo $ONESCRIPT.$ipath; ?>'"/>
		<input type="submit" class="button" value="<?php echo $button_label;?>" style="margin-left: 2.5em;">
	</p>
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
if (isset($_POST["filename"]) && $_SESSION['onefilecms_valid'] = "1" && $_POST["sessionid"] == session_id()) {
	$filename = $_POST["filename"];
	$content = stripslashes($_POST["content"]);
	$fp = @fopen($filename, "w");
	if ($fp) {
		fwrite($fp, $content);
		fclose($fp);
	}
	$message = '<b>'.$filename."</b> saved successfully.";
}
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
}



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
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="noindex">

<title><?php echo $config_title.' - '.$pagetitle; ?></title>

<?php 
$STYLE_SHEET = '/'.$config_csslocal;
//Check for local style sheet
if (!file_exists($config_csslocal)) { $STYLE_SHEET = $config_csshosted; }
?>

<link href="<?php echo $STYLE_SHEET;?>" type="text/css" rel="stylesheet" />

</head>

<body class="page_<?php echo $page; ?>">

<div class="container">

<div class="header">
	<?php echo '<a href="', $ONESCRIPT, '" id="logo" >', $config_title; ?></a>

	<?php if ((isset($_SESSION['onefilecms_valid'])) && ($_SESSION['onefilecms_valid'] == "1")) { ?>
		<div class="nav">
			<a href="/">Visit Site</a> | 
			<a href="<?php echo $ONESCRIPT; ?>">Index</a> | 
			<a href="<?php echo $ONESCRIPT; ?>?p=logout">Log Out</a>
		</div>
	<?php } ?>
</div>



<?php if (isset($message)) { echo '<div id="message"><p>'.$message.'</p></div>'; };



// COPY FILE *******************************************************************
if ($page == "copy") { 
	$extension = strrchr($filename, ".");
	$slug = substr($filename, 0, strlen($filename) - strlen($extension));
	$varvar = "?i=".substr($_GET["c"],0,strrpos($_GET["c"],"/")); ?>
	<h2>Copy &ldquo;<a href="/<?php echo $filename; ?> "> <?php echo $filename; ?> </a> &rdquo;</h2>
	<p>Existing files with the same filename are automatically overwritten... Be careful!</p>
	<form method="post" id="new" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
		<p>
			<label>Old filename:</label>
			<input type="hidden" name="old_filename" value="<?php echo $filename; ?>" />
			<input type="text" name="dummy" value="<?php echo $filename; ?>" class="textinput" disabled="disabled" />
		</p>
		<p>
			<label for="copy_filename">New filename:</label>
			<input type="text" name="copy_filename" id="copy_filename" class="textinput" value="<?php echo $slug."_".date("mdyHi").$extension; ?>" />
		</p>
		<p>	<?php Cancel_Submit_Buttons("Copy"); ?>	</p>
	</form>
<?php };



// DELETE FILE *****************************************************************
if ($page == "delete") {
	$varvar = "?i=".substr($_GET["d"],0,strrpos($_GET["d"],"/")); ?>
	<h2>Delete &ldquo;<a href="/<?php echo $filename; ?> " >
	<?php echo $filename; ?></a>&rdquo;</h2>
	<p>Are you sure?</p>

	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
		<p>
			<input type="hidden" name="delete_filename" value="<?php echo $filename; ?>" />
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
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
		<p>
			<input type="hidden" name="delete_foldername" value="<?php echo $_GET["i"]; ?>" />
			<?php Cancel_Submit_Buttons("DELETE"); ?>

		</p>
	</form>
<?php };



// EDIT ************************************************************************
if ($page == "edit") { ?>
	<h2 id="edit_header">Edit &ldquo;
	<a href="/<?php echo $filename; ?>" >
	<?php echo $filename; ?>
	</a>&rdquo;</h2>

	<form method="post" action="<?php echo $ONESCRIPT.'?f='.$filename; ?>">
		<?php Close_Button("close"); ?>
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
		<?php $lfile = strtolower($filename);
		if (strpos($config_disabled,end(explode(".", $lfile)))) { ?>
			<p>
				<textarea name="content" class="textinput disabled" cols="70" rows="25" disabled="disabled">Disabled.</textarea>
			</p>
			<p class="buttons_right">
				<input type="submit" class="button" name="save_file" value="Save" 
				disabled="disabled" />
		<?php } else { ?>
			<p>
				<input type="hidden" name="filename" id="filename" class="textinput" value="<?php echo $filename; ?>" />
				<textarea name="content" class="textinput" cols="70" rows="25"><?php echo $filecontent; ?></textarea>
			</p>
			<p class="buttons_right">
				<input type="submit" class="button" name="save_file" id="save_file" value="Save" />
		<?php } ?>
			<input type="button" class="button" name="rename_file" value="Rename/Move" onclick="parent.location='<?php echo $ONESCRIPT.'?r='.$filename; ?>'" />
			<input type="button" class="button" name="delete_file" value="Delete"      onclick="parent.location='<?php echo $ONESCRIPT.'?d='.$filename; ?>'" />
			<input type="button" class="button" name="copy_file"   value="Copy"        onclick="parent.location='<?php echo $ONESCRIPT.'?c='.$filename; ?>'" />
			<?php Close_Button(""); ?>
		</p><div class="meta">
			<p>File Size: <?php echo number_format(filesize($filename)); ?> &nbsp; &ndash; &nbsp;
			   Updated: <?php echo date("Y-m-d\, h:ia", filemtime($filename)); ?>
			</p>
		</div>
	</form>
	<div style="clear:both;"></div>
<?php };



// INDEX ***********************************************************************
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
		sort($files);
		foreach ($files as $file) {
			echo '<a href="'.$ONESCRIPT.'?i='.$file.'" class="folder">'.basename($file).' /</a>';
		} ?>
	</p>
	


	<!--============= List files ==============-->
	<div style="clear:both;"></div>
	<ul class="index">
		<?php $files = glob($varvar."{,.}*", GLOB_BRACE); sort($files);
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
				$file_class = "";
				$lfile = strtolower($file);
				if (
					(strrpos(strtolower($lfile),".jpg")) || 
					(strrpos($lfile,".gif")) || 
					(strrpos($lfile,".png")) || 
					(strrpos($lfile,".ico"))
				) {
					$file_class = "img";
				};
				if (strrpos($lfile,".css")) { $file_class = "css"; };
				if (strrpos($lfile,".php")) { $file_class = "php"; };
				if (strrpos($lfile,".htm")) { $file_class = "htm"; };
				if (strrpos($lfile,".html")) { $file_class = "htm"; };
		?>
					<li>
						<a href="<?php echo $ONESCRIPT.'?f='.$file.'" class=" '.$file_class.'">';
						echo basename($file); ?></a>
						<div class="meta">
							<span><i>File Size:</i>
							<?php echo round(filesize($file)/1000,2);?> kb<br /></span>
							<span><i>Last Updated:</i>
							<?php echo date("n/j/y g:ia", filemtime($file)); ?></span>
						</div>
					</li>
			<?php }
		} ?>
	</ul>

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



// LOG IN **********************************************************************
if ($page == "login") { ?>
	<h2>Log In</h2>
	<form method="post" action="<?php echo $ONESCRIPT; ?>">
		<p>
			<label for="onefilecms_username">Username:</label>
			<input type="text" name="onefilecms_username" id="onefilecms_username" class="login_input" />
		</p>
		<p>
			<label for="onefilecms_password">Password:</label>
			<input type="password" name="onefilecms_password" id="onefilecms_password" class="login_input" />
		</p>
			
		<input type="submit" class="button" value="Enter" />
	</form>
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
			<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
			<p>
				<label for="new_filename">New filename: </label>
				<input type="text" name="new_filename" id="new_filename" class="textinput" value="<?php echo $_GET["i"]; ?>" />
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
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
		<p>
			<label for="new_folder">Folder name: </label>
			<input type="text" name="new_folder" id="new_folder" class="textinput" value="<?php echo $_GET["i"]; ?>" />
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
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
		<p>
			<label>Old filename:</label>
			<input type="hidden" name="old_filename" value="<?php echo $filename; ?>" />
			<input type="text" name="dummy" value="<?php echo $filename; ?>" class="textinput" disabled="disabled" />
		</p>
		<p>
			<label for="rename_filename">New filename:</label>
			<input type="text" name="rename_filename" id="rename_filename" class="textinput" value="<?php echo $filename; ?>" />
		</p>
		<p><?php Cancel_Submit_Buttons("Rename"); ?></p>
	</form>
<?php };



// RENAME FOLDER ***************************************************************
if ($page == "renamefolder") {
	$varvar = "?i=".substr($_GET["i"],0,strrpos(substr_replace($_GET["i"],"",-1),"/")); ?>
	<h2>Rename Folder &ldquo;<?php echo $_GET["i"]; ?>&rdquo;</h2>
	<form method="post" action="<?php echo $ONESCRIPT.$varvar; ?>">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
		<p>
			<label>Old name:</label><input type="hidden" name="old_foldername" value="<?php echo $_GET["i"]; ?>" />
			<input type="text" name="dummy" value="<?php echo $_GET["i"]; ?>" class="textinput" disabled="disabled" />
		</p>
		<p>
			<label for="rename_foldername">New name:</label>
			<input type="text" name="rename_foldername" id="rename_foldername" class="textinput" value="<?php echo $_GET["i"]; ?>" />
		</p>
		<p><?php Cancel_Submit_Buttons("Rename"); ?></p>
	</form>
<?php };



// UPLOAD FILE *****************************************************************
if ($page == "upload") {
	$varvar = ""; if (isset($_GET["i"])) { $varvar = "?i=".$_GET["i"]; } ?>
	<h2>Upload</h2>
	<form enctype="multipart/form-data" action="<?php echo $ONESCRIPT.substr_replace($varvar,"",-1); ?>" method="post">
		<input type="hidden" name="sessionid" value="<?php echo session_id(); ?>" />
		<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
		<p>
			<label for="upload_destination">Destination:</label>
			<input type="text" name="upload_destination" value="<?php echo $_GET["i"]; ?>" class="textinput" />
		</p>
		<p>
			<label for="upload_filename">File:</label>
			<input name="upload_filename" type="file" size="93"/>
		</p>
		<p><?php Cancel_Submit_Buttons("Upload"); ?></p>
	</form>
<?php } ?>



<div class="footer"> <hr>

</div>

</div>



<?php //************************************************************************
$JQUERY = '/'.$config_JQlocal;
//Check for local copy of jquery
if (!file_exists($config_JQlocal)) { $JQUERY = $config_JQhosted; }
?>

<script src="<?php echo $JQUERY; ?>"></script>
<script type="text/javascript">
	$.fn.ready(function(){
	
		var $message = $("#message"),
		    $save_file = $("#save_file");

		//This line fades out the message after specified time (3000 = 3 seconds)
		//if ( $message.length > 0 ) { $message.animate({opacity: 1.0}, 3000).fadeOut(); };
		
		$(".button:visible:enabled:first").focus();
		$(".textinput:visible:enabled:first").focus();
		
		$(".page_edit .textinput").bind("change keyup", function (e) {
			key = e.which+" ";
			badkeys = "224 16 17 18 37 38 39 40 ";
			if ((badkeys.indexOf(key) == "-1") && ($save_file.val() !== "Save!")) {
				$save_file.val("Save!");
				document.title = document.title + " *";
				$(".page_edit h2").append(" *");
			}
		});
		
		$(".page_edit form").submit(function() { $save_file.val("Save"); });
		window.onbeforeunload = function () {
			if ($save_file.val() == "Save!") {
				return "Any changes you've made will be lost!";
			}
		};
	});
</script>

</body>
</html>
