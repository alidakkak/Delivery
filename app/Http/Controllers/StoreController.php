<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreResource;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $store = Store::all();

        return StoreResource::collection($store);
    }

    public function store(StoreRequest $request)
    {
        try {
            $store = Store::create($request->all());

            return response()->json([
                'message' => 'Created SuccessFully',
                'data' => StoreResource::make($store),
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
        $store = Store::find($Id);
        if (! $store) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return StoreResource::make($store);
    }

    public function searchStore(Request $request)
    {
        $search = '%'.$request->input('search').'%';
        $store = Store::where('name', 'LIKE', $search)->get();

        return StoreResource::collection($store);
    }
}
