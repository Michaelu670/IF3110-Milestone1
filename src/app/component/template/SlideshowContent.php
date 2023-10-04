<?php

function echoSlideshowContent($url) {
    $html = <<<"EOT"
    <div class="mySlides fade">
        <img src="$url" style="width:100%">
    </div>

EOT;

    echo $html;

    
}