<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->status = 1;
        $user->name = 'abdur rahman';
        $user->email = 'abdur@gmail.com';
        $user->is_going = true;
        $user->password = Hash::make('password');
        $user->phone = '01777797143';
        $user->tshirt_size = 'L';
        $user->opinion = 'no opinion';
        $user->save();
    }
}
