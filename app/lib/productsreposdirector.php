<?php
namespace Task\Lib;

class ProductsReposDirector
{
    private $currentRepo;

    private $reposClasses = array(
        'Book' => 'Task\Repositories\BookRepository',
        'Furniture' => 'Task\Repositories\FurnitureRepository',
        'DVD' => 'Task\Repositories\DvdRepository'
    );


    private function currentRepoClass($currentRepoType)
    {
        $currentRepoClass = $this->reposClasses[$currentRepoType];

        return $currentRepoClass;
    }

    public function instantiateRepo($type)
    {
        $currentRepoClass =  $this->currentRepoClass($type);
        $this->currentRepo = new $currentRepoClass;

        return $this->currentRepo;
    }

    public function getReposClasses()
    {
        return $this->reposClasses;
    }
}
