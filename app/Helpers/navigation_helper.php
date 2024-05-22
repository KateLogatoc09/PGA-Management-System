<?php

if (!function_exists('set_active')) {
    function set_active($uri, $is_sub = false)
    {
        $current_uri = uri_string();

        if ($is_sub) {
            // For sub-links, check if the current URI starts with the given URI
            return (strpos($current_uri, $uri) === 0) ? 'active' : '';
        } else {
            // For main links, check if the current URI matches exactly
            return ($current_uri == $uri) ? 'active' : '';
        }
    }
}