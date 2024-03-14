<?php

trait View
{
    public function view($view, $data = [])
    {
        extract($data);

        return include "Views/$view.php";
    }
}