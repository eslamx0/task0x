<?php
namespace Task\Models;

class DVD extends AbstractProduct
{
    private $size;

    protected $mainAttrs = ['sku', 'name', 'price', 'typeSwitcher', 'size'];

    // Setters
    public function setSize($size)
    {
        $this->size = $size;
    }

    // Getters
    public function getSize()
    {
        return $this->size;
    }
}
