<?php

namespace App\Contracts;

interface ProductServiceInterface
{
    public function getProducts($search = null);
    public function createProduct(array $data);
    public function getProductById($id);
    public function updateProduct($id, array $data);
    public function deleteProduct($id);
}
