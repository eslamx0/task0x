<?php
namespace Task\Models;

class AbstractProduct
{
    // common attributes in products
    protected $sku;
    protected $name;
    protected $price;
    protected $typeSwitcher;
    protected $mainAttrs;

    
    // Setters
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setTypeSwitcher($type)
    {
        $this->typeSwitcher = $type;
    }

    public function setAttrs($postedData)
    {
        foreach ($this->mainAttrs as $attr) {
            $attrValue = $postedData[$attr];
            $attrSetter = 'set' . ucfirst($attr);

            $this -> $attrSetter($attrValue);
        }
    }
    
    // Getters
    public function getSku()
    {
        return $this->sku;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getType()
    {
        return $this->typeSwitcher;
    }
}
