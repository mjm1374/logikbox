-----------------------
LANGUAGE - PLEASE READ
-----------------------

The .php files in the 'content/language/english/' directory are languages files for this software. Edit them to suit your own preferences.
It is recommended you edit these files in a good text editor. Notepad is fine. Microsoft Word and other word processors are NOT recommended.

DO NOT edit the lang variable / array names in any way and be careful NOT to remove any of the apostrophe`s (') that contain the variable info. This will cause the script to malfunction.

------------------------------------
USING APOSTROPHES IN VARIABLES
------------------------------------

If you need to use an apostrophe, escape it with a backslash. eg: d\'apostrophe. Also see the note in the 'content/language/english/global.php' file with regards to javascript variables.

------------------------------------
AMPERSANDS (&)
------------------------------------

So that ampersands don`t break the validation, the corresponding character entity should be used. Example:

tea & coffee (WRONG)
tea &amp; coffee (CORRECT)

-----------------------
SYSTEM VARIABLES
-----------------------

Text between braces are system variables. eg: {count} etc

The system will not fail if you accidentally delete these, but some language may not display correctly.

-----------------------
ADMIN VARIABLES
-----------------------

Language files in the 'content/language/english/admin/' folder relate to admin operations ONLY.

-----------------------
EMAIL TEMPLATES
-----------------------

The email templates are located in the 'content/language/english/email-templates/' directory.

Admin operation email templates are located 'content/language/english/admin/email-templates/'.

Again, do NOT remove any system variables between braces. eg: {NAME}

-----------------
WHITESPACE
-----------------

When you edit any of the language files, make sure there is NO whitespace after the closing ?> tag. This will cause the language and the system to fail.

------------------
TEXT EDITORS
------------------

There are some excellent free text editors around. A few recommendations are as follows:

- SynWrite
  http://www.uvviewsoft.com/synwrite/

- PSPad
  http://www.pspad.com/

- Notepad++
  http://notepad-plus-plus.org

- RJ TextEd
  http://www.rj-texted.se/

----------------
SEARCHING
----------------

If you can`t find a particular variable, use a good search utility to find the language you are looking for and search the 'content/language/english/' directory.
Note that the same text may appear in several files.

Recommended free search utilities are:

- File Locator
  http://www.mythicsoft.com

- Search My Files
  http://www.nirsoft.net/utils/search_my_files.html

- Super Finder
  http://fsl.sytes.net

- Copernic
  http://www.copernic.com/en/products/desktop-search/index.html

- File Seek
  http://www.fileseek.ca/


=============================================================================================
NOTE THAT I AM NOT AFFILIATED WITH THE ABOVE PRODUCTS AND THEY ARE USED AT YOUR OWN RISK!!
=============================================================================================


