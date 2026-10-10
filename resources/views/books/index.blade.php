<body >

@extends('layouts.app')

@section('title', 'Data Buku' ) <br>

@section('content')
<head>
    <!-- ... head tag lainnya ... -->
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>


    
<div class="judul-1">
    <h1 class="judul">Data Buku</h1>
</div>
    
    <form method="GET" action="{{ route('books.index') }}">
        <input
            type="search"
            name="q"
            value="{{ $keyword }}"
            placeholder="Cari judul, penulis, atau ISBN">
        <button type="submit">Cari</button>
        <a href="{{ route('books.index') }}">Reset</a>
  
    </form><br>

    <table border="1" >
        <thead>
            <tr>
                <th>NO</th>
                <th>Judul Buku</th>
                <th>Pencipta</th>
                <th>Tahun Terbit</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        @forelse ($books as $book)
            <tr style="text-align: center;">
                <td>{{ $books->firstItem() + $loop->index }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->published_year }}</td> <!-- PERBAIKAN: Ubah jadi published_year -->
                <td>{{ $book->stock }}</td>
                <td>
                    <a href="{{ route('books.show', $book) }}" style="text-decoration: none; color:black;">Detail</a>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning" style="text-decoration: none; color:black;">
                        Edit
                    </a>
                    <form method="POST" action="{{ route('books.destroy', $book) }}"
                        onsubmit="return confirm('Hapus data buku ini?')" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6">Data belum tersedia.</td>
            </tr>
        @endforelse

    </table>

    @if ($books->hasPages())
        <nav>
            @if ($books->onFirstPage())
                <span>Sebelumnya</span>
            @else
                <a href="{{ $books->previousPageUrl() }}">Sebelumnya</a>
            @endif

            <span>
                Halaman {{ $books->currentPage() }}
                dari {{ $books->lastPage() }}
            </span>

            @if ($books->hasMorePages())
                <a href="{{ $books->nextPageUrl() }}">Berikutnya</a>
            @endif
        </nav>
    @endif

@endsection
</body>