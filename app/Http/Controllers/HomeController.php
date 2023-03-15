<?php

namespace App\Http\Controllers;

use App\Book;
use League\Csv\Reader;
use League\Csv\Statement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function search(Request $request){
        $search_txt = $request->get("search_value");
        if(!empty($search_txt)){
            $search_result = Book::where("ten", "like", "%".$search_txt."%")->get();
            return response()->json($search_result);
        }else{
            return response()->json([]);
        }
    }

    public function showImportView(){
        return view('import');
    }

    public function importCSVHandler(Request $request){
        // $request->validate([
        //     'file' => "required|mimes:csv,txt"
        // ]);

        // Get the uploaded file and open it using the CSV reader
        $fileCSV = $request->file('csv_file')->getPathname();
        $csv = Reader::createFromPath($fileCSV, 'r');
        
        // Get the header row and remaining rows of data
        // $header = $csv->fetchOne();

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
        return response()->json(['success'=>'Thêm dữ liệu từ file csv thành công', 'redirect' => route('book.index')]);      
    }
}
