### May 29, 2012

# Current stable versions: 1.5, 2.0, & 3.1.5

- 3.1.1: "Full" version - uses svg icons
- 2.0  : "Lite" version - uses no icons.
- 1.5  : style sheet is now part of onfilecms.php file, but still uses external icons.

--------------------------------------------------------------------------------

### April 30, 2012

## NOTICE - SECURITY HOLE! (Fixed in version 1.2.1)

## Versions affected

- 1.1.7 thru 1.2.0

## Versions *Un* affected / fixed

- Version 1.1.6
- Versions 1.2.1 and newer

## Brief description:

- No login required if a file and path is known.
  EX:  http:// yourdomain.com/onefilecms.php?f=some/path/to/file.txt

- File edit, rename, move, and copy work in this way, without login.

## Cause

- Me. I just noticed the problem.  Some edit after 1.1.6 introduced the hole.

--------------------------------------------------------------------------------

# OneFileCMS

## Yes, that's exactly what it is!

Main screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot.png)

Edit screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot_edit.png)


OneFileCMS is just that. It's a flat, light, one file CMS (Content Management System) entirely contained in an easy-to-implement, highly customizable, database-less PHP script.

Coupling a utilitarian code editor with all the basic necessities of an FTP application, OneFileCMS can maintain a whole website completely in-browser without any external programs.

## Demo

- Just download & try the current version - it's one file!

## Features
 
- All the basic features of an FTP application like renaming, deleting, copying, and uploading
  _(Of course, for more complex processes like batch renaming or mass uploads/deletions, you're going to want to break out an actual FTP program.)_
- Alert if you try to leave without saving your edits
- Easily modifiable & re-brandable.
- Possibly the easiest installation process ever!

## Installation

1) Download [this file](https://raw.github.com/Self-Evident/OneFileCMS/master/onefilecms.php).

2) Set your username and password - edit them to something less obvious.

    // CONFIGURATION INFO
    $config_username = "username";
    $config_password = "password";

3) Upload!

Depending on how your web stack is set up, you may also have to modify the file permissions of your site's folders to allow OneFileCMS to modify and create files. ([More about that here.](http://catcode.com/teachmod/)) Make sure onefilecms.php and its parent folder are allowed to execute, with CHMOD at 755. Check with your host if you're not sure, and be aware of any inherent security concerns.

You can also change the name of OneFileCMS.php to something else. _(Be careful making it a folder's default file: your server may get stuck in redirects.)_

## FAQ

### Where's the WYSIWYG? What about syntax highlighting?

WYSWIWYG editors have been requested, but probably won’t become standard, as they’d bloat the system out and/or make it more than one file, sort of defeating the point of OneFileCMS. Plus, if you’re working in PHP or non-HTML code, they're generally more of a hindrance than anything else.

Just because I don't want to do it, though, doesn't mean it's impossible.  Look for the Edit_Page() function. Its textarea can be modified to work with whatever editor you like. 

### I found something that could be better. Can I suggest it to you?

Yes, of course, you can!

I may not have the time/bandwidthinclination to implement every feature, but I'll do what I can. If it's urgent, contact me.

Otherwise, try [forking the file and submitting your changes to me](https://github.com/blog/844-forking-with-the-edit-button).

Everything's welcome!

### This is basically just a file manager with a text editor. Why is it being a Content Management System?

Well, because "OneFileFileManagerTextEditor" just doesn't have the same ring to it...

### Multi-Language Support?

Probably not.

### Can I have more than one username/password?

The reason there isn't default support for multiple users is that all of their info will have to be stored together, more or less in plain text, at the top of onefilecms.php. Giving people different usernames and passwords then is sort of futile, since everyone who can log in can view onefilecms's source and config variables. (This answer kind of ignores MD5 hashes but is valid for most considerations.) 

## Change Log




### 3.1.2 thru 3.1.5

- Added file size limits to the Edit/View page. (Some browsers don't like large files in an HTML textarea.
- Added some data validation to _GET parameters
- Some misc code cleanup & organization etc.
- And other misc stuff...

### 3.1.1

- Fixed minor issue with data encoding of file to exit in <textarea>

### 3.1

- (Very) moderate data validation improvements.
- Reorganized & funcionalized() most of the code.

### 3.0

- Implemented svg icons

### 2.0

- OneFileCMS is now actually ONE FILE! No external style sheets or icons.
  __(Of course, external style sheets & icons can be added back in, if you like.)__

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

- Breadcrumb navigation (courtesy of [Self-Evident](https://github.com/Self-Evident/)), CSS file and some minor changes to it<br />
  Installation is still as usual, but, now, if you have _onefilecms.css_ in the same folder as _onefilecms.php_, it'll be linked instead of the normal [http://onefilecms.com/style.css](http://onefilecms.com/style.css).

### 1.1.5

- Fixed a disallowed redirect vulnerability<br />Many thanks to Abhi M Balakrishnan from [OWASP Mantra Team](http://www.getmantra.com/) for his help

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

## Requirements

- PHP 5.4  
  (Older 5.x versions may work, but there will be issues editing files with back slashes, among other things.  See php docs on magic_quotes_gpc & stripslashes().)
- File permission privileges on your host
- Javascript enabled browswer
- And, for OneFileCMS 3+, a browser that supports inline SVG.

## Credit, License, Et Cetera

Original concept and development by github.com/rocktronica

Written in PHP, JavaScript, HTML, CSS, and SVG.

Available under the MIT and BSD licenses.

Icons for versions thru 1.1.6 by [famfamfam](http://www.famfamfam.com/).

To report a bug or request a feature, please file an issue via Github. Forks encouraged!

##Needed/potential/upcoming improvements

- Connection is not encrypted (doesn't use SSL), so passwords & usernames are sent in clear text during login.
- Be aware that only some very basic & rudimentary data & error checking is performed.  
  On Windows, for instance, it's possible to create folders that are subsequently inaccessible and undeletable by Windows.  (Yea, I found out the hard way...)
- With Chrome, and possibly Safari, issue with Edit page: Clicking browser [back] & then browser [forward],  with file changed and not saved. On return (after [forward] clicked), file still has changes, but indicators are green (saved/unchanged). Does not affect FF 7+ or IE 8+.
- Check size of file to upload, verify under max post/upload limits.
- Multiple login names?


--------------------------------------------------------------------------------

### General layout/structure of OneFileCMS.php
  
Configurable Info  
Session start  
A few functions needed early  
A few global values.  
Misc functions  
A few macros (reusable chunks of code)  
svg\_icons\_...() functions  
Login\_Page() function  
list\_files() function  
Index\_Page() function  
&lt;...page&gt;_Page() functions  
&lt;...page&gt;_response() functions  
&nbsp; &nbsp; Edit\_Page()...   
&nbsp; &nbsp; Upload\_  
&nbsp; &nbsp; New\_File\_  
&nbsp; &nbsp; Copy_Ren_Move\_  
&nbsp; &nbsp; Delete\_File\_  
&nbsp; &nbsp; New\_Folder\_   
&nbsp; &nbsp; Delete\_Folder\_  
Invalid Login response  
Logout response  
If ($VALID\_POST), do \_response  
Set page title  
Verify valid $page  
Load\_Selected\_Page() function  
Time\_Stamp\_scripts() function  
Edit\_Page\_script() function  
style\_sheet() function  
&lt;html&gt;  
.  
.. (head, body, etc...)  
...  
Load\_Selected\_Page()  
...  
&lt;/html&gt;  
