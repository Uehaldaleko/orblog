orblog (0.1)
------
Simple blog for hidden services with markdown support.

###### Features
* Without JavaScript.
* Posts with markdown support.
* Comments with markdown support.
* Categories.
* View posts by tags.


###### System requirements
* PHP 7.3 +
* GDLib
* SQLite3

###### Installation
* Edit config file (./config.php).
* Set permissions.
  * For ./private/data 775
  * For ./private/data/data.sqlite 664
  * For other files 644
* Deny access to ./private directory at web server.
* Open your_domain/?view=admin in web browser.