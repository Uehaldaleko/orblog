<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>
          <h1><?=$_LANG['add_post']?></h1>
          <form action="index.php?view=admin&action=add_post" method="post">       
            <input type="text" name="title" class="editor" placeholder="<?=$_LANG['post_title']?>">
            <select name="category" class="editor">
              <option value="0"><?=$_LANG['without_cat']?></option>
              <?=$_TPL['category_select']?>
            </select>   
            <textarea name="desc" class="editor" rows="5" placeholder="<?=$_LANG['post_desc']?>"></textarea>
            <textarea name="text" class="editor" rows="20" placeholder="<?=$_LANG['post_text']?>"></textarea>          
            <input type="text" name="tags" class="editor" placeholder="<?=$_LANG['post_tags']?>">
            <input type="submit" class="button" value="<?=$_LANG['submit']?>">
          </form>
