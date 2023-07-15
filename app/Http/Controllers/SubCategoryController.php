<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Validation\Rule;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subCategories = subCategory::with('category')->paginate(2);
        return view('subCategory.index' , compact('subCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id','name')->where('is_active' , true)->get();
        return view('subCategory.create' , compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'name' => 'required',
            'is_active' => 'required | in:1,0',
            'img' => 'required|mimes:png,jpg',
            'category_id' => ['required' ,Rule::exists('categories', 'id') ]
        ]);

        if (!$validator->fails()){
            if ($request->hasFile('img')){
                $imgName = 'subCategory'.time() . '.' .$request->file('img')->getClientOriginalExtension();
                $request->file('img')->storePubliclyAs('subCategory' , $imgName , ['disk'=>'public']);
                $request->img = $imgName;
            }
            $created = subCategory::create([
                'name'=>$request->name,
                'is_active'=>$request->is_active,
                'category_id'=>$request->category_id,
                'img'=>$request->img,
            ]);
            return response()->json(['message'=>$created?'تمت عملية الاضافة بنجاح' : "فشلت عملية الاضافة" , 'style'=> $created?'success':'error'] , $created ?Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(['message'=>$validator->errors()->first() , 'style'=>'error'],Response::HTTP_OK);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(subCategory $subCategory)
    {
        dd(123);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subCategory $subCategory)
    {
        $categories = Category::select('id','name')->where('is_active' , true)->get();
        return view('subCategory.edit' , compact('subCategory' ,'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, subCategory $subCategory)
    {
        $validator = Validator($request->all(), [
            'name' => 'required',
            'img' => 'mimes:png,jpg',
            'is_active' => 'required|string|in:true,false,1,0',
            'category_id' => ['required' ,Rule::exists('categories', 'id') ]
        ]);
        if (!$validator->fails()) {

            if ($request->has('img')) {
                //delete old image if exist
                if (Storage::disk('public')->exists("category/$subCategory->img")) {
                    Storage::disk('public')->delete("category/$subCategory->img");
                }

                // receive and store new image
                $img = $request->file('img');
                $imgName = 'subcategory_'.time() . '.' . $img->getClientOriginalExtension();
                $request->file('img')->storePubliclyAs('subCategory', $imgName, ['disk' => 'public']);
                $request->img = $imgName;
            }


            $updated = $subCategory->update([
                'name'=>$request->name,
                'img'=>$request->img?$request->img:$subCategory->img,
                'category_id'=>$request->category_id ,
                'is_active'=>$request->is_active,

            ]);
            if ($updated) {
                return response()->json(['message' => 'تمت العملية بنجاح' , 'style' => 'success'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'فشلت عملية التعديل' ,'style' => 'error'], Response::HTTP_BAD_REQUEST);
            }


        }else{
            dd($validator->errors()->first());
            return response()->json(['message'=>$validator->errors()->first(), 'style'=>'error'],Response::HTTP_OK);

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(subCategory $subCategory)
    {
        $deleted = $subCategory->delete();
        if ($deleted) {
            return response()->json(['message'=>'تمت العملية بنجاح'],Response::HTTP_OK);
        }
        else {
            return response()->json(['message'=>'فشلت عملية الحذف'],Response::HTTP_BAD_REQUEST);
        }
    }
}
