<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@perpustakaan.test',
            'password' => 'password',
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jalan Merdeka No. 1',
        ]);

        User::factory()->count(10)->create(['role' => 'member']);

        $categories = [
            ['name' => 'Teknologi', 'description' => 'Buku teknologi dan pemrograman.'],
            ['name' => 'Sains', 'description' => 'Buku tentang sains dan pengetahuan.'],
            ['name' => 'Novel', 'description' => 'Koleksi novel fiksi populer.'],
            ['name' => 'Pendidikan', 'description' => 'Buku referensi dan pendidikan.'],
        ];

        foreach ($categories as $category) {
            
                \App\Models\Category::create($category);
            
        }

        $books = [
            ['title' => 'Algoritma Dasar', 'author' => 'Abdul Kadir', 'category_id' => 1, 'description' => 'Pengantar algoritma dasar.', 'status' => 'available', 'total_copies' => 5, 'available_copies' => 5, 'published_year' => 2022],
            ['title' => 'Basis Data', 'author' => 'Rosa Shalahuddin', 'category_id' => 1, 'description' => 'Dasar-dasar basis data.', 'status' => 'borrowed', 'total_copies' => 4, 'available_copies' => 2, 'published_year' => 2021],
            ['title' => 'Pemrograman Web', 'author' => 'Janner Simarmata', 'category_id' => 1, 'description' => 'Panduan pemrograman web modern.', 'status' => 'available', 'total_copies' => 6, 'available_copies' => 6, 'published_year' => 2023],
        ];

        foreach ($books as $book) {
            \App\Models\Book::create($book);
        }
    }
}
