<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Contracts\ProductServiceInterface;

use App\Services\ProductService;
use App\Traits\ProductValidationTrait;

class ProductController extends Controller
{

    use ProductValidationTrait;

    protected $productService;

    public function __construct(ProductServiceInterface  $productService)
    {
        $this->productService = $productService;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $products = $this->productService->getProducts($search);

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $data = $this->validateProduct($request);
        $product = $this->productService->createProduct($data);

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $data = $this->validateProduct($request);
        $product = $this->productService->updateProduct($id, $data);

        return response()->json($product);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return response()->json(null, 204);
    }


    // // Display a listing of the products
    // public function index(Request $request)
    // {
    //     //return Product::all();

    //     $search = $request->input('search');

    //     $products = Product::when($search, function ($query, $search) {
    //         return $query->where('name', 'like', "%{$search}%")
    //                     ->orWhere('category', 'like', "%{$search}%");
    //     })->get();

    //     return response()->json($products);
    // }

    // // Store a newly created product in storage
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'quantity_in_stock' => 'required|integer|min:1',
    //         'price' => 'required|numeric|min:0.01',
    //         'category' => 'required|string|max:255',
    //     ]);

    //     $product = Product::create($request->all());

    //     return response()->json($product, 201);
    // }

    // // Display the specified product
    // public function show($id)
    // {
    //     return Product::findOrFail($id);
    // }

    // // Update the specified product in storage
    // public function update(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'quantity_in_stock' => 'required|integer|min:1',
    //         'price' => 'required|numeric|min:0.01',
    //         'category' => 'required|string|max:255',
    //     ]);

    //     $product->update($request->all());

    //     return response()->json($product);
    // }

    // // Remove the specified product from storage
    // public function destroy($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->delete();

    //     return response()->json(null, 204);
    // }

}
