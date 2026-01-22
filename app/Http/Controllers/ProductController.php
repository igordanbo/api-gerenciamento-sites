<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('url', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('hosting')) {
            $query->where('hosting', $request->hosting);
        }

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        if ($request->filled('service')) {
            $query->where('service', $request->department);
        }

        $orderBy  = $request->get('order_by', 'created_at');
        $orderDir = $request->get('order_dir', 'desc');

        $allowedOrderBy = ['name', 'status', 'hosting', 'department', 'service', 'created_at'];

        if (in_array($orderBy, $allowedOrderBy)) {
            $query->orderBy($orderBy, $orderDir === 'asc' ? 'asc' : 'desc');
        }

        $perPage = min($request->get('per_page', 10), 50);

        $products = $query->paginate($perPage)->withQueryString();

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());

        return response()->json([
            'data' => $product,
            'message' => "OK"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'data' => $product,
            'message' => "OK"
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return response()->json([
            'data' => $product,
            'message' => "OK"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return response()->json([
            'message' => 'Produto removido com sucesso'
        ], 200);
    }
}
