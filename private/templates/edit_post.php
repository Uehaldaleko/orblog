<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>
          <h1><?=$_LANG['edit_post']?></h1>
          <form action="index.php?view=admin&action=edit_post&post=<?=$_TPL['id']?>" method="post">       
            <input type="text" name="title" class="editor" value="<?=$_TPL['title']?>">
            <select name="category" class="editor">
              <option value=" <?=$_TPL['category']?>"><?=$_TPL['category_name']?></option>
              <option value="0"></option>
              <?=$_TPL['category_select']?>
              <option value="0"><?=$_LANG['without_cat']?></option>
            </select>   
            <textarea name="desc" class="editor" rows="5"><?=$_TPL['desc']?></textarea>
            <textarea name="text" class="editor" rows="20"><?=$_TPL['text']?></textarea>          
            <input type="text" name="tags" class="editor" value="<?=$_TPL['tags']?>">
            <input type="submit" class="button" value="<?=$_LANG['submit']?>" style="float:left">
          </form>
          <a href="index.php?view=admin&action=delete_post&id=<?=$_TPL['id']?>" class="title_etc"><?=$_LANG['delete']?></a>
