# Current stable version: 3.4.04

### September 14, 2012

- Minor bug fix.

### September 13, 2012

Nothing, it seems, is ever "done".  Shortly after commiting the changes to 3.4, I noticed a couple very minor issues.  Issues that probably would go unnoticed by most.  But, I had to fix them.  Then, I started thinking, "hmmm, this could be little better... maybe that too..."

Anyway, maybe now it's sorta at a resting spot  (hahaha...).  In anycase, here's the recent summary:

- A few minor fixes, and some code cleanup & improvements.

(what'd you expect, a epic treatise?...)

### Auguest 29, 2012

- Added options to select and move, copy, or delete, multiple files from the index page.

### Auguest 14, 2012

- OneFileCMS now can now update the password and username itself, so manual editing of OneFileCMS is not required (but is still possible, of course).
- Removed plain text $PASSWORD option.
- Added options to Rename, Copy, or Delete files from Index screen.


### Auguest 6, 2012

- I just noticed that a function OneFile uses has only been available since PHP 5.1.  So, I guess that's the new minimum required version. (Even though further down this page 5.2 is listed at the minimum version)


### Auguest 3, 2012

- For reasons of required content, consistancy, & code simplicity, the format for language files is now php, instead of ini. While the ini format is cleaner looking and a bit easier to read, there are a few deal-breakers as far as using it to contain values for language strings (as used in OFCMS). Those issues, along with some general considerations of various pros & cons, are detailed on the wiki page.

### July 31, 2012

- For reasons of security, consistancy, & code simplicity, the format for external config files (if used) is now php, instead of ini. This permits a simple copy & paste between an external config file & onefilecms.php.  
  A config file must begin with "<?php".  And, for security reasons, external config file names should end in ".php".  Otherwise, your webserver may serve up the file as plain text, exposing the contents, such as username and password.


### July 25, 2012

#### Security issue if using external .ini config file for password storage  
If an external config file is used to store your password and/or hash, make sure to save the file with php as the extension, and begin the file as follows:  
  
;<?php die();  
  
Otherwise, the file - along with your password, is world readable. For details, see the php documentation and comments on parse\_ini\_file().


#### Language files

- Thanks to [fermuch](http://github.com/fermuch) for the Spanish language file!  
- Thanks to [codeless](http://github.com/codeless) for the German language file!


--------------------------------------------------------------------------------

# OneFileCMS

## Yes, that's exactly what it is!

Main screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot.png)

Edit screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot_edit.png)


OneFileCMS is just that: It's a flat, light, one file CMS (Content Management System) contained entirely in an easy-to-implement database-less PHP script.

Coupling a utilitarian code editor with basic file managing functions, OneFileCMS can maintain an entire website completely in-browser without any external programs.

## Demo

- Just download & try the current stable version - it's one file!

## Features
 
- All the basic features of an FTP application like renaming, deleting, copying, and uploading
  _(For complex processes like batch renaming or mass uploads, you're going to want to use an actual FTP program.)_
- A basic text editor.
- Warns if you try to leave editing with unsaved changes.
- A Login delay after too many invalid attempts.
- Adjustable idle time before auto-logout.
- Easily modifiable & re-brandable.
- <del>Possibly</del> The easiest installation process ever!

## Installation

1) Download [this file](https://raw.github.com/Self-Evident/OneFileCMS/master/onefilecms.php).  

2) Upload to anywhere on your site.  
  
3) Log in to OneFileCMS with the default "username" and "password", and set your own username and password!  

Depending on how your web stack is set up, you may also have to modify the file permissions of your site's folders to allow OneFileCMS to modify and create files. ([More about that here.](http://catcode.com/teachmod/)) Make sure onefilecms.php and its parent folder are allowed to execute, with CHMOD at 755. Check with your host if you're not sure, and be aware of any inherent security concerns.  

