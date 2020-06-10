<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/

function parser ($string)
{
  global $parser;

  $string = preg_replace('!\t!', '    ', $string);
  $string = $parser -> text($string);
  return  $string;
}


function category_name($category)
{  
  global $sqlite;
  
  $query = 'SELECT `name` FROM `categories` WHERE id = '.$category;
  $name  = $sqlite -> querySingle($query); 
  
  return $name;
}

function select_categories($result)
{
  while ($cat = $result -> fetchArray())
  { 
    $return.= '<option value="'.$cat['id'].'">'.$cat['name'].'</option>
              ';
  }
  return $return;
}

function view_categories($result)
{
  while ($cat = $result -> fetchArray())
  { 
    $return.= '<a href="index.php?category='.$cat['id'].'">'.$cat['name'].'</a>    
          ';
  }
  return $return;
}

function view_edit_categories($result)
{
  global $_LANG, $_TPL;
  while ($cat = $result -> fetchArray())
  { 
    $_TPL['id']   = $cat['id'];
    $_TPL['sort'] = $cat['sort'];
    $_TPL['name'] = $cat['name'];
    
    include_template('edit_category');    
  }
}

function view_posts($result)
{
  global $_LANG, $_TPL, $parser;
  while ($row = $result -> fetchArray())
  { 
    if(!$row['time']) return 0;
    
    $_TPL['id']       = $row['id'];       
    $_TPL['time']     = date("d.m.y", $row['time']);    
    $_TPL['title']    = $row['title'];     
    $_TPL['desc']     = parser($row['desc']);  
    $_TPL['text']     = parser($row['text']);     
    $_TPL['tags']     = separate_tags($row['tags']);        
    $_TPL['comments'] = $row['comments'];     
    
    include_template('post_short');
  } 
}

function separate_tags($string)
{
  $tags = explode(' ', $string);
  foreach ($tags as &$tag)
    if(!empty($tag))
      $return.= '<a href="index.php?tag='.$tag.'">@'.$tag.'</a> ';  
  return $return;
}

function view_comments($result)
{
  global $_LANG, $_TPL, $parser;
  while ($row = $result -> fetchArray())
  { 
    if(!$row['time']) return 0;
    
    $_TPL['post_id'] = 0;       
    
    if($_TPL['id'] != $row['id']) $_TPL['post_id'] = $row['id'];
    $_TPL['pid']    = $row['id'];    
    $_TPL['cid']    = $row['cid'];     
    $_TPL['time']   = date("d.m.y h:i", $row['time']);    
    $_TPL['text']   = parser($row['text']);     
    $_TPL['admin']  = $row['admin'];         
      
    include_template('comment');
  }
}

function gen_captcha()
{
  $letters = '23456789abcdefghjkmnpqrstvwxyz';
  $return  = substr(str_shuffle($letters), 0, 6);
  return $return;
}

function include_template($template)
{
  global $_LANG, $_TPL, $parser;  
  include 'private/templates/'.$template.'.php'; 
}
