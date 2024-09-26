<?php
require_once __DIR__ . '../../../controllers/AuthorController.php';

$controller = new AuthorController();

$authors = $controller->index();