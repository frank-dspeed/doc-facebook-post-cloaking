<?php
/* 
Implementation

I require a php script that is capable of doing this. (plus a configured .htaccess file that allows me write redirect.com/move/YmxvZy5jb20vYXJ0aWNsZS9h and still target the php script )

1. The script receives the YmxvZy5jb20vYXJ0aWNsZS9h and decodes it from base64 => blog.com/article/a
2. It will then load blog.com/article/a and:
a. extract the title - T0
b. extract all images from img tags - ImageList
3. The script will output html:
a. the title will be set to T0
b. for every image inside ImageList => it will output an image tage with the image url (with display:none)
4. The script will also issues a javscript redirect to blog.com/article/a immediatly
*/

// Getting Parameters from rewrite or directly
$processing_url = base64_decode($_GET[url]);




// CREATING dom object from url and extract titel and imags in loop and save into vars



// Loadtemplate and insert Title and Images then return it