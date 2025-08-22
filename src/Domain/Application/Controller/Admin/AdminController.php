<?php 

namespace Alpha\Domain\Application\Controller\Admin;

use Alpha\Domain\Application\Controller\Controller;

class AdminController implements Controller
{
    public function processRequest(): void
    {
        require_once __DIR__ . '/../../../../../views/admin.php';
    }
}