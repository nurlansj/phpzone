<?php
namespace Vendor\Controllers;
use Vendor\View\View;

abstract class ParentController
{
    protected $view;
    public function __construct() {
        $className = static::class;
        $pieces = explode('\\', $className);
        $shortName = array_pop($pieces);
        $viewFolder = lcfirst(substr($shortName,0,-10));
        $this->view = new View(__DIR__ . '/../../../templates/' . $viewFolder);

        // get shortName of static Class using \ReflectionClass
        // return;
        // $reflector = new \ReflectionClass($className);
        // $viewFolder = lcfirst(substr($reflector->getShortName(),0,-10));
        // $this->view = new View(__DIR__ . '/../../../templates/' . $viewFolder);
    }
}