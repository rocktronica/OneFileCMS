# OneFileCMS Readme

## Recent changes

### December 19, 2012 (v3.4.20)

- The $ACCESS_ROOT option has been reimplemented and is now fully functional\*.  This option limits access to a specified folder (and it's sub-folders).  To use, just specify a valid path relative to the root of the website (no leading slash).  
(*Well, as best as I can tell...)

- All OneFileCMS configuration variables that reference external files ($CONFIG\_file, $LANGUAGE\_FILE, $WYSIWYG\_PLUGIN) must be specified in one of two ways:  
	1. Relative to the root of the website - with NO leading slash:  "some/path/from/webroot/somefile.php"  
	2. Absolute to the file system - WITH a leading slash:  "/some/path/from/system/root/somefile.php"  
	(On Windows, the drive letter may also be used, but it is not required if all is on same drive.)

### December 12, 2012 (v3.4.19)

- Slightly adjusted how wysiwyg plugins are implemented - removed $WYSIWIG\_SOURCE config variable.  
 (It's value is now specified directly in the "init" file specified by $WYSIWYG\_PLUGIN.)

- Two steps forward, one step back...  
	Just for now - removed the $ACCESS_ROOT option.  I was coding in circles and getting no where while trying to reconcile various issues:  

	- With OneFileCMS in any folder other than the web root,
	- With OneFileCMS in a folder other than $ACCESS_ROOT  
	- Depending on the above, can't delete the backup copy of OneFileCMS created by a p/w or u/n change).
	- External file references (config, language, plugins) affected by the above.  
	- Should $ACCESS_ROOT also restrict access to OneFileCMS itself?  That would prevent p/w & u/n changes.
	- Display of the current/path/header/ varies depending on $ACESS_ROOT.
	- Combining the above.
	
	A solution is in the works, but I'm going to take some time to make sure no new problems are introduced by the eventual fix. (hahaha...) It will probably end up being simple, but it's not yet...

- Just a general note on security: due to the fundamental structure of OneFileCMS - primarily that it's one file, and that there is no seperate database for authentication - there are certain inherent security limitations that should be kept in mind:  
	- The first is that all OneFileCMS users are "admins", with the ability to upload and edit files with any type of code.
	- Next, as a direct consequence of the prior point, is that any restriction imposed by some potential feature, such as the $ACCESS_ROOT option that limited access to a specific folder, is only - at most - a guard against accidental access and modification of files outside of the "accessible" folder.   This is not to say that such features are not useful - this is simply meant to provide a realistic expectation of security, and that OneFileCMS should only be used with trusted users.

### December 03, 2012 (v3.4.18)

Of course, everything comes with a price (exacerbated by my apparent lack of testing...)

- Anyway, the current release partly fixes an issue when trying to use a wysiwyg editor with onefilecms.php installed in a sub-folder of a site.  The issue is - it didn't work.  Now it does - mostly. However, there is still an issue using wysiwyg editors if the $ACCESS_ROOT variable is set to anything but blank (root).

### December 02, 2012

-  Just a note: there is an issue using a wysiwyg editor when onefilecm.php is in a sub-folder, or related to using the $ACCESS_ROOT option (restricting onefilecms access to a folder).  WYSIWYG seems to otherwise work fine when onefilecms.php is in the root folder of a site.

### November 29, 2012 (v3.4.17)

- WYSIWYG is here!  
Due to popular demand (ie: it has been requested more than once), WYSYWIG editors can now be "plugged in" and used with OneFileCMS.  Currently, only [TinyMCE](http://tinymce.moxiecode.com/) and [CKEditor](http://ckeditor.com/) have been tested (and on a very limited scale). Others may work - but I don't know yet.  And, naturally, the use or inclusion of such editors is completely optional, of course.

	**No actual WYSIWYG editors are included with OneFileCMS** - any desired editor must be obtained seperately.

	A brief how-to on using either editor can be found in their respective sample "init" files included in the plugins folder of the OneFileCMS repo. Any suitable init file for a given editor may be used, as long as the correct path to the editor's javascript source file is specified, and - for CKEditor - the id of the OneFileCMS textarea, "file_editor", is also be specified. 

	Now, while everything seems to work, I have little to no experience using TinyMCE, CKEditor, or any other such application. So, if there is something missing or not working as expected, please let me know (open an "issue" on the Issues page).

	Notes:  

	- These editors have their own, extensive, event controls (responses to keyboard & mouse input), so the OneFileCMS edit page event scripts are not loaded when an editor is in use.  The primary effect is the loss of incidental file status indicators - [Save] will not change to [SAVE CHANGES!], background color will not change, etc., and any "unsaved changes" alerts should be handled by the active editor.  Also, the [Wide View] button will be unavailable.  
  
	- The TinyMCE "init" file included in the OneFileCMS repo specifies the use of the TinyMCE "fullpage" plugin, which produces an "unsaved changes" alert every time you exit the Edit page - even if no changes have been made to the file in the editor.  

	- The CKEditor, on the other hand, does not seem to present an alert at all when you leave the editor page - even with unsaved changes.  


--------------------------------------------------------------------------------

# OneFileCMS

## Yes, that's exactly what it is!

Main screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot.png)

Edit screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot_edit.png)


OneFileCMS is just that: It's a flat, light, one file CMS (Content Management System) contained entirely in an easy-to-implement database-less PHP script.

Coupling a utilitarian code editor with basic file managing functions, OneFileCMS can maintain an entire website completely in-browser without any external programs.

## What it is not:

- OneFileCMS would not be the best option for a site that requires different levels of privileges, unless all of the users are trusted to stay within their designated areas of responsibility. Since OneFileCMS allows file uploads and editing files directly on the web server, there is simply no way to secure against any particular action.

	These issues are not unique to OneFileCMS - they will exist in any CMS that permits unrestricted file uploads & editing.

## Demo

- Just download & try the current stable version - it's one file!

## Features
 
- All the basic file management features like renaming, moving, copying, deleting, and uploading.
  (For complex processes, like batch renaming or mass uploads, you're going to want to use an FTP program.)
- A basic text editor.
- A WYSIWYG editor may be added as a plugin.
- A Login delay after too many invalid login attempts.
- Adjustable idle time before auto-logout.
- Easily modifiable & re-brandable.
- Multi-language support.
- <del>Possibly</del> The easiest installation process ever!

## Installation

1) **Download** the current version from the Download page.  

2) **Upload** to anywhere on your site.  
  
