<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use function Termwind\style;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $columns = ['name' , 'is_active', 'img'];
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
    public function store(Request $request)
    {
        $validator = Validator($request->all() , [
            'name' => 'required',
            'img'=> 'required|mimes:png,jpg',
            'is_active'=>'required|string|in:true,false'
        ]);

        if (!$validator->fails()){

            $imgName = 'category_'.time().'.'.$request->file('img')->getClientOriginalExtension();
            $request->file('img')->storePubliclyAs('category' , $imgName , ['disk'=>'public']);
            $request->img = $imgName;
            $request->is_active = $request->is_active ?1:0;

            $created =  Category::create([
                'name'=>$request->name ,
                'is_active'=>$request->is_active ,
                'img'=>$request->img ,

            ]);
            return response()->json(['message'=>$created?'تمت العملية بنجاح':'فشلت عملية الاضافة ', 'style'=>'success'],$created ?Response::HTTP_OK : Response::HTTP_BAD_REQUEST );


        }else{
            return response()->json(['message'=>$validator->errors()->first()],Response::HTTP_OK);

        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $subCategories =  $category->subCategories()->where('is_active' , 1)->get();
        return response()->json(['subCategories'=>$subCategories], Response::HTTP_OK);

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

        $validator = Validator($request->all(), [
            'name' => 'required',
            'img' => 'mimes:png,jpg',
            'is_active' => 'required|string|in:true,false,1,0'
        ]);
        if (!$validator->fails()) {

            if ($request->has('img')) {
                //delete old image if exist
                if (Storage::disk('public')->exists("category/$category->img")) {
                    Storage::disk('public')->delete("category/$category->img");
                }

                // receive and store new image
                $img = $request->file('img');
                $imgName = 'category_'.time() . '.' . $img->getClientOriginalExtension();
                $request->file('img')->storePubliclyAs('category', $imgName, ['disk' => 'public']);
                $request->img = $imgName;
                  }

            $updated = $category->update([
                    'name'=>$request->name,
                    'img'=>$request->img?$request->img:$category->img,
                    'is_active'=>$request->is_active,

                ]);
                if ($updated) {
                    return response()->json(['message' => 'تمت العملية بنجاح' , 'style' => 'success'], Response::HTTP_OK);
                } else {
                    return response()->json(['message' => 'فشلت عملية التعديل' ,'style' => 'error'], Response::HTTP_BAD_REQUEST);
                }


        }else{
            return response()->json(['message'=>$validator->errors()->first() , 'style'=>'error'],Response::HTTP_OK);

        }



    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {

        $deleted = $category->delete();
        if ($deleted) {
            return response()->json(['message'=>'تمت العملية بنجاح'],Response::HTTP_OK);
        }
        else {
            return response()->json(['message'=>'فشلت عملية الحذف'],Response::HTTP_BAD_REQUEST);
        }

    }



}
