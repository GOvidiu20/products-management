<?php

namespace App\Controllers;

use App\Model\Product;
use HelsingborgStad\GlobalBladeService\GlobalBladeService;

class ProductController
{
    private Product $productModel;

    public function __construct(
        Product $productModel
    )
    {
        $this->productModel = $productModel;
    }

    public function index()
    {
        $page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $search  = isset($_GET['search']) ? (string)$_GET['search'] : '';
        $perPage = 10;

        $products = $this->productModel->all($search, $page, $perPage);

        $totalProducts = $this->productModel->count();
        $totalPages    = ceil($totalProducts / $perPage);

        $blade = GlobalBladeService::getInstance(
            [__DIR__ . '/../views'],
            __DIR__ . '/../../cache'
        );

        echo $blade->makeView('products.list-page', [
            'products' => $products,
            'page' => $page,
            'totalPages' => $totalPages,
            'title' => 'Products List',
            'search' => $search,
        ]);
    }

    public function change(int $productId = null)
    {
        if ($productId) {
            $product = $this->productModel->find($productId);
        }

        $blade = GlobalBladeService::getInstance(
            [__DIR__ . '/../views'],
            __DIR__ . '/../../cache'
        );

        echo $blade->makeView('products.change-page', [
            'title' => 'Create Product',
            'product' => $productId ? $product : null,
        ]);
    }

    public function store() {
        $data = [
            'name'              => $_POST['name'] ?? '',
            'price'             => $_POST['price'] ?? 0,
            'availability_date' => $_POST['availability_date'] ?? null,
            'description'       => $_POST['description'] ?? '',
            'image_path'        => $_POST['image_url'] ?? '',
        ];

        return $this->productModel->create($data);
    }
}