3) **Log in** to OneFileCMS with the default "username" and "password", and set your own username and password!  

As with any CMS, you may also have to modify the file permissions of your site's folders to allow OneFileCMS to modify and create files.  Check with your host if you're not sure, and be aware of any inherent security concerns.  

You can also change the file name from "onefilecms.php" to something else, such as "admin.php". (Be careful about making it a folder's default file: your server may get stuck in redirects.)

--------------------------------------------------------------------------------

## FAQ

### I found something that could be better. Can I suggest it to you?

Yes, of course!

I may not have the time/bandwidth/inclination to implement every feature, but I 'll do what I can. If you find a bug, please file a report on the issues page.

### This is basically just a file manager with a text editor- why is it being called a CMS?

Well, because "OneFileCMS" sounds way cooler (relatively speaking) than "OneFileFileManagerwithTextEditor".

### Multi-Language Support?

Yes!  Currently, English (EN), German (DE), Spanish (ES), Dutch (NL), and Russian (RU) are available.

- German (Deutsch) courtesy of [codeless](http://github.com/codeless).
- Spanish (Espanõla) courtesy of [fermuch](http://github.com/fermuch).
- Dutch (Nederlands) courtesy of [symsec](http://github.com/symsec).  
- Russian courtesy of [zaykin](https://github.com/zaykin).  

If you speak another language and would like to contribute, translations are welcomed and appreciated!  Just use the English language file (or any of the others) as a template, and translate each word, phrase, etc., as appropriate.

### Can I have more than one username/password?

Yes!  Well, sort of - indirectly.  Upload or create addional copies of OneFileCMS, but give them different file names.(ex: OneFile1.php and OneFile2.php etc...)  Then, in each copy, maintain different usernames, passwords, and $session_name config values.  
  
Now, since there is no database or other means of granular control or access logging, multiple usernames may be kind of pointless.  However, having at least one working backup copy of OneFileCMS available is recommended in case the primary copy gets corrupted.

--------------------------------------------------------------------------------

## Requirements

- PHP 5.1+
  (Only tested on versions 5.2.8, 5.2.17, 5.3.3, and 5.4 + )
- File permission privileges on your host.
- Javascript enabled browswer.
- And- but only if you wish to see the icons- a browser that supports inline SVG.  
  (If your browser doesn't support inline SVG, OneFileCMS will still work, just without any icons.)

## License, Credit, Et Cetera  

- Available under the MIT and BSD licenses.
- Original concept and development by github.com/rocktronica
- Maintained by github/Self-Evident
- Contributors: A. M Balakrishnan, github.com/codeless, github.com/fermuch, github.com/symsec, github.com/zaykin
- Written in PHP, JavaScript, HTML, CSS, and SVG.
- Icons for versions thru 1.1.6 by [famfamfam](http://www.famfamfam.com/).
- To report a bug or request a feature, please file an issue via Github.
- And, of course, please feel free to fork away!

##Needed/potential improvements

- With Chrome, and possibly Safari, issue with Edit page: Clicking browser [back] & then browser [forward],  with file changed and not saved. On return (after [forward] clicked), file still has changes, but indicators are green (saved/unchanged). Does not affect FF 7+ or IE 8+.
- Issue with Chrome's XSS filter: Editing some legitimate files with OneFileCMS will trigger the filter and disable much of the javascript provided functionallity, but only while on the edit page with such a file, and only after a [Save].
- The connection is not encrypted (doesn't use SSL), so passwords & usernames are sent in clear text* during login.  However, this is true of most online login systems, unless SSL or the like is employed.  
  *As of version 3.4.15, a client-side hash of the user's "plain-text" password is sent to the server.  So, while this client-side hash is still a "plain-text" password as far as the server is concerned, the user's raw password is now protected from immediate exposure.
- Be aware that only some very basic data & error checking is performed.  (But, it's getting better...)  
- Anything else?

--------------------------------------------------------------------------------

### General layout/structure of OneFileCMS.php
  
CONFIGURATION SECTION  
  
SYSTEM SETUP/VARIABLES  
  
DEFAULT LANGUAGE  
  
SESSION & MISC FUNCTIONS  
  
SVG $ICONS & FUNCTIONS
  
PAGE & RESPONSE FUNCTIONS  
  
JAVASCRIPT FUNCTIONS  
  
STYLESHEET  
  
LOGIC TO DETERMINE PAGE ACTION  
  
GENERATE/OUTPUT THE PAGE  

--------------------------------------------------------------------------------

## [Change Log](http://self-evident.github.com/OneFileCMS/changelog.html)

## [Git Log](https://raw.github.com/Self-Evident/OneFileCMS/gh-pages/git.log)
