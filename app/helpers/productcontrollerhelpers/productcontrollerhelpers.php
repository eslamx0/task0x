<?php
namespace Task\Helpers\ProductControllerHelpers;

// directors
use Task\Lib\ProductsModelsDirector;
use Task\Lib\ProductsReposDirector;

trait ProductControllerHelpers
{
    private function getReposClasses()
    {
        $productsReposDirector = new ProductsReposDirector;
        $reposClasses = $productsReposDirector -> getReposClasses();

        return $reposClasses;
    }


    
    // this is for getting all types' products
    private function getProducts()
    {

        // repos classes
        $reposClasses = $this->getReposClasses();

        // getting all products of all types
        $products = [];
        foreach ($reposClasses as $repoClass) {
            $repo = new $repoClass;

            $typeProducts = $repo -> getAllProducts();
            foreach ($typeProducts as $product) {
                array_push($products, $product);
            }
        }

        return $products;
    }



    //arranging products by the item_id which means by who was created first
    private function sortProducts($products)
    {
        usort(
            $products,
            function ($a, $b) {
            return $a['item_id'] <=> $b['item_id'];
        }
        );

        return $products;
    }



    // Model instantiation
    private function createProduct($type)
    {
        $productsModelsDirector = new ProductsModelsDirector;
        $model = $productsModelsDirector->instantiateModel($type);
        $model->setAttrs($_POST);

        return $model;
    }



    private function createProductRepo($type)
    {
        $productsReposDirector = new productsReposDirector;
        $productRepo = $productsReposDirector -> instantiateRepo($type);

        return $productRepo;
    }
}
