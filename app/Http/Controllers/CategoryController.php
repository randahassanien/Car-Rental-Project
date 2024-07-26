<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;


class CategoryController extends Controller
{
    public function index(){
        $categories=Category::get();
        return view('admin/categories',compact("categories"));
    }

    public function create(){
        return view('admin.addCategory');
    }

    public function store(Request $request){
        $messages=[
            'name.required'=>'Name is required'

        ];
        $request->validate([
            'name'=>'required|string'

        ], $messages );

        $new_category = new Category();
        $new_category->name = $request->name;

        $new_category->save();

        return redirect('admin/categories');

    }

    public function edit(string $id){
        $category=Category::findOrFail($id);
        return view('admin/editCategory',compact('category'));
    }
    public function update(Request $request, string $id): RedirectResponse
    {
        Category::where('id',$id)->update([
            'name'=>$request->name
        ]);
        return redirect('admin/categories');

    }

    public function destroy(Request $request):RedirectResponse{
        $id= $request->id;
        Category::where('id',$id)->delete();
        return redirect('admin/categories');
       }



}
