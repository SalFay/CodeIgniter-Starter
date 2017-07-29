<?php

if(!function_exists('theme_url')){
    function theme_url($url){
        $ci = &get_instance();
        $url = ltrim($url,'/');
        return $ci->theme->getThemeUrl().$url;
    }
}

if(!function_exists('ci')){
    function &ci(){
        return get_instance();
    }
}
