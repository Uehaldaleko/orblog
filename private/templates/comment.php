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
            <?=$_TPL['time']?>
          </div>
          <div class="title_etc">
            <?php if(!$_TPL['admin']) { ?>  
              <?=$_LANG['by_guest']?>
            <?php }else{ ?>
              <?=$_LANG['by_admin']?>
            <?php } ?>
            <?php if($_TPL['post_id']) { ?>  
              [ <a href="index.php?view=post&id=<?=$_TPL['post_id']?>"><?=$_LANG['goto_post']?></a> ] 
            <?php } ?>
            <?php if($_SESSION['admin']) { ?>  
              [ <a href="index.php?view=admin&page=comments&action=delete_comment&id=<?=$_TPL['cid']?>&post=<?=$_TPL['pid']?>"><?=$_LANG['delete']?></a> ] 
            <?php } ?>
          </div>     
        </div> 
        <div class="clear"></div>
        <div class="comment_content">
          <?=$_TPL['text']?>
        </div>          

