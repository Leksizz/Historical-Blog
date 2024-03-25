<?php

namespace Core;

class View
{
    public function generate($content, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }
        require_once('application/views/template.php');
    }
}