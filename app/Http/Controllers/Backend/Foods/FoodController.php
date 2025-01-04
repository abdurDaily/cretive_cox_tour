<?php

namespace App\Http\Controllers\Backend\Foods;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    public function foodsIndex(){
        return view('backend.foods.store');
    }


    
    public function foodsStore(Request $request){
        $storeTransport = new Food();
        $storeTransport->food_name = $request->food_name; 
        $storeTransport->serve_time = $request->serve_time;
        $storeTransport->save();
    }


    public function viewfoods(){
        $foods = Food::get();
        return view('frontend.foods.allFoods', compact('foods'));
    }
}
