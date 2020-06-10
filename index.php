<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/

include_once 'config.php';
include_once 'private/libs/functions.php';
include_once 'private/libs/parsedown.php';
include_once 'private/languages/'.LANG.'.php';

date_default_timezone_set('UTC');
session_name('SESSID');
session_start();

$sqlite = new SQLite3(DATABASE);

$category_dump = $sqlite -> query('SELECT * FROM `categories` 
                                   ORDER BY `sort` ASC');
if (!empty($_GET['view']))
{ 
  $view = preg_replace ("/[^a-zA-Z_\-\d]/ui","",$_GET['view']);
  
  if(file_exists('private/pages/'.$view.'.php'))    
    include 'private/pages/'.$view.'.php';  
  else include 'private/pages/404.php';
}
else include 'private/pages/index.php';

$_TPL['category_list'] = view_categories($category_dump);
include_template('footer');
