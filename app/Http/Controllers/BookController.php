<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
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
        echo "hehe";
        $books = Book::with(['category','files'])->orderBy('created_at', 'desc')->paginate(5);
        return view("books.index")->with('books', $books);
    }

    public function search(Request $request)
    {
        $search_txt = $request->get("search_value");
        if (!empty($search_txt)) {
            $search_result = Book::where("ten", "like", "%" . $search_txt . "%")->with('category')->get();
            return response()->json($search_result);
        } else {
            return response()->json([]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // Show view create new Books
    public function create()
    {
        $danhmuc = Category::all();
        return new Response(view('books.create', ['danhmuc' => $danhmuc]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // Store data by Ajax
    public function storeByAjax(Request $request)
    {
        $book = new Book;
        // validate form data
        $validator = Validator::make($request->all(), [
            'tensach' => 'required|string',
            'mota' => 'required|string|max:255',
            'soluong' => 'required|integer|max:50',
            'tacgia' => 'required',
            'nhaxuatban' => 'required',
            'noidungsach' => 'required'
        ], [
            'tensach.required' => 'Vui lòng nhập tên sách',
            'mota.required' => 'Vui lòng nhập mô tả',
            'soluong.required' => 'Vui lòng nhập số lượng',
            'tacgia.required' => 'Vui lòng nhập tác giả',
            'nhaxuatban.required' => 'Vui lòng nhập nhà xuất bản',
            'noidungsach.required' => 'Vui lòng nhập nội dung sách'
        ]);

        if ($validator->fails()) {
            return ["errors" => $validator->errors()];
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path(URL_IMAGE_UPLOAD);
            $image->move($destinationPath, $name);
            $book->hinh = $name;
        } else {
            $book->hinh = null;
        }


        $book->ten = $validator->validated()["tensach"];
        $book->mota = $validator->validated()["mota"];
        $book->soluong = $validator->validated()["soluong"];
        $book->tacgia = $validator->validated()["tacgia"];
        $book->nhaxuatban = $validator->validated()["nhaxuatban"];
        $book->noidungsach = $validator->validated()["noidungsach"];
        $book->danhmuc = $request->input("danhmuc");

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
                $destinationFilesPath = public_path(URL_IMAGE_UPLOAD);
                $file->move($destinationFilesPath, $filename);

                $fileModel = new File();
                $fileModel->filename = $filename;
                $fileModel->filepath = URL_IMAGE_UPLOAD . $filename;
                $fileModel->filetype = $file->getClientMimeType();
                $fileModel->book_id = $book->id;
                $fileModel->save();
            }
        }

        // Write log when user create new book
        try {
            Log::channel('my_log')->info("User created a new book",
            ["user_id" => auth()->user()->id, "book_id" => $book->id]);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
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
        // validate form data
        $validator = Validator::make($request->all(), [
            'tensach' => 'required|string',
            'mota' => 'required|string|max:255',
            'soluong' => 'required|integer|max:50',
            'tacgia' => 'required',
            'nhaxuatban' => 'required',
            'image' => 'image|max:2048',
            'noidungsach' => 'required'
        ], [
            'tensach.required' => 'Vui lòng nhập tên sách',
            'mota.required' => 'Vui lòng nhập mô tả',
            'soluong.required' => 'Vui lòng nhập số lượng',
            'tacgia.required' => 'Vui lòng nhập tác giả',
            'nhaxuatban.required' => 'Vui lòng nhập nhà xuất bản',
            'image.image' => 'Vui lòng chọn đúng định dạng ảnh',
            'image.max' => 'Dung lượng ảnh không được vượt quá 2048 kilobytes.',
            'noidungsach.required' => 'Vui lòng nhập nội dung sách'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Get book by id
        $bookById = Book::find($id);
        // // Get file by id
        $fileById = File::where('book_id', "=", $id)->first();
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
            $fileById->filepath = '/uploads/images/' . $name;
        } else {
            $bookById->hinh = null;
        }

        $bookById->save();
        $fileById->save();
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