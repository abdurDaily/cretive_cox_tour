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
        $user->email = 'abdurdiary@gmail.com';
        $user->is_going = true;
        $user->password = Hash::make('test123@');
        $user->phone = '01777797143';
        $user->l_size = 1;
        $user->opinion = 'no opinion';
        $user->single_room = 1;
        $user->save();
    }
}
