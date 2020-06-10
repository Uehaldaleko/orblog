<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/

/*--  Posts count  ----------------------------------------------------------*/
if(!isset($_GET['category']) and !isset($_GET['tag']))
{
  $query  = 'SELECT COUNT(*) FROM `posts`';
}
else if(isset($_GET['category']))
{
  $cat    = filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT);
  if ($cat < 0) $cat = 0;
  $query  = 'SELECT COUNT(*) FROM `posts` WHERE category = '.$cat;  
  
  $name = category_name($cat);
}
else if($_GET['tag'])
{
  $tag = preg_replace ("/[^a-zA-Zа-яА-ЯёЁ_\-\d]/ui","",$_GET['tag']);
  $query  = 'SELECT COUNT(*) FROM `posts` WHERE tags LIKE "%'.$tag.'%"';
}
$count  = $sqlite -> querySingle($query);

/*--  Pagination  -----------------------------------------------------------*/
if($count)
{
  if(!$_GET['page']) $page = 0; 
  else $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT);

  $start  = $page * MAXPOSTS;

  if($page < 0 or ($page * MAXPOSTS) >= $count )
  {
    header('Location:'.URL.'index.php?view=404'); exit;
  }
}
/*--  Get posts and set pagination links  -----------------------------------*/
if(!isset($_GET['category']) and !isset($_GET['tag']))
{
  $query  = 'SELECT * FROM `posts`
             ORDER BY `time` DESC  
             LIMIT '.$start.', '.MAXPOSTS;
             
  $_TPL['title'] = TITLE;             
  
  if(($page - 1) >= 0) 
    $_TPL['prev_page'] = 'index.php?page='.($page - 1);
  if((($page + 1) * MAXPOSTS) < $count)
    $_TPL['next_page'] = 'index.php?page='.($page + 1);
}
else if(isset($cat))  // Categories
{
  $query  = 'SELECT * FROM `posts`  WHERE category = '.$cat.'
             ORDER BY `time` DESC LIMIT '.$start.', '.MAXPOSTS;
  
  $_TPL['title'] = $name.' | '.TITLE;             
  if($cat == 0) $_TPL['title'] = $_LANG['without_cat'].' | '.TITLE;   

  if(($page - 1) >= 0) 
    $_TPL['prev_page'] = 'index.php?category='.$cat.'&page='.($page - 1);
  if((($page + 1) * MAXPOSTS) < $count)
    $_TPL['next_page'] = 'index.php?category='.$cat.'&page='.($page + 1);
}
else if(isset($tag)) // Tags
{
  $query  = 'SELECT * FROM `posts` WHERE tags LIKE "%'.$tag.'%"
             ORDER BY `time` DESC LIMIT '.$start.', '.MAXPOSTS;

  $_TPL['title'] = '@'.$tag.' | '.TITLE;  

  if(($page - 1) >= 0) 
    $_TPL['prev_page'] = 'index.php?tag='.$tag.'&page='.($page - 1);
  if((($page + 1) * MAXPOSTS) < $count)
    $_TPL['next_page'] = 'index.php?tag='.$tag.'&page='.($page + 1);
}
else
{
  header('Location:'.URL.'index.php'); exit;
}

$result = $sqlite -> query($query);

/*--  View posts  -----------------------------------------------------------*/
$parser = new Parsedown();

include_template('header');

if($count) view_posts($result);
else include_template('index_empty');

include_template('index_footer');
