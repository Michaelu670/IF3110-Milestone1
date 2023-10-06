<?php

function echoTagCheckbox($data) {
    $html = <<<"EOT"
        <label class="container-checkbox" for="$data">$data
            <input type="checkbox" id="$data" class="tag-checkbox">
            <span class="checkmark"></span>
        </label>
        <br>

EOT;

    echo $html;

}