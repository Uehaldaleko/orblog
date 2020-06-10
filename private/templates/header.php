<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html lang="<?=LANG?>">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="public/style/main.css">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="<?=$_TPL['desc']?>">
    <title><?=$_TPL['title']?></title>
  </head>
  <body>
    <header>
      <div class="body">
        <div class="header_logo">
          <a href="<?=URL?>"><?=TEXTLOGO?></a>
        </div>      
        <div class="header_desc">
          <div class="heder_block">
            <?=H_DESC?>
          </div>
        </div>
      </div>
    </header>
    <div class="body">
      <section class="main">
