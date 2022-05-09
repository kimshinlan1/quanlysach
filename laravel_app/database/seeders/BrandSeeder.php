<?php

namespace Database\Seeders;

use App\Models\Device;
use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Samsung = Brand::create([
            'name' => 'Samsung'
        ]);
        $Nokia = Brand::create([
            'name' => 'Nokia'
        ]);
        $Apple = Brand::create([
            'name' => 'Apple'
        ]);
        $BlackBerry = Brand::create([
            'name' => 'BlackBerry'
        ]);
        $brands = collect([$Samsung, $Nokia, $Apple, $BlackBerry]);
        // Create Devices based on its brand
        foreach ($brands as $brand) {
            Device::factory()->count(4)->for($brand)->create();
        }
    }
}
