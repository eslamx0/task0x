<?php
namespace Task\Repositories;

use Task\Models\DVD;
use Task\Lib\DatabaseHandler;

class DvdRepository implements InterfaceProductRepository
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



    public function save($dvd)
    {
        // dvd attributes
        
        $sku = $dvd->getSku();
        $name = $dvd->getName();
        $price = $dvd->getPrice();
        $type = $dvd->getType();
        $size = $dvd->getSize();


        //Inserting into items
        $stmt = $this->pdo->prepare("INSERT INTO items(sku, name, price, type) VALUES(:sku, :name, :price, :type)");

        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $type);


        
        $stmt->execute();
        //Inserting into size
        $stmt = $this->pdo->prepare("INSERT INTO sizes(size, item_id) VALUES(:size, :item_id)");

        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':item_id', $item_id);
        
        $item_id = $this->pdo->lastInsertId();

        $stmt->execute();
    }



    public function getAllProducts()
    {
        //SELECTING items
        $query = "SELECT items.*, sizes.* FROM items INNER JOIN sizes ON items.id = sizes.item_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    
    public function delete($id)
    {
        //DELETING product special attr from sizes table
        $query = "DELETE FROM sizes WHERE item_id = :id";
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
