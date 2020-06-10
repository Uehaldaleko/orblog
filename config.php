<?php
/*-----------------------------------------------------------------------------
    
  orblog - Simple blog for hidden networks.  
  
    Version:   0.1
    GitLab:    https://github.com/neuberon/orblog/
    Copyright: neuberon@disroot.org 2020
    License:   http://www.apache.org/licenses/LICENSE-2.0

-----------------------------------------------------------------------------*/
  
// Path to database.
  define('DATABASE', 'private/data/data.sqlite');    

// URL with ending "/".
  define('URL', 'http://orblog.local/');    

// Language (en, ru). 
  define('LANG', 'en');                   

// Admin password.
  define('PASS', 'changeme');                

// Title.  
  define('TITLE', 'orblog - simple blog');    

// Text logo in header.
  define('TEXTLOGO','orblog');                  

// Header text.
  define('H_DESC', 'Simple blog for hidden services with markdown support. Read README.md for more info or visit <a href="https://github.com/neuberon/orblog/">https://github.com/neuberon/orblog/</a>');  

// Copyright.                                               
  define('COPY', 'orblog 2020');                 

// Max. posts per page.
  define('MAXPOSTS', 10);                       

// Allow comments.
  define('COMMENTS', true); 

// Antiflood.
  define('ANTIFLOOD', 30);                        

