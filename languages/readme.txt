* Get Poedit.
* Open the po file.
* Configure the Poedit Katalog to use the theme root folder excluding node modules and use all additional symbols from here (including numbers for contexts and plural forms of phrases!):
  https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#localization-functions
* Update from source code.
* Translate and save.
* Copy mo file to <wordpress-root>/wp-content/languages/themes/owneon-de_DE.mo
* ensure wp-config.php contains 
    define('WPLANG', 'de_DE');
