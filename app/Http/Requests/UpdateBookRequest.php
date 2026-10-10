<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
       public function authorize(): bool
    {
        return true;
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
        public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'isbn' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('books', 'isbn')->ignore($this->route('book')),
            ],
            'author' => ['required', 'string', 'max:150'],
            'publisher' => ['nullable', 'string', 'max:150'],
            'published_year' => [
                'nullable',
                'integer',
                'min:1900',
                'max:'.date('Y'),
            ],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
        ];
    }
public function messages(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'isbn.unique' => 'ISBN sudah digunakan oleh buku lain.',
            'published_year.min' => 'Tahun terbit minimal 1900.',
            'published_year.max' => 'Tahun terbit tidak boleh melebihi tahun berjalan.',
            'price.min' => 'Harga tidak boleh bernilai negatif.',
            'stock.min' => 'Stok tidak boleh bernilai negatif.',
        ];
    }
    public function attributes(): array
    {
        return [
            'title' => 'judul',
            'isbn' => 'ISBN',
            'author' => 'penulis',
            'publisher' => 'penerbit',
            'published_year' => 'tahun terbit',
            'price' => 'harga',
            'stock' => 'stok',
            'description' => 'deskripsi',
        ];
    }

}
