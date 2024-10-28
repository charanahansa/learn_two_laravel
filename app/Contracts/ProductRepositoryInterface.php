<?php

namespace App\Contracts;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAllProducts($search = null);
    public function createProduct(array $data);
    public function getProductById($id);
    public function updateProduct(Product $product, array $data);
    public function deleteProduct(Product $product);
}
