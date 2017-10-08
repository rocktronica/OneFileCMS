# OneFileCMS Change Log

### v3.6.12 (2017-10-08)

- Admin page now shows username OneFileCMS is running as.
- Index & Edit pages now indicate files that are not writable (rather than just responding with an error message after trying to edit/delete said files).
- When editing file permissions, message box shows current expanded perms [rwxrwxrwx] owner group :current user:  
    (But, can still only edit the octal form by the file name.)

### v3.6.11 (2017-10-06)

- Switched to php short tags: `<?= ?>`&nbsp; &nbsp; (from `<?php echo ?>`) &nbsp; &nbsp; Because I felt like it.  I wanted to years ago, in my beginning of this project, but my web host was still on some 5.3 version of php, and didn't always have 'em enabled. But now, as php is up to v7.something, and most hosts have, at least, php 5.4, it seems like a safe move at this point.  If not, oh well!

### v3.6.10 (2017-10-06)

- Fixed a minor bug introduced by prior commit's code "improvements".
- Directory list now shows link targets:  some\_symlink -> /target/of/symlink
- Reworked keyboard nav a bit.
- Some misc code improvements.

### v3.6.09 (2017-10-04)

- Some minor keyboard nav improvements on index page.
- Some misc code improvements.

### v3.6.08 (2017-09-30)

- [Mov], [Del], & [X] are unavailable if file is readonly.
- Fixed minor issue where if perms changed, new value not always displayed.
- A bit of restructure/refactor of perm & Assemble\_Insert\_Row() related functions.
- "(on php 5.x.x)" version, and link to phpinfo, now only shows on Admin page.
- Andd some css...

### v3.6.07 (2017-09-29)

- Mostly some code improvements.
- And some css...

### v3.6.06 (2017-09-27)

- Added ability to edit file permissions.

### v3.6.05 (2017-09-24)

