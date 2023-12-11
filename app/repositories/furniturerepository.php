<?php
namespace Task\Repositories;

use Task\Models\Furniture;
use Task\Lib\DatabaseHandler;

class FurnitureRepository implements InterfaceProductRepository
{
    private $pdo;

    public function __construct()
    {
        $this->connectDb();
    }



    public function connectDb()
    {
        $dbHandler = new DatabaseHandler();
        $this->pdo = $dbHandler->connect();
    }



    public function save($furniture)
    {
        // furniture attributes
            
        $sku = $furniture->getSku();
        $name = $furniture->getName();
        $price = $furniture->getPrice();
        $type = $furniture->getType();
        $width = $furniture->getWidth();
        $height = $furniture->getHeight();
        $length = $furniture->getLength();

        //Inserting into items
        $stmt = $this->pdo->prepare("INSERT INTO items(sku, name, price, type) VALUES(:sku, :name, :price, :type)");

        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $type);

        
        $stmt->execute();



        //Inserting into dimensions
        $stmt = $this->pdo->prepare("INSERT INTO dimensions(height, width, length , item_id) VALUES(:height, :width, :length, :item_id)");

        $stmt->bindParam(':height', $height);
        $stmt->bindParam(':width', $width);
        $stmt->bindParam(':length', $length);
        $stmt->bindParam(':item_id', $item_id);

        $item_id = $this->pdo->lastInsertId();

        $stmt->execute();
    }




    public function getAllProducts()
    {
        //SELECTING items
        $query = "SELECT items.*, dimensions.* FROM items INNER JOIN dimensions ON items.id = dimensions.item_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    
    public function delete($id)
    {
        //DELETING product special attr from dimensions table
        $query = "DELETE FROM dimensions WHERE item_id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        //DELETING product from items table
        $query = "DELETE FROM items WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);

        $stmt->execute();
    }
}
