<?php

/**
 * Router for `php -S` so existing files under public/ are served as static assets
 * and all other requests bootstrap Laravel via index.php.
 */
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');

if ($uri !== '/' && file_exists(__DIR__.$uri)) {
    return false;
}

require_once __DIR__.'/index.php';
