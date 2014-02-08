(Last update: 2014-02-08)
# OneFileCMS

## Yes, that's exactly what it is!

Main screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot.png)

Edit screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot_edit.png)


OneFileCMS is just that: It's a flat, light, one file CMS (Content Management System) contained entirely in an easy-to-implement database-less PHP script.

Coupling a utilitarian code editor with basic upload and file managing functions, OneFileCMS can maintain an entire website completely in-browser without any external programs.

## Demo

- Just download & try the [current version](https://raw.github.com/Self-Evident/OneFileCMS/master/onefilecms.php) - it's one file!  
  

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

1) **Download** the [current version](https://raw.github.com/Self-Evident/OneFileCMS/master/onefilecms.php).  

2) **Upload** to anywhere on your site.  
  
3) **Log in** to OneFileCMS with the default "username" and "password".

4) **Change the password**!

As with any CMS, you may also have to modify the file permissions of your site's folders to allow OneFileCMS to modify and create files.  Check with your host if you're not sure, and be aware of any inherent security concerns.  

You can also change the file name from "onefilecms.php" to something else, such as "admin.php". (Be careful about making it a folder's default file: your server may get stuck in redirects.)

--------------------------------------------------------------------------------

## FAQ

### I found something that could be better. Can I suggest it to you?

Yes, of course!

I may not have the time/bandwidth/inclination to implement every feature, but I 'll do what I can. If you find a bug, please file a report on the issues page.


### Multi-Language Support?

Yes!  Currently, English (EN), German (DE), Spanish (ES), Dutch (NL), and Russian (RU) are available.

- German (Deutsch) courtesy of [codeless](http://github.com/codeless).
- Spanish (Espanõla) courtesy of [fermuch](http://github.com/fermuch).
- Dutch (Nederlands) courtesy of [symsec](http://github.com/symsec).  
- Russian courtesy of [zaykin](https://github.com/zaykin).  

If you speak another language and would like to contribute, translations are welcomed and appreciated!  Just use the English language file (or any of the others) as a template, and translate each word, phrase, etc., as appropriate.

### Can I have more than one username/password?

Yes!  Well, sort of - indirectly.  Upload or create addional copies of OneFileCMS, but give them different file names.(ex: OneFile1.php and OneFile2.php etc...)  Then, in each copy, maintain different usernames, passwords, and $session_name config values.  
  
Now, since there is no database or other means of granular control or access logging, multiple usernames may be kind of superfluous.  However, having at least one working backup copy of OneFileCMS available is recommended in case the primary copy gets corrupted.

### This is basically just a file manager with a text editor- why is it being called a CMS?

Well, because "OneFileCMS" sounds way cooler (relatively speaking) than "OneFileFileManagerwithTextEditor".

### Where's the WYSISWYG?

OneFileCMS can be configured to work with [TinyMCE](http://tinymce.moxiecode.com) or [CKEditor](http://ckeditor.com) (and possibly others), but the editors themselves must be obtained from their respective sites.  For basic setup instructions, read the appropriate "init" file from the plugin/ directory in the OneFileCMS repo.  



### What it is not?

- OneFileCMS would not be the best option for a site that requires different levels of privileges, unless all of the users are trusted to stay within their designated areas of responsibility. Since OneFileCMS allows file uploads and editing files directly on the web server, there is simply no way to secure against any particular action.

	These issues, of course, are not unique to OneFileCMS - as they will exist in any CMS that permits unrestricted file editing & uploads.

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
  *As of version 3.4.15, a client-side hash of the user's "plain-text" password is sent to the server.  So, while this client-side hash is still a "plain-text" password as far as the server is concerned, the user's raw password is protected from immediate exposure.
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
