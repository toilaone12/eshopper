<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class); // goi tu lop seeder khac
        // DB::table('product')->insert([
        //     'name_product' => Str::random(10), //tao ra chuoi ky tu ngau nhien
        //     'id_category' => '1', //tao ra chuoi ky tu ngau nhien
        //     'image_product' => Str::random(10).'.png',
        //     'quantity_product' => '1',
        //     'price_product' => '100000',
        //     'description_product' => 'Thông tin chất lượng',
        // ]);
        // DB::table('category')->insert([
        //     'name_category' => Str::random(10), //tao ra chuoi ky tu ngau nhien
        // ]);
    }
}
