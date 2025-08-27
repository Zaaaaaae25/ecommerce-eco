<?php

namespace App\Http\Controllers;

use App\Models\Product; // Jangan lupa import model Product
use App\Models\Wishlist; // Jangan lupa import model Wishlist
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth Facade

class WishlistController extends Controller
{
    /**
     * Menampilkan halaman wishlist milik user yang sedang login.
     */
    public function index()
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk melihat wishlist.');
        }

        // Ambil semua item wishlist milik user yang sedang login
        // Eager load relasi 'product' untuk menghindari N+1 problem
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->latest()->get();

        // Kirim data ke view
        return view('wishlist.index', compact('wishlistItems'));
    }

    /**
     * Metode ini biasanya tidak digunakan untuk wishlist.
     * Item ditambahkan langsung dari halaman produk.
     */
    public function create()
    {
        //
    }

    /**
     * Menyimpan produk baru ke dalam wishlist.
     */
    public function store(Request $request)
    {
        // Validasi request, pastikan product_id ada
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menambahkan item ke wishlist.');
        }

        $userId = Auth::id();
        $productId = $request->product_id;

        // Cek apakah produk sudah ada di wishlist user
        $existingItem = Wishlist::where('user_id', $userId)
                                ->where('product_id', $productId)
                                ->first();

        if ($existingItem) {
            return back()->with('info', 'Produk ini sudah ada di wishlist Anda.');
        }

        // Jika belum ada, buat entri baru
        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan ke wishlist!');
    }

    /**
     * Metode ini biasanya tidak digunakan.
     * Semua item ditampilkan di halaman index.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Metode ini tidak relevan untuk wishlist.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Metode ini tidak relevan untuk wishlist.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Menghapus item dari wishlist.
     */
    public function destroy(string $id)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk menghapus item.');
        }

        // Cari item wishlist berdasarkan ID-nya
        $wishlistItem = Wishlist::find($id);

        // Jika item tidak ditemukan atau bukan milik user yang sedang login, beri error
        if (!$wishlistItem || $wishlistItem->user_id !== Auth::id()) {
            return back()->with('error', 'Item tidak ditemukan atau Anda tidak memiliki izin.');
        }

        // Hapus item
        $wishlistItem->delete();

        return back()->with('success', 'Produk berhasil dihapus dari wishlist.');
    }
}
