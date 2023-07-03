<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(2);
        return view('category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        if($request->is_active){
            $request->is_active = true;
        }else{
            $request->is_active = false;

        }
        if ($request->has('img')){
            $img = $request->file('img');
            $imgName = time().$request->name . '.'. $img->getClientOriginalExtension();
            $request->file('img')->storePubliclyAs('category' ,$imgName , ['disk' => 'public']);
             $request->img = $imgName;
        }
        $created = Category::create([
            'name'=> $request->name ,
            'img'=> $request->img  ,
            'is_active'=> $request->is_active
        ]);
        if ($created){
            session()->flash('msg' , 'created Successfully');
            session()->flash('style' , 'success');
        }else{
            session()->flash('msg' , 'fail updating ');
            session()->flash('style' , 'danger');
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('category.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if (Storage::disk('public')->exists("category/$category->img")) {
            Storage::disk('public')->delete("category/$category->img");
        }

        if ($request->has('img')){
            $img = $request->file('img');
            $imgName = time().$request->name . '.'. $img->getClientOriginalExtension();
            $request->file('img')->storePubliclyAs('category' ,$imgName , ['disk' => 'public']);
             $request->img = $imgName;
        }
        $updated =  $category->update([
            'name' => $request->name ,
            'img' => $request->img ,
            'is_active' => $request->is_active
        ]);
        if ($updated){
            session()->flash('msg' , 'updated Successfully');
            session()->flash('style' , 'info');
        }else{
            session()->flash('msg' , 'fail updating ');
            session()->flash('style' , 'danger');
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if (Storage::disk('public')->exists("category/$category->img")) {
            Storage::disk('public')->delete("category/$category->img");
        }


        $deleted = $category->delete();
        if($deleted){
            session()->flash('msg' , 'deleted Successfully');
            session()->flash('style' , 'danger');
        }else{
            session()->flash('msg' , 'fail deleting ');
            session()->flash('style' , 'danger');
        }
        return redirect()->route('category.index');
    }
}
