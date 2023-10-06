<?php

function echoTagCheckbox($data) {
    $checked = '';
    if (isset($_GET['tags']) && in_array($data, explode(',', $_GET['tags']))) {
        $checked = 'checked';
    }
    $html = <<<"EOT"
        <label class="container-checkbox" for="$data">$data
            <input type="checkbox" id="$data" class="tag-checkbox" $checked>
            <span class="checkmark"></span>
        </label>
        <br>

EOT;

    echo $html;

}