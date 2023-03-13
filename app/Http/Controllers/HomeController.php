<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

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
}
