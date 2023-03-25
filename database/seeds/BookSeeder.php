<?php

use App\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Enumerable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Book::class, 10)->create();
        //
        // DB::table('books')->insert([
        //     'ten' => Str::random(10),
        //     'soluong' => rand(2,20),
        //     'nhaxuatban' => Str::random(10),
        //     "danhmuc" => rand(1,5)
        // ]);
    }
}
