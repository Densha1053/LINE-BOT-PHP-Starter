<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL, 
    'https://ami1053.herokuapp.com/action_page.php?1=Mickey&lastname=Mouse'
);
$content = curl_exec($ch);
echo $content;
