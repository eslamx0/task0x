<?php
namespace Task\Lib;

class ProductsModelsDirector
{
    private $currentModel;

    private $modelsClasses = array(
        'Book' => 'Task\Models\Book',
        'Furniture' => 'Task\Models\Furniture',
        'DVD' => '\Task\Models\DVD'
    );

    private function currentModelClass($productType)
    {
        $currentModelClass = $this->modelsClasses[$productType];

        return $currentModelClass;
    }

    public function instantiateModel($productType)
    {
        // prouduct class is the model
        $currentModelClass =  $this->currentModelClass($productType);
        $this->currentModel = new $currentModelClass;

        return $this->currentModel;
    }
}
