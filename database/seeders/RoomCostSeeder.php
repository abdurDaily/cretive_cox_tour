<?php

namespace Database\Seeders;

use App\Models\RoomCost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomAndTshirt = new RoomCost();
        $roomAndTshirt->single_room_cost = 988;
        $roomAndTshirt->couple_room_cost = 2903;
        $roomAndTshirt->t_shirt_price = 190;
        $roomAndTshirt->save();
        
    }
}
