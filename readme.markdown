# OneFileCMS

## Yes, that's *exactly* what it is!

OneFileCMS is a simple CMS (Content Management System) contained entirely in a single, database-less, PHP/Javascript.

With basic editing, upload, and file managing functions, OneFileCMS can maintain an entire website completely in-browser without any external programs.

### Main screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot.png)

###Edit screen:
![OneFileCMS](http://self-evident.github.com/OneFileCMS/images/OneFileCMS_screenshot_edit.png)

--------------------------------------------------------------------------------
## Contents:
- [Demo](#demo)
- [Features](#features)
- [Installation](#installation)
- [Requirements](#requirements)
- [FAQ](#faq)
- [Limitations and Considerations](#limitations)
- [Needed/potential improvements](#potential)
- [License, Credit, Et Cetera](#license)
- [General layout/structure of OneFileCMS.php](#layout)
- [Logs](#logs)

--------------------------------------------------------------------------------
## <a name=demo></a>Demo

- Just download & try the [current version](https://raw.github.com/Self-Evident/OneFileCMS/master/onefilecms.php) - it's one file!  
  
--------------------------------------------------------------------------------
## <a name=features></a>Features
 
- All the basic file management features like renaming, moving, copying, deleting, and uploading.
- A basic text editor.
- Sort directory listings by file name, extension, size, or date.
- Keyboard navigation of directory list. (Arrows, Page Up/Down, Home, End)
- A WYSIWYG editor may be added as a plugin.
- A login delay after too many invalid login attempts.
- Adjustable idle time before auto-logout.
- Easily modifiable & re-brandable.
- Multi-language support.
- Lots more...
- <del>Possibly</del> The easiest installation process ever!

--------------------------------------------------------------------------------
## <a name=installation></a>Installation

1) **Download** the [current version](https://raw.github.com/Self-Evident/OneFileCMS/master/onefilecms.php).  

2) **Upload** to anywhere on your site.  
  
3) **Log in** !

The default login info is "username" and "password".  Of course, you'll want to change those...

As with any CMS, you may also have to modify the file permissions of your site's folders to allow OneFileCMS to modify and create files.  Check with your host if you're not sure, and be aware of any inherent security concerns.  

You can also change the file name from "onefilecms.php" to something else, such as "admin.php". (Be careful about making it a folder's default file: your server may get stuck in redirects.)

--------------------------------------------------------------------------------
## <a name=requirements></a>Requirements

- PHP 5.1+
  (Only tested on versions 5.2.8, 5.2.17, 5.3.3, and 5.4 + )
- A Javascript enabled browser.
- Most modern browsers probably work, but I only test on Firefox, Chrome, and IE 8.
- And if you wish to see the icons- a browser that supports inline SVG.  
  (If your browser doesn't support inline SVG, OneFileCMS will still work, just without any icons.)
- File permission privileges on your host.

--------------------------------------------------------------------------------
## <a name=faq></a>FAQ

- [Multi-Language Support?](#language)
- [I found something that could be better. Can I suggest it to you?](#suggestions)
- [Can I have more than one username/password?](#multiuser)
- [This is basically just a file manager with a text editor- why is it being called a CMS?](#handsaw)
- [Why do I get a "Stop running this script?" alert during login?](#slowlogin)
- [Where's the WYSISWYG?](#WYSIWYG)

### <a name=language></a>Multi-Language Support?

Yes!  While English (EN) is the default, the following laguages are also available:

- Deutsch (DE) courtesy of [codeless](http://github.com/codeless).
- Espanõla (ES) courtesy of [fermuch](http://github.com/fermuch).
- Nederlands (NL) courtesy of [symsec](http://github.com/symsec).  
- Pусский (RU) courtesy of [zaykin](https://github.com/zaykin).  

If you speak another language and would like to contribute, translations are welcomed and appreciated!  Just use the English language file (or any of the others) as a template, and translate each word, phrase, etc., as appropriate.

### <a name=suggestions></a>I found something that could be better. Can I suggest it to you?

Yes, of course!

I may not have the time/bandwidth/inclination to implement every feature, but I 'll do what I can. If you find a bug, please file a report on the issues page.

### <a name=multiuser></a>Can I have more than one username/password?

Yes!  Well, sort of... indirectly.  Upload or create additional copies of OneFileCMS, but give them different file names.(ex: OneFile1.php and OneFile2.php etc...)  Then, in each copy, maintain different usernames, passwords, and $session\_name config values.  
  
Now, since there is no database or other means of granular control or access logging, multiple usernames provides limited utility.  However, having at least one working backup copy of OneFileCMS available is recommended in case the primary copy gets corrupted.

### <a name=handsaw></a>This is basically just a file manager with a text editor- why is it being called a CMS?

Because it is. It may be simple, but it can get the job done.  While you wouldn't want to build a new house from the ground up with just a hammer, saw, and tape measure, you can "manage" quite a bit with just those tools.  

And, because "OneFileCMS" sounds cool.


### <a name=slowlogin></a>Why do I get a "Stop running this script?" alert during login?

OneFile's login functions take condsiderably longer* to run on IE, version 8 at least, than on Chrome or Firefox.  Just click [ No ] on the alert, and the login should finish after a few more seconds.  
(*About 8 seconds -vs- 1/4 second on my test system.)

The delay is the result of the client-side "pre-hash" OneFileCMS performs on your password before submitting the login to OneFileCMS server-side.  Not counting the time the alert is waiting for a response, the 8 seconds previously mentioned is from a 2.5gz single-core XP system.  

See the global variable "$PRE\_ITERATIONS" at the end of System\_Setup().  It can be adjusted, but it's best to do so on a local copy in a development setup, then upload the updated copy.

### <a name=WYSIWYG></a>Where's the WYSISWYG?

OneFileCMS can be easily configured to work with [TinyMCE](http://tinymce.moxiecode.com) or [CKEditor](http://ckeditor.com) (and possibly others), but the editors themselves must be obtained from their respective sites.  For basic setup instructions, read the appropriate "init" file from the extras/ directory in the OneFileCMS repo.  


--------------------------------------------------------------------------------
## <a name=limitations></a>Limitations & Considerations

- If you need to upload a lots of files, an FTP program may be a bit more flexible & practicle.

- Directories with hundreds of files can take several seconds to display.  For instance, on my system- a 2.5gz desktop running XP, it takes 2 to 4 seconds to display a directory with 200 files.

- OneFileCMS would not be the best option for a site that requires different levels of privileges, unless all of the users are trusted to stay within their designated areas of responsibility. Since OneFileCMS allows file uploads and editing files directly on the web server, there is simply no way to secure against any particular action.  

  These issues, of course, are not unique to OneFileCMS - as they will exist in any CMS that permits unrestricted file editing & uploads.

- If your website's connection is not encrypted (doesn't use SSL/TLS), passwords & usernames will be sent in clear text* during login.  However, this is true of any login system that's over an unencrypted connection.  
  *As of version 3.4.15, a client-side hash of the user's "plain-text" password is sent to the server.  So, while this client-side hash is still a "plain-text" password as far as the server is concerned, the user's actual raw password is protected from immediate exposure.

--------------------------------------------------------------------------------
## <a name=license></a>License, Credit, Et Cetera  

- Available under the MIT and BSD licenses.
- Original concept and development by github.com/rocktronica
- Maintained by github/Self-Evident
- Contributors: A. M Balakrishnan, github.com/codeless, github.com/fermuch, github.com/symsec, github.com/zaykin
- Written in PHP, JavaScript, HTML, CSS, and SVG.
- Icons for versions thru 1.1.6 by [famfamfam](http://www.famfamfam.com/).
- To report a bug or request a feature, please file an issue via Github.
- And, of course, please feel free to fork away!

--------------------------------------------------------------------------------
## <a name=potential></a>Needed/potential improvements

- With Chrome, and possibly Safari, issue with Edit page: Clicking browser [back] & then browser [forward],  with file changed and not saved. On return (after [forward] clicked), file still has changes, but indicators are green (saved/unchanged). Does not affect FF 7+ or IE 8+.
- Be aware that only some very basic data & error checking is performed.  (But, it's getting better...)  
- Anything else?

--------------------------------------------------------------------------------
### <a name=layout></a>General layout/structure of OneFileCMS.php
  
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
## <a name=logs></a>[Change Log](http://self-evident.github.com/OneFileCMS/changelog.html)

## [Git Log](https://raw.github.com/Self-Evident/OneFileCMS/gh-pages/master-branch.git.log)


<br><br><br><br>