<?php

function echoTagCheckbox($data) {
    $html = <<<"EOT"
        <input type="checkbox" id="$data" class="tag-checkbox" />
        <label for="$data">$data</input>
        <br>

EOT;

    echo $html;

}