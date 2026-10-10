<?php
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookCrudTest extends TestCase
{
    use RefreshDatabase;

    public function test_book_can_be_created(): void
    {
        $payload = [
            'title' => 'Pemrograman Laravel 13',
            'isbn' => '9781234567890',
            'author' => 'Penulis Contoh',
            'publisher' => 'Penerbit Kampus',
            'published_year' => 2026,
            'price' => 125000,
            'stock' => 10,
            'description' => 'Deskripsi buku.',
        ];

        $response = $this->post(route('books.store'), $payload);

        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', [
            'isbn' => '9781234567890',
        ]);
    }
}

test('example', function () {
   $response = $this->get('/');

    $response->assertStatus(200);
});
