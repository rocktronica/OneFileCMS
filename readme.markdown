# OneFileCMS

## Current version: 3.4.14

## Recent changes

### November 12, 2012 (v3.4.14)

- Courtesy of [Fuchur777](github.com/Fuchur777), added option to restrict OneFileCMS to a specified folder (and it's sub-folders).
- Fixed issue on Upload page if using PHP v3.2.12 or earlier.
- A few miscellaneous code improvements.

### November 11, 2012

- Thanks to [zaykin](https://github.com/zaykin) for the Russian language file!

### November 5, 2012 (v3.4.13)

- Thanks to [symsec](http://github.com/symsec) for the Dutch (Nederlands) language file!
- Otherwise, mostly some incidental code improvements and cleanup.

### October 21, 2012 (v3.4.12)

- On the Upload Page, added an option to select either automatic rename or overwrite of pre-existing files.

#### Language files

- German (Deutsch) courtesy of [codeless](http://github.com/codeless).
- Spanish (Espanõla) courtesy of [fermuch](http://github.com/fermuch).
- Dutch (Nederlands) courtesy of [symsec](http://github.com/symsec).  
- Russian courtesy of [zaykin](https://github.com/zaykin).  

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
 
- All the basic file management features like renaming, moving, copying, deleting, and uploading.
  (For complex processes, like batch renaming or mass uploads, you're going to want to use an FTP program.)
- A basic text editor.
- Alerts if you try to leave editing with unsaved changes.
- A Login delay after too many invalid login attempts.
- Adjustable idle time before auto-logout.
- Easily modifiable & re-brandable.
- Multi-language support.
- <del>Possibly</del> The easiest installation process ever!

## Installation

1) Download the current version from the Download page.  

2) Upload to anywhere on your site.  
  
3) Log in to OneFileCMS with the default "username" and "password", and set your own username and password!  

As with any CMS, you may also have to modify the file permissions of your site's folders to allow OneFileCMS to modify and create files.  Check with your host if you're not sure, and be aware of any inherent security concerns.  

You can also change the file name from "onefilecms.php" to something else, such as "admin.php". (Be careful about making it a folder's default file: your server may get stuck in redirects.)

--------------------------------------------------------------------------------

## FAQ

### Where's the WYSIWYG? What about syntax highlighting?

WYSWIWYG editors have been requested, but probably won't become standard, as they'd make it more than one file, sort of defeating the whole "OneFile" point. Plus, when working with PHP or non-HTML code, they can be more of a hindrance than an asset.

However, just because I don't want to do it, doesn't mean it's impossible.  Look for the Edit\_Page\_form() function. Its textarea can be modified to work with whatever editor you like. 

### I found something that could be better. Can I suggest it to you?

Yes, of course!

I may not have the time/bandwidth/inclination to implement every feature, but I 'll do what I can. If you find a bug, please file a report on the issues page.

### This is basically just a file manager with a text editor- why is it being called a CMS?

Well, because "OneFileCMS" sounds way cooler (relatively speaking) than "OneFileFileManagerwithTextEditor".

### Multi-Language Support?

Yes!  Currently, English (EN), German (DE), Spanish (ES), Dutch (NL), and Russian (RU) are available.

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
- And- but if you wish to see the icons- a browser that supports inline SVG.  
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
- The connection is not encrypted (doesn't use SSL), so passwords & usernames are sent in clear text during login.  However, this is true of most online login systems, unless SSL or the like is employed.
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
