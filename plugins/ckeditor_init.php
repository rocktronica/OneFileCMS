<?php /*************************************************************************
Sample code to use the CKEditor with OneFileCMS (as of v3.4.17).

For information on CKEditor, visit ckeditor.com.

Here is a brief how-to:
(The "plugin" folder used below is not required, or may be named anything you like.)

 1) Obtain CKEditor.

 2) Install CKEditor into a folder on your web site. For example: "plugins/".

 3) From the github.com/Self-Evident/OneFileCMS repo, copy the file 
    "ckeditor_init.php" into the "plugins/" folder.

 4) In the configuration section of OneFileCMS, add the following two variables:
    $WYSIWYG_PLUGIN = 'plugins/ckeditor_init.php';     //Init settings for CKEditor. (This file)
    $WYSIWYG_SOURCE = 'plugins/ckeditor/ckeditor.js';  //used in $WYSIWYG_PLUGIN

 5) Include the id of the OneFileCMS textarea, "file_editor", in the CKEDITOR.replace() call (see below).

 6) In OneFileCMS- open a file for editing, and click [Edit WYSIWIG].
*****************************************************************************/?>

<script type="text/javascript" src="<?php echo $WYSIWYG_SOURCE ?>"></script>
<script type="text/javascript">
	CKEDITOR.replace( 'file_editor',{  //id of desired <textarea>
		fullPage : true,
		extraPlugins : 'docprops'
	});
</script>

