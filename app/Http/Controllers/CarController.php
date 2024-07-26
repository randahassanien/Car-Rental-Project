<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;

class CarController extends Controller
{
    public function index(){
        $cars=Car::get();
        return view('admin/cars',compact("cars"));
    }

    public function create(){
        return view('admin.addCar');
    }

    public function store(Request $request){
        $messages=[
            'title.required'=>'title is required',
            'title.string'=>'title must be string',
            'content.required'=>'content is required',
            'doors.required'=>'doors is required',
            'doors.integer'=>'doors must be integer',
            'price.required'=>'price is required',

        ];
        $request->validate([
            'title'=>'required|string',
            'content'=>'required',
            'doors'=>'required',
            'price'=>'required',


        ], $messages );

        $new_car = new Car();
        $new_car->title = $request->title;
        $new_car->content = $request->content;
        $new_car->doors = $request->doors;
        $new_car->price = $request->price;

        $new_car->save();

        return redirect('admin/addcars');

    }
}
