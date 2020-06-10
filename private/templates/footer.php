<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>
        </div>
      </section>
      <section class="sidebar">
        <div class="title">
          <div class="title_tab">
              <?=$_LANG['categories']?>
          </div>
          <div class="title_etc">
            <?php if($_SESSION['admin']) { ?>  
              <a href="index.php?view=admin"><?=$_LANG['admin']?></a>
            <?php } ?>
          </div>     
        </div>
        <div class="clear"></div>
        <nav class="categories">
          <?=$_TPL['category_list']?>
          
          <a href="index.php?category=0"><?=$_LANG['without_cat']?></a>
          <a href="index.php"><?=$_LANG['all_posts']?></a>
        </nav>
      </section>
    </div>
    <div class="clear"></div>
    <footer>
      <div class="body">
        <div class="footer_copy">
          &copy; <?=COPY?>
        </div>      
        <div class="footer_text">
          Powered by <a href="https://github.com/neuberon/orblog/" title="Simple blog for hidden networks.">orblog</a>.
        </div>
      </div>
    </footer>
  </body>
</html>
