<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>          
            <form action="index.php?view=admin&action=edit_category&id=<?=$_TPL['id']?>" method="post">
              <input type="text" class="editor input_id" name="sort" placeholder="ID" value="<?=$_TPL['sort']?>">
              <input type="text" class="editor input_name" name="name" placeholder="<?=$_LANG['category_name']?>"  value="<?=$_TPL['name']?>">
              <input type="submit" class="button editor input_button" value="⟳">
              <input type="submit" class="button editor input_button" value="✕" name="delete">
            </form> 
