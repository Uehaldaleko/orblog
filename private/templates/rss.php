<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>
    <item>
      <title><?=$_TPL['title']?></title>
      <link><?=URL?>index.php?view=post&amp;id=<?=$_TPL['id']?></link>
      <description>
        <![CDATA[<?=$_TPL['desc']?>]]>
      </description>
    </item>
