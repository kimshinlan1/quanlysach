<?php

namespace App\Http\Controllers;

use App\Book;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use League\Csv\Writer;

class HomeController extends Controller
{
    public function showImportView()
    {
        return view('import');
    }

    public function importCSVHandler(Request $request)
    {
        // $request->validate([
        //     'file' => "required|mimes:csv,txt"
        // ]);

        // Get the uploaded file and open it using the CSV reader
        $fileCSV = $request->file('csv_file')->getPathname();
        $csv = Reader::createFromPath($fileCSV, 'r');

        //returns all the CSV records as an Iterator object
        $csv->setHeaderOffset(0);
        $records = $csv->getRecords();

        // Loop
        $csv_data = [];
        foreach ($records as $record) {
            $csv_data[] = $record;
        }

        DB::table('books')->insert($csv_data);

        // Redirect back to the import form with a success message
        return response()->json(['success' => 'Thêm dữ liệu từ file csv thành công', 'redirect' => route('book.index')]);
    }

    public function exportCSVHandler()
    {
        // Get all books from database
        $books = Book::all();

        // Create a new CSV Writer instance
        $csv = Writer::createFromFileObject(new \SplTempFileObject);

        // Add the header row
        $csv->insertOne(['ten', 'mota', 'soluong', 'tacgia', 'nhaxuatban',    'danhmuc', 'hinh', 'noidungsach']);

        // Loop through each book and insert it into csv file
        foreach ($books as $book) {
            $csv->insertOne([$book->ten, $book->mota, $book->soluong, $book->tacgia, $book->nhaxuatban, $book->danhmuc, $book->hinh, $book->noidungsach]);
        }

        // Set the HTTP headers to download the CSV file
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="books.csv"',
        ];

        // Return the CSV file as a response
        return response($csv->getContent(), 200, $headers);
    }
}
