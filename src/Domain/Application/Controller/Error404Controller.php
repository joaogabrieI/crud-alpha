<?php

namespace Alpha\Domain\Application\Controller;

class Error404Controller implements Controller
{
    public function processRequest(): void
    {
        http_response_code(404);
        echo "Página não encontrada";
    }
}