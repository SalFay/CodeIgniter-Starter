<?php
if (!function_exists('old')) {
    function old($field, $default = '', $html_escape = true)
    {
        return set_value($field, $default, $html_escape);
    }
}

if (!function_exists('get_current_url')) {
    function get_current_url()
    {
        $url = current_url();
        $query_string = $_SERVER['QUERY_STRING'];
        if (!empty($query_string)) {
            $url .= '?' . $query_string;
        }
        return $url;
    }
}
