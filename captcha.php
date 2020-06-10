<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/

session_name('SESSID'); 
session_start();                  

$captcha = imagecreate(80, 30); 
imagecolorallocate($captcha, 255, 255, 255);

$color = imagecolorallocate($captcha, 60, 60, 60); 
imagettftext($captcha, 16, 0, 6, 22, $color, 
             'public/style/roboto.ttf', $_SESSION['captcha']);

header('Content-type: image/png');
imagepng($captcha);
