<?php
namespace Vendor\View;

class View
{
    private $templatePath;
    public function __construct(string $templatePath) {
        $this->templatePath = $templatePath;
    }
    public function renderHtml(string $fileName, array $vars=[], int $code = 200) {
        http_response_code($code);
        extract($vars);
        ob_start();
        include $this->templatePath . '/' . $fileName;
        $buffer = ob_get_contents();
        ob_end_clean();

        echo $buffer;
    }
}