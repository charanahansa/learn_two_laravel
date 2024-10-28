<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

use App\Contracts\ProductServiceInterface;

use App\Traits\ProductValidationTrait;

class ProductController extends Controller
{

    use ProductValidationTrait;

    protected $productService;

    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        try {
            $search = $request->input('search');
            $products = $this->productService->getProducts($search);

            return response()->json($products);
        } catch (\Exception $e) {
            Log::channel('api_errors')->error('Failed to fetch products: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch products'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $this->validateProduct($request);
            $product = $this->productService->createProduct($data);

            return response()->json($product, 201);
        } catch (\Exception $e) {
            Log::channel('api_errors')->error('Failed to create product: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to create product'], 500);
        }
    }

    public function show($id)
    {
        try {
            $product = $this->productService->getProductById($id);

            return response()->json($product);
        } catch (\Exception $e) {
            Log::channel('api_errors')->error('Failed to fetch product with ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['error' => 'Failed to fetch product'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $this->validateProduct($request);
            $product = $this->productService->updateProduct($id, $data);

            return response()->json($product);
        } catch (\Exception $e) {
            Log::channel('api_errors')->error('Failed to update product with ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update product'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $this->productService->deleteProduct($id);

            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::channel('api_errors')->error('Failed to delete product with ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete product'], 500);
        }
    }

}