- Fixed a couple bugs in keyboard navigation when there's only one item in current diretory.
 (Couldn't "arrow up" when in the file row [M][C][D][x][perms] [Filename])
 (It was submitting on enter when on checkboxes.)

### v3.6.04 (2017-09-20)

- A _little_ bit of code improvement/cleanup - using onfocus/blur in lieu of the prior scatter gun approach.


### v3.6.03 (2017-09-20)

- Removed Rename/Delete/Edit options for readonly files.
  (previously would simple have generated an error.)
- Some more prep work for eventual option to edit file perms.

### v3.6.02 (2017-09-18)

- Fixed a minor bug with tabindex on directory listing page.
- Increased default $PRE\_ITERATIONS from 1000 to 10000. Had kept low as IE8 was slow.
- Now attempts to set a session\_save\_path() based on username. (default is /tmp, or /var/lib/php5/, etc)

### v3.6.01 (2017-09-18)

- Fixed a couple of minor display bugs.

### v3.6 (2017-09-17)

- Fixed a minor bug in $ACCESS\_ROOT.
- Did some prep work for editing of file permissions. Not yet editable.


### v3.5.23 (2017-09-08)

- OneFileCMS is no longer restricted to just public_html.
- Increased $MAX\_EDIT\_SIZE to 250000. (It could probably go higher.)

### v3.5.22 (2017-09-05)

- Added file permissions to directory list.
- A couple of minor bug-fixes.
- Some minor code improvements.

### v3.5.21 (2016-06-26)

- Some code cleanup & a little local js re-org.
- Some minor static & active css improvements.
- Added some basic validation to a config value.

### v3.5.20 (2016-06-21)

- Fixed sporadic directory-won't-display issue.
- Fixed wrapping & line-numbering issue when toggling between wrap on & wrap off.
- Added line-numbers to read-only files also.

### v3.5.19 (2016-06-16)

- Added line numbers to left of edit window.  A current side effect is wrapping is now break-word, instead of word-break.  That is, lines may wrap in the midddle of words, not just on white-space. 
- Added a word-wrap toggle option on the edit page.  Only works on editable files. Files with edit disabled still just word-wrap normally as appropriate.
- And some code cleanup etc.

### v3.5.18 (2016-06-09)

- And a few more improvements to arrow key handling.
- A couple minor bug fixes
- Some code cleanup etc.

### v3.5.17 (2014-04-20)

- Additional improvments to arrow key handling, particularly in regards to $message box.

### v3.5.16 (2014-04-04)

- Improved logic for handling Left & Rigth arrow keys in Index\_Page\_events()
- Left some //##### comments in as reminders for potential improvements.

### v3.5.15 (2014-04-03)

- Fixed a minor keyboard navigation bug on Index page if active copy of OnefileCMS is listed.
- Fixed css "glitch" that ony affected IE - removed borders on checkboxes.

### v3.5.14 (2014-04-02)

- Improved keyboard navigation of directory listings (Arrows, Page Up/Down, etc...)
- Asked "how hard can it be?" - and found out...
- Fixed a minor bug on the Edit page (affected IE only).
- Some css adjustments/cleanup (needs lots more).

### v3.5.13 (2014-03-30)

- Added basic keyboard navigation on directory listings.
- Removed [View Raw] button when viewing images.
- And tweaked some css...

### v3.5.12 (2014-03-25)

- Fixed a minor glitch in the countdown used in login delays.
- Associated/misc code tweaks & imrovements.
- Added the countdown timer to the two-minute time-out "Warning..." message.

### v3.5.11 (2014-03-24)

- Improved some $message handling & focus() responses.
- Some minor readme updates.
- some css...

### v3.5.10 (2014-03-23)

- Just a quick fix to a minor issue: needed to urlencode an onclick parameter.
- Also a few minor updates to the readme.

### v3.5.09 (2014-03-22)

- Restored IE 8+ support.
- And, you know, tweaked some css...

### v3.5.08 (2014-03-21)

- Mostly just some code improvements/cleanup.
- ...and css...


### v3.5.07 (2014-03-15)

- Removed ability for OneFileCMS to edit itself - it is too risky an option.  If needed, make a copy & edit it.
- Added a [View Raw] button on the Edit/View page.  It displays the raw/plain text of the current file.
- Fixed issue using Chrome & editing some files containing javascript.
- Some changes to "file changed" visual feedback (textarea & [Save] button styles).
- Some general code improvements to Edit\_Page\_...  functions.
- Some other general code improvements.
- And, a bit of css tweakin...

### v3.5.06 (2014-03-11)

- Added optional logging of login attempts, both successful & failed.

### v3.5.05 (2014-03-09)

- Copy & Rename pages ignore blank "New Name" fields.
- Some minor improvemnts & css tweaks.

### v3.5.04 (2014-03-08)

- Fixed "minor" bug - editor not saving changes (introduced in 3.5.02, but just noticed)
- Some general code improvements & shuffling
- Some CSS shuffling & tweaks.

### v3.5.03 (2014-03-06)

- Minor update to Get\_DIRECTORY\_DATA(). Didn't seem to affect all php versions.

### v3.5.02 (2014-03-06)

- OneFileCMS can now work with non-ASCII filenames.
- (But, OneFileCMS itself can not be named with non-ASCII characters. I don't know why.)
- Increased $PRE_ITERATIONS from 200 to 1000.  This will affect, at least, older IE's, and maybe other browsers as well. For instance, it takes IE8 37 times longer to perform the "pre-iterations" than Firefox.  In anycase, it can, of course, be changed back if needed.  
  (However, OneFileCMS does not currenly work in IE, so it's kinda academic for now.)
- Some css tweaks & improvements.

### v3.5.01 (2014-02-22)

- Mostly behind the scenes stuff...
- Replaced use of htmlentities() with htmlspecialchars().  With UTF-8, htmlentites() is superfluous.
- Added hsc() to a number of strings where should have already been.
- Changed directory sort function a bit. Note: when selecting/deselecting the 'folders first' option, the primary sort will be the last sorted column.
- Split out a new function, Send\_data\_to\_js(), from Index\_Page().
- Also, in prep for an upcoming update, tagged several places (with //##### ) where file system calls are made. The $filename strings used in the calls may need to be encoded with something other than UTF-8, depending on the underlying OS's filesystem. (such as NTFS, which uses UTF-16)

### v3.5 (2014-02-19)

- The directory list can now be sorted by column: name, .ext, size, date.
- Also has an option to list folders first, or to sort without regard to file or folder.
- In accomplishing the above, most sorting moved client side.  This permits resorts without another server hit.
- Added & tweaked some css...
- Slight restructure of the repo (ie: move a few "extras" files around).
- NOTE:  versions 3.4.23 and later DO NOT WORK IN IE!  I don't know why yet, mostly likely js related.

### v3.4.23 (2014-02-12)

- More changes in prep for sort by column
- Directory list is now built & displayed client side via javascript.

### v3.4.22 (2014-02-10)

- Mostly some changes to prep for sort by column (name, size, or date) feature.

### v3.4.21 (2014-02-08)

- Added back the option for external style sheets
- Cooresponding updates to sample external config file.
- In addition to specific file names, specific folder names may now be excluded from directory listings.
- Fixed minor missing page title on Copy Folder page
- Tweaked a couple css defaults


### (2013-01-19)

- Just some minor updates/wording changes to the readme & plugin/*.init files.

### v3.4.20 (2012-12-19)

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
