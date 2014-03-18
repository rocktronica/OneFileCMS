<?php /*************************************************************************
Sample code to use the CKEditor with OneFileCMS (as of v3.4.19).

For information on CKEditor, visit ckeditor.com.

Here is a brief how-to:
(The "plugins" folder used below is not required, or may be named anything you like.)

 1) Obtain CKEditor.

 2) Install CKEditor into a folder on your web site. For example: "plugins/".

 3) From the github.com/Self-Evident/OneFileCMS repo, copy the file 
    "extras/plugin-ckeditor_init.php" into the "plugins/" folder.

 4) In the configuration section of OneFileCMS, uncomment or add the following variable:
    $WYSIWYG_PLUGIN = 'plugins/ckeditor_init.php';  //Init settings for CKEditor (this file).

	Path can be absolute to the filesystem, or relative to root of website.

 5) In the "init" file specified by $WYSIWYG_PLUGIN (ie: this file): 
    1) specify the source file of the actual plugin via a <script src= ...> tag.*
	2) specify the id of the OneFileCMS textarea, "file_editor", in the CKEDITOR.replace() call
	    
	*Note: In the <script> tag, the src path is absolute from the root of the website,
		   and the leading forward slash is generally required. 
	(This is in contrast to configuration values such as $WYSIWYG_PLUGIN.)

 6) Reload OneFileCMS, open a file for editing, and click [Edit WYSIWIG].
*****************************************************************************/?>

<script type="text/javascript" src="/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
	CKEDITOR.replace( 'file_editor',{  //id of desired <textarea>
		fullPage : true,
		extraPlugins : 'docprops'
	});
</script>

