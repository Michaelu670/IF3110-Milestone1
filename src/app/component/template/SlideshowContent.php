<?php

function echoSlideshowContent($url) {
    $ext = explode('.', $url);
    $ext = $ext[count($ext) - 1];

    $videoExt = ['mp4', 'ogg'];

    $html = <<<"EOT"
    <div class="mySlides fade">
        <img src="$url" style="width:100%" alt="product image">
    </div>

EOT;

    if (in_array($ext, $videoExt)) {
        $html = <<<"EOT"
    <div class=mySlides fade">
        <video controls>
            <source src="$url" type="video/$ext">
            Your browser does not support the video tag.
        </video>
    </div>

EOT;
    } 
    
    echo $html;

    
}