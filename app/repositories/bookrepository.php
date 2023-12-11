<?php
namespace Task\Repositories;

use Task\Models\Book;
use Task\Lib\DatabaseHandler;

class BookRepository implements InterfaceProductRepository
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



    // save a product book into database
    public function save($book)
    {
        // book attributes
        $sku = $book->getSku();
        $name = $book->getName();
        $price = $book->getPrice();
        $type = $book->getType();
        $weight = $book->getWeight();
        
        //Inserting into items
        $query = "INSERT INTO items(sku, name, price, type) VALUES(:sku, :name, :price, :type)";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':sku', $sku);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':type', $type);


        $stmt->execute();

        //Inserting into weight
        $query = "INSERT INTO weights(weight, item_id) VALUES(:weight, :item_id)";

        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(':weight', $weight);
        $stmt->bindParam(':item_id', $item_id);

        $item_id = $this->pdo->lastInsertId();

        $stmt->execute();
    }


    // get all books from database
    public function getAllProducts()
    {
        $query = "SELECT items.*, weights.* FROM items INNER JOIN weights ON items.id = weights.item_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $all_products = $stmt->fetchAll();

        return $all_products;
    }



    // delete a book from database
    public function delete($id)
    {

        //DELETING product special attr from weight table
        $query = "DELETE FROM weights WHERE item_id = :id";
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
