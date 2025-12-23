<?php

namespace App\Controllers;

use App\Helpers\RequestHelper;
use App\Model\Product;
use HelsingborgStad\GlobalBladeService\GlobalBladeService;

class ProductController extends RequestHelper
{
    private Product $productModel;

    public function __construct(
        Product $productModel
    )
    {
        $this->productModel = $productModel;
    }

    public function index(): void
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
            'products'   => $products,
            'page'       => $page,
            'totalPages' => $totalPages,
            'search'     => $search,
        ]);
    }

    public function change(int $productId = null): void
    {
        if ($productId) {
            $product = $this->productModel->find($productId);
        }

        $blade = GlobalBladeService::getInstance(
            [__DIR__ . '/../views'],
            __DIR__ . '/../../cache'
        );

        echo $blade->makeView('products.change-page', [
            'product' => $productId ? $product : null,
        ]);
    }

    public function store(): void
    {
        try {
            $this->productValidation();

            if (! empty($this->errors)) {
                throw new \Exception('Validation failed: ' . implode(', ', $this->errors));
            }

            $data = $this->requestProductFields();

            $this->productModel->create($data);

            http_response_code(200);
        } catch (\Exception $e) {
            var_dump($e->getMessage());
            http_response_code(400);
        }
    }

    public function update(int $productId = null): void
    {
        try {
            $this->productValidation();

            if (! empty($this->errors)) {
                throw new \Exception(implode(', ', $this->errors));
            }

            $data = $this->requestProductFields();

            $this->productModel->update($productId, $data);

            http_response_code(200);
        } catch (\Exception $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }

    public function delete(int $productId): void
    {
        try {
            $this->productModel->delete($productId);

            http_response_code(200);
        } catch (\Exception $e) {
            http_response_code(400);
            echo $e->getMessage();
        }
    }
}