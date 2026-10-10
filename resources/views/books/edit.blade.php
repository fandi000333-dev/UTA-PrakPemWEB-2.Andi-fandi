<nav>
        <a href="{{ route('books.index') }}">Data Buku</a>
    </nav>

<h1>Edit Buku</h1>

<!-- Menampilkan error validasi jika ada input yang tidak sesuai -->
@if ($errors->any())
    <div style="background-color: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border: 1px solid #f5c6cb; border-radius: 4px;">
        <strong>Gagal menyimpan perubahan:</strong>
        <ul style="margin: 0; padding-left: 20px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('books.update', $book) }}" method="POST">
    @csrf
    @method('PUT')

    <div style="margin-bottom: 15px;">
        <label for="title" style="display: block; font-weight: bold;">Judul Buku:</label>
        <input type="text" id="title" name="title" value="{{ old('title', $book->title) }}" required style="width: 300px; padding: 5px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="author" style="display: block; font-weight: bold;">Pencipta / Penulis:</label>
        <input type="text" id="author" name="author" value="{{ old('author', $book->author) }}" required style="width: 300px; padding: 5px;">
    </div>

    <div style="margin-bottom: 15px;">
    <label for="published_year">Tahun Terbit:</label><br>
    <input 
        type="number" 
        id="published_year" 
        name="published_year" 
        value="{{ old('published_year', $book->published_year) }}" 
        min="1900" 
        max="{{ date('Y') }}" 
        required 
        style="width: 300px; padding: 5px;">
</div>

    <div style="margin-bottom: 15px;">
        <label for="price" style="display: block; font-weight: bold;">Harga:</label>
        <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $book->price) }}" required style="width: 300px; padding: 5px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="stock" style="display: block; font-weight: bold;">Stok:</label>
        <input type="number" id="stock" name="stock" value="{{ old('stock', $book->stock) }}" required style="width: 300px; padding: 5px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="description" style="display: block; font-weight: bold;">Deskripsi Buku:</label>
        <textarea name="description" id="description" rows="4" style="width: 100%; max-width: 400px; padding: 8px;">{{ old('description', $book->description) }}</textarea>
    </div>

    <button type="submit" style="padding: 6px 12px; background-color: #0d6efd; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan Perubahan</button>
    <a href="{{ route('books.index') }}" style="margin-left: 10px;">Batal</a>
</form>
