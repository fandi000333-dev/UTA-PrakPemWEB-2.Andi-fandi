@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h1>Tambah Buku</h1>

    <form method="POST" action="{{ route('books.store') }}">
        @csrf

        <label for="title">Judul</label>
        <input
            id="title"
            name="title"
            value="{{ old('title') }}"
            >
        @error('title')
            <small>{{ $message }}</small>
        @enderror

        <!-- Tambahkan field lain dengan pola yang sama. -->
        <button type="submit">Simpan</button>
    </form>
@endsection
