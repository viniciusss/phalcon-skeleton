<?php
/**
 * PHP Built-in Web Server wrapper for ZF apps
 */

$reqUri = $_SERVER['REQUEST_URI'];
if (strpos($reqUri, '?') !== false) {
    $reqUri = substr($reqUri, 0, strpos($reqUri, '?'));
}

$target = realpath(__DIR__ . $reqUri);
if ($target && is_file($target)) {
    // Security check: make sure the file is under the public dir
    if (strpos($target, __DIR__) === 0) {
        // Tell PHP to directly serve the requested file
        return false;
    }
}

require __DIR__ . '/index.php';

// Cleanup the open cache
opcache_reset();