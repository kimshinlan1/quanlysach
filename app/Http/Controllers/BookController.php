<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //  echo "<pre>";
       /* $data = Book::all();
        var_dump($data->toArray());*/
        $books = DB::table('books')->paginate(5);
        
        return view("books.index")->with('books', $books);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate form data
        $validatedData = $request->validate([
            'ten'=>'required|string',
            'mota' => 'required|string|max:255',
            'soluong' => 'required|integer|max:50',
            'tacgia' =>'required',
            'nhaxuatban' => 'required',
            'danhmuc' => 'required',
            'noidungsach' => 'required',
        ]);


        $book = new Book;
        $book->ten = $validatedData["ten"];
        $book->mota = $validatedData["mota"];
        $book->soluong = $validatedData["soluong"];
        $book->tacgia = $validatedData["tacgia"];
        $book->nhaxuatban = $validatedData["nhaxuatban"];
        $book->danhmuc = $validatedData["danhmuc"];
        $book->noidungsach = $validatedData["noidungsach"];

        // save data to database
        $book->save();
        return response()->json(['success'=>true,'redirect'=>route('book.index')]);
    }

    public function storeByAjax(Request $request){
        // validate form data
        $validatedData = $request->validate([
            'tensach'=>'required|string',
            'mota' => 'required|string|max:255',
            'soluong' => 'required|integer|max:50',
            'tacgia' =>'required',
            'nhaxuatban' => 'required',
            'danhmuc' => 'required',
            'noidungsach' => 'required',
        ]);


        $book = new Book;
        $book->ten = $validatedData["tensach"];
        $book->mota = $validatedData["mota"];
        $book->soluong = $validatedData["soluong"];
        $book->tacgia = $validatedData["tacgia"];
        $book->nhaxuatban = $validatedData["nhaxuatban"];
        $book->danhmuc = $validatedData["danhmuc"];
        $book->noidungsach = $validatedData["noidungsach"];

        // save data to database
        $book->save();
        return response()->json(['success'=>true,'redirect'=>route('book.index')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {   
        //
        return view('books.edit', compact("book"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // get book by id
        $bookById = Book::find($id);
        $bookById->ten = $request->tensach;
        $bookById->mota = $request->mota;
        $bookById->soluong = $request->soluong;
        $bookById->tacgia = $request->tacgia;
        $bookById->nhaxuatban = $request->nhaxuatban;
        $bookById->danhmuc = $request->danhmuc;
        $bookById->noidungsach = $request->noidungsach; 

        $bookById->save();
        return redirect()->route("book.index")->with("success","Cập nhật dữ liệu thành công");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
        $book->delete();
        return redirect()->route("book.index")->with("success", "Xóa thành công");
    }
    public function deleteByAjax($id){
        $rowById = Book::find($id);
        // Check if the row exist
        if(!$rowById) 
            return response()->json([ "success"=> false ]);

        // delete row
        $rowById->delete();

        return response() -> json(["success"=>true]);
    }
}
// Writing The Validation Logic in Request object in laravel