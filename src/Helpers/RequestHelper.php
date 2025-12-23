<?php

namespace App\Helpers;

class RequestHelper
{
    protected array $errors = [];

    public function productValidation(): array
    {
        $name        = $_POST['name'];
        $price       = $_POST['price'];
        $description = $_POST['description'];

        if ($name === '') {
            $this->errors['name'] = 'Name is required.';
        } elseif (strlen($name) > 255) {
            $this->errors['name'] = 'Name must not exceed 255 characters.';
        }

        if ($price === '') {
            $this->errors['price'] = 'Price is required.';
        } elseif (!is_numeric($price) || (float)$price < 0) {
            $this->errors['price'] = 'Price must be a valid non-negative number.';
        }

        if (strlen($description) > 1000) {
            $this->errors['description'] = 'Description must not exceed 1000 characters.';
        }

        return $this->errors;
    }

    function requestProductFields(): array
    {
        return [
            'name'              => $_POST['name'],
            'price'             => $_POST['price'],
            'availability_date' => $_POST['availability_date'],
            'description'       => $_POST['description'],
            'image_path'        => $_POST['image_path'],
            'in_stock'          => $_POST['in_stock'],
        ];
    }
}