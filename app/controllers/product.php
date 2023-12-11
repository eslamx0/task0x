<?php
namespace Task\Controllers;

// helpers
use Task\Helpers\ProductControllerHelpers\ProductControllerHelpers;
use Task\Helpers\ProductControllerHelpers\RenderSpecialAttr;

// directors ;)
use Task\Lib\ProductsReposDirector;

class Product extends AbstractController
{
    use ProductControllerHelpers;
    use RenderSpecialAttr;
    
    public function defaultAction()
    {

        // getting all types' products
        $products = $this->getProducts();

        // Sorting products ascending by item_id
        $sortedProducts = $this->sortProducts($products);
    
        // Getting each id with its special attr to be rendered
        $idsWithToBeRenderedSpecialAttrs = $this->idsWithToBeRenderedSpecialAttrs($sortedProducts);

        // Assigning to data be rendered with
        $this->data['idsWithSpecialAttrs'] = $idsWithToBeRenderedSpecialAttrs;
        $this->data['products'] = $sortedProducts;

        // Render Views
        $this->renderView();
    }


    // sku, name, price && dimensions or weight or size

    public function deleteAction()
    {
        $productsReposDirector = new productsReposDirector;
        $idsWithTypes = $_POST;

        foreach ($idsWithTypes as $id => $type) {
            // Getting repo of the specific type
            $productRepo = $productsReposDirector -> instantiateRepo($type);
            // delete the product by the id
            $productRepo->delete($id);
        }

        // Go to home
        header('Location: /');
    }



    public function addAction()
    {
        if (isset($_POST['typeSwitcher'])) {
            $productType = $_POST['typeSwitcher'];

            // create a new product obj ( new model)
            $product = $this -> createProduct($productType);

            // create a new product repo
            $productRepo = $this -> createProductRepo($productType);

            // saving the product
            $productRepo->save($product);

            header('Location: /');
        }


        $this->renderView();
    }
}
