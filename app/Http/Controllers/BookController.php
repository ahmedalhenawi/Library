<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('subCategory')->paginate(5);
        return view('book.index' ,compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $categories = Category::where('is_active' , true)->get();
        return view('book.create' , compact('categories'));
    }



public function store(Request $request)
{


    $validator = Validator($request->all() , [
        'name'=>'required',
        'author_name'=>'required',
        'description'=>'required',
        'sub_category_id'=>'required',
        'publication_at'=>'required|date',
    ]);

    $date=date_create($request->publication_at);
    $publication_at = date_format($date,"Y/m/d");

    if (!$validator->fails()){

        $added = Book::create([
            'name'=>$request->name,
            'author_name'=>$request->author_name,
            'description'=>$request->description,
            'sub_category_id'=>$request->sub_category_id,
            'publication_at'=>$publication_at,
        ]);
        return response()->json(['message'=>$added?'تمت العملية بنجاح':'فشلت عملية الاضافة ', 'style'=>'success'],$added ?Response::HTTP_OK : Response::HTTP_BAD_REQUEST );


    }else{
        return response()->json(['message'=>$validator->errors()->first()],Response::HTTP_OK);

    }











//    $request->validate([
//        'name'=>'required',
//        'author_name'=>'required',
//        'description'=>'required',
//        'category_id'=>'required',
//        'subCategory_id'=>'required',
//        'publication_at'=>'required|date',
//    ]);
//
//        $date=date_create($request->publication_at);
//        $publication_at = date_format($date,"Y/m/d");
//
//        $added = Book::create([
//            'name'=>$request->name,
//            'author_name'=>$request->author_name,
//            'description'=>$request->description,
//            'category_id'=>$request->category_id,
//            'publication_at'=>$publication_at,
//        ]);
//
//        if ($added){
//            session()->flash('msg' , 'created Successfully');
//            session()->flash('style' , 'success');
//        }else{
//            session()->flash('msg' , 'fail updating ');
//            session()->flash('style' , 'danger');
//        }
//        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
//        $categories = DB::table('categories')
//        ->select('name', 'id')->where('is_active', '1')
//        ->get();
        $categories = Category::where('is_active' , true)->get();

        return view('book.edit' , compact('book' ,'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {

        $validator = Validator($request->all(), [
            'name' => 'required',
            'author_name' => 'required',
            'description' => 'required',
            'sub_category_id' => 'required',
            'publication_at' => 'required|date',
        ]);
        if (!$validator->fails()) {

            $date = date_create($request->publication_at);
            $publication_at = date_format($date, "Y-m-d");

            $updated = $book->update([
                'name' => $request->name,
                'author_name' => $request->author_name,
                'description' => $request->description,
                'sub_category_id' => $request->sub_category_id,
                'publication_at' => $publication_at,

            ]);
            if ($updated) {
                return response()->json(['message' => 'تمت العملية بنجاح', 'style' => 'success'], Response::HTTP_OK);
            } else {
                return response()->json(['message' => 'فشلت عملية التعديل', 'style' => 'error'], Response::HTTP_BAD_REQUEST);
            }


        } else {
            return response()->json(['message' => $validator->errors()->first(), 'style' => 'error'], Response::HTTP_OK);

        }


    }


    public function destroy(Book $book){

        $deleted = $book->delete();
        if ($deleted) {
            return response()->json(['message'=>'تمت العملية بنجاح'],Response::HTTP_OK);
        }
        else {
            return response()->json(['message'=>'فشلت عملية الحذف'],Response::HTTP_BAD_REQUEST);
        }



    }
}
