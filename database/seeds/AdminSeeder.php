<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $user = DB::table('users')->insert([
                'name' =>   'Admin',
                'email' => 'madmin@chapter247.com',
                'password' => Hash::make('123456789'),
            ]);
       $user->assignRole('admin');
        
    }
}
