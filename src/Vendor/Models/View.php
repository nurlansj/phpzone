<?php
namespace Vendor\Models;

class View 
{
    private $templatePath;
    public function __construct(string $templatePath) {
        $this->templatePath = $templatePath;
    }
    public function renderHtml(string $templateName, array $vars = []) {
        extract($vars);
        ob_start();
        include $this->templatePath . '/' . $templateName;
        $buffer = ob_get_contents();
        ob_end_clean();
        echo $buffer;
    }
} 