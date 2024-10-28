<?php

namespace App\Services;

use App\Contracts\ProductServiceInterface;
use App\Contracts\ProductRepositoryInterface;

use App\Repositories\ProductRepository;

class ProductService implements ProductServiceInterface
{

    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts($search = null)
    {
        return $this->productRepository->getAllProducts($search);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->createProduct($data);
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function updateProduct($id, array $data)
    {
        $product = $this->productRepository->getProductById($id);
        return $this->productRepository->updateProduct($product, $data);
    }

    public function deleteProduct($id)
    {
        $product = $this->productRepository->getProductById($id);
        return $this->productRepository->deleteProduct($product);
    }

}
