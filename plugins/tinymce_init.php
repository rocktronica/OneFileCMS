<?php /*************************************************************************
Sample code to use the TinyMCE editor with OneFileCMS (as of v3.4.19).

For information on TinyMCE, visit tinymce.moxiecode.com.

Here is a brief how-to:
(The "plugin" folder used below is not required, or may be named anything you like.)

 1) Obtain TinyMCE.

 2) Install TinyMCE into a folder on your web site. For example: "plugins/".

 3) From the github.com/Self-Evident/OneFileCMS repo, copy the file 
    "tinymce_init.php" into the "plugins/" folder.

 4) In the configuration section of OneFileCMS, add the following variable:
    $WYSIWYG_PLUGIN = 'plugins/tinymce_init.php'; // Init settings for TinyMCE (this file).

	Path can be absolute to the filesystem, or relative to root of website.

 5) In the "init" file specified by $WYSIWYG_PLUGIN (this file): 
    - specify the source file of the actual plugin via a <script src= ...> tag.*


	*Note: In this case, the plugin path is absolute, but still relative to the root of the website, 
	and the leading forward slash is generally required. 
	(This is in contrast to configuration values such as $WYSIWYG_PLUGIN.)

 6) In OneFileCMS- open a file for editing, and click [Edit WYSIWIG].
*****************************************************************************/?>

<script type="text/javascript" src="/plugins/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript"> 
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		
		plugins : "fullpage,autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",
		
		// Theme options
		theme_advanced_buttons1 : "save,newdocument,preview,print,|,restoredraft,|,removeformat,undo,redo,cut,copy,paste,pastetext,pasteword,|,search,replace,|,visualblocks,visualchars,visualaid,fullscreen,|,styleprops,|,code,|,help,|",
		theme_advanced_buttons2 : "bold,italic,underline,strikethrough,|,sub,sup,forecolor,backcolor,|,fontselect,fontsizeselect,nonbreaking,charmap,|,insertdate,inserttime,|,emotions,image,|,attribs,fullpage",
		theme_advanced_buttons3 : "justifyleft,justifycenter,justifyright,justifyfull,|,outdent,indent,bullist,numlist,|,styleselect,formatselect,blockquote,ltr,rtl,|,hr,advhr,|,link,unlink,anchor,|",
		theme_advanced_buttons4 : "tablecontrols,|,insertlayer,moveforward,movebackward,absolute,|,cite,abbr,acronym,del,ins,|,pagebreak,template,|,cleanup,|",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
		// Example content CSS (should be your site CSS)  //####################
		//content_css : "css/content.css",
		
		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		
		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],
		
		//========================
		//doctype : '<!DOCTYPE html>',
        //verify_html : false,
        //verify_css_classes : true,
        //cleanup : false,
        //cleanup_on_startup : false,
		remove_linebreaks : false,
		//fullpage_default_xml_pi : false,
		//fullpage_doctypes : 'HTML<!DOCTYPE HTML>',
		//fullpage_default_doctype : '<!DOCTYPE html>',
	}); 
</script>
