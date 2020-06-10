<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

/*-- Get post contents  -----------------------------------------------------*/
if($id <= 0)
{
  header('Location:'.URL.'index.php?view=404'); exit;
}
  
$result    = $sqlite -> query('SELECT * FROM `posts` WHERE id='.$id);
$post_data = $result -> fetchArray(SQLITE3_ASSOC);
  
if(!$post_data['time'])
{
  header('Location:'.URL.'index.php?view=404'); exit; 
}   

$_TPL['title']       = $post_data['title'].' | '.TITLE;

include_template('header');

/*-- View post contents  ----------------------------------------------------*/
$parser = new Parsedown();

$_TPL['id']          = $id;
$_TPL['time']        = date("d.m.y", $post_data['time']);
$_TPL['title']       = $post_data['title'];
$_TPL['desc']        = parser($post_data['desc']);
$_TPL['text']        = parser($post_data['text']);
$_TPL['tags']        =   separate_tags($post_data['tags']);
$_TPL['comments']    = $post_data['comments'];

include_template('post');

/*--  Add a comment  --------------------------------------------------------*/
if($_GET['action'] == 'add_comment' && COMMENTS)
{
  $post_url = URL.'index.php?view=post&id='.$_TPL['id'];
  
  if(empty($_POST['text']) or $_POST['captcha'] != $_SESSION['captcha'])
  {
    header('Location:'.$post_url.'&error=comment_err#add'); exit;  
  } 
  
  if($_SESSION['flood'] and (time() - $_SESSION['flood']) < ANTIFLOOD)
  {
    header('Location:'.$post_url.'&error=antiflood#add'); exit;  
  }   
     
  $_SESSION['flood'] = time();
  
  $query = 'INSERT INTO `comments` (id, time, text, admin)
            VALUES (:id, :time, :text, :admin)';
  
  $stmt = $sqlite -> prepare($query);
  
  $stmt -> bindValue(':id',    $id,                SQLITE3_INTEGER);
  $stmt -> bindValue(':time',  time(),             SQLITE3_INTEGER);
  $stmt -> bindValue(':text',  $_POST['text'],     SQLITE3_TEXT);
  $stmt -> bindValue(':admin', $_SESSION['admin'], SQLITE3_INTEGER);

  
  $stmt->execute();
  
  $query = 'UPDATE `posts` SET comments = '.($post_data['comments']+1).' 
            WHERE id = '.$id;
  $sqlite -> exec($query);
}
/*--  View comments  --------------------------------------------------------*/

$parser -> setSafeMode(true);

$query  = 'SELECT * FROM `comments` WHERE id='.$id;
$result = $sqlite -> query($query);

view_comments($result);
  
/*--  Comment form  ---------------------------------------------------------*/
if(COMMENTS)
{
  $_SESSION['captcha'] = gen_captcha();
  
  if ($_GET['error'] == "comment_err") $_TPL['error'] = $_LANG['comment_err'];
  if ($_GET['error'] == "antiflood")   $_TPL['error'] = $_LANG['flood_err'];  

  include_template('comment_form');
}
