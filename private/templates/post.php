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
            <?php if($_SESSION['admin']) { ?>  
              [ <a href="index.php?view=admin&page=edit_post&id=<?=$_TPL['id']?>"><?=$_LANG['edit']?></a> ]  
            <?php } ?>
            <a href="index.php?view=post&id=<?=$_TPL['id']?>#comments"><?=$_LANG['comments']?> ( <?=$_TPL['comments']?> )</a>
          </div>     
        </div> 
        <div class="clear"></div>
        <div class="content">
          <h1><?=$_TPL['title']?></h1>
          <?=$_TPL['text']?>  
          <br>
          <?php if($_TPL['tags']) { ?>           
            <?=$_LANG['tags']?>: <?=$_TPL['tags']?><br>
          <?php } ?>          
          <br>
          <div class="clear" id="comments"></div>
