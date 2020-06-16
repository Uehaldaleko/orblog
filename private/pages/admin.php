<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/

/*--  Admin panel auth  -----------------------------------------------------*/
if($_GET['auth'] == 'sign_in')
{
  if($_POST['pass'] == PASS and $_POST['captcha'] == $_SESSION['captcha'])
    $_SESSION['admin'] = 1;
  else
    $_TPL['error'] = $_LANG['error_sign_in'];  
}
if($_GET['auth'] == 'sign_out')
    $_SESSION['admin'] = 0;  

/*--  Admin panel actions  --------------------------------------------------*/
if($_GET['action'] == 'add_post' and $_SESSION['admin'])       // Add post
{
  $query = 'INSERT INTO `posts`
                  (time, category, title, desc, text, tags)
                  VALUES
                  (:time, :cat, :title, :desc, :text, :tags)';

  $stmt = $sqlite -> prepare($query);

  $stmt -> bindValue(':time',  time(),             SQLITE3_INTEGER);  
  $stmt -> bindValue(':cat',   $_POST['category'], SQLITE3_INTEGER);
  $stmt -> bindValue(':title', $_POST['title'],    SQLITE3_TEXT);
  $stmt -> bindValue(':desc',  $_POST['desc'],     SQLITE3_TEXT);
  $stmt -> bindValue(':text',  $_POST['text'],     SQLITE3_TEXT);
  $stmt -> bindValue(':tags',  $_POST['tags'],     SQLITE3_TEXT);

  $stmt->execute();

  header('Location:'.URL); exit;
}

if($_GET['action'] == 'edit_post' and $_SESSION['admin'])      // Edit post
{  
  $query  = 'SELECT COUNT(*) FROM `comments` WHERE id = '.$_GET['post'];
  $count  =  $sqlite -> querySingle($query);

  $query  = 'UPDATE `posts` SET 
             category = :cat,
             title = :title,
             desc = :desc,
             text = :text, 
             tags = :tags,             
             comments = :count
             WHERE id = :id';
  
  $stmt = $sqlite -> prepare($query);

  $stmt -> bindValue(':cat',   $_POST['category'], SQLITE3_INTEGER);
  $stmt -> bindValue(':title', $_POST['title'],    SQLITE3_TEXT);
  $stmt -> bindValue(':desc',  $_POST['desc'],     SQLITE3_TEXT);
  $stmt -> bindValue(':text',  $_POST['text'],     SQLITE3_TEXT);
  $stmt -> bindValue(':tags',  $_POST['tags'],     SQLITE3_TEXT);
  $stmt -> bindValue(':count', $count,             SQLITE3_INTEGER);
  $stmt -> bindValue(':id',    $_GET['post'],      SQLITE3_INTEGER); 
  
  $stmt->execute();
  
  header('Location:'.URL.'/index.php?view=post&id='.$_GET['post']); exit;
} 

if($_GET['action'] == 'delete_post' and $_SESSION['admin'])    // Del post
{ 
    $query  = 'DELETE FROM `posts` WHERE id = '.$_GET['id'];
    $sqlite -> exec($query);
    
    $query  = 'DELETE FROM `comments` WHERE id = '.$_GET['id'];
    $sqlite -> exec($query);
    
    header('Location:'.URL); exit;
}

if($_GET['action'] == 'add_category' and $_SESSION['admin'])   // Add category
{ 
  if (!$_POST['sort']) $_POST['sort'] = 0;
  $query = 'INSERT INTO `categories`
                  (sort, name)
                  VALUES
                  ('.$_POST['sort'].',
                  "'.$_POST['name'].'")';

  $sqlite -> exec($query);
  header('Location:'.URL.'index.php?view=admin&page=categories'); exit;
}

if($_GET['action'] == 'edit_category' and $_SESSION['admin'])  // Edit category
{ 
  if($_POST['delete'])
  {
    $query  = 'DELETE FROM `categories` WHERE id = '.$_GET['id'];
    $sqlite -> exec($query);
    
    header('Location:'.URL.'index.php?view=admin&page=categories'); exit;
  }  
  $query  = 'UPDATE `categories` SET 
             sort = '.$_POST['sort'].',
             name = "'.$_POST['name'].'"              
             WHERE id = '.$_GET['id'];
  $sqlite -> exec($query);

  header('Location:'.URL.'index.php?view=admin&page=categories'); exit;
}

if($_GET['action'] == 'delete_comment' and $_SESSION['admin']) // Del comment
{
  $query  = 'DELETE FROM `comments` WHERE cid = '.$_GET['id'];
  $sqlite -> exec($query);
  
  $query  = 'SELECT COUNT(*) FROM `comments` WHERE id = '.$_GET['post'];
  $count  =  $sqlite -> querySingle($query);
  
  $query  = 'UPDATE `posts` SET comments = '.$count.' 
             WHERE id = '.$_GET['post'];
  $sqlite -> exec($query);  
  
  header('Location:'.$_SERVER['HTTP_REFERER']); exit;
} 

/*--  Pages  ----------------------------------------------------------------*/
$_TPL['title'] = $_LANG['admin'].' | '.TITLE;
include_template('header');

if(!$_SESSION['admin'])                                        // Login
{
  $_SESSION['captcha'] = gen_captcha();
  include_template('sign_in');
}
else if($_GET['page'] == 'add_post')                           // Add post
{   
  $_TPL['category_select'] = select_categories($category_dump);
  
  include_template('admin_header');
  include_template('add_post');
}
else if($_GET['page'] == 'categories')                         // Categories
{   
  include_template('admin_header');
  include_template('categories_header');
    
  view_edit_categories($category_dump);
      
  include_template('categories');
}
else if($_GET['page'] == 'comments')                           // Comments
{   
  $parser = new Parsedown();
  $parser -> setSafeMode(true);

  $query  = 'SELECT * FROM `comments` LIMIT 50';
  $result = $sqlite -> query($query);

  include_template('admin_header');
  include_template('comments');
  view_comments($result);
}
else if($_GET['page'] == 'edit_post')                          // Edit post
{   
  $result    = $sqlite -> query('SELECT * FROM `posts` WHERE id='.$_GET['id']);
  $post_data = $result -> fetchArray(SQLITE3_ASSOC);
  
  $_TPL['id']         = $post_data['id'];  
  $_TPL['category']   = $post_data['category'];
  $_TPL['title']      = $post_data['title'];
  $_TPL['title']      = $post_data['title'];
  $_TPL['desc']       = $post_data['desc'];
  $_TPL['text']       = $post_data['text'];
  $_TPL['tags']       = $post_data['tags']; 

  if($post_data['category'])    
    $_TPL['category_name']   = category_name($post_data['category']);
  else $_TPL['category_name'] = $_LANG['without_cat'];
  
  $_TPL['category_select'] = select_categories($category_dump);
  
  include_template('admin_header');
  include_template('edit_post');
}
else                                                           // Admin inddex
{ 
  $query            = 'SELECT COUNT(*) FROM `posts`';
  $_TPL['posts'] =  $sqlite -> querySingle($query); 
  
  $query            = 'SELECT COUNT(*) FROM `comments`';
  $_TPL['comments'] =  $sqlite -> querySingle($query);

  include_template('admin_header'); 
  include_template('admin_index');
}
