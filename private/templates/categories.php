<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>        
            <div class="clear"></div>
            <br>
            <div class="title">
              <div class="title_tab">
                <?=$_LANG['add_category']?>
              </div>   
            </div>
            <div class="content">
              <form action="index.php?view=admin&action=add_category" method="post">
                <input type="text" class="editor" name="sort" placeholder="<?=$_LANG['sort_category']?>">
                <input type="text" class="editor" name="name" placeholder="<?=$_LANG['category_name']?>">
                <input type="submit" class="button" value="<?=$_LANG['submit']?>">
              </form>
            </div>
