<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $Product = Product::all();

        return ProductResource::collection($Product);
    }

    public function store(ProductRequest $request)
    {
        try {
            $Product = Product::create($request->all());

            return response()->json([
                'message' => 'Created SuccessFully',
                'data' => ProductResource::make($Product),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($Id)
    {
        $Product = Product::find($Id);
        if (! $Product) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return ProductResource::make($Product);
    }


    public function searchProduct(Request $request)
    {
        $search = '%'.$request->input('search').'%';
        $Product = Product::where('name', 'LIKE', $search)->get();

        return ProductResource::collection($Product);
    }
}
