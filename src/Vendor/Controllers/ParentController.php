<?php
namespace Vendor\Controllers;

use Vendor\Models\View;

class ParentController 
{
    protected $view;
    public function __construct() {
        $className = static::class;
        $array = explode('\\', $className);
        $lastElement = end($array);
        $shortClassName = lcfirst(substr($lastElement, 0, -10));
        $this->view = new View(__DIR__ . '/../../MyProject/Templates/' . $shortClassName);
    }
} 