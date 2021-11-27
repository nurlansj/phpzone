<?php
namespace Vendor\Controllers;

use Vendor\View\View;

abstract class ParentController
{
    protected $view;
    public function __construct() {
        $className = static::class;
        $pieces = explode('\\', $className);
        $shortClassName = array_pop($pieces);
        $viewFolderName = lcfirst(substr($shortClassName,0,-10));
        $this->view = new View(__DIR__ . '/../../../templates/' . $viewFolderName);
    }
}