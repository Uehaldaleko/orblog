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
        </div>
        <div class="clear"></div>
        <div class="content">
          <div class="center">
            <h1><?=$_LANG['sign_in']?></h1>
            <?php if($_TPL['error']) { ?>  
              <div class="error">
                <?=$_TPL['error']?>
              </div>
            <?php } ?> 
            <form action="index.php?view=admin&auth=sign_in" method="post">
              <input type="password" name="pass" placeholder="<?=$_LANG['input_pass']?>"><br>
              <img src="captcha.php" alt="captcha" class="captcha"><br>
              <input type="text" name="captcha" placeholder="<?=$_LANG['input_captcha']?>"><br>
              <input type="submit" value="<?=$_LANG['sign_in']?>" class="button"><br>
            </form>
          </div>         
        </div>
