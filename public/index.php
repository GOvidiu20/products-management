<?php

use App\Controllers\ProductController;
use App\Model\Product;

require __DIR__ . '/../vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($uri, '/'));

$productModel = new Product();
$controller = new ProductController($productModel);

switch ($parts[0]) {
    case '':
        $controller->index();
        break;

    case 'change':
        $id = isset($parts[1]) ? (int) $parts[1] : null;

        $controller->change($id);
        break;

    case 'store':
        $controller->store();
        break;

    case 'update':
        $controller->update();
        break;

    case 'delete':
        $controller->delete();
        break;

        default:
        http_response_code(404);
        echo "Page not found";
}