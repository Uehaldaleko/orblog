<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>
          <h1 id="add"><?=$_LANG['add_comment']?></h1>
          <?php if($_TPL['error']) { ?>  
            <div class="error">
                <?=$_TPL['error']?>
            </div>
          <?php } ?>          
          <form action="index.php?view=post&id=<?=$_TPL['id']?>&action=add_comment" method="post">       
            <textarea name="text" class="editor" rows="4" placeholder="<?=$_LANG['comment_text']?>"></textarea>
            <img src="captcha.php" alt="captcha" class="captcha"><br>
            <input type="text" name="captcha" class="editor" placeholder="<?=$_LANG['input_captcha']?>">
            <input type="submit" class="button" value="<?=$_LANG['submit']?>">
          </form>
