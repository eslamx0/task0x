<?php
namespace Task\Repositories;

use Task\Models\AbstractProduct;

interface InterfaceProductRepository
{
    // for connection with the DB
    public function connectDb();
    // save a product into db
    public function save(AbstractProduct $product);
    // get all product from database of a specific type like book, furniture and dvd
    public function getAllProducts();
    // delete a specific product type from the db
    public function delete($id);
}
