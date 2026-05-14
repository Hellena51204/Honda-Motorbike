<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'required|url',
            'images' => 'nullable|array',
            'images.*' => 'nullable|url',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'year' => 'nullable|string',
            'colors' => 'nullable|string',
        ]);

        if(!empty($data['colors'])) {
            $data['colors'] = array_map('trim', explode(',', $data['colors']));
        } else {
            $data['colors'] = [];
        }

        if(!empty($data['images'])) {
            $data['images'] = array_values(array_filter($data['images'], function($value) {
                return !is_null($value) && $value !== '';
            }));
        } else {
            $data['images'] = [];
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'required|url',
            'images' => 'nullable|array',
            'images.*' => 'nullable|url',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer|min:0',
            'year' => 'nullable|string',
            'colors' => 'nullable|string',
        ]);

        if(!empty($data['colors'])) {
            $data['colors'] = array_map('trim', explode(',', $data['colors']));
        } else {
            $data['colors'] = [];
        }

        if(!empty($data['images'])) {
            $data['images'] = array_values(array_filter($data['images'], function($value) {
                return !is_null($value) && $value !== '';
            }));
        } else {
            $data['images'] = [];
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Sửa sản phẩm thành công.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công.');
    }
}
