<?php

namespace Database\Seeders;
use App\Models\Buku;

 

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i =0; $i <20; $i++){
            Buku::create([
                'judul'=>fake()->sentence(3),
                'penulis'=>fake()->name(),
                'harga'=>fake()->numberbetween(10000,50000),
                'tanggal_terbit'=>fake()->date(),
            ]);
        }
    }
}
