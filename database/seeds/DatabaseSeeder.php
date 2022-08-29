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
        // $this->call(UserSeeder::class);
        DB::table('product')->insert([
            'name_product' => Str::random(10),
            'image_product' => Str::random(10).'.png',
            'quantity_product' => '1',
            'price_product' => '100000',
            'description_product' => Hash::make('password'),
        ]);
    }
}
