<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;

class TestimonialController extends Controller
{
    public function index(){
        $testimonials=Testimonial::get();
        return view('admin/testimonials',compact("testimonials"));
    }

    public function create(){
        return view('admin.addTestimonials');
    }

    public function store(Request $request){
        $messages=[
            'name.required'=>'Name is required',
            'name.string'=>'name must be string',
            'position.required'=>'position is required',
            'content.required'=>'content is required',

        ];
        $request->validate([
            'name'=>'required|string',
            'position'=>'required',
            'content'=>'required',
            'images'=>'required',
        ], $messages );

        $new_testimonial = new Testimonial();
        $new_testimonial->name = $request->name;
        $new_testimonial->position = $request->position;
        $new_testimonial->content = $request->content;
        $new_testimonial->filename=$request->file('testimonial')->getClientOriginalName();
        $new_testimonial->images = file_get_contents($request->file('testimonial')->getpathname());

        $new_testimonial->save();

        return redirect('admin/testimonials');

    }


}

