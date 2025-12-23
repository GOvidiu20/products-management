<?php

use App\Controllers\ProductController;
use App\Model\Product;

require __DIR__ . '/../vendor/autoload.php';

$path = trim(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),
    '/'
);

$productModel = new Product();
$controller = new ProductController($productModel);

$routes = [
    '#^$#' => fn() => $controller->index(),

    '#^create#' => fn() => $controller->change(),

    '#^(\d+)/change$#' => fn($id) => $controller->change((int) $id),

    '#^store$#' => fn() => $controller->store(),

    '#^(\d+)/update$#' => fn($id) => $controller->update((int) $id),

    '#^(\d+)/delete$#' => fn($id) => $controller->delete((int) $id),
];

foreach ($routes as $pattern => $handler) {
    if (preg_match($pattern, $path, $matches)) {
        array_shift($matches);
       $handler(...$matches);

        exit;
    }
}

http_response_code(404);
echo 'Page not found';