You can also change the file name of OneFileCMS.php to something else, such as "Admin.php" . (Be careful about making it a folder's default file: your server may get stuck in redirects.)

## FAQ

### Where's the WYSIWYG? What about syntax highlighting?

WYSWIWYG editors have been requested, but probably won't become standard, as they'd make it more than one file, sort of defeating the "OneFile" point. Plus, if you're working in PHP or non-HTML code, they can be more of a hindrance than an asset.

However, just because I don't want to do it, doesn't mean it's impossible.  Look for the Edit_Page_form() function. Its textarea can be modified to work with whatever editor you like. 

### I found something that could be better. Can I suggest it to you?

Yes, of course!

I may not have the time/bandwidth/inclination to implement every feature, but I 'll do what I can. If it's urgent, contact me.  

### This is basically just a file manager with a text editor- why is it being called a CMS?

Well, because "OneFileCMS" sounds way cooler than "OneFileFileManagerwithTextEditor".

### Multi-Language Support?

Yes!  Currently, English, German, and Spanish are available.

If you speak another language and would like to contribute, translations into other languages are welcomed and appreciated!  Just use the English language file as a template, and translate each word, phrase, etc., as appropriate.  (Someone told me he was working on an Esparento translation, but that might have been a joke...)

### Can I have more than one username/password?

Yes!  Well, sort of - indirectly.  Upload or create addional copies of OneFileCMS, but give them different file names.(ie: OneFile1.php and OneFile2.php etc...)  Then, in each copy, maintain different user names and passwords.  Also, so that one user does not log out the other, change the value of the $session_name config variables.  
  
Now, since there is no database or other means of granular control and access logging, multiple usernames may be kind of pointless.  On the other hand, having at least one working backup copy of OneFileCMS available is recommended in case the primary copy gets corrupted.

## Requirements

- PHP 5.1+
  (Only tested on versions 5.2.8, 5.2.17, 5.3.3, and 5.4 + )
- File permission privileges on your host
- Javascript enabled browswer
- And a browser that supports inline SVG, but only if you wish to see the icons
  (If your browser doesn't support inline SVG, OneFileCMS will still work, just without any icons.)

## Credit, License, Et Cetera  

- Maintained by github/Self-Evident
- Original concept and development by github.com/rocktronica
- Contributors: A. M Balakrishnan, github.com/codeless, github.com/fermuch
- Written in PHP, JavaScript, HTML, CSS, and SVG.
- Available under the MIT and BSD licenses.
- Icons for versions thru 1.1.6 by [famfamfam](http://www.famfamfam.com/).
- To report a bug or request a feature, please file an issue via Github.
- And, of course, please feel free to fork away!

##Needed/potential/upcoming improvements

- With Chrome, and possibly Safari, issue with Edit page: Clicking browser [back] & then browser [forward],  with file changed and not saved. On return (after [forward] clicked), file still has changes, but indicators are green (saved/unchanged). Does not affect FF 7+ or IE 8+.
- Issue with Chrome's XSS filter: Editing some legitimate files with OneFileCMS will trigger the filter and disable much of the javascript provided functionallity, but only while on the edit page with such a file, and only after a [Save].
- The connection is not encrypted (doesn't use SSL), so passwords & usernames are sent in clear text during login.  
  However, this is true of most online login systems, unless SSL or the like is employed.
- Be aware that only some very basic data & error checking is performed.  (But, it's getting better...)  
  On Windows, for instance, it was possible to create folders that were subsequently inaccessible and undeletable by Windows.  (Yea, I found out the hard way...)  (However, I *think* that issue is fixed.)
- Anything else?

--------------------------------------------------------------------------------

### General layout/structure of OneFileCMS.php
  
CONFIGURATION SECTION  
  
SYSTEM SETUP/VARIABLES  
  
DEFAULT LANGUAGE  
  
SESSION & MISC FUNCTIONS  
  
SVG ICON FUNCTIONS  
  
PAGE & RESPONSE FUNCTIONS  
  
JAVASCRIPT FUNCTIONS  
  
STYLESHEET  
  
LOGIC TO DETERMINE PAGE ACTION  
  
GENERATE/OUTPUT THE PAGE  

--------------------------------------------------------------------------------

## Change Log

### 3.4.04

- Minor bug fix.

### 3.4.02-3.4.03

- Primary user noticable change: on rename/move/copy pages, split "New Name" from "New Location".
- A couple minor bug fixes.
- Consolidated a four functions into two.
- Other general code cleanup & improvements.
- Numerous changed, new, and removed langauge settings.

### 3.4.01

- A couple of minor bug fixes.
- Some code cleanup & improvements.

### 3.3.17 - 3.4.0

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

- Fixed a "minor" issue after adding multi-language support- OneFileCMS stopped working altogether on versions of PHP < 5.3.

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
- Resolved issue (I hope) with differing versions of PHP and how magic_quotes & stripslashes are handeled.

### 3.1.2 thru 3.1.5

- Added file size limits to the Edit/View page. (Some browsers don't like large files in an HTML textarea.)
- Added some data validation to _GET parameters
- Some misc code cleanup & organization etc.
- And other misc stuff...

### 3.1.1

- Fixed minor issue with data encoding of file to exit in &lt;textarea>

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
- File date shown on Index & Edit pages is now in user's local time.
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
