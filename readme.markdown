# OneFileCMS

## Yeah, it's exactly what you think.

![OneFileCMS](http://onefilecms.com/images/screenshots/branded_index.jpg)

OneFileCMS is just that. It's a flat, light, one file CMS (Content Management System) entirely contained in an easy-to-implement, highly customizable, database-less PHP script.

Coupling a utilitarian code editor with all the basic necessities of an FTP application, OneFileCMS can maintain a whole website completely in-browser without any external programs.

**Demo**: [http://php.opensourcecms.com/scripts/details.php?scriptid=340](http://php.opensourcecms.com/scripts/details.php?scriptid=340)

## Features
 
- Validating, semantic, and commented markup. Tested in FF, Safari, and IE7/IE8.
- Possibly the easiest installation process ever
- All the basic features of an FTP application like renaming, deleting, copying, and uploading<br />
  _(Of course, for more complex processes like batch renaming or mass uploads/deletions, you're going to want to break out an actual FTP program.)_
- Gracefully degrading CSS and Javascript
- 100% re-brandable with title/footer text stored in variables and a modifiable filename
- Externally hosted CSS and images for smaller file size<br />
  _(But you can switch it out to your own stylesheet if you need to!)_
- Smart alert if you try to leave without saving your edits

## Installation

Download [this file](https://raw.github.com/rocktronica/OneFileCMS/master/onefilecms.php).

Your username and password are inlined. Edit them to something less obvious.

    // CONFIGURATION INFO
    $config_username = "username";
    $config_password = "password";

Optional variables thereafter: password hint, title, footer text, filetypes to disable, and filenames to ignore

You can also change the name of the file to something else. Be careful making it a folder's default file; your server may get stuck in redirects.

Upload!

Depending on how your stack is set up, you may also have to modify the file permissions of your site's folders to allow OneFileCMS to modify and create files. ([More about that here.](http://catcode.com/teachmod/)) Make sure onefilecms.php and its parent folder are allowed to execute, with CHMOD at 777 or 755. Check with your host if you're not sure, and be aware of any inherent security concerns.

## FAQ

### Where's the WYSIWYG? What about syntax highlighting?

WYSWIWYG editors have been requested but probably won’t ever come standard, as they’d bloat the system out and/or make it more than one file, sort of defeating the novelty. Plus, if you’re working in PHP or non-HTML code, they're generally more hindrance than anything else.

Just because I don't want to do it, though, doesn't mean it's impossible. About halfway through, look for this line (If you're searching for it, it's the second instance):

    // EDIT

This is the edit page code. Its textareas can be modified to work with whatever editor you like. If the editor is initiated via jQuery, you can call it in the jQ code in the footer.

### I found something that could be better. Can I suggest it to you?

Yes, of course, you can!

I may not have the bandwidth to implement every feature, but I'll do what I can. If it's urgent, contact me.

Otherwise, try [forking the file and submitting your changes to me](https://github.com/blog/844-forking-with-the-edit-button).

Everything's welcome!

### This is basically just a file manager with a text editor. Why is it being called a Content Management System?

Because "OneFileFileManagerTextEditor" doesn't quite have the same ring to it, duh.

### Multi-Language Support?

Maybe later!

### Can I have more than one username/password?

The reason there isn't default support for multiple users is that all of their info will have to be stored together, more or less in plain text, at the top of onefilecms.php. Giving people different usernames and passwords then is sort of futile, since everyone who can log in can view onefilecms's source and config variables. (This answer kind of ignores MD5 hashes but is valid for most considerations.)

### Is the JavaScript at the end of file really needed? When I remove it, everything works fine.

It isn't entirely necessary, but it does nice little progressive enhancements like warn if you try to leave w/o saving and stuff like that. Feel free to take it out if you're trying to trim down your figure.

## Updates

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

- UNIX/Linux host, Apache
- PHP5 (PHP4 untested)
- File permission privileges

## Credit, License, Et Cetera

Written in PHP, XHTML, CSS, and [jQuery](http://jquery.com/). Icons by [famfamfam](http://www.famfamfam.com/).

Available under the MIT and BSD license.

To report a bug or request a feature, please file an issue via Github. Forks encouraged!