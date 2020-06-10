<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>
        <div class="title">
          <div class="title_tab">
            <?=$_LANG['admin']?>
          </div>
            <div class="title_etc"> 
            <a href="index.php?view=admin&auth=sign_out"><?=$_LANG['sign_out']?></a>
          </div>    
        </div>    
        <div class="clear"></div>
        <div class="content">
          <div class="center">
            <a href="index.php?view=admin&page=add_post"><?=$_LANG['add_post']?></a> | 
            <a href="index.php?view=admin&page=categories"><?=$_LANG['categories']?></a> |  
            <a href="index.php?view=admin&page=comments"><?=$_LANG['comments']?></a>
          </div>
