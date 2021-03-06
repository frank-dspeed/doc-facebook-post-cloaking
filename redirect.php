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
$url = base64_decode($_GET[url]);
//read the entire string
$output_html=file_get_contents('template.html');
$output_js=file_get_contents('geoip-params.js');
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
$output_remote = curl_exec($curl);
curl_close($curl);

$DOM = new DOMDocument;
libxml_use_internal_errors(true);
$DOM->loadHTML( $output_remote);
libxml_clear_errors();


//get all img tags and title tags into vars
$itemstitle = $DOM->getElementsByTagName('title');
$itemsimg = $DOM->getElementsByTagName('img');

 for ($i = 0; $i < $itemstitle->length; $i++)
        $inserttitle = $itemstitle->item($i)->nodeValue;

//display all H1 text
 $insertimgs = "";
 for ($i = 0; $i < $itemsimg->length; $i++) {
        $insertimgs .= '<img src="'.$itemsimg->item($i)->getAttribute('src') . '" /> <br/>';
    }

// CREATING dom object from url and extract titel and imags in loop and save into vars

//replace something in the string - this is a VERY simple example
$output_html=str_replace("###TITLE###", $inserttitle, $output_html);
$output_html=str_replace("###IMGS###", $insertimgs, $output_html);
$output_js=str_replace("###URL###", $url, $output_js);
$output_html=str_replace("###JS###", $output_js, $output_html);
echo $output_html;

// Loadtemplate and insert Title and Images then return it
