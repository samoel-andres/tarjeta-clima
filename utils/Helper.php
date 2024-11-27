<?php

class Helper
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getValue($index, $key)
    {
        return isset($this->data[$index][$key]) ? $this->data[$index][$key] : 'N/A';
    }
}
