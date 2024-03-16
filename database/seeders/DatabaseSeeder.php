<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            [
                'role'=>'admin',
                'name'=>'Karunia Motor',
                'email'=>'admin@gmail.com',
                'password'=>Hash::make('admin'),
                'gender'=>'Perempuan',
                'born'=>'2001-01-01',
                'address'=>'Jl. Aji Melayu No. 19-20',
                'phone'=>'+6282251482711',
                'province'=>'Kalimantan Barat',
                'city'=>'Kabupaten Sintang',
                'subdistrict'=>'Sintang',
                'postal_code'=>'78613',
                'image'=>'admin.jpeg',
            ],
            [
                'role'=>'user',
                'name'=>'Eli Yanti',
                'email'=>'eli@gmail.com',
                'password'=>Hash::make('123123'),
                'gender'=>'Perempuan',
                'born'=>'2001-01-01',
                'address'=>'Jl. Aji Melayu No. 19-20',
                'phone'=>'+6281256622930',
                'province'=>'Kalimantan Barat',
                'city'=>'Kabupaten Sintang',
                'subdistrict'=>'Sintang',
                'postal_code'=>'78613',
                'image'=>'user.jpeg',
            ]
        ]);
    }
}
