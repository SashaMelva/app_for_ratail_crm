<?php

namespace App\Services;

class View
{
    public function __construct(
        private string $viewPath,
        private array    $arguments = []
    )
    {
    }

    public function __toString(): string
    {
        return $this->getRenderedFileAsString($this->viewPath);
    }

    /** Рендеринг страницы */
    private function getRenderedFileAsString(string $filePath): string
    {
        ob_start();
        require_once($filePath);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }
}