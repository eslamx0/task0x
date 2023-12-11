<?php

namespace Task\Lib;

use Task\Helpers\CoreHelpers\ParseUrlTrait;
use Task\Helpers\CoreHelpers\DispatchTrait;


class Core
{
    use ParseUrlTrait;
    use DispatchTrait;

    const NOT_FOUND_ACTION = "notFound";
    const NOT_FOUND_CONTROLLER = "notFound";

    private $currentController = 'product';
    private $currentAction = 'default';
    private $currentParams;

    public function __construct()
    {
        $this->parseUrl();
        $this->dispatch();
    }
}
