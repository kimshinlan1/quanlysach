<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\VarDumper\Cloner\Data;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('category')->orderBy('created_at', 'desc')->paginate(5);
        return view("books.index")->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $danhmuc = Category::all();
        return view('books.create', compact('danhmuc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function storeByAjax(Request $request)
    {
        $book = new Book;
        // validate form data
        $validatedData = $request->validate([
            'tensach' => 'required|string',
            'mota' => 'required|string|max:255',
            'soluong' => 'required|integer|max:50',
            'tacgia' => 'required',
            'nhaxuatban' => 'required',
            'danhmuc' => 'required',
            'noidungsach' => 'required',
            'image' => 'required|image|max:2048'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/images');
            $image->move($destinationPath, $name);
            $book->hinh = $name;
        }

        $book->ten = $validatedData["tensach"];
        $book->mota = $validatedData["mota"];
        $book->soluong = $validatedData["soluong"];
        $book->tacgia = $validatedData["tacgia"];
        $book->nhaxuatban = $validatedData["nhaxuatban"];
        $book->danhmuc = $validatedData["danhmuc"];
        $book->hinh = $validatedData["image"];
        $book->noidungsach = $validatedData["noidungsach"];

        // save data to database
        $book->save();

        // Get the files from the request
        if ($request->hasFile('files')) {
            $files = $request->file('files');
        }
        // Loop through each file and upload it
        if (isset($files) && is_iterable($files)) {
            foreach ($files as $file) {
                // Generate a unique filename for the file
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationFilesPath = public_path('/uploads/images');
                $file->move($destinationFilesPath, $filename);

                $fileModel = new File();
                $fileModel->filename = $filename;
                $fileModel->filepath = 'uploads/images/' . $filename;
                $fileModel->filetype = $file->getClientMimeType();
                $fileModel->book_id = $book->id;
                $fileModel->save();
            }
        }

        // Write log when user create new book
        try {
            Log::channel('my_log')->info("User created a new book", ["user_id" => auth()->user()->id, "book_id" => $book->id]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return response()->json(['success' => true, 'redirect' => route('book.index')]);
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
        // iddanhmuc -> tendanhmuc ($book->danhmuc)
        // lay danh muc theo id book
        $categories = Category::all();

        // echo "<pre>";
        //  $danhmuc = Category::find($book->danhmuc) ? Category::find($book->danhmuc) : $book->danhmuc;
        return view('books.edit', compact("book", "categories"));
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

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/images');
            $image->move($destinationPath, $name);
            $bookById->hinh = $name;
        }

        $bookById->save();
        return redirect()->route("book.index")->with("success", "Cập nhật dữ liệu thành công");
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
    public function deleteByAjax($id)
    {
        $rowById = Book::find($id);
        // Check if the row exist
        if (!$rowById)
            return response()->json(["success" => false]);

        // delete row
        $rowById->delete();

        try {
            Log::channel('my_log')->warning("User deleted a book", ["user_id" => auth()->user()->id, "book_id" => $id]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

        return response()->json(["success" => true]);
    }
}
// Writing The Validation Logic in Request object in laravel