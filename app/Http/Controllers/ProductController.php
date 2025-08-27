<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Pastikan ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; // Pastikan ini ada

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil semua kategori dari database
        $categories = Category::all();
        // Mengirim data kategori ke view
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input dari form
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // 2. Handle upload gambar jika ada
        if ($request->hasFile('image')) {
            // Kode baru yang benar
            $path = $request->file('image')->store('products', 'public'); // Simpan ke disk 'public'
            $validatedData['image'] = $path; // Simpan path relatifnya
        }

        // 3. Buat slug otomatis dari nama produk
        $validatedData['slug'] = Str::slug($request->name, '-');

        // 4. Atur nilai default untuk eco_score
        $validatedData['eco_score'] = 0; // Sesuai default di database

        // 5. Simpan produk ke database
        Product::create($validatedData);

        // 6. Redirect ke halaman index dengan pesan sukses
        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete(str_replace('/storage', 'public', $product->image));
            }          // Kode baru yang benar
            $path = $request->file('image')->store('products', 'public'); // Simpan ke disk 'public'
            $validatedData['image'] = $path; // Simpan path relatifnya
        }

        $validatedData['slug'] = Str::slug($request->name, '-');

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete(str_replace('/storage', 'public', $product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
