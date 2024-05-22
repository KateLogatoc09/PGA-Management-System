<?php

if (!function_exists('set_active')) {
    function set_active($uri)
    {
        return (uri_string() == $uri) ? 'active' : '';
    }
}