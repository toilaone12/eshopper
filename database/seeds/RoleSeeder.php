<?php

use App\Model\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::truncate(); // xoa neu co CSDL
        Role::create(['name_role' => 'Quản lý']);
        Role::create(['name_role' => 'Nhân viên']);
    }
}
