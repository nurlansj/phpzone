<?php
namespace Vendor\Controllers;
use MyProject\View\View;

abstract class ParentController
{
    protected $view;
    public function __construct() {
        $className = static::class;
        $reflector = new \ReflectionClass($className);
        $viewFolder = lcfirst(substr($reflector->getShortName(),0,-10));
        $this->view = new View(__DIR__ . '/../../../templates/' . $viewFolder);
    }
}