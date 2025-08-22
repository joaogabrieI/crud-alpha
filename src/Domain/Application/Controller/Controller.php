<?php 

namespace Alpha\Domain\Application\Controller;

interface Controller
{
    public function processRequest(): void;
}