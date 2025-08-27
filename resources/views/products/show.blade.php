<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header">
            <h3>Detail Produk: {{ $product->name }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    {{-- Menggunakan asset() untuk path gambar yang benar --}}
                    <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid rounded" alt="Gambar Produk {{ $product->name }}" onerror="this.onerror=null;this.src='https://placehold.co/600x400?text=No+Image';">
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 150px;">Nama Produk</th>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <th>Kategori</th>
                            {{-- Pastikan relasi 'category' ada di Model Product --}}
                            <td>{{ $product->category->name ?? 'Tidak ada kategori' }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Stok</th>
                            <td>{{ $product->stock }} unit</td>
                        </tr>
                        <tr>
                            <th>Deskripsi</th>
                            <td>{!! nl2br(e($product->description)) !!}</td>
                        </tr>
                    </table>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali ke Daftar Produk</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
