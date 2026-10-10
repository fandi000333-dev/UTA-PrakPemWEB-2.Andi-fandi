<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('books', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('isbn', 20)->nullable()->unique();
            $table->string('author');
            $table->string('publisher')->nullable();
            $table->unsignedSmallInteger('published_year')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
