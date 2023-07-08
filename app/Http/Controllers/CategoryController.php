<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

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
        $categoryStora= Category::create($request->getData());
        if ($categoryStora) {
            return response()->json(['message'=>'تمت العملية بنجاح'],Response::HTTP_OK);
            # code...
        }

         // if ($request->has('img')){
        //     $img = $request->file('img');
        //     $imgName = time().$request->name . '.'. $img->getClientOriginalExtension();
        //     $request->file('img')->storePubliclyAs('category' ,$imgName , ['disk' => 'public']);
        //      $request->img = $imgName;
        // }

        // $created = Category::create([
        //     'name'=> $request->name ,
        //     'img'=> $request->img  ,
        //     'is_active'=> $request->is_active? $request->is_active :0
        // ]);

        //     session()->flash('msg' , $created?'created Successfully':'fail updating ');
        //     session()->flash('style' , $created?'success':'danger');
        // return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

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
    public function update(Request $request, Category $category)
    {


        $request->validate([
            'name' => 'required',
            'img'=> 'mimes:png,jpg',
            'is_active'=>'in:1,0|nullable'
        ]);




        if ($request->has('img')){

            //delete old image if exist
            if (Storage::disk('public')->exists("category/$category->img")) {
                Storage::disk('public')->delete("category/$category->img");
            }

            // receive and store new image
            $img = $request->file('img');
            $imgName = time().$request->name . '.'. $img->getClientOriginalExtension();
            $request->file('img')->storePubliclyAs('category' ,$imgName , ['disk' => 'public']);
             $request->img = $imgName;
        }


        $updated =  $category->update([
            'name' => $request->name ,
            'img' => $request->img? $request->img : $category->img  ,
            'is_active' => $request->is_active ? $request->is_active:0
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
//    public function destroy(Category $category)
//    {
//        if (Storage::disk('public')->exists("category/$category->img")) {
//            Storage::disk('public')->delete("category/$category->img");
//        }
//
//
//        $deleted = $category->delete();
//        if($deleted){
//            session()->flash('msg' , 'deleted Successfully');
//            session()->flash('style' , 'danger');
//        }else{
//            session()->flash('msg' , 'fail deleting ');
//            session()->flash('style' , 'danger');
//        }
//        return redirect()->route('category.index');
//    }

    public function delete($id)
    {
        $category = Category::find($id);
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
