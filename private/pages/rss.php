<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
header("Content-Type: application/xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<rss version="2.0">
  <channel>
    <title><?=TITLE?></title>
    <link><?=URL?></link>

<?php

$query  = 'SELECT COUNT(*) FROM `posts`';
$count  = $sqlite -> querySingle($query);
$query  = 'SELECT * FROM `posts` ORDER BY `time` DESC LIMIT 0, '.MAXPOSTS;
$result = $sqlite -> query($query);

if($count)
{
  $parser = new Parsedown();
  $parser -> setSafeMode(true);
  
  while ($row = $result -> fetchArray())
  { 
    if(!$row['time']) exit;
    
    $_TPL['id']       = $row['id'];   
    $_TPL['title']    = $row['title'];     
    $_TPL['desc']     = parser($row['desc']); 
  
    include_template('rss');
  }
}
?>
  </channel>
</rss>
<?php exit;
