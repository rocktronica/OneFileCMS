# OneFileCMS Change Log

### (January 19, 2013)

- Just some minor updates/wording changes to the readme & plugin/*.init files.

### v3.4.20 (December 19, 2012)

- The $ACCESS_ROOT option has been reimplemented and is now fully functional\*.  This option limits access to a specified folder (and it's sub-folders).  To use, just specify a valid path relative to the root of the website (no leading slash).  
(*Well, as best as I can tell...)

- All OneFileCMS configuration variables that reference external files ($CONFIG\_file, $LANGUAGE\_FILE, $WYSIWYG\_PLUGIN) must be specified in one of two ways:  
	1. Relative to the root of the website - with NO leading slash:  "some/path/from/webroot/somefile.php"  
	2. Absolute to the file system - WITH a leading slash:  "/some/path/from/system/root/somefile.php"  
	(On Windows, the drive letter may also be used, but it is not required if all is on same drive.)

### v3.4.19 (2012-12-12)

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

### v3.4.18 (2012-12-03)

Of course, everything comes with a price (exacerbated by my apparent lack of testing...)

- Anyway, the current release partly fixes an issue when trying to use a wysiwyg editor with onefilecms.php installed in a sub-folder of a site.  The issue is - it didn't work.  Now it does - mostly. However, there is still an issue using wysiwyg editors if the $ACCESS_ROOT variable is set to anything but blank (root).

### 2012-12-03

-  Just a note: there is an issue using a wysiwyg editor when onefilecm.php is in a sub-folder, or related to using the $ACCESS_ROOT option (restricting onefilecms access to a folder).  WYSIWYG seems to otherwise work fine when onefilecms.php is in the root folder of a site.

### v3.4.17 (2012-11-29)

- WYSIWYG is here!  
Due to popular demand (ie: it has been requested more than once), WYSYWIG editors can now be "plugged in" and used with OneFileCMS.  Currently, only [TinyMCE](http://tinymce.moxiecode.com/) and [CKEditor](http://ckeditor.com/) have been tested (and on a very limited scale). Others may work - but I don't know yet.  And, naturally, the use or inclusion of such editors is completely optional, of course.

	**No actual WYSIWYG editors are included with OneFileCMS** - any desired editor must be obtained seperately.

	A brief how-to on using either editor can be found in their respective sample "init" files included in the plugins folder of the OneFileCMS repo. Any suitable init file for a given editor may be used, as long as the correct path to the editor's javascript source file is specified, and - for CKEditor - the id of the OneFileCMS textarea, "file_editor", is also be specified. 

	Now, while everything seems to work, I have little to no experience using TinyMCE, CKEditor, or any other such application. So, if there is something missing or not working as expected, please let me know (open an "issue" on the Issues page).

	Notes:  

	- These editors have their own, extensive, event controls (responses to keyboard & mouse input), so the OneFileCMS edit page event scripts are not loaded when an editor is in use.  The primary effect is the loss of incidental file status indicators - [Save] will not change to [SAVE CHANGES!], background color will not change, etc., and any "unsaved changes" alerts should be handled by the active editor.  Also, the [Wide View] button will be unavailable.  
  
	- The TinyMCE "init" file included in the OneFileCMS repo specifies the use of the TinyMCE "fullpage" plugin, which produces an "unsaved changes" alert every time you exit the Edit page - even if no changes have been made to the file in the editor.  

	- The CKEditor, on the other hand, does not seem to present an alert at all when you leave the editor page - even with unsaved changes.  

### v3.4.16 (2012-11-23)

- Added icons to lower buttons on edit page.
- And a few code tweaks & improvements.

### v3.4.15 (2012-11-18)

- Added client-side hashing of passwords. 
  This is primarily a benefit for the user, as it does not really add any security to the server side application that uses it (such as OneFileCMS).  The reason is that this "pre-hash" simply becomes the actual password as far as the server is concerned, and is just as vulnerable to exposure while in transit. However, it does help to protect the user's plain-text password, which may be used elsewhere.  

- Also added a "please wait..." message while computing the client-side hashes - primarily for IE versions < 9, which are MUCH slower than FF or Chrome (by a factor of 37 or more).  Subsequently, the number of iterations for the client-side hashing is quite low (compared to the server side), but still causes a 1 - 2 second delay on the login screen, and a 3 - 6 second delay on the Change Password screen.  On FF and Chrome, however, the delay is much shorter, almost unnoticable.

- I want to thank [fermuch](http://github.com/fermuch) for the client-side hashing suggestion.  While a somewhat different approach was ultlimately employed, his original solution provided the insight needed to approach the idea in general.

### 3.4.14 (2012-11-12)

- Courtesy of [Fuchur777](github.com/Fuchur777), added option to restrict OneFileCMS to a specified folder (and it's sub-folders).
- Fixed issue on Upload page if using PHP v3.2.12 or earlier.
- A few miscellaneous code improvements.

### (2012-11-11)

- Thanks to [zaykin](https://github.com/zaykin) for the Russion language file!

### 3.4.13 (2012-11-05)

- Thanks to [symsec](http://github.com/symsec) for the Dutch (Nederlands) language file!
- Otherwise, mostly some incidental code improvements and cleanup.

### 3.4.12 (2012-10-21)

- On the Upload Page, added an option to select either automatic rename or overwrite of pre-existing files.

### 3.4.11 (2012-10-16)

- Just a few code tweaks and improvements.

### 3.4.10 (2012-10-08)

- Folders are now listed ahead of files in main file list.
- Quite of bit of code consolidation and improvement.
- Converted svg icons from functions into an array of $ICONS[]

### 3.4.09

- Can now recursively copy folders.
- Consolidated some functions.
- Removed some svg icons no longer used.
- The usual "code cleanup" and "tweaked some css"...

### 3.4.07

- Can now recursively delete non-empty folders (just be careful!)
- Consolidated some functions.
- Minor bug fix & a few misc code improvements.
- Darkened folder icons.
- Removed & changed a few $_[] language strings. 

### 3.4.06

- Minor bug fix: Index page would not display folders that started with a period ("hidden" folders on *nix)

### 3.4.05

- Consolidated index page radio & submit buttons (for Move, Copy, Delete) into just three standard buttons.
- Added multi-file upload ability.
- Index page: removed extra Upload/New/Rename/Delete buttons from  bottom of page.
- Subsequent to the above, a bit of code cleanup & improvement.

### 3.4.04

- Minor bug fix.

### 3.4.02-3.4.03

- Primary user noticable change: on rename/move/copy pages, split "New Name" from "New Location".
- A couple minor bug fixes.
- Consolidated four functions into two.
- Other general code cleanup & improvements.
- Numerous new, changed, and removed langauge settings.

### 3.4.01

- A couple of minor bug fixes.
- Some code cleanup & improvements.

### 3.3.17 - 3.4.0 (2012-08-29)

- Added option to select and move, copy, or delete multiple files.
- And other general code tweaks and improvements.

### 3.3.11 - 3.3.16

- Added screens for changing username and password.
- Plaintext $PASSWORD option is no longer available.
- Added options to Rename, Copy, or Delete files from Index screen.
- Improved validation of $_GET parameters & other general code improvements.

### 3.3.10

- Created an actual "Admin" page that has links to admin functions: Hash Page, Edit OneFileCMS, and (soon) Change Password.

### 3.3.09 

- Minor code improvements & cleanup.

### 3.3.08

- Added some basic error handling and now using buffering to capture errant early output.
- Seperate function to handle dynamic css values.

### 3.3.07

- Language file formats are now php instead of ini.
- Minor improvement to version checking.

### 3.3.06

- Increased hash iterations from 1000 to 10000.  (I've read that lots of iterations help slow down brute force p/w recovery)
- Format for external config files is now just php (instead of ini).
- Some miscellaneous code & css improvements.

### 3.3.05a

- Just removed some trouble-shooting code that was left in unintentionally.

### 3.3.05

- Added a few settings to the language files to adjust certain css values if needed.  In some instances, some langauges may use significantly longer words or phrases than others.  So, a smaller font or less spacing may be desirable in those places to preserve page layout.   
- And, of course, some minor code improvements hear and there.

### 3.3.04

- Added Spanish language file courtesy of [fermuch](https//github.com/fermuch).
- Some misc code improvements.
- Added notes regarding using .ini file for password storage.

### 3.3.03

- "Wide View" option on Edit page now persists across saves.
- Improved handling of language files.  However, kinda' like "online security", "multi-language support" is nebulous and a bit finicky.

### 3.3.02

- Added German language file courtesy of [codeless](http://github.com/codeless).

### 3.3.01

- Fixed a "minor" issue after adding multi-language support- OneFileCMS stopped working altogether on versions of PHP &lt; 5.3.

### 3.3.0

- Added support for optional external language files.   Now to get some translations...  
- The default, English, is included directly in OneFileCMS, of course.
- A sample language file (English) is included in the repo for reference for anyone that may be interested.


### 3.2.3

- Thanks to github.com/codeless: added the ability to process a seperate config file.  
  (This is just an option for flexibility, and is not required)
- Added a [Wide View] button to Edit page.
- Some minor code improvement & css tweaking.

### 3.2.2

- Thanks to github.com/codeless: added a configurable whitelist of files to show.
- Fixed minor issue on hash page (needed htmlspecialchars)
- And, of course, various style & code tweaks.


### 3.2.1

- Added timer to "Please wait..." message after too many invalid login attempts.
- Mostly some misc code cleanup & improvement.
	
### 3.2.0

- Added a few security improvements.
- Added "timeout" timer as a warning to save edits before they're lost.


### 3.1.9

- Password may now be stored as an encrypted hash, instead of in plain text.
- Added an "Admin" page to generate password hashes.
- A bunch of other code tweakin' & improvements.

### 3.1.6 thru 3.1.8

- Converted bulk of rest of code into functions (easier to work with).
- Resolved issue (I hope) with differing versions of PHP and how magic_quotes & stripslashes are handled.

### 3.1.2 thru 3.1.5

- Added file size limits to the Edit/View page. (Some browsers don't like large files in an HTML textarea.)
- Added some data validation to $_GET parameters
- Some misc code cleanup & organization etc.
- And other misc stuff...

### 3.1.1

- Fixed minor issue with data encoding of file for editting in a &lt;textarea>

### 3.1

- (Very) moderate data validation improvements.
- Reorganized & funcionalized() most of the code.

### 3.0

- Implemented svg icons

### 2.0

- OneFileCMS is now actually ONE FILE! No external style sheets or icons.  
  (Of course, external style sheets & icons can be added back in, if you like.)

- This is OneFileCMS "Lite", and will be maintained along with v3.0

### 1.5 

- Style sheet is now part of onfilecms.php file, but still uses external icons.
- Some minor logic improvements on Edit & Index pages.

### 1.4.0

- Substantial code reorganization & updates.


### 1.2.4 - 1.3.0

- DO NOT USE THESE VERSIONS!
- Mostly just a bunch of code modifications.
- These versions have issues, primarily when on the home/root page your site. 

### 1.2.3

- Fixed check for local css. If not found, loads hosted copy. 
  (This will soon be a moot point...)

### 1.2.2

- On "Edit" page, images are now displayed directly, instead of a disabled textarea.
- Logout page replaced with standard "alert" message on login screen.

### 1.2.1

- Fixed security hole that affected versions 1.1.7 - 1.2.0.

### 1.2.0

- List of files now sorted alphabetically, without regard to case.
- Further improved Edit page & screen feedback of file state (changed/unchanged).
- Added [X] dismiss button on message box
- File dates shown on Index & Edit pages are now in user's local time.
- Moved from xhtml to html syntax & doctype.

### 1.1.9

- Improved Edit page & screen feedback of file state (changed/unchanged).
- Removed use of jquery in move towards a true "OneFileCMS".

### 1.1.8  

- Added a table list view option (default).  Either List or original "Block" view selectable with $VIEW_MODE variable. (On screen selection in the works)
- (And, of course, numerous other code tweaks/improvements.

### 1.1.7

- Added [Cancel] button to most screens. Numerous minor UI & code tweaks/improvements.  Changed where .css is hosted (may change back later).  Removed "Rendered in (microseconds)...".  Added license info & copyright notice.

### 1.1.6

- Breadcrumb navigation (courtesy of [Self-Evident](https://github.com/Self-Evident/)), CSS file and some minor changes to it
- Installation is still as usual, but now, if you have _onefilecms.css_ in the same folder as _onefilecms.php_, it'll be linked instead of the normal [http://onefilecms.com/style.css](http://onefilecms.com/style.css).

### 1.1.5

- Fixed a disallowed redirect vulnerability  
Many thanks to Abhi M Balakrishnan from [OWASP Mantra Team](http://www.getmantra.com/) for his help

### 1.1.4

- JavaScript cleanup and jQuery upgrade
- Visit Site = /
- Now on GitHub!

### 1.1.3 (1/10/2012)

- Fixed a upload bug leftover from 1.1.2's CSRF protection

### 1.1.2 (9/21/11)

- More CSRF protection for logged-in users

### 1.1.1 (1/9/10)

- CSRF protection (thanks Steve and Rene)
- Support for storing password as an MD5 hash (thanks, durilka!)

### 1.1.0 (10/18/09)

- config_footer variable for branding or analytics code
- config_disabled variable to disallow editing of files like images, zips, icons, etc
- config_excluded variable to exclude specific files (or filetypes) from being shown in the index
- Shows hidden files (files that start with a "." like ".htaccess") on index listing
- "noindex" meta tag so Google doesn't crawl your backend
- Fixed a couple minor CSS and link bugs in the example site.
- Updated license page to clarify commercial license usage per domain and upgrade.

### 1.0.1 (9/24/09)

- Relative CSS links and navigation in example site to work better with the demo (No change to OneFileCMS itself)

### 1.0 (9/5/09)

- Launch!
