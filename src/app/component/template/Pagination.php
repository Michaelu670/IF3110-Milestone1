<?php
/**
 * $page_cos: block order from left, 0 is leftmost.
 * $page_count: total page in result
 * $page_displayed: number of block in pagination, default = 9.
 */
function echoPagination($page_count, $page_pos, $page_displayed) {
    $next_page = 0;
    $fill = $page_pos;

    $page_now = $_GET['page'] ?? 1;
    if ($page_pos == 0) {
        $fill = '<';
        $next_page = max(1, $page_now - 1);
    } 
    else if ($page_pos == $page_displayed - 1 || $page_pos == $page_count + 1) {
        $fill = '>';
        $next_page = min($page_count, $page_now + 1);
    }
    // angka
    else if ($page_pos > $page_count + 1) exit;
    else if ($page_count <= 7) {
        $fill = $page_pos;
        $next_page = $page_pos;
    }
    else if ($page_now < 5) {
        if ($page_pos <= 5) {
            $next_page = $page_pos;
        }
        else if ($page_pos == 6) {
            $next_page = $page_now;
            $fill = '...';
        }
        else if ($page_pos == 7) {
            $next_page = $page_count;
            $fill = $page_count;
        }
    }
    else if ($page_count - $page_now < 5) {
        if ($page_pos == 1) {
            $next_page = $page_pos;
        }
        else if ($page_pos == 2) {
            $next_page = $page_now;
            $fill = '...';
        }
        else {
            $next_page = $page_count - $page_displayed + 1 + $page_pos;
            $fill = $next_page; 
        }
    }
    else {
        if ($page_pos == 2 || $page_pos == 6) {
            $next_page = $page_now;
            $fill = '...';
        }
        else if ($page_pos == 1) {
            $next_page = $page_pos;
        }
        else if ($page_pos == 7) {
            $next_page = $page_count - $page_displayed + 1 + $page_pos;
            $fill = $next_page; 
        }
        else {
            $next_page = $page_pos - 4 + $page_now;
            $fill = $next_page;
        }
    }

    // $query = $_GET;
    // $query['page'] = $next_page;
    // $link = $_SERVER['REQUEST_URL'] . '?' . http_build_query($query);

    $curClass = 'page';
    if ($page_now == $fill) $curClass = 'page active';

    // if ($func !== '') {
    //     $func = $func . '('. $next_page . ')';
    // }

    $html = <<<"EOT"
        <a class="$curClass">{$fill}</a>

EOT;
    if ($page_pos < $page_count + 2)
        echo $html;

}