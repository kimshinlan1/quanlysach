<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
   protected $table = "books";

   public function category()
   {
      return $this->belongsTo(Category::class, 'danhmuc');
   }

   public function files()
   {
      return $this->hasMany(File::class, 'book_id');
   }
}
