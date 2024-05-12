<?php

class View
{
    public static function view($template)
    {
        $path = 'view/' . $template;

        if (file_exists($path) == false) {
            trigger_error('Template ' . $path . ' doesnt exist', E_USER_NOTICE);
            return false;
        }

        include($path);
    }
}
