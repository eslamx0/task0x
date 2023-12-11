<?php
namespace Task\Models;

class Book extends AbstractProduct
{
    private $weight;

    protected $mainAttrs = ['sku', 'name', 'price', 'typeSwitcher', 'weight'];

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }
}
