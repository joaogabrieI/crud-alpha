<?php 

namespace Alpha\Domain\Application\Controller;

interface ViewController extends Controller {
    public function loadView(string $view, array $data = []): void;
}