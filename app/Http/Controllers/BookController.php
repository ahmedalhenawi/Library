<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('category')->paginate(5);
        return view('book.index' ,compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')
                    ->select('name', 'id')->where('is_active', '1')
                    ->get();
        return view('book.create' , compact('categories'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'author_name'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'publication_at'=>'required|date',
        ]);

        $date=date_create($request->publication_at);
        $publication_at = date_format($date,"Y/m/d");

        $added = Book::create([
            'name'=>$request->name,
            'author_name'=>$request->author_name,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'publication_at'=>$publication_at,
        ]);

        if ($added){
            session()->flash('msg' , 'created Successfully');
            session()->flash('style' , 'success');
        }else{
            session()->flash('msg' , 'fail updating ');
            session()->flash('style' , 'danger');
        }
        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
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
        $request->validate([
            'name'=>'required',
            'author_name'=>'required',
            'description'=>'required',
            'category_id'=>'required',
            'publication_at'=>'required|date',
        ]);

        $updated =  $book->update([
            'name'=>$request->name,
            'author_name'=>$request->author_name,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'publication_at'=>$request->publication_at,
        ]);
        if ($updated){
            session()->flash('msg' , 'updated Successfully');
            session()->flash('style' , 'info');
        }else{
            session()->flash('msg' , 'fail updating ');
            session()->flash('style' , 'danger');
        }
        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(Book $book)
//    {
//        $deleted = $book->delete();
//        if($deleted){
//            session()->flash('msg' , 'deleted Successfully');
//            session()->flash('style' , 'danger');
//        }else{
//            session()->flash('msg' , 'fail deleting ');
//            session()->flash('style' , 'danger');
//        }
//        return redirect()->route('book.index');
//    }


    public function delete($id){
        $book = Book::find($id);
        $deleted = $book->delete();
        if($deleted){
            session()->flash('msg' , 'deleted Successfully');
            session()->flash('style' , 'danger');
        }else{
            session()->flash('msg' , 'fail deleting ');
            session()->flash('style' , 'danger');
        }
        return redirect()->route('book.index');
    }
}
