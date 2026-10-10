<label for="title">Judul</label>
<input
    id="title"
    name="title"
    value="{{ old('title', $book->title ?? '') }}"
>
@error('title')
    <small>{{ $message }}</small>
@enderror
