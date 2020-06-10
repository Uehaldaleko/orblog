<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>
        <div class="content">
          <div class="center">  
            <?php if($_TPL['prev_page']) { ?>  
              <a href="<?=$_TPL['prev_page']?>">⤽ &nbsp;<?=$_LANG['prev_page']?></a>&nbsp;
            <?php } ?>
            <?php if($_TPL['next_page']) { ?>  
              &nbsp;<a href="<?=$_TPL['next_page']?>"><?=$_LANG['next_page']?>&nbsp; ⤼</a>
            <?php } ?>
          </div>    
          
