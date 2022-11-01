<?php

use App\Model\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Admin::truncate(); // xoa neu co CSDL
        Admin::create(
            [
                'id_role' => 1,
                'name_admin' => 'son',
                'password_admin' => md5(123456),
            ]
        );
        Admin::create(
            [
                'id_role' => 2,
                'name_admin' => 'tu',
                'password_admin' => md5(123456),
            ]
        );
        Admin::create(
            [
                'id_role' => 1,
                'name_admin' => 'toan',
                'password_admin' => md5(123456),
            ]
        );
        Admin::create(
            [
                'id_role' => 2,
                'name_admin' => 'hong',
                'password_admin' => md5(123456),
            ]
        );
    }
